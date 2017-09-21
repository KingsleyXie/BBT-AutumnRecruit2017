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
$result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (empty($result1)) response(1, '获取数据失败');

print_r($result1);

$stmt = $connect->prepare("
       SELECT
       DISTINCT department2
       AS '第二志愿部门',
       (
           SELECT COUNT(*)
           FROM `register`
           AS reg
           WHERE
           reg.gender = '男'
           AND
           reg.department2 = register.department2
       )
       AS '报名男生人数',
       (
           SELECT COUNT(*)
           FROM `register`
           AS reg
           WHERE
           reg.gender = '女'
           AND
           reg.department2 = register.department2
       )
       AS '报名女生人数' 
       FROM `register`");
$stmt->execute();
$result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (empty($result2)) response(1, '获取数据失败');

print_r($result2);
