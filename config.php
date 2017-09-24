<?php
/* --- Cofiguration Part Start --- */

//Close time of register system
$closeTime = '2017-09-21 00:00:00';

//Database Configurations:
$addr = 'localhost';			//Database Address
$dbname = 'autumn_recruit_2017';		//Database Name
$user = 'db_user_name';					//Username for Project Database
$password = 'corresponding_password';		//Password for Project Database

/* --- Cofiguration Part End --- */





//Database Connection based on PDO:
try {
	$connect = new PDO("mysql:host=$addr;dbname=$dbname;charset=utf8", $user, $password);
} catch(PDOException $ex) {
    response(2333, '数据库连接出错，请联系管理员');
}

//Return Code Process Function:
function response($code, $errMsg = 'Success') {
	echo json_encode(['code' => $code, 'errMsg' => $errMsg]);
	exit(0);
}

//Check whether required paraments exist or not
function existCheck() {
	for($i = 0; $i < func_num_args(); $i++) {
		if (!isset($_POST[func_get_arg($i)])) {
			header('Location: http://p1.img.cctvpic.com/20120409/images/1333902721891_1333902721891_r.jpg');
		}
	}
}

//Check if necessary paraments are blank
//Note: Uncommet the '=== 0' condition if necessary
function blankCheck() {
	for($i = 0; $i < func_num_args(); $i++) {
		if (($_POST[func_get_arg($i)] == '')/* OR ($_POST[func_get_arg($i)] === 0)*/) {
			response(233, '必填项中含有空值');
		}
	}
}





// Export data to csv file and auto download
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
