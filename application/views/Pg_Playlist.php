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
    <link href="<?php echo BASE_PATH; ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo BASE_PATH; ?>css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo BASE_PATH; ?>font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

        <!-- jQuery -->
    <script src="<?php echo BASE_PATH; ?>js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo BASE_PATH; ?>js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="<?php echo BASE_PATH; ?>js/classie.js"></script>
    <script src="<?php echo BASE_PATH; ?>js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="<?php echo BASE_PATH; ?>js/jqBootstrapValidation.js"></script>
    <script src="<?php echo BASE_PATH; ?>js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo BASE_PATH; ?>js/freelancer.js"></script>

    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>colorbox/colorbox.css" />
    <script src="<?php echo BASE_PATH; ?>colorbox/jquery.colorbox.js"></script>
    
    <link href="<?php echo BASE_PATH; ?>scroll/src/perfect-scrollbar.css" rel="stylesheet">
    <script src="<?php echo BASE_PATH; ?>scroll/src/perfect-scrollbar.js"></script>
    
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
    
    <link href="<?php echo BASE_PATH; ?>css/playlist.css" rel="stylesheet">


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
    
    function getPlayList(){
        return playlist;
    }

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
            	
            	$('#add_video_link').click(function(){
            		$('#add_url_div').slideToggle();
            	});
                

                $('#p_next').click(function(){
                    var playing_id=$('#playing_id').val();
                    var playing_index = playlist.indexOf(playing_id);
                    console.log(playing_index+1);
                    console.log(playlist.length-1);
			        if((playing_index)!=(playlist.length-1)){
			        	v_id=playlist[playing_index+1];
			        }else{
			        	v_id=playlist[0];
			        }
                    $.ajax({
							type: 'POST',
							url: "<?php echo BASE_PATH; ?>video/video_details",
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
							url: "<?php echo BASE_PATH; ?>video/video_details",
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
		                        	$('#playQueue').perfectScrollbar();
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

               // $(".inline").colorbox({inline:true, width:"25%", closeButton:true,transition:"none", top:"7%", right:"10%",opacity:0.5});
                
                // $(document).bind('cbox_load', function(){
				  // $('#new_url').focus();
				// });
                
                


            });

            $(document).ready(function(){
                $('#save_playlist').click(function(){
                    var playlist_arr = getPlayList();
                    var playlist_save_name = $('#playlist_name').val();
                    if(playlist_arr.length<=0 || playlist_save_name==''){
                        alert('Please provide all data');
                    }else{
                        $.ajax({
							type: 'POST',
							url: "<?php echo BASE_PATH; ?>playlist/save_playlist",
							data: {playlist:playlist_arr, name: playlist_save_name},
							dataType: 'html',
							success: function (result){
		                        var obj = jQuery.parseJSON(result);
		                        console.log(obj);
							}
						}); 
                    }
                    
                });
            });

        </script>

</head>

<body id="page-top" class="index">

<?php $this->load->view('skeleton/logged_in_nav'); ?>

    <!-- Header -->
    <header>
        <div class="container" style="width: 90%; !important;">
        <!--
        <div id="add_url_div" style="display:none; float: right; width: 30%;">
                    <input type="text" style="width: 80%;">
                  <input type="button" value="Add" style="margin-left: 5%;">
                  </div>-->
        
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-8">
                        
                        <div id="player_body">
                        <div id="playing_top"></div>
                        <div id="start_screen" style="width:98%; height:80%; background-color: #e6e6dc; margin-left: 1%;">
                            
                        </div>
                        <input type="hidden" id="playing_id" value="" />
                        <div id="player"></div>
                        
                        <br />
                        <img id="p_prev" src="<?php echo BASE_PATH; ?>img/p_prev.png" class="img-responsive" alt="" style="float: left; margin-left: 5%; background-color: #fff; border-radius: 1em; ">
                        <img id="p_play" src="<?php echo BASE_PATH; ?>img/p_play.png" class="img-responsive" alt="" style="float: left; margin-left: 5%; background-color: #fff; border-radius: 1em;">
                        <img id="p_next" src="<?php echo BASE_PATH; ?>img/p_next.png" class="img-responsive" alt="" style="float: left; margin-left: 5%; background-color: #fff; border-radius: 1em;">
                        <img id="p_stop" src="<?php echo BASE_PATH; ?>img/p_stop.png" class="img-responsive" alt="" style="float: left; margin-left: 5%; background-color: #fff; border-radius: 1em;">


                    </div>
                </div>
                <div class="col-lg-4">
                    <div id="playQueue" style="">
                        <ul id="vidList">
                            <!-- <li><a href="#">Travis - My Eyes (Official Video)</a></li> -->
                        </ul>
                    </div>
                    <div id="save_playlist_form">
                        <label>Playlist Name: </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" name="playlist_name" id="playlist_name" />
                        <button id="save_playlist" name="save_playlist">Save Playlist</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-8">
                    <div id="now_playing"> </div>
                </div>
                <div class="col-lg-4">
                    
                </div>
            </div>
        </div>
        </div>
    </header>
                    
	                    
<!--                 </div>
                    <br />
                    
                    </div>
                    <div id="save_playlist_form">
	                    <label>Playlist Name: </label>
	                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                    <input type="text" name="playlist_name" id="playlist_name" />
	                    <button id="save_playlist" name="save_playlist">Save Playlist</button>
					</div>
					<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
                    <br /><br />
                    <div id="now_playing">
	                    	
	                    	
	                </div>

                    <div class="intro-text">
                        <!-- <hr class="star-light"> -->
<!--                    </div>
                </div>
            </div>
        </div>
    </header> -->

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>Location</h3>
                        
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
                        <h3>About vShuffle</h3>
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; vShuffle 2015
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


</body>

</html>
