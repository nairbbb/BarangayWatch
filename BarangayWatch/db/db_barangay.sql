-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2024 at 05:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_barangay`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`admin_id`, `username`, `password`, `firstname`, `lastname`, `email`, `phone_no`) VALUES
(1, 'admin', 'admin', 'Administrator', '', '', ''),
(3, 'emard', '12345', 'Emard', 'Trabado', 'trabado@gmail.com', '543534');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `subject`, `message`, `user_id`) VALUES
(1, 'Hello', 'Hi', 2);

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `file_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `ticket_no` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`file_id`, `file_name`, `file_type`, `ticket_no`, `user_id`) VALUES
(1, 'Screenshot 2023-10-13 222853.png', 'image', 694937217, 1),
(2, 'Screenshot 2023-10-13 224409.png', 'image', 694937217, 1),
(3, 'Screenshot 2023-10-13 225839.png', 'image', 694937217, 1),
(4, 'WIN_20231121_15_26_21_Pro.jpg', 'image', 189762166, 1),
(5, 'suntukan rec.mp4', 'video', 189762166, 1),
(6, 'Screenshot 2024-04-29 165553.png', 'image', 564494108, 2);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `post` text NOT NULL,
  `author` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `title`, `post`, `author`, `date_created`) VALUES
(1, 'Sunog sumiklab sa Paco, Maynila', 'MANILA – Sumiklab ang sunog sa bahagi ng Paco Market sa Maynila nitong Sabado ng gabi.<br />\r\n<br />\r\nAyon sa Manila Disaster Risk Reduction and Management Office, umabot na sa ika-limang alarma ang sunog.<br />\r\n<br />\r\nNakunan naman ng ABS-CBN News crew na kumakalat na rin ito sa katabing Paco Catholic School.<br />\r\n<br />\r\n Tuloy-tuloy ang pag-apula ng mga awtoridad sa sunog.', '1', '2024-04-29 16:20:12'),
(2, '&#039;Literal warm welcome&#039;: Poe tells NAIA, Iloilo airport to fix air conditioning', 'MANILA — Sen. Grace Poe on Monday told the managements of the Ninoy Aquino International Airport and the Iloilo International Airport to fix their air conditioning systems, as the country continues to experience record heat this dry season. <br />\r\n<br />\r\nPoe, chair of the Senate Committee on Public Services, also urged the airports to fix their broken elevators, which she said were causing inconvenience to passengers.<br />\r\n<br />\r\nThe Manila International Airport Authority said that repairs were ongoing as of Sunday.<br />\r\n<br />\r\n&quot;Sa bawat airport, gusto nating bigyan ng warm welcome ang bawat biyahero. Naging literal naman yata ang &#039;warm&#039; sa NAIA at Iloilo airport dahil parang pugon daw sa init ang loob nito dahil sa sirang aircon,&quot; Poe said in a statement. ', '1', '2024-04-29 16:20:46'),
(3, 'Labor unions in gov&#039;t to be recognized via amended rules on self-organization', 'MANILA — National employee organizations within the public sector will be recognized under the 2024 Implementing Rules and Regulations (IRR) on the right of government employees to self-organize.<br />\r\nhe registration of national unions in government for Collective Negotiation Agreements is one of the salient points of the revised rules under Executive Order No. 180 series of 1987 or Governing the Exercise of the Right of Government Employees to Self-Organize, according to officials of the Public Sector Labor Management Council.<br />\r\n<br />\r\nRELATED: Transport, labor groups join forces vs franchise consolidation deadline<br />\r\n<br />\r\nThe ceremonial signing of the amended IRR was led by officials of the Department of Justice, Civil Service Commission, Department of Labor and Employment, Department of Finance and Department of Budget and Management.<br />\r\n<br />\r\n“We recognize, of course, that the new rules and regulations may not be absolutely perfect, considering the dynamic environment that they operate within. However, this acknowledgment should not deter us from actively engaging in shaping the trajectory of employee relations in the public sector,” CSC Chairperson Karlo Nograles said.<br />\r\n<br />\r\nThe government is the country&#039;s biggest employer, but it also has the most contractual workers.<br />\r\n<br />\r\nOther amendments in the IRR are clearer qualifications and criteria for personnel eligibility to join employee organizations, the use of electronic filing of pleadings and documents and online platforms, integration of new council policies, employee elections, among others.<br />\r\n<br />\r\n“Sa pagtutulong-tulong po ng ibang departamento sa pangunguna ng Civil Service Commission, napapanatili po natin ang tinatawag na industrial peace sa public sector at sa bahagi po ng Department of Labor and Employment kami po ay nagpapahayag ng taimtim at taos-pusong pasasalamat at pagsasabi na patuloy po kami na magbibigay ng aming ambag at kontribusyon para sa kapakanan ng ating mga manggagawa sa public sector,” said DOLE Sec. Bienvenido Laguesma.<br />\r\n<br />\r\n(With the cooperation of various agencies, we are able to maintain industrial peace in the public sector. For us in the DOLE, we will continue to contribute for the sake of  workers in the public sector.)<br />\r\n<br />\r\nThe 1987 IRR of EO No. 180 was last amended in 2004.<br />\r\n<br />\r\n“The rules we signed today are a promise — a promise to safeguard the rights of those who serve our country, to support their well-being and to recognize their invaluable contribution to our nation,” said DOJ Secretary Jesus Crispin Remulla in the statement read by Undersecretary Fredderick Vida.', '1', '2024-04-29 16:21:57'),
(4, 'Jeepney drivers raise a flag against franchise consolidation', 'Jeepney drivers and operators set up banners as they hold a transport strike along the Roxas Boulevard Service Road near the corner of EDSA in Pasay on Monday. Jeepney drivers and operators, led by PISTON, held another round of a 3-day transport strike from April 29 to May 1, opposing the April 30 deadline for franchise consolidation as part of the Public Utility Vehicle Modernization Program, citing its impact on their livelihood.', '1', '2024-04-29 16:22:21'),
(5, 'Marcos leads Bangsamoro Police Basic Course graduation rites', 'President Ferdinand Marcos Jr. leadsthe graduation of Bangsamoro Police Basic Course Batch 2023-01 class of Alpha Bravo “Baklas-Lipi” at the Municipality of Parang, Province of Maguindanao del Norte on Monday, April 29, 2024. The 100 graduates who completed their training are former members of the Moro Islamic Liberation Front (MILF) and Moro National Liberation Front (MNLF). Their integration into the national police force is provided for under the Bangsamoro Organic Law (BOL), the charter of the Bangsamoro Autonomous Region in Muslim Mindanao (BARMM), which mandates the waiving of age, height, and education attainment requirements to facilitate the entry of MNLF and MILF members into the police force.', '1', '2024-04-29 16:22:46'),
(6, 'Marcos urged anew to shut down POGOs in Philippines', 'MANILA — President Ferdinand Marcos Jr. is once again being urged to shut down the Philippine Offshore Gaming Operations (POGOs) in the Philippines.<br />\r\n<br />\r\nSen. Risa Hontiveros on Monday said that the &quot;very serious&quot; social cost of POGOs outweighs the benefit. <br />\r\n<br />\r\n&quot;Ang liit-liit ng proceeds diyan, ang laki-laki pa rin ng tax obligations nila,&quot; she told ANC.<br />\r\n<br />\r\n(The proceeds are small, and their tax obligations are huge.)', '1', '2024-04-29 16:25:08');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `ticket_no` int(11) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `report_category` varchar(40) NOT NULL,
  `address` text NOT NULL,
  `date` datetime NOT NULL,
  `status_report` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `ticket_no`, `subject`, `message`, `report_category`, `address`, `date`, `status_report`, `user_id`) VALUES
(1, 694937217, 'maingay na kapitbahay', 'magpadala na po kayo ng tanod, nag aaway po yung kapitbahay ko. madaling araw na nakakaabala sila', 'Noise Complaint', 'Paz Mendoza Guazon Street, Paco, Fifth District, Manila, Capital District, Metro Manila, 1007, Philippines', '2024-04-29 16:31:26', 'Resolved', 1),
(2, 189762166, 'suntukan ayaw magpaawat', 'pumunta na po kayo asap, mukang magpapatayan na po sila.', 'Harrasment', 'Paz Mendoza Guazon Street, Paco, Fifth District, Manila, Capital District, Metro Manila, 1007, Philippines', '2024-04-29 16:41:29', 'Onhold', 1),
(3, 564494108, 'magpadala ng tanod or enforcer', 'may nakaharang na sasakyan sa tapat po ng gate namin di po kami makalabas', 'Blocking Driving', 'Paz Mendoza Guazon Street, Paco, Fifth District, Manila, Capital District, Metro Manila, 1007, Philippines', '2024-04-29 16:56:17', 'Rejected', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(20) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `email`, `password`, `phone_no`, `status`) VALUES
(1, 'John', 'Smith', 'john@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '76543', 0),
(2, 'mard', 'villaspin', 'mard@gmail.com', 'a4942cc55b6fb1ca9f23a5d15c420703', '09661595280', 0),
(3, 'magno', 'dizon', 'magno@gmail.com', '25f9e794323b453885f5181f1b624d0b', '0956784311', 0),
(4, 'makmak', 'molleda', 'molleda@gmail.com', '25f9e794323b453885f5181f1b624d0b', '09786555442', 0),
(5, 'emill', 'vasquez', 'emill@gmail.com', '25f9e794323b453885f5181f1b624d0b', '098765432110', 0),
(6, 'vincent', 'salamat', 'salamat@gmail.com', '25f9e794323b453885f5181f1b624d0b', '09876654321', 0),
(7, 'bong ', 'vasquez', 'vasquez@gmail.com', '25f9e794323b453885f5181f1b624d0b', '09788556321', 0),
(8, 'jelbert', 'gonzalez', 'jel@gmail.com', '25f9e794323b453885f5181f1b624d0b', '09876543211', 0),
(9, 'obet', 'ugali', 'ugali@gmail.com', '25f9e794323b453885f5181f1b624d0b', '09788556342', 0),
(10, 'lorenz', 'luistro', 'lorenz@gmail.com', '25f9e794323b453885f5181f1b624d0b', '09877555631', 0),
(11, 'noy', 'castillo', 'noy@gmail.com', '25f9e794323b453885f5181f1b624d0b', '09985478657', 0),
(12, 'kawhi ', 'leonard', 'kawhi@GMAIL.COM', '25f9e794323b453885f5181f1b624d0b', '0988676734565', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
