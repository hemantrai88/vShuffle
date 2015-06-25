<? //print_r(phpinfo()); exit;


	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

 ?>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <!-- jQuery -->
    <script src="<?php echo BASE_PATH; ?>js/jquery.js"></script>
  
      <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="<?php echo BASE_PATH; ?>css/bootstrap.min.css" rel="stylesheet">
    
    <link href="<?php echo BASE_PATH; ?>css/freelancer.css" rel="stylesheet">

      <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="<?php echo BASE_PATH; ?>css/bootstrap.min.filter.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!-- <link href="css/freelancer.css" rel="stylesheet"> -->

    <link href="<?php echo BASE_PATH; ?>css/jquery-ui-1.10.2.custom.min.css" media="screen" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_PATH; ?>css/stream.css" media="screen" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_PATH; ?>colorbox/colorbox.css" media="screen" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_PATH; ?>css/buttons.css" media="screen" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_PATH; ?>css/animate.css" media="screen" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_PATH; ?>css/chosen-style.css" media="screen" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_PATH; ?>css/prism.css" media="screen" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_PATH; ?>css/chosen.css" media="screen" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_PATH; ?>css/font-awesome/css/font-awesome.min.css" media="screen" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <link href="<?php echo BASE_PATH; ?>css/chosen-style.css" media="screen" rel="stylesheet" type="text/css">

    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
	<link rel="stylesheet" href="<?php echo BASE_PATH; ?>css/jquery.fileupload.css" media="screen" rel="stylesheet" type="text/css">

    <script src="<?php echo BASE_PATH; ?>colorbox/jquery.colorbox.js"  type="text/javascript"></script>
    <script src="<?php echo BASE_PATH; ?>js/jquery-ui-1.10.2.custom.min.js" type="text/javascript"></script>
    <script src="<?php echo BASE_PATH; ?>js/jquery.noty.packaged.min.js" type="text/javascript"></script>
    <script src="<?php echo BASE_PATH; ?>js/notification_html.js" type="text/javascript"></script>
    <script src="<?php echo BASE_PATH; ?>js/chosen.jquery.js" type="text/javascript"></script>
    <script src="<?php echo BASE_PATH; ?>js/prism.js" type="text/javascript"></script>
    <script src="<?php echo BASE_PATH; ?>js/chosen.jquery.js" type="text/javascript"></script>

	<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
	<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
	<!-- The Canvas to Blob plugin is included for image resizing functionality -->
	<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
	<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
	<script src="<?php echo BASE_PATH; ?>js/jquery.iframe-transport.js"></script>
	<!-- The basic File Upload plugin -->
	<script src="<?php echo BASE_PATH; ?>js/jquery.fileupload.js"></script>
	<!-- The File Upload processing plugin -->
	<script src="<?php echo BASE_PATH; ?>js/jquery.fileupload-process.js"></script>
	<!-- The File Upload image preview & resize plugin -->
	<script src="<?php echo BASE_PATH; ?>js/jquery.fileupload-image.js"></script>
	<!-- The File Upload audio preview plugin -->
	<script src="<?php echo BASE_PATH; ?>js/jquery.fileupload-audio.js"></script>
	<!-- The File Upload video preview plugin -->
	<script src="<?php echo BASE_PATH; ?>js/jquery.fileupload-video.js"></script>
	<!-- The File Upload validation plugin -->
	<script src="<?php echo BASE_PATH; ?>js/jquery.fileupload-validate.js"></script>
    

	<!-- jQuery easing plugin -->
	<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
	
    <!-- Shuffle Resources CSS -->
    <script src="<?php echo BASE_PATH; ?>js/ShuffleScript.js" type="text/javascript"></script>
    <link href="<?php echo BASE_PATH; ?>css/ShuffleStyle.css" media="screen" rel="stylesheet" type="text/css">

    <style type="text/css">
    	#page_body{
    		background-color: #fff;
    		width: 80%;
    		margin-left: 10%;
    		padding: 2%;
    	}

    	#search_body{
    		background-color: #fff;
    		width: 80%;
    		margin-left: 10%;
    		padding: 2%;
    		display: none;
    	}

    	#page_heading{
    		background-color: #fff;
    		width: 80%;
    		margin-left: 10%;
    		padding: 1%;
    		margin-bottom: 1%;
    	}

    	#pl_preview{
    		background-color: #fff;
    		width: 80%;
    		margin-left: 10%;
    		padding: 2%;
    		display: none;
    	}

    	#pl_add_songs{
    		display: block;
    		margin: auto;
    	}

    	h3{
    		background-color: #fff !important;
    		padding: 1%;
    		text-align: center;
    	}

    	.pl_holder{
    		display: none;
    		text-transform: none;
    		opacity: 0.9;
    		/*box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);*/
    	}

    	.pl_tags_holder_tag {
		    background-color: #979797;
		    border-left: 1px solid #979797;
		    border-radius: 3px 4px 4px 3px;
		    color: white;
		    display: inline-block;
		    font-family: "Source Sans Pro",monospace;
		    font-size: 75%;
		    font-weight: 700;
		    height: 38px;
		    line-height: 310%;
		    margin-left: 3%;
		    padding: 0 1%;
		    position: relative;
		    width: auto;
		}

		/* Makes the triangle */
		.pl_tags_holder_tag:before {
			content: "";
			position: absolute;
			display: block;
			left: -19px;
			width: 0;
			height: 0;
			border-top: 19px solid transparent;
			border-bottom: 19px solid transparent;
			border-right: 19px solid #979797;
		}

		/* Makes the circle */
		.pl_tags_holder_tag:after {
			content: "";
			background-color: white;
			border-radius: 50%;
			width: 4px;
			height: 4px;
			display: block;
			position: absolute;
			left: -9px;
			top: 17px;
		}

		#is_mature_div{
			text-align: center;
			background-color: #fff;
			padding: 0.5%;
		}

		#pl_is_mature{
			vertical-align: top;
		}

		.fileinput-button {
		    display: block;
		    margin: auto;
		    width: 15%;
		}

		#progress{
			display: none;
		}

		#files{
			margin-left: 45%;
		}

		.pl_field{
			margin: 1% 0;
		}

		.video_result {
		    background-color: #fff;
		    border: 1px solid #000;
		    color: #00628b;
		    display: inline-block;
		    padding: 2%;
		    width: 48%;
		}
	    .search_title{
	    	vertical-align: top;
	    	display: block;
	    }
	    .add_video{
	    	margin-left: 25%;
	    }
	    .close_video{
	    	display: none;
	    }

    </style>

	<script>

	//Load player api asynchronously.
	    var tag = document.createElement('script');
	    tag.src = "https://www.youtube.com/iframe_api";
	    var firstScriptTag = document.getElementsByTagName('script')[0];
	    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	    var done = false;
	    var player;

	    function onPlayerReady(evt) {
	         evt.target.playVideo();
	     }

    	function playVideo(vid, div_id){
	    	player = new YT.Player(div_id, {
	          height: '50%',
	          width: '90%',
	          videoId: vid,
	          events: {
	            'onReady': onPlayerReady	          
	        	}
	        });

	        $('#img_'+vid).hide();
	        $('#div_'+vid).show();
	        $('#close_'+vid).show();

	        $('.video_result').css("opacity", "0.5");
	    	$('#li_'+vid).css("opacity", "1");
	        
	    }

	    function addToPlay(vid){
	    	alert('Video was added to your playlist');
	    	console.log(vid);
	    }

	    function closeVideo(vid){
	    	//player.stopVideo();
	    	$('#div_'+vid).html('');
	    	$('#div_'+vid).hide();
	    	$('#close_'+vid).hide();
	    	$('#img_'+vid).show();
	    	$('.video_result').css("opacity", "1.0");
	    }

	    var $listItems = $("ul li");

		$listItems.hover(function() {

		    $listItems.not(this).css("opacity", "0.25");

		}, function() {

		    $listItems.not(this).css("opacity", "1.0");    

		});


	function add_tag(){
		alert('Tag "'+$('.chosen-search input').val()+'" was successfully added');
	}

	$(document).ready(function(){

		$('.chosen-select').chosen({no_results_text: "Tag not found! <a href='return false;' onclick='add_tag();' >Add a new tag</a>"});

		$('#pl_name').blur(function(){
			if($('#pl_name').val().length != 0){
				$('#pl_name_holder').html($('#pl_name').val());
				$('#pl_name').hide();
				$('#pl_name_holder').show();
			}
			var tags = $('#pl_tags').val();
			var tag_text = '';
			$.each(tags,function(id,tag){
				tag_text += '<span class="pl_tags_holder_tag">'+tag+'</span>';
			});

			if(tag_text.length>0){
				$('#pl_tags_holder').html(tag_text);
				$('#pl_tags_holder').show();
				$('#pl_tags_chosen').hide();
			}

		});

		$('#pl_tags_holder').click(function(){
			$('#pl_tags_holder').hide();
			$('#pl_tags_chosen').show();			
		});

		$('#pl_name_holder').click(function(){
			$('#pl_name').show();
			$('#pl_name').focus();
			$('#pl_name_holder').hide();
		});

		$('#pl_desc').blur(function(){
			if($('#pl_desc').val().length != 0){
				$('#pl_desc_holder').html($('#pl_desc').val());
				$('#pl_desc').hide();
				$('#pl_desc_holder').show();
			}

			var tags = $('#pl_tags').val();
			var tag_text = '';
			$.each(tags,function(id,tag){
				tag_text += '<span class="pl_tags_holder_tag">'+tag+'</span>';
			});

			if(tag_text.length>0){
				$('#pl_tags_holder').html(tag_text);
				$('#pl_tags_holder').show();
				$('#pl_tags_chosen').hide();
			}

			
		});

		$('#pl_desc_holder').click(function(){
			$('#pl_desc').show();
			$('#pl_desc').focus();
			$('#pl_desc_holder').hide();
		});

		$('#pl_is_mature').click(function(){
			var tags = $('#pl_tags').val();
			var tag_text = '';
			$.each(tags,function(id,tag){
				tag_text += '<span class="pl_tags_holder_tag">'+tag+'</span>';
			});

			if(tag_text.length>0){
				$('#pl_tags_holder').html(tag_text);
				$('#pl_tags_holder').show();
				$('#pl_tags_chosen').hide();
			}
		});

		$('#pl_add_songs').click(function(){
			var pl_name = $('#pl_name').val();
			var pl_desc = $('#pl_desc').val();
			var pl_tags = $('#pl_tags').val();
			
			if($('#pl_is_mature').is(':checked'))
			    var pl_is_mature = $('#pl_is_mature').val();
			else
			    var pl_is_mature = 'No';

			var pl_cover = $('#pl_cover').val();

			var pl_owner = '<? echo $this->session->userdata("UID"); ?>';

					$('#page_body').hide();
					$('#search_body').show();

					$('#pl_cover_img').attr("src",pl_cover);
					$('#pl_preview_name').html(pl_name);
					$('#pl_preview_desc').html(pl_desc);
					$('#pl_preview_tags').html(pl_tags);
					$('#pl_preview_mature').html(pl_is_mature);

					$('#pl_preview').show();

			/*$.ajax({
				type: 'POST',
				url: "<?php echo BASE_PATH; ?>playlist/save_playlist",
				data: {pl_name:pl_name, pl_desc:pl_desc, pl_tags:pl_tags, pl_is_mature:pl_is_mature, pl_cover:pl_cover, pl_owner:pl_owner},
				dataType: 'html',
				success: function (result){
					$('#page_body').hide();
					$('#search_body').show();

					$('#pl_cover_img').attr("src",pl_cover);
					$('#pl_preview_name').html(pl_name);
					$('#pl_preview_desc').html(pl_desc);
					$('#pl_preview_tags').html(pl_tags);
					$('#pl_preview_mature').html(pl_is_mature);

					$('#pl_preview').show();


                    console.log(result);
				}
			});*/

		});

		$('#searchYou').click(function(){
			var q = $('#textYou').val();
			var maxResults = 25;
			$.ajax({
				type: 'POST',
				url: "<?php echo BASE_PATH; ?>playlist/searchYoutube",
				data: {q:q, maxResults:maxResults},
				dataType: 'html',
				success: function (result){
                    $('#search_body').html(result);
				}
			});
		});

	});

	/*jslint unparam: true, regexp: true */
	/*global window, $ */
	$(function () {
	    'use strict';
	    // Change this to the location of your server-side upload handler:
	    var url = window.location.hostname === 'blueimp.github.io' ?
	                '//jquery-file-upload.appspot.com/' : '/server/php/',
	        uploadButton = $('<button/>')
	            .addClass('btn btn-primary')
	            .prop('disabled', true)
	            .text('Processing...')
	            .on('click', function () {
	            	$('#progress').show();
	                var $this = $(this),
	                    data = $this.data();
	                $this
	                    .off('click')
	                    .text('Abort')
	                    .on('click', function () {
	                        $this.remove();
	                        data.abort();
	                    });
	                data.submit().always(function () {
	                	$('#progress').show();
	                    $this.remove();
	                });
	            });
	    $('#fileupload').fileupload({
	        url: url,
	        dataType: 'json',
	        autoUpload: false,
	        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
	        maxFileSize: 5000000, // 5 MB
	        // Enable image resizing, except for Android and Opera,
	        // which actually support image resizing, but fail to
	        // send Blob objects via XHR requests:
	        disableImageResize: /Android(?!.*Chrome)|Opera/
	            .test(window.navigator.userAgent),
	        previewMaxWidth: 100,
	        previewMaxHeight: 100,
	        previewCrop: true
	    }).on('fileuploadadd', function (e, data) {
	        data.context = $('<div/>').appendTo('#files');
	        $.each(data.files, function (index, file) {
	            var node = $('<p/>')
	                    .append($('<span/>').text(file.name));
	            if (!index) {
	                node
	                    .append('<br>')
	                    .append(uploadButton.clone(true).data(data));
	            }
	            node.appendTo(data.context);
	        });
	    }).on('fileuploadprocessalways', function (e, data) {
	        var index = data.index,
	            file = data.files[index],
	            node = $(data.context.children()[index]);
	        if (file.preview) {
	            node
	                .prepend('<br>')
	                .prepend(file.preview);
	        }
	        if (file.error) {
	            node
	                .append('<br>')
	                .append($('<span class="text-danger"/>').text(file.error));
	        }
	        if (index + 1 === data.files.length) {
	            data.context.find('button')
	                .text('Upload')
	                .prop('disabled', !!data.files.error);
	        }
	    }).on('fileuploadprogressall', function (e, data) {
	        var progress = parseInt(data.loaded / data.total * 100, 10);
	        $('#progress .progress-bar').css(
	            'width',
	            progress + '%'
	        );
	    }).on('fileuploaddone', function (e, data) {
	        $.each(data.result.files, function (index, file) {
	            if (file.url) {
	            	$('#files').html('');
	            	$('#pl_cover').val(file.url);
	            	$('#page_body').css('background', 'rgba(0, 0, 0, 0) url("'+file.url+'") no-repeat scroll 0 0 / 100% 100%');
	                $('.fileinput-button').hide();
	                $('#progress').hide();
	                /*var link = $('<a>')
	                    .attr('target', '_blank')
	                    .prop('href', file.url);*/
	                $(data.context.children()[index])
	                    .wrap(link);
	            } else if (file.error) {
	                var error = $('<span class="text-danger"/>').text(file.error);
	                $(data.context.children()[index])
	                    .append('<br>')
	                    .append(error);
	            }
	        });
	    }).on('fileuploadfail', function (e, data) {
	        $.each(data.files, function (index) {
	            var error = $('<span class="text-danger"/>').text('File upload failed.');
	            $(data.context.children()[index])
	                .append('<br>')
	                .append(error);
	        });
	    }).prop('disabled', !$.support.fileInput)
	        .parent().addClass($.support.fileInput ? undefined : 'disabled');
	});
	</script>

    
</head>
<body id="page-top" class="index">
	<div id="loadsite" class="loadsite"></div>
	<div id="slate" style="display: none;">

<?php $this->load->view('skeleton/logged_in_nav'); ?>

<br /><br /><br /><br /><br />

<div id="page_heading">
	<h3>Roll your playlist</h3>	
</div>

<div id="pl_preview">

	<div id="pl_boxSet">
		<div id="pl_cover_art">
			<img src="" id="pl_cover_img">
		</div>
		<div id="pl_side">
			<h4 id="pl_preview_name"></h4>
			<h4 id="pl_preview_desc"></h4>
			<h4 id="pl_preview_tags"></h4>
			<h4 id="pl_preview_mature"></h4>
		</div>
	</div>
	
</div>

<div id="page_body">
  <!-- <form id="pl_form"> -->
	<h3 id="pl_name_holder" class="pl_holder"></h3>
	<input type="text" id="pl_name" name="pl_name" class="pl_field" placeholder="Playlist Name">
	<br />
	<h3 id="pl_desc_holder" class="pl_holder"></h3>
	<textarea id="pl_desc" name="pl_desc" class="pl_field" placeholder="A little bit about the playlist"></textarea>
	<br />
	<h3 id="pl_tags_holder" class="pl_holder"></h3>
	<select id="pl_tags" name="pl_tags" class="chosen-select pl_field" data-placeholder="Tags for the playlist" multiple >
		<option value="Pop">Pop</option>
		<option value="Rock">Rock</option>
		<option value="Jazz">Jazz</option>
		<option value="EDM">EDM</option>
		<option value="Country">Country</option>
		<option value="Folk">Folk</option>
		<option value="Bollywood">Bollywood</option>
		<option value="Hindi">Hindi</option>
	</select>
	<br />
	<div id="is_mature_div" class="pl_field">
		<input type="checkbox" name="pl_is_mature" id="pl_is_mature"  class="pl_field" value="Yes">
		<label>This playlist contains mature content</label>
	</div>
	<br />
	<!-- The fileinput-button span is used to style the file input field as button -->
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Playlist Cover</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]">
    </span>
    <br>
    
    <!-- The global progress bar -->
    <div id="progress" class="progress">
        <div class="progress-bar progress-bar-success"></div>
    </div>
    <!-- The container for the uploaded files -->
    <div id="files" class="files"></div>
    <br>

    <input type="hidden" id="pl_cover" name="pl_cover">
    
    <input type="button" value="Add Songs to playlist" id="pl_add_songs" name="pl_add_songs" class="pure-button pure-button-primary">
  <!-- </form> -->
  
</div>

<div id="search_body">
	<input type="text" id="textYou" name="textYou"> <input type="button" id="searchYou" value="Search">	
</div>


  </div>




</body>
