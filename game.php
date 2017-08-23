<?php
header('Content-Type: application/json');
require_once('./config.php');

existCheck('passedRecord');
blankCheck('passedRecord');

if (substr($_POST['passedRecord'], 246, 1) && !($connect->query('
	UPDATE `game`
	SET
	`passed_number` = `passed_number` + 1')))
	response(1, '更新数据失败');

if (!($connect->query('
	UPDATE `game`
	SET
	`participate_number` = `participate_number` + 1')))
	response(2, '更新数据失败');

$stmt = $connect->prepare('
       SELECT passed_number
       FROM `game`');
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (empty($result)) response(3, '获取数据失败');

echo json_encode(array('code' => 0, 'passedNo' => $result[0]['passed_number']));
