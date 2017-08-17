CREATE DATABASE autumn_recruit_2017 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE autumn_recruit_2017;

CREATE TABLE `register`(
  `ID` INTEGER NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `gender` VARCHAR(5) NOT NULL,
  `college` VARCHAR(30) NOT NULL,
  `grade` VARCHAR(30) NOT NULL,
  `dorm` VARCHAR(10) NOT NULL,
  `tel` VARCHAR(11) NOT NULL,
  `department1` VARCHAR(30) NOT NULL,
  `department2` VARCHAR(30),
  `intro` VARCHAR(200),
  `register_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(`ID`),
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
