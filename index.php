

<?php

require($_SERVER['DOCUMENT_ROOT'] . '/CheckinApp/Request.php');
require($_SERVER['DOCUMENT_ROOT'] . '/CheckinApp/Router.php');



Router::load('routes.php')
    ->direct(Request::uri(), Request::method());
