<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cronjob2 extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
     * 
	 */
	
	function __construct()
    {
        parent::__construct();
        $this->load->library('session');
       // if($this->session->userdata('bookingID')=="" || $this->session->userdata('isAdmin')=="")
      //  redirect(base_url().'home/home', 'refresh');
         
        $this->load->model('user_Model');
        $this->load->model('PatientInformation_Model');
        $this->load->model('Authority_Model');
        $this->load->helper('form');
    }
    
	public function index()
	{
	   
	       $SurgeonList=$this->user_Model->querySendNotifyVS();
         
        foreach($SurgeonList->result() as $row){
            $ccEmailArray=array();
            if($this->config->item("hospitalName")=="台大醫院" || $this->config->item("hospitalName")=="台大醫院新竹分院" ){
            //array_push($ccEmailArray,"lingyi.wei@gmail.com");
            }
                   if($row->vsEmailNotifyOthers=="Y"){
                             $ccEmail= $this->Authority_Model->query_authorityEmailbyvs($row->userID);
                       foreach($ccEmail->result() as $ccrow){
                                   if($ccrow->email!="")
                                   array_push($ccEmailArray,$ccrow->email);
                       }
                       }
            
                
               
                    $content=$this->mailBody($row,'1');
                    echo $row->userName."<br/>".$content."<br/>";
                    if($content!=""){
                              $ci = get_instance();
                    $ci->load->library('email');
                    $config['protocol'] = 'smtp';
                    $config['smtp_host'] = 'ssl://smtp.gmail.com';
                    $config['smtp_port'] = '465';
                    $config['smtp_user'] = 'twcvs2017@gmail.com'; 
                    $config['smtp_pass'] = 'vicwang2018';
                    $config['charset'] = 'utf-8';
                    $config['mailtype'] = 'html';
                    $config['newline'] = "\r\n";

                    $ci->email->initialize($config);

                    $ci->email->from('twcvs2017@gmail.com', 'TWCVS');
                       $list = array($row->vsEmail);
                   
                             
                       $ci->email->to($list);
                   //  $ci->email->to("lingyi.wei@gmail.com");
                      $ci->email->cc($ccEmailArray);
                        $this->email->reply_to('twcvs.tatcs@gmail.com', 'TWCVS');
                   
                   
                        $ci->email->subject('TWCVS: ['.$row->userRealname.' 醫師] 病患出院通知表');
                   
                  
                        $ci->email->message($content);
                    
                      $ci->email->send();
                      echo "病患出院通知表 send mail to:".$row->vsEmail."<br/>";
                     // print_r($ccEmailArray);
              }
               

            
         
           }
	}
      
   function mailBody($vs,$frequency)
    {
         $html="";
       
            $pList=$this->PatientInformation_Model->queryPatientCompleted($vs->userID);
      
        if($pList->num_rows()>0){
            $html="";
        $html.="<table cellspacing='0' cellpadding='0' border='1' width='100%' style='border: 1px solid black'> ";
        $html.="<tr bgcolor='#CED8F6'>";
        $html.="<td>Chart Numbet</td>";
        $html.="<td>Patient Name</td>";
        $html.="<td>EuroScore II</td>";
        $html.="<td>Op Date</td>";
        $html.="<td>Surgeon 1</td>";
      
        
        $html.="<td>Procedure</td>";
        $html.="<td>Complications</td>";
        $html.="</tr>";
        foreach($pList->result() as $row){
            $this->PatientInformation_Model->mailStatus($row->patientID);
                $html.="<tr>";
        $html.="<td>".$row->patientChartNumber."</td>";
        $html.="<td>".$row->patientName."</td>";
        $html.="<td>".$row->euroScoreII."%</td>";
        $html.="<td>".$row->patientOpDate."</td>";
        $html.="<td>".$row->patientSurgeon."</td>";
                
        $html.="<td>";
        if($row->operationCABG=='Y'){
                $html.="CABG(";
       if($row->operationLIMA!='' && $row->operationLIMA!='0' )
                $html.="LIMA:".$row->operationLIMA.",";       
       if($row->operationRIMA!='' && $row->operationRIMA!='0' )
                $html.="RIMA:".$row->operationRIMA.",";  
       if($row->operationRIMA_RadialA!='' && $row->operationRIMA_RadialA!='0' )
                $html.="Radial artery:".$row->operationRIMA_RadialA.",";  
       if($row->operationRIMA_GEA!='' && $row->operationRIMA_GEA!='0' )
                $html.="Gastroepiploic artery :".$row->operationRIMA_GEA.",";  
       if($row->operationVeinGraft!='' && $row->operationVeinGraft!='0' )
                $html.="Vein graft:".$row->operationVeinGraft.",";  
       $html.=")<br/>";
        }
        if($row->operationAorticValve=='Y'){
           //     $html.="Aortic valve surgery<br/>";
          if($row->operationAorticValve_AVP=='Y')
                $html.="AVP";
         if($row->operationAVP!='')
                $html.="(".$row->operationAVP.")"; 
         $html.="<br/>";
          if($row->operationAorticValve_AVR=='Y')
                $html.="AVR";
         if($row->operationAVRSelect!='')
                $html.="(".$row->operationAVRSelect.")"; 
         $html.="<br/>";
         if($row->operationMitralValveBentall=='Y')
                $html.="Bentall’s Op<br/>";
          }
        if($row->operationAorticSurgery=='Y'){
                $html.="Aortic surgery(";
        if($row->operationDissection=='Y')
                $html.="Dissection,";
        if($row->operationAneurysm=='Y')
                $html.="Aneurysm";
            $html.=")<br/>";
        }
        if($row->operationMitralValve=='Y'){
          //      $html.="Mitral valve surgery<br/>";
       if($row->Operation_MitralValve_MVP=='Y')
               $html.="MVP(";
        if($row->operationMVPRing=='Y')
                $html.="Ring,";
        if($row->operationMVPArtificialChord=='Y')
                $html.="Artificial chordae,";
        if($row->operationMVPAnnularPlication=='Y')
                $html.="Annular plication";
        if($row->operationMVPLeafletResection=='Y')
                $html.="Leaflet resection";
        if($row->Operation_MitralValve_MVP=='Y')
        $html.=")<br/>";
       
       // if($row->operationMVPOthers=='Y')
          //      $html.="Mitral valve surgery Ohers<br/>";
        if($row->Operation_MitralValve_MVR=='Y')
                $html.="MVR";
         if($row->operationMVR!='')
                $html.="(".$row->operationMVR.")";
         if($row->Operation_MitralValve_MVR=='Y')
         $html.="<br/>";
        }
      if($row->operationArrythmiaSurgery=='Y'){
            //    $html.="Arrhythmia surgery<br/>";
         if($row->operationMazebiatrialLesion=='Y')
                $html.="Maze (";
          if($row->operationMazeLA=='Y')
                $html.="LA Maze (no RA lesion) ,";
           if($row->operationMazePVIwithLAA=='Y')
                $html.="PVI with LAA closure,";
            if($row->operationMazePVIwithoutLAA=='Y')
                $html.="PVI without LAA closure ,";
             if($row->operationMazeOthers=='Y')
                $html.="Maze Others,";
            //  if($row->operationMazeEnergySource!='')
              //$html.="Energy source";
                //$html.="Energy source:".$row->operationMazeEnergySource."";
               if($row->operationMazebiatrialLesion=='Y')
              $html.=")<br/>";
         }
        if($row->operationTricuspidValve=='Y'){
           //     $html.="Tricuspid valve surgery<br/>";
      if($row->Operation_TricuspidValve_TVP=='Y')
              $html.="TVP(";
        if($row->operationTVPRing=='Y')
                $html.="Ring,";
        if($row->operationTVPArtificialChord=='Y')
                $html.="Artificial chordae,";
        if($row->operationTVPAnnularPlication=='Y')
                $html.="Annular plication,";
        if($row->operationTVPLeafletResection=='Y')
                $html.="Leaflet resection";
        if($row->Operation_TricuspidValve_TVP=='Y')
        $html.=")<br/>";
      
       // if($row->operationTVPOthers=='Y')
          //      $html.="Tricuspid valve surgery Ohers<br/>";
        if($row->Operation_TricuspidValve_TVR=='Y')
                $html.="TVR";
         if($row->operationTVR!='')
                $html.="(".$row->operationTVR.")";
          if($row->Operation_TricuspidValve_TVR=='Y')
         $html.="<br/>";
        }
                
        if($row->operationPulmonaryValve=='Y'){
         //       $html.="Pulmonary valve surgery<br/>";
        if($row->Operation_PulmonaryValve_PVP=='Y')
                $html.="PVP";
         if($row->operationPulmonaryValvePVP!='')
                $html.="(".$row->operationPulmonaryValvePVP.")";
           if($row->Operation_PulmonaryValve_PVP=='Y')
         $html.="<br/>";
        
       if($row->Operation_PulmonaryValve_PVR=='Y')
                $html.="PVR";
         if($row->operationPulmonaryValvePVR!='')
                $html.="(".$row->operationPulmonaryValvePVR.")";
          if($row->Operation_PulmonaryValve_PVR=='Y')
                $html.="<br/>";
       }
         
      //  if($row->operationHeartTransplantation=='Y')
          //      $html.="Heart transplant , Mechanical support:<br/>";
         if($row->operationHeartTransplantationOP=='Y')
                $html.="Heart transplant <br/>";
          if($row->operationHeartTransplantationLVAD=='Y')
                $html.="LVAD<br/>";
           if($row->operationHeartTransplantationRVAD=='Y')
                $html.="RVAD<br/>";
                   
        if($row->operationOtherCardiacSurgery1=='Y')
                $html.="Repair of Post-MI free wall rupture<br/>";
        if($row->operationOtherCardiacSurgery2=='Y')
                $html.="Repair of Post-MI ventricular septal defect (VSR)<br/>";
           if($row->operationOtherCardiacSurgery3=='Y')
                $html.=" Repair of traumatic cardiac rupture<br/>";
       if($row->operationOtherCardiacSurgery4=='Y')
                $html.=" Intracardiac tumor excision<br/>";
      if($row->operationOtherCardiacSurgery5=='Y')
                $html.="Septal myectomy<br/>";
      if($row->operationOtherCardiacSurgery6=='Y')
                $html.="Pericardiectomy<br/>";
      if($row->operationOtherCardiacSurgery7=='Y')
                $html.="LV aneurysm surgery<br/>";
      if($row->operationOtherCardiacSurgery8=='Y')
                $html.="Pulmonary embolectomy<br/>";
      if($row->operationOtherCardiacSurgery9=='Y')
                $html.="Pulmonary endarterectomy<br/>";
      if($row->operationOtherCardiacSurgery11=='Y')
                $html.="Cardiac Implantable Electronic Device lead insertion, replacement, or extraction<br/>";
      if($row->operationOtherCardiacSurgery10=='Y')
                $html.="Others<br/>";
     if($row->CongenitalProcedure1!='')
                $html.=$row->CongenitalProcedure1."<br/>"; 
     if($row->CongenitalProcedure2!='')
                $html.=$row->CongenitalProcedure2."<br/>"; 
     if($row->CongenitalProcedure3!='')
                $html.=$row->CongenitalProcedure3."<br/>"; 
     if($row->CongenitalProcedure4!='')
                $html.=$row->CongenitalProcedure4."<br/>"; 
     if($row->CongenitalProcedure5!='')
                $html.=$row->CongenitalProcedure5."<br/>"; 
      
          if($row->operationCABGMemo!='')
       $html.="<font color='red'>".$row->operationCABGMemo."</font><br/>"; 
         if($row->operationAorticMemo!='')
       $html.="<font color='red'>".$row->operationAorticMemo."</font><br/>"; 
           if($row->operationAorticSurgeryMemo!='')
       $html.="<font color='red'>".$row->operationAorticSurgeryMemo."</font><br/>"; 
         if($row->operationMVRMemo!='')
       $html.="<font color='red'>".$row->operationMVRMemo."</font><br/>"; 
         if($row->operationMazeMemo!='')
       $html.="<font color='red'>".$row->operationMazeMemo."</font><br/>"; 
           if($row->operationTricuspidValveMemo!='')
       $html.="<font color='red'>".$row->operationTricuspidValveMemo."</font><br/>"; 
             if($row->operationPulmonaryValveMemo!='')
       $html.="<font color='red'>".$row->operationPulmonaryValveMemo."</font><br/>"; 
               if($row->operationHeartTransplantationMemo!='')
       $html.="<font color='red'>".$row->operationHeartTransplantationMemo."</font><br/>"; 
                 if($row->operationOtherCardiacSurgeryMemo!='')
       $html.="<font color='red'>".$row->operationOtherCardiacSurgeryMemo."</font><br/>"; 
                 
       //瓣膜名稱
              if($row->AorticValveProductName!='')
             $html.="<font color='blue'>瓣膜名稱:".$row->AorticValveProductName."</font><br/>";     
               if($row->AorticValveProductType!='')
             $html.="<font color='blue'>瓣膜尺寸:".$row->AorticValveProductType."</font><br/>";     
               
                if($row->MitralValveProductName!='')
             $html.="<font color='blue'>瓣膜名稱:".$row->MitralValveProductName."</font><br/>";     
               if($row->MitralValveProductType!='')
             $html.="<font color='blue'>瓣膜尺寸:".$row->MitralValveProductType."</font><br/>";     
             
              if($row->TricuspidValveProductName!='')
             $html.="<font color='blue'>瓣膜名稱:".$row->TricuspidValveProductName."</font><br/>";     
               if($row->TricuspidValveProductType!='')
             $html.="<font color='blue'>瓣膜尺寸:".$row->TricuspidValveProductType."</font><br/>";     
               
                if($row->PulmonaryValveProductName!='')
             $html.="<font color='blue'>瓣膜名稱:".$row->PulmonaryValveProductName."</font><br/>";     
               if($row->PulmonaryValveProductType!='')
             $html.="<font color='blue'>瓣膜尺寸:".$row->PulmonaryValveProductType."</font><br/>";     
               
        $html.="</td>";
        $html.="<td>";
        
         if($row->outcomeCheck1=='Y')
                $html.="Operative Mortality<br/>"; 
          if($row->outcomeCheck2=='Y')
                $html.="Permanent Stroke<br/>";
          if($row->outcomeCheck3=='Y')
                $html.="Renal Failure<br/>";
          if($row->outcomeCheck4=='Y')
                $html.="Prolonged Ventilation > 24 hours<br/>";
          if($row->outcomeCheck5=='Y')
                $html.="Deep Sternal Wound Infection<br/>";
          if($row->outcomeCheck6=='Y')
                $html.="Reoperation For any reason<br/>";
          
            
            if($row->outcomeChildComplication4=='Y')
                $html.="Bleeding, requiring reoperation<br/>"; 
             if($row->outcomeChildComplication10=='Y')
                $html.="Mechanical circulatory support (IABP, VAD, ECMO, or CPS)<br/>"; 
                 if($row->outcomeChildComplication14=='Y')
                $html.="Neurological deficit that occurred after the operating room visit, persisting at discharge<br/>"; 
                  if($row->outcomeChildComplication20=='Y')
                $html.="Postoperative/Postprocedural respiratory insufficiency requiring mechanical ventilatory support > 7 days<br/>"; 
                   if($row->outcomeChildComplication23=='Y')
                $html.="Renal failure ­ acute renal failure, Acute renal failure requiring dialysis at the time of hospital discharge or 91 days if patient is still in hospital<br/>"; 
                    if($row->outcomeChildComplication28=='Y')
                $html.="Sepsis<br/>"; 
                     if($row->outcomeChildComplication35=='Y')
                $html.="Wound infection­Mediastinitis<br/>"; 
        $html.="</td>";  
        
        $html.="</tr>";
        
        }
         $html.="</table>";
         
        }

   return $html;
    }

    public function check()
    {
       
        $pList=$this->PatientInformation_Model->query_patientAlllist();   
        foreach($pList->result() as $row){
             $completeStatus='Y';
             //if(patientChartNumber =''  or  patientName=''  or  patientGender=''  or patientBirthday='' or patientBirthday='0000-00-00'
             //patientOpDate='' or patientOpDate='0000-00-00' or patientOpDate is null 
             if($row->patientChartNumber=='' || $row->patientName=='' || $row->patientGender=='' || $row->patientBirthday=='' || $row->patientBirthday=='0000-00-00' || $row->patientOpDate==''  || $row->patientOpDate=='0000-00-00' ) {
                 $completeStatus='N';
                 echo "1<br/>";
             }
             if($row->patientDischargeDate=='' || $row->patientDischargeDate=='0000-00-00' || $row->outcomeExtubationDate=='' || $row->outcomeExtubationDate=='0000-00-00' || $row->outcomeStatus=='') {
                 $completeStatus='N';
                 echo "2<br/>";
             }
              if($row->patientSurgeon=='' && $row->patientSurgeon2=='' && $row->patientSurgeon3=='' && $row->patientSurgeon4=='') {
                 $completeStatus='N';
                  echo "3<br/>";
             }
                if($row->CongenitalDiagnosis1=='' && $row->CongenitalDiagnosis2=='' && $row->CongenitalDiagnosis3=='' && $row->CongenitalDiagnosis4=='' && $row->CongenitalDiagnosis5=='' && $row->CongenitalDiagnosisOthers=='' && $row->AdultDiagnosis1=='' && $row->AdultDiagnosis2=='' && $row->AdultDiagnosis3=='' && $row->AdultDiagnosis4=='' && $row->AdultDiagnosis5=='' && $row->CongenitalDiagnosisOthers=='') {
                 $completeStatus='N';
                    echo "4<br/>";
             }  
               if(($row->CongenitalDiagnosis1!='' || $row->CongenitalDiagnosis2!='' || $row->CongenitalDiagnosis3!='' || $row->CongenitalDiagnosis4!='' || $row->CongenitalDiagnosis5!='' || $row->CongenitalDiagnosisOthers!='') && $row->CongenitalProcedure1=='' && $row->CongenitalProcedure2=='' && $row->CongenitalProcedure3=='' && $row->CongenitalProcedure4=='' && $row->CongenitalProcedure5=='' && $row->CongenitalProcedureOthers=='') {
                 $completeStatus='N';
                 echo "5<br/>";
             }   
                 if(($row->AdultDiagnosis1!='' || $row->AdultDiagnosis2!='' || $row->AdultDiagnosis3!='' || $row->AdultDiagnosis4!='' || $row->AdultDiagnosis5!='') && $row->operationCABG !='Y' && $row->operationAorticValve !='Y' && $row->operationAorticSurgery !='Y' && $row->operationMitralValve !='Y' && $row->operationArrythmiaSurgery !='Y' && $row->operationTricuspidValve !='Y' && $row->operationPulmonaryValve !='Y' && $row->operationHeartTransplantation !='Y' && $row->operationOtherCardiacSurgery !='Y') {
                 $completeStatus='N';
                     echo "6<br/>";
             }  
               if($row->patientCardiopulmonaryBypass=='' && strtotime($row->patientOpDate)>=strtotime('2019-01-01')) {
                 $completeStatus='N';
                   echo "7<br/>";
             }  
                  
                  if($completeStatus!=$row->CompletedStatus){
                      $this->PatientInformation_Model->changeStatus($row->patientID,$completeStatus);
                  }
              }
               

    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */