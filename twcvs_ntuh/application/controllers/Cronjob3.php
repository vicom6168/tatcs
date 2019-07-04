<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cronjob3 extends CI_Controller {

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
        $this->load->model('Calreport_Model');
        $this->load->model('Authority_Model');
        $this->load->helper('form');
    }
    
	public function index()
	{
	   
       //先清空欄位
	       $this->Calreport_Model->update_category('0');
         
           //17. 特殊表單Vascular/Procedure 中只要有5. Surgery for peripheral artery disease(5-01~5-07)就算
           //PAOD
           $this->Calreport_Model->update_category('17');
           //16. 特殊表單Vascular/Procedure 中只要有1-08-3 Open grafting for AAA就算
           //大動脈瘤->Abdominal
           $this->Calreport_Model->update_category('16');
           //15. 其他剩下的都算這一個欄位
           //其他 Others
           $this->Calreport_Model->update_category('15');
           //14.AVP=Y或MVP=Y或TVP=Y或PVP=Y
           //瓣膜修補術 Valvular Replacement
           $this->Calreport_Model->update_category('14');
           //13.AVR = Y或Bentall Op =Y或MVR = Y或TVR=Y或PVR=Y
           //瓣膜置換術Valvular replacement->組織 Tissue
           $this->Calreport_Model->update_category('13');
           //12.AVR/Mechanical valve = Y或Bentall Op/Mechanical valve =Y或MVR/Mechanical valve =Y或TVR/Mechanical valve =Y或PVR/Mechanilcal valve =Y
           //瓣膜置換術Valvular replacement->金屬 Metallic
           
           $this->Calreport_Model->update_category('12');
           //11. CBG = Y
           //冠狀動脈繞道手術CABG->Off pump->≥ 2
           $this->Calreport_Model->update_category('11');
           //10. CABG = Y 且所有吻合處總合 =1
           //冠狀動脈繞道手術CABG->Off pump->= 1
           $this->Calreport_Model->update_category('10');
           //9. CABG = Y 且 Cardiopulmonary bypass or ECMO support = Y
           //冠狀動脈繞道手術CABG->On pump->≥ 2
           $this->Calreport_Model->update_category('9');
           
           //8. CABG = Y 且 Cardiopulmonary bypass or ECMO support = Y 且所有吻合處總合 =1 
           //冠狀動脈繞道手術CABG->On pump->= 1
           $this->Calreport_Model->update_category('8');
           //7. Aortid surgery/Etiology/Aneurysm = Y
           //大動脈瘤->Thoracic
           $this->Calreport_Model->update_category('7');
           //6. Aortic surger/Etiolog/Dissection = Y
           //主動脈夾層 Aortic Dissection
           $this->Calreport_Model->update_category('6');
           //5. Heart transplant & Mechanical support/LVAD = Y 或 RVAD =Y
           //Mechanical Support   ECMO, LVAD
           $this->Calreport_Model->update_category('5');
           //4. Heart transplant & Mechanical support/Heart transplant = Y
           //心臟移植 HTX
           $this->Calreport_Model->update_category('4');
           //3. Congenital surgery/Primary procedure = Y
           //先天性心臟病->On CPB->Non-cyanotic
           $this->Calreport_Model->update_category('3');
           //2. Congenital surgery/Primary procedure = Y 且 Congenital surgery/Diagnosis 裡面任何診斷碼開頭有包含: 
           //14,16,18,23,24,26,27,31,33,36,39,42,43,44,46中的其中一個 
           //先天性心臟病->On CPB->Cyanotic 
           $this->Calreport_Model->update_category('2');
           //1. Congenital surgery/Primary procedure = Y 且 Congenital surgery/Bypass ≠ Y
           //先天性心臟病->No CPB
           $this->Calreport_Model->update_category('1');
           
           //2019 report=======================================
           //先清空欄位
           $this->Calreport_Model->update_category2019('0');
           
             //20. 特殊表單Vascular/Procedure 中只要有5. Surgery for peripheral artery disease(5-01~5-07)就算
           //PAOD
           $this->Calreport_Model->update_category2019('20');
           
             //19. 特殊表單Vascular/Procedure 中只要有8-01或8-02就算
           //Mechanical Support   ECMO, LVAD/ECMO
           $this->Calreport_Model->update_category2019('19');
           
             //17. 特殊表單Vascular/Procedure 中只要有5. Surgery for peripheral artery disease(5-01~5-07)就算
           //PAOD
           $this->Calreport_Model->update_category2019('18');
         
           //17. 特殊表單Vascular/Procedure 中只要有5. Surgery for peripheral artery disease(5-01~5-07)就算
           //PAOD
           $this->Calreport_Model->update_category2019('17');
           //16. 特殊表單Vascular/Procedure 中只要有1-08-3 Open grafting for AAA就算
           //大動脈瘤->Abdominal
           $this->Calreport_Model->update_category2019('16');
           //15. 其他剩下的都算這一個欄位
           //其他 Others
           $this->Calreport_Model->update_category2019('15');
           //14.AVP=Y或MVP=Y或TVP=Y或PVP=Y
           //瓣膜修補術 Valvular Replacement
           $this->Calreport_Model->update_category2019('14');
           //13.AVR = Y或Bentall Op =Y或MVR = Y或TVR=Y或PVR=Y
           //瓣膜置換術Valvular replacement->組織 Tissue
           $this->Calreport_Model->update_category2019('13');
           //12.AVR/Mechanical valve = Y或Bentall Op/Mechanical valve =Y或MVR/Mechanical valve =Y或TVR/Mechanical valve =Y或PVR/Mechanilcal valve =Y
           //瓣膜置換術Valvular replacement->金屬 Metallic
           
           $this->Calreport_Model->update_category2019('12');
           //11. CBG = Y
           //冠狀動脈繞道手術CABG->Off pump->≥ 2
           $this->Calreport_Model->update_category2019('11');
           //10. CABG = Y 且所有吻合處總合 =1
           //冠狀動脈繞道手術CABG->Off pump->= 1
           $this->Calreport_Model->update_category2019('10');
           //9. CABG = Y 且 Cardiopulmonary bypass or ECMO support = Y
           //冠狀動脈繞道手術CABG->On pump->≥ 2
           $this->Calreport_Model->update_category2019('9');
           
           //8. CABG = Y 且 Cardiopulmonary bypass or ECMO support = Y 且所有吻合處總合 =1 
           //冠狀動脈繞道手術CABG->On pump->= 1
           $this->Calreport_Model->update_category2019('8');
           //7. Aortid surgery/Etiology/Aneurysm = Y
           //大動脈瘤->Thoracic
           $this->Calreport_Model->update_category2019('7');
           //6. Aortic surger/Etiolog/Dissection = Y
           //主動脈夾層 Aortic Dissection
           $this->Calreport_Model->update_category2019('6');
           //5. Heart transplant & Mechanical support/LVAD = Y 或 RVAD =Y
           //Mechanical Support   ECMO, LVAD
           $this->Calreport_Model->update_category2019('5');
           //4. Heart transplant & Mechanical support/Heart transplant = Y
           //心臟移植 HTX
           $this->Calreport_Model->update_category2019('4');
           //3. Congenital surgery/Primary procedure = Y
           //先天性心臟病->On CPB->Non-cyanotic
           $this->Calreport_Model->update_category2019('3');
           //2. Congenital surgery/Primary procedure = Y 且 Congenital surgery/Diagnosis 裡面任何診斷碼開頭有包含: 
           //14,16,18,23,24,26,27,31,33,36,39,42,43,44,46中的其中一個 
           //先天性心臟病->On CPB->Cyanotic 
           $this->Calreport_Model->update_category2019('2');
           //1. Congenital surgery/Primary procedure = Y 且 Congenital surgery/Bypass ≠ Y
           //先天性心臟病->No CPB
           $this->Calreport_Model->update_category2019('1');
	}
      
 
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */