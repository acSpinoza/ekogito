<style>
html {
    margin-top: 0 !important;
    overflow: hidden !important;
}

h1,
figure{
    margin: 0 !important;
}

div{
    padding: 0 15px !important;
    padding-bottom: 30px !important;
    overflow-y: scroll;
    height: 200px;
}

p{
    display: block;
    padding-bottom: 30px !important;
}
</style>
<?php
wp_head();
?>
<script>
jQuery('html').attr('style', 'margin-top: 0 !important');
</script>
<?php

if(isset($_GET['id'])){
    $page_id = $_GET["id"];  //Page ID
    $page_data = get_page($page_id); 
    $title = $page_data->post_title; 
    $content = $page_data->post_content;
    
    echo do_shortcode($content);
}