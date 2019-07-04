function loadDiagnosis(){
	 $.ajax({
           	        type:"POST",
           			url: "/parameter/loadDiagnosis",
           			cache: false,
           			data:
           				{},
           			datatype: "JSON",
           			success: function(data){
                         var HtmlStr="";						
           					HtmlStr +='<table cellspacing="0" cellpadding="0" border="1" class="" width=90%> ';
                            HtmlStr +='<thead>';
                            HtmlStr +='<tr>';
                            HtmlStr +='<th>No.</th>';
							HtmlStr +='<th>Diagnosis</th>';
                            HtmlStr +='<th>Action</th>';
                            HtmlStr +='</tr>';
                            HtmlStr +='</thead>';
							HtmlStr +='<tbody>';
							var user = JSON.parse(data).result;
                            if(user!=null){
    							for(i=0;i<user.length;i++){
                                              HtmlStr +='<tr>';
                                              HtmlStr +='<td>'+(i+1)+'</td>';
											  HtmlStr +='<td><input type="text" class="medium" id="DiagnosisName_'+user[i].DiagnosisID+'" value="'+user[i].DiagnosisName+'"></td>';
										
                                             HtmlStr +='<td>';
                                             HtmlStr +='<a href="#" onclick="javascript: editDiagnosis('+user[i].DiagnosisID+');"><img src="/images/gfx/icon-edit.png" alt="edit" /></a>&nbsp;&nbsp;';
                                             HtmlStr +='<a href="#" onclick="javascript:if(confirm(&quot;Press confirm to delete this data?&quot;)){ deleteDiagnosis('+user[i].DiagnosisID+');}" ><img src="/images/gfx/icon-delete.png" alt="delete" /></a>';
                                             HtmlStr +='</td>';
                                   HtmlStr +='</tr>';
                                }
							} 
                            HtmlStr +=' </tbody>';
                            HtmlStr +='</table>';
							$('#myContent').empty();
	           				$('#myContent').append(HtmlStr);
           					}		
           		});
}

function addDiagnosis(){
	var errorStr="";
	if($("#Diagnosis").val()==""){
		$("#Diagnosis").notify("Please fill Diagnosis name");
		 errorStr="1";
		 return false;
	}
	
	if(errorStr==""){
		  $.ajax({
           	        type:"POST",
           			url: "/parameter/saveDiagnosis",
           			cache: false,
           			data:
           				{
           				Diagnosis:$("#Diagnosis").val()
						},
           			datatype: "JSON",
           			success: function(data){
                         var HtmlStr="";						           					
								$("#DiagnosisButton").notify("Adding Diagnosis Success", "info");
								loadDiagnosis();
           					}	
           		});
		
	}
}
function editDiagnosis(id){
	var errorStr="";
	
	if($("#DiagnosisName_"+id).val()==""){
		$("#DiagnosisName_"+id).notify("Please fill Diagnosis name");
		 errorStr="1";
		 return false;
	}
	
	if(errorStr==""){
		  $.ajax({
           	        type:"POST",
           			url: "/parameter/editDiagnosis",
           			cache: false,
           			data:
           				{
           			    DiagnosisID:id,
           				DiagnosisName:$("#DiagnosisName_"+id).val()
						},
           			datatype: "JSON",
           			success: function(data){
                         var HtmlStr="";						           					
								$("#DiagnosisName_"+id).notify("Update Diagnosis Success", "info");
								//loadDiagnosis();
           					}	
           		});
		
	}
}

function deleteDiagnosis(id){
		  $.ajax({
           	        type:"POST",
           			url: "/parameter/deleteDiagnosis",
           			cache: false,
           			data:
           				{
           				DiagnosisID:id
						},
           			datatype: "JSON",
           			success: function(data){
                         var HtmlStr="";						           					
								$.notify("Delete Diagnosis Success", "info");
								loadDiagnosis();
           					}	
           		});
		
	
}

//Bacteria Beginning
function loadBacteria(){
	 $.ajax({
           	        type:"POST",
           			url: "/parameter/loadBacteria",
           			cache: false,
           			data:
           				{},
           			datatype: "JSON",
           			success: function(data){
                         var HtmlStr="";						
           					HtmlStr +='<table cellspacing="0" cellpadding="0" border="1" class="" width=90%> ';
                            HtmlStr +='<thead>';
                            HtmlStr +='<tr>';
                            HtmlStr +='<th>No.</th>';
							HtmlStr +='<th>Bacteria</th>';
                            HtmlStr +='<th>Action</th>';
                            HtmlStr +='</tr>';
                            HtmlStr +='</thead>';
							HtmlStr +='<tbody>';
							var user = JSON.parse(data).result;
                            if(user!=null){
    							for(i=0;i<user.length;i++){
                                              HtmlStr +='<tr>';
                                              HtmlStr +='<td>'+(i+1)+'</td>';
											  HtmlStr +='<td><input type="text" class="medium" id="BacteriaName_'+user[i].Bacteria_No+'" value="'+user[i].Bacteria_Name+'"></td>';
										
                                             HtmlStr +='<td>';
                                             HtmlStr +='<a href="#" onclick="javascript: editBacteria('+user[i].Bacteria_No+');"><img src="/images/gfx/icon-edit.png" alt="edit" /></a>&nbsp;&nbsp;';
                                             HtmlStr +='<a href="#" onclick="javascript:if(confirm(&quot;Press confirm to delete this data?&quot;)){ deleteBacteria('+user[i].Bacteria_No+');}" ><img src="/images/gfx/icon-delete.png" alt="delete" /></a>';
                                             HtmlStr +='</td>';
                                   HtmlStr +='</tr>';
                                }
							} 
                            HtmlStr +=' </tbody>';
                            HtmlStr +='</table>';
							$('#myContent').empty();
	           				$('#myContent').append(HtmlStr);
           					}		
           		});
}

function addBacteria(){
	var errorStr="";
	if($("#Bacteria").val()==""){
		$("#Bacteria").notify("Please fill Bacteria name");
		 errorStr="1";
		 return false;
	}
	
	if(errorStr==""){
		  $.ajax({
           	        type:"POST",
           			url: "/parameter/saveBacteria",
           			cache: false,
           			data:
           				{
           				Bacteria:$("#Bacteria").val()
						},
           			datatype: "JSON",
           			success: function(data){
                         var HtmlStr="";						           					
								$("#BacteriaButton").notify("Adding Bacteria Success", "info");
								loadBacteria();
           					}	
           		});
		
	}
}
function editBacteria(id){
	var errorStr="";
	
	if($("#BacteriaName_"+id).val()==""){
		$("#BacteriaName_"+id).notify("Please fill Bacteria name");
		 errorStr="1";
		 return false;
	}
	
	if(errorStr==""){
		  $.ajax({
           	        type:"POST",
           			url: "/parameter/editBacteria",
           			cache: false,
           			data:
           				{
           			    BacteriaID:id,
           				BacteriaName:$("#BacteriaName_"+id).val()
						},
           			datatype: "JSON",
           			success: function(data){
                         var HtmlStr="";						           					
								$("#BacteriaName_"+id).notify("Update Bacteria Success", "info");
								//loadDiagnosis();
           					}	
           		});
		
	}
}

function deleteBacteria(id){
		  $.ajax({
           	        type:"POST",
           			url: "/parameter/deleteBacteria",
           			cache: false,
           			data:
           				{
           				BacteriaID:id
						},
           			datatype: "JSON",
           			success: function(data){
                         var HtmlStr="";						           					
								$.notify("Delete Bacteria Success", "info");
								loadBacteria();
           					}	
           		});
		
	
}
//Bacteria Ending

//VS Beginning
function loadVS(){
	 $.ajax({
           	        type:"POST",
           			url: "/parameter/loadVS",
           			cache: false,
           			data:
           				{},
           			datatype: "JSON",
           			success: function(data){
                         var HtmlStr="";						
           					HtmlStr +='<table cellspacing="0" cellpadding="0" border="1" class="" width=90%> ';
                            HtmlStr +='<thead>';
                            HtmlStr +='<tr>';
                            HtmlStr +='<th>No.</th>';
							HtmlStr +='<th>VS Name</th>';
							HtmlStr +='<th>員工編號</th>';
							HtmlStr +='<th>學會編號</th>';
                            HtmlStr +='<th>Action</th>';
                            HtmlStr +='</tr>';
                            HtmlStr +='</thead>';
							HtmlStr +='<tbody>';
							var user = JSON.parse(data).result;
                            if(user!=null){
    							for(i=0;i<user.length;i++){
                                              HtmlStr +='<tr>';
                                              HtmlStr +='<td>'+(i+1)+'</td>';
											  HtmlStr +='<td><input type="text" class="verysmall" id="VsName_'+user[i].vsID+'" value="'+user[i].vsName+'"></td>';
										      HtmlStr +='<td><input type="text" class="verysmall" id="hospitalID_'+user[i].vsID+'" value="'+user[i].hospitalID+'"></td>';
										      HtmlStr +='<td><input type="text" class="verysmall" id="associateID_'+user[i].vsID+'" value="'+user[i].associateID+'"></td>';
                                             HtmlStr +='<td>';
                                             HtmlStr +='<a href="#" onclick="javascript: editVS('+user[i].vsID+');"><img src="/images/gfx/icon-edit.png" alt="edit" /></a>&nbsp;&nbsp;';
                                             HtmlStr +='<a href="#" onclick="javascript:if(confirm(&quot;Press confirm to delete this data?&quot;)){ deleteVS('+user[i].vsID+');}" ><img src="/images/gfx/icon-delete.png" alt="delete" /></a>';
                                             HtmlStr +='</td>';
                                   HtmlStr +='</tr>';
                                }
							} 
                            HtmlStr +=' </tbody>';
                            HtmlStr +='</table>';
							$('#myContent').empty();
	           				$('#myContent').append(HtmlStr);
           					}		
           		});
}

function addVS(){
	var errorStr="";
	if($("#vs").val()=="" || $("#hospitalID").val()=="" ){
		$("#vs").notify("Please fill VS name and employee number");
		 errorStr="1";
		 return false;
	}
	
	if(errorStr==""){
		  $.ajax({
           	        type:"POST",
           			url: "/parameter/saveVS",
           			cache: false,
           			data:
           				{
           				vs:$("#vs").val(),
           				hospitalID:$("#hospitalID").val(),
           				associateID:$("#associateID").val()
						},
           			datatype: "JSON",
           			success: function(data){
                         var HtmlStr="";						           					
								$("#vsButton").notify("Adding VS Success", "info");
								loadVS();
           					}	
           		});
		
	}
}
function editVS(id){
	var errorStr="";
	
	if($("#VsName_"+id).val()==""){
		$("#VsName_"+id).notify("Please fill VS name");
		 errorStr="1";
		 return false;
	}
	
	if(errorStr==""){
		  $.ajax({
           	        type:"POST",
           			url: "/parameter/editVS",
           			cache: false,
           			data:
           				{
           			    vsID:id,
           				vsName:$("#VsName_"+id).val(),
           				hospitalID:$("#hospitalID_"+id).val(),
           				associateID:$("#associateID_"+id).val()
						},
           			datatype: "JSON",
           			success: function(data){
                         var HtmlStr="";						           					
								$("#VsName_"+id).notify("Update VS Success", "info");
								//loadDiagnosis();
           					}	
           		});
		
	}
}

function deleteVS(id){
		  $.ajax({
           	        type:"POST",
           			url: "/parameter/deleteVS",
           			cache: false,
           			data:
           				{
           				vsID:id
						},
           			datatype: "JSON",
           			success: function(data){
                         var HtmlStr="";						           					
								$.notify("Delete VS Success", "info");
								loadVS();
           					}	
           		});
		
	
}

function queryNonOpenHeart(){
	if($('#qYear').val()!="" && $('#qMonth').val()!=""){
		querynonopenheartlist();
		  $.ajax({
           	        type:"POST",
           			url: "/nonopenheart/querynonopenheart",
           			cache: false,
           			data:
           				{
           				qyear:$('#qYear').val(),
           				qmonth:$('#qMonth').val()
						},
           			datatype: "JSON",
           			success: function(data){
                         var HtmlStr="";			
                         	var user = JSON.parse(data).result;
                            if(user==''){			           					
									$('#item1').val('');
									$('#item2').val('');
									$('#item3').val('');
									$('#item4').val('');
									$('#item5').val('');
									$('#item6').val('');
									$('#item7').val('');
									$('#item8').val('');
									$('#item9').val('');
           					} else {
           						if(user[0].item1!=null)  {$('#item1').val(user[0].item1);} 	else { $('#item1').val('');}	
           						if(user[0].item2!=null)  {$('#item2').val(user[0].item2);} 	else { $('#item2').val('');}	
           						if(user[0].item3!=null)  {$('#item3').val(user[0].item3);} 	else { $('#item3').val('');}	
           						if(user[0].item4!=null)  {$('#item4').val(user[0].item4);} 	else { $('#item4').val('');}	
           						if(user[0].item5!=null)  {$('#item5').val(user[0].item5);} 	else { $('#item5').val('');}	
           						if(user[0].item6!=null)  {$('#item6').val(user[0].item6);} 	else { $('#item6').val('');}	
           						if(user[0].item7!=null)  {$('#item7').val(user[0].item7);} 	else { $('#item7').val('');}	
           						if(user[0].item8!=null)  {$('#item8').val(user[0].item8);} 	else { $('#item8').val('');}	
           						if(user[0].item9!=null)  {$('#item9').val(user[0].item9);} 	else { $('#item9').val('');}	
           					}
           					}
           		});
	} else {
		$("#queryButton").notify("Please select the Year and Month");
	}
}

function saveOpenHeart(){
	if($('#qYear').val()!="" && $('#qMonth').val()!=""){
		  $.ajax({
           	        type:"POST",
           			url: "/nonopenheart/savenonopenheart",
           			cache: false,
           			data:
           				{
           				qyear:$('#qYear').val(),
           				qmonth:$('#qMonth').val(),
           				item1:$('#item1').val(),
           				item2:$('#item2').val(),
           				item3:$('#item3').val(),
           				item4:$('#item4').val(),
           				item5:$('#item5').val(),
           				item6:$('#item6').val(),
           				item7:$('#item7').val(),
           				item8:$('#item8').val(),
           				item9:$('#item9').val(),
						},
           			datatype: "JSON",
           			success: function(data){
                         $("#saveButton").notify("Saved Successfully","info");
                         querynonopenheartlist();
           					}
           		});
	} else {
		$("#queryButton").notify("Please select the Year and Month");
	}
}

function querynonopenheartlist(){
	 $.ajax({
           	        type:"POST",
           			url: "/nonopenheart/querynonopenheartlist",
           			cache: false,
           			data:
           				{},
           			datatype: "JSON",
           			success: function(data){
                         var HtmlStr="";		
                         var HtmlStrYear="";				
           					HtmlStr +='<table cellspacing="0" cellpadding="0" border="1" class="" width=90%> ';
                            HtmlStr +='<thead>';
                            HtmlStr +='<tr>';
                            HtmlStr +=' <th nowrap>Non open-heart List</th>';
						    HtmlStr +='</tr>';
                            HtmlStr +='</thead>';
							HtmlStr +='<tbody>';
							var user = JSON.parse(data).result;
                            if(user!=null){
                            	var yearLen=0;
                            	var y="";
    							for(i=0;i<user.length;i++){
    								 if(user[i].qYear==$('#qYear').val()){
                                              HtmlStr +='<tr>';
                                             
                                             HtmlStr +='<td>';
                                             HtmlStr +='<a href="/nonopenheart/index/'+user[i].qYear+'/'+user[i].qMonth+'">'+user[i].qYear+'/'+user[i].qMonth+'</a>&nbsp;&nbsp;';
                                             HtmlStr +='</td>';
                                   HtmlStr +='</tr>';
                                  }
                                   if(user[i].qYear!=y){
                                   	yearLen++;
                                   	 if(user[i].qYear==$('#qYear').val()){
                                   	HtmlStrYear+=' <button type="button" class="orange medium" id="queryButtonYear" onclick="window.location=\'/nonopenheart/index/'+user[i].qYear+'/1\';"><span>'+user[i].qYear+'</span></button>';
                                   	} else {
                                   	HtmlStrYear+=' <button type="button" class="grey medium" id="queryButtonYear" onclick="window.location=\'/nonopenheart/index/'+user[i].qYear+'/1\';"><span>'+user[i].qYear+'</span></button>';
                                   	}
                                   	y=user[i].qYear;
                                   }
                                }
							} 
                            HtmlStr +=' </tbody>';
                            HtmlStr +='</table>';
							$('#NonopenheartDiv').empty();
	           				$('#NonopenheartDiv').append(HtmlStr);
	           				if(yearLen>1){
	           						$('#NonopenheartYearDiv').empty();
	           				$('#NonopenheartYearDiv').append(HtmlStrYear);
	           				}
           					}		
           		});
}

//VS Beginning
function loadNews(t){
	 $.ajax({
           	        type:"POST",
           			url: "/news/loadNews",
           			cache: false,
           			data:
           				{type:t},
           			datatype: "JSON",
           			success: function(data){
                         var HtmlStr="";						
           					HtmlStr +='<table id="example" cellspacing="0" cellpadding="0" border="1" class="" width=90%> ';
                            HtmlStr +='<thead>';
                            HtmlStr +='<tr>';
                            HtmlStr +='<th width="30%">Date</th>';
							HtmlStr +='<th>Subject</th>';
                            HtmlStr +='</tr>';
                            HtmlStr +='</thead>';
							HtmlStr +='<tbody>';
							var user = JSON.parse(data).result;
                            if(user!=null){
    							for(i=0;i<user.length;i++){
                                              HtmlStr +='<tr>';
                                              HtmlStr +='<td>'+user[i].publishdate+'</td>';
											  HtmlStr +='<td><a class="various" data-fancybox-type="iframe" href="/news/queryContent/'+user[i].nid+'">'+user[i].subject;
											  if(user[i].attachment!='')   {
                           						HtmlStr +='<img src="/images/blue-document.png" width="16" height="16" style="display:inline;margin:0;float:none;" />';
                                                 }
                           
											  HtmlStr +='</a></td>';
										
                                             
                                   HtmlStr +='</tr>';
                                }
							} 
                            HtmlStr +=' </tbody>';
                            HtmlStr +='</table>';
                             
							$('#myContent').empty();
	           				$('#myContent').append(HtmlStr);
	           		//	$('#example').DataTable();
           					}		
           		});
}

function loadAdminNews(){
	 $.ajax({
           	        type:"POST",
           			url: "/news/loadAdminNews",
           			cache: false,
           			data:
           			{type:'3'},
           			datatype: "JSON",
           			success: function(data){
                         var HtmlStr="";						
           					HtmlStr +='<table cellspacing="0" cellpadding="0" border="1" class="" width=90%> ';
                            HtmlStr +='<thead>';
                            HtmlStr +='<tr>';
                            HtmlStr +='<th>No.</th>';
                            HtmlStr +='<th>Date</th>';
							HtmlStr +='<th>Subjecct</th>';
							HtmlStr +='<th>On line</th>';
                            HtmlStr +='<th>Action</th>';
                            HtmlStr +='</tr>';
                            HtmlStr +='</thead>';
							HtmlStr +='<tbody>';
							var user = JSON.parse(data).result;
                            if(user!=null){
    							for(i=0;i<user.length;i++){
                                              HtmlStr +='<tr>';
                                              HtmlStr +='<td>'+(i+1)+'</td>';
                                              HtmlStr +='<td>'+user[i].publishdate+'</td>';
											  HtmlStr +='<td>'+user[i].subject+'</td>';
										      HtmlStr +='<td>'+user[i].isOnline+'</td>';
                                             HtmlStr +='<td>';
                                             HtmlStr +='<a href="#" onclick="javascript: editNews('+user[i].nid+');"><img src="/images/gfx/icon-edit.png" alt="edit" /></a>&nbsp;&nbsp;';
                                             HtmlStr +='<a href="#" onclick="javascript:if(confirm(&quot;Press confirm to delete this data?&quot;)){ deleteNews('+user[i].nid+');}" ><img src="/images/gfx/icon-delete.png" alt="delete" /></a>';
                                             HtmlStr +='</td>';
                                   HtmlStr +='</tr>';
                                }
							} 
                            HtmlStr +=' </tbody>';
                            HtmlStr +='</table>';
							$('#myContent').empty();
	           				$('#myContent').append(HtmlStr);
           					}		
           		});
}
function editNews(id){
	window.location='/news/editNews/'+id;
}
function addNews(){
	window.location='/news/addNews/';
}
function deleteNews(id){
		  $.ajax({
           	        type:"POST",
           			url: "/parameter/deleteNews",
           			cache: false,
           			data:
           				{
           				newsID:id
						},
           			datatype: "JSON",
           			success: function(data){
                         var HtmlStr="";						           					
								$.notify("Delete News Success", "info");
								loadAdminNews();
           					}	
           		});
		
	
}


//VS Ending