<?php

declare (strict_types = 1);

namespace AppUtbf\Routes;

/**
 * Urls
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Urls
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        add_action('edit_user_profile_update', [$this,'add_custom_param_to_user_edit_redirect']);

    }

    /**
     * Add custom param from url wp-admin/user-edit.php?user_id=
     *
     * @param int $user_id The user ID being updated.
     *
     * @return void
     */
    public function add_custom_param_to_user_edit_redirect($user_id)
    {

        $tab = isset($_POST['tab']) ? sanitize_text_field($_POST['tab']) : '';
        $p = isset($_POST['p']) ? sanitize_text_field($_POST['p']) : '';
        $ppp = isset($_POST['ppp']) ? sanitize_text_field($_POST['ppp']) : '';

        $redirect_url = admin_url('user-edit.php?user_id=' . $user_id);
        $redirect_url = add_query_arg('tab',  $tab, $redirect_url);
        if($tab == 'orders'):
            if(!empty($p)):
                $redirect_url = add_query_arg('p',  $p, $redirect_url);
            endif;
            if(!empty($ppp)):
                $redirect_url = add_query_arg('ppp',  $ppp, $redirect_url);
            endif;
        endif;

        wp_redirect($redirect_url);
        exit;

    }

    /**
     * Remove Query Arg Exceptions
     *
     * @param string $url                   url
     * @param string $params_to_keep        Params To Keep
     *
     * @return string
     */
    public function remove_query_arg_exceptions($url, $params_to_keep = []):string
    {

        $parsed_url = parse_url($url);
        if (isset($parsed_url['query'])):
            parse_str($parsed_url['query'], $query_params);
            $query_params = array_intersect_key($params_to_keep + $query_params, $params_to_keep);
            $parsed_url['query'] = http_build_query($query_params);
            if (!empty($parsed_url['query'])) :
                $parsed_url['query'] = '?' . $parsed_url['query'];
            endif;
        endif;
        return $parsed_url['scheme'] . '://' . $parsed_url['host'] . $parsed_url['path'] . $parsed_url['query'];

    }

    /**
     * Replace query args
     *
     * @param string $current_url           Current Url
     * @param string $param                 Param
     * @param string $value                 value
     *
     * @return string
     */
    public function replace_query_arg(string $current_url, string $param,string $value):string
    {

        $uriParts = parse_url($current_url);

        if (isset($uriParts['query']) && !empty($uriParts['query'])):
            parse_str($uriParts['query'], $queryParams);
        endif;

        $queryParams[$param] = $value;
        $newQueryString = http_build_query($queryParams);
        $newUrl = $uriParts['scheme'] . '://' . $uriParts['host'] . $uriParts['path'] . '?' . $newQueryString;

        return $newUrl;


    }


}