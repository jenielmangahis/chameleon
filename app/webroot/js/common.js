/**
implement by:Puneet
controller:setups controller
view:help_list.ctp

**/
$(document).ready(function()
{
    $('#checkall').bind('change',function(){
    var check = $(this).attr('checked')?1:0;
    if(check ==1)
    {
       $('.checkid').each(function()
        {
          $(this).attr('checked',true);
         });
   }else{
		$('.checkid').each(function()
		{
			$(this).attr('checked',false);

		});
     }               
  });
  
  
   $('.checkid').bind('change',function() {   
		//event.stopPropagation();
		var i=0;
		var j=0;
		$('.checkid').each(function(){
				i++;
				var check = $(this).attr('checked')?1:0;
				if(check ==1)
				{                       
						j++;
				}
		});		
		if(i==j)
				$('#checkall').attr('checked',true);
		else
				$('#checkall').attr('checked',false);
	});

});
/**
implement by:Puneet
controller:setups controller
view:help_list.ctp

**/

/**
implement by:Puneet
controller:setups controller
view:help_list.ctp

**/
function editholderhelplist()
  {       
	
	var counter=0;
	var id="";
	$('.checkid').each(function(){          
			var check = $(this).attr('checked')?1:0;
			if(check ==1)
			{                       
							id=$(this).val();
							counter=counter +1;
			}
    });     
        
        if(counter!=1)
        {
                alert("please select only one row  to edit");
                return false;
                }else{  
                document.getElementById("linkedit").href=baseUrl+"/setups/edithelp/"+id; 
                
                }
        }
		
function validate(){
   
   if($('#system_version_name').val() == '')
     {
         inlineMsg('system_version_name','<strong>Please provide Version name</strong>',2);
         return false;
     }    
     return true;
}


/**
implement by:Puneet
controller:setups controller
view:system_version_list.ctp

**/
  

	/**
implement by:Puneet
controller:setups controller
view:system_version_list.ctp

**/
    $(document).ready(function()
    {   
        $('.checkid').bind('change',function()
        {   
            //event.stopPropagation();
            var i=0;
            var j=0;
            $('.checkid').each(function(){
                i++;
                var check = $(this).attr('checked')?1:0;
                if(check ==1)
                    {                       
                    j++;
                }


            });

            if(i==j)
                $('#checkall').attr('checked',true);
            else
                $('#checkall').attr('checked',false);
        });
    });

/**
implement by:Puneet
controller:setups controller
view:border_footer_list.ctp
**/
	function editholderborderfooterlist()
    {       
        var counter=0;
        var id="";
        $('.checkid').each(function(){          
            var check = $(this).attr('checked')?1:0;
            if(check ==1)
                {                       
                id=$(this).val();
                counter=counter +1;
            }
        });     

        if(counter!=1)
            {
            alert("please select only one row to edit");
            return false;
        }else{  
            document.getElementById("linkedit").href=baseUrl+"versions/system_version/edit/"+id; 

        }
    } 


/**
implement by:Puneet
controller:setups controller
view:system_version_list.ctp

**/

    function setEditRecord(pathStr) {
		
		// pathStr = controller+action name
		var counter=0;
        var id="";
        $('.checkid').each(function(){          
            var check = $(this).attr('checked')?1:0;
            if(check ==1)
                {                       
                id=$(this).val();
                counter=counter +1;
            }
        });     

        if(counter!=1) {
            alert("please select only one row to edit");
            return false;
        }else{  
            //window.href=baseUrl+"versions/system_version/edit/"+id; 
			window.location=baseUrl+pathStr+'/'+id;
        }
	}
/**
implement by:Puneet
common function


**/

    function activatecontents(act,op)
    {       
        var id="";
        $('.checkid').each(function(){          
            var check = $(this).attr('checked')?1:0;
            if(check ==1)
                {                       
                if(id=="")
                    id=$(this).val();
                else
                    id=id + "*" + $(this).val();
            }
        });
        if(id !=""){
            if(op=="change"){       
                if(act=="active"){
                    window.location=baseUrlAdmin+"changestatus/"+id+"/SystemVersion/1/system_version_list/cngstatus";
                }else{
                    window.location=baseUrlAdmin+"changestatus/"+id+"/SystemVersion/0/system_version_list/cngstatus";
                }
            }
            if(op=="del"){
                if(confirm("Are you sure to delete the item ?"))
                    window.location=baseUrlAdmin+"changestatus/"+id+"/SystemVersion/0/system_version_list/delete";
            }
        }else{
            alert('Please atleast one record should be select'); 
            return false;
        }
    }

	/**
implement by:Puneet
controller:mailtasks controller
view:supermailtemplatelist.ctp

**/


	 function editmailcontent()
        {       
                var counter=0;
                var id="";
                $('.checkid').each(function(){          
                        var check = $(this).attr('checked')?1:0;
                        if(check ==1)
                        {                       
                                        id=$(this).val();
                                        counter=counter +1;
                        }
                });     
                
                if(counter!=1)
                {
                        alert("please select only one row  to edit");
                        return false;
                        }else{  
                        document.getElementById("linkedit").href=baseUrl+"mailtasks/addmailtemplate/"+id; 
                        
                }
        } 

/**
implement by:Puneet
controller:admins controller
view:addcompany1.ctp

**/

function activatecompanycontents(act,op){
   var id="";
        $('.checkid').each(function(){          
                var check = $(this).attr('checked')?1:0;
                if(check ==1)
                {                       
                        if(id=="")
                                id=$(this).val();
                        else
                                id=id + "*" + $(this).val();
                }
   });
        if(id !=""){
                        if(op=="change"){       
                                if(act=="active"){
                                        window.location=baseUrl+"contacts/changestatus/"+id+"/CommentType/1/sa_companylist/cngstatus";
                                        }else{
                                        window.location=baseUrl+"contacts/changestatus/"+id+"/CommentType/0/sa_companylist/cngstatus";
                                        }
                        }
                        if(op=="del"){
			if(confirm("Are you sure to delete the item ?"))
                        window.location=baseUrl+"contacts/changestatus/"+id+"/Company/0/sa_companylist/delete";
                        }
        }else{
                alert('Please atleast one record should be select'); 
                return false;
        }
}

/**
implement by:Puneet
controller:setups controller
view:system_version_list.ctp

**/

    function versionactivatecontents(act,op)
    {       
      
		var id="";
        $('.checkid').each(function(){          
            var check = $(this).attr('checked')?1:0;
            if(check ==1)
                {                       
                if(id=="")
                    id=$(this).val();
                else
                    id=id + "*" + $(this).val();
            }
        });
        if(id !=""){
            if(op=="change"){       
                if(act=="active"){
                    window.location=baseUrl+"versions/changestatus/"+id+"/1";
                }else{
                    window.location=baseUrl+"versions/changestatus/"+id+"/2";
                }
            }
            if(op=="del"){
                if(confirm("Are you sure to delete the item ?"))
                    window.location=baseUrl+"versions/changestatus/"+id+"/SystemVersion/0/system_version_list/delete";
            }
        }else{
            alert('Please atleast one record should be select'); 
            return false;
        }
    }
