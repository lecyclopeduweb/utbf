<?php

declare (strict_types = 1);

namespace AppUtbf\Users;

/**
 * Users
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Users
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        add_action('init', [$this,'add_default_classroom']);
        add_action('init', [$this,'add_default_school']);

    }

    /**
     * Utilities
     *
     * Add default classroom in theme settings
     *
     * @return void
     */
    public function add_default_classroom():void
    {

        $theme_settings_classroom = get_option('options_theme_settings_classroom');
        if(empty($theme_settings_classroom)):
            $classrooms = [
                'Petite Section',
                'Moyenne Section',
                'Grande Section',
                'CP',
                'CE1',
                'CE2',
                'CM1',
                'CM2',
                '6ème',
                '5ème'
            ];
            foreach($classrooms as $key => $classroom):
                update_option('options_theme_settings_classroom_'.($key).'_classroom', $classroom);
            endforeach;
            update_option('options_theme_settings_classroom', count($classrooms));
        endif;

    }

    /**
     * Utilities
     *
     * Add default school in theme settings
     *
     * @return void
     */
    public function add_default_school():void
    {

        $theme_settings_school = get_option('options_theme_settings_school');
        if(empty($theme_settings_school)):
            $schools = [
                'Sainte Marie Saint Loup (10ème)',
                'Chevreul Champavier (5ème)',
                'Saint Barnabé (12ème)',
                'Saint Jean Baptiste (9ème)'
            ];
            foreach($schools as $key => $school):
                update_option('options_theme_settings_school_'.($key).'_school', $school);
            endforeach;
            update_option('options_theme_settings_school', count($schools));
        endif;

    }


}
