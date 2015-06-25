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
                <a class="navbar-brand" href="#page-top">vShuffle</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a class='inline' id="add_video_link" href="#inline_content">Add Video</a>
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
        <div id="add_url_div" style="display:none;">
            <div id='inline_content' style='padding:10px;'>
            	<label id="add_you">Paste the Youtube URL here</label>
            	<br />
            	<input type="text" id="new_url" />
            	<img id="addurl" src="<?php echo BASE_PATH; ?>img/plus.png" class="img-responsive" alt="" style="height: 35px; width: 35px; display: inline; margin-left: 5%; margin-top: -2%;">
            	<!-- <button id="addurl">Add new video</button> -->
            	<br />
            </div>
        </div>