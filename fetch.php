<?php

require($_SERVER['DOCUMENT_ROOT'] . '/CheckinApp/database/Connection.php');
$config = require($_SERVER['DOCUMENT_ROOT'] . '/CheckinApp/config.php');

$conn = Connection::create($config);

$limit = 5;
$page = 1;




if ($_POST['page'] > 1) {
    $start = ((intval($_POST['page']) - 1) * $limit);
    $page = (intval($_POST['page']));
} else {
    $start = 0;
}

$query = "SELECT * FROM guests WHERE checked IS NULL";

if ($_POST['query'] != '') {
    $query .= " AND (name LIKE '%{$_POST['query']}%' OR surname LIKE '%{$_POST['query']}%')";
}



$query .= " ORDER BY name ASC";

$filter_query = $query . '  LIMIT ' . $start . ', ' . $limit . '';

$statment = $conn->prepare($query);
$statment->execute();

$total_data = $statment->rowCount();

$statment = $conn->prepare($filter_query);
$statment->execute();

$result = $statment->fetchAll();

$output = '<label>Total Records ' . $total_data . '</label>
<table class="table table-hover ">
<tr class="bg-secondary">
<th >Name</th>
<th>Surname</th>
<th>Action</th>
</tr>';


if ($total_data > 0) {

    foreach ($result as $row) {
        $output .= '
        <tr>
        <td>' . $row['name'] . '</td>
        <td>' . $row['surname'] . '</td>
        <td><button class="check btn btn-success" id="' . $row['id'] . '">Check</button></td>
        </tr>';
    }
} else {
    $output .= '
    <tr>
    <td colspan="2" align="center">No Data Found</td>
    </tr>';
}

$output .= '
</table>';

$total_links = ceil($total_data / $limit);

for ($i = 1; $i <= $total_links; $i++) {
    $output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid green;' id='" . $i . "'>" . $i . "</span>";
}


echo $output;
