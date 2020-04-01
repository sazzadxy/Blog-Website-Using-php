-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 01, 2020 at 01:39 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_oop`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `subject`, `description`, `slug`, `created_at`, `status`) VALUES
(1, 'mendes', 'mendes@gmail.com', '', 'nice stuff', 'Winnie-the-Pooh', '2020-03-25', 1),
(5, 'gomez', 'gomez@hotmail.com', 'pooh', 'ok', 'Winnie-the-Pooh', '2020-03-26', 1),
(6, 'evan', 'evan@mail.com', 'cartoon', '1960s with the release of Letraset sheets ', 'multiple-tagged-post', '2020-03-26', 1),
(7, 'silva', 'silva@mail.com', 'tom & jerry', 'versions of Lorem Ipsum', 'multiple-tagged-post', '2020-03-27', 1),
(8, 'mendes', 'mendes@gmail.com', '', ' Aldus PageMaker including versions of Lorem Ipsum', 'multiple-tagged-post', '2020-03-27', 1),
(9, 'gomez', 'gomez@hotmail.com', 'cartoon', 'you and your friends do on these social channels', 'multiple-tagged-post5e7b80b2e8e07', '2020-03-27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `slug` varchar(122) COLLATE utf8_unicode_ci NOT NULL,
  `user` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `image`, `created_at`, `slug`, `user`) VALUES
(136, 'Winnie the Pooh', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'pooh.png', '2020-03-21 10:50:24', 'Winnie-the-Pooh', 'admin'),
(137, 'multiple tagged post', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'Tomgf.jpg', '2020-03-21 11:28:25', 'multiple-tagged-post', 'admin1'),
(139, 'multiple tagged post', '<p>This real time notification system keeps track of every action you and your friends do on these social channels. Notifications form a big part of the real time engagement feature of these platforms. Even you are not online, you could still receive these notifications. A PHP notification system could be could be easily built using a mix of vanilla PHP and JavaScript. This system provides real time notification in a PHP powered application.</p>', 'maxresdefault.jpg', '2020-03-25 10:02:58', 'multiple-tagged-post5e7b80b2e8e07', 'admin'),
(140, 'posts get by slug', '<p>The pagination component should be wrapped in a &lt;nav&gt; element to identify it as a navigation section to screen readers and other assistive technologies. In addition, as a page is likely to have more than one such navigation section already (such as the primary navigation in the header, or a sidebar navigation), it is advisable to provide a descriptive aria-label for the &lt;nav&gt; which reflects its purpose. For example, if the pagination component is used to navigate between a set of search results, an appropriate label could be aria-label=\"Search results pages\"</p>', 'pooh.jpg', '2020-03-25 01:14:10', 'posts-get-by-slug', 'admin'),
(141, 'loren ipsem doler', '<p>The \"<strong>invalid argument supplied for foreach()</strong> \" errorâ€‹ occurs when PHP\'s built-in <strong>foreach()</strong> tries to iterate over a data structure that is not recognized as an array or object. // a list/array, a boolean FALSE is returned.&nbsp;</p>', 'maxresdefault.jpg', '2020-03-28 04:56:13', 'loren-ipsem-doler', 'admin1'),
(142, 'Popeye The Sailor', '<p>Popeye is a scrappy little seaman with bulging forearms, a squinty eye, and a screwed-up face, punctuated with an ever-present pipe in his mouth. He is always ready for a fight instead of a reasonable discussion, has a gravelly voice, and is constantly mumbling under his breath. His credo is â€œI yam what I yam, and thatâ€™s all what I yam.â€ His girlfriend is the gangly, uncoordinated <a href=\"https://www.britannica.com/topic/Olive-Oyl\">Olive Oyl</a>, for whose attention Popeye vies constantly with Bluto, his bearded, hulking rival. Other recurring characters include J. Wellington Wimpy, a hamburger-loving coward; Sweeâ€™pea, Popeyeâ€™s adopted baby (whom he calls his â€œinfinkâ€); and Poopdeck Pappy, Popeyeâ€™s anarchic father.</p><p>From 1933 to 1942 brothers <a href=\"https://www.britannica.com/biography/Fleischer-brothers\">Max and Dave Fleischer</a> produced numerous cartoon short subjects in which an animated Popeye was voiced by Jack Mercer and other actors. In the 1960s and â€™70s Popeye cartoons were made for American television, where the old cartoons also found a wide audience. Popeye comic books were produced from the 1930s to the 1970s. The likenesses of Popeye and other characters in the strip were widely marketed on toys, clothing, and other merchandise. <a href=\"https://www.britannica.com/biography/Robin-Williams\">Robin Williams</a> portrayed the old salt in the live-action film <i>Popeye</i> (1980).</p>', 'popye.jpg', '2020-03-29 12:21:04', 'Popeye-The-Sailor', 'admin1'),
(143, ' animated tv series', '<p>Like any boys trying to survive their adolescence, Ed, Edd and Eddy are as clueless about girls as everything else. Eddy may not be the brains of the trio, but he\'s the \"idea guy,\" always scheming and dragging his buddies along. Ed, Edd and Eddy go on summertime adventures involving part-time jobs, treehouses and of course, girls. Under the unofficial leadership of Eddy, the trio frequently invent schemes to make money from their peers to purchase their favourite confection. Their plans usually fail, leaving them in various, often humiliating, predicaments.</p><p>. The show attracted an audience of 31 million households, was broadcast in 120 countries, and proved to be popular among children, teenagers, and adults. With nearly an 11-year run, <i>Ed, Edd n Eddy</i> is currently the longest-running Cartoon Network original series.</p>', 'E.png', '2020-03-31 11:03:31', 'Ed-Edd-n-Eddy-animated-television-series', 'admin'),
(144, 'test post1', '<ul><li>Try again later.</li><li>Check your network connection.</li><li>If you are connected but behind a firewall, check that Firefox has permission to access the Web.</li></ul>', '89676193_116736863271493_4330795062779707392_o.jpg', '2020-04-01 07:37:53', 'test-post1', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE `post_tags` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post_tags`
--

INSERT INTO `post_tags` (`post_id`, `tag_id`) VALUES
(136, 1),
(136, 2),
(136, 3),
(137, 2),
(137, 3),
(137, 4),
(138, 3),
(139, 2),
(139, 3),
(140, 1),
(140, 3),
(140, 5),
(141, 1),
(141, 2),
(142, 4),
(143, 10),
(144, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag`) VALUES
(2, 'tom and jerry'),
(3, 'Bugs Bunny'),
(4, 'Popeye'),
(5, 'micky mouse'),
(6, 'doraemon'),
(9, 'Pooh'),
(10, 'Ed, Edd n Eddy'),
(11, 'dragon ball z');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`) VALUES
(3, 'admin', 'admin user', '81dc9bdb52d04dc20036dbd8313ed055'),
(4, 'admin1', 'admin user1', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
