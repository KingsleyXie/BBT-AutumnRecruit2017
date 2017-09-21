<?php
require_once './config.php';

$stmt = $connect->prepare('
       SELECT *
       FROM `register`');
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (empty($result)) response(1, '获取数据失败');

$heads = ['报名序号', '姓名', '性别', '学院', '年级', '宿舍', '联系方式', '第一志愿', '第二志愿', '接受调剂', '自我介绍', '提交时间'];
csv_export($result, $heads, 'regsiter_data');





// Source: https://segmentfault.com/a/1190000005366832
function csv_export($data = array(), $headlist = array(), $fileName) {
	header('Content-Type: text/csv');
	header('Content-Disposition: attachment;filename="'.$fileName.'.csv"');
	header('Cache-Control: max-age=0');

	$fp = fopen('php://output', 'a');

	foreach ($headlist as $key => $value) {
		$headlist[$key] = iconv('utf-8', 'gbk', $value);
	}
	fputcsv($fp, $headlist);

	$num = 0;
	$limit = 100000;
	$count = count($data);
	for ($i = 0; $i < $count; $i++) {
		$num++;
		if ($limit == $num) { 
			ob_flush();
			flush();
			$num = 0;
		}
		$row = $data[$i];
		foreach ($row as $key => $value) {
			$row[$key] = iconv('utf-8', 'gbk', $value);
		}
		fputcsv($fp, $row);
	}
}
