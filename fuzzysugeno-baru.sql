/*
Navicat MySQL Data Transfer

Source Server         : MYSQL
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : fuzzysugeno

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2014-12-24 10:00:37
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `area`
-- ----------------------------
DROP TABLE IF EXISTS `area`;
CREATE TABLE `area` (
  `area_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_area` varchar(100) NOT NULL DEFAULT '0',
  `fakultas_id` int(11) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`area_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of area
-- ----------------------------
INSERT INTO area VALUES ('1', 'Rektorat', '0', '2014-12-20 19:37:31');
INSERT INTO area VALUES ('2', 'Tugu Bunder', '0', '2014-12-20 19:37:37');
INSERT INTO area VALUES ('3', 'Perpustakaan Utama', '0', '2014-12-20 19:37:44');
INSERT INTO area VALUES ('4', 'Lapangan Rektorat', '0', '2014-12-20 19:38:07');
INSERT INTO area VALUES ('5', 'Parkir Teknik', '3', '2014-12-20 19:38:18');
INSERT INTO area VALUES ('6', 'Kantin Teknik ', '3', '2014-12-20 19:38:47');
INSERT INTO area VALUES ('7', 'Parkir Manajemen', '4', '2014-12-22 03:56:17');
INSERT INTO area VALUES ('8', 'Sakit', '1', '2014-12-23 15:32:30');

-- ----------------------------
-- Table structure for `fakultas`
-- ----------------------------
DROP TABLE IF EXISTS `fakultas`;
CREATE TABLE `fakultas` (
  `fakultas_id` int(11) NOT NULL AUTO_INCREMENT,
  `fakultas` varchar(150) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fakultas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fakultas
-- ----------------------------
INSERT INTO fakultas VALUES ('1', 'Hukum', '2014-12-11 06:56:46');
INSERT INTO fakultas VALUES ('2', 'Pertanian', '2014-12-11 06:57:04');
INSERT INTO fakultas VALUES ('3', 'Teknik', '2014-12-11 06:57:11');
INSERT INTO fakultas VALUES ('4', 'Ekonomi', '2014-12-11 06:57:17');
INSERT INTO fakultas VALUES ('5', 'Ilmu Bahasa Dan Budaya', '2014-12-11 06:57:32');
INSERT INTO fakultas VALUES ('6', 'Teknologi Informatika', '2014-12-11 06:57:54');
INSERT INTO fakultas VALUES ('7', 'MIPA', '2014-12-22 06:15:03');

-- ----------------------------
-- Table structure for `jurusan`
-- ----------------------------
DROP TABLE IF EXISTS `jurusan`;
CREATE TABLE `jurusan` (
  `jurusan_id` int(11) NOT NULL AUTO_INCREMENT,
  `jurusan` varchar(100) NOT NULL DEFAULT '0',
  `fakultas_id` int(11) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`jurusan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jurusan
-- ----------------------------
INSERT INTO jurusan VALUES ('1', 'Teknik Mesin', '3', '2014-12-11 07:24:21');
INSERT INTO jurusan VALUES ('2', 'Teknik Listrik', '3', '2014-12-11 07:24:30');
INSERT INTO jurusan VALUES ('3', 'Teknik Industri', '3', '2014-12-11 07:24:39');
INSERT INTO jurusan VALUES ('4', 'Teknik Metalurgi', '3', '2014-12-11 07:24:57');
INSERT INTO jurusan VALUES ('5', 'Hubungan International', '1', '2014-12-11 07:25:19');
INSERT INTO jurusan VALUES ('6', 'Hukum Syariah', '1', '2014-12-11 07:25:31');
INSERT INTO jurusan VALUES ('7', 'Biologi', '7', '2014-12-11 07:26:20');
INSERT INTO jurusan VALUES ('9', 'Teknik Informatika', '3', '2014-12-22 06:16:50');

-- ----------------------------
-- Table structure for `network`
-- ----------------------------
DROP TABLE IF EXISTS `network`;
CREATE TABLE `network` (
  `net_id` int(11) NOT NULL AUTO_INCREMENT,
  `area_id` int(11) DEFAULT '0',
  `jurusan_id` int(11) DEFAULT '0',
  `node_id` int(11) DEFAULT '0',
  `bandwidth` float DEFAULT '0',
  `jml_pelanggan` float DEFAULT '0',
  `pelayanan` float DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`net_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of network
-- ----------------------------
INSERT INTO network VALUES ('1', '1', '0', '0', '50', '60', '33.3', '2014-12-22 13:28:03');
INSERT INTO network VALUES ('2', '2', '3', '6', '20', '85', '66.6', '2014-12-22 13:28:09');
INSERT INTO network VALUES ('3', '4', '0', '4', '33.3', '70', '100', '2014-12-22 13:28:12');
INSERT INTO network VALUES ('4', '3', '2', '5', '60', '66', '66.6', '2014-12-22 07:22:45');
INSERT INTO network VALUES ('5', '5', '2', '3', '66.6', '50', '66.6', '2014-12-22 08:28:51');
INSERT INTO network VALUES ('6', '6', '0', '11', '70', '33', '33.3', '2014-12-22 13:28:15');
INSERT INTO network VALUES ('7', '6', '0', '14', '80', '25', '33.3', '2014-12-22 13:28:17');
INSERT INTO network VALUES ('8', '7', '0', '5', '100', '10', '100', '2014-12-20 18:17:12');
INSERT INTO network VALUES ('9', '7', '5', '0', '70', '25', '100', '2014-12-22 08:29:28');
INSERT INTO network VALUES ('10', '7', '5', '1', '100', '100', '100', '2014-12-22 06:42:13');
INSERT INTO network VALUES ('11', '2', '9', '0', '50', '100', '66.6', '2014-12-22 13:28:20');

-- ----------------------------
-- Table structure for `node`
-- ----------------------------
DROP TABLE IF EXISTS `node`;
CREATE TABLE `node` (
  `node_id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(255) NOT NULL DEFAULT '0',
  `posisi` varchar(255) NOT NULL DEFAULT '0',
  `lat` varchar(255) NOT NULL DEFAULT '0',
  `long` varchar(255) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `geom` geometrycollection NOT NULL,
  PRIMARY KEY (`node_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='titik jaringan';

-- ----------------------------
-- Records of node
-- ----------------------------
INSERT INTO node VALUES ('1', 'Titik utama Tugu Bunder', 'Diatas Tiang', '0', '0', '2014-12-11 07:18:43', '');
INSERT INTO node VALUES ('2', 'Titik Satu Tugu Bunder', 'Pintu masuk THP', '0', '0', '2014-12-11 07:19:22', '');
INSERT INTO node VALUES ('3', 'Titik Dua Tugu Bunder', 'Kantin Perpustakaan', '0', '0', '2014-12-11 07:19:43', '');
INSERT INTO node VALUES ('4', 'Titik Tiga', 'Parkiran FE', '0', '0', '2014-12-11 07:20:26', '');

-- ----------------------------
-- Table structure for `rules`
-- ----------------------------
DROP TABLE IF EXISTS `rules`;
CREATE TABLE `rules` (
  `rule_id` int(11) NOT NULL AUTO_INCREMENT,
  `rulename` varchar(50) NOT NULL DEFAULT '0',
  `trafik_jaringan_b` varchar(50) NOT NULL DEFAULT '0',
  `j_pelanggan_cmt` varchar(50) NOT NULL DEFAULT '0',
  `kualitas_ck` varchar(100) NOT NULL DEFAULT '0',
  `fuzzy_output` varchar(100) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`rule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rules
-- ----------------------------
INSERT INTO rules VALUES ('1', 'R1', 'Sedikit', 'Sedikit', 'Buruk', 'Upgrade', '2014-12-10 20:42:03');
INSERT INTO rules VALUES ('2', 'R2', 'Sedikit', 'Sedikit', 'Cukup', 'Upgrade', '2014-12-16 00:49:01');
INSERT INTO rules VALUES ('3', 'R3', 'Sedikit', 'Sedikit', 'Baik', 'Normal', '2014-12-16 00:53:44');
INSERT INTO rules VALUES ('4', 'R4', 'Sedikit', 'Sedang', 'Buruk', 'Upgrade', '2014-12-16 00:49:01');
INSERT INTO rules VALUES ('5', 'R5', 'Sedikit', 'Sedang', 'Cukup', 'Upgrade', '2014-12-16 00:49:01');
INSERT INTO rules VALUES ('6', 'R6', 'Sedikit', 'Sedang', 'Baik', 'Normal', '2014-12-16 00:53:44');
INSERT INTO rules VALUES ('7', 'R7', 'Sedikit', 'Banyak', 'Buruk', 'Upgrade', '2014-12-16 00:49:01');
INSERT INTO rules VALUES ('8', 'R8', 'Sedikit', 'Banyak', 'Cukup', 'Upgrade', '2014-12-16 00:49:01');
INSERT INTO rules VALUES ('9', 'R9', 'Sedikit', 'Banyak', 'Baik', 'Normal', '2014-12-16 00:53:44');
INSERT INTO rules VALUES ('10', 'R10', 'Sedang', 'Sedikit', 'Buruk', 'Upgrade', '2014-12-16 00:49:01');
INSERT INTO rules VALUES ('11', 'R11', 'Sedang', 'Sedikit', 'Cukup', 'Upgrade', '2014-12-16 00:49:01');
INSERT INTO rules VALUES ('12', 'R12', 'Sedang', 'Sedikit', 'Baik', 'Normal', '2014-12-16 00:53:44');
INSERT INTO rules VALUES ('13', 'R13', 'Sedang', 'Sedang', 'Buruk', 'Upgrade', '2014-12-16 00:50:49');
INSERT INTO rules VALUES ('14', 'R14', 'Sedang', 'Sedang', 'Cukup', 'Upgrade', '2014-12-16 00:50:49');
INSERT INTO rules VALUES ('15', 'R15', 'Sedang', 'Sedang', 'Baik', 'Normal', '2014-12-16 00:53:44');
INSERT INTO rules VALUES ('16', 'R16', 'Sedang', 'Banyak', 'Buruk', 'Upgrade', '2014-12-16 00:50:49');
INSERT INTO rules VALUES ('17', 'R17', 'Sedang', 'Banyak', 'Cukup', 'Upgrade', '2014-12-16 00:50:49');
INSERT INTO rules VALUES ('18', 'R18', 'Sedang', 'Banyak', 'Baik', 'Normal', '2014-12-16 00:53:44');
INSERT INTO rules VALUES ('19', 'R19', 'Banyak', 'Sedikit', 'Buruk', 'Upgrade', '2014-12-16 00:50:49');
INSERT INTO rules VALUES ('20', 'R20', 'Banyak', 'Sedikit', 'Cukup', 'Upgrade', '2014-12-16 00:50:49');
INSERT INTO rules VALUES ('21', 'R21', 'Banyak', 'Sedikit', 'Baik', 'Normal', '2014-12-16 00:53:44');
INSERT INTO rules VALUES ('22', 'R22', 'Banyak', 'Sedang', 'Buruk', 'Upgrade', '2014-12-16 00:50:49');
INSERT INTO rules VALUES ('23', 'R23', 'Banyak', 'Sedang', 'Cukup', 'Upgrade', '2014-12-16 00:50:49');
INSERT INTO rules VALUES ('24', 'R24', 'Banyak', 'Sedang', 'Baik', 'Normal', '2014-12-16 00:53:44');
INSERT INTO rules VALUES ('25', 'R25', 'Banyak', 'Banyak', 'Buruk', 'Upgrade', '2014-12-16 00:52:08');
INSERT INTO rules VALUES ('26', 'R26', 'Banyak', 'Banyak', 'Cukup', 'Upgrade', '2014-12-16 00:52:08');
INSERT INTO rules VALUES ('27', 'R27', 'Banyak', 'Banyak', 'Baik', 'Normal', '2014-12-16 00:53:44');

-- ----------------------------
-- View structure for `20-view-rulebase`
-- ----------------------------
DROP VIEW IF EXISTS `20-view-rulebase`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `20-view-rulebase` AS select `a`.`netid` AS `netid`,`a`.`b` AS `b`,`a`.`jml` AS `j`,`a`.`serv` AS `s`,`b`.`ruleid` AS `ruleid`,`b`.`rulename` AS `rulename`,`b`.`bw` AS `bw`,`b`.`jml` AS `jml`,`b`.`serv` AS `serv`,`b`.`fz` AS `fz`,(select `query-rules`.`ruleid` from `query-rules` order by `query-rules`.`ruleid` limit 1) AS `min`,(select `query-rules`.`ruleid` from `query-rules` order by `query-rules`.`ruleid` desc limit 1) AS `max` from (`query-himpunan` `a` join `query-rules` `b`) where (((`b`.`bw` = convert(if((`a`.`bwmin` = 1),'Sedikit','') using latin1)) or (`b`.`bw` = convert(if((`a`.`bwmid` = 1),'Sedang','') using latin1)) or (`b`.`bw` = convert(if((`a`.`bwmax` = 1),'Banyak','') using latin1))) and ((`b`.`jml` = convert(if((`a`.`jmlmin` = 1),'Sedikit','') using latin1)) or (`b`.`jml` = convert(if((`a`.`jmlmid` = 1),'Sedang','') using latin1)) or (`b`.`jml` = convert(if((`a`.`jmlmax` = 1),'Banyak','') using latin1))) and ((`b`.`serv` = convert(if((`a`.`servmin` = 1),'Buruk','') using latin1)) or (`b`.`serv` = convert(if((`a`.`servmid` = 1),'Cukup','') using latin1)) or (`b`.`serv` = convert(if((`a`.`servmax` = 1),'Baik','') using latin1)))) group by `b`.`ruleid`;

-- ----------------------------
-- View structure for `21-view-minmax-rule`
-- ----------------------------
DROP VIEW IF EXISTS `21-view-minmax-rule`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `21-view-minmax-rule` AS select `a`.`netid` AS `netid`,`a`.`ruleid` AS `ruleid`,`a`.`rulename` AS `rulename`,(select min(`20-view-rulebase`.`ruleid`) from `20-view-rulebase`) AS `rmin`,(select `20-view-rulebase`.`ruleid` from `20-view-rulebase` order by `20-view-rulebase`.`ruleid` desc limit 1) AS `rmax` from `20-view-rulebase` `a`;

-- ----------------------------
-- View structure for `22-view-rulebase`
-- ----------------------------
DROP VIEW IF EXISTS `22-view-rulebase`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `22-view-rulebase` AS select `a`.`netid` AS `netid`,`a`.`b` AS `b`,`a`.`jml` AS `cmt`,`a`.`serv` AS `ck`,`b`.`ruleid` AS `ruleid`,`b`.`rulename` AS `rulename`,`b`.`bw` AS `bw`,`b`.`jml` AS `jml`,`b`.`serv` AS `serv`,`b`.`fz` AS `fz` from (`query-himpunan` `a` join `query-rules` `b`) where (((`b`.`bw` = convert(if((`a`.`bwmin` = 1),'Sedikit',0) using latin1)) or (`b`.`bw` = convert(if((`a`.`bwmid` = 1),'Sedang',0) using latin1)) or (`b`.`bw` = convert(if((`a`.`bwmax` = 1),'Banyak',0) using latin1))) and ((`b`.`jml` = convert(if((`a`.`jmlmin` = 1),'Sedikit',0) using latin1)) or (`b`.`jml` = convert(if((`a`.`jmlmid` = 1),'Sedang',0) using latin1)) or (`b`.`jml` = convert(if((`a`.`jmlmax` = 1),'Banyak',0) using latin1))) and ((`b`.`serv` = convert(if((`a`.`servmin` = 1),'Buruk',0) using latin1)) or (`b`.`serv` = convert(if((`a`.`servmid` = 1),'Cukup',0) using latin1)) or (`b`.`serv` = convert(if((`a`.`servmax` = 1),'Baik',0) using latin1)))) order by `a`.`netid`,`b`.`ruleid`;

-- ----------------------------
-- View structure for `23-view-ruleminmax`
-- ----------------------------
DROP VIEW IF EXISTS `23-view-ruleminmax`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `23-view-ruleminmax` AS select `a`.`netid` AS `netid`,`a`.`b` AS `b`,`a`.`cmt` AS `cmt`,`a`.`ck` AS `ck`,min(`a`.`ruleid`) AS `rmin`,max(`a`.`ruleid`) AS `rmax` from `22-view-rulebase` `a`;

-- ----------------------------
-- View structure for `24-view-querynya`
-- ----------------------------
DROP VIEW IF EXISTS `24-view-querynya`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `24-view-querynya` AS select `b`.`netid` AS `netid`,`b`.`b` AS `b`,`b`.`cmt` AS `cmt`,`b`.`ck` AS `ck`,`b`.`ruleid` AS `ruleid`,`b`.`rulename` AS `rulename`,`b`.`bw` AS `bw`,`b`.`jml` AS `jml`,`b`.`serv` AS `serv`,`b`.`fz` AS `fz`,`a`.`rmin` AS `rmin`,`a`.`rmax` AS `rmax` from (`23-view-ruleminmax` `a` join `22-view-rulebase` `b` on((`a`.`netid` = `b`.`netid`))) where (`b`.`netid` = 5);

-- ----------------------------
-- View structure for `query-fuzzy-final`
-- ----------------------------
DROP VIEW IF EXISTS `query-fuzzy-final`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `query-fuzzy-final` AS select `a`.`id` AS `id`,`a`.`bw` AS `bw`,`a`.`jml` AS `jml`,`a`.`serv` AS `serv`,`a`.`fz` AS `fz`,`a`.`min` AS `min`,`a`.`WA` AS `WA`,(`a`.`fo_bawah` / `a`.`fo_atas`) AS `fuzzy` from `query-sum-weighted` `a`;

-- ----------------------------
-- View structure for `query-fuzzy-output`
-- ----------------------------
DROP VIEW IF EXISTS `query-fuzzy-output`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `query-fuzzy-output` AS select `a`.`id` AS `id`,`a`.`bw` AS `bw`,`a`.`jml` AS `jml`,`a`.`serv` AS `serv`,`a`.`fz` AS `fz`,`a`.`min` AS `min`,`a`.`WA` AS `WA`,if(((`a`.`fuzzy` >= 0) and (`a`.`fuzzy` <= 10)),'Normal',if(((`a`.`fuzzy` > 10) and (`a`.`fuzzy` <= 100)),'Upgrade','')) AS `fuzzy_output` from `query-fuzzy-final` `a`;

-- ----------------------------
-- View structure for `query-himpunan`
-- ----------------------------
DROP VIEW IF EXISTS `query-himpunan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `query-himpunan` AS select `a`.`netid` AS `netid`,`a`.`b` AS `b`,`b`.`jml` AS `jml`,`c`.`serv` AS `serv`,`a`.`sedikit` AS `bwmin`,`a`.`sedang` AS `bwmid`,`a`.`banyak` AS `bwmax`,`b`.`sedikit` AS `jmlmin`,`b`.`sedang` AS `jmlmid`,`b`.`banyak` AS `jmlmax`,`c`.`buruk` AS `servmin`,`c`.`cukup` AS `servmid`,`c`.`baik` AS `servmax` from ((`query-rule-bandwidth` `a` join `query-rule-pelanggan` `b` on((`a`.`netid` = `b`.`netid`))) join `query-rule-pelayanan` `c` on((`c`.`netid` = `a`.`netid`)));

-- ----------------------------
-- View structure for `query-rule-bandwidth`
-- ----------------------------
DROP VIEW IF EXISTS `query-rule-bandwidth`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `query-rule-bandwidth` AS select `a`.`net_id` AS `netid`,`a`.`bandwidth` AS `b`,if((((`a`.`bandwidth` >= 0) and (`a`.`bandwidth` < 66.6)) or (`a`.`bandwidth` = 33.3)),1,0) AS `sedikit`,if((((`a`.`bandwidth` >= 33.3) and (`a`.`bandwidth` < 100)) or (`a`.`bandwidth` = 66.6)),1,0) AS `sedang`,if((((`a`.`bandwidth` >= 66.6) and (`a`.`bandwidth` < 100)) or (`a`.`bandwidth` = 100)),1,0) AS `banyak` from `network` `a`;

-- ----------------------------
-- View structure for `query-rule-pelanggan`
-- ----------------------------
DROP VIEW IF EXISTS `query-rule-pelanggan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `query-rule-pelanggan` AS select `a`.`net_id` AS `netid`,`a`.`jml_pelanggan` AS `jml`,if((((`a`.`jml_pelanggan` >= 0) and (`a`.`jml_pelanggan` < 66.6)) or (`a`.`jml_pelanggan` = 33.3)),1,0) AS `sedikit`,if((((`a`.`jml_pelanggan` >= 33.3) and (`a`.`jml_pelanggan` < 100)) or (`a`.`jml_pelanggan` = 66.6)),1,0) AS `sedang`,if((((`a`.`jml_pelanggan` >= 66.6) and (`a`.`jml_pelanggan` < 100)) or (`a`.`jml_pelanggan` = 100)),1,0) AS `banyak` from `network` `a`;

-- ----------------------------
-- View structure for `query-rule-pelayanan`
-- ----------------------------
DROP VIEW IF EXISTS `query-rule-pelayanan`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `query-rule-pelayanan` AS select `a`.`net_id` AS `netid`,`a`.`pelayanan` AS `serv`,if((((`a`.`pelayanan` >= 0) and (`a`.`pelayanan` < 66.6)) or (`a`.`pelayanan` = 33.3)),1,0) AS `buruk`,if((((`a`.`pelayanan` > 33.3) and (`a`.`pelayanan` < 100)) or (`a`.`pelayanan` = 66.6)),1,0) AS `cukup`,if((((`a`.`pelayanan` >= 66.6) and (`a`.`pelayanan` < 100)) or (`a`.`pelayanan` = 100)),1,0) AS `baik` from `network` `a`;

-- ----------------------------
-- View structure for `query-rules`
-- ----------------------------
DROP VIEW IF EXISTS `query-rules`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `query-rules` AS select `a`.`rule_id` AS `ruleid`,`a`.`rulename` AS `rulename`,`a`.`trafik_jaringan_b` AS `bw`,`a`.`j_pelanggan_cmt` AS `jml`,`a`.`kualitas_ck` AS `serv`,`a`.`fuzzy_output` AS `fz` from `rules` `a`;

-- ----------------------------
-- View structure for `query-sum-weighted`
-- ----------------------------
DROP VIEW IF EXISTS `query-sum-weighted`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `query-sum-weighted` AS select `query-weighted`.`id` AS `id`,`query-weighted`.`ruleid` AS `ruleid`,`query-weighted`.`rulename` AS `rulename`,`query-weighted`.`bw` AS `bw`,`query-weighted`.`jml` AS `jml`,`query-weighted`.`serv` AS `serv`,`query-weighted`.`fz` AS `fz`,`query-weighted`.`min` AS `min`,`query-weighted`.`WA` AS `WA`,sum(`query-weighted`.`min`) AS `fo_atas`,sum((`query-weighted`.`WA` * `query-weighted`.`min`)) AS `fo_bawah` from `query-weighted` group by `query-weighted`.`id`;

-- ----------------------------
-- View structure for `query-weighted`
-- ----------------------------
DROP VIEW IF EXISTS `query-weighted`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `query-weighted` AS select `a`.`id` AS `id`,`a`.`ruleid` AS `ruleid`,`a`.`rulename` AS `rulename`,`a`.`bw` AS `bw`,`a`.`jml` AS `jml`,`a`.`serv` AS `serv`,`a`.`fz` AS `fz`,least(`a`.`alpha_bw`,`a`.`alpha_jml`,`a`.`alpha_serv`) AS `min`,if((`a`.`fz` = 'Normal'),10,100) AS `WA` from `view-query-predikat` `a`;

-- ----------------------------
-- View structure for `view-network`
-- ----------------------------
DROP VIEW IF EXISTS `view-network`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view-network` AS select `a`.`net_id` AS `netid`,`a`.`node_id` AS `nodeid`,`b`.`nama_area` AS `area`,`d`.`fakultas` AS `fakultas`,`c`.`jurusan` AS `jurusan`,`a`.`bandwidth` AS `bw`,`a`.`jml_pelanggan` AS `jml`,`a`.`pelayanan` AS `serv` from (((`network` `a` left join `area` `b` on((`b`.`area_id` = `a`.`area_id`))) left join `jurusan` `c` on((`c`.`jurusan_id` = `a`.`jurusan_id`))) left join `fakultas` `d` on((`d`.`fakultas_id` = `b`.`fakultas_id`)));

-- ----------------------------
-- View structure for `view-network-fuzzy`
-- ----------------------------
DROP VIEW IF EXISTS `view-network-fuzzy`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view-network-fuzzy` AS select `view-network`.`netid` AS `netid`,`view-network`.`nodeid` AS `nodeid`,`view-network`.`area` AS `area`,`view-network`.`fakultas` AS `fakultas`,`view-network`.`jurusan` AS `jurusan`,`view-network`.`bw` AS `bw`,`view-network`.`jml` AS `jml`,`view-network`.`serv` AS `serv`,`query-fuzzy-output`.`fuzzy_output` AS `fuzzy_output` from (`view-network` join `query-fuzzy-output` on((`query-fuzzy-output`.`id` = `view-network`.`netid`)));

-- ----------------------------
-- View structure for `view-query-fuzzy-value`
-- ----------------------------
DROP VIEW IF EXISTS `view-query-fuzzy-value`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view-query-fuzzy-value` AS select `a`.`netid` AS `netid`,`a`.`b` AS `b`,`b`.`jml` AS `cmt`,`c`.`serv` AS `cks`,if((`a`.`sedikit` = 1),round((`a`.`b` / 33.3),2),0) AS `bwmin`,if((`a`.`sedang` = 1),round(((100 - `a`.`b`) / 33.3),2),0) AS `bwmid`,if((`a`.`banyak` = 1),round(((`a`.`b` - 66.6) / 33.3),2),0) AS `bwmax`,if((`b`.`sedikit` = 1),round((`b`.`jml` / 33.3),2),0) AS `jmlmin`,if((`b`.`sedang` = 1),round(((100 - `b`.`jml`) / 33.3),2),0) AS `jmlmid`,if((`b`.`banyak` = 1),round(((`b`.`jml` - 66.6) / 33.3),2),0) AS `jmlmax`,if((`c`.`buruk` = 1),round((`c`.`serv` / 33.3),2),0) AS `servmin`,if((`c`.`cukup` = 1),round(((100 - `c`.`serv`) / 33.3),2),0) AS `servmid`,if((`c`.`baik` = 1),round(((`c`.`serv` - 66.6) / 33.3),2),0) AS `servmax` from ((`query-rule-bandwidth` `a` join `query-rule-pelanggan` `b` on((`b`.`netid` = `a`.`netid`))) join `query-rule-pelayanan` `c` on((`c`.`netid` = `a`.`netid`)));

-- ----------------------------
-- View structure for `view-query-predikat`
-- ----------------------------
DROP VIEW IF EXISTS `view-query-predikat`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view-query-predikat` AS select `a`.`netid` AS `id`,`b`.`ruleid` AS `ruleid`,`b`.`rulename` AS `rulename`,`b`.`b` AS `bw`,`b`.`j` AS `jml`,`b`.`s` AS `serv`,if((`b`.`bw` = 'Sedikit'),`a`.`bwmin`,if((`b`.`bw` = 'Sedang'),`a`.`bwmid`,`a`.`bwmax`)) AS `alpha_bw`,if((`b`.`jml` = 'Sedikit'),`a`.`jmlmin`,if((`b`.`jml` = 'Sedang'),`a`.`jmlmid`,if((`b`.`jml` = 'Banyak'),`a`.`jmlmax`,''))) AS `alpha_jml`,if((`b`.`serv` = 'Buruk'),`a`.`servmin`,if((`b`.`serv` = 'Cukup'),`a`.`servmid`,`a`.`servmax`)) AS `alpha_serv`,`b`.`fz` AS `fz` from (`view-query-fuzzy-value` `a` left join `view-query-rulebase` `b` on((`a`.`netid` = `b`.`netid`)));

-- ----------------------------
-- View structure for `view-query-rulebase`
-- ----------------------------
DROP VIEW IF EXISTS `view-query-rulebase`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view-query-rulebase` AS select `a`.`netid` AS `netid`,`a`.`b` AS `b`,`a`.`jml` AS `j`,`a`.`serv` AS `s`,`b`.`ruleid` AS `ruleid`,`b`.`rulename` AS `rulename`,`b`.`bw` AS `bw`,`b`.`jml` AS `jml`,`b`.`serv` AS `serv`,`b`.`fz` AS `fz` from (`query-himpunan` `a` join `query-rules` `b`) where (((`b`.`bw` = convert(if((`a`.`bwmin` = 1),'Sedikit','') using latin1)) or (`b`.`bw` = convert(if((`a`.`bwmid` = 1),'Sedang','') using latin1)) or (`b`.`bw` = convert(if((`a`.`bwmax` = 1),'Banyak','') using latin1))) and ((`b`.`jml` = convert(if((`a`.`jmlmin` = 1),'Sedikit','') using latin1)) or (`b`.`jml` = convert(if((`a`.`jmlmid` = 1),'Sedang','') using latin1)) or (`b`.`jml` = convert(if((`a`.`jmlmax` = 1),'Banyak','') using latin1))) and ((`b`.`serv` = convert(if((`a`.`servmin` = 1),'Buruk','') using latin1)) or (`b`.`serv` = convert(if((`a`.`servmid` = 1),'Cukup','') using latin1)) or (`b`.`serv` = convert(if((`a`.`servmax` = 1),'Baik','') using latin1)))) order by `a`.`netid`,`b`.`ruleid`;
