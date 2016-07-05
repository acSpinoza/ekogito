<?php

class Eff {

    private static $accessToken = '1492018151012834|U3qsH98pUZxv5watRRC4c-rg1rc';
    private static $initiated = false;
    private static $useCurl = false;
    private static $useFopen = false;

    public static function init(){
        if (!self::$initiated) {
            self::init_hooks();
        }
    }

    /**
     * Initializes WordPress hooks
     */
    private static function init_hooks(){
        self::$initiated = true;

        add_action( 'wp_enqueue_scripts', array('Eff', 'eff_stylesheet') );
        add_shortcode( 'easy_facebook_feed', array('Eff', 'eff_easy_facebook_feed') );
    }

    /**
     * Load stylesheets
     */
    public static function eff_stylesheet() {
        wp_register_style( 'eff_style', plugins_url('css/eff_style.css?8', __FILE__) );
        wp_enqueue_style( 'eff_style' );
        wp_enqueue_style( 'eff-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css');
    }

    /**
     * @param $atts
     * @return null|string
     */
    public static function eff_easy_facebook_feed( $atts ){
        $options = self::eff_getOptions();
        $serverRequirements = new EffServerRequirements();
        $return = null;

        if($serverRequirements->checkPhpVersion()) {
            echo self::eff_makeError("Easy Facebook Feed requires PHP 5.3 or higher. You’re still on ".PHP_VERSION.". Please update your PHP version.");
            return;
        }

        if($serverRequirements->checkCurl()) {
            self::$useCurl = true;
        } elseif($serverRequirements->checkFopen()) {
            self::$useFopen = true;
        } else {
            echo self::eff_makeError("Easy Facebook Feed requires allow_url_fopen or Curl to function, please contact your hosting provider to enable allow_url_fopen or Curl in your php.ini.");
            return;
        }

        $shortcode_atts = shortcode_atts( array(
            'id' => $options['facebook_page_id'],
            'limit' => $options['facebook_post_limit'],
        ), $atts );

        $feed = self::eff_get_page_feed($shortcode_atts['id'], $shortcode_atts['limit']);
        $page = self::eff_get_page($shortcode_atts['id']);

        if ($feed->error) {
            return self::eff_makeError($feed->error->message);
        }

        if ($page->error) {
            return self::eff_makeError($page->error->message);
        }

        foreach ($feed->data as $key => $data) {
            $postTemplate = self::eff_makePost($data, $page);

            switch ($data->type) {
                case 'photo':
                    $photoTemplate = self::eff_makePhoto($data);
                    $return .= Template::merge($postTemplate, $photoTemplate);
                    break;
                case 'link':
                    $linkTemplate = self::eff_makeLink($data);
                    $return .= Template::merge($postTemplate, $linkTemplate);
                    break;
                case 'video':
                    $videoTemplate = self::eff_makeVideo($data);
                    $return .= Template::merge($postTemplate, $videoTemplate);
                    break;
                case 'event':
                    $eventTemplate = self::eff_makeEvent($data);
                    $return .= Template::merge($postTemplate, $eventTemplate);
                    break;
                case 'status':
                    $postTemplate = str_replace("{{data-content}}", '', $postTemplate);
                    $return .= $postTemplate;
                    break;
            }
        }

        return $return;
    }

    /**
     * @param $message
     * @return mixed|string
     */
    public static function eff_makeError($message){
        $template = new Template("eff-error.html");
        $template->set("error-message", $message);

        return $template->output();
    }

    /**
     * @param $data
     * @return mixed|string
     */
    public static function eff_makePhoto($data){
        $template = new Template("eff-photo.html");
        $template->set("image-url", $data->full_picture);

        return $template->output();                     
    }

    /**
     * @param $data
     * @return mixed
     */
    public static function eff_makeVideo($data){
        if(strpos($data->source,'fbcdn')) {
            $template = new Template("eff-video.html");
            $template->set("data-source", $data->source);
            $template->set("data-picture", $data->picture);
            $template->set("data-link", $data->link);
        } else {
            $template = new Template("eff-photo.html");
            $template->set("image-url", $data->full_picture);
        }

        return $template->output();
    }

    /**
     * @param $data
     * @return mixed
     */
    public static function eff_makeEvent($data){
        $template = new Template("eff-event.html");
        $template->set("data-link", $data->link);
        $template->set("data-name", $data->name);
        $template->set("data-description", nl2br($data->description));

        if($data->full_picture){
            $template2 = new Template("eff-link-picture.html");
            $template2->set("data-picture", $data->full_picture);
            $template = Template::merge($template->output(), $template2->output());
        } else {
            $template->remove("data-content");
            $template = $template->output();
        }

        return $template;
    }

    /**
     * @param $data
     * @return mixed
     */
    public static function eff_makeLink($data){
        $template = new Template("eff-link.html");
        $template->set("data-link", $data->link);
        $template->set("data-name", $data->name);
        $template->set("data-description", nl2br($data->description));

        if($data->full_picture){
            $template2 = new Template("eff-link-picture.html");
            $template2->set("data-picture", $data->full_picture);
            $template = Template::merge($template->output(), $template2->output());
        } else {
            $template->remove("data-content");
            $template = $template->output();
        }

        return $template;
    }

    /**
     * @param $data
     * @param $page
     * @return mixed
     */
    public static function eff_makePost($data, $page){
        $template = new Template("eff-post.html");
        $template->set("page-link", $page->link);
        $template->set("page-cover-source", $page->picture->data->url);
        $template->set("data-from-name", $data->from->name);
        $template->set("data-link", $data->link);
        $template->set("data-created_time", self::eff_time_elapsed_string($data->created_time));
        $message = self::setUrls($data->message);
        $message = self::setHashtags($message);
        $template->set("data-message", nl2br($message));

        return $template->output();
    }

    private static function setHashtags($message){
        if(preg_match_all("/#(\\w+)/", $message, $matches)){
            foreach($matches[1] as $key => $match){
                $url = "<a href='https://www.facebook.com/hashtag/".$match."'>#".$match."</a>";
                $message = str_replace('#'.$match, $url, $message);
            }
        }

        return $message;
    }

    private static function setUrls($message){
        $message = preg_replace("/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/", "<a href=\"\\0\">\\0</a>", $message);

        return $message;
    }

    /**
     * @param $pageId
     * @return array|mixed|object
     */
    private static function eff_get_page($pageId){
        $fields = 'link,name,cover,picture';
        $accessToken = self::$accessToken;
        $url = "https://graph.facebook.com/v2.6/{$pageId}?fields={$fields}&access_token={$accessToken}";
        $page = self::eff_connect($url);

        return $page;
    }

    /**
     * @param $pageId
     * @param $postLimit
     * @return array|mixed|object
     */
    public static function eff_get_page_feed($pageId, $postLimit){
        $accessToken = self::$accessToken;
        $fields = 'full_picture,type,message,link,name,description,from,source,created_time';
        $url = "https://graph.facebook.com/v2.6/{$pageId}/posts?fields={$fields}&access_token={$accessToken}&limit={$postLimit}";
        $feed = self::eff_connect($url);

        return $feed;
    }

    /**
     * @param $url
     * @return array|mixed|object
     */
    public static function eff_connect($url){
        $json = '';

        // use curl or file_get_contents
        if(self::$useCurl) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $json = curl_exec($ch);
            curl_close($ch);
        } else {
            if(file_get_contents($url)) {
                $json = file_get_contents($url);
            } else {
                $arr = array('error' => array('message' => "Unknown file_get_contents connection error with Facebook."));
                $json = json_encode($arr);
            }
        }

        return json_decode($json);
    }

    /**
     * @return mixed|void
     */
    public static function eff_getOptions(){
        $defaults = array(
            'facebook_page_id' => 'bbcnews',
            'facebook_post_limit' => '5'
        );

        $options = get_option( 'eff_options', $defaults );

        return $options;
    }

    /**
     * @param $datetime
     * @param bool|false $full
     * @return string
     */
    public static function eff_time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = (array)$now->diff($ago);

        $diff['w'] = floor($diff['d'] / 7);
        $diff['d'] -= $diff['w'] * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );

        foreach ($string as $k => &$v) {
            if ($diff[$k]) {
                $v = $diff[$k] . ' ' . $v . ($diff[$k] > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) {
            $string = array_slice($string, 0, 1);
        }

        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }


}
