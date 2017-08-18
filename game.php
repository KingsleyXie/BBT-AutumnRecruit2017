<?php
header('Content-Type: application/json');
require_once('./config.php');

existCheck('passedRecord');
blankCheck('passedRecord');

$sql = '
UPDATE `game`
SET
`passed_number` = `passed_number` + 1
';
$stmt = $connect->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!empty($result)) response(1, '写入数据库失败');

response(0);
