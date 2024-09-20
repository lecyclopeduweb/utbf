<?php

declare (strict_types = 1);

namespace AppUtbf\Forms;

use AppUtbf\Forms\Register;
use AppUtbf\Forms\ChildsAccount;

/**
 * Forms Services Providers
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class FormsServiceProvider
{

    /**
     * {@inheritdoc}
     */
    public function boot()
    {

        new Register;
        new ChildsAccount;

    }

}
