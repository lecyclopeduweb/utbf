/**
 * Change display user-edit.php
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
(function($){
    $(document).ready(function(){

        /**
         * Redirect Menu UTBF
         *
         * @return {void}
         */
        function redirect_menu_utbf(){
            let baseUrl = window.location.origin;
            window.location.href = baseUrl+'/wp-admin/admin.php?page=utbf_users_search';
        }

        /**
         * Redirect Menu Global Analytics
         *
         * @return {void}
         */
        function redirect_menu_global_analytics(){
            let baseUrl = window.location.origin;
            window.location.href = baseUrl+'/wp-admin/';
        }

        /**
         * Events
         */
        if ($("body").hasClass('toplevel_page_menu_utbf')) {
            redirect_menu_utbf();
        }
        if ($("body").hasClass('utbf_page_utbf_global_analytics')) {
            redirect_menu_global_analytics();
        }

    });
}(jQuery));
