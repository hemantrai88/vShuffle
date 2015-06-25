<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=yes">
  <title>vShuffle</title>
  <script src="/components/webcomponentsjs/webcomponents.min.js"></script>
  <!-- <link rel="import" href="/vulcanized.html"> -->
  <link rel="import" href="/elements.html">
  <link rel="stylesheet" href="/styles.css" shim-shadowdom>
  <link rel="import" href="/post-card.html">
  <script type="text/javascript" src="//code.jquery.com/jquery-2.1.4.min.js"></script>
  <base target="_blank"></base>
  <style>
    core-animated-pages > *  {
      font-size: inherit;
      overflow-y: auto;
      padding: 30px;
    }
  </style>

  <script type="text/javascript">
    //Load player api asynchronously.
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    var done = false;
    var player;
  </script>


<script type="text/javascript">

jQuery.fn.toggleAttr = function(attribute, value) {
    value = value || attribute;
    return this.each(function() {
        var attr = jQuery(this).attr(attribute);
        if (typeof attr !== typeof undefined && attr !== false) {
            jQuery(this).removeAttr(attribute);
        }
        else {
            jQuery(this).attr(attribute, value);
        }
    });
};


function favoriteTapped(){
  alert('Video has been added to the playlist');
}

function closePreview(){
  $('#dialog').removeAttr('opened');
}

function playVideo(vid){
      var player_id = 'player__'+vid;
      player = new YT.Player(player_id, {
          height: '80%',
          width: '80%',
          videoId: vid
        });
    }

function open_vid_card(vid){
  playVideo(vid);
  $('#dialog_action__'+vid).toggleAttr('opened');
  //alert('Open via function for id = '+vid);
}

function show_preview(vid){
  $('#pc_link__'+vid).css( 'cursor', 'pointer' );
}

function hide_preview(vid){
  $('#pc_link__'+vid).css( 'cursor', 'auto' ); 
}

  function searchYouTube(){
      var q = $('#textYou').val();
        var maxResults = 25;
        $('#search_spinner').show()
        $.ajax({
          type: 'POST',
          url: "//stoneman.boozie.in/playlist/searchYoutubePoly",
          data: {q:q, maxResults:maxResults},
          dataType: 'html',
          success: function (result){
                      $('#search_spinner').hide()
                      $('#search_body').html(result);

                      $('.search_vid_card').click(function(){
                        alert('Preparing Preview...');
                        
                      });
          }
        });
  }

  function showTagSelector(){
    $('#pg_tags').slideToggle();
    $('#add_tags_label').slideToggle();
  }

  function searchYouTubeReturn(e){
    if(e.which == 13){
      var q = $('#textYou').val();
        var maxResults = 25;
        $('#search_spinner').show()
        $.ajax({
          type: 'POST',
          url: "//stoneman.boozie.in/playlist/searchYoutubePoly",
          data: {q:q, maxResults:maxResults},
          dataType: 'html',
          success: function (result){
                      $('#search_spinner').hide()
                      $('#search_body').html(result);

                      $('.search_vid_card').click(function(){
                        alert('Preparing Preview...');
                        
                      });
          }
        });
    }
  }
    
</script>



</head>
<body unresolved fullbleed>

<template is="auto-binding" id="t">

  <!-- Route controller. -->
  <flatiron-director route="{{route}}" autoHash></flatiron-director>

  <!-- Keyboard nav controller. -->
  <core-a11y-keys id="keys" target="{{parentElement}}"
                  keys="up down left right space+shift"
                  on-keys-pressed="{{keyHandler}}"></core-a11y-keys>

  <!-- Dynamic content controller -->
  <core-ajax id="ajax" url="{{selectedPage.page.url}}" handleAs="document"
             on-core-response="{{onResponse}}"></core-ajax>

  <core-scaffold id="scaffold" responsiveWidth="1200px">

    <nav>
      <core-toolbar>
        <span>vShuffle</span>
      </core-toolbar>
      <core-menu id="menu" valueattr="hash"
                 selected="{{route}}"
                 selectedModel="{{selectedPage}}"
                 on-core-select="{{menuItemSelected}}" on-click="{{ajaxLoad}}">
        <template repeat="{{page, i in pages}}">
          <paper-item hash="{{page.hash}}" noink>
            <core-icon icon="label{{route != page.hash ? '-outline' : ''}}"></core-icon>
            <a href="{{page.url}}">{{page.name}}</a>
          </paper-item>
        </template>
      </core-menu>
    </nav>

    <core-toolbar tool flex>
      <div flex>{{selectedPage.page.name}}</div>
      <core-icon-button icon="refresh"></core-icon-button>
      <core-icon-button icon="add"></core-icon-button>
    </core-toolbar>

    <div layout horizontal center-center fit>
      <core-animated-pages id="pages" selected="{{route}}" valueattr="hash"
                           transitions="slide-from-right">
        <template repeat="{{page, i in pages}}">
          <section hash="{{page.hash}}" layout vertical center-center>
            <div style="max-width:100%;">Loading...</div>
          </section>
        </template>
      </core-animated-pages>
    </div>

  </core-scaffold>

</template>

<script src="/app-ajax.js"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43475701-2', 'auto'); // ebidel's
  ga('create', 'UA-39334307-1', 'auto'); // pp.org
  ga('send', 'pageview');
</script>
</body>
</html>