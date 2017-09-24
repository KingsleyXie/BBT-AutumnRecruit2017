<?php
require_once '../config.php';

$stmt = $connect->prepare("
	SELECT name,
	(
		SELECT COUNT(*)
		FROM `register`
		AS reg
		WHERE
		reg.department1 = name
		OR
		reg.department2 = name
	),
	(
		SELECT COUNT(*)
		FROM `register`
		AS reg
		WHERE
		reg.gender = '男'
		AND
		(
			reg.department1 = name
			OR
			reg.department2 = name
		)
	),
	(
		SELECT COUNT(*)
		FROM `register`
		AS reg
		WHERE
		reg.gender = '女'
		AND
		(
			reg.department1 = name
			OR
			reg.department2 = name
		)
	),
	(
		SELECT COUNT(*)
		FROM `register`
		AS reg
		WHERE
		reg.department1 = name
	),
	(
		SELECT COUNT(*)
		FROM `register`
		AS reg
		WHERE
		reg.gender = '男'
		AND
		reg.department1 = name
	),
	(
		SELECT COUNT(*)
		FROM `register`
		AS reg
		WHERE
		reg.gender = '女'
		AND
		reg.department1 = name
	),
	(
		SELECT COUNT(*)
		FROM `register`
		AS reg
		WHERE
		reg.department2 = name
	),
	(
		SELECT COUNT(*)
		FROM `register`
		AS reg
		WHERE
		reg.gender = '男'
		AND
		reg.department2 = name
	),
	(
		SELECT COUNT(*)
		FROM `register`
		AS reg
		WHERE
		reg.gender = '女'
		AND
		reg.department2 = name
	)
	FROM `departments`");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (empty($result)) response(1, '获取数据失败');

$heads = ['部门名称', '报名总人数', '男生', '女生', '第一志愿总数', '第一志愿男生', '第一志愿女生', '第二志愿总数', '第二志愿男生', '第二志愿女生'];
csv_export($result, $heads, 'register_statistics');
