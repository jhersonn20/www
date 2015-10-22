-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 13, 2012 at 03:52 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `arcc-eei`
--

-- --------------------------------------------------------

--
-- Table structure for table `wparcc_spf_testimonail`
--

CREATE TABLE IF NOT EXISTS `wparcc_spf_testimonail` (
  `gid` int(10) NOT NULL AUTO_INCREMENT,
  `path` text NOT NULL,
  `description` varchar(1000) NOT NULL,
  `page_id` varchar(50) NOT NULL,
  `fldSort` int(11) NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=253 ;

--
-- Dumping data for table `wparcc_spf_testimonail`
--

INSERT INTO `wparcc_spf_testimonail` (`gid`, `path`, `description`, `page_id`, `fldSort`) VALUES
(22, '/arcc-eei/wp-content/uploads/slides/43/quality.gif', '', '439000', 0),
(121, '/arcc-eei/wp-content/uploads/slides/453/Saudization.jpg', '', '4539000', 0),
(122, '/arcc-eei/wp-content/uploads/slides/453/saudiz_1.png', '', '453', 1),
(21, '/arcc-eei/wp-content/uploads/slides/41/safety1.png', '', '419000', 0),
(20, '/arcc-eei/wp-content/uploads/slides/41/certification.png', '', '41', 1),
(19, '/arcc-eei/wp-content/uploads/slides/41/safety2.png', '', '41', 2),
(18, '/arcc-eei/wp-content/uploads/slides/41/recognition.png', '', '41', 3),
(171, '/arcc-eei/wp-content/uploads/slides/346/workforce.png', '', '3469000', 0),
(170, '/arcc-eei/wp-content/uploads/slides/346/lengthOfService.png', '', '346', 1),
(17, '/arcc-eei/wp-content/uploads/slides/41/cert1.jpg', '', '419000', 0),
(23, '/arcc-eei/wp-content/uploads/slides/43/quality2.png', '', '439000', 0),
(24, '/arcc-eei/wp-content/uploads/slides/43/certificationQ.png', '', '43', 1),
(25, '/arcc-eei/wp-content/uploads/slides/45/JUP12.png', '1.2 million t/y Ethylene Plant', '45', 0),
(26, '/arcc-eei/wp-content/uploads/slides/43/quality3.png', '', '43', 2),
(27, '/arcc-eei/wp-content/uploads/slides/45/aramco.png', 'Smokeless Flare Systems Upgrade for Saudi Aramco Saudi Aramco testing (FAT) in Tulsa, Oklahoma USA', '45', 0),
(28, '/arcc-eei/wp-content/uploads/slides/45/sharq_new21.png', 'Ethylene Expansion Project', '45', 0),
(29, '/arcc-eei/wp-content/uploads/slides/45/0.04-Radiant-Panel-Erection-Complete-07Oct05.png', 'Cracking Furnace', '45', 0),
(30, '/arcc-eei/wp-content/uploads/slides/45/shuqaiqP.png', '3 x 320 MW Power Plant & Desalination', '45', 0),
(31, '/arcc-eei/wp-content/uploads/slides/45/Shoaiba-Project.png', '5 x 115MW Power Plant', '45', 0),
(32, '/arcc-eei/wp-content/uploads/slides/45/05-01-04-Ghazlan-II-from-phase-I.png', '4 x 600MW Power Plant', '45', 0),
(34, '/arcc-eei/wp-content/uploads/slides/45/fab1.png', 'Pipe Spool Fabrication', '45', 0),
(172, '/arcc-eei/wp-content/uploads/slides/346/manpower.png', 'ARCC, through its joint venture partner, EEI Corporation, has a manpower pool of over 50,000 skilled workers and staff in the Philippines', '346', 2),
(36, '/arcc-eei/wp-content/uploads/slides/45/fab2.png', 'Pipe Spool Fabrication', '45', 0),
(37, '/arcc-eei/wp-content/uploads/slides/45/fab3.png', 'Pipe Spool Fabrication', '45', 0),
(38, '/arcc-eei/wp-content/uploads/slides/45/fab4.png', 'Pipe Spool Fabrication', '45', 0),
(39, '/arcc-eei/wp-content/uploads/slides/45/fab5.png', 'Pipe Spool Fabrication', '45', 0),
(40, '/arcc-eei/wp-content/uploads/slides/45/fab6.png', 'Pipe Spool Fabrication', '45', 0),
(41, '/arcc-eei/wp-content/uploads/slides/45/qurayyah.png', 'Shutdown Works', '45', 0),
(42, '/arcc-eei/wp-content/uploads/slides/45/albayroni.png', 'Turnaround Project', '45', 0),
(43, '/arcc-eei/wp-content/uploads/slides/45/lummus-alireza.png', 'Furnace Utilities Project', '45', 0),
(44, '/arcc-eei/wp-content/uploads/slides/45/JUP05.png', 'United Ethylene Plant De-bottlenecking', '45', 0),
(45, '/arcc-eei/wp-content/uploads/slides/45/1---DSC03229.png', 'NPC Project', '45', 0),
(46, '/arcc-eei/wp-content/uploads/slides/45/2---DSC03216.png', 'NPC Project', '45', 0),
(47, '/arcc-eei/wp-content/uploads/slides/45/3---DSC03357.png', 'NPC Project', '45', 0),
(48, '/arcc-eei/wp-content/uploads/slides/45/4---DSC03217.png', 'NPC Project', '45', 0),
(49, '/arcc-eei/wp-content/uploads/slides/453/saudiz_2.png', '', '453', 2),
(50, '/arcc-eei/wp-content/uploads/slides/453/saudiz_3.png', '', '453', 3),
(51, '/arcc-eei/wp-content/uploads/slides/453/english.png', 'English Graduation', '4539000', 0),
(52, '/arcc-eei/wp-content/uploads/slides/453/DSC00366.png', 'Mensuration Training', '4539000', 0),
(53, '/arcc-eei/wp-content/uploads/slides/453/DSC00406.png', 'Actual Testing', '4539000', 0),
(130, '/arcc-eei/wp-content/uploads/slides/453/DSC00474.png', 'Piping Material Training', '4539000', 0),
(56, '/arcc-eei/wp-content/uploads/slides/428/Training-Slide-1.jpg', '', '4289000', 0),
(57, '/arcc-eei/wp-content/uploads/slides/428/trainingTitle_1.png', '', '428', 1),
(225, '/arcc-eei/wp-content/uploads/slides/428/training_1.png', '', '428', 2),
(58, '/arcc-eei/wp-content/uploads/slides/428/trainingTitle_2.png', '', '428', 3),
(129, '/arcc-eei/wp-content/uploads/slides/453/DSC00508.png', 'Electrical Training', '4539000', 0),
(116, '/arcc-eei/wp-content/uploads/slides/428/trainingFacilities_0.png', '', '428', 4),
(60, '/arcc-eei/wp-content/uploads/slides/428/trainingFacilities_1.png', '', '428', 5),
(61, '/arcc-eei/wp-content/uploads/slides/428/trainingFacilities_2.png', '', '428', 6),
(62, '/arcc-eei/wp-content/uploads/slides/428/trainingFacilities_3.png', '', '428', 7),
(224, '/arcc-eei/wp-content/uploads/slides/428/trainingTitle_3.png', '', '428', 8),
(226, '/arcc-eei/wp-content/uploads/slides/346/phil_recruitment.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Manpower Recruitment</strong></span></div> <ul style="list-style-type:circle !important;text-align: left;width: 700px;margin: 20px auto 0 auto;"><li>ARCC through its partner, EEI Corporation has an established reputable recruitment agency in the Philippines.</li><li>The Company also source semi-skilled manpower in India, Nepal and Bangladesh.</li><li>In the Philippines, its recruitment agency has various offices strategically located in the entire islands.</li></ul>', '346', 3),
(64, '/arcc-eei/wp-content/uploads/slides/428/51.png', 'Pumps and motors for Millwright training', '4289000', 0),
(65, '/arcc-eei/wp-content/uploads/slides/428/61.png', 'Water filling of tanks in preparation for hydrotesting exercises', '4289000', 0),
(66, '/arcc-eei/wp-content/uploads/slides/428/71.png', 'Hands-on training at the pipe spool fabrication shop', '4289000', 0),
(67, '/arcc-eei/wp-content/uploads/slides/428/81.png', 'Cutting and Beveling Workouts', '4289000', 0),
(69, '/arcc-eei/wp-content/uploads/slides/428/91.png', 'Welders Training Booths', '4289000', 0),
(132, '/arcc-eei/wp-content/uploads/slides/346/nepal_recruitment.png', '', '346', 4),
(243, '/arcc-eei/wp-content/uploads/slides/428/SKS_Torch.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012: Saudi Edition</strong></span></div> Firing up the torch...', '453', 14),
(231, '/arcc-eei/wp-content/uploads/slides/428/scaffolding2012.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012</strong></span></div> Participants of the Scaffolding Competition', '428', 16),
(113, '/arcc-eei/wp-content/uploads/slides/41/cert2.png', '', '419000', 0),
(114, '/arcc-eei/wp-content/uploads/slides/43/quality4.png', '', '43', 3),
(84, '/arcc-eei/wp-content/uploads/slides/386/aramco4.png', '\r\nSmokeless  Flare Systems Upgrade for Saudi Aramco \r\nSaudi Aramco testing (FAT) in Tulsa, Oklahoma USA', '386', 0),
(85, '/arcc-eei/wp-content/uploads/slides/386/bgp1.png', 'Saudi Aramco Berri Gas Plant Ethane Recovery Project', '386', 0),
(86, '/arcc-eei/wp-content/uploads/slides/388/sharq_new21.png', 'Ethylene  Expansion Project', '388', 0),
(87, '/arcc-eei/wp-content/uploads/slides/388/JUP12.png', '1.2 million t/y Ethylene Plant', '388', 0),
(88, '/arcc-eei/wp-content/uploads/slides/388/0.04-Radiant-Panel-Erection-Complete-07Oct05.png', 'Cracking Furnace', '388', 0),
(89, '/arcc-eei/wp-content/uploads/slides/390/shuqaiqP.png', '3 x 320 MW Power Plant & Desalination', '390', 0),
(90, '/arcc-eei/wp-content/uploads/slides/390/Shoaiba-Project.png', '5 x 115MW Power Plant', '390', 0),
(91, '/arcc-eei/wp-content/uploads/slides/390/05-01-04-Ghazlan-II-from-phase-I.png', '4 x 600MW Power Plant', '390', 0),
(92, '/arcc-eei/wp-content/uploads/slides/394/qurayyah.png', 'Shutdown Works\r\n\r\n', '394', 0),
(93, '/arcc-eei/wp-content/uploads/slides/394/albayroni.png', 'Turnaround Project', '394', 0),
(94, '/arcc-eei/wp-content/uploads/slides/394/lummus-alireza.png', 'Furnace Utilities Project', '394', 0),
(95, '/arcc-eei/wp-content/uploads/slides/394/JUP05.png', 'United Ethylene Plant  De-bottlenecking\r\n', '394', 0),
(96, '/arcc-eei/wp-content/uploads/slides/467/1---DSC03229.png', 'NPC Project', '467', 0),
(97, '/arcc-eei/wp-content/uploads/slides/467/2---DSC03216.png', 'NPC Project', '467', 0),
(98, '/arcc-eei/wp-content/uploads/slides/467/3---DSC03357.png', 'NPC Project', '467', 0),
(99, '/arcc-eei/wp-content/uploads/slides/467/4---DSC03217.png', 'NPC Project', '467', 0),
(100, '/arcc-eei/wp-content/uploads/slides/467/5---Main.png', 'NPC Project', '467', 0),
(101, '/arcc-eei/wp-content/uploads/slides/456/fab11.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>Inauguration of Fabrication Shop</strong></span></div>', '4569000', 0),
(102, '/arcc-eei/wp-content/uploads/slides/456/inauguration1.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>Inauguration of Fabrication Shop</strong></span></div>Arrival of the Guest of Honors.', '4569000', 0),
(103, '/arcc-eei/wp-content/uploads/slides/456/inauguration2.png', 'Pipe Spool Fabrication', '4569000', 0),
(104, '/arcc-eei/wp-content/uploads/slides/456/inauguration3.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>Inauguration of Fabrication Shop</strong></span></div>Ribbon Cutting.', '4569000', 0),
(105, '/arcc-eei/wp-content/uploads/slides/456/pipeSpool3.png', 'Pipe Spool Fabrication', '456', 0),
(106, '/arcc-eei/wp-content/uploads/slides/456/pipeSpool2.png', 'Pipe Spool Fabrication', '456', 0),
(143, '/arcc-eei/wp-content/uploads/slides/418/accom.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong> Employee Rooms </strong></span></div> Modern and decent houses for both senior staff and workers with complete amenities.', '418', 1),
(111, '/arcc-eei/wp-content/uploads/slides/43/recognitionQ.png', '', '43', 4),
(112, '/arcc-eei/wp-content/uploads/slides/43/cert1.jpg', '', '43', 9),
(115, '/arcc-eei/wp-content/uploads/slides/43/cert2.jpg', '', '43', 6),
(117, '/arcc-eei/wp-content/uploads/slides/428/101.png', 'SMAW trainee removing the flux for the next hot passes', '4289000', 0),
(118, '/arcc-eei/wp-content/uploads/slides/428/111.png', 'Learning to use the hi-low welding gauge', '4289000', 0),
(119, '/arcc-eei/wp-content/uploads/slides/428/121.png', 'GTAW welder being trained in simulated position', '4289000', 0),
(131, '/arcc-eei/wp-content/uploads/slides/428/training_3.png', '', '428', 9),
(133, '/arcc-eei/wp-content/uploads/slides/346/bacolod.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Manpower Recruitment</strong></span></div> <ul style="list-style-type:circle !important;text-align: left;width: 700px;margin: 20px auto 0 auto;"><li>ARCC through its partner, EEI Corporation has an established reputable recruitment agency in the Philippines.</li><li>The Company also source semi-skilled manpower in India, Nepal and Bangladesh.</li><li>In the Philippines, its recruitment agency has various offices strategically located in the entire islands.</li></ul>', '3469000', 0),
(134, '/arcc-eei/wp-content/uploads/slides/346/cebu.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Manpower Recruitment</strong></span></div> <ul style="list-style-type:circle !important;text-align: left;width: 700px;margin: 20px auto 0 auto;"><li>ARCC through its partner, EEI Corporation has an established reputable recruitment agency in the Philippines.</li><li>The Company also source semi-skilled manpower in India, Nepal and Bangladesh.</li><li>In the Philippines, its recruitment agency has various offices strategically located in the entire islands.</li></ul>', '3469000', 0),
(135, '/arcc-eei/wp-content/uploads/slides/346/commDiss.png', 'Company newsletter, bulletin boards and suggestion boxes are effective tools in communicating with employees.', '3469000', 0),
(136, '/arcc-eei/wp-content/uploads/slides/428/trainingTitle_4.png', '', '428', 10),
(137, '/arcc-eei/wp-content/uploads/slides/428/trainingFacilities_4.png', '', '428', 11),
(176, '/arcc-eei/wp-content/uploads/slides/428/trainingFacilities_5.png', '', '428', 12),
(177, '/arcc-eei/wp-content/uploads/slides/428/welding-area_16.png', 'Welding Training Booths', '4289000', 0),
(178, '/arcc-eei/wp-content/uploads/slides/428/training_15.png', 'Scaffolding Training', '4289000', 0),
(179, '/arcc-eei/wp-content/uploads/slides/428/piping14.png', 'Piping Training Course', '4289000', 0),
(138, '/arcc-eei/wp-content/uploads/slides/428/skillsOlympics2011.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2011</strong></span></div>', '428', 25),
(139, '/arcc-eei/wp-content/uploads/slides/346/skillsOlympics.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2011</strong></span></div> Presentation of all participants per projects', '428', 26),
(140, '/arcc-eei/wp-content/uploads/slides/346/skillsOlympics2.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2011</strong></span></div> Firing up the torch...', '428', 27),
(141, '/arcc-eei/wp-content/uploads/slides/346/skillsOlympics3.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2011</strong></span></div> Let the competition begins...', '428', 28),
(142, '/arcc-eei/wp-content/uploads/slides/346/funRun.png', '', '3469000', 0),
(144, '/arcc-eei/wp-content/uploads/slides/418/accom2.png', 'Modern and decent house for both senior staff and workers with complete amenities', '4189000', 0),
(145, '/arcc-eei/wp-content/uploads/slides/418/accom3.png', 'Modern and decent house for both senior staff and workers with complete amenities', '4189000', 0),
(146, '/arcc-eei/wp-content/uploads/slides/418/medical.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong> Resident Clinic </strong></span></div> Medical Service for all employees, equipped with necessary medical items.', '418', 2),
(147, '/arcc-eei/wp-content/uploads/slides/418/medical1.png', 'Quality medicines that are safe and sure to support the needs of all employees.', '4189000', 0),
(148, '/arcc-eei/wp-content/uploads/slides/418/medical2.png', 'Qualified medical staff that attends to medical need of employees 24/7.', '4189000', 0),
(149, '/arcc-eei/wp-content/uploads/slides/418/mess1.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong> Canteens </strong></span></div> Modest dining rooms that serves delicious and nutritious foods necessary for the body of all employees.', '418', 3),
(150, '/arcc-eei/wp-content/uploads/slides/418/mess2.png', 'Modest dining rooms that serves delicious and nutritious foods necessary for the body of all employees.', '4189000', 0),
(155, '/arcc-eei/wp-content/uploads/slides/418/mess3.png', 'Modest dining rooms that serves delicious and nutritious foods necessary for the body of all employees.', '4189000', 0),
(156, '/arcc-eei/wp-content/uploads/slides/418/sportsFac1.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong> Amenities </strong></span></div> Various kinds of sports and recreational facilities that is free of use to all employees for their self-satisfaction, relaxation and enjoyment. ', '418', 4),
(157, '/arcc-eei/wp-content/uploads/slides/418/sportsFac2.png', 'Various kinds of sports and recreational facilities that is free of use to all employees for their self-satisfaction, relaxation and enjoyment.', '4189000', 0),
(158, '/arcc-eei/wp-content/uploads/slides/418/outdoorFac1.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong> Amenities </strong></span></div> Various kinds of sports and recreational facilities that is free of use to all employees for their self-satisfaction, relaxation and enjoyment. ', '418', 5),
(159, '/arcc-eei/wp-content/uploads/slides/418/outdoorFac2.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong> Amenities </strong></span></div> Various kinds of sports and recreational facilities that is free of use to all employees for their self-satisfaction, relaxation and enjoyment. ', '418', 6),
(160, '/arcc-eei/wp-content/uploads/slides/418/otherAmen.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong> Amenities </strong></span></div> Convenient store that offer affordable prices to patrons.', '418', 7),
(161, '/arcc-eei/wp-content/uploads/slides/418/laundry.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong> Amenities </strong></span></div> Laundry service is provided to all employees.', '418', 8),
(162, '/arcc-eei/wp-content/uploads/slides/43/cert3.jpg', '', '43', 7),
(163, '/arcc-eei/wp-content/uploads/slides/41/cert3.jpg', '', '419000', 0),
(202, '/arcc-eei/wp-content/uploads/slides/41/cert5.jpg', '', '419000', 0),
(164, '/arcc-eei/wp-content/uploads/slides/41/award11.png', '', '41', 4),
(166, '/arcc-eei/wp-content/uploads/slides/41/award12.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>Safety awarding at SAMREF</strong></span></div>ARCC General Manager Norman K. Macapagal(middle) received the award from Mr. S. A. Al-Bargan(left), President & CEO and Mr. Ralf E. Schairer(right), Executive Vice President, in behalf of ARCC.', '41', 5),
(167, '/arcc-eei/wp-content/uploads/slides/41/safetyAwardSamref.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>Safety awarding at SAMREF</strong></span></div>Present during the ceremony (starting from right) is our very own General Manager Norman K. Macapagal, Lou Bauer (Project Director of Worley Parsons), Jim Vanness (Project Director of SAMREF Exxon Mobil) and Mr. Ali Kharashi (CFP Project Manager).', '41', 6),
(204, '/arcc-eei/wp-content/uploads/slides/453/rebar.png', 'Rebar Training', '4539000', 0),
(168, '/arcc-eei/wp-content/uploads/slides/41/award10.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>Manifa Central Processing Utilities Storage and Shipping Facilities</strong></span></div>The project congratulates ARCC staff, workers and sub-contractors for attaining <strong> 20 Million Manhours </strong> without lost time injury last June, 2012.', '41', 7),
(169, '/arcc-eei/wp-content/uploads/slides/346/empRel.png', 'ARCC Management believes that through various employee relations programs, camaraderie and teamwork are strengthened among employees thus improving productivity and morale.', '3469000', 0),
(212, '/arcc-eei/wp-content/uploads/slides/41/mh1.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>Ras Al Khair Aluminum Smelter Plant</strong></span></div>  The project congratulates ARCC staff, workers and sub-contractors for attaining <strong> 3 Million Manhours </strong> without lost time injury last 12th of March, 2012.', '41', 8),
(195, '/arcc-eei/wp-content/uploads/slides/41/mh3.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>SAMCo Project</strong></span></div>  The project congratulates ARCC staff, workers and sub-contractors for attaining <strong> 5 Million Manhours </strong> without lost time injury last November, 2011.', '41', 9),
(173, '/arcc-eei/wp-content/uploads/slides/346/sportsAct2.png', 'Sports program strengthens camaraderie and teamwork. ARCC has regular annual Sports activities that showcase individual abilities and team effort.', '3469000', 0),
(174, '/arcc-eei/wp-content/uploads/slides/346/sportsAct3.png', 'Sports program strengthens camaraderie and teamwork. ARCC has regular annual Sports activities that showcase individual abilities and team effort.', '3469000', 0),
(175, '/arcc-eei/wp-content/uploads/slides/346/sportsAct4.png', 'Sports program strengthens camaraderie and teamwork. ARCC has regular annual Sports activities that showcase individual abilities and team effort.', '3469000', 0),
(196, '/arcc-eei/wp-content/uploads/slides/41/mh5.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>Ras Al Khair Aluminum Smelter Plant</strong></span></div>  The project congratulates ARCC staff, workers and sub-contractors for attaining <strong> Best ES & H Contractor of the Year </strong> last 2011.', '41', 10),
(197, '/arcc-eei/wp-content/uploads/slides/41/mh2.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>Ras Al Khair Aluminum Smelter Plant</strong></span></div>  The project congratulates ARCC staff, workers and sub-contractors for attaining <strong> Best ES & H Contractor of the Year </strong> last 2011.', '41', 11),
(192, '/arcc-eei/wp-content/uploads/slides/41/award9.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>Manifa Central Processing Utilities Storage and Shipping Facilities</strong></span></div>The project congratulates ARCC staff, workers and sub-contractors for attaining <strong> 5 Million Manhours </strong> without lost time injury last January, 2011.', '41', 12),
(193, '/arcc-eei/wp-content/uploads/slides/41/award8.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>North Plot Project</strong></span></div>The project congratulates ARCC staff, workers and sub-contractors for attaining <strong> 20 Million Manhours </strong> without lost time injury last 22th of April, 2010.', '41', 13),
(194, '/arcc-eei/wp-content/uploads/slides/41/cert2.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>Sharq 3rd Expansion Ethylene Plant Project</strong></span></div>The project congratulates ARCC staff, workers and sub-contractors for attaining <strong> 42 Million Manhours </strong> without lost time injury last 31th of July, 2009.', '41', 14),
(180, '/arcc-eei/wp-content/uploads/slides/456/pipeSpool1.png', 'Pipe Spool Fabrication', '456', 0),
(181, '/arcc-eei/wp-content/uploads/slides/456/fab2.png', 'Pipe Spool Fabrication', '456', 0),
(182, '/arcc-eei/wp-content/uploads/slides/456/fab3.png', 'Pipe Spool Fabrication', '456', 0),
(183, '/arcc-eei/wp-content/uploads/slides/453/smpp.png', '', '453', 4),
(184, '/arcc-eei/wp-content/uploads/slides/453/DSC00519.png', '', '4539000', 0),
(185, '/arcc-eei/wp-content/uploads/slides/41/cert3.jpg', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>Jubail United Petrochemical Company</strong></span></div>The project congratulates ARCC staff, workers and sub-contractors for the contribution to the successful completion of <strong> United Complex Shutdown </strong> activities last 20th of June, 2006.', '41', 15),
(186, '/arcc-eei/wp-content/uploads/slides/41/award6.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>Qatif Facilities at Berri Gas Plant Project</strong></span></div>The project congratulates ARCC staff, workers and sub-contractors for attaining <strong> 1 Million Manhours </strong> without lost time injury last 30th of August, 2005.', '41', 16),
(187, '/arcc-eei/wp-content/uploads/slides/41/award5.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>United Olefins Complex Project</strong></span></div>The project congratulates ARCC staff, workers and sub-contractors for attaining <strong> 9 Million Manhours </strong> without lost time injury last 26th of July, 2004.', '41', 17),
(188, '/arcc-eei/wp-content/uploads/slides/43/cert4.jpg', '', '43', 8),
(189, '/arcc-eei/wp-content/uploads/slides/43/cert5.jpg', '', '43', 10),
(190, '/arcc-eei/wp-content/uploads/slides/346/cdo.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Manpower Recruitment</strong></span></div> <ul style="list-style-type:circle !important;text-align: left;width: 700px;margin: 20px auto 0 auto;"><li>ARCC through its partner, EEI Corporation has an established reputable recruitment agency in the Philippines.</li><li>The Company also source semi-skilled manpower in India, Nepal and Bangladesh.</li><li>In the Philippines, its recruitment agency has various offices strategically located in the entire islands.</li></ul>', '3469000', 0),
(191, '/arcc-eei/wp-content/uploads/slides/346/davao.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Manpower Recruitment</strong></span></div> <ul style="list-style-type:circle !important;text-align: left;width: 700px;margin: 20px auto 0 auto;"><li>ARCC through its partner, EEI Corporation has an established reputable recruitment agency in the Philippines.</li><li>The Company also source semi-skilled manpower in India, Nepal and Bangladesh.</li><li>In the Philippines, its recruitment agency has various offices strategically located in the entire islands.</li></ul>', '3469000', 0),
(198, '/arcc-eei/wp-content/uploads/slides/41/award4.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>United Olefins Complex Project</strong></span></div>The project congratulates ARCC staff, workers and sub-contractors for attaining <strong> Best Safety Performance </strong> last March, 2003.', '41', 18),
(199, '/arcc-eei/wp-content/uploads/slides/41/cert4.jpg', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>ARAMCO - Berri Gas Plant Ethane Recovery Plant</strong></span></div>The project congratulates ARCC staff, workers and sub-contractors for attaining <strong> 5 Million Manhours </strong> without lost time injury last 25th of March, 2002.', '41', 19),
(200, '/arcc-eei/wp-content/uploads/slides/41/award3.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>ARAMCO - Berri Gas Plant Ethane Recovery Plant</strong></span></div>The project congratulates ARCC staff, workers and sub-contractors for attaining <strong> The Safest Contractor of the Month </strong> last July, 2001.', '41', 20),
(201, '/arcc-eei/wp-content/uploads/slides/41/award2.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>ARAMCO - Shedgum Gas Plant Debottlenecking Project</strong></span></div>The project congratulates ARCC staff, workers and sub-contractors for attaining <strong> 1 Million Manhours </strong> without lost time injury last 10th of February, 2000.', '41', 21),
(203, '/arcc-eei/wp-content/uploads/slides/453/smppCivil.png', '', '453', 5),
(215, '/arcc-eei/wp-content/uploads/slides/456/fab4.png', 'Pipe Spool Fabrication', '456', 0),
(205, '/arcc-eei/wp-content/uploads/slides/453/smppStruc.png', '', '453', 6),
(206, '/arcc-eei/wp-content/uploads/slides/453/smppScaff.png', '', '453', 7),
(207, '/arcc-eei/wp-content/uploads/slides/453/smppFabric.png', '', '453', 8),
(208, '/arcc-eei/wp-content/uploads/slides/453/smppPiping.png', '', '453', 9),
(209, '/arcc-eei/wp-content/uploads/slides/453/smppElec.png', '', '453', 10),
(210, '/arcc-eei/wp-content/uploads/slides/453/smppWhole.png', '', '453', 11),
(211, '/arcc-eei/wp-content/uploads/slides/41/award1.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>Uthmaniyah Gas Plant</strong></span></div>Phase 2 of the Control System Upgrade for BI-3127.', '41', 22),
(213, '/arcc-eei/wp-content/uploads/slides/456/fab5.png', 'Pipe Spool Fabrication', '456', 0),
(214, '/arcc-eei/wp-content/uploads/slides/456/fab6.png', 'Pipe Spool Fabrication', '456', 0),
(216, '/arcc-eei/wp-content/uploads/slides/346/skillsOlympics4.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2011</strong></span></div> Participants of the Rebar Competition', '428', 29),
(217, '/arcc-eei/wp-content/uploads/slides/41/mh4.png', '<div style="width: 100%;text-align: center;"><span style="color: #043d65;"><strong>SAMREF Clean Fuel Project</strong></span></div>  The project congratulates ARCC staff, workers and sub-contractors for attaining <strong> 5 Million Manhours </strong> without lost time injury.', '419000', 23),
(218, '/arcc-eei/wp-content/uploads/slides/346/skillsOlympics5.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2011</strong></span></div> Saudi nationals participate on the Mensuration Competition', '428', 30),
(219, '/arcc-eei/wp-content/uploads/slides/346/skillsOlympics6.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2011</strong></span></div> Participants of the Piping Competition', '428', 31),
(220, '/arcc-eei/wp-content/uploads/slides/346/skillsOlympics7.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2011</strong></span></div> Participants of the Electrical Competition', '428', 32),
(221, '/arcc-eei/wp-content/uploads/slides/346/skillsOlympics8.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2011</strong></span></div> Participants of the Scaffolding Competition', '428', 33),
(222, '/arcc-eei/wp-content/uploads/slides/346/skillsOlympics9.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2011</strong></span></div> Awarding of the participants who excel on the competition.', '428', 34),
(223, '/arcc-eei/wp-content/uploads/slides/346/skillsOlympics10.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2011</strong></span></div> Awarding of the participants who excel on the competition.', '428', 35),
(227, '/arcc-eei/wp-content/uploads/slides/346/india_recruitment.png', '', '346', 5),
(240, '/arcc-eei/wp-content/uploads/slides/43/oct2012.png', '', '43', 5),
(241, '/arcc-eei/wp-content/uploads/slides/428/skillsOlympicsSaudi.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012: Saudi Edition</strong></span></div>', '453', 12),
(242, '/arcc-eei/wp-content/uploads/slides/428/SKS_Welcome.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012: Saudi Edition</strong></span></div> Welcome Remarks', '453', 13),
(230, '/arcc-eei/wp-content/uploads/slides/428/skills2012.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012</strong></span></div>', '428', 13),
(228, '/arcc-eei/wp-content/uploads/slides/428/welcome2012.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012</strong></span></div> Welcome Remarks', '428', 14),
(229, '/arcc-eei/wp-content/uploads/slides/428/participants2012.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012</strong></span></div> Presentation of all participants per projects', '428', 15),
(232, '/arcc-eei/wp-content/uploads/slides/428/rebar2012.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012</strong></span></div> Participants of the Rebar Competition', '428', 17),
(233, '/arcc-eei/wp-content/uploads/slides/428/welding2012.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012</strong></span></div> Participants of the Welding Competition', '428', 18),
(234, '/arcc-eei/wp-content/uploads/slides/428/piping2012.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012</strong></span></div> Participants of the Piping Competition', '428', 19),
(235, '/arcc-eei/wp-content/uploads/slides/428/electrical2012.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012</strong></span></div> Participants of the Electrical Competition', '428', 20),
(236, '/arcc-eei/wp-content/uploads/slides/428/mensuration2012.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012</strong></span></div> Participants of the Mensuration Competition', '428', 21),
(237, '/arcc-eei/wp-content/uploads/slides/428/mechanical2012.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012</strong></span></div> Participants of the Mechanical Competition', '4289000', 22),
(238, '/arcc-eei/wp-content/uploads/slides/428/eventsWinner2012.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012</strong></span></div> Awarding of the participants who excel on the competition.', '428', 23),
(239, '/arcc-eei/wp-content/uploads/slides/428/pmWinner2012.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012</strong></span></div> Awarding of the Best Project Manager for the year.', '428', 24),
(244, '/arcc-eei/wp-content/uploads/slides/428/SKS_Presentation.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012: Saudi Edition</strong></span></div> Presentation of all participants per projects', '453', 15),
(245, '/arcc-eei/wp-content/uploads/slides/428/SKS_Scaff.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012: Saudi Edition</strong></span></div> Participants of the Scaffolding Competition', '453', 17),
(246, '/arcc-eei/wp-content/uploads/slides/428/SKS_Welding.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012: Saudi Edition</strong></span></div> Participants of the Welding Competition', '453', 16),
(247, '/arcc-eei/wp-content/uploads/slides/428/SKS_Mensuration.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012: Saudi Edition</strong></span></div> Participants of the Mensuration Competition', '453', 18),
(248, '/arcc-eei/wp-content/uploads/slides/428/SKS_Award_Scaff_Champ.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012: Saudi Edition</strong></span></div> Awarding of the participants who excel on the Scaffolding competition, The Champion.', '453', 20),
(249, '/arcc-eei/wp-content/uploads/slides/428/SKS_Award_Scaff_1st.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012: Saudi Edition</strong></span></div> Awarding of the participants who excel on the Scaffolding competition, First Placer.', '453', 21),
(250, '/arcc-eei/wp-content/uploads/slides/428/SKS_Award_Scaff_2nd.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012: Saudi Edition</strong></span></div> Awarding of the participants who excel on the Scaffolding competition, Second Placer.', '453', 22),
(251, '/arcc-eei/wp-content/uploads/slides/428/SKS_Award_Welders.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012: Saudi Edition</strong></span></div> Awarding of the participants who excel on the Welding competition.', '453', 19),
(252, '/arcc-eei/wp-content/uploads/slides/428/SKS_Award_Mensuration.png', '<div style="width: auto;text-align: center;"><span style="color: #043d65;"><strong>Skills Olympics 2012: Saudi Edition</strong></span></div> Awarding of the participants who excel on the Mensuration competition.', '453', 23);
