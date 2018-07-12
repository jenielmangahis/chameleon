$('#ThemeBackcolor, #ThemeBodycolor, #ThemeBodybgcolor, #ThemeBordercolor, #ThemeMenubgcolor, #ThemeHeadercolor, #ThemeHeaderseperator, #ThemeFooterseprator, #ThemeMenucolor, #ThemeMenuactive, #ThemeMenuspecial, #ThemeBodytextcolor, #ThemeCopyrighttextcolor, #ThemeHeadercolor1, #ThemeHeadercolor2, #ThemeHeadercolor3, #ThemeLinkcolor, #bgaroundcoins, #systemtextcolor, #labeltextcolor, #systemlinkcolor, #dashboardlabelcolor, #dashboardtextcolor, #dashboardlinkcolor, #dashboardmenutextcolor, #dashboardmenubgcolor, #dashboardmenuhovercolor, #dashboardselectmenucolor, #progressbarcolor, #saveapplybg, #saveapplyhover, #dashboardmenuseparatorcolor, #saveapplyseparator, #saveapplytextcolor, #dropdowntextcolor, #ThemeBorderColor, #ThemeDropdowntextcolor, #bgregisterbtn, #bgcommentbtn, #ThemeMenuhover, #ThemeFormscolor').parent().append(function(i,h){
			return '<span  style="margin:0px 0px 0px 4px; padding:3px 10px 1px 10px; background: #'+$($(this).get(0)).find('input').val()+'; border: solid 1px #000"></span>';
			});
			
	
	 if(!$("#ThemePagewidth960").attr('checked') && !$("#ThemePagewidth1080").attr('checked') && !$("#ThemePagewidth1200").attr('checked'))
   		$("#ThemePagewidth1080").attr('checked',true);
	  
	 if(!$("#ThemeIspageborder0").attr('checked') && !$("#ThemeIspageborder1").attr('checked'))
		$('#ThemeIspageborder0').attr('checked',true);
		
	 if($("#ThemeBordercolor").val()=="")
		$('#ThemeBordercolor').val('000000');
	
	if($("#ThemeBorderwidth").val()=="")
			$('#ThemeBorderwidth').val('3');
	
	if($("#ThemeMenubgcolor").val()=="")
			$('#ThemeMenubgcolor').val('000000');
			
	if($("#ThemeMenuheight").val()=="")
			$('#ThemeMenuheight').val('34');
	
	if($("#ThemeDropdowntextcolor").val()=="")
			$('#ThemeDropdowntextcolor').val('ebebeb');
			
	//if($("#ThemeNoHeaderImg").attr('checked'))
		//	$('#ThemeNoHeaderImg').attr('checked',true);
			
	if($("#ThemeHeadercolor").val()=="")
			$('#ThemeHeadercolor').val('000000');
	
	if($("#ThemeHeaderseperator").val()=="")
			$('#ThemeHeaderseperator').val('ffffff');
			
	if($("#ThemeFooterseprator").val()=="")
			$('#ThemeFooterseprator').val('ffffff');
			
	if($("#ThemeBordercolor").val()=="")
			$('#pagefont').val('Arial');
			
	if($("#ThemeBodytextcolor").val()=="")
			$('#ThemeBodytextcolor').val('000000');
			
	if($("#ThemeLinkcolor").val()=="")
			$('#ThemeLinkcolor').val('ff6600');
			
	if($("#ThemeHeadercolor1").val()=="")
			$('#ThemeHeadercolor1').val('000000');
			
	if($("#ThemeHeadercolor2").val()=="")
			$('#ThemeHeadercolor2').val('000000');
			
	if($("#ThemeHeadercolor3").val()=="")
			$('#ThemeHeadercolor3').val('000000');
			
	if($("#menufont").val()=="")
			$('#menufont').val('Arial');
			
	if($("#ThemeMenucolor").val()=="")
			$('#ThemeMenucolor').val('000000');
			
	if($("#ThemeMenuhover").val()=="")
			$('#ThemeMenuhover').val('ebebeb');
			
	if($("#ThemeMenuactive").val()=="")
			$('#ThemeMenuactive').val('ebebeb');
			
	if($("#ThemeMenuspecial").val()=="")
			$('#ThemeMenuspecial').val('ff6600');
			
	if($("#ThemeBodybgcolor").val()=="")
			$('#ThemeBodybgcolor').val('88B2DC');
			
	if($("#ThemeBodycolor").val()=="")
			$('#ThemeBodycolor').val('FFFFFF');
			
	if($("#ThemeFormscolor").val()=="")
			$('#ThemeFormscolor').val('FFFFFF');
			
   if($("#saveapplytextcolor").val()=="")
      $("#saveapplytextcolor").val("ffffff");
      
   if($("#saveapplyseparator").val()=="")
      $("#saveapplyseparator").val("ffffff");
      
   if($("#saveapplyhover").val()=="")
      $("#saveapplyhover").val("757575");
      
    if($("#saveapplybg").val()=="")
      $("#saveapplybg").val("209f20");
      
    if($("#progressbarcolor").val()=="")
      $("#progressbarcolor").val("509cd9");
      
    if($("#dashboardselectmenucolor").val()=="")
      $("#dashboardselectmenucolor").val("757575");
      
    if($("#dashboardmenuhovercolor").val()=="")
      $("#dashboardmenuhovercolor").val("757575");
    
    if($("#dashboardmenuseparatorcolor").val()=="")
      $("#dashboardmenuseparatorcolor").val("ffffff");
    
    if($("#dashboardmenubgcolor").val()=="")
      $("#dashboardmenubgcolor").val("509cd9");
    
    if($("#dashboardmenutextcolor").val()=="")
      $("#dashboardmenutextcolor").val("ffffff");
      
    if($("#dashboardlinkcolor").val()=="")
      $("#dashboardlinkcolor").val("2cdb23");
      
    if($("#dashboardtextcolor").val()=="")
      $("#dashboardtextcolor").val("fb7503");
      
    if($("#dashboardlabelcolor").val()=="")
      $("#dashboardlabelcolor").val("4f4f4f");
      
    if($("#systemlinkcolor").val()=="")
      $("#systemlinkcolor").val("ffb400");
      
    if($("#labeltextcolor").val()=="")
      $("#labeltextcolor").val("4f4f4f");
      
    if($("#systemtextcolor").val()=="")
      $("#systemtextcolor").val("000000");
      
    if($("#ThemeCopyrighttextcolor").val()=="")
      $("#ThemeCopyrighttextcolor").val("ebebeb");
      
    if($("#dropdowntextcolor").val()=="")
      $("#dropdowntextcolor").val("000000");
      
    if($("#bgaroundcoins").val()=="")
      $("#bgaroundcoins").val("ffffff");
	  
  	if($("#bgregisterbtn").val()=="")
      $("#bgregisterbtn").val("ffffff");
	  
 	if($("#bgcommentbtn").val()=="")
      $("#bgcommentbtn").val("ffffff");
    
 	if($("#ThemeDropdowntextcolor").val()=="")
      $("#ThemeDropdowntextcolor").val("ebebeb");
	  
	
	$('#AdminsReset').live('click', function(){
		if($(this).is(':checked')){
			$('#ThemePagewidth').attr('checked',true);
			$('#ThemeIspageborder').attr('checked',true);
			
			$('#ThemeBordercolor').val('000000');
			$('#ThemeBordercolor').next().css('background','#'+$('#ThemeBordercolor').val()+'');

			$('#ThemeBorderwidth').val('3');

			$('#ThemeMenubgcolor').val('000000');
			$('#ThemeMenubgcolor').next().css('background','#'+$('#ThemeMenubgcolor').val());

			$('#ThemeMenuheight').val('34');

			$('#ThemeDropdowntextcolor').val('ebebeb');
			$('#ThemeDropdowntextcolor').next().css('background','#'+$('#ThemeDropdowntextcolor').val());
			
			$('#ThemeNoHeaderImg').attr('checked',true);
			
			$('#ThemeHeadercolor').val('000000');
			$('#ThemeHeadercolor').next().css('background','#'+$('#ThemeHeadercolor').val());
			
			$('#ThemeHeaderseperator').val('ffffff');
			$('#ThemeHeaderseperator').next().css('background','#'+$('#ThemeHeaderseperator').val());
			
			$('#ThemeFooterseprator').val('ffffff');
			$('#ThemeFooterseprator').next().css('background', '#'+$('#ThemeFooterseprator').val());
			
			$('#pagefont').val('Arial');
			
			$('#ThemeBodytextcolor').val('000000');
			$('#ThemeBodytextcolor').next().css('background', '#'+$('#ThemeBodytextcolor').val());
			
			$('#ThemeLinkcolor').val('ff6600');
			$('#ThemeLinkcolor').next().css('background', '#'+$('#ThemeLinkcolor').val());
			
			$('#ThemeHeadercolor1').val('000000');
			$('#ThemeHeadercolor1').next().css('background', '#'+$('#ThemeHeadercolor1').val());
			
			$('#ThemeHeadercolor2').val('000000');
			$('#ThemeHeadercolor2').next().css('background', '#'+$('#ThemeHeadercolor2').val());
			
			$('#ThemeHeadercolor3').val('000000');
			$('#ThemeHeadercolor3').next().css('background', '#'+$('#ThemeHeadercolor3').val());
			
			$('#menufont').val('Arial');
			
			$('#ThemeMenucolor').val('000000');
			$('#ThemeMenucolor').next().css('background', '#'+$('#ThemeMenucolor').val());
			
			$('#ThemeMenuhover').val('ebebeb');
			$('#ThemeMenuhover').next().css('background', '#'+$('#ThemeMenuhover').val());
			
			$('#ThemeMenuactive').val('ebebeb');
			$('#ThemeMenuactive').next().css('background', '#'+$('#ThemeMenuactive').val());
			
			$('#ThemeMenuspecial').val('ff6600');
			$('#ThemeMenuspecial').next().css('background', '#'+$('#ThemeMenuspecial').val());
			
			$('#ThemeBodybgcolor').val('88B2DC');
			$('#ThemeBodybgcolor').next().css('background', '#'+$('#ThemeBodybgcolor').val());
			
			$('#ThemeBodycolor').val('FFFFFF');
			$('#ThemeBodycolor').next().css('background', '#'+$('#ThemeBodycolor').val());
			
			$('#ThemeFormscolor').val('FFFFFF');
			$('#ThemeFormscolor').next().css('background', '#'+$('#ThemeFormscolor').val());
			
			$('#labeltextcolor').val('4f4f4f');
			$('#labeltextcolor').next().css('background', '#'+$('#labeltextcolor').val());
			
			$('#systemtextcolor').val('000000');
			$('#systemtextcolor').next().css('background', '#'+$('#systemtextcolor').val());
			
			$('#systemlinkcolor').val('FFB400');
			$('#systemlinkcolor').next().css('background', '#'+$('#systemlinkcolor').val());
			
			$('#dashboardlabelcolor').val('4F4F4F');
			$('#dashboardlabelcolor').next().css('background', '#'+$('#dashboardlabelcolor').val());
			
			$('#dashboardtextcolor').val('FB7503');
			$('#dashboardtextcolor').next().css('background', '#'+$('#dashboardtextcolor').val());
			
			$('#dashboardlinkcolor').val('2CDB23');
			$('#dashboardlinkcolor').next().css('background', '#'+$('#dashboardlinkcolor').val());
			
			$('#dashboardmenutextcolor').val('ffffff');
			$('#dashboardmenutextcolor').next().css('background', '#'+$('#dashboardmenutextcolor').val());
			
			$('#dashboardmenubgcolor').val('509cd9');
			$('#dashboardmenubgcolor').next().css('background', '#'+$('#dashboardmenubgcolor').val());
			
			$('#dashboardmenuhovercolor').val('757575');
			$('#dashboardmenuhovercolor').next().css('background', '#'+$('#dashboardmenuhovercolor').val());
			
			$('#dashboardselectmenucolor').val('757575');
			$('#dashboardselectmenucolor').next().css('background', '#'+$('#dashboardselectmenucolor').val());
			
			$('#dashboardmenuseparatorcolor').val('ffffff');
			$('#dashboardmenuseparatorcolor').next().css('background', '#'+$('#dashboardmenuseparatorcolor').val());
			
			$('#progressbarcolor').val('509cd9');
			$('#progressbarcolor').next().css('background', '#'+$('#progressbarcolor').val());
			
			$('#saveapplybg').val('209f20');
			$('#saveapplybg').next().css('background', '#'+$('#saveapplybg').val());
			
			$('#saveapplyhover').val('757575');
			$('#saveapplyhover').next().css('background', '#'+$('#saveapplyhover').val());
			
			$('#saveapplyseparator').val('ffffff');
			$('#saveapplyseparator').next().css('background', '#'+$('#saveapplyseparator').val());
			
			$('#saveapplytextcolor').val('ffffff');
			$('#saveapplytextcolor').next().css('background', '#'+$('#saveapplytextcolor').val());
			
			$('#bgaroundcoins').val('ffffff');
			$('#bgaroundcoins').next().css('background', '#'+$('#bgaroundcoins').val());
			
			$("#bgcommentbtn").val("ffffff");
			$('#bgcommentbtn').next().css('background', '#'+$('#bgcommentbtn').val());
			
	 		$("#bgregisterbtn").val("ffffff");
			$('#bgregisterbtn').next().css('background', '#'+$('#bgregisterbtn').val());
		}
	});
    
