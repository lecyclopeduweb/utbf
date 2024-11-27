<?php

declare (strict_types = 1);

namespace AppUtbf\CSV;

use AppUtbf\CSV\CSV;
use AppUtbf\CSV\Products;

/**
 * CSV Services Providers
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class CsvServiceProvider
{

    /**
     * {@inheritdoc}
     */
    public function boot()
    {

        new Products;

    }

}
