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
