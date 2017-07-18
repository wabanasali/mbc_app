-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 08, 2017 at 04:37 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mbc`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `associated_expenses_view`
--
CREATE TABLE IF NOT EXISTS `associated_expenses_view` (
`total_expenses` decimal(32,0)
,`todayDate` datetime
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `associated_htgofferings_view`
--
CREATE TABLE IF NOT EXISTS `associated_htgofferings_view` (
`total_htgOfferings` decimal(32,0)
,`todayDate` datetime
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `associated_otherofferings_view`
--
CREATE TABLE IF NOT EXISTS `associated_otherofferings_view` (
`total_otherOfferings` decimal(32,0)
,`todayDate` datetime
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `associated_projects_view`
--
CREATE TABLE IF NOT EXISTS `associated_projects_view` (
`total_projects` decimal(32,0)
,`todayDate` datetime
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `associated_regofferings_view`
--
CREATE TABLE IF NOT EXISTS `associated_regofferings_view` (
`total_regOfferings` decimal(32,0)
,`todayDate` datetime
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `associated_tithes_view`
--
CREATE TABLE IF NOT EXISTS `associated_tithes_view` (
`total_tithes` decimal(32,0)
,`todayDate` datetime
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `a_expenses_view`
--
CREATE TABLE IF NOT EXISTS `a_expenses_view` (
`totalExpenses` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `a_htgofferings_view`
--
CREATE TABLE IF NOT EXISTS `a_htgofferings_view` (
`totalHtgOfferings` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `a_otherofferings_view`
--
CREATE TABLE IF NOT EXISTS `a_otherofferings_view` (
`totalOtherOfferings` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `a_projectofferings_view`
--
CREATE TABLE IF NOT EXISTS `a_projectofferings_view` (
`totalProjectOfferings` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `a_regularofferings_view`
--
CREATE TABLE IF NOT EXISTS `a_regularofferings_view` (
`totalRegularOfferings` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `a_tithes_view`
--
CREATE TABLE IF NOT EXISTS `a_tithes_view` (
`totalTithes` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Table structure for table `christians`
--

CREATE TABLE IF NOT EXISTS `christians` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `baptised_on` datetime NOT NULL,
  `matricule` varchar(25) NOT NULL,
  `f_year_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `f_year_id` (`f_year_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `christians`
--

INSERT INTO `christians` (`id`, `name`, `baptised_on`, `matricule`, `f_year_id`) VALUES
(1, 'SAMURUJUKUMA KUSFRABUJANZA', '2013-06-10 00:00:00', 'MBC20160001', 1),
(2, 'AMBOREKEBIYA OUMAROU', '2011-07-14 00:00:00', 'MBC20160002', 1),
(3, 'TASSANG WILFRED OLUWA NAGODEH', '2016-05-09 00:00:00', 'MBC20160003', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `daystatistics`
--
CREATE TABLE IF NOT EXISTS `daystatistics` (
`total_expenses` decimal(32,0)
,`total_htgOfferings` decimal(32,0)
,`total_otherOfferings` decimal(32,0)
,`total_projects` decimal(32,0)
,`total_regOfferings` decimal(32,0)
,`total_tithes` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `daystatistics1`
--
CREATE TABLE IF NOT EXISTS `daystatistics1` (
`totalExpenses` decimal(32,0)
,`totalHtgOfferings` decimal(32,0)
,`totalOtherOfferings` decimal(32,0)
,`totalProjectOfferings` decimal(32,0)
,`totalRegularOfferings` decimal(32,0)
,`totalTithes` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `purpose` varchar(45) NOT NULL,
  `withdrawn_on` datetime NOT NULL DEFAULT '2016-09-01 09:30:00',
  `u_id` int(11) NOT NULL,
  `f_year_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`),
  KEY `f_year_id` (`f_year_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `amount`, `purpose`, `withdrawn_on`, `u_id`, `f_year_id`) VALUES
(1, 60000, 'pastors salary for the month', '2017-01-23 09:30:00', 22, 2),
(2, 25000, 'Delegates registration for Ekona FCC', '2017-01-24 09:30:00', 22, 2),
(3, 750000, 'expenses on project', '2017-01-24 15:30:00', 22, 2),
(4, 50000, 'pastors salary for the month', '2017-01-25 09:30:00', 22, 2),
(5, 80000, 'expenses on project', '2017-01-25 16:30:00', 22, 2),
(6, 200000, 'pastors salary for the month', '2017-01-31 09:30:00', 22, 2),
(7, 200000, 'pastors salary for the month', '2017-02-07 09:30:00', 22, 2),
(8, 3000000, 'expenses on project', '2017-02-07 14:30:00', 22, 2),
(9, 120000, 'pastors salary for the month', '2017-04-13 09:30:00', 22, 2),
(10, 125000, 'pastors salary for the month', '2017-04-18 03:30:00', 22, 2),
(11, 42000, 'expenses on project', '2017-04-18 01:30:00', 22, 2),
(12, 10050, 'Support Feeding for FCC Delegates', '2017-04-18 11:30:00', 22, 2),
(13, 300000, 'pastors salary for the month', '2017-04-27 09:30:00', 22, 2),
(14, 1290000, 'expenses on project', '2017-04-27 16:30:00', 22, 2),
(15, 125000, 'pastors salary for the month', '2017-05-05 09:30:00', 22, 2),
(16, 50000, 'expenses on project', '2017-05-05 14:30:00', 22, 2),
(17, 400000, 'Disbursed to Truste Committee for buying of L', '2017-05-05 17:30:00', 22, 2),
(18, 500000, 'buying of new land', '2017-05-06 09:30:00', 22, 2),
(19, 50000, 'expenses on project', '2017-05-08 13:24:17', 22, 2),
(20, 100000, 'pastors salary for the month', '2017-05-08 13:25:47', 22, 2);

-- --------------------------------------------------------

--
-- Table structure for table `financial_year`
--

CREATE TABLE IF NOT EXISTS `financial_year` (
  `f_year_id` int(11) NOT NULL,
  `f_year` int(11) NOT NULL,
  PRIMARY KEY (`f_year_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `financial_year`
--

INSERT INTO `financial_year` (`f_year_id`, `f_year`) VALUES
(1, 2016),
(2, 2017);

-- --------------------------------------------------------

--
-- Table structure for table `htg_offerings`
--

CREATE TABLE IF NOT EXISTS `htg_offerings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `collected_on` datetime NOT NULL DEFAULT '2017-01-23 07:30:00',
  `u_id` int(11) NOT NULL,
  `f_year_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`),
  KEY `f_year_id` (`f_year_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `htg_offerings`
--

INSERT INTO `htg_offerings` (`id`, `amount`, `collected_on`, `u_id`, `f_year_id`) VALUES
(1, 300000, '2016-12-26 07:30:00', 22, 1),
(2, 800000, '2017-01-24 07:30:00', 22, 2),
(3, 1200000, '2017-01-25 07:30:00', 22, 2),
(4, 600000, '2017-01-31 07:30:00', 22, 2),
(5, 10002600, '2017-04-18 07:30:00', 22, 2),
(6, 500000, '2017-05-05 07:30:00', 22, 2),
(7, 120000, '2017-05-06 13:18:35', 22, 2),
(8, 150000, '2017-05-08 13:37:51', 22, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `other_expenses`
--
CREATE TABLE IF NOT EXISTS `other_expenses` (
`id` int(11)
,`amount` int(11)
,`purpose` varchar(45)
,`withdrawn_on` datetime
,`u_id` int(11)
,`f_year_id` int(11)
);
-- --------------------------------------------------------

--
-- Table structure for table `other_offerings`
--

CREATE TABLE IF NOT EXISTS `other_offerings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `collected_on` datetime NOT NULL DEFAULT '2016-09-01 09:30:00',
  `u_id` int(11) NOT NULL,
  `f_year_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`),
  KEY `f_year_id` (`f_year_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `other_offerings`
--

INSERT INTO `other_offerings` (`id`, `amount`, `collected_on`, `u_id`, `f_year_id`) VALUES
(0, 30000, '2016-09-01 09:30:00', 22, 1),
(2, 100000, '2017-01-24 09:30:00', 22, 2),
(3, 700000, '2017-01-24 12:30:00', 22, 2),
(4, 10000000, '2017-02-07 09:30:00', 22, 2),
(5, 2050, '2017-04-18 09:30:00', 22, 2),
(6, 25000, '2017-05-05 09:30:00', 22, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pastors_salary`
--
CREATE TABLE IF NOT EXISTS `pastors_salary` (
`id` int(11)
,`amount` int(11)
,`purpose` varchar(45)
,`withdrawn_on` datetime
,`u_id` int(11)
,`f_year_id` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `project_expenditure`
--
CREATE TABLE IF NOT EXISTS `project_expenditure` (
`id` int(11)
,`amount` int(11)
,`purpose` varchar(45)
,`withdrawn_on` datetime
,`u_id` int(11)
,`f_year_id` int(11)
);
-- --------------------------------------------------------

--
-- Table structure for table `project_offerings`
--

CREATE TABLE IF NOT EXISTS `project_offerings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) DEFAULT NULL,
  `collected_on` datetime NOT NULL,
  `c_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `f_year_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `c_id` (`c_id`),
  KEY `u_id` (`u_id`),
  KEY `f_year_id` (`f_year_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `project_offerings`
--

INSERT INTO `project_offerings` (`id`, `amount`, `collected_on`, `c_id`, `u_id`, `f_year_id`) VALUES
(1, 22000, '2016-12-26 00:00:00', 2, 22, 1),
(2, 28000, '2016-12-27 03:13:41', 1, 22, 2),
(3, 300000, '2017-01-23 00:00:00', 3, 22, 2),
(4, 250000, '2017-01-25 00:00:00', 1, 22, 2),
(5, 700000, '2017-01-25 19:40:46', 2, 22, 2),
(6, 20000, '2017-02-07 13:16:11', 2, 22, 2),
(7, 60000, '2017-04-13 00:00:00', 2, 22, 2),
(8, 2900, '2017-04-18 00:00:00', 1, 22, 2),
(9, 60000, '2017-04-20 15:00:00', 1, 22, 2),
(10, 2000, '2017-04-26 00:00:00', 1, 22, 2),
(11, 400000, '2017-05-05 00:00:00', 3, 22, 2),
(12, 10000, '2017-05-06 00:00:00', 2, 22, 2),
(13, 20000, '2017-05-06 12:52:17', 2, 22, 2),
(14, 10000, '2017-05-06 22:00:00', 3, 22, 2);

-- --------------------------------------------------------

--
-- Table structure for table `regular_offerings`
--

CREATE TABLE IF NOT EXISTS `regular_offerings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `collected_on` datetime NOT NULL DEFAULT '2017-01-23 07:30:00',
  `u_id` int(11) NOT NULL,
  `f_year_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`),
  KEY `f_year_id` (`f_year_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `regular_offerings`
--

INSERT INTO `regular_offerings` (`id`, `amount`, `collected_on`, `u_id`, `f_year_id`) VALUES
(1, 12000, '2016-12-26 07:30:00', 22, 1),
(2, 80000, '2017-01-24 07:30:00', 22, 2),
(3, 50000, '2017-01-25 07:30:00', 22, 2),
(4, 92000, '2017-04-18 07:30:00', 22, 2),
(5, 50000, '2017-05-05 07:30:00', 22, 2),
(6, 70000, '2017-05-08 13:09:32', 22, 2);

-- --------------------------------------------------------

--
-- Table structure for table `session_data`
--

CREATE TABLE IF NOT EXISTS `session_data` (
  `id` int(11) NOT NULL,
  `ip_addr` varchar(45) NOT NULL,
  `u_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tithes`
--

CREATE TABLE IF NOT EXISTS `tithes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `paid_on` datetime NOT NULL,
  `c_id` int(11) NOT NULL,
  `f_year_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `c_id` (`c_id`),
  KEY `f_year_id` (`f_year_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `tithes`
--

INSERT INTO `tithes` (`id`, `amount`, `paid_on`, `c_id`, `f_year_id`) VALUES
(4, 90000, '2016-10-19 00:00:00', 2, 1),
(5, 35000, '2016-12-07 04:08:21', 1, 1),
(6, 25000, '2017-01-06 04:11:14', 1, 2),
(7, 25500, '2017-01-10 00:00:00', 2, 2),
(8, 70000, '2017-02-01 00:00:00', 1, 2),
(9, 23000, '2017-05-01 00:00:00', 2, 2),
(10, 120000, '2017-03-05 00:00:00', 1, 2),
(11, 50000, '2017-04-05 00:00:00', 3, 2),
(12, 75000, '2017-05-08 00:00:00', 2, 2),
(13, 1200000, '2017-05-14 00:00:00', 3, 2),
(14, 25000, '2017-04-17 00:00:00', 3, 2),
(25, 100000, '2017-05-03 00:00:00', 2, 2),
(26, 100000, '2017-05-04 00:00:00', 2, 2),
(27, 50000, '2017-05-06 00:00:00', 1, 2),
(28, 20000, '2017-05-06 11:42:47', 3, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `todaystatistics`
--
CREATE TABLE IF NOT EXISTS `todaystatistics` (
`total_htgOfferings` double
,`total_otherOfferings` double
,`total_projects` double
,`total_regOfferings` double
,`total_tithes` double
);
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `created_on` varchar(45) NOT NULL,
  `full_name` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_on`, `full_name`) VALUES
(22, 'admin', '21232f297a57a5a743894a0e4a801fc3', '19/12/2016', 'Adamu Ramatu Ndisi');

-- --------------------------------------------------------

--
-- Structure for view `associated_expenses_view`
--
DROP TABLE IF EXISTS `associated_expenses_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `associated_expenses_view` AS select sum(`expenses`.`amount`) AS `total_expenses`,`expenses`.`withdrawn_on` AS `todayDate` from `expenses` where (`expenses`.`withdrawn_on` = convert(date_format(curdate(),'%d/%m/%Y') using latin1));

-- --------------------------------------------------------

--
-- Structure for view `associated_htgofferings_view`
--
DROP TABLE IF EXISTS `associated_htgofferings_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `associated_htgofferings_view` AS select sum(`htg_offerings`.`amount`) AS `total_htgOfferings`,`htg_offerings`.`collected_on` AS `todayDate` from `htg_offerings` where (`htg_offerings`.`collected_on` = convert(date_format(curdate(),'%d/%m/%Y') using latin1));

-- --------------------------------------------------------

--
-- Structure for view `associated_otherofferings_view`
--
DROP TABLE IF EXISTS `associated_otherofferings_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `associated_otherofferings_view` AS select sum(`other_offerings`.`amount`) AS `total_otherOfferings`,`other_offerings`.`collected_on` AS `todayDate` from `other_offerings` where (`other_offerings`.`collected_on` = convert(date_format(curdate(),'%d/%m/%Y') using latin1));

-- --------------------------------------------------------

--
-- Structure for view `associated_projects_view`
--
DROP TABLE IF EXISTS `associated_projects_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `associated_projects_view` AS select sum(`project_offerings`.`amount`) AS `total_projects`,`project_offerings`.`collected_on` AS `todayDate` from `project_offerings` where (`project_offerings`.`collected_on` = convert(date_format(curdate(),'%d/%m/%Y') using latin1));

-- --------------------------------------------------------

--
-- Structure for view `associated_regofferings_view`
--
DROP TABLE IF EXISTS `associated_regofferings_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `associated_regofferings_view` AS select sum(`regular_offerings`.`amount`) AS `total_regOfferings`,`regular_offerings`.`collected_on` AS `todayDate` from `regular_offerings` where (`regular_offerings`.`collected_on` = convert(date_format(curdate(),'%d/%m/%Y') using latin1));

-- --------------------------------------------------------

--
-- Structure for view `associated_tithes_view`
--
DROP TABLE IF EXISTS `associated_tithes_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `associated_tithes_view` AS select sum(`tithes`.`amount`) AS `total_tithes`,`tithes`.`paid_on` AS `todayDate` from `tithes` where (`tithes`.`paid_on` = convert(date_format(curdate(),'%d/%m/%Y') using latin1));

-- --------------------------------------------------------

--
-- Structure for view `a_expenses_view`
--
DROP TABLE IF EXISTS `a_expenses_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `a_expenses_view` AS select sum(`expenses`.`amount`) AS `totalExpenses` from `expenses` where (date_format(`expenses`.`withdrawn_on`,'%Y-%m-%d') = curdate());

-- --------------------------------------------------------

--
-- Structure for view `a_htgofferings_view`
--
DROP TABLE IF EXISTS `a_htgofferings_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `a_htgofferings_view` AS select sum(`htg_offerings`.`amount`) AS `totalHtgOfferings` from `htg_offerings` where (date_format(`htg_offerings`.`collected_on`,'%Y-%m-%d') = curdate());

-- --------------------------------------------------------

--
-- Structure for view `a_otherofferings_view`
--
DROP TABLE IF EXISTS `a_otherofferings_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `a_otherofferings_view` AS select sum(`other_offerings`.`amount`) AS `totalOtherOfferings` from `other_offerings` where (date_format(`other_offerings`.`collected_on`,'%Y-%m-%d') = curdate());

-- --------------------------------------------------------

--
-- Structure for view `a_projectofferings_view`
--
DROP TABLE IF EXISTS `a_projectofferings_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `a_projectofferings_view` AS select sum(`project_offerings`.`amount`) AS `totalProjectOfferings` from `project_offerings` where (date_format(`project_offerings`.`collected_on`,'%Y-%m-%d') = curdate());

-- --------------------------------------------------------

--
-- Structure for view `a_regularofferings_view`
--
DROP TABLE IF EXISTS `a_regularofferings_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `a_regularofferings_view` AS select sum(`regular_offerings`.`amount`) AS `totalRegularOfferings` from `regular_offerings` where (date_format(`regular_offerings`.`collected_on`,'%Y-%m-%d') = curdate());

-- --------------------------------------------------------

--
-- Structure for view `a_tithes_view`
--
DROP TABLE IF EXISTS `a_tithes_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `a_tithes_view` AS select sum(`tithes`.`amount`) AS `totalTithes` from `tithes` where (date_format(`tithes`.`paid_on`,'%Y-%m-%d') = curdate());

-- --------------------------------------------------------

--
-- Structure for view `daystatistics`
--
DROP TABLE IF EXISTS `daystatistics`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daystatistics` AS select `e`.`total_expenses` AS `total_expenses`,`h`.`total_htgOfferings` AS `total_htgOfferings`,`o`.`total_otherOfferings` AS `total_otherOfferings`,`p`.`total_projects` AS `total_projects`,`r`.`total_regOfferings` AS `total_regOfferings`,`t`.`total_tithes` AS `total_tithes` from (((((`associated_expenses_view` `e` join `associated_htgofferings_view` `h`) join `associated_otherofferings_view` `o`) join `associated_projects_view` `p`) join `associated_regofferings_view` `r`) join `associated_tithes_view` `t`);

-- --------------------------------------------------------

--
-- Structure for view `daystatistics1`
--
DROP TABLE IF EXISTS `daystatistics1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daystatistics1` AS select `a_expenses_view`.`totalExpenses` AS `totalExpenses`,`a_htgofferings_view`.`totalHtgOfferings` AS `totalHtgOfferings`,`a_otherofferings_view`.`totalOtherOfferings` AS `totalOtherOfferings`,`a_projectofferings_view`.`totalProjectOfferings` AS `totalProjectOfferings`,`a_regularofferings_view`.`totalRegularOfferings` AS `totalRegularOfferings`,`a_tithes_view`.`totalTithes` AS `totalTithes` from (((((`a_expenses_view` join `a_htgofferings_view`) join `a_otherofferings_view`) join `a_projectofferings_view`) join `a_regularofferings_view`) join `a_tithes_view`);

-- --------------------------------------------------------

--
-- Structure for view `other_expenses`
--
DROP TABLE IF EXISTS `other_expenses`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `other_expenses` AS select `expenses`.`id` AS `id`,`expenses`.`amount` AS `amount`,`expenses`.`purpose` AS `purpose`,`expenses`.`withdrawn_on` AS `withdrawn_on`,`expenses`.`u_id` AS `u_id`,`expenses`.`f_year_id` AS `f_year_id` from `expenses` where ((`expenses`.`purpose` not in ('pastors salary for the month','expenses on project')) and (`expenses`.`f_year_id` = (select `financial_year`.`f_year_id` from `financial_year` where (`financial_year`.`f_year` = date_format(curdate(),'%Y')))));

-- --------------------------------------------------------

--
-- Structure for view `pastors_salary`
--
DROP TABLE IF EXISTS `pastors_salary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pastors_salary` AS select `expenses`.`id` AS `id`,`expenses`.`amount` AS `amount`,`expenses`.`purpose` AS `purpose`,`expenses`.`withdrawn_on` AS `withdrawn_on`,`expenses`.`u_id` AS `u_id`,`expenses`.`f_year_id` AS `f_year_id` from `expenses` where ((`expenses`.`purpose` = 'pastors salary for the month') and (`expenses`.`f_year_id` = (select `financial_year`.`f_year_id` from `financial_year` where (`financial_year`.`f_year` = date_format(curdate(),'%Y')))));

-- --------------------------------------------------------

--
-- Structure for view `project_expenditure`
--
DROP TABLE IF EXISTS `project_expenditure`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `project_expenditure` AS select `expenses`.`id` AS `id`,`expenses`.`amount` AS `amount`,`expenses`.`purpose` AS `purpose`,`expenses`.`withdrawn_on` AS `withdrawn_on`,`expenses`.`u_id` AS `u_id`,`expenses`.`f_year_id` AS `f_year_id` from `expenses` where ((`expenses`.`purpose` = 'expenses on project') and (`expenses`.`f_year_id` = (select `financial_year`.`f_year_id` from `financial_year` where (`financial_year`.`f_year` = date_format(curdate(),'%Y')))));

-- --------------------------------------------------------

--
-- Structure for view `todaystatistics`
--
DROP TABLE IF EXISTS `todaystatistics`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `todaystatistics` AS select sum('amount') AS `total_htgOfferings`,sum('amount') AS `total_otherOfferings`,sum('amount') AS `total_projects`,sum('amount') AS `total_regOfferings`,sum('amount') AS `total_tithes` from ((((`htg_offerings` join `other_offerings`) join `project_offerings`) join `regular_offerings`) join `tithes`) where ((`htg_offerings`.`collected_on` = curdate()) and (`other_offerings`.`collected_on` = curdate()) and (`project_offerings`.`collected_on` = curdate()) and (`regular_offerings`.`collected_on` = curdate()) and (`tithes`.`paid_on` = curdate()));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `christians`
--
ALTER TABLE `christians`
  ADD CONSTRAINT `christians_ibfk_1` FOREIGN KEY (`f_year_id`) REFERENCES `financial_year` (`f_year_id`);

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expenses_ibfk_3` FOREIGN KEY (`f_year_id`) REFERENCES `financial_year` (`f_year_id`);

--
-- Constraints for table `htg_offerings`
--
ALTER TABLE `htg_offerings`
  ADD CONSTRAINT `htg_offerings_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `htg_offerings_ibfk_3` FOREIGN KEY (`f_year_id`) REFERENCES `financial_year` (`f_year_id`);

--
-- Constraints for table `other_offerings`
--
ALTER TABLE `other_offerings`
  ADD CONSTRAINT `other_offerings_ibfk_1` FOREIGN KEY (`f_year_id`) REFERENCES `financial_year` (`f_year_id`);

--
-- Constraints for table `project_offerings`
--
ALTER TABLE `project_offerings`
  ADD CONSTRAINT `project_offerings_ibfk_3` FOREIGN KEY (`c_id`) REFERENCES `christians` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_offerings_ibfk_4` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_offerings_ibfk_5` FOREIGN KEY (`f_year_id`) REFERENCES `financial_year` (`f_year_id`);

--
-- Constraints for table `regular_offerings`
--
ALTER TABLE `regular_offerings`
  ADD CONSTRAINT `regular_offerings_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `regular_offerings_ibfk_3` FOREIGN KEY (`f_year_id`) REFERENCES `financial_year` (`f_year_id`);

--
-- Constraints for table `session_data`
--
ALTER TABLE `session_data`
  ADD CONSTRAINT `session_data_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tithes`
--
ALTER TABLE `tithes`
  ADD CONSTRAINT `tithes_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `christians` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tithes_ibfk_3` FOREIGN KEY (`f_year_id`) REFERENCES `financial_year` (`f_year_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
