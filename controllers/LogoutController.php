<?php
use App\Classes\Redirect;
use App\Classes\SessionManager;

SessionManager::start();

$_SESSION = array();

SessionManager::destroy();

Redirect::redirect('/login')
?>