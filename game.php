<?php
header('Content-Type: application/json');
require_once('./config.php');

existCheck('passedRecord');
blankCheck('passedRecord');

if (substr($_POST['passedRecord'], 246, 1)) {
	$stmt = $connect->prepare('
		UPDATE `game`
		SET
		`passed_number` = `passed_number` + 1');
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	if (!empty($result)) response(1, '更新数据失败');
}

$stmt = $connect->prepare('
	SELECT *
	FROM `game`');
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (empty($result)) response(2, '获取数据失败');

echo json_encode(array('code' => 0, 'passedNo' => $result[0]['passed_number']));
