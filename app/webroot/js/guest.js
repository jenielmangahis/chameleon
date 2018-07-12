
var g_captcha = 0;
var is_click_login = 0;
var g_ajax_type = 0;





$(document).ready(function() {
// popup stuff

    var overlayObject = $("a[rel]").overlay({
      top: 40,
      expose: {
        color: '#232323',
        closeOnClick: true
      },
				
      effect:'apple', 

	  onLoad: function() {
		  // bind loing btn submit
		  $(document).keypress(function(e) {
			 if (e.keyCode == 13) {
				 if (is_click_login) {
					$('#login_btn').trigger('click');
				 } else {
					$('#join_btn').trigger('click');
				 }
			 }
		  });
	  },

      onClose:function() {
		  if (is_click_login)
			  is_click_login = 0;
		  $(document).unbind('keypress');

      }
    });

	$('#login').click(function() {
		is_click_login = 1;
	});

	$('#login_btn').click(function() {
		var username = $.trim($('#login_username').val());
		var password = $.trim($('#login_password').val());

		var remem=$('#UserIsRemember').val();
		
		
		if(document.getElementById('UserIsRemember').checked==true)
		var remember=1
		else
		var remember=0;
		
		//alert(remember);

		g_ajax_type = 3;

		if ('' == username || '' == password) 
			return;

		$('#waiting_span').show();
		$('#login_btn_span').hide();
		$.post(ab_baseurl + 'users/login_chk', {userme: username, password: password,remember: remember}, function(data) {
										
										
			data = parseInt(data);
			
			//alert(data);
			
				if(data==3)
				{
				$('#login_msg').html('<ul><li>Wrong Username or Password</li></ul>');
				$('#waiting_span').hide();
				$('#login_btn_span').show();
				}
				else if(data==2)
				{					
				$('#login_msg').html('Your account must be activated before you can login. To resend the activation email again <a href="'+ab_baseurl+'users/resend_activation/'+username+'" class="links">Click Here</a>');
				$('#waiting_span').hide();
				$('#login_btn_span').show();
				}
				else
				{
				$('#login_form').attr('action', ab_baseurl + 'users/login');
				$('#login_form').submit();
				}
		});
	});
	

$('#join_form').bind('keypress', function(e) {
        if(e.keyCode==13){			
		return false;             
        }
});


$('#msg_submit').submit(function() {

		
		$('#join_btn_spans').toggle();
		
		$('#join_waiting_spans').toggle();

		g_ajax_type = 4;		

		$.post($(this).attr('action'), $(this).serialize(), function (data) {			
			
				var errors;
			
				$('#join_btn_spans').toggle();
				
				$('#join_waiting_spans').toggle();
				
				
				if(data!=1)
				{
				html = '<ul>';
				errors = data.split('|');	
				$.each(errors, function(i, item) {
					html += '<li>' + item + '</li>';
				});
				html += '</ul>';

				$('#join_msgs').html(html); return false;
				}
				else {
					
				$('#join_btn_spans').toggle();
				
				$('#join_waiting_spans').toggle();

				location.href = ab_baseurl + 'messages/'; }

				
		});
		
		 return false;
		 
	});	


$('#pass_submit').submit(function() {

		
		$('#join_btn_spans').toggle();
		
		$('#join_waiting_spans').toggle();

		
		

		$.post($(this).attr('action'), $(this).serialize(), function (data) {			
			
				var errors;
			
				$('#join_btn_spans').toggle();
				
				$('#join_waiting_spans').toggle();
				
				//alert(data);
				
				if(data!=1)
				{
				html = '<ul>';
				errors = data.split('|');	
				$.each(errors, function(i, item) {
					html += '<li>' + item + '</li>';
				});
				html += '</ul>';

				$('#join_msgs').html(html);
				}
				else {
				location.href = ab_baseurl + 'public/jobsonoffer'; }

				
		});
		
		 return false;
		 
	});	


	$('#join_ref_form').submit(function () {
		$('#join_ref_btn_span').toggle();
		$('#join_ref_waiting_span').toggle();

		g_ajax_type = 4;
		
		
		
		

		$.post($(this).attr('action'), $(this).serialize(), function (data) {
			var html = '';
			var errors;
			
			
		
	
			if(data==2)
			location.href=ab_baseurl + 'public/premium_user';
			else if(data==3)
			location.href = ab_baseurl + 'public/jobsonoffer';
			else
			{
				$('#join_ref_btn_span').toggle();
				$('#join_ref_waiting_span').toggle();

				html = '<ul>';
				errors = data.split('|');	
				$.each(errors, function(i, item) {
					html += '<li>' + item + '</li>';
				});
				html += '</ul>';
				
				
				
				$('#join_ref_msg').html(html);
			}
		});		

		return false;
	});




	$('#join_form').submit(function () {
									 
		$('#join_btn_span').toggle();
		
		$('#join_waiting_span').toggle();
		
		$('#join_msg').val('');

		g_ajax_type = 4;
		

		$.post($(this).attr('action'), $(this).serialize(), function (data) {
			var html = '';
			
			var errors;
			
			//alert(data);
			
			if(data==2)
			location.href=ab_baseurl + 'public/premium_user';
			else if(data==3)
			location.href=ab_baseurl + 'public/jobsonoffer';
			else
			{
				$('#join_btn_span').toggle();
				
				$('#join_waiting_span').toggle();

				html = '<ul>';
				errors = data.split('|');	
				$.each(errors, function(i, item) {
					html += '<li>' + item + '</li>';
				});
				html += '</ul>';

				$('#join_msg').html(html);
			} 
		});		

		return false;
	});


/*	$('#saveBtn').click(function () {
		
		$('#waiting_span').show();
	});

*/




$('#job_form').submit(function () {
								
								
								
								
		$('#join_btn_spans').toggle();
		
		$('#join_waiting_spans').toggle();

		g_ajax_type = 4;
		

		$.post($(this).attr('action'), $(this).serialize(), function (data) {
																	  
			var html = '';
			
			var errors;
			
			if(data=='f') {
				location.href = ab_baseurl + 'jobs/feature_redirect';
			}
			else if(data==1)
			location.href = ab_baseurl + 'public/jobsonoffer';
			else
			{
				$('#join_btn_spans').toggle();
				
				$('#join_waiting_spans').toggle();

				html = '<ul>';
				errors = data.split('|');	
				$.each(errors, function(i, item) {
					html += '<li>' + item + '</li>';
				});
				html += '</ul>';

				$('#join_msgs').html(html);
				
				$( 'html, body' ).animate( { scrollTop: 0 }, 'slow' );

			}

		});		

		return false;
	});


$('#edit_job').submit(function () {
								
		$('#join_btn_spans').toggle();
		
		$('#join_waiting_spans').toggle();

		g_ajax_type = 4;
		

		$.post($(this).attr('action'), $(this).serialize(), function (data) {
																	  
			var html = '';
			
		
			
			var errors;
			
			if(data=='f') {
				location.href = ab_baseurl + 'jobs/feature_redirect';
			}
			else if(data==1)
			location.href = ab_baseurl + 'public/jobsonoffer';
			else
			{
				$('#join_btn_spans').toggle();
				
				$('#join_waiting_spans').toggle();

				html = '<ul>';
				errors = data.split('|');	
				$.each(errors, function(i, item) {
					html += '<li>' + item + '</li>';
				});
				html += '</ul>';

				$('#join_msgs').html(html);
				
				$( 'html, body' ).animate( { scrollTop: 0 }, 'slow' );
			}

		});		

		return false;
	});





$('#clear_img1').change(function() {
								 
	var image=$('#image1').val();
	
	
	var x=confirm('Are you sure confirm to remove this image?');
	
		if(x==true)
		{
			
			$('#image1').val('');
			
			$.post(ab_baseurl + 'jobs/delete_img', {image: image}, function(data){
																			
				document.getElementById('img2Queue').style.display='none'; 																			
				
				document.getElementById('img2_display').innerHTML='';
				
				document.getElementById('clear_img1').checked=false;
																				  
		   });
		}
		else
		document.getElementById('clear_img1').checked=false;
								 
});


$('#clear_img2').change(function() {
								 
	var image=$('#image2').val();
	
	
	var x=confirm('Are you sure confirm to remove this image?');
	
		if(x==true)
		{
			$('#image2').val('');
			
			$.post(ab_baseurl + 'jobs/delete_img', {image: image}, function(data){
				
				document.getElementById('img3Queue').style.display='none'; 						
				
				document.getElementById('clear_img2').checked=false;
				
				document.getElementById('img3_display').innerHTML='';
																				  
		   });
		}
		else
		document.getElementById('clear_img2').checked=false;
								 
});

$('#jobreq_form').submit(function () {
								
								
		$('#join_btn_spans').toggle();
		
		$('#join_waiting_spans').toggle();

		g_ajax_type = 4;
		

		$.post($(this).attr('action'), $(this).serialize(), function (data) {
																	  
			var html = '';
			
			var errors;
			
			
			
			if(data==1)
			location.href = ab_baseurl + 'public/jobrequests';
			else
			{
				$('#join_btn_spans').toggle();
				
				$('#join_waiting_spans').toggle();

				html = '<ul>';
				errors = data.split('|');	
				$.each(errors, function(i, item) {
					html += '<li>' + item + '</li>';
				});
				html += '</ul>';

				$('#join_msgs').html(html);
				
				$( 'html, body' ).animate( { scrollTop: 0 }, 'slow' );

			}

		});		

		return false;
	});



$('#editjobreq_form').submit(function () {
								
								
		$('#join_btn_spans').toggle();
		
		$('#join_waiting_spans').toggle();

		g_ajax_type = 4;
		

		$.post($(this).attr('action'), $(this).serialize(), function (data) {
																	  
			var html = '';
			
			var errors;
			
		
			
			
			if(data==1)
			location.href = ab_baseurl + 'suggestedjobs/';
			else
			{
				$('#join_btn_spans').toggle();
				
				$('#join_waiting_spans').toggle();

				html = '<ul>';
				errors = data.split('|');	
				$.each(errors, function(i, item) {
					html += '<li>' + item + '</li>';
				});
				html += '</ul>';

				$('#join_msgs').html(html);
				
				$( 'html, body' ).animate( { scrollTop: 0 }, 'slow' );

			}

		});		

		return false;
	});



$('#JobCategory').change(function() {
//function select_sub_cat() {									
			
		var cat_id=$(this).val();
//alert(cat_id);


		var sub_cat=document.getElementById('sub_cat_id').value;
		
		$('#waiting_sp').show();

		
		$.post(ab_baseurl + 'jobs/subcategories', {cat_id: cat_id,subcat:sub_cat}, function(data) {
																		   
			
			var ret_data=data;
			
			
			
			var exp_data=ret_data.split('<!DOCTYPE');
			
			//alert(exp_data[0]);
			
			$('#subcat_msg').fadeOut('slow');
			
			$('#waiting_sp').hide();
			
			$('#subcat_msg').fadeIn('slow');
			
			$('#subcat_msg').html(exp_data[0]);

				
			});

							 
});

$('#edit_profile').submit(function () {
								
								
							
								
		$('#join_btn_spans').toggle();
		
		$('#join_waiting_spans').toggle();

		g_ajax_type = 4;
		

		$.post($(this).attr('action'), $(this).serialize(), function (data) {
																	  
			var html = '';
			
			var errors;
			
		
			
			if(data==1)
			location.href = ab_baseurl + 'public/jobsonoffer';
			else if(data==2)
			location.href=ab_baseurl + 'public/premium_user';
			else
			{
				$('#join_btn_spans').toggle();
				
				$('#join_waiting_spans').toggle();

				html = '<ul>';
				errors = data.split('|');	
				$.each(errors, function(i, item) {
					html += '<li>' + item + '</li>';
				});
				html += '</ul>';

				$('#join_msgs').html(html);
				
				$( 'html, body' ).animate( { scrollTop: 0 }, 'slow' );
			}

		});		

		return false;
	});							 


	$('#username').keyup(function() {
		var username = $(this).val();

		g_ajax_type = 1;
		
		if (username.length > 3) {
			$('#username_msg').ajaxStart(function() {
				if (g_ajax_type == 1)
					$(this).text('checking...');
			});
			$.post(ab_baseurl + 'users/username_chk', {username: username}, function(data) {
				if (data==0)
					$('#username_msg').html('<font color="green">Available</font>');
				else
					$('#username_msg').html('Unavailable');
			});
		} else {
			$('#username_msg').text('Username should have at least 4 characters');
		}
	});

	$('#email').keyup(function() {
							   
		var email = $(this).val();

		g_ajax_type = 2;
		
		if (email.length > 3) {
			$('#email_msg').ajaxStart(function() {
				if (g_ajax_type == 2)
					$(this).text('checking...');
			});
			$.post(ab_baseurl + 'users/email_chk', {email: email}, function(data) {
				data = $.trim(data);
				if (parseInt(data) != -1)
					$('#email_msg').html(data);
				else
					$('#email_msg').html('<font color="green">Available</font>');
			});
		} else {
			$('#email_msg').text('email should have at least 4 characters');
		}
	});
	
	
	
		$('#ref_email').keyup(function() {
							   
		var email = $(this).val();
		

		g_ajax_type = 2;
		
		if (email.length > 3) {
			$('#email_msg').ajaxStart(function() {
				if (g_ajax_type == 2)
					$(this).text('checking...');
			});
			$.post(ab_baseurl + 'users/email_chk', {email: email}, function(data) {
				data = $.trim(data);
				if (parseInt(data) != -1)
					$('#email_ref_msg').html(data);
				else
				$('#email_ref_msg').html('<font color="green">Available</font>');
			});
		} else {
			$('#email_ref_msg').text('email should have at least 4 characters');
		}
	});

	$('#ref_username').keyup(function() {
		var username = $(this).val();

		g_ajax_type = 1;
		
		if (username.length > 3) {
			$('#username_ref_msg').ajaxStart(function() {
				if (g_ajax_type == 1)
					$(this).text('checking...');
			});
			$.post(ab_baseurl + 'users/username_chk', {username: username}, function(data) {
				if (data==0)
					$('#username_ref_msg').html('<font color="green">Available</font>');
				else
					$('#username_ref_msg').html('Unavailable');
			});
		} else {
			$('#username_ref_msg').text('Username should have at least 4 characters');
		}
	});



	$('#sign_in').click(function() {
		$('body').trigger('click');	
		$('#login').trigger('click');
	});

	$('#register-show').click(function() {
		$('body').trigger('click');
		$('#join').trigger('click');
		return false;
	});

	$('#forgot_btn').click(function() {
		var email = $.trim($('#forgot_email').val());
		
		

		$('#forgot_btn_span').toggle();
		$('#forgot_waiting_span').toggle();

		$.get(ab_baseurl + 'users/forgot_password', {email: email}, function(data) {
			var msg = "";
			
				
			
			
			data = parseInt(data);
			
		
			
/*			if (1 == data) {
				location.href = ab_baseurl + 'users/sent_fp_email';
			} else if (-1 == data) {
				msg = "<ul><li>The email address is not correct.</li></ul>";
			} else {
				msg = "<ul><li>The email address is required</li></ul>";
			}	
*/

			if(data==1)
			location.href = ab_baseurl + 'users/sent_fp_email';
			else
			msg = "<ul><li>The email address is not correct.</li></ul>";

			$('#forgot_btn_span').toggle();
			$('#forgot_waiting_span').toggle();

			$('#login_msg').html(msg);
		});
	});

	$('#offer_title').keyup(function() {
		var r = count_words($(this).val(), 200);
		$('#title_count').text(r);
	});

	$('#offer_desc').keyup(function() {
		var r = count_words($(this).val(), 200);
		$('#desc_count').text(r);
	});
});

var count_words = function(v, max) {
	var l = v.length;
	return l > max ? max : l;
}

var login_div_toggle = function() {
	$('#login_div').toggle();
	$('#forgot_div').toggle();

	$('#fp').toggle();
	$('#btl').toggle();
};



function copy_link()
{
	var link = $.trim($('#aft_link').val());
	
	try {
		window.clipboardData.setData("Text", link);
	} catch(e) {
		alert("Copy error, please manually copy!");
	}
}

function send_aft_email()
{
	var email = $.trim($('#email').val());
	
	if (email) {
		$.post(ab_baseurl + 'users/aft_email/', {email: email}, function(data) {

		});
	}
}

function share_toggle(jid)
{
	$('#share' + jid).toggle();
}

function login_chk_job_add(obj) 
{
	$.get(ab_baseurl + 'users/is_login', {}, function(data) {
		data = parseInt(data);
		if (data)
			obj.submit();
		else
			$('#login').trigger('click');
	});
	return false;
}

function toggle_div(id)
{
	$.each(id, function(i, item) {
		$('#' + item).toggle();
	});
}
