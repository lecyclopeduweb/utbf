<?php

declare (strict_types = 1);

namespace AppUtbf\Users;

/**
 * Childs
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Childs
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get Childs
     *
     * @return array
     */
    public function get_childs():array
    {

        $childs = [];

        $user_id = get_current_user_id();

        //Childs count
        $childs_repeater = get_field('user__childs_repeater', 'user_'.$user_id);
        $count = (!empty($childs_repeater)) ? ((is_array($childs_repeater))? count($childs_repeater) : $childs_repeater) : 0;

        for ($i = 1; $i <= $count; $i++):
            $nb = $i-1;
            $repeater = 'user__childs_repeater_'.$nb.'_';

            $childs[] = [
                'last_name'                 =>  get_user_meta($user_id, $repeater.'user__child__last_name',true),
                'first_name'                =>  get_user_meta($user_id, $repeater.'user__child__first_name',true),
                'classroom'                 =>  get_user_meta($user_id, $repeater.'user__child__classroom',true),
                'school'                    =>  get_user_meta($user_id, $repeater.'user__child__school',true),
                'other_school'              =>  get_user_meta($user_id, $repeater.'user__child__other_school',true),
                'birthday'                  =>  get_user_meta($user_id, $repeater.'user__child__birthday',true),
                'medical_treatments'        =>  get_user_meta($user_id, $repeater.'user__child__medical_treatments',true),
                'specific_aspects'          =>  get_user_meta($user_id, $repeater.'user__child__specific_aspects',true),
                'recommendations'           =>  get_user_meta($user_id, $repeater.'user__child__recommendations',true),
                'last_name_emergency'       =>  get_user_meta($user_id, $repeater.'user__child__last_name_emergency',true),
                'first_name_emergency'      =>  get_user_meta($user_id, $repeater.'user__child__first_name_emergency',true),
                'phone_emergency'           =>  get_user_meta($user_id, $repeater.'user__child__phone_emergency',true),
            ];

        endfor;

        return $childs;

    }


}
