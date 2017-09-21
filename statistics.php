<?php
require_once './config.php';

$stmt = $connect->prepare("
       SELECT
       DISTINCT department1
       AS '第一志愿部门',
       (
           SELECT COUNT(*)
           FROM `register`
           AS reg
           WHERE
           reg.gender = '男'
           AND
           reg.department1 = register.department1
       )
       AS '报名男生人数',
       (
           SELECT COUNT(*)
           FROM `register`
           AS reg
           WHERE
           reg.gender = '女'
           AND
           reg.department1 = register.department1
       )
       AS '报名女生人数' 
       FROM `register`");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (empty($result)) response(1, '获取数据失败');

print_r($result);