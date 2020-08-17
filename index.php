

<?php

require('Request.php');
require('Router.php');



Router::load('routes.php')
    ->direct(Request::uri(), Request::method());

 