<?php
include('env.php');
include('autoload.php');

/**
 * App Services Providers
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
use AppUtbf\AppServiceProvider;

$AppServiceProvider = new AppServiceProvider;
$AppServiceProvider->boot();