
var signup_email_validated=false;
var signup_username_validated=false;
var signup_password_validated=false;
var signup_conf_password_validated=false;


//jQuery time

$(document).ready(function(){
	
	$('#dob').datepicker({
		dateFormat: 'dd/mm/yy',
		changeMonth: true,
      	changeYear: true,
      	yearRange: ((new Date).getFullYear()-100)+':'+(new Date).getFullYear()
	});
	
	
	$( document ).tooltip({
		position: {
        my: "left top",
        at: "right+5 top-5"
     },
     tooltipClass: "validateinfo-tooltip",
     items: "[data-geo], [title]",
     content: function() {
     	 var element = $( this );
        if ( element.is( "[data-geo]" ) ) {
        return element.attr( "title" );
      }
     }
	});
	
	var current_fs, next_fs, previous_fs; //fieldsets
	var left, opacity, scale; //fieldset properties which we will animate
	var animating; //flag to prevent quick multi-click glitches
	
	$(".next").click(function(){
		
		if($('#first_signup_fieldset').is(':visible')){
			if(signup_email_validated && signup_username_validated && signup_password_validated && signup_conf_password_validated){
				
			}else{
				if(!signup_email_validated){
					$('#sign_up_email').css('border','1px solid #f00');
				}
				if(!signup_username_validated){
					$('#signup_username').css('border','1px solid #f00');
				}
				if(!signup_password_validated){
					$('#signup_pass').css('border','1px solid #f00');
				}
				if(!signup_conf_password_validated){
					$('#signup_conf_pass').css('border','1px solid #f00');
				}
				
				return false;
				
			}
		}
		
		if(animating) return false;
		animating = true;
		
		current_fs = $(this).parent();
		next_fs = $(this).parent().next();
		
		//activate next step on progressbar using the index of next_fs
		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
		
		//show the next fieldset
		next_fs.show(); 
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale current_fs down to 80%
				scale = 1 - (1 - now) * 0.2;
				//2. bring next_fs from the right(50%)
				left = (now * 50)+"%";
				//3. increase opacity of next_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({'transform': 'scale('+scale+')'});
				next_fs.css({'left': left, 'opacity': opacity});
			}, 
			duration: 800, 
			complete: function(){
				current_fs.hide();
				animating = false;
			}, 
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
	});
	
	$(".previous").click(function(){
		if(animating) return false;
		animating = true;
		
		current_fs = $(this).parent();
		previous_fs = $(this).parent().prev();
		
		//de-activate current step on progressbar
		$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
		
		//show the previous fieldset
		previous_fs.show(); 
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale previous_fs from 80% to 100%
				scale = 0.8 + (1 - now) * 0.2;
				//2. take current_fs to the right(50%) - from 0%
				left = ((1-now) * 50)+"%";
				//3. increase opacity of previous_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({'left': left});
				previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
			}, 
			duration: 800, 
			complete: function(){
				current_fs.hide();
				animating = false;
			}, 
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
	});


	
	$(".submit").click(function(){
		return false;
	});
	

	$("#signup_window").colorbox({
		inline:true, 
		href:"#register_div", 
		width:"100%", 
		height:"100%",
		trapFocus: false,
		onOpen: function(){
			$('body').css('overflow','hidden');
		},
		onComplete: function(){
			
			$('#sign_up_email').bind('input propertychange', function() {

				if(isValidEmailAddress($('#sign_up_email').val())){
					
					$('#signup_email_spinner').show();

					var email_entered=$('#sign_up_email').val();	
			        $.ajax({
						type: 'POST',
						url: "Login/chekEmail",
						data: {'email':email_entered},
						dataType: 'html',
						success: function (result){
							$('#signup_email_spinner').hide();
							if(result==1){
								unset_signup_email_validated();
								$('#signup_email_success').hide();
								$('#sign_up_email').css('border-color','red');
								$('#msg_signup_email').html('This email is already in use');
							}else{
								set_signup_email_validated();
								$('#signup_email_success').show();
								$('#signup_email_success').css('display','inline-block');
								$('#sign_up_email').css('border-color','#ccc');
								$('#msg_signup_email').html('');
								
							}    
					                        
						}
					});				

					
				}else{
					unset_signup_email_validated();
					$('#signup_email_success').hide();
					$('#sign_up_email').css('border-color','red');
					$('#msg_signup_email').html('Please enter a valid email address');
				}
				
			});
			
			$('#signup_username').keypress(function(e) {
				
				var theEvent = e || window.event;
				var key = theEvent.keyCode || theEvent.which;
				var keychar = String.fromCharCode(key);
				var keycheck = /[a-zA-Z0-9]/;
				// backspace || delete || escape || arrows
				if (!(key == 8 || key == 9 || key == 27 || key == 46 || key == 37 || key == 39 )) {
					var pattern = new RegExp(/[a-z0-9_.-]$/i);
					var c = String.fromCharCode(e.which);
					if(!pattern.test(c)){
						e.preventDefault();
						theEvent.returnValue = false; //for IE
					}
				}
				
			});
			
			$('#signup_username').keyup(function(){
				var uname_entered=$('#signup_username').val();
				$('#signup_username').val(uname_entered.replace('%',''));
			});
			
			$('#signup_username').bind('input propertychange', function() {
				if(isValidUsername($('#signup_username').val())){
					
					$('#signup_username_spinner').show();

					var username_entered=$('#signup_username').val();	
			        $.ajax({
						type: 'POST',
						url: "Login/chekUsername",
						data: {'username':username_entered},
						dataType: 'html',
						success: function (result){
							$('#signup_username_spinner').hide();
							if(result==1){
								unset_signup_username_validated();
								$('#signup_username_success').hide();
								$('#signup_username').css('border-color','red');
								$('#msg_signup_username').html('This username is already in use');
							}else{
								set_signup_username_validated();
								$('#signup_username_success').show();
								$('#signup_username_success').css('display','inline-block');
								$('#signup_username').css('border-color','#ccc');
								$('#msg_signup_username').html('');
								
							}    
					                        
						}
					});				

					
				}else{
					unset_signup_username_validated();
					$('#signup_username_success').hide();
					$('#signup_username').css('border-color','red');
					$('#msg_signup_username').html('Please enter a valid username');
				}
				
			});
			
			$('#signup_pass').bind('input propertychange', function() {
				
				if(isValidPassword($('#signup_pass').val())){
					
					set_signup_password_validated();
					$('#signup_pass_success').show();
					$('#signup_pass_success').css('display','inline-block');
					$('#signup_pass').css('border-color','#ccc');
					$('#msg_signup_pass').html('');
					
				}else{
					
					unset_signup_password_validated();
					$('#signup_pass_success').hide();
					$('#signup_pass').css('border-color','red');
					$('#msg_signup_pass').html('Please enter a valid password');
				}
				
			});
			
			$('#signup_conf_pass').bind('input propertychange', function() {
				
				if(matchSignupPasswords()){
					
					set_signup_conf_password_validated();
					$('#signup_conf_pass_success').show();
					$('#signup_conf_pass_success').css('display','inline-block');
					$('#signup_conf_pass').css('border-color','#ccc');
					$('#msg_signup_conf_pass').html('');
					
				}else{
					
					unset_signup_conf_password_validated();
					$('#signup_conf_pass_success').hide();
					$('#signup_conf_pass').css('border-color','red');
					$('#msg_signup_conf_pass').html('The passwords you entered don\'t match.');
				}
				
			});
			
			$('#dob').keypress(function(e){
				e.preventDefault();
			});
			
			$('.chosen-select').chosen();
			//$('#genderr_chosen').css('width','auto');

		},
		onClosed: function(){
			$('body').css('overflow','auto');
		} 
		});
	
	$("#login_window").colorbox({
		inline:true, 
		href:"#login_div", 
		width:"100%", 
		height:"100%",
		onOpen: function(){
			$('body').css('overflow','hidden');
		},
		onClosed: function(){
			$('body').css('overflow','auto');
		} 
		});
	
	
	$('#submit_login').click(function(){
		
		$('#login_spinner').show();
		
		var credentials=$('#login_form').serialize();

        $.ajax({
			type: 'POST',
			url: "Login/validate",
			data: credentials,
			dataType: 'html',
			success: function (response){
				 var result = jQuery.parseJSON(response);
			    $('#login_spinner').hide();
			    if(result!=0){
			    	var login_sucess = '<div class="activity-item"> <i class="fa fa-check text-success"></i> <div class="activity"> Welcome back '+result.fname+' <span>Log-in Successful</span> </div> </div>';
			    	generate('success', login_sucess);
			    	setTimeout(function() {
		                $.colorbox.close();
		            }, 6000);
			    	
			    }else{
			    	var login_failure = '<div class="activity-item"> <i class="fa fa-tasks text-warning"></i><div class="activity"> Login Failed <span>Please check the given username/email and password combination</span> </div> </div>';
			    	generate('error', login_failure);
			    }

		                        
			}
		});		
		
	});

	$('#submit_signup').click(function(){
		
		validate_signup();
		
		return false;
		
		
		
		// var details=$('#register_form').serialize();
// 
        // $.ajax({
			// type: 'POST',
			// url: "Login/signup",
			// data: details,
			// dataType: 'html',
			// success: function (result){
// 			    
			    // if(result!=0){
			    	// var login_sucess = '<div class="activity-item"> <i class="fa fa-check text-success"></i> <div class="activity"> Congratulations! You have been successfully registered. <span>Please log-in to proceed</span> </div> </div>'
			    	// generate('success', login_sucess);
			    	// setTimeout(function() {
		                // $.colorbox.close();
		            // }, 6000);
// 		            
			    	// setTimeout(function() {
		                // $.colorbox({
							// inline:true, 
							// href:"#login_div", 
							// width:"100%", 
							// height:"100%",
							// onOpen: function(){
								// $('body').css('overflow','hidden');
							// },
							// onClosed: function(){
								// $('body').css('overflow','auto');
							// } 
						  // });
		            // }, 7000);
// 		            
			    // }else{
			    	// var login_failure = '<div class="activity-item"> <i class="fa fa-tasks text-warning"></i><div class="activity"> Something went wrong with your registration <span>Please try again</span> </div> </div>'
			    	// generate('error', login_failure);
			    // }
// 		                        
			// }
		// });		
		
	});
	
	
	$('#gender').change(function(){
		var selected_gender=$('#gender').val();
		if(selected_gender!=''){
			$('#gender').css('color','#2c3e50');
		}else{
			$('#gender').css('color','#cccccc');
		}
	});



	

});

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};

function isValidUsername(username){
	var pattern = new RegExp(/^[a-z][a-z0-9_.-]{5,14}$/i);
	return pattern.test(username);
}

function isValidPassword(password){
	var pattern = new RegExp(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z._-]{8,}$/);
	return pattern.test(password);
}

function matchSignupPasswords(){
	
	var first_pass=$.trim($('#signup_pass').val());
	var second_pass=$.trim($('#signup_conf_pass').val());
	
	if(first_pass===second_pass)
		return 1;
	else
		return 0;
	
}

function validate_signup () {
  
}


        function generate(type, text) {

            var n = noty({
                text        : text,
                type        : type,
                dismissQueue: true,
                layout      : 'bottom',
                closeWith   : ['click', 'button', 'backdrop'],
                theme       : 'relax',
                maxVisible  : 1,
                animation   : {
                    open  : 'animated flipInX',
                    close : 'animated flipOutX',
                    easing: 'swing',
                    speed : 500
                }
            });
            
            setTimeout(function() {
                n.close();
            }, 5000);
        }

        function generateAll() {
            generate('warning', notification_html[0]);
            generate('error', notification_html[1]);
            generate('information', notification_html[2]);
            generate('success', notification_html[3]);
//            generate('notification');
//            generate('success');
        }
        
        function set_signup_email_validated(){
        	signup_email_validated=true;
        }

        function unset_signup_email_validated(){
        	signup_email_validated=false;
        }
        
        function set_signup_username_validated(){
        	signup_username_validated=true;
        }

        function unset_signup_username_validated(){
        	signup_username_validated=false;
        }
        
        function set_signup_password_validated(){
        	signup_password_validated=true;
        }
        
        function unset_signup_password_validated(){
        	signup_password_validated=false;
        }
        
        function set_signup_conf_password_validated(){
        	signup_conf_password_validated=true;
        }
        
        function unset_signup_conf_password_validated(){
        	signup_conf_password_validated=false;
        }
        
        function validate_signup(){
        }

        $(document).ready(function () {

            setTimeout(function() {
                //generateAll();
            }, 500);

        });
        

