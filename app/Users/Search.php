<?php

declare (strict_types = 1);

namespace AppUtbf\Users;

/**
 * Search
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Search
{

    private $childs     = [];
    private $parents    = [];
    private $combined   = [];
    private $limite     = UTBF_PPP_USERS_SEARCH;
    private $paged      = 1;

    /**
     * __construct
     *
     *
     * @param int $limit Number of users to retrieve per page
     * @param int $paged Page to retrieve
     *
     * @return void
     */
    public function __construct(int $limite = UTBF_PPP_USERS_SEARCH, int $paged = 1)
    {

        $this->limite = $limite;
        $this->paged = $paged;

    }

    /**
     * Get childs
     *
     * @param string $s      Query Search
     *
     * @return self
     */
    public function childs(string $s):self
    {

        if(empty($s))
            return $this;

        global $wpdb;

        $search_pattern = implode('|', array_map('preg_quote', explode(' ', $s)));

        $query = "
            SELECT user_id
            FROM {$wpdb->usermeta}
            WHERE (
                (meta_key REGEXP 'user__childs_repeater_[0-999]+_user__child__first_name' AND meta_value REGEXP %s)
                OR
                (meta_key REGEXP 'user__childs_repeater_[0-999]+_user__child__last_name' AND meta_value REGEXP %s)
            )
            GROUP BY user_id
        ";

        $childs = $wpdb->get_col($wpdb->prepare($query, $search_pattern, $search_pattern));

        $this->childs = $childs;

        return $this;

    }

    /**
     * Get parents
     *
     * @param string  $s      Query Search
     *
     * @return self
     */
    public function parents(string $s):self
    {

        if(empty($s))
            return $this;

        global $wpdb;

        $search_pattern = implode('|', array_map('preg_quote', explode(' ', $s)));

        $query = "
            SELECT user_id
            FROM {$wpdb->usermeta}
            WHERE (
                (meta_key = 'first_name' AND meta_value REGEXP %s)
                OR
                (meta_key = 'last_name' AND meta_value REGEXP %s)
            )
            GROUP BY user_id
        ";

        $parents = $wpdb->get_col($wpdb->prepare($query, $search_pattern, $search_pattern));

        $this->parents = $parents;

        return $this;

    }

    /**
     * Remove duplicates from the parents and childs arrays
     *
     * @return self
     */
    public function removeDuplicates(): self
    {
        $combined = array_merge($this->parents, $this->childs);
        $combined = array_map("unserialize", array_unique(array_map("serialize", $combined)));

        $this->combined = $combined;

        return $this;
    }

    /**
     * Get mixed results
     *
     * @return self
     */
    public function getMixedResults(): self
    {

        $combined = (!empty($this->combined))? $this->combined : array_merge($this->parents, $this->childs);
        shuffle($combined);

        return $this;
    }


    /**
     * Get total users found
     *
     * @param string $s      Query Search
     *
     * @return int
     */
    public function getTotalUsers($s): int
    {

        return !empty($s) ? count($this->getUsersTotal()) : count(get_users(
            ['role__not_in' => ['administrator']]
        ));

    }


    /**
     * Get Users
     *
     * @return array
     */
    public function getUsers(): array
    {

        $users_ids = (!empty($this->combined))? $this->combined : [];

        $offset = ($this->paged - 1) * $this->limite;

        $args['number']         =  $this->limite;
        $args['offset']         =  $offset;
        $args['role__not_in']   =  ['administrator'];
        if(!empty($users_ids)):
            $args['include']    =  $users_ids;
        endif;

        $users = get_users($args);

        if(!empty($users)):
            foreach($users as $key => $user):
                $user_meta = get_user_meta($user->ID);
                $users[$key] = array_merge((array) $user, $user_meta);
            endforeach;
        endif;

        return $users;

    }

    /**
     * Get Users Total
     *
     * @return array
     */
    public function getUsersTotal(): array
    {

        $users_ids = (!empty($this->combined))? $this->combined : [];

        $args['role__not_in']   =  ['administrator'];
        if(!empty($users_ids)):
            $args['include']    =  $users_ids;
        endif;

        $users = get_users($args);

        if(!empty($users)):
            foreach($users as $key => $user):
                $user_meta = get_user_meta($user->ID);
                $users[$key] = array_merge((array) $user, $user_meta);
            endforeach;
        endif;

        return $users;

    }

    /**
     * Get combined
     *
     * @return array
     */
    public function getCombined(): array
    {

        return $this->combined;

    }

    /**
     * Set limite
     *
     * @param int $limit Number of users to retrieve per page
     *
     * @return self
     */
    public function setLimite(int $limite): self
    {

        $this->limite = $limite;

        return $this;

    }

    /**
     * Get limite
     *
     * @return int
     */
    public function getLimite(): int
    {

        $limite = $this->limite;

        return $limite;

    }

    /**
     * Set paged
     *
     * @param int $paged Page number to retrieve
     *
     * @return self
     */
    public function setPaged(int $paged): self
    {

        $this->paged = $paged;

        return $this;

    }

    /**
     * Get paged
     *
     * @return int
     */
    public function getPaged(): int
    {

        $paged = $this->paged;

        return $paged;

    }




}
