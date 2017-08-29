-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2017 at 04:57 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `posted_by` varchar(60) NOT NULL,
  `posted_to` varchar(60) NOT NULL,
  `date` datetime NOT NULL,
  `removed` varchar(3) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_body`, `posted_by`, `posted_to`, `date`, `removed`, `post_id`) VALUES
(1, 'Ok!', 'indranil_kumar', 'indranil_kumar', '2017-08-12 21:25:24', 'no', 14),
(2, 'I dont think so!', 'indranil_kumar', 'indranil_kumar', '2017-08-12 23:10:39', 'no', 6),
(3, 'Hy\r\n', 'indranil_kumar', 'indranil_kumar', '2017-08-12 23:26:37', 'no', 13),
(4, 'Hy what can i do now?', 'indranil_kumar', 'indranil_kumar', '2017-08-12 23:32:57', 'no', 14),
(5, '', 'indranil_kumar', 'indranil_kumar', '2017-08-12 23:38:11', 'no', 14),
(6, 'Yeah sure bro!!', 'aaditya_raj', 'aaditya_raj', '2017-08-12 23:58:12', 'no', 12),
(7, 'what\'s up MAN??\r\n', 'aaditya_raj', 'indranil_kumar', '2017-08-14 19:10:26', 'no', 13),
(8, 'When?', 'aaditya_raj', 'aaditya_raj', '2017-08-14 19:25:08', 'no', 16),
(9, 'hy', 'aaditya_raj', 'indranil_kumar', '2017-08-17 23:53:57', 'no', 25),
(10, 'hy now!!', 'indranil_kumar', 'aaditya_raj', '2017-08-18 00:14:00', 'no', 20),
(11, 'hy', 'indranil_kumar', 'indranil_kumar', '2017-08-18 00:58:27', 'no', 25),
(12, 'hy', 'aaditya_raj', 'aaditya_raj', '2017-08-18 08:24:37', 'no', 23);

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`id`, `user_to`, `user_from`) VALUES
(1, 'oman_burman', 'indranil_kumar'),
(2, 'neeraj_kumar', 'indranil_kumar'),
(3, 'shubham_vasistha', 'indranil_kumar');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `post_id`) VALUES
(16, 'indranil_kumar', 14),
(21, 'indranil_kumar', 13),
(23, 'aaditya_raj', 14),
(25, 'aaditya_raj', 13),
(30, 'indranil_kumar', 19),
(34, 'indranil_kumar', 23),
(35, 'indranil_kumar', 21),
(37, 'indranil_kumar', 25),
(38, 'aaditya_raj', 25),
(39, 'indranil_kumar', 20),
(40, 'aaditya_raj', 26),
(41, 'aaditya_raj', 9),
(42, 'aaditya_raj', 10),
(43, 'indranil_kumar', 24),
(44, 'indranil_kumar', 16),
(45, 'indranil_kumar', 15),
(46, 'indranil_kumar', 12),
(47, 'indranil_kumar', 11),
(48, 'aaditya_raj', 20),
(49, 'indranil_kumar', 26);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_to`, `user_from`, `body`, `date`, `opened`, `viewed`, `deleted`) VALUES
(1, 'aaditya_raj', 'indranil_kumar', 'Hy what\'s up?', '2017-08-15 11:14:57', 'yes', 'yes', 'no'),
(2, 'aaditya_raj', 'indranil_kumar', ':)\r\n', '2017-08-15 11:25:50', 'yes', 'yes', 'no'),
(3, 'aaditya_raj', 'indranil_kumar', 'Had you lunch?', '2017-08-15 11:26:03', 'yes', 'yes', 'no'),
(5, 'indranil_kumar', 'aaditya_raj', 'Hy ', '2017-08-15 11:57:35', 'yes', 'yes', 'no'),
(6, 'indranil_kumar', 'aaditya_raj', 'No mercy', '2017-08-15 11:57:39', 'yes', 'yes', 'no'),
(7, 'aaditya_raj', 'indranil_kumar', 'Now what?', '2017-08-15 12:40:54', 'yes', 'yes', 'no'),
(8, 'aaditya_raj', 'indranil_kumar', 'Hi again!!', '2017-08-15 13:16:52', 'yes', 'yes', 'no'),
(9, 'aaditya_raj', 'indranil_kumar', 'Atleast reply!!', '2017-08-15 13:21:17', 'yes', 'yes', 'no'),
(10, 'aaditya_raj', 'indranil_kumar', 'yup you can!', '2017-08-15 13:21:37', 'yes', 'yes', 'no'),
(11, 'aaditya_raj', 'indranil_kumar', 'No its going on!', '2017-08-15 13:21:45', 'yes', 'yes', 'no'),
(12, 'aaditya_raj', 'indranil_kumar', 'khfksdkdskf', '2017-08-15 13:21:59', 'yes', 'yes', 'no'),
(13, 'aaditya_raj', 'indranil_kumar', 'jsdsdfiwfhid', '2017-08-15 13:22:03', 'yes', 'yes', 'no'),
(14, 'aaditya_raj', 'indranil_kumar', 'jsdgfidgdif', '2017-08-15 13:22:07', 'yes', 'yes', 'no'),
(15, 'aaditya_raj', 'indranil_kumar', 'dsjjsdfb', '2017-08-15 13:22:11', 'yes', 'yes', 'no'),
(16, 'aaditya_raj', 'indranil_kumar', 'vjsdvjsdb', '2017-08-15 13:25:55', 'yes', 'yes', 'no'),
(17, 'aaditya_raj', 'indranil_kumar', 'hey', '2017-08-15 13:33:38', 'yes', 'yes', 'no'),
(18, 'shubham_vasistha', 'indranil_kumar', 'Hy\r\n', '2017-08-15 15:09:45', 'yes', 'yes', 'no'),
(19, 'indranil_kumar', 'shubham_vasistha', 'Hy\r\n', '2017-08-15 15:14:00', 'yes', 'yes', 'no'),
(20, 'indranil_kumar', 'shubham_vasistha', 'Wha\'s up?', '2017-08-15 15:14:10', 'yes', 'yes', 'no'),
(21, 'indranil_kumar', 'shubham_vasistha', 'kvhsdkvdskbdskbdkbdfblnbkdbvfjdnwqm dkqncasnclnlwemfn;lwefwenf', '2017-08-15 15:14:22', 'yes', 'yes', 'no'),
(22, 'shubham_vasistha', 'indranil_kumar', 'hy man!', '2017-08-15 15:22:27', 'yes', 'yes', 'no'),
(23, 'aaditya_raj', 'indranil_kumar', 'Kya bhai?', '2017-08-15 15:22:43', 'yes', 'yes', 'no'),
(24, 'shubham_vasistha', 'indranil_kumar', 'bdskkkndslvnsdlvnsd', '2017-08-15 15:37:07', 'yes', 'yes', 'no'),
(25, 'aaditya_raj', 'indranil_kumar', 'hy', '2017-08-15 15:37:31', 'yes', 'yes', 'no'),
(26, 'aaditya_raj', 'indranil_kumar', 'hvisddhvihftxcfhgvjhbknjm,..ygvhjbknml', '2017-08-15 15:39:14', 'yes', 'yes', 'no'),
(27, 'shubham_vasistha', 'indranil_kumar', 'fbgdjdsdknaslcas', '2017-08-16 10:18:35', 'yes', 'yes', 'no'),
(28, 'aaditya_raj', 'indranil_kumar', 'hy', '2017-08-16 20:26:54', 'yes', 'yes', 'no'),
(29, 'aaditya_raj', 'indranil_kumar', 'hy', '2017-08-16 20:32:42', 'yes', 'yes', 'no'),
(30, 'aaditya_raj', 'indranil_kumar', 'hello', '2017-08-16 20:33:58', 'yes', 'yes', 'no'),
(31, 'aaditya_raj', 'indranil_kumar', 'hello!', '2017-08-17 08:13:01', 'yes', 'yes', 'no'),
(32, 'aaditya_raj', 'indranil_kumar', 'bvjdfvb', '2017-08-17 08:13:21', 'yes', 'yes', 'no'),
(33, 'shubham_vasistha', 'indranil_kumar', 'hy man', '2017-08-17 13:06:18', 'yes', 'yes', 'no'),
(34, 'aaditya_raj', 'indranil_kumar', 'jsddgsdgs', '2017-08-17 13:07:00', 'yes', 'yes', 'no'),
(35, 'indranil_kumar', 'aaditya_raj', 'hy bro?', '2017-08-17 18:45:53', 'yes', 'yes', 'no'),
(36, 'indranil_kumar', 'shubham_vasistha', 'hy', '2017-08-17 18:47:52', 'yes', 'yes', 'no'),
(37, 'indranil_kumar', 'indranil_kumar_1', 'hy', '2017-08-17 18:49:16', 'yes', 'yes', 'no'),
(38, 'indranil_kumar', 'oman_burman', 'Hy man..what\'s up?', '2017-08-17 18:56:17', 'yes', 'yes', 'no'),
(39, 'indranil_kumar', 'pratush_rai', 'Holla!!', '2017-08-17 18:56:49', 'yes', 'yes', 'no'),
(40, 'indranil_kumar', 'ratnesh_bisen', 'kya yaar!!', '2017-08-17 18:57:23', 'yes', 'yes', 'no'),
(41, 'indranil_kumar', 'ankit_kumar', 'hello brother!', '2017-08-17 19:32:06', 'yes', 'yes', 'no'),
(42, 'indranil_kumar', 'akash_tulsikar', 'yo man yo man!!', '2017-08-17 19:32:41', 'yes', 'yes', 'no'),
(43, 'indranil_kumar', 'rajesh_kumar', 'anime!', '2017-08-17 19:33:06', 'yes', 'yes', 'no'),
(44, 'aaditya_raj', 'indranil_kumar', 'hy long time ha?', '2017-08-17 20:33:59', 'yes', 'yes', 'no'),
(45, 'shubham_vasistha', 'indranil_kumar', 'hy', '2017-08-17 20:34:52', 'no', 'no', 'no'),
(46, 'indranil_kumar', 'aaditya_raj', 'hy', '2017-08-17 21:05:27', 'yes', 'yes', 'no'),
(47, 'indranil_kumar', 'aaditya_raj', 'hello', '2017-08-17 21:05:58', 'yes', 'yes', 'no'),
(48, 'indranil_kumar', 'aaditya_raj', 'hy afterall again!', '2017-08-17 21:15:07', 'yes', 'yes', 'no'),
(49, 'aaditya_raj', 'indranil_kumar', 'hy', '2017-08-17 21:20:00', 'yes', 'yes', 'no'),
(50, 'indranil_kumar', 'aaditya_raj', 'oh man!', '2017-08-18 08:25:39', 'yes', 'yes', 'no'),
(51, 'shubham_vasistha', 'indranil_kumar', 'gyfyuhbkibj', '2017-08-18 08:29:14', 'no', 'no', 'no'),
(52, 'ratnesh_bisen', 'indranil_kumar', 'yo', '2017-08-18 08:29:25', 'no', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `link` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_to`, `user_from`, `message`, `link`, `datetime`, `opened`, `viewed`) VALUES
(1, 'indranil_kumar', 'aaditya_raj', 'Aaditya Raj commented on your post.', 'post.php?id=25', '2017-08-17 23:53:58', 'yes', 'yes'),
(2, 'aaditya_raj', 'indranil_kumar', 'Indranil Kumar commented on your post.', 'post.php?id=20', '2017-08-18 00:14:00', 'yes', 'yes'),
(3, 'aaditya_raj', 'indranil_kumar', 'Indranil Kumar posted on your profile.', 'post.php?id=26', '2017-08-18 00:14:10', 'yes', 'yes'),
(4, 'aaditya_raj', 'indranil_kumar', 'Indranil Kumar commented on your profile post.', 'post.php?id=25', '2017-08-18 00:58:27', 'yes', 'yes'),
(5, 'indranil_kumar', 'aaditya_raj', 'Aaditya Raj commented on your profile post.', 'post.php?id=23', '2017-08-18 08:24:37', 'yes', 'yes'),
(6, 'indranil_kumar', 'aaditya_raj', 'Aaditya Raj posted on your profile.', 'post.php?id=27', '2017-08-18 08:25:16', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `added_by` varchar(60) NOT NULL,
  `user_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `user_to`, `date_added`, `user_closed`, `deleted`, `likes`) VALUES
(1, 'Hy this is my first post.', 'indranil_kumar', 'none', '2017-08-09 21:44:48', 'no', 'no', 0),
(2, 'Same here bro!!', 'aaditya_raj', 'none', '2017-08-10 19:48:46', 'no', 'no', 0),
(3, 'BDW how is you?', 'indranil_kumar', 'none', '2017-08-10 20:20:55', 'no', 'no', 0),
(4, '  I am fine WAU?', 'aaditya_raj', 'none', '2017-08-10 20:21:50', 'no', 'no', 0),
(5, 'here pretty well and awesome.', 'indranil_kumar', 'none', '2017-08-10 20:38:46', 'no', 'no', 0),
(6, 'any tour so far?', 'indranil_kumar', 'none', '2017-08-10 20:41:19', 'no', 'no', 0),
(7, 'anyone dre?', 'indranil_kumar', 'none', '2017-08-10 20:41:56', 'no', 'no', 0),
(8, 'i am so lucky!!', 'indranil_kumar', 'none', '2017-08-10 20:42:08', 'no', 'no', 0),
(9, 'Hie Gaint!\r\n', 'indranil_kumar', 'none', '2017-08-12 12:22:02', 'no', 'no', 1),
(10, 'No more complain...BDW!!', 'indranil_kumar', 'none', '2017-08-12 12:22:21', 'no', 'no', 1),
(11, 'No no not again!!\r\n', 'aaditya_raj', 'none', '2017-08-12 12:22:56', 'no', 'no', 1),
(12, 'let me learn now!', 'aaditya_raj', 'none', '2017-08-12 12:23:09', 'no', 'no', 1),
(13, 'Hello!', 'indranil_kumar', 'none', '2017-08-12 12:23:31', 'no', 'yes', 2),
(14, 'come here!', 'indranil_kumar', 'none', '2017-08-12 12:24:00', 'no', 'yes', 2),
(15, 'No more bro', 'aaditya_raj', 'none', '2017-08-12 12:44:28', 'no', 'no', 1),
(16, 'Coming home!!!', 'aaditya_raj', 'none', '2017-08-12 12:44:38', 'no', 'no', 1),
(17, 'hy                ', 'aaditya_raj', '', '2017-08-14 20:48:22', 'no', 'no', 0),
(18, '        hello        ', 'aaditya_raj', '', '2017-08-14 20:49:09', 'no', 'no', 0),
(19, '  hello buddy!!              ', 'aaditya_raj', 'indranil_kumar', '2017-08-14 20:52:30', 'no', 'no', 1),
(20, '                bye bye!!', 'aaditya_raj', 'none', '2017-08-14 21:15:47', 'no', 'no', 2),
(21, 'First post from profile!                ', 'indranil_kumar', 'none', '2017-08-15 00:00:37', 'no', 'no', 1),
(22, '                hy bud!', 'indranil_kumar', 'aaditya_raj', '2017-08-15 00:39:04', 'no', 'yes', 0),
(23, '                helloo', 'aaditya_raj', 'indranil_kumar', '2017-08-16 10:17:08', 'no', 'no', 1),
(24, 'Now i\' am here!', 'indranil_kumar', 'none', '2017-08-16 13:18:49', 'no', 'yes', 1),
(25, '           hy bro i am here!     ', 'indranil_kumar', 'aaditya_raj', '2017-08-17 13:05:24', 'no', 'yes', 2),
(26, '                helooo MAN!!', 'indranil_kumar', 'aaditya_raj', '2017-08-18 00:14:10', 'no', 'yes', 2),
(27, '      Hy man          ', 'aaditya_raj', 'indranil_kumar', '2017-08-18 08:25:16', 'no', 'no', 0),
(33, ' hy man', 'indranil_kumar', 'none', '2017-08-24 23:35:16', 'no', 'yes', 0),
(34, ' <br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/92XVwY54h5k\'></iframe><br>', 'indranil_kumar', 'none', '2017-08-24 23:35:46', 'no', 'yes', 0),
(35, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/92XVwY54h5k\'></iframe><br>', 'indranil_kumar', 'none', '2017-08-24 23:36:14', 'no', 'yes', 0),
(36, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/92XVwY54h5k\'></iframe><br>', 'indranil_kumar', 'none', '2017-08-24 23:36:27', 'no', 'yes', 0),
(37, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/92XVwY54h5k\'></iframe><br>', 'indranil_kumar', 'none', '2017-08-24 23:37:30', 'no', 'yes', 0),
(38, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/92XVwY54h5k\'></iframe><br>', 'indranil_kumar', 'none', '2017-08-24 23:47:06', 'no', 'yes', 0),
(39, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/92XVwY54h5k\'></iframe><br>', 'indranil_kumar', 'none', '2017-08-24 23:47:21', 'no', 'yes', 0),
(40, 'hey now brown cow.', 'indranil_kumar', 'none', '2017-08-28 20:18:09', 'no', 'no', 0),
(41, '#republic', 'indranil_kumar', 'none', '2017-08-28 20:18:30', 'no', 'no', 0);

-- --------------------------------------------------------

--
-- Table structure for table `trends`
--

CREATE TABLE `trends` (
  `title` varchar(50) NOT NULL,
  `hits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trends`
--

INSERT INTO `trends` (`title`, `hits`) VALUES
('Brown', 1),
('Cow', 1),
('Republic', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `num_posts` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `friend_array` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`) VALUES
(1, 'Neeraj', 'Kumar', 'neeraj_kumar', 'neeraj@gmail.com', '123456', '2017-07-25', 'jigcj', 1, 1, 'no', ',indranil_kumar,'),
(2, 'Kumar', 'Kumar', '0', 'Ny29599@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2017-07-25', 'assets/images/profile_pics/defaults/user.png', 0, 0, 'no', '.'),
(3, 'Yadav', 'Yadav', '1', 'Ny2599@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2017-07-25', 'assets/images/profile_pics/defaults/user.png', 0, 0, 'no', '.'),
(4, 'Santosh', 'Kumar', '3', 'Santosh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2017-07-25', 'assets/images/profile_pics/defaults/user.png', 0, 0, 'no', '.'),
(5, 'Indranil', 'Kumar', 'indranil_kumar', 'Indro@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2017-07-25', 'assets/images/profile_pics/indranil_kumarc0c3c848b80551ae8a5181013b8aaad6n.jpeg', 29, 12, 'no', ',aaditya_raj,'),
(6, 'Indranil', 'Kumar', 'indranil_kumar_1', 'Indrome@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2017-07-25', 'assets/images/profile_pics/defaults/user2.png', 0, 0, 'no', '.'),
(7, 'Shubham', 'Vasistha', 'shubham_vasistha', 'Subham@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2017-07-27', 'assets/images/profile_pics/defaults/user.png', 0, 0, 'no', ','),
(8, 'Aaditya', 'Raj', 'aaditya_raj', 'Aaditya@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2017-07-27', 'assets/images/profile_pics/aaditya_rajaed1d5854c4739a18151488ced85ebaan.jpeg', 12, 8, 'no', ',indranil_kumar,'),
(9, 'Oman', 'Burman', 'oman_burman', 'Oman@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2017-08-17', 'assets/images/profile_pics/defaults/user2.jpg', 0, 0, 'no', '.'),
(10, 'Pratush', 'Rai', 'pratush_rai', 'Pratush@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2017-08-17', 'assets/images/profile_pics/defaults/user.jpg', 0, 0, 'no', '.'),
(11, 'Ratnesh', 'Bisen', 'ratnesh_bisen', 'Ratnesh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2017-08-17', 'assets/images/profile_pics/defaults/user.jpg', 0, 0, 'no', '.'),
(12, 'Ankit', 'Kumar', 'ankit_kumar', 'Ankit@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2017-08-17', 'assets/images/profile_pics/defaults/user.jpg', 0, 0, 'no', '.'),
(13, 'Akash', 'Tulsikar', 'akash_tulsikar', 'Akash@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2017-08-17', 'assets/images/profile_pics/defaults/user.jpg', 0, 0, 'no', '.'),
(14, 'Rajesh', 'Kumar', 'rajesh_kumar', 'Rajesh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2017-08-17', 'assets/images/profile_pics/defaults/user.jpg', 0, 0, 'no', '.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
