<?php



require($_SERVER['DOCUMENT_ROOT'] . '/CheckinApp/database/Connection.php');
require($_SERVER['DOCUMENT_ROOT'] . '/CheckinApp/database/Query.php');




class GuestController
{

    public function index()
    {
        require($_SERVER['DOCUMENT_ROOT'] . '/CheckinApp/views/main.php');
    }
}
