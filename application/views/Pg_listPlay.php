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
    	var playlist= ["KWZGAExj-es", "x8eDyCRa0mY", "0ZnShXeJoB8", "N7ys8qVZwAk", "v3tb-m0Ez4I", "bpOSxM0rNPM", "FHCYHldJi_g", "VQH8ZTgna3Q"]; 
        var original_queue = getPlayList();
        var details=[];
        var playing_det='';
        var next_det='';
        var v_count=playlist.length;
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
        var target_event = evt.target.getPlayerState();

        if(target_event == 1){
            $('#play_vid').hide();
            $('#pause_vid').show();
        }else if(target_event == 2){
            $('#pause_vid').hide();
            $('#play_vid').show();
        }
        // if (evt.data == YT.PlayerState.PLAYING && !done) {
            // setTimeout(stopVideo, 6000);
            // done = true;
        // }
        /*if(evt.data === 0) {          
        	
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
            }*/
    }
    function stopVideo() {
        player.stopVideo();
    }

    function pauseVideo(){
      player.pauseVideo();
    }

    function playPausedVideo(){
      player.playVideo();
    }
    
    function nextVideo(){
    	
        var now_playing_id=$('#playing_id').val();
       // $('#'+now_playing_id+'_li a').css({'background':'none repeat scroll 0 0 #00628b', 'color':'#fff'});
        var playing_index = playlist.indexOf(now_playing_id);
        $('#'+now_playing_id+'_playing').hide();
        if(playing_index!=playlist.length-1){
        	v_id=playlist[playing_index+1];
            player.loadVideoById(v_id, 0, "medium");
            $('#playing_id').val(v_id);
            get_video_details(v_id);
            //$('#'+v_id+'_li a').css({'background':'none repeat scroll 0 0 #ffffff', 'color':'#00628b'});

        }else{
        	v_id=playlist[0];
            player.loadVideoById(v_id, 0, "medium");
            $('#playing_id').val(v_id);
            get_video_details(v_id);
            //$('#'+v_id+'_li a').css({'background':'none repeat scroll 0 0 #ffffff', 'color':'#00628b'});

        }
        var current_index = playlist.indexOf(v_id);
        if(current_index!=0){
            var prev_index = current_index-1;
            var last_played_id = playlist[prev_index];
            console.log("LAST PLAYED = "+'"#'+last_played_id+'_li"');
            $('#'+last_played_id+'_li').removeClass('playQueuelistItemPlaying').addClass('playQueuelistItem');
        }
        console.log("NOW PLAYING = "+'"#'+v_id+'_li"');
        $('#'+v_id+'_li').removeClass('playQueuelistItem').addClass('playQueuelistItemPlaying');    	
    }
    
    function playVideo(vid){
    	player = new YT.Player('player', {
          height: '95%',
          width: '100%',
          videoId: vid,
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
        var playing_li = '#'+vid+'_li';
        var current_index = playlist.indexOf(vid);
        if(current_index!=0){
            var prev_index = current_index-1;
            var last_played_id = playlist[prev_index];
            console.log("LAST PLAYED = "+'"#'+last_played_id+'_li"');
            $('#'+last_played_id+'_li').removeClass('playQueuelistItemPlaying').addClass('playQueuelistItem');
        }
        console.log("NOW PLAYING = "+'"#'+vid+'_li"');
        $('#'+vid+'_li').removeClass('playQueuelistItem').addClass('playQueuelistItemPlaying');
    	//player.playVideo();
    	//player.loadVideoById(vid, 0, "large");
    }

    function shuffle(array) {
      var currentIndex = array.length, temporaryValue, randomIndex ;

      // While there remain elements to shuffle...
      while (0 !== currentIndex) {

        // Pick a remaining element...
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        // And swap it with the current element.
        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
      }

      return array;
    }
    
    function get_video_details(video_id){
    	
    	var playing_det = '';
    	var next_det = '';
    	
    	var current_index = playlist.indexOf(video_id);
    	
    	var pl_size = playlist.length;
    	
    	if(pl_size == (current_index+1)){
    		var next_index = 0;
    	}else{
    		var next_index = current_index + 1;
    	}

    	$.ajax({
				type: 'POST',
				url: "<?php echo BASE_PATH; ?>video/video_details",
				data: {vid:video_id},
				dataType: 'html',
				success: function (result){
		         	var obj = jQuery.parseJSON(result);
		         	details[video_id]=obj;
		         	
		          	playing_det='<div id="playing_now"><div class="playing_label">Now Playing</div><img src="'+obj.thumbnail_url+'" class="vid_thumb"><div class="now_title">'+obj.title+'<br />Author: '+obj.author_name+'</div></div>';
		            $('#playing_top').html(obj.title);
		            $('#now_playing').html(playing_det);

                    //console.log(playing_det);
		            
				}
			});
			
            //console.log(playing_det);
            //console.log(next_det);

			var next_video_id = playlist[next_index];
			
			$.ajax({
				type: 'POST',
				url: "<?php echo BASE_PATH; ?>video/video_details",
				data: {vid:next_video_id},
				dataType: 'html',
				success: function (result){
		         	var obj = jQuery.parseJSON(result);
		         	details[next_video_id]=obj;

		            next_det='<div id="playing_next" style="display:none;"><div class="playing_next_label">Coming Up</div><img src="'+obj.thumbnail_url+'" class="vid_thumb"><div class="now_title">'+obj.title+'<br />Author: '+obj.author_name+'</div></div>';
		            
		            //console.log(playing_det);
		            //console.log(next_det);
		            
		            $('#now_playing').html(playing_det+next_det);
		            
		            var $or = $("#playing_now"),
					$bl = $("#playing_next"),
					togglePlaying;
				                    	
					togglePlaying = function() {
						$or.slideToggle();
						$bl.slideToggle();
					};
										
					setInterval(togglePlaying, 5000);            	
		                        	
		            }
				
			});
			
			
    }
    
    function play_list(play_list){
    	
    	var pl = play_list;
    	
    	
    	
    	
    }
     
            $(document).ready(function(){

                $.each(playlist, function(index, value){
                    console.log(value);
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo BASE_PATH; ?>video/video_details",
                        data: {vid:value},
                        dataType: 'html',
                        async: false,
                        success: function (result){
                            var obj = jQuery.parseJSON(result);
                            details[value]=obj;
                            $("#playQueue ul").append('<li id="'+value+'_li" class="playQueuelistItem"><a href="#">'+obj.title+'</a></li>');
                            
                            $('#playQueue').perfectScrollbar();

                        }
                    });

                });

/*                var list = $('#playQueue ul');
                var listItems = list.children('li');
                list.append(listItems.get().reverse());
*/
                get_video_details(playlist[0]);

                $('#start_screen').hide();
                $('#player').show();
                var first_play = playlist[0];
                setTimeout(function(){ playVideo(first_play); },1000)
                
                $('#playing_id').val(first_play);
                $('#player_body').css({padding:0});

                //playVideo(playlist[0]);
            	
            	//$('#player').hide();
            	
            	$('#add_video_link').click(function(){
            		$('#add_url_div').slideToggle();
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

                $('#pause_vid').click(function(){
                    pauseVideo();
                    $('#pause_vid').hide();
                    $('#play_vid').show();
                });

                $('#play_vid').click(function(){
                    playPausedVideo();
                    $('#play_vid').hide();
                    $('#pause_vid').show();
                });

                $('#next_vid').click(function(){
                    console.log(playlist);
                    console.log(original_queue);

                    nextVideo();    

                });

                $('#shuffle_play').click(function(){
                    $('#shuffle_play').hide();
                    $('#shuffling_play').show();
                    var temp_play = playlist;
                    playlist = shuffle(temp_play);
                });

                $('#shuffling_play').click(function(){
                    $('#shuffling_play').hide();
                    $('#shuffle_play').show();
                    playlist= ["KWZGAExj-es", "x8eDyCRa0mY", "0ZnShXeJoB8", "N7ys8qVZwAk", "v3tb-m0Ez4I", "bpOSxM0rNPM", "FHCYHldJi_g", "VQH8ZTgna3Q"];
                });

                $('#loop_play').click(function(){
                    $('#loop_play').hide();
                    $('#looping_play').show();
                });

                $('#looping_play').click(function(){
                    $('#looping_play').hide();
                    $('#loop_play').show();
                });

                


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
        <div class="container" style="width: 90% !important;">
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
                    </div>
                    <div id="player_controls">
                        <a id="pause_vid" href="javascript:void(0);" class="p_control_link pause_control"><img src="<? echo BASE_PATH; ?>img/controls/pause_64.png" class="img-responsive player_control"></a>
                        <a id="play_vid" href="javascript:void(0);" class="p_control_link play_control"><img src="<? echo BASE_PATH; ?>img/controls/play_64.png" class="img-responsive player_control"></a>
                        <a id="play_down" href="javascript:void(0);" class="p_control_link"><img src="<? echo BASE_PATH; ?>img/controls/down_64.png" class="img-responsive player_control"></a>
                        <a id="prev_vid" href="javascript:void(0);" class="p_control_link"><img src="<? echo BASE_PATH; ?>img/controls/left_64.png" class="img-responsive player_control"></a>
                        <a id="next_vid" href="javascript:void(0);" class="p_control_link"><img src="<? echo BASE_PATH; ?>img/controls/right_64.png" class="img-responsive player_control"></a>
                        <a id="play_up" href="javascript:void(0);" class="p_control_link"><img src="<? echo BASE_PATH; ?>img/controls/up_64.png" class="img-responsive player_control"></a>
                        <a id="shuffle_play" href="javascript:void(0);" class="p_control_link"><img src="<? echo BASE_PATH; ?>img/controls/shuffle_64.png" class="img-responsive player_control"></a>
                        <a id="shuffling_play" href="javascript:void(0);" class="p_control_link" style="display: none;"><img src="<? echo BASE_PATH; ?>img/controls/shuffling_64.png" class="img-responsive player_control"></a>
                        <a id="loop_play" href="javascript:void(0);" class="p_control_link" style="display: none;"><img src="<? echo BASE_PATH; ?>img/controls/loop_64.png" class="img-responsive player_control"></a>
                        <a id="looping_play" href="javascript:void(0);" class="p_control_link"><img src="<? echo BASE_PATH; ?>img/controls/looping_64.png" class="img-responsive player_control"></a>
                        <!-- <img id="p_prev" src="<?php echo BASE_PATH; ?>img/p_prev.png" class="img-responsive" alt="" style="float: left; margin-left: 5%; background-color: #fff; border-radius: 1em; ">
                        <img id="p_play" src="<?php echo BASE_PATH; ?>img/p_play.png" class="img-responsive" alt="" style="float: left; margin-left: 5%; background-color: #fff; border-radius: 1em;">
                        <img id="p_next" src="<?php echo BASE_PATH; ?>img/p_next.png" class="img-responsive" alt="" style="float: left; margin-left: 5%; background-color: #fff; border-radius: 1em;">
                        <img id="p_stop" src="<?php echo BASE_PATH; ?>img/p_stop.png" class="img-responsive" alt="" style="float: left; margin-left: 5%; background-color: #fff; border-radius: 1em;"> -->
                    </div>
                    <div id="now_playing"> </div>

                </div>
                <div class="col-lg-4">
                    <div id="playQueue" style="">
                        <ul id="vidList">
                            <!-- <li><a href="#">Travis - My Eyes (Official Video)</a></li> -->
                        </ul>
                    </div>
                    <!-- <div id="save_playlist_form">
                        <label>Playlist Name: </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" name="playlist_name" id="playlist_name" />
                        <button id="save_playlist" name="save_playlist">Save Playlist</button>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-8">
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
