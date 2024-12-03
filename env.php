<?php
/**
 *  Env
 *
 *  @author  "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
//CACHE
define('UTBF_SCRIPTS_VERSION','nc4f3njzhfq4rtd');
//PROJET
define('UTBF_SITE_NAME','Une Tête Bien Faite' );
//URLS
define('UTBF_SITE_URL', get_site_url());
define('UTBF_ROOT_URL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http'). '://' . $_SERVER['HTTP_HOST']);
define('UTBF_CURRENT_URL', (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
define('UTBF_PARSE_URL', parse_url(UTBF_CURRENT_URL));
define('UTBF_PATH_URL', array_filter(explode('/',parse_url(UTBF_CURRENT_URL)['path'])));
//URI
define('UTBF_THEME_URI', site_url().'/wp-content/themes/'.basename(__DIR__));
define('UTBF_ASSETS_URI', UTBF_THEME_URI . '/assets');
define('UTBF_IMG_URI', UTBF_THEME_URI . '/img');
define('UTBF_TEMPLATES_URI', UTBF_THEME_URI . '/template-parts');
define('UTBF_UPLOAD_URI', wp_upload_dir()['baseurl']);
define('UTBF_DIVI_URI', UTBF_THEME_URI.'/divi');
//PATH
define('UTBF_THEME_PATH', dirname(__FILE__));
define('UTBF_APP_PATH', UTBF_THEME_PATH . '/app');
define('UTBF_ASSETS_PATH', UTBF_THEME_PATH. '/assets');
define('UTBF_IMG_PATH', UTBF_THEME_PATH. '/img');
define('UTBF_THEME_PARENT_PATH', get_template_directory());
define('UTBF_PATH_ACF_JSON', UTBF_THEME_PATH . '/app/ACF/fields-json');
define('UTBF_UPLOAD_PATH', wp_upload_dir()['basedir']);
define('UTBF_DIVI_PATH', UTBF_THEME_PATH . '/divi');
//TRAD
define('UTBF_TEXT_DOMAIN', 'divi-child');
//USERS SEARCH
define('UTBF_PPP_USERS_SEARCH', 10);
define('UTBF_PPP_ARRAY_USERS_SEARCH', [1,2,3,5,10]);
//USERS ORDERS
define('UTBF_PPP_USERS_ORDERS', 10);
define('UTBF_PPP_ARRAY_USERS_ORDERS', [1,2,3,5,10]);
///PRICES
define('UTBF_DECREASING_RATE_PERCENTAGE', 0);
define('UTBF_DAYCARE_PRICE', 2);
define('UTBF_CANTEEN_PRICE', 6);