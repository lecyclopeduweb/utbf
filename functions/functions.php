<?php
/**
 * Use PHP class in function
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
use AppUtbf\Routes\Urls;

/**
 * Function Replace query args
 *
 * @param string $current_url           current Url
 * @param string $param                 Param
 * @param string $value                 value
 *
 * @return string
 */
function replace_query_arg(string $current_url, string $param,string $value):string
{
    $url = new Urls;
    return $url->replace_query_arg($current_url,$param,$value);
}