<div id="article-content">
	<div layout center-center fit>
<style>

paper-input-decorator /deep/ .label-text,
paper-input-decorator /deep/ .error {
    /* inline label,  floating label, error message and error icon color when the input is unfocused */
    color: green;
}

paper-input-decorator /deep/ ::-webkit-input-placeholder {
    /* platform specific rules for placeholder text */
    color: green;
}
paper-input-decorator /deep/ ::-moz-placeholder {
    color: green;
}
paper-input-decorator /deep/ :-ms-input-placeholder {
    color: green;
}

paper-input-decorator /deep/ .unfocused-underline {
    /* line color when the input is unfocused */
    background-color: green;
}

paper-input-decorator[focused] /deep/ .floated-label .label-text {
    /* floating label color when the input is focused */
    color: orange;
}

paper-input-decorator /deep/ .focused-underline {
    /* line color when the input is focused */
    background-color: orange;
}

paper-input-decorator.invalid[focused] /deep/ .floated-label .label-text,
paper-input-decorator[focused] /deep/ .error {
    /* floating label, error message nad error icon color when the input is invalid and focused */
    color: salmon;
}

paper-input-decorator.invalid /deep/ .focused-underline {
    /* line and color when the input is invalid and focused */
    background-color: salmon;
}

#my-button::shadow #ripple {
  color: blue;
}

post-card{
  width: 90%;
  margin: 0 auto 2% auto;
}

/*#search_body{
  margin-top: 15%;
  float: right;
}*/

.result_text{
  max-width: 90%;
}

.result_preview{
  display: none;
  background-color: #eee;
  font-size: 75%;
  padding: 0.5%;
  width: 10%;
}

.tabbed_page{
  width:80%; 
  margin: auto;
}

#search_div{
  width: 100%;
}

#search_body{
  width: 100%;
  margin-top: 5%;
}

#factory_view{
  width: 80%;
  margin: auto;
}

#pg_tags{
  display: none;
  width: 100%;
}

#add_tags_label{
  display: none;
}

  </style>

<div id="factory_view">
	  
    <div id="pl_roller">
      <paper-input-decorator floatingLabel label="Name it">
       <input is="core-input" id="pl_name">
      </paper-input-decorator>

      <paper-input-decorator floatingLabel label="Describe it">
          <textarea id="pl_desc"></textarea>
      </paper-input-decorator>

      <paper-input-decorator floatingLabel label="" id="tags_label">
        <paper-button raised id="addTag" on-tap="{{associateTags}}">
          <core-icon icon="add"></core-icon>
          Tag it
        </paper-button>
      </paper-input-decorator>

      <!-- <paper-fab id="addTag" icon="loyalty" on-tap="{{associateTags}}"></paper-fab> -->

      <paper-input-decorator floatingLabel label="Tags" id="add_tags_label">
        
      </paper-input-decorator>



      <my-element id="pg_tags"></my-element>

    </div>

    
    <paper-input-decorator floatingLabel label="Certify it">
      ALL<paper-toggle-button id="pl_isMature"></paper-toggle-button>MATURE(18+)
    </paper-input-decorator>

    <div id="search_div">
		  <paper-input-decorator floatingLabel label="Youtube">
			 <input is="core-input" id="textYou">
		  </paper-input-decorator>

		  <paper-button id="searchYouT">
		    <core-icon icon="search"></core-icon>
			  Search
		  </paper-button>

		  <style shim-shadowdom>
  			 paper-spinner.blue::shadow .circle {
  			  border-color: #4285f4;
  			 }
		  </style>
	  </div>

		<paper-spinner class="blue" active id="search_spinner" style="display: none;"></paper-spinner>

		<div id="search_body">
    </div>

	<script type="text/javascript">

		var searchEvent = document.querySelector('#searchYouT');

		searchEvent.addEventListener("click",searchYouTube, false);
		searchEvent.addEventListener("keypress",searchYouTubeReturn(event), false);

    var addTag = document.querySelector('#addTag');
    addTag.addEventListener("click",showTagSelector, false);  

    var toggle = document.querySelector("paper-toggle-button");
    toggle.addEventListener('change', function () {
      if (this.checked) {
        //alert('MATURE');
      } else {
        //alert('ALL');
      }
    }); 


	</script>
</div>
