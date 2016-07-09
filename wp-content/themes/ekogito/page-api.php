
<?php
wp_head();
?>

<script>
  console.log('api loaded');
</script>

<div id="content"></div>
 
<script>
(function($) {
  var flickerAPI = "//www.ekogito.co/wp-json/wp/v2/posts?per_page=1";
  $.getJSON( flickerAPI)
    .done(function( data ) {
        $.each(data, function(index, value) {
        console.log(value.title);
           $( "#content" ).text(value.link);
      });   
    });
})( jQuery );
</script>