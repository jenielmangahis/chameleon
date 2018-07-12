/**
 * Javascript file to validate the coin serial number
 */
jQuery(document).ready(function() {
	/*jQuery('#coinserial').keypress(function() {
		alert('test');
	});*/

	jQuery('#coinserial').keyup(function() {
		var coinserial = jQuery(this).val();
		if (coinserial.length == 7 || coinserial.length == 10) {
			
			checkcoinserial(coinserial);
		}
		else {
			jQuery('#verify').hide();
			jQuery('#butdiv').hide();
			jQuery('#ajaxloader').hide();
		}
	});
});


function checkcoinserial(coinserial) {
		// The coin serial
		//var coinserial = jQuery(this).val();

		if ((coinserial == '')) {
			//console.log('Not A Number');
			inlineMsg('coinserial', '<strong> Invalid coin serial #.</strong>', 2);
			jQuery('#verify').hide();
			jQuery('#butdiv').hide();
			jQuery('#ajaxloader').hide();
			
		}
		else {
			jQuery('#ajaxloader').show();
			if (!(coinserial.length == 7 || coinserial.length == 10)) {
				//console.log('Not a valid coin serial');
				inlineMsg('coinserial', '<strong> Invalid coin serial #.</strong>', 2);

			jQuery('#verify').hide();
			jQuery('#butdiv').hide();
			jQuery('#ajaxloader').hide();
			}
			else {
				jQuery.ajax({
					type: "GET",
					url: "/companies/verify_coin/" + coinserial,
					async: false,
					success: function(response) {
						jQuery('#ajaxloader').hide();
						//console.log(response);
						if (response.indexOf('false') != -1) {
							inlineMsg('coinserial', '<strong> Coin serial not found.</strong>', 2);
							jQuery('#verify').hide();
							jQuery('#butdiv').hide();

						} else if (response.indexOf('null') != -1) {
							jQuery('#verify').hide();
							jQuery('#butdiv').show();

						} else {
							jQuery('#verify').show();
							jQuery('#butdiv').show();

						}
					}
				});
			}
		}

}