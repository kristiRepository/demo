<?php
require($_SERVER['DOCUMENT_ROOT'] . '/CheckinApp/database/Connection.php');
$config = require($_SERVER['DOCUMENT_ROOT'] . '/CheckinApp/config.php');
require($_SERVER['DOCUMENT_ROOT'] . '/CheckinApp/database/Query.php');


$conn = Connection::create($config);

$id = "";

if (!isset($_POST['id'])) {
    throw new Exception('Guest not identified');
}
$id = $_POST['id'];

$query = new Query(Connection::create($config));
$query->check($id);



$output = "success";
echo $output;
