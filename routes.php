<?php

$router->get('', 'GuestController@index');
$router->post('guest', 'GuestController@checkGuest');
