<?php
require_once './config.php';

$stmt = $connect->prepare("
       SELECT name AS '部门名称',
       (
           SELECT COUNT(*)
           FROM `register`
           AS reg
           WHERE
           reg.department1 = departments.name
           OR
           reg.department2 = departments.name
       ) AS '报名总数',
       (
           SELECT COUNT(*)
           FROM `register`
           AS reg
           WHERE
           reg.department1 = departments.name
       ) AS '第一志愿报名人数',
       (
           SELECT COUNT(*)
           FROM `register`
           AS reg
           WHERE
           reg.gender = '男'
           AND
           reg.department1 = departments.name
       ) AS '第一志愿男生人数',
       (
           SELECT COUNT(*)
           FROM `register`
           AS reg
           WHERE
           reg.gender = '女'
           AND
           reg.department1 = departments.name
       ) AS '第一志愿女生人数',
       (
           SELECT COUNT(*)
           FROM `register`
           AS reg
           WHERE
           reg.department2 = departments.name
       ) AS '第二志愿报名人数',
       (
           SELECT COUNT(*)
           FROM `register`
           AS reg
           WHERE
           reg.gender = '男'
           AND
           reg.department2 = departments.name
       ) AS '第二志愿男生人数',
       (
           SELECT COUNT(*)
           FROM `register`
           AS reg
           WHERE
           reg.gender = '女'
           AND
           reg.department2 = departments.name
       ) AS '第二志愿女生人数',
       (
           SELECT COUNT(*)
           FROM `register`
           AS reg
           WHERE
           reg.gender = '男'
           AND
           (
               reg.department1 = departments.name
               OR
               reg.department2 = departments.name
           )
       ) AS '报名男生总数',
       (
           SELECT COUNT(*)
           FROM `register`
           AS reg
           WHERE
           reg.gender = '女'
           AND
           (
               reg.department1 = departments.name
               OR
               reg.department2 = departments.name
           )
       ) AS '报名女生总数'
       FROM `departments`");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (empty($result)) response(1, '获取数据失败');

print_r($result);
