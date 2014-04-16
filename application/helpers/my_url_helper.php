<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('css_url')) {
    function css_url($uri = '')
    {
        $CI = &get_instance();
        $css_string = "<link rel='stylesheet' type='text/css' href='" . $CI->config->
            base_url("/public/css" . $uri) . "'/>";
        return $css_string;
    }
}
if (!function_exists('js_url')) {
    function js_url($uri = '')
    {
        $CI = &get_instance();
        $javascript_string = "<script type='text/javascript' src='" . base_url("/public/js" .
            $uri) . "'></script>";
        return $javascript_string;
    }
}

if (!function_exists('image_url')) {
    function redirect_url($uri = '')
    {
        $CI = &get_instance();
        return $CI->config->base_url($uri);
    }
}

if (!function_exists('image_url')) {
    function image_url($uri = '')
    {
        $CI = &get_instance();
        return $CI->config->base_url("/views/css" . $uri);
    }
}


?>