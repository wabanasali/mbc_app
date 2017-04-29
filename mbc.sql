-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 29, 2017 at 09:06 PM
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
,`todayDate` varchar(45)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `associated_htgofferings_view`
--
CREATE TABLE IF NOT EXISTS `associated_htgofferings_view` (
`total_htgOfferings` decimal(32,0)
,`todayDate` varchar(45)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `associated_otherofferings_view`
--
CREATE TABLE IF NOT EXISTS `associated_otherofferings_view` (
`total_otherOfferings` decimal(32,0)
,`todayDate` varchar(45)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `associated_projects_view`
--
CREATE TABLE IF NOT EXISTS `associated_projects_view` (
`total_projects` decimal(32,0)
,`todayDate` varchar(45)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `associated_regofferings_view`
--
CREATE TABLE IF NOT EXISTS `associated_regofferings_view` (
`total_regOfferings` decimal(32,0)
,`todayDate` varchar(45)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `associated_tithes_view`
--
CREATE TABLE IF NOT EXISTS `associated_tithes_view` (
`total_tithes` decimal(32,0)
,`todayDate` varchar(45)
);
-- --------------------------------------------------------

--
-- Table structure for table `christians`
--

CREATE TABLE IF NOT EXISTS `christians` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `baptised_on` varchar(45) NOT NULL,
  `matricule` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `christians`
--

INSERT INTO `christians` (`id`, `name`, `baptised_on`, `matricule`) VALUES
(1, 'SAMURUJUKUMA KUSFRABUJANZA', '21/05/2015', 'MBC20160001'),
(2, 'AMBOREKEBIYA OUMAROU', '10/02/2016', 'MBC20160002'),
(3, 'TASSANG WILFRED OLUWA NAGODEH', '31/03/1997', 'MBC20160003');

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
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `purpose` varchar(45) NOT NULL,
  `withdrawn_on` varchar(45) NOT NULL,
  `u_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `amount`, `purpose`, `withdrawn_on`, `u_id`) VALUES
(1, 60000, 'pastors salary for the month', '23/01/2017', 22),
(2, 25000, 'Delegates registration for Ekona FCC', '24/01/2017', 22),
(3, 750000, 'expenses on project', '24/01/2017', 22),
(4, 50000, 'pastors salary for the month', '25/01/2017', 22),
(5, 80000, 'expenses on project', '25/01/2017', 22),
(6, 200000, 'pastors salary for the month', '31/01/2017', 22),
(7, 200000, 'pastors salary for the month', '07/02/2017', 22),
(8, 3000000, 'expenses on project', '07/02/2017', 22),
(9, 120000, 'pastors salary for the month', '13/04/2017', 22),
(10, 125000, 'pastors salary for the month', '18/04/2017', 22),
(11, 42000, 'expenses on project', '18/04/2017', 22),
(12, 10050, 'Support Feeding for FCC Delegates', '18/04/2017', 22),
(13, 300000, 'pastors salary for the month', '27/04/2017', 22),
(14, 1290000, 'expenses on project', '27/04/2017', 22);

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
  `collected_on` varchar(45) NOT NULL,
  `u_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `htg_offerings`
--

INSERT INTO `htg_offerings` (`id`, `amount`, `collected_on`, `u_id`) VALUES
(1, 300000, '26/12/2016', 22),
(2, 800000, '24/01/2017', 22),
(3, 1200000, '25/01/2017', 22),
(4, 600000, '31/01/2017', 22),
(5, 10002600, '18/04/2017', 22);

-- --------------------------------------------------------

--
-- Stand-in structure for view `other_expenses`
--
CREATE TABLE IF NOT EXISTS `other_expenses` (
`id` int(11)
,`amount` int(11)
,`purpose` varchar(45)
,`withdrawn_on` varchar(45)
,`u_id` int(11)
);
-- --------------------------------------------------------

--
-- Table structure for table `other_offerings`
--

CREATE TABLE IF NOT EXISTS `other_offerings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `purpose` varchar(45) NOT NULL,
  `collected_on` varchar(45) NOT NULL,
  `u_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `other_offerings`
--

INSERT INTO `other_offerings` (`id`, `amount`, `purpose`, `collected_on`, `u_id`) VALUES
(0, 30000, 'latest couple special thanks giving', '26/12/2016', 22),
(2, 100000, 'latest couple special thanks giving', '24/01/2017', 22),
(3, 700000, 'Tithes brought foward', '24/01/2017', 22),
(4, 10000000, 'Support from Florida Foundation', '07/02/2017', 22),
(5, 2050, 'Late Support for Wedding', '18/04/2017', 22);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pastor_salary`
--
CREATE TABLE IF NOT EXISTS `pastor_salary` (
`id` int(11)
,`amount` int(11)
,`purpose` varchar(45)
,`withdrawn_on` varchar(45)
,`u_id` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `project_expenditure`
--
CREATE TABLE IF NOT EXISTS `project_expenditure` (
`id` int(11)
,`amount` int(11)
,`purpose` varchar(45)
,`withdrawn_on` varchar(45)
,`u_id` int(11)
);
-- --------------------------------------------------------

--
-- Table structure for table `project_offerings`
--

CREATE TABLE IF NOT EXISTS `project_offerings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `collected_on` varchar(45) NOT NULL,
  `c_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `c_id` (`c_id`),
  KEY `u_id` (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `project_offerings`
--

INSERT INTO `project_offerings` (`id`, `amount`, `collected_on`, `c_id`, `u_id`) VALUES
(1, 22000, '26/12/2016', 2, 22),
(2, 28000, '27/12/2017', 1, 22),
(3, 300000, '23/01/2017', 3, 22),
(4, 250000, '25/01/2017', 1, 22),
(5, 700000, '25/01/2017', 2, 22),
(6, 20000, '25/01/2017', 2, 22),
(7, 60000, '25/01/2017', 2, 22),
(8, 2900, '07/02/2017', 1, 22),
(9, 60000, '13/04/2017', 1, 22),
(10, 2000, '18/04/2017', 1, 22);

-- --------------------------------------------------------

--
-- Table structure for table `regular_offerings`
--

CREATE TABLE IF NOT EXISTS `regular_offerings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `collected_on` varchar(45) NOT NULL,
  `u_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `regular_offerings`
--

INSERT INTO `regular_offerings` (`id`, `amount`, `collected_on`, `u_id`) VALUES
(1, 12000, '26/12/2016', 22),
(2, 80000, '24/01/2017', 22),
(3, 50000, '25/01/2017', 22),
(4, 92000, '18/04/2017', 22);

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
  `paid_on` varchar(45) NOT NULL,
  `c_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `c_id` (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tithes`
--

INSERT INTO `tithes` (`id`, `amount`, `paid_on`, `c_id`) VALUES
(4, 90000, '25/12/2016', 2),
(5, 35000, '25/12/2016', 1),
(6, 25000, '07/01/2017', 1),
(7, 25500, '07/01/2017', 2),
(8, 70000, '18/01/2017', 1),
(9, 23000, '23/01/2017', 2),
(10, 120000, '24/01/2017', 1),
(11, 50000, '25/01/2017', 3),
(12, 75000, '25/01/2017', 2),
(13, 1200000, '28/01/2017', 3),
(14, 25000, '14/04/2017', 3);

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
-- Structure for view `daystatistics`
--
DROP TABLE IF EXISTS `daystatistics`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daystatistics` AS select `e`.`total_expenses` AS `total_expenses`,`h`.`total_htgOfferings` AS `total_htgOfferings`,`o`.`total_otherOfferings` AS `total_otherOfferings`,`p`.`total_projects` AS `total_projects`,`r`.`total_regOfferings` AS `total_regOfferings`,`t`.`total_tithes` AS `total_tithes` from (((((`associated_expenses_view` `e` join `associated_htgofferings_view` `h`) join `associated_otherofferings_view` `o`) join `associated_projects_view` `p`) join `associated_regofferings_view` `r`) join `associated_tithes_view` `t`);

-- --------------------------------------------------------

--
-- Structure for view `other_expenses`
--
DROP TABLE IF EXISTS `other_expenses`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `other_expenses` AS select `expenses`.`id` AS `id`,`expenses`.`amount` AS `amount`,`expenses`.`purpose` AS `purpose`,`expenses`.`withdrawn_on` AS `withdrawn_on`,`expenses`.`u_id` AS `u_id` from `expenses` where (`expenses`.`purpose` not in ('expenses on project','pastors salary for the month'));

-- --------------------------------------------------------

--
-- Structure for view `pastor_salary`
--
DROP TABLE IF EXISTS `pastor_salary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pastor_salary` AS select `expenses`.`id` AS `id`,`expenses`.`amount` AS `amount`,`expenses`.`purpose` AS `purpose`,`expenses`.`withdrawn_on` AS `withdrawn_on`,`expenses`.`u_id` AS `u_id` from `expenses` where (`expenses`.`purpose` = 'pastors salary for the month');

-- --------------------------------------------------------

--
-- Structure for view `project_expenditure`
--
DROP TABLE IF EXISTS `project_expenditure`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `project_expenditure` AS select `expenses`.`id` AS `id`,`expenses`.`amount` AS `amount`,`expenses`.`purpose` AS `purpose`,`expenses`.`withdrawn_on` AS `withdrawn_on`,`expenses`.`u_id` AS `u_id` from `expenses` where (`expenses`.`purpose` = 'expenses on project');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `htg_offerings`
--
ALTER TABLE `htg_offerings`
  ADD CONSTRAINT `htg_offerings_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_offerings`
--
ALTER TABLE `project_offerings`
  ADD CONSTRAINT `project_offerings_ibfk_3` FOREIGN KEY (`c_id`) REFERENCES `christians` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_offerings_ibfk_4` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `regular_offerings`
--
ALTER TABLE `regular_offerings`
  ADD CONSTRAINT `regular_offerings_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session_data`
--
ALTER TABLE `session_data`
  ADD CONSTRAINT `session_data_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tithes`
--
ALTER TABLE `tithes`
  ADD CONSTRAINT `tithes_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `christians` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
