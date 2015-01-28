-- phpMyAdmin SQL Dump
-- version 2.8.0.1
-- http://www.phpmyadmin.net
-- 
-- 主机: custsql-ipg104.eigbox.net
-- 生成日期: 2015 年 01 月 27 日 11:53
-- 服务器版本: 5.5.40
-- PHP 版本: 4.4.9
-- 
-- 数据库: `user_auth_db`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `sr_users`
-- 

CREATE TABLE `sr_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pwHash` varchar(200) CHARACTER SET latin1 NOT NULL,
  `isTemp` varchar(5) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `sr_users`
-- 

INSERT INTO `sr_users` VALUES (1, 'wenqing', 'yu', 'email@email.com', '123456', '');
INSERT INTO `sr_users` VALUES (2, 'wenqin', 'afga', 'awe@asdg.com', '123456', '');
