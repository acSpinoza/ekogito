<?php

class EffServerRequirements {

    public function checkCurl(){
        if(function_exists('curl_version')) {
            return true;
        }
    }

    public function checkFopen(){
        if(ini_get('allow_url_fopen')) {
            return true;
        }
    }

    public function checkPhpVersion(){
        if(version_compare(PHP_VERSION, '5.3', '<')) {
            return true;
        }
    }


}