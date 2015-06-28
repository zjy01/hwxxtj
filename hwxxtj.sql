-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 06 月 26 日 03:09
-- 服务器版本: 5.6.12-log
-- PHP 版本: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `hwxxtj`
--
CREATE DATABASE IF NOT EXISTS `hwxxtj` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `hwxxtj`;

-- --------------------------------------------------------

--
-- 表的结构 `device`
--

CREATE TABLE IF NOT EXISTS `device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doneTime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `proName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `useDate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `useTime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `people` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remark` text COLLATE utf8_unicode_ci NOT NULL,
  `device` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `captain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schoolYear` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `term` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `week` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `schedule`
--

INSERT INTO `schedule` (`id`, `doneTime`, `unit`, `proName`, `useDate`, `useTime`, `tel`, `people`, `place`, `remark`, `device`, `captain`, `schoolYear`, `term`, `week`) VALUES
(1, '2015/03/14', '思科信息学院', '测试', '2015/03/13', '08:00-14:00', '我/18819490079', '["2","17"]', '大会场', '2', '全部', '15', '2014-2015', '2', 1),
(2, '2015/03/14', '金融学院', '测试', '2015/03/13', '08:00-14:00', '我/18819490079', '["2","17"]', '大会场', '2', '全部', '15', '2014-2015', '2', 1),
(3, '2015/03/14', '加州', '测试', '2015/03/13', '08:00-14:00', '我/18819490079', '["2","17"]', '大会场', '2', '全部', '15', '2014-2015', '2', 1),
(7, '', '', '\r\n不知道', '2015/03/19', '08:00-19:00', '', '["16","17"]', '', '', '', '2', '2014-2015', '2', 1),
(14, '', '思科信息学院', '是俄hi', '2015/03/23', '07:00-06:00', '', '["19","20"]', '', '', '录像、投影仪、sdfs', '18', '2014-2015', '2', 2),
(15, '', '思科信息学院', '毕业晚会', '2015/06/16', '14:00-22:00', '杜文19983045436', '["19","20"]', '大会堂', '', '音响、投影仪、', '18', '2014-2015', '2', 14),
(16, '22', '', '45640', '2015/06/16', '10-12', '59595', '["19"]', '+98+98', '65656188', '', '18', '2014-2015', '2', 14);

-- --------------------------------------------------------

--
-- 表的结构 `special`
--

CREATE TABLE IF NOT EXISTS `special` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `part1` text COLLATE utf8_unicode_ci NOT NULL,
  `part2` text COLLATE utf8_unicode_ci NOT NULL,
  `part3` text COLLATE utf8_unicode_ci NOT NULL,
  `part4` text COLLATE utf8_unicode_ci NOT NULL,
  `part5` text COLLATE utf8_unicode_ci NOT NULL,
  `proName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `people` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remark` text COLLATE utf8_unicode_ci NOT NULL,
  `schoolYear` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `term` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `week` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `special`
--

INSERT INTO `special` (`id`, `part1`, `part2`, `part3`, `part4`, `part5`, `proName`, `people`, `place`, `remark`, `schoolYear`, `term`, `week`) VALUES
(1, '请大家做好安全工作，做好工作日志,在星期一交带签名的上星期的安全检查表，本周安全监督员：王芬', '实验室开放，请大家锁好门窗、做好设备清单登记', '梁俏/康翔可联系勤工俭学的学生参加，排在前面两位布场需要到场', '请做好大会堂、报告厅的活动使用情况登记', '请大家继续做好安全工作，安全排查不能放松。', '注意电器漏电、防火', '科室', '楼', '到各实验室检查安全情况', '2014-2015', '2', '1'),
(2, '请大家做好安全工作，做好工作日志,在星期一交带签名的上星期的安全检查表，本周安全监督员：王淑芬', '实验室开放，请大家锁好门窗、做好设备清单登记、日志登记、做好安全防火工作', '梁俏/康翔可联系勤工俭学的学生参加，排在前面两位布场需要到场，布场最多不超过3人，实验室人员一般情况下是在5点下课以后到场', '请做好大会堂、报告厅的活动使用情况登记，如有问题，请及时汇报', '请大家继续做好安全工作，安全排查不能放松。每周二上午9:30安全大检查', '注意电器漏电、防火，不要松懈、安全检查', '科室全体人员', '实验楼', '黄伟波、孟令春到各实验室检查安全情况', '2015-2016', '2', '1'),
(3, '请大家做好安全工作，做好工作日志,在星期一交带签名的上星期的安全检查表，本周安全监督员：王淑芬', '实验室开放，请大家锁好门窗、做好设备清单登记、日志登记、做好安全防火工作', '梁俏/康翔可联系勤工俭学的学生参加，排在前面两位布场需要到场，布场最多不超过3人，实验室人员一般情况下是在5点下课以后到场', '请做好大会堂、报告厅的活动使用情况登记，如有问题，请及时汇报', '请大家继续做好安全工作，安全排查不能放松。每周二上午9:30安全大检查', '注意电器漏电、防火，不要松懈、安全检查', '科室全体人员', '实验楼', '黄伟波、孟令春到各实验室检查安全情况', '2014-2015', '2', '2'),
(4, '请大家做好安全工作，做好工作日志,在星期一交带签名的上星期的安全检查表，本周安全监督员：王淑芬', '实验室开放，请大家锁好门窗、做好设备清单登记、日志登记、做好安全防火工作', '梁俏/康翔可联系勤工俭学的学生参加，排在前面两位布场需要到场，布场最多不超过3人，实验室人员一般情况下是在5点下课以后到场', '请做好大会堂、报告厅的活动使用情况登记，如有问题，请及时汇报', '请大家继续做好安全工作，安全排查不能放松。每周二上午9:30安全大检查', '注意电器漏电、防火，不要松懈、安全检查', '科室全体人员', '实验楼', '黄伟波、孟令春到各实验室检查安全情况', '', '', ''),
(5, '请大家做好安全工作，做好工作日志,在星期一交带签名的上星期的安全检查表，本周安全监督员：王淑芬', '实验室开放，请大家锁好门窗、做好设备清单登记、日志登记、做好安全防火工作', '梁俏/康翔可联系勤工俭学的学生参加，排在前面两位布场需要到场，布场最多不超过3人，实验室人员一般情况下是在5点下课以后到场', '请做好大会堂、报告厅的活动使用情况登记，如有问题，请及时汇报', '请大家继续做好安全工作，安全排查不能放松。每周二上午9:30安全大检查', '注意电器漏电、防火，不要松懈、安全检查', '科室全体人员', '实验楼', '黄伟波、孟令春到各实验室检查安全情况', '2014-2015', '2', '14');

-- --------------------------------------------------------

--
-- 表的结构 `unit`
--

CREATE TABLE IF NOT EXISTS `unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `unit`
--

INSERT INTO `unit` (`id`, `name`) VALUES
(1, '思科信息学院'),
(2, '金融学院'),
(3, '经贸学院'),
(4, '艺术学院');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(34) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `rank` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `number`, `rank`) VALUES
(1, '超级管理员', '96e79218965eb72c92a549dd5a330112', '88888888', 0),
(18, '梁俏', '96e79218965eb72c92a549dd5a330112', '201110077', 1),
(19, '康翔', '96e79218965eb72c92a549dd5a330112', '201110055', 1),
(20, '郭艾', '96e79218965eb72c92a549dd5a330112', '241054410', 1);

-- --------------------------------------------------------

--
-- 表的结构 `workcount`
--

CREATE TABLE IF NOT EXISTS `workcount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `useDate` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `useTime` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `workTime` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `proName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `worker` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `proId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=62 ;

--
-- 转存表中的数据 `workcount`
--

INSERT INTO `workcount` (`id`, `useDate`, `place`, `useTime`, `workTime`, `proName`, `worker`, `remark`, `proId`) VALUES
(4, '2015/03/13', '大会场', '12:00-14:00', '2.0', '测试', '15', '', 3),
(5, '2015/03/13', '大会场', '12:00-14:00', '2.0', '测试', '2', '', 3),
(6, '2015/03/13', '大会场', '12:00-14:00', '2.0', '测试', '17', '', 3),
(7, '2015/03/19', '', '12:00-14:00', '2.0', '周末加班', '17', '', 4),
(8, '2015/03/19', '', '12:00-14:00', '2.0', '周末加班', '15', '', 4),
(9, '2015/03/19', '', '12:00-14:00', '2.0', '周末加班', '16', '', 4),
(10, '2015/03/19', '', '12:00-14:00', '2.0', '周末加班', '18', '', 4),
(35, '2015/03/13', '大会场', '12:00-14:00', '2.0', '测试', '15', '', 1),
(36, '2015/03/13', '大会场', '12:00-14:00', '2.0', '测试', '2', '', 1),
(37, '2015/03/13', '大会场', '12:00-14:00', '2.0', '测试', '17', '', 1),
(38, '2015/03/13', '大会场', '12:00-14:00', '2.0', '测试', '15', '', 2),
(39, '2015/03/13', '大会场', '12:00-14:00', '2.0', '测试', '2', '', 2),
(40, '2015/03/13', '大会场', '12:00-14:00', '2.0', '测试', '17', '', 2),
(41, '2015/03/19', '', '12:00-14:00', '2.0', '', '17', '', 9),
(42, '2015/03/19', '', '12:00-14:00', '2.0', '', '15', '', 9),
(46, '2015/03/23', '', '无', '0.0', '是俄hi', '18', '', 14),
(47, '2015/03/23', '', '无', '0.0', '所得税', '16', '', 13),
(48, '2015/03/19', '', '12:00-14:00,17:30-19:00', '3.5', '山东分公司的公司', '2', '', 12),
(49, '2015/03/19', '', '12:00-14:00,17:30-19:00', '3.5', '山东分公司的公司', '15', '', 12),
(56, '2015/03/19', '', '12:00-14:00,17:30-19:00', '3.5', '不知道', '2', '', 8),
(57, '2015/03/19', '', '12:00-14:00,17:30-19:00', '3.5', '不知道', '16', '', 8),
(58, '2015/03/19', '', '12:00-14:00,17:30-19:00', '3.5', '不知道', '17', '', 8),
(59, '2015/06/16', '大会堂', '12:00-14:00', '2.0', '毕业晚会', '18', '', 15),
(60, '2015/06/16', '大会堂', '12:00-14:00', '2.0', '毕业晚会', '19', '', 15),
(61, '2015/06/16', '大会堂', '12:00-14:00', '2.0', '毕业晚会', '20', '', 15);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
