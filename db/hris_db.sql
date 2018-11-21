/*
SQLyog Ultimate v12.4.1 (64 bit)
MySQL - 5.1.30-community : Database - hris_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `attachment_tbl` */

DROP TABLE IF EXISTS `attachment_tbl`;

CREATE TABLE `attachment_tbl` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `tbl_data` varchar(100) DEFAULT NULL COMMENT 'qlue_tbl',
  `data_pk` int(11) DEFAULT NULL,
  `attachment_name` varchar(100) DEFAULT NULL,
  `attachment_size` int(11) DEFAULT NULL,
  `attachment_type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `attachment_tbl` */

/*Table structure for table `employee_competencies` */

DROP TABLE IF EXISTS `employee_competencies`;

CREATE TABLE `employee_competencies` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `EMPLOYEE_ID` varchar(30) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `employee_competencies` */

/*Table structure for table `employee_discliplinary_tbl` */

DROP TABLE IF EXISTS `employee_discliplinary_tbl`;

CREATE TABLE `employee_discliplinary_tbl` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `EMPLOYEE_ID` varchar(30) DEFAULT NULL,
  `SP` varchar(100) DEFAULT NULL,
  `VALID_FROM` date DEFAULT NULL,
  `VALID_TO` date DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `employee_discliplinary_tbl` */

/*Table structure for table `employee_pa_tbl` */

DROP TABLE IF EXISTS `employee_pa_tbl`;

CREATE TABLE `employee_pa_tbl` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(4) DEFAULT NULL,
  `EMPLOYEE_ID` varchar(30) DEFAULT NULL,
  `score` decimal(5,2) DEFAULT '0.00',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `employee_pa_tbl` */

/*Table structure for table `employee_position_tbl` */

DROP TABLE IF EXISTS `employee_position_tbl`;

CREATE TABLE `employee_position_tbl` (
  `COMPANY_ID` varchar(30) DEFAULT NULL,
  `EMPLOYEE_ID` varchar(20) DEFAULT NULL,
  `POSITION_ID` varchar(10) DEFAULT NULL,
  `PRIMARY_POSITION` varchar(3) DEFAULT NULL,
  `VALID_FROM` date DEFAULT NULL,
  `VALID_TO` date DEFAULT NULL,
  `GOLID` int(11) NOT NULL DEFAULT '0',
  `GOLVERSION` int(11) DEFAULT NULL,
  PRIMARY KEY (`GOLID`),
  UNIQUE KEY `EMP_POS` (`EMPLOYEE_ID`,`POSITION_ID`,`VALID_TO`,`GOLID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `employee_position_tbl` */

/*Table structure for table `employee_profile_tbl` */

DROP TABLE IF EXISTS `employee_profile_tbl`;

CREATE TABLE `employee_profile_tbl` (
  `cid` int(11) DEFAULT NULL,
  `EMPLOYEE_ID` varchar(30) DEFAULT NULL,
  `profile_type` varchar(100) DEFAULT NULL COMMENT 'Strength, Weakness',
  `subject` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `employee_profile_tbl` */

/*Table structure for table `friendly_url_tbl` */

DROP TABLE IF EXISTS `friendly_url_tbl`;

CREATE TABLE `friendly_url_tbl` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(100) DEFAULT NULL,
  `script` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `friendly_url_tbl` */

insert  into `friendly_url_tbl`(`cid`,`page`,`script`) values 
(1,'login','page_login.php'),
(2,'logout','page_logout.php'),
(3,'',''),
(4,'forgot-password','page_forgot_password.php');

/*Table structure for table `log_tbl` */

DROP TABLE IF EXISTS `log_tbl`;

CREATE TABLE `log_tbl` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `EMPLOYEE_ID` int(11) DEFAULT NULL,
  `form_name` varchar(50) DEFAULT NULL,
  `tbl_data` varchar(100) DEFAULT NULL,
  `log_date` datetime DEFAULT NULL,
  `log_action` varchar(50) DEFAULT NULL,
  `description` text,
  `email` text,
  `subject` text,
  `content` text,
  `log_status` text,
  `ipuser` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `log_tbl` */

/*Table structure for table `menu_tbl` */

DROP TABLE IF EXISTS `menu_tbl`;

CREATE TABLE `menu_tbl` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(50) DEFAULT NULL,
  `menu_group` varchar(50) DEFAULT NULL,
  `menu_root` int(11) DEFAULT NULL,
  `menu_url` varchar(100) DEFAULT NULL,
  `content` text,
  `first_cursor` varchar(100) DEFAULT NULL,
  `sort_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `menu_tbl` */

insert  into `menu_tbl`(`menu_id`,`menu_name`,`menu_group`,`menu_root`,`menu_url`,`content`,`first_cursor`,`sort_by`) values 
(1,'Profil Human Capital','MENU PORTAL',0,'',NULL,'',1),
(2,'Profil XYZ','MENU PORTAL',0,'',NULL,'',2),
(3,'Struktur Human Capital','MENU PORTAL',0,'',NULL,'',3),
(4,'Contact Us','MENU PORTAL',0,'contact-us.php','','',4),
(5,'Latar Belakang','MENU PORTAL',1,'',NULL,'',1),
(6,'Fungsi Strategis','MENU PORTAL',1,'',NULL,'',2),
(7,'Visi & Misi','MENU PORTAL',1,'',NULL,'',3),
(8,'Sasaran Strategis','MENU PORTAL',1,'',NULL,'',4),
(9,'Strategi Kerja','MENU PORTAL',1,'',NULL,'',5),
(10,'Sejarah Perusahaan','MENU PORTAL',2,'',NULL,'',1),
(11,'Visi & Misi','MENU PORTAL',2,'',NULL,'',2),
(12,'Profil Direksi','MENU PORTAL',2,'',NULL,'',3),
(13,'Struktur Organisasi','MENU PORTAL',2,'',NULL,'',4),
(14,'HC Division 1','MENU PORTAL',3,'',NULL,'',1),
(15,'HC Division 2','MENU PORTAL',3,'',NULL,'',2),
(16,'HC Division 3','MENU PORTAL',3,'hc-business-partner.php',NULL,'',3),
(17,'Setting','MENU PROFILE',0,'setting.php',NULL,'',1),
(18,'Change Password','MENU PROFILE',0,'change-password.php',NULL,'v_change_password_password_old',2),
(19,'Lock','MENU PROFILE',0,'lock.php',NULL,'v_lock_password',3),
(20,'Role Access','ADMIN',27,'admin_role_access.php',NULL,'q_role_access',1),
(21,'Setup Email','ADMIN',27,'admin_setup_email.php',NULL,'',2),
(22,'List User','ADMIN',27,'admin_user.php',NULL,'',3),
(23,'List Menu','ADMIN',27,'admin_menu.php','','q_menu',4),
(24,'List Log','ADMIN',27,'admin_log.php',NULL,'',5),
(27,'ADMIN','ADMIN',0,'',NULL,'',99),
(25,'TALENT CARD','TALENT CARD',0,'','','',1),
(26,'List Talent Card','TALENT CARD',25,'talent_card.php',NULL,'',1);

/*Table structure for table `reset_tbl` */

DROP TABLE IF EXISTS `reset_tbl`;

CREATE TABLE `reset_tbl` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `reset_id` varchar(32) DEFAULT NULL,
  `reset_date` datetime DEFAULT NULL,
  `EMPLOYEE_ID` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status_reset` varchar(100) DEFAULT NULL COMMENT 'open, used',
  `VALID_FROM` date DEFAULT NULL,
  `VALID_TO` date DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `reset_tbl` */

insert  into `reset_tbl`(`cid`,`reset_id`,`reset_date`,`EMPLOYEE_ID`,`email`,`status_reset`,`VALID_FROM`,`VALID_TO`) values 
(1,'99100f6614a133ca9a8a9eeb4c1a6451','2018-11-16 15:42:29','234170388','htrestiawan@gmail.com','Open','2018-11-16','2018-11-23');

/*Table structure for table `role_access_detail_tbl` */

DROP TABLE IF EXISTS `role_access_detail_tbl`;

CREATE TABLE `role_access_detail_tbl` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `cid_role_access` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `i` int(11) DEFAULT '0',
  `u` int(11) DEFAULT '0',
  `d` int(11) DEFAULT '0',
  `p` int(11) DEFAULT '0',
  `v` int(11) DEFAULT '0',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `role_access_detail_tbl` */

/*Table structure for table `role_access_tbl` */

DROP TABLE IF EXISTS `role_access_tbl`;

CREATE TABLE `role_access_tbl` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `role_access_name` varchar(50) DEFAULT NULL,
  `POSITION_ID` text,
  `EMPLOYEE_ID` text,
  `NOTE` text,
  `Active` int(11) DEFAULT '1',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `role_access_tbl` */

insert  into `role_access_tbl`(`cid`,`role_access_name`,`POSITION_ID`,`EMPLOYEE_ID`,`NOTE`,`Active`) values 
(1,'HCIS',',P0001,P0002,','',NULL,1),
(2,'HENDRI','',',234170388,',NULL,1),
(3,'aa',NULL,NULL,NULL,1),
(4,'vv',NULL,NULL,NULL,1),
(14,'aa',NULL,NULL,NULL,1),
(13,'aa',NULL,NULL,NULL,1),
(12,'aa',NULL,NULL,NULL,1),
(11,'aa',NULL,NULL,NULL,1),
(10,'aa',NULL,NULL,NULL,1),
(15,'ss',NULL,NULL,NULL,1),
(16,'dd',NULL,NULL,NULL,1);

/*Table structure for table `tab_nominatif` */

DROP TABLE IF EXISTS `tab_nominatif`;

CREATE TABLE `tab_nominatif` (
  `EMPLOYEE_ID` varchar(30) NOT NULL DEFAULT '',
  `FULLNAME` varchar(100) DEFAULT NULL,
  `GENDER` varchar(6) DEFAULT NULL,
  `subArea` varchar(100) DEFAULT NULL,
  `subAreaText` varchar(100) DEFAULT NULL,
  `orgUnit` varchar(100) DEFAULT NULL,
  `orgName` varchar(100) DEFAULT NULL,
  `SUPERVISOR_ID` varchar(20) DEFAULT NULL,
  `SUPERVISOR_NAME` varchar(100) DEFAULT NULL,
  `REGION` varchar(100) DEFAULT NULL,
  `BRANCH` varchar(100) DEFAULT NULL,
  `subBranch` varchar(100) DEFAULT NULL,
  `directorate` varchar(100) DEFAULT NULL,
  `division` varchar(100) DEFAULT NULL,
  `grade` varchar(20) DEFAULT NULL,
  `POSITION_ID` varchar(10) DEFAULT NULL,
  `POSITION_NAME` varchar(100) DEFAULT NULL,
  `Status_Employee` varchar(25) DEFAULT NULL,
  `education` varchar(50) DEFAULT NULL,
  `birthDate` date DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `ibuKandung` varchar(100) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `noKTP` varchar(100) DEFAULT NULL,
  `HOMEBASE` varchar(100) DEFAULT NULL,
  `IQ` varchar(15) DEFAULT NULL,
  `Disc_Profile` varchar(100) DEFAULT NULL,
  `Child` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `talent_category` varchar(100) DEFAULT NULL COMMENT 'Talented, Not Talented',
  PRIMARY KEY (`EMPLOYEE_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tab_nominatif` */

insert  into `tab_nominatif`(`EMPLOYEE_ID`,`FULLNAME`,`GENDER`,`subArea`,`subAreaText`,`orgUnit`,`orgName`,`SUPERVISOR_ID`,`SUPERVISOR_NAME`,`REGION`,`BRANCH`,`subBranch`,`directorate`,`division`,`grade`,`POSITION_ID`,`POSITION_NAME`,`Status_Employee`,`education`,`birthDate`,`startDate`,`ibuKandung`,`status`,`noKTP`,`HOMEBASE`,`IQ`,`Disc_Profile`,`Child`,`email`,`talent_category`) values 
('234170388','HENDRI TRESTIAWAN','Male','234','HO1','ORG001','HC Information System Department','234150483','DAVID SANDY','KANTOR PUSAT','HO','HO','Human Capital Directorate','HC Shared Service Division','G2','P00002','HCIS Development Specialist','Permanent','Bachelor','1988-03-10','2012-11-01','IBU','Active','123','HO','120','D','1','htrestiawan@gmail.com','TALENTED'),
('234150483','DAVID SANDY','Male','234','HO1','ORG001','HC Information System Department','','','KANTOR PUSAT','HO','HO','Human Capital Directorate','HC Shared Service Division','G3','P00001','HC Information System Dept Head','Permanent','Bachelor','1985-10-06','2010-11-01','IBU','Active','456','HO','130','D','0','dsandy@gmail.com','TALENTED');

/*Table structure for table `tab_user` */

DROP TABLE IF EXISTS `tab_user`;

CREATE TABLE `tab_user` (
  `usrID` varchar(30) NOT NULL,
  `fullName` varchar(100) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `noKTP` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`usrID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tab_user` */

insert  into `tab_user`(`usrID`,`fullName`,`password`,`birthday`,`noKTP`,`email`) values 
('234170388','HENDRI TRESTIAWAN','21232f297a57a5a743894a0e4a801fc3','1988-03-10',NULL,'htrestiawan@gmail.com'),
('234150483','DAVID SANDY','21232f297a57a5a743894a0e4a801fc3','1985-10-06',NULL,'dsandy@gmail.com');

/*Table structure for table `task_user_tbl` */

DROP TABLE IF EXISTS `task_user_tbl`;

CREATE TABLE `task_user_tbl` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `ip_user` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=349 DEFAULT CHARSET=latin1;

/*Data for the table `task_user_tbl` */

insert  into `task_user_tbl`(`cid`,`menu_id`,`task_id`,`ip_user`) values 
(348,22,1,'10.0.1.128');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
