<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('currency_idr'))
{
  function currency_idr($number)
  {
    return 'Rp '.number_format($number,2,',','.');
  }
}