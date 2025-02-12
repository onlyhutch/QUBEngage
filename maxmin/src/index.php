<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
require('functions.inc.php');

$output = array(
	"error" => false,
  "items" => "",
	"attendance" => 0,
	"max_item" => "",
	"min_item" => ""
);

function checkForBlank($param): bool
{
    return empty($param) && $param !== '0';
}
if (checkForBlank($_REQUEST['item_1']) || checkForBlank($_REQUEST['item_2']) || checkForBlank($_REQUEST['item_3']) || checkForBlank($_REQUEST['item_4']) ||
    checkForBlank($_REQUEST['attendance_1']) || checkForBlank($_REQUEST['attendance_2']) || checkForBlank($_REQUEST['attendance_3']) || checkForBlank($_REQUEST['attendance_4'])) {

    $output['error'] = true;
    $output['message'] = 'Please do not leave blank parameters.';

    echo json_encode($output);
    exit();
}

$item_1 = $_REQUEST['item_1'];
$item_2 = $_REQUEST['item_2'];
$item_3 = $_REQUEST['item_3'];
$item_4 = $_REQUEST['item_4'];
$attendance_1 = $_REQUEST['attendance_1'];
$attendance_2 = $_REQUEST['attendance_2'];
$attendance_3 = $_REQUEST['attendance_3'];
$attendance_4 = $_REQUEST['attendance_4'];
$items = array($item_1, $item_2, $item_3, $item_4);
$attendances = array($attendance_1, $attendance_2, $attendance_3, $attendance_4);

if (!is_numeric($attendance_1) || !is_numeric($attendance_2) || !is_numeric($attendance_3) || !is_numeric($attendance_4)) {
    $output['error'] = true;
    $output['message'] = 'You must use integers from 0-9.';

    echo json_encode($output);
    exit();
}

$max_min_items = getMaxMin($items, $attendances);

$output['items'] = $items;
$output['attendance'] = $attendances;
$output['max_item'] = $max_min_items[0];
$output['min_item'] = $max_min_items[1];

echo json_encode($output);
exit();
