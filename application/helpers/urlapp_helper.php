<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if ( ! function_exists('images_url'))
{
  function images_url($uri = '')
  {
    $CI =& get_instance();
    return base_url()."sources/img/".$uri;
  }
}

if ( ! function_exists('css_url'))
{
  function css_url($uri = '')
  {
    $CI =& get_instance();
    return base_url()."sources/css/".$uri;
  }
}

if ( ! function_exists('js_url'))
{
  function js_url($uri = '')
  {
    $CI =& get_instance();
    return base_url()."sources/js/".$uri;
  }
}