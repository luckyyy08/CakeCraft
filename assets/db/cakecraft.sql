-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2026 at 06:38 AM
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
-- Database: `cakecraft`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$5tiTIZiSMFdx7w297VxeKe.CU.xkmd78RYicy6VbITkgnPgljx9XW');

-- --------------------------------------------------------

--
-- Table structure for table `cakes`
--

CREATE TABLE `cakes` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `original_price` int(11) DEFAULT 0,
  `type` enum('egg','eggless') DEFAULT 'eggless',
  `flavor` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cakes`
--

INSERT INTO `cakes` (`id`, `category_id`, `name`, `price`, `original_price`, `type`, `flavor`, `image`, `description`, `created_at`) VALUES
(1, 1, 'Funfetti Fiesta', 449, 549, 'eggless', 'vanilla', 'bdcake1.jpeg', 'Colorful sprinkles inside and out, perfect for a joyful celebration.', '2026-03-08 18:52:15'),
(2, 1, 'Chocolate Overload', 549, 649, 'egg', 'chocolate', 'bdcake2.jpeg', 'Layers of dark chocolate ganache topped with chocolate chunks.', '2026-03-08 18:52:15'),
(3, 1, 'Rainbow Sprinkle Surprise', 499, 599, 'eggless', 'vanilla', 'bdcake3.jpeg', 'A vibrant rainbow-layered cake hidden under white frosting.', '2026-03-08 18:52:15'),
(4, 1, 'Cookies & Cream Dream', 529, 649, 'eggless', 'oreo', 'bdcake4.jpeg', 'Crunchy Oreo bits blended with smooth vanilla cream.', '2026-03-08 18:52:15'),
(5, 1, 'Strawberry Shortcake Classic', 399, 499, 'egg', 'strawberry', 'bdcake5.jpeg', 'Light sponge cake with fresh strawberries and whipped cream.', '2026-03-08 18:52:15'),
(6, 1, 'Nutella Hazelnut Blast', 649, 799, 'eggless', 'chocolate', 'bdcake6.jpeg', 'Rich Nutella spread with crunchy hazelnuts.', '2026-03-08 18:52:15'),
(7, 1, 'Caramel Popcorn Crunch', 599, 749, 'eggless', 'caramel', 'bdcake7.jpeg', 'Sweet caramel glaze topped with salty popcorn.', '2026-03-08 18:52:15'),
(8, 1, 'Magic Unicorn Swirl', 699, 899, 'eggless', 'strawberry', 'bdcake8.jpeg', 'Colorful pastel swirls with a golden unicorn horn.', '2026-03-08 18:52:15'),
(9, 1, 'Galaxy Mirror Glaze', 749, 949, 'egg', 'chocolate', 'bdcake9.jpeg', 'Shiny space-themed glaze with edible stars.', '2026-03-08 18:52:15'),
(10, 2, 'The Yes Rose Gold Cake', 849, 999, 'eggless', 'vanilla', 'ecake1.jpeg', 'Elegant rose gold finish with delicate edible flowers.', '2026-03-08 18:52:15'),
(11, 2, 'Marbled Romance', 899, 1099, 'eggless', 'chocolate', 'ecake2.jpeg', 'Modern grey and pink marble design for a sophisticated look.', '2026-03-08 18:52:15'),
(12, 2, 'Hand-Painted Floral Blush', 1099, 1299, 'egg', 'fruit', 'ecake3.jpeg', 'Artistic hand-painted flowers on a smooth fondant base.', '2026-03-08 18:52:15'),
(13, 2, 'Champagne & Strawberries', 949, 1149, 'eggless', 'strawberry', 'ecake4.jpeg', 'Infused with premium flavors for a luxurious celebration.', '2026-03-08 18:52:15'),
(14, 2, 'Gilded Heart Tier', 1199, 1499, 'eggless', 'red velvet', 'ecake5.jpeg', 'Two-tier masterpiece with gold-leafed heart accents.', '2026-03-08 18:52:15'),
(15, 2, 'Modern Geometric Love', 999, 1249, 'egg', 'chocolate', 'ecake6.jpeg', 'Bold shapes and gold lines for a modern couple.', '2026-03-08 18:52:15'),
(16, 2, 'Pearl & Lace Delicacy', 1149, 1399, 'eggless', 'vanilla', 'ecake7.jpeg', 'Elegant edible pearls with intricate lace work.', '2026-03-08 18:52:15'),
(17, 2, 'Rustic Semi-Naked Berry', 799, 999, 'eggless', 'fruit', 'ecake8.jpeg', 'Natural look with fresh forest berries and light cream.', '2026-03-08 18:52:15'),
(18, 2, 'Forever & Always Velvet', 949, 1149, 'eggless', 'red velvet', 'ecake9.jpeg', 'Deep red cake with a Forever topper.', '2026-03-08 18:52:15'),
(19, 3, 'Grand Ivory Cascade', 3999, 4799, 'eggless', 'vanilla', 'wcake1.jpeg', 'Elegant multi-tier cake with cascading white cream roses.', '2026-03-08 18:52:15'),
(20, 3, 'Vintage Victorian Lace', 4499, 5399, 'eggless', 'butterscotch', 'wcake2.jpeg', 'Intricate edible lace design for a royal vintage feel.', '2026-03-08 18:52:15'),
(21, 3, 'White Truffle Elegance', 3499, 4199, 'egg', 'white chocolate', 'wcake3.jpeg', 'Smooth white truffle finish with a minimalist touch.', '2026-03-08 18:52:15'),
(22, 3, 'Sugar Orchid Tower', 5999, 6999, 'eggless', 'fruit', 'wcake4.jpeg', 'Tall multi-tier cake with handmade sugar orchids.', '2026-03-08 18:52:15'),
(23, 3, 'Silver Leaf Majesty', 5499, 6399, 'eggless', 'vanilla', 'wcake5.jpeg', 'Real silver leafing on a pristine white base.', '2026-03-08 18:52:15'),
(24, 3, 'Pressed Wildflower Tier', 4299, 5199, 'egg', 'strawberry', 'wcake6.jpeg', 'Delicate look with colorful pressed edible flowers.', '2026-03-08 18:52:15'),
(25, 3, 'Classic Gold Foil Ribbon', 4999, 5999, 'eggless', 'chocolate', 'wcake7.jpeg', 'Timeless design with a 24k gold foil ribbon effect.', '2026-03-08 18:52:15'),
(26, 3, 'Minimalist Satin Smooth', 2999, 3599, 'eggless', 'vanilla', 'wcake8.jpeg', 'Clean lines and satin-smooth finish for modern weddings.', '2026-03-08 18:52:15'),
(27, 3, 'Royal Grandeur Multi-Tier', 6499, 7599, 'eggless', 'red velvet', 'wcake9.jpeg', 'Our most luxurious cake with royal icing and 5 tiers.', '2026-03-08 18:52:15'),
(28, 4, 'Ruby Red Anniversary', 699, 849, 'eggless', 'red velvet', 'acake1.jpeg', 'Deep red velvet layers symbolizing deep love and passion.', '2026-03-08 18:52:15'),
(29, 4, 'Silver Jubilee Sparkle', 1199, 1499, 'eggless', 'vanilla', 'acake2.jpeg', 'Shimmering silver accents perfect for a 25th-year celebration.', '2026-03-08 18:52:15'),
(30, 4, 'Golden Years Vanilla', 1399, 1699, 'eggless', 'vanilla', 'acake3.jpeg', 'Prestigious gold-themed cake for the 50th milestone.', '2026-03-08 18:52:15'),
(31, 4, 'Eternal Love Chocolate', 749, 899, 'egg', 'chocolate', 'acake4.jpeg', 'Deep chocolate ganache with interlocking hearts.', '2026-03-08 18:52:15'),
(32, 4, 'Sweet Memories Photo Cake', 999, 1249, 'eggless', 'custom', 'acake5.jpeg', 'Edible photo print of your favorite memory.', '2026-03-08 18:52:15'),
(33, 4, 'First Year Bloom', 599, 749, 'eggless', 'strawberry', 'acake6.jpeg', 'Light floral design for the first milestone.', '2026-03-08 18:52:15'),
(34, 4, 'Diamond Jubilee White', 1499, 1799, 'eggless', 'vanilla', 'acake7.jpeg', 'Sparkling diamond-like crystals on a white base.', '2026-03-08 18:52:15'),
(35, 4, 'Timeless Toffee Crunch', 649, 799, 'egg', 'butterscotch', 'acake8.jpeg', 'Classic toffee bits for a timeless taste.', '2026-03-08 18:52:15'),
(36, 4, 'Heart-to-Heart Velvet', 799, 999, 'eggless', 'red velvet', 'acake9.jpeg', 'Heart-shaped red velvet for a romantic evening.', '2026-03-08 18:52:15'),
(37, 5, 'Little Dreamer Clouds', 899, 1099, 'eggless', 'vanilla', 'bcake1.jpeg', 'Soft blue and white cloud theme for the new arrival.', '2026-03-08 18:52:15'),
(38, 5, 'Teddy Bear Picnic', 1199, 1499, 'eggless', 'chocolate', 'bcake2.jpeg', 'Adorable edible teddy bear toppers on a rustic basket design.', '2026-03-08 18:52:15'),
(39, 5, 'Gender Reveal Mystery', 999, 1249, 'egg', 'custom', 'bcake3.jpeg', 'Surprise inside! Reveals pink or blue sponge when cut.', '2026-03-08 18:52:15'),
(40, 5, 'Oh Baby Pastel Ombre', 849, 1049, 'eggless', 'strawberry', 'bcake4.jpeg', 'Smooth ombre shading with a gold topper.', '2026-03-08 18:52:15'),
(41, 5, 'Twinkle Twinkle Little Star', 949, 1199, 'eggless', 'vanilla', 'bcake5.jpeg', 'Midnight blue base with golden twinkling stars.', '2026-03-08 18:52:15'),
(42, 5, 'Boho Safari Adventure', 1499, 1899, 'eggless', 'butterscotch', 'bcake6.jpeg', 'Cute safari animals in a bohemian style.', '2026-03-08 18:52:15'),
(43, 5, 'Sleeping Elephant Cute', 1199, 1499, 'egg', 'chocolate', 'bcake7.jpeg', 'A peaceful sleeping elephant made of sugar.', '2026-03-08 18:52:15'),
(44, 5, 'Peach & Cream Ruffles', 799, 999, 'eggless', 'fruit', 'bcake8.jpeg', 'Delicate peach-colored cream ruffles.', '2026-03-08 18:52:15'),
(45, 5, 'Blueberry Sky Delight', 699, 849, 'eggless', 'blueberry', 'bcake9.jpeg', 'Light blueberry cake with fluffy sky-blue cream.', '2026-03-08 18:52:15'),
(46, 6, 'Smarty Pants Chocolate', 549, 699, 'eggless', 'chocolate', 'gcake1.jpeg', 'Fun design with a graduation cap and mini chocolate books.', '2026-03-08 18:52:15'),
(47, 6, 'Cap & Gown Glory', 799, 999, 'egg', 'vanilla', 'gcake2.jpeg', 'Classic black and white graduation theme with a tassel.', '2026-03-08 18:52:15'),
(48, 6, 'Future Leader Fruit Cake', 699, 849, 'eggless', 'fruit', 'gcake3.jpeg', 'Healthy fruit layers for a bright future.', '2026-03-08 18:52:15'),
(49, 6, 'Diploma Scroll Delight', 599, 749, 'eggless', 'butterscotch', 'gcake4.jpeg', 'Features a handmade edible diploma scroll.', '2026-03-08 18:52:15'),
(50, 6, 'The World Awaits Map', 1099, 1399, 'eggless', 'chocolate', 'gcake5.jpeg', 'Beautiful map design for the graduate starting a new journey.', '2026-03-08 18:52:15'),
(51, 6, 'Bright Future Lemon', 499, 599, 'eggless', 'fruit', 'gcake6.jpeg', 'Zesty lemon flavor for a fresh start.', '2026-03-08 18:52:15'),
(52, 6, 'Class of 2026 Masterpiece', 1299, 1599, 'eggless', 'red velvet', 'gcake7.jpeg', 'Large celebration cake with the graduation year.', '2026-03-08 18:52:15'),
(53, 6, 'Dream Big Blueberry', 699, 849, 'egg', 'fruit', 'gcake8.jpeg', 'Rich blueberry flavor with Dream Big message.', '2026-03-08 18:52:15'),
(54, 6, 'Achievement Award Gold', 999, 1249, 'eggless', 'vanilla', 'gcake9.jpeg', 'Trophy-shaped cake with golden finish.', '2026-03-08 18:52:15'),
(55, 7, 'The Corner Office Cake', 899, 1099, 'eggless', 'chocolate', 'pcake1.jpeg', 'Professional desk-themed cake to celebrate a new position.', '2026-03-08 18:52:15'),
(56, 7, 'Ladder to Success', 1199, 1499, 'eggless', 'vanilla', 'pcake2.jpeg', '3D ladder design climbing up the tiers.', '2026-03-08 18:52:15'),
(57, 7, 'Corporate Boss Black Forest', 649, 799, 'egg', 'chocolate', 'pcake3.jpeg', 'Classic black forest with a professional touch.', '2026-03-08 18:52:15'),
(58, 7, 'Next Level Lemon Tart', 549, 699, 'eggless', 'fruit', 'pcake4.jpeg', 'Sharp lemon tart flavor for the next career step.', '2026-03-08 18:52:15'),
(59, 7, 'Hard Work Pays Off', 799, 999, 'eggless', 'butterscotch', 'pcake5.jpeg', 'Gold coin accents to celebrate success.', '2026-03-08 18:52:15'),
(60, 7, 'Office Party Piñata', 1499, 1899, 'eggless', 'chocolate', 'pcake6.jpeg', 'Fun chocolate shell filled with treats, comes with a hammer!', '2026-03-08 18:52:15'),
(61, 7, 'Strategic Success Sponge', 749, 949, 'egg', 'vanilla', 'pcake7.jpeg', 'Chess-themed design for the strategic thinker.', '2026-03-08 18:52:15'),
(62, 7, 'The Executive Suite', 1399, 1699, 'eggless', 'red velvet', 'pcake8.jpeg', 'Luxury suite design for top-level promotions.', '2026-03-08 18:52:15'),
(63, 7, 'Moving On Up Mocha', 899, 1099, 'eggless', 'coffee', 'pcake9.jpeg', 'Rich mocha flavor for the corporate high-flyer.', '2026-03-08 18:52:15'),
(64, 8, 'The Gamers Controller', 1499, 1899, 'eggless', 'chocolate', 'ccake1.jpeg', 'Realistic 3D controller cake for hardcore gamers.', '2026-03-08 18:52:15'),
(65, 8, 'Sports Fanatic Arena', 1999, 2499, 'egg', 'vanilla', 'ccake2.jpeg', 'Stadium design for your favorite sport.', '2026-03-08 18:52:15'),
(66, 8, 'Travelers Suitcase', 1799, 2199, 'eggless', 'butterscotch', 'ccake3.jpeg', 'Vintage suitcase with edible passport and tags.', '2026-03-08 18:52:15'),
(67, 8, 'Retro Disco Fever', 1299, 1599, 'eggless', 'strawberry', 'ccake4.jpeg', 'Shiny disco ball effect with neon colors.', '2026-03-08 18:52:15'),
(68, 8, 'Movie Night Popcorn', 1199, 1499, 'eggless', 'caramel', 'ccake5.jpeg', 'Bucket design filled with marshmallow popcorn.', '2026-03-08 18:52:15'),
(69, 8, 'Space Explorer Mars', 1699, 2099, 'egg', 'chocolate', 'ccake6.jpeg', 'Red planet surface design with galaxy effects.', '2026-03-08 18:52:15'),
(70, 8, 'Enchanted Forest Theme', 2299, 2799, 'eggless', 'fruit', 'ccake7.jpeg', 'Magical forest look with sugar mushrooms and deer.', '2026-03-08 18:52:15'),
(71, 8, 'Music Note Symphony', 999, 1500, 'eggless', 'vanilla', 'ccake8.jpeg', 'Black and white piano keys with music notes.', '2026-03-08 18:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `candles`
--

CREATE TABLE `candles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `original_price` int(11) DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candles`
--

INSERT INTO `candles` (`id`, `name`, `price`, `original_price`, `image`, `description`) VALUES
(1, 'Vanilla Scented Candle', 299, 0, 'candle1.jpg', 'Fragrant vanilla candle for cozy evenings.'),
(2, 'Birthday Number Candle', 199, 0, 'candle2.jpg', 'Number shaped candles for birthdays.'),
(3, 'LED Flameless Candle', 399, 0, 'candle3.jpg', 'Safe LED candle for indoor decoration.'),
(4, 'Rose Gold Candle Set', 499, 0, 'candle4.jpg', 'Set of 3 decorative candles in rose gold finish.');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `item_type` varchar(50) NOT NULL DEFAULT 'cake',
  `weight` varchar(50) DEFAULT '0.5 kg',
  `message_on_cake` varchar(255) DEFAULT '',
  `is_eggless` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `item_id`, `quantity`, `item_type`, `weight`, `message_on_cake`, `is_eggless`) VALUES
(92, 8, 1, 1, 'cake', '0.5 kg', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`) VALUES
(1, 'Birthday Cakes', 'cake1.png'),
(2, 'Engagement Cakes', 'cake2.png'),
(3, 'Wedding Cakes', 'cake3.png'),
(4, 'Anniversary Cakes', 'cake4.png'),
(5, 'Baby Shower Cakes', 'cake5.png'),
(6, 'Graduation Cakes', 'cake6.png'),
(7, 'Promotion Cakes', 'cake7.png'),
(8, 'Custom Theme Cakes', 'cake8.png');

-- --------------------------------------------------------

--
-- Table structure for table `contact_queries`
--

CREATE TABLE `contact_queries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `decorations`
--

CREATE TABLE `decorations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `original_price` int(11) DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `decorations`
--

INSERT INTO `decorations` (`id`, `name`, `price`, `original_price`, `image`, `description`) VALUES
(1, 'Rainbow Balloon Set', 1200, 0, 'decoration1.jpg', 'Colorful balloons for birthday celebrations.'),
(2, 'Floral Table Centerpiece', 1500, 0, 'decoration2.jpg', 'Elegant flower centerpiece for dining tables.'),
(3, 'LED Party Lights', 900, 0, 'decoration3.jpg', 'Vibrant LED lights to light up the party.'),
(4, 'Themed Wall Decor', 2000, 0, 'decoration4.jpg', 'Decorative wall hangings for themed parties.');

-- --------------------------------------------------------

--
-- Table structure for table `halls`
--

CREATE TABLE `halls` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `halls`
--

INSERT INTO `halls` (`id`, `name`, `price`, `capacity`, `image`, `description`) VALUES
(1, 'Grand Celebration Hall', 25000, 200, 'hall1.jpg', 'Spacious hall perfect for weddings and large parties.'),
(2, 'Sunny Banquet Hall', 18000, 150, 'hall2.jpg', 'Bright hall with modern amenities for small gatherings.'),
(3, 'Royal Garden Hall', 30000, 250, 'hall3.jpg', 'Open garden hall with elegant décor for receptions.'),
(4, 'Cityview Conference Hall', 15000, 100, 'hall4.jpg', 'Ideal hall for corporate events and meetings.');

-- --------------------------------------------------------

--
-- Table structure for table `hall_bookings`
--

CREATE TABLE `hall_bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `hall_id` int(11) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `guests` int(11) DEFAULT NULL,
  `event_type` varchar(100) DEFAULT NULL,
  `time_slot` varchar(50) DEFAULT NULL,
  `special_requests` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hampers`
--

CREATE TABLE `hampers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `original_price` int(11) DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hampers`
--

INSERT INTO `hampers` (`id`, `name`, `price`, `original_price`, `image`, `description`) VALUES
(1, 'Chocolate Delight Hamper', 999, 0, 'hamper1.jpg', 'Assorted chocolates for gifting.'),
(2, 'Birthday Surprise Hamper', 1299, 0, 'hamper2.jpg', 'Birthday goodies packed in a beautiful basket.'),
(3, 'Luxury Spa Hamper', 1799, 0, 'hamper3.jpg', 'Relaxing spa products for pampering.'),
(4, 'Tea & Coffee Hamper', 1499, 0, 'hamper4.jpg', 'Premium teas and coffees in a gift pack.');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_price` int(11) DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `order_status` varchar(50) DEFAULT 'Pending',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `delivery_time` varchar(50) DEFAULT NULL,
  `payment_status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `payment_type`, `order_status`, `order_date`, `address`, `phone`, `pincode`, `delivery_date`, `delivery_time`, `payment_status`) VALUES
(55, 8, 3499, 'COD', 'Pending', '2026-04-11 09:46:14', 'Godaarvari Sankul, Nashik', '9579329098', '424306', '2026-04-17', 'Evening (4 PM - 8 PM)', 'Pending'),
(56, 8, 499, 'Online', 'Processing', '2026-04-11 09:53:38', ', Godaarvari Sankul, Nashik, , , ', '9579329098', '424306', '2026-04-23', 'Afternoon (12 PM - 4 PM)', 'Paid'),
(57, 8, 499, 'Online', 'Processing', '2026-04-11 10:05:16', ', Godaarvari Sankul, Nashik, , , ', '9579329098', '424306', '2026-04-18', 'Afternoon (12 PM - 4 PM)', 'Paid'),
(58, 8, 5596, 'Online', 'Processing', '2026-04-11 10:31:07', ', Godaarvari Sankul, Nashik, , , ', '9579329098', '424306', '2026-04-16', 'Afternoon (12 PM - 4 PM)', 'Paid'),
(59, 8, 449, 'Online', 'Processing', '2026-04-11 11:51:27', 'Rk,Nashik ', '9579329098', '424306', '2026-04-17', 'Morning (9 AM - 12 PM)', 'Paid'),
(82, 8, 2263, 'Online', 'Delivered', '2025-01-08 12:15:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-01-08', 'Evening', 'Paid'),
(83, 8, 2804, 'Online', 'Delivered', '2025-01-07 12:41:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-01-07', 'Evening', 'Paid'),
(84, 8, 1597, 'COD', 'Pending', '2025-01-18 13:10:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-01-18', 'Evening', 'Pending'),
(85, 8, 3428, 'COD', 'Delivered', '2025-02-15 06:11:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-02-15', 'Evening', 'Paid'),
(86, 8, 927, 'Online', 'Delivered', '2025-02-03 08:04:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-02-03', 'Evening', 'Paid'),
(87, 8, 3365, 'Online', 'Delivered', '2025-03-11 06:19:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-03-11', 'Evening', 'Paid'),
(88, 8, 3125, 'COD', 'Pending', '2025-03-08 10:43:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-03-08', 'Evening', 'Pending'),
(89, 8, 1275, 'Online', 'Delivered', '2025-03-07 11:14:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-03-07', 'Evening', 'Paid'),
(90, 8, 2772, 'COD', 'Delivered', '2025-04-28 10:23:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-04-28', 'Evening', 'Paid'),
(91, 8, 814, 'COD', 'Pending', '2025-04-11 13:52:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-04-11', 'Evening', 'Pending'),
(92, 8, 2184, 'COD', 'Pending', '2025-04-19 14:56:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-04-19', 'Evening', 'Pending'),
(93, 8, 2684, 'Online', 'Delivered', '2025-04-09 11:18:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-04-09', 'Evening', 'Paid'),
(94, 8, 1942, 'Online', 'Delivered', '2025-05-12 12:53:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-05-12', 'Evening', 'Paid'),
(95, 8, 1300, 'Online', 'Delivered', '2025-05-07 09:50:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-05-07', 'Evening', 'Paid'),
(96, 8, 1485, 'COD', 'Pending', '2025-06-03 05:19:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-06-03', 'Evening', 'Pending'),
(97, 8, 3478, 'COD', 'Delivered', '2025-06-25 05:00:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-06-25', 'Evening', 'Paid'),
(98, 8, 2851, 'Online', 'Delivered', '2025-07-15 07:40:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-07-15', 'Evening', 'Paid'),
(99, 8, 1407, 'COD', 'Pending', '2025-07-08 15:02:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-07-08', 'Evening', 'Pending'),
(100, 8, 3222, 'Online', 'Delivered', '2025-07-10 13:17:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-07-10', 'Evening', 'Paid'),
(101, 8, 2526, 'Online', 'Delivered', '2025-08-11 10:09:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-08-11', 'Evening', 'Paid'),
(102, 8, 653, 'Online', 'Delivered', '2025-08-13 09:26:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-08-13', 'Evening', 'Paid'),
(103, 8, 2456, 'COD', 'Delivered', '2025-08-14 08:23:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-08-14', 'Evening', 'Paid'),
(104, 8, 2465, 'COD', 'Delivered', '2025-09-02 09:00:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-09-02', 'Evening', 'Paid'),
(105, 8, 457, 'Online', 'Delivered', '2025-09-07 12:51:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-09-07', 'Evening', 'Paid'),
(106, 8, 2604, 'COD', 'Pending', '2025-09-23 14:55:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-09-23', 'Evening', 'Pending'),
(107, 8, 1905, 'Online', 'Delivered', '2025-09-27 07:03:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-09-27', 'Evening', 'Paid'),
(108, 8, 2048, 'Online', 'Delivered', '2025-10-10 06:28:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-10-10', 'Evening', 'Paid'),
(109, 8, 2976, 'Online', 'Delivered', '2025-10-12 06:57:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-10-12', 'Evening', 'Paid'),
(110, 8, 2568, 'Online', 'Delivered', '2025-10-12 14:21:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-10-12', 'Evening', 'Paid'),
(111, 8, 2976, 'COD', 'Delivered', '2025-10-28 12:00:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-10-28', 'Evening', 'Paid'),
(112, 8, 2518, 'COD', 'Pending', '2025-11-20 08:49:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-11-20', 'Evening', 'Pending'),
(113, 8, 1690, 'Online', 'Delivered', '2025-11-20 15:12:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-11-20', 'Evening', 'Paid'),
(114, 8, 816, 'COD', 'Pending', '2025-11-21 12:46:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-11-21', 'Evening', 'Pending'),
(115, 8, 2368, 'COD', 'Pending', '2025-11-04 06:50:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-11-04', 'Evening', 'Pending'),
(116, 8, 3452, 'COD', 'Pending', '2025-12-18 07:47:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-12-18', 'Evening', 'Pending'),
(117, 8, 3304, 'Online', 'Delivered', '2025-12-08 07:22:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-12-08', 'Evening', 'Paid'),
(118, 8, 2600, 'COD', 'Delivered', '2025-12-07 10:05:00', 'Testing Colony, Pune', '9876543210', '411001', '2025-12-07', 'Evening', 'Paid'),
(119, 8, 3338, 'COD', 'Delivered', '2026-01-02 10:24:00', 'Testing Colony, Pune', '9876543210', '411001', '2026-01-02', 'Evening', 'Paid'),
(120, 8, 2199, 'Online', 'Delivered', '2026-01-27 14:45:00', 'Testing Colony, Pune', '9876543210', '411001', '2026-01-27', 'Evening', 'Paid'),
(121, 8, 3445, 'COD', 'Pending', '2026-02-28 09:16:00', 'Testing Colony, Pune', '9876543210', '411001', '2026-02-28', 'Evening', 'Pending'),
(122, 8, 934, 'Online', 'Delivered', '2026-02-18 06:22:00', 'Testing Colony, Pune', '9876543210', '411001', '2026-02-18', 'Evening', 'Paid'),
(123, 8, 1155, 'Online', 'Delivered', '2026-02-02 14:55:00', 'Testing Colony, Pune', '9876543210', '411001', '2026-02-02', 'Evening', 'Paid'),
(124, 8, 1412, 'Online', 'Delivered', '2026-03-07 15:03:00', 'Testing Colony, Pune', '9876543210', '411001', '2026-03-07', 'Evening', 'Paid'),
(125, 8, 814, 'COD', 'Delivered', '2026-03-21 14:49:00', 'Testing Colony, Pune', '9876543210', '411001', '2026-03-21', 'Evening', 'Paid'),
(126, 8, 2933, 'Online', 'Delivered', '2026-03-08 12:58:00', 'Testing Colony, Pune', '9876543210', '411001', '2026-03-08', 'Evening', 'Paid'),
(127, 8, 2540, 'COD', 'Delivered', '2026-03-21 08:19:00', 'Testing Colony, Pune', '9876543210', '411001', '2026-03-21', 'Evening', 'Paid'),
(128, 8, 2761, 'Online', 'Delivered', '2026-04-19 06:53:00', 'Testing Colony, Pune', '9876543210', '411001', '2026-04-19', 'Evening', 'Paid'),
(129, 8, 3270, 'COD', 'Pending', '2026-04-19 05:54:00', 'Testing Colony, Pune', '9876543210', '411001', '2026-04-19', 'Evening', 'Pending'),
(130, 8, 3264, 'Online', 'Delivered', '2026-04-06 11:07:00', 'Testing Colony, Pune', '9876543210', '411001', '2026-04-06', 'Evening', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `item_type` varchar(50) NOT NULL DEFAULT 'cake',
  `weight` varchar(50) DEFAULT '0.5 kg',
  `message_on_cake` varchar(255) DEFAULT '',
  `is_eggless` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `quantity`, `price`, `item_type`, `weight`, `message_on_cake`, `is_eggless`) VALUES
(74, 55, 21, 1, 3499, 'cake', '0.5 kg', '', 0),
(75, 56, 3, 1, 499, 'cake', '0.5 kg', '', 0),
(76, 57, 3, 1, 499, 'cake', '0.5 kg', '', 0),
(77, 58, 30, 4, 1399, 'cake', '0.5 kg', '', 0),
(78, 59, 1, 1, 449, 'cake', '0.5 kg', '', 0),
(79, 82, 8, 1, 2263, 'cake', '0.5 kg', '', 0),
(80, 83, 6, 1, 2804, 'cake', '0.5 kg', '', 0),
(81, 84, 5, 1, 1597, 'cake', '0.5 kg', '', 0),
(82, 85, 10, 1, 3428, 'cake', '0.5 kg', '', 0),
(83, 86, 3, 1, 927, 'cake', '0.5 kg', '', 0),
(84, 87, 9, 1, 3365, 'cake', '0.5 kg', '', 0),
(85, 88, 3, 1, 3125, 'cake', '0.5 kg', '', 0),
(86, 89, 3, 1, 1275, 'cake', '0.5 kg', '', 0),
(87, 90, 9, 1, 2772, 'cake', '0.5 kg', '', 0),
(88, 91, 1, 1, 814, 'cake', '0.5 kg', '', 0),
(89, 92, 9, 1, 2184, 'cake', '0.5 kg', '', 0),
(90, 93, 3, 1, 2684, 'cake', '0.5 kg', '', 0),
(91, 94, 7, 1, 1942, 'cake', '0.5 kg', '', 0),
(92, 95, 8, 1, 1300, 'cake', '0.5 kg', '', 0),
(93, 96, 2, 1, 1485, 'cake', '0.5 kg', '', 0),
(94, 97, 5, 1, 3478, 'cake', '0.5 kg', '', 0),
(95, 98, 8, 1, 2851, 'cake', '0.5 kg', '', 0),
(96, 99, 1, 1, 1407, 'cake', '0.5 kg', '', 0),
(97, 100, 7, 1, 3222, 'cake', '0.5 kg', '', 0),
(98, 101, 7, 1, 2526, 'cake', '0.5 kg', '', 0),
(99, 102, 8, 1, 653, 'cake', '0.5 kg', '', 0),
(100, 103, 5, 1, 2456, 'cake', '0.5 kg', '', 0),
(101, 104, 6, 1, 2465, 'cake', '0.5 kg', '', 0),
(102, 105, 3, 1, 457, 'cake', '0.5 kg', '', 0),
(103, 106, 6, 1, 2604, 'cake', '0.5 kg', '', 0),
(104, 107, 4, 1, 1905, 'cake', '0.5 kg', '', 0),
(105, 108, 2, 1, 2048, 'cake', '0.5 kg', '', 0),
(106, 109, 7, 1, 2976, 'cake', '0.5 kg', '', 0),
(107, 110, 10, 1, 2568, 'cake', '0.5 kg', '', 0),
(108, 111, 6, 1, 2976, 'cake', '0.5 kg', '', 0),
(109, 112, 8, 1, 2518, 'cake', '0.5 kg', '', 0),
(110, 113, 5, 1, 1690, 'cake', '0.5 kg', '', 0),
(111, 114, 1, 1, 816, 'cake', '0.5 kg', '', 0),
(112, 115, 5, 1, 2368, 'cake', '0.5 kg', '', 0),
(113, 116, 5, 1, 3452, 'cake', '0.5 kg', '', 0),
(114, 117, 7, 1, 3304, 'cake', '0.5 kg', '', 0),
(115, 118, 10, 1, 2600, 'cake', '0.5 kg', '', 0),
(116, 119, 9, 1, 3338, 'cake', '0.5 kg', '', 0),
(117, 120, 10, 1, 2199, 'cake', '0.5 kg', '', 0),
(118, 121, 3, 1, 3445, 'cake', '0.5 kg', '', 0),
(119, 122, 2, 1, 934, 'cake', '0.5 kg', '', 0),
(120, 123, 2, 1, 1155, 'cake', '0.5 kg', '', 0),
(121, 124, 10, 1, 1412, 'cake', '0.5 kg', '', 0),
(122, 125, 7, 1, 814, 'cake', '0.5 kg', '', 0),
(123, 126, 3, 1, 2933, 'cake', '0.5 kg', '', 0),
(124, 127, 3, 1, 2540, 'cake', '0.5 kg', '', 0),
(125, 128, 2, 1, 2761, 'cake', '0.5 kg', '', 0),
(126, 129, 8, 1, 3270, 'cake', '0.5 kg', '', 0),
(127, 130, 4, 1, 3264, 'cake', '0.5 kg', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `mobile`, `created_at`) VALUES
(8, 'Lokesh', 'lokesh@gmail.com', '$2y$10$dRNw9Q97OIr/r840BRse1OYelXiMUSMVhvIfaGdosGffwE4wdhxga', '9579329098', '2026-04-11 09:41:37'),
(1000, 'Tejas', 'tejas@gmail.com', '$2y$10$LFpk12xo0nK77SLq/umV.e.X2HdFhwrkCBWYLM2uX.0jBxCQy28eK', '05555555555', '2026-04-12 04:36:38'),
(1001, 'Ayush', 'ayush@gmail.com', '$2y$10$iPYcttqEPvmsnlz8SmcTDOzhVSbvVseL7rKmW0uRxUwUGndbuwoJa', '05555555555', '2026-04-12 04:37:22');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `house_no` varchar(255) DEFAULT NULL,
  `area_street` varchar(255) NOT NULL,
  `landmark` varchar(255) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `address_type` enum('Home','Work') DEFAULT 'Home',
  `is_default` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `fullname`, `mobile`, `pincode`, `house_no`, `area_street`, `landmark`, `city`, `state`, `address_type`, `is_default`, `created_at`) VALUES
(5, 5, 'lokesh', '09579329098', '424306', '', '10,amuthdham,nashik', '', 'nashik', 'maharatra', 'Home', 0, '2026-03-15 12:41:15'),
(7, 8, 'lokesh', '9579329098', '424306', NULL, 'Rk,Nashik ', NULL, '', '', 'Home', 0, '2026-04-11 11:51:27');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_type` varchar(50) NOT NULL DEFAULT 'cake'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cakes`
--
ALTER TABLE `cakes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `candles`
--
ALTER TABLE `candles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `cake_id` (`item_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_queries`
--
ALTER TABLE `contact_queries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `decorations`
--
ALTER TABLE `decorations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `halls`
--
ALTER TABLE `halls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hall_bookings`
--
ALTER TABLE `hall_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `hall_id` (`hall_id`);

--
-- Indexes for table `hampers`
--
ALTER TABLE `hampers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `cake_id` (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `cake_id` (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cakes`
--
ALTER TABLE `cakes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `candles`
--
ALTER TABLE `candles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact_queries`
--
ALTER TABLE `contact_queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `decorations`
--
ALTER TABLE `decorations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `halls`
--
ALTER TABLE `halls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hall_bookings`
--
ALTER TABLE `hall_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `hampers`
--
ALTER TABLE `hampers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cakes`
--
ALTER TABLE `cakes`
  ADD CONSTRAINT `cakes_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `hall_bookings`
--
ALTER TABLE `hall_bookings`
  ADD CONSTRAINT `hall_bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `hall_bookings_ibfk_2` FOREIGN KEY (`hall_id`) REFERENCES `halls` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
