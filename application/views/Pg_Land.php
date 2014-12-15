<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Video-Shuffle</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

        <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>

    <link rel="stylesheet" href="colorbox/colorbox.css" />
    <script src="colorbox/jquery.colorbox.js"></script>
    
    <link href="scroll/src/perfect-scrollbar.css" rel="stylesheet">
    <script src="scroll/src/perfect-scrollbar.js"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

     <script>
    	var playlist=[]; 
        var details=[];
        var playing_det='';
        var next_det='';
        var v_count=0;
        var current_index=0;
        
    //Load player api asynchronously.
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    var done = false;
    var player;
    
    function onYouTubeIframeAPIReady() {

    }    

     function onPlayerReady(evt) {
         evt.target.playVideo();
     }
    function onPlayerStateChange(evt) {
        // if (evt.data == YT.PlayerState.PLAYING && !done) {
            // setTimeout(stopVideo, 6000);
            // done = true;
        // }
        if(evt.data === 0) {          
        	
            var now_playing_id=$('#playing_id').val();
            var playing_index = playlist.indexOf(now_playing_id);
            if(playing_index!=playlist.length-1){
            	v_id=playlist[playing_index+1];
            	player.loadVideoById(v_id, 0, "medium");
            	$('#playing_id').val(v_id);
            }else{
            	v_id=playlist[0];
            	player.loadVideoById(v_id, 0, "medium");
            	$('#playing_id').val(v_id);
            }
            }
    }
    function stopVideo() {
        player.stopVideo();
    }

    function pauseVideo(){
      player.pauseVideo();
    }
    
    function nextVideo(){
    	
        var now_playing_id=$('#playing_id').val();
        var playing_index = playlist.indexOf(now_playing_id);
        if(playing_index!=playlist.length-1){
        	v_id=playlist[playing_index+1];
            player.loadVideoById(v_id, 0, "medium");
            $('#playing_id').val(v_id);
        }else{
        	v_id=playlist[0];
            player.loadVideoById(v_id, 0, "medium");
            $('#playing_id').val(v_id);
        }    	
    }
    
    function playVideo(vid){
    	player = new YT.Player('player', {
          height: '390',
          width: '640',
          videoId: vid,
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
    	//player.playVideo();
    	//player.loadVideoById(vid, 0, "large");
    }
     
            $(document).ready(function(){
            	
            	//$('#player').hide();
            	
                

                $('#p_next').click(function(){
                    var playing_id=$('#playing_id').val();
                    var playing_index = playlist.indexOf(playing_id);
                    console.log(playing_index+1);
                    console.log(playlist.length-1);
			        if((playing_index)!=(playlist.length-1)){
			        	console.log("IF");
			        	v_id=playlist[playing_index+1];
			        }else{
			        	v_id=playlist[0];
			        	console.log("ELSE");
			        }
			        console.log(v_id);    	
                    $.ajax({
							type: 'POST',
							url: "video/video_details",
							data: {vid:v_id},
							dataType: 'html',
							success: function (result){
		                        var obj = jQuery.parseJSON(result);
		                        
		                        	playing_det='<div id="playing_now"><div class="playing_label">Now Playing</div><img src="'+obj.thumbnail_url+'" class="vid_thumb"><div class="now_title">'+obj.title+'<br />Author: '+obj.author_name+'</div></div>';
		                        	$('#playing_top').html(obj.title);
		                        	$('#now_playing').html(playing_det);
		                        
		                        // if(current_index==1){
		                        	// next_det='<div id="playing_next" style="display:none;"><div class="playing_next_label">Coming Up</div><img src="'+obj.thumbnail_url+'" class="vid_thumb"><div class="now_title">'+obj.title+'<br />Author: '+obj.author_name+'</div></div>';
		                        	// $('#now_playing').html(playing_det+next_det);
// 		                        	
		                        	// var $or = $("#playing_now"),
							            // $bl = $("#playing_next"),
							            // togglePlaying;
// 		                    	
			                    	// togglePlaying = function() {
										// $or.slideToggle();
										// $bl.slideToggle();
									// };
// 								
							 		// setInterval(togglePlaying, 10000);
// 		                        	
		                        // }
							}
					});                    
                    
                    // var play_index = playlist.indexOf(playing_id);
                    // var next_index = ++play_index;
                    // var next_play = playlist[next_index];
                    // $("#playback").attr('data', "http://www.youtube.com/v/"+next_play+'&autoplay=1').hide().show();
                    // var current=details[next_index];
                    // var next=details[next_index+1];
                    // playing_det='<div id="playing_now"><div class="playing_label">Now Playing</div><img src="'+current.thumbnail_url+'" class="vid_thumb"><div class="now_title">'+current.title+'<br />Author: '+current.author_name+'</div></div>';
//                     
                    // if(next_index!=v_count-1){
                    	// next_det='<div id="playing_next" style="display:none;"><div class="playing_next_label">Coming Up</div><img src="'+next.thumbnail_url+'" class="vid_thumb"><div class="now_title">'+next.title+'<br />Author: '+next.author_name+'</div></div>';
                    	// $('#now_playing').html(playing_det+next_det);
                    // }else{
                    	// $('#now_playing').html(playing_det);
                    // }
//                     
// 
//                     
                    // $('#playing_top').html(current.title);
//                     
                    // if(next_index!=v_count-1){
//                     	
                    	 // var $or = $("#playing_now"),
					         // $bl = $("#playing_next"),
					         // togglePlaying;
//                     	
                    	// togglePlaying = function() {
							// $or.slideToggle();
							// $bl.slideToggle();
						// };
// 						
					 // setInterval(togglePlaying, 10000);
                    // }
                    
                nextVideo();    
                });
                
                $('#addurl').click(function(){
                    var url=$('#new_url').val();
                    var video_id = url.match(/v=(.{11})/)[1];
                    //playlist.push(video_id);
                    playlist[v_count]=video_id;
                    current_index=v_count;
                    
                    $.ajax({
							type: 'POST',
							url: "video/video_details",
							data: {vid:video_id},
							dataType: 'html',
							success: function (result){
		                        var obj = jQuery.parseJSON(result);
		                        details[v_count]=obj;
		                        $("#playQueue ul").append('<li><a href="#">'+obj.title+'</a></li>');
		                        if(current_index==0) {
		                        	playing_det='<div id="playing_now"><div class="playing_label">Now Playing</div><img src="'+obj.thumbnail_url+'" class="vid_thumb"><div class="now_title">'+obj.title+'<br />Author: '+obj.author_name+'</div></div>';
		                        	$('#playing_top').html(obj.title);
		                        	$('#now_playing').html(playing_det);
		                        }
		                        if(current_index==1){
		                        	next_det='<div id="playing_next" style="display:none;"><div class="playing_next_label">Coming Up</div><img src="'+obj.thumbnail_url+'" class="vid_thumb"><div class="now_title">'+obj.title+'<br />Author: '+obj.author_name+'</div></div>';
		                        	$('#now_playing').html(playing_det+next_det);
		                        	
		                        	var $or = $("#playing_now"),
							            $bl = $("#playing_next"),
							            togglePlaying;
		                    	
			                    	togglePlaying = function() {
										$or.slideToggle();
										$bl.slideToggle();
									};
								
							 		setInterval(togglePlaying, 10000);
		                        	
		                        }
							}
					});
                    
                    
                      // $.post("video/video_details",{vid:video_id},function(result){
// 
                      // });

                    $('#new_url').val('');
                    alert('Video was successfully added to your playlist');
                    $.colorbox.close();
                    if($('#start_screen').is(':visible')) {
		                    $('#start_screen').hide();
		                    $('#player').show();
		                    var first_play = playlist[0];
		                    playVideo(first_play);
		                    $('#playing_id').val(first_play);
		                    $('#player_body').css({padding:0});
		                    //player.loadVideoById(first_play, 0, "medium");
		                    //player.target.cueVideoById(first_play, 0, "medium");
		                    //$("#playback").attr('data', "http://www.youtube.com/v/"+first_play+'&autoplay=1').hide().show();
                    }
                    
				    v_count++;                    
                    
                });

                $(".inline").colorbox({inline:true, width:"25%", closeButton:true,transition:"none", top:"7%", right:"10%",opacity:0.5});
                
                $(document).bind('cbox_load', function(){
				  $('#new_url').focus();
				});
                
                $('#playQueue').perfectScrollbar();


            });
        </script>

<style type="text/css">


#playQueue{
	overflow: hidden;
    position: relative;
    height:450px; 
    float: right; 
    width: 275px;
    padding-top:2%;
}

#playQueue ul{
  width:250px;
  list-style:none;
  padding:0;
  text-align:center;
  height: 450px;

  margin-top: -10%;
}
#playQueue ul > li{
  margin-bottom:15px;
}
#playQueue li span{
  display:block;
  clear:both;
  background:#5A9BD5;
  padding:25px 0;
}
#playQueue ul ul li{
  float:left;
  width:90px;
  margin:15px 15px 0 0;
}
#playQueue ul ul li:nth-child(3){
  margin-right:0;
}
#playQueue ul li a{
  background:#00628B;
  display:block;
  width:100%;
  padding:25px 0;
  text-decoration:none;
  transition: 0.4s;
  color:#fff;
  font-weight: bold;
}
#playQueue ul li a:hover{
  background:#ffffff;
  color: #00628B;
  font-weight: bold;
}

/*::-webkit-scrollbar {
    width: 12px;
}
::-webkit-scrollbar-track {
    background-color: #eaeaea;
    border-left: 1px solid #ccc;
}
::-webkit-scrollbar-thumb {
    background-color: #ccc;
}
::-webkit-scrollbar-thumb:hover {
    background-color: #aaa;
}*/


/*.row{
    margin-top: -5%;
}*/

#new_url{
	border: 1px solid #ccc;
    border-radius: 4px;
    box-shadow: 0 1px 3px #ddd inset;
    box-sizing: border-box;
    display: inline-block;
    padding: 0.5em 0.6em;
    width: 80%;
}

#add_you{
	border-bottom: 1px solid #e5e5e5;
    color: #333;
    display: block;
    margin-bottom: 0.3em;
    padding: 0.3em 0;
    width: 100%;
}

#playback{
	margin-bottom: 2%;
}

.vid_thumb{
	width:120px;
	height:90px;
	display: inline-block;
	margin-left:-58%;
	margin-top:2%;
}

#now_playing{
	width: 65%;
    margin-top: 6%;
    background-color:#00628b;
}

.now_title{
	display: inline-block;
    margin-left: 2%;
    margin-top: -2%;
    font-weight:bold;
}

.playing_label{
	background-color: #00628b;
    float: left;
    font-size: 0.8em;
    font-weight: bold;
    padding-left: 1%;
    padding-right: 1%;
    transform: rotate(90deg);
    transform-origin: left top 0;
}

.playing_next_label{
	background-color: #00628b;
    float: left;
    font-size: 0.8em;
    font-weight: bold;
    padding-left: 1%;
    padding-right: 1%;
    transform: rotate(90deg);
    transform-origin: left top 0;
}

#player_body{
	float:left;
	background-color: #393939; 
	height: 31em;
	padding: 1% 0; 
	width: 65%; 
	border-radius: 1em;
}


/*#playQueue::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	border-radius: 10px;
	background-color: #F5F5F5;
}

#playQueue::-webkit-scrollbar
{
	width: 12px;
	background-color: #F5F5F5;
}

#playQueue::-webkit-scrollbar-thumb
{
	border-radius: 10px;
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
	background-color: #555;
}*/



</style>

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top">Start Bootstrap</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a class='inline' href="#inline_content">Add Video</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about">About</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- This contains the hidden content for inline calls -->
        <div style='display:none'>
            <div id='inline_content' style='padding:10px;'>
            	<label id="add_you">Paste the Youtube URL here</label>
            	<br />
            	<input type="text" id="new_url" />
            	<img id="addurl" src="img/plus.png" class="img-responsive" alt="" style="height: 35px; width: 35px; display: inline; margin-left: 5%; margin-top: -2%;">
            	<!-- <button id="addurl">Add new video</button> -->
            	<br />
            </div>
        </div>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div id="player_body">
                    	<div id="playing_top"></div>
                    	<div id="start_screen" style="width:98%; height:80%; background-color: #e6e6dc; margin-left: 1%;">
                    		
                    	</div>
                    	<input type="hidden" id="playing_id" value="" />
                    	<div id="player"></div>
	                    
	                    <br />
	                    <img id="p_prev" src="img/p_prev.png" class="img-responsive" alt="" style="float: left; margin-left: 5%; background-color: #fff; border-radius: 1em; ">
	                    <img id="p_play" src="img/p_play.png" class="img-responsive" alt="" style="float: left; margin-left: 5%; background-color: #fff; border-radius: 1em;">
	                    <img id="p_next" src="img/p_next.png" class="img-responsive" alt="" style="float: left; margin-left: 5%; background-color: #fff; border-radius: 1em;">
	                    <img id="p_stop" src="img/p_stop.png" class="img-responsive" alt="" style="float: left; margin-left: 5%; background-color: #fff; border-radius: 1em;">
	                    
                </div>
                    <br />
                    <div id="playQueue" style="">
                        <ul id="vidList">
                            <!-- <li><a href="#">Travis - My Eyes (Official Video)</a></li> -->
                        </ul>
                    </div>
					<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
                    <br /><br />
                    <div id="now_playing">
	                    	
	                    	
	                    </div>

                    <div class="intro-text">
                        <!-- <hr class="star-light"> -->
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Portfolio</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/cabin.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/cake.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/circus.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/game.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/safe.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/submarine.png" class="img-responsive" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <p>Freelancer is a free bootstrap theme created by Start Bootstrap. The download includes the complete source files including HTML, CSS, and JavaScript as well as optional LESS stylesheets for easy customization.</p>
                </div>
                <div class="col-lg-4">
                    <p>Whether you're a student looking to showcase your work, a professional looking to attract clients, or a graphic artist looking to share your projects, this template is the perfect starting point!</p>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <a href="#" class="btn btn-lg btn-outline">
                        <i class="fa fa-download"></i> Download Theme
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Contact Me</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Email Address</label>
                                <input type="email" class="form-control" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Phone Number</label>
                                <input type="tel" class="form-control" placeholder="Phone Number" id="phone" required data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Message</label>
                                <textarea rows="5" class="form-control" placeholder="Message" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-success btn-lg">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>Location</h3>
                        <p>3481 Melrose Place<br>Beverly Hills, CA 90210</p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Around the Web</h3>
                        <ul class="list-inline">
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-dribbble"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>About Freelancer</h3>
                        <p>Freelance is a free to use, open source Bootstrap theme created by <a href="http://startbootstrap.com">Start Bootstrap</a>.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; Your Website 2014
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visble-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- Portfolio Modals -->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="img/portfolio/cabin.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="img/portfolio/cake.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="img/portfolio/circus.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="img/portfolio/game.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="img/portfolio/safe.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="img/portfolio/submarine.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>
