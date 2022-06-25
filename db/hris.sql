-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2022 at 09:17 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hris`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_advance_salary`
--

CREATE TABLE `ci_advance_salary` (
  `advance_salary_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `salary_type` varchar(100) DEFAULT NULL,
  `month_year` varchar(255) NOT NULL,
  `advance_amount` decimal(65,2) NOT NULL,
  `one_time_deduct` varchar(50) NOT NULL,
  `monthly_installment` decimal(65,2) NOT NULL,
  `total_paid` decimal(65,2) NOT NULL,
  `reason` text NOT NULL,
  `status` int(11) DEFAULT NULL,
  `is_deducted_from_salary` int(11) DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_advance_salary`
--

INSERT INTO `ci_advance_salary` (`advance_salary_id`, `company_id`, `employee_id`, `salary_type`, `month_year`, `advance_amount`, `one_time_deduct`, `monthly_installment`, `total_paid`, `reason`, `status`, `is_deducted_from_salary`, `created_at`) VALUES
(12, 2, 3, 'advance', '2021-10', '1234.00', '1', '1234.00', '0.00', 'Test Reason', 0, 0, '29-10-2021 02:23:34'),
(13, 2, 3, 'loan', '2021-10', '50.00', '1', '50.00', '0.00', 'Test Loan Reason', 0, 0, '29-10-2021 02:24:30');

-- --------------------------------------------------------

--
-- Table structure for table `ci_announcements`
--

CREATE TABLE `ci_announcements` (
  `announcement_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `department_id` varchar(255) NOT NULL,
  `audience_id` varchar(255) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `start_date` varchar(200) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `published_by` int(111) NOT NULL,
  `summary` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_announcements`
--

INSERT INTO `ci_announcements` (`announcement_id`, `company_id`, `department_id`, `audience_id`, `title`, `start_date`, `end_date`, `published_by`, `summary`, `description`, `is_active`, `created_at`) VALUES
(3, 24, '0,26,27,28,29,30', NULL, 'This is a test announcement', '2021-11-28', '2021-12-28', 24, 'This is a test announcement', '', 1, '28-11-2021 09:51:04'),
(4, 24, '0,all', '0,all', 'Test', '2021-12-08', '2021-12-22', 24, 'Test', 'Test', 1, '08-12-2021 08:34:06'),
(5, 24, '0,all', '0,all', 'Test 2', '2021-12-01', '2021-12-31', 24, 'This is an announcement', '&lt;blockquote style=&#34;overflow:hidden;margin:1em 0px;padding:8px 32px;border-left:none;color:#202122;font-family:sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;p style=&#34;margin-top:0.5em;margin-bottom:0.5em;&#34;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;&lt;div&gt;&lt;/div&gt;&lt;/blockquote&gt;', 1, '08-12-2021 08:04:09'),
(6, 24, '0,all', '0,all', 'Second test Announcement', '2021-12-09', '2021-12-24', 24, 'Test', '', 1, '09-12-2021 10:55:35'),
(7, 24, '0,all', '0,all', 'Families with Vaccinated and Unvaccinated Members', '2021-12-09', '2021-12-25', 24, 'Families with Vaccinated and Unvaccinated Members', '&lt;img src=&#34;https://www.who.int/images/default-source/health-topics/coronavirus/risk-communications/olympic_games_tile_30_7_1.jpg?sfvrsn=a1672b82_9&#34; alt=&#34;Test&#34; width=&#34;900&#34; height=&#34;700&#34; /&gt;', 1, '09-12-2021 11:06:24'),
(8, 24, '0,all', '0,all', 'What to do if someone is sick in your household', '2021-12-09', '2021-12-31', 24, 'What to do if someone is sick in your household', '&lt;img src=&#34;https://www.who.int/images/default-source/health-topics/coronavirus/person-sick-in-your-household-what-to-do.jpg?sfvrsn=39d1287_17&#34; alt=&#34;&#34; /&gt;', 1, '09-12-2021 11:11:24'),
(10, 24, '0,9', '0,25', 'Test', '2022-01-13', '2022-01-31', 24, 'Test For Patrick', 'Test', 1, '13-01-2022 07:22:02');

-- --------------------------------------------------------

--
-- Table structure for table `ci_announcement_comments`
--

CREATE TABLE `ci_announcement_comments` (
  `comment_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `announcement_id` int(11) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `announcement_comment` text DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_announcement_comments`
--

INSERT INTO `ci_announcement_comments` (`comment_id`, `company_id`, `announcement_id`, `employee_id`, `announcement_comment`, `created_at`) VALUES
(2, 24, 4, 26, 'Reply to the test', '08-12-2021 08:34:34'),
(3, 24, 8, 26, 'test comment', '30-12-2021 08:21:50');

-- --------------------------------------------------------

--
-- Table structure for table `ci_assets`
--

CREATE TABLE `ci_assets` (
  `assets_id` int(111) NOT NULL,
  `assets_category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `company_asset_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `purchase_date` varchar(255) NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `warranty_end_date` varchar(255) NOT NULL,
  `asset_note` text NOT NULL,
  `asset_image` varchar(255) NOT NULL,
  `is_working` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_assets`
--

INSERT INTO `ci_assets` (`assets_id`, `assets_category_id`, `brand_id`, `company_id`, `employee_id`, `company_asset_code`, `name`, `purchase_date`, `invoice_number`, `manufacturer`, `serial_number`, `warranty_end_date`, `asset_note`, `asset_image`, `is_working`, `created_at`) VALUES
(1, 179, 180, 2, 3, '', 'asdasd', '', '', '', '', '', 'asdasdsads ', 'pr22od-22.jpg', 1, '31-07-2021 05:29:12');

-- --------------------------------------------------------

--
-- Table structure for table `ci_awards`
--

CREATE TABLE `ci_awards` (
  `award_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(200) NOT NULL,
  `award_type_id` int(200) NOT NULL,
  `associated_goals` text DEFAULT NULL,
  `gift_item` varchar(200) NOT NULL,
  `cash_price` decimal(65,2) NOT NULL,
  `award_photo` varchar(255) NOT NULL,
  `award_month_year` varchar(200) NOT NULL,
  `award_information` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_awards`
--

INSERT INTO `ci_awards` (`award_id`, `company_id`, `employee_id`, `award_type_id`, `associated_goals`, `gift_item`, `cash_price`, `award_photo`, `award_month_year`, `award_information`, `description`, `created_at`) VALUES
(1, 2, 3, 174, '0,136', 'test', '1200.00', 'hr_80_80.jpg', '2021-06', 'asdas', 'asdasdsa', '2021-06-15'),
(2, 2, 3, 174, '0,136', 'test', '1200.00', 'hr_80_80.jpg', '2021-06', 'asdas', 'asdasdsa', '2021-06-15');

-- --------------------------------------------------------

--
-- Table structure for table `ci_cms_pages`
--

CREATE TABLE `ci_cms_pages` (
  `page_id` int(11) NOT NULL,
  `page_name` text DEFAULT NULL,
  `page_type` varchar(100) NOT NULL,
  `page_description` text DEFAULT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_cms_pages`
--

INSERT INTO `ci_cms_pages` (`page_id`, `page_name`, `page_type`, `page_description`, `is_active`) VALUES
(1, 'Privacy Policy', 'footer', '&lt;span style=&#34;font-family:Arial;&#34;&gt;&lt;/span&gt;&lt;h4 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;&#34;&gt;&lt;span style=&#34;font-size:13.5pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;Our Commitment To Privacy&lt;/span&gt;&lt;/h4&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;360HRIS is committed to protecting and safeguarding the privacy of individuals in all aspects of our business operations. Keeping personal information in strict confidence is a cornerstone of our business. 360HRIS has implemented a Privacy Policy to comply with the Personal Information Protection &amp;amp; Electronic Documents Act (PIPEDA) that came into effect on January 1, 2004, as well as other applicable legislation that may apply in other provinces. The Privacy Policy sets out the principles and guidelines that 360HRIS has adopted for the management of personal information of its customers (corporations, organizations and individuals purchasing services from 360HRIS), clients (individuals utilizing career transition or recruiting services from 360HRIS) and employees of 360HRIS. The Privacy Policy is based on the principles of the Canadian Standards Association Model Code for the Protection of Personal Information (the &amp;ldquo;Privacy Principles&amp;rdquo;).&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;Personal information is defined as information about an identifiable individual. The personal information that 360HRIS may utilize includes:&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;For customers &amp;ndash; personal information may include information about their current employees (position, compensation, performance rating, length of service, employment history, career plans, assessment results or training), their former employees (use of our services), purchase orders, invoices or any records of dealings with us. This information is used to manage the business relationship with the customer and to allow 360HRIS to complete assignments on behalf of the customer.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;For clients &amp;ndash; this may include contact information, services provided, records of consultant meetings, resume information, employment preferences, job search plans, references or assessment results. For career transition clients, this information is used to help the client to plan and execute an effective job search. For recruitment clients, this information is used to connect the client with job opportunities.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9.0pt;line-height:107%;font-family:&#39;Open Sans&#39;,sans-serif;color:#373C4C;&#34;&gt;&lt;span style=&#34;font-family:Arial;&#34;&gt;For employees of 360HRIS &amp;ndash; this may include contact information, performance evaluations, employment history, employment arrangements, benefit plan participation, career plans and assessment results.&lt;/span&gt;&lt;br style=&#34;box-sizing:inherit;&#34; /&gt;&lt;span style=&#34;font-family:Arial;&#34;&gt;Personal information does not include information that is publicly available, such as an individual&amp;acute;s name, address, telephone number and electronic address, when listed in a directory or made available through directory assistance or other similar sources or that is the name, title or business address or telephone number of an employee of an organization.&lt;/span&gt;&lt;/span&gt;&lt;/h6&gt;&lt;h4 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:13.5pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;1. Accountability&lt;/span&gt;&lt;/h4&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;360HRIS is responsible for all customer, client and employee personal information in its possession and under its control. 360HRIS has designated a Privacy Officer to oversee the organization&amp;rsquo;s compliance with its Privacy Policy and applicable privacy legislation. There are other individuals within 360HRIS who are designated with the responsibility for day-to-day collection and management of customer, client and employee personal information.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;360HRIS has established policies and procedures to implement and comply with its Privacy Policy, including internal guidelines and procedures relating to the collection, handling, storage and destruction of personal information. 360HRIS staff has been provided the education and training to protect personal information and how to deal with complaints on privacy issues.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;360HRIS is responsible for any personal information transferred to third parties for service or processing on its behalf. 360HRIS uses contractual means to provide an appropriate level of protection for such transferred information. Parties entering into a business relationship with 360HRIS may be required to sign a non-disclosure agreement to protect the confidentiality of information disclosed to such parties during the term and after the termination or expiry of such agreement. 360HRIS may examine the policies and procedures of any third party practices with respect to personal information to safeguard the personal information while it is being handled by a third party.&lt;/span&gt;&lt;/h6&gt;&lt;h4 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:13.5pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;2. Identifying the purposes for collection of personal information&lt;/span&gt;&lt;/h4&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;The purposes for which personal information is collected will be identified by 360HRIS at or before the time the information is collected, unless such purposes are obvious.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;360HRIS will ensure that the purposes for which personal information is collected and the way in which the information may be used are clear to the individual. In some cases, the purpose will be clear from the context of the interaction, in other circumstances, a written or verbal explanation may be required.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;Generally, 360HRIS collects personal information only for the following purposes:&lt;/span&gt;&lt;/h6&gt;&lt;ul&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;to establish and maintain responsible commercial relations with customers and to provide ongoing service and offers;&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;to understand customer and client needs;&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;to develop, enhance, market or provide products and services;&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;to manage and develop 360HRIS business and operations, including personnel and employment matters; and&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;to meet legal and regulatory requirements including requirements or requests of government agencies or pursuant to a subpoena or other legal proceeding.&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;/ul&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;The Privacy Policy places no limits on the collection, use or disclosure of information that is publicly available, such as an individual&amp;rsquo;s name, address, telephone number and electronic address, when listed in a directory or made available through directory assistance or other similar source or that is the name, title or business address or telephone number of an employee of an organization.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;360HRIS&amp;rsquo;s customers may obtain and, in some cases may require, personal information pertaining to a 360HRIS employee. Such information may be obtained and/or used for the purposes of business and employment communications, facility and equipment management, video monitoring, accommodation management, travel or transportation management, health, safety and security management, social communications and expense and invoice payment processing.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;In the event that customer, client or employee personal information is required to be used or disclosed for a purpose that is not listed above and in respect of which the customer, client or employee has not previously granted his or her consent, the personal information will not be used or disclosed without first identifying the new purpose and obtaining consent.&lt;/span&gt;&lt;/h6&gt;&lt;h4 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:13.5pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;3. Obtaining consent&lt;/span&gt;&lt;/h4&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;360HRIS will not collect, use or disclose the personal information of a person without the individual&amp;rsquo;s knowledge and consent, except in certain limited circumstances permitted by law, such as where immediate health of a person is at risk, or in connection with the breach of an agreement or a law.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;The knowledge and consent of the individual are required for the collection, use or disclosure of personal information, except where noted below.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;The consent may be expressed, implied, or given through an authorized representative. In determining the appropriate form of consent, the sensitivity of the information and reasonable expectations of the individual is taken into account. Implied consent is generally appropriate when the information is less sensitive. Any consent, including any implied consent, will apply to information already in the possession of 360HRIS as of the date of the consent.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;360HRIS makes reasonable efforts to inform its customers, clients and employees how any personal information collected will be used and disclosed. To achieve this aim, the purposes for which the information will be used, if not obvious, will be explained in such a manner that the individual can reasonably understand how the information will be used or disclosed.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;Generally, consent to use and disclose personal information is sought at the same time it is collected. In certain circumstances, however, 360HRIS may identify a new purpose and seek consent to use and disclose the personal information after it has been collected.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;An individual can withdraw consent to use personal information at any time, subject to any legal or contractual restrictions and reasonable notice. 360HRIS will inform individuals of the implications, if any, of withdrawing consent and how to do so.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;Exceptions for collection, use and disclosure without consent&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;Personal information may be collected without the knowledge or consent of the individual if:&lt;/span&gt;&lt;/h6&gt;&lt;ul&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;the collection is clearly in the interests of the individual and consent cannot be obtained in a timely way;&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;it is reasonable to expect that the collection with the knowledge or consent of the individual would compromise the availability or the accuracy of the information and the collection is reasonable for purposes related to investigating a breach of an agreement or a contravention of the laws of Canada or a province; or&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;the information is publicly available and is specified by the regulations.&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;/ul&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;Personal Information may be used without the knowledge or consent of the individual if:&lt;/span&gt;&lt;/h6&gt;&lt;ul&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;in the course of its activities, 360HRIS becomes aware of information that it has reasonable grounds to believe could be useful in the investigation of a contravention of the laws of Canada, a province or a foreign jurisdiction that has been, is being or is about to be committed, and the information is used for the purpose of investigating that contravention;&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;it is used for the purpose of acting in respect of an emergency that threatens the life, health or security of an individual;&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;it is used for statistical, or scholarly study of research purposes that cannot be achieved without using the information, the information is used in a manner that will ensure its confidentiality, it is impracticable to obtain consent and 360HRIS informs the Privacy Commissioner of the use before the information is used;&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;it is publicly available and is specified by the regulations; or&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;it was collected under paragraph (a)(i) or (ii) above.&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;/ul&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;Personal information may be disclosed without the knowledge or consent of the individual if the disclosure is:&lt;/span&gt;&lt;/h6&gt;&lt;ul&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;made to, in the Province of Quebec, an advocate or notary or, in any other province, a barrister or solicitor who is representing the organization;&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;for the purpose of collecting a debt owed by the individual to 360HRIS;&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;required to comply with a subpoena or warrant issued or an order made by a court, person or body with jurisdiction to compel the production of information, or to comply with rules of court relating to the production of records;&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;made to a government institution or part of a government institution or an investigative body that has made a request for the information and identified its lawful authority to obtain the information.&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;made to a person who needs the information because of an emergency that threatens the life, health or security of an individual and, if the individual whom the information is about is alive, the organization informs that individual in writing without delay of the disclosure;&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;of information that is publicly available and is specified by the regulations;&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;made by an investigative body and the disclosure is reasonable for purposes related to investigating a breach of an agreement or a contravention of the laws of Canada or a province; or&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;required by law.&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;/ul&gt;&lt;h4 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:13.5pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;4. Limiting collection of personal information&lt;/span&gt;&lt;/h4&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;360HRIS will collect only the amount and type of personal information needed for the purposes it has identified. Personal information is collected by fair and lawful means.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;Although 360HRIS will collect personal information primarily from customers, clients and employees, it may also collect personal information from other sources such as credit bureaus, or other third parties who represent that they have the right to disclose the information.&lt;/span&gt;&lt;/h6&gt;&lt;h4 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:13.5pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;5. Limiting use, disclosure and retention of personal information&lt;/span&gt;&lt;/h4&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9.0pt;line-height:107%;font-family:&#39;Open Sans&#39;,sans-serif;color:#373C4C;&#34;&gt;&lt;span style=&#34;font-family:Arial;&#34;&gt;The personal information that 360HRIS collects is used or disclosed only for the purposes specified above or for which it was collected, unless the individual gives consent or as required by law. 360HRIS may disclose personal information without consent when it is required to do so by law, e.g. subpoenas, search warrants, other court and government orders, or demands from other parties who have a legal right to personal information, or to protect the security and integrity of its network or system. In such circumstances, the interests of the individual is protected by ensuring that:&lt;/span&gt;&lt;br style=&#34;box-sizing:inherit;&#34; /&gt;&lt;span style=&#34;font-family:Arial;&#34;&gt;orders or demands appear to comply with the laws under which they were issued; and&lt;/span&gt;&lt;br style=&#34;box-sizing:inherit;&#34; /&gt;&lt;span style=&#34;font-family:Arial;&#34;&gt;360HRIS discloses only the personal information that is legally required, and nothing more.&lt;/span&gt;&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;The customer, client or employee may be notified that an order requiring disclosure has been received, if the law allows it.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;360HRIS may disclose Information to:&lt;/span&gt;&lt;/h6&gt;&lt;ul&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;any person who, in its reasonable judgment, is seeking the Information as the agent of the customer, client or employee concerned;&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;a person involved directly or indirectly in supplying the product or service to a customer, client or employee, including, without limitation, our sales and marketing agents, our administration team for invoice printing and mailing, our employee benefits and pension providers, and provided that such person is required to keep the Information confidential;&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;a person retained by 360HRIS to collect amounts which are owed to it or to enforce 360HRIS&amp;rsquo;s rights under its terms and conditions, if the Information is required for, and is to be used only for that purpose and that person is required to keep such Information confidential.&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;/ul&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9.0pt;line-height:107%;font-family:&#39;Open Sans&#39;,sans-serif;color:#373C4C;&#34;&gt;&lt;span style=&#34;font-family:Arial;&#34;&gt;360HRIS may share Information with potential business partners of, or potential investors in, 360HRIS&lt;/span&gt;&lt;br /&gt;&lt;span style=&#34;font-family:Arial;&#34;&gt;360HRIS may provide Information, including customer information, as security for an investment in 360HRIS. 360HRIS may provide information, including customer information, to third parties who purchase assets from 360HRIS where such information is relevant to the assets so sold.&lt;/span&gt;&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;Only employees with a business need-to-know, or whose duties so require, are granted access to customer, client and employee personal information.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9.0pt;line-height:107%;font-family:&#39;Open Sans&#39;,sans-serif;color:#373C4C;&#34;&gt;&lt;span style=&#34;font-family:Arial;&#34;&gt;360HRIS will retain personal information only as long as necessary to fulfill the identified purposes. Depending on the circumstances, personal information used to make a decision about a customer, client or employee is kept long enough to allow the customer or employee access to the information after the decision has been made.&lt;/span&gt;&lt;br style=&#34;box-sizing:inherit;&#34; /&gt;&lt;span style=&#34;font-family:Arial;&#34;&gt;360HRIS has established reasonable guidelines and procedures for information and records retention, and any personal information no longer needed for its identified purposes or for legal requirements will be destroyed, erased or made anonymous within a reasonable period of time.&lt;/span&gt;&lt;/span&gt;&lt;/h6&gt;&lt;h4 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:13.5pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;6. Ensuring accuracy of personal information&lt;/span&gt;&lt;/h4&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;360HRIS will make reasonable efforts to ensure that personal information of individuals is as accurate, complete, and up-to-date as is necessary for the purposes for which it is to be used.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;Personal information will not be updated without the consent of the individual and it will only be updated if it is necessary for the continued use of the personal information.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;360HRIS will make reasonable efforts to obtain information from individuals in order to update information on hand if required to fulfill the purposes for which the information was collected. Once informed by a person that personal information held by 360HRIS about them is inaccurate, 360HRIS will update the information as soon as possible.&lt;/span&gt;&lt;/h6&gt;&lt;h4 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:13.5pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;7. Safeguarding personal information&lt;/span&gt;&lt;/h4&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;360HRIS will protect personal information with safeguards appropriate to the sensitivity of the information. 360HRIS has implemented appropriate safeguards to protect personal information against such risks as loss or theft, unauthorized access, disclosure, copying, use, modification or destruction.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;360HRIS&amp;acute;s employees are made aware of the need to maintain the confidentiality of all personal information.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;The methods of protection used by 360HRIS will include:&lt;/span&gt;&lt;/h6&gt;&lt;ul&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;physical measures, for example, locked filing cabinets and restricted access to offices;&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;organizational measures, for example, limiting access on a &amp;ldquo;need-to-know&amp;rdquo; basis; and&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;technological measures, for example, the use of passwords and encryption.&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;/ul&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;7.3 360HRIS will ensure that its employees who are in contact with personal information are trained in the appropriate protection of personal information and that they are aware of the importance of maintaining the confidentiality of personal information. Employees are required to abide by this Privacy Policy.&lt;/span&gt;&lt;/h6&gt;&lt;h4 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:13.5pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;8. Making information about policies and procedures available to customers, clients and employees&lt;/span&gt;&lt;/h4&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;360HRIS&amp;rsquo;s policies and practices for the protection of personal information are made available to customers, clients, employees and general public. 360HRIS&amp;rsquo;s Privacy Policy is posted on the 360HRIS website and informs individuals about the type of personal information it collects, what it is used for and to whom the information is disclosed.&lt;/span&gt;&lt;/h6&gt;&lt;h4 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:13.5pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;9. Providing access to personal information&lt;/span&gt;&lt;/h4&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;When customers, clients or employees request it, 360HRIS will disclose to them what personal information 360HRIS has about the customer, client or employee, what it is being used for, and to whom it has been disclosed, and will give them reasonable access to their information. 360HRIS will provide a list of the third parties to which it may have disclosed the personal information when it is not possible to provide an actual list. Wrong or incomplete information will be amended and the amended information transmitted to third parties where appropriate. Any dispute over amending a file will be recorded and details of disputed data provided to third parties where appropriate.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;In certain situations, however, 360HRIS may not be able to give customers or employees access to all personal information it holds about the customer, client or employee. This may, for example, be the case when the information is unreasonably costly to provide, the information contains references to other individuals, the information cannot be disclosed for legal, security or commercial proprietary reasons or the information is subject to solicitor-client or litigation privilege. 360HRIS will explain the reasons for denying access in writing, and the recourse available to the customer, client or employee.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;360HRIS will make reasonable efforts to respond to an individual&amp;rsquo;s request for access to his or her personal information no later than 30 days after receipt of the written request, and at minimal or no cost. The individual will be informed of any extensions to the time limit and his or her right to complain to the Privacy Commissioner.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;360HRIS may not provide access to personal information to an individual if doing so would likely reveal personal information about a third party, unless:&lt;/span&gt;&lt;/h6&gt;&lt;ul&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;the information about the third party can be severed from the record containing the information about the individual, in which case it will be severed prior to providing the access;&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;the third party consents to the access; or&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;the individual needs the information because an individual&amp;rsquo;s life, health or security is threatened.&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;/ul&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;Access to personal information will not be given if:&lt;/span&gt;&lt;/h6&gt;&lt;ul&gt;&lt;li&gt;&lt;ul&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;the information is protected by solicitor-client privilege;&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;to do so would reveal confidential commercial information;&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;/ul&gt;&lt;/li&gt;&lt;/ul&gt;&lt;ul&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;to do so could reasonably be expected to threaten the life or security of another individual; or&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;the information was generated in the course of a formal dispute resolution process.&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;A customer or client can obtain information or seek access to his or her personal information by contacting a 360HRIS representative at the 360HRIS office.&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;li&gt;&lt;h6&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;An employee can obtain information or seek access to his or her individual personal file by contacting the 360HRIS Privacy Officer.&lt;/span&gt;&lt;/h6&gt;&lt;/li&gt;&lt;/ul&gt;&lt;h4 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:13.5pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;10. Handling complaints &lt;/span&gt;&lt;span style=&#34;font-size:small;line-height:107%;font-family:&#39;Open Sans&#39;, sans-serif;color:#373c4c;&#34;&gt;&lt;/span&gt;&lt;span style=&#34;font-size:13.5pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;and questions&lt;/span&gt;&lt;/h4&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;Customers, clients or employees may challenge 360HRIS compliance with its Privacy Policy. 360HRIS has implemented an internal escalation policy to deal with the receipt, investigation and responses to complaints and questions regarding privacy issues.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;All complaints and questions will be responded to in a timely manner under the circumstances. All complaints will be investigated and appropriate measures taken to correct deficient policies and practices. Customers, clients or employees have the right to contact the Privacy Commissioner in the event of any dispute.&lt;/span&gt;&lt;/h6&gt;&lt;h6 style=&#34;margin-top:7.5pt;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;background:#FEFEFE;box-sizing:inherit;font-variant-ligatures:normal;font-variant-caps:normal;orphans:2;widows:2;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;word-spacing:0px;&#34;&gt;&lt;span style=&#34;font-size:9pt;line-height:107%;font-family:Arial;color:#373c4c;&#34;&gt;Any complaints or concerns regarding personal information and this Privacy Policy may be addressed to 360HRIS.&lt;/span&gt;&lt;/h6&gt;&lt;p&gt;&lt;span style=&#34;font-family:Arial;&#34;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;', 1);
INSERT INTO `ci_cms_pages` (`page_id`, `page_name`, `page_type`, `page_description`, `is_active`) VALUES
(2, 'Terms & Conditions', 'footer', '&lt;ul&gt;&lt;li&gt;&lt;span style=&#34;font-size:10.5pt;font-family:Arial;letter-spacing:-0.2pt;&#34;&gt;Your complete information is required to complete the sign up process for this service.&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&#34;font-size:10.5pt;font-family:Arial;letter-spacing:-0.2pt;&#34;&gt;You must be 18 years or older to use this service.&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&#34;font-size:10.5pt;font-family:Arial;letter-spacing:-0.2pt;&#34;&gt;You must keep your password secure, 360HRIS will not be liable for any loss or damage from your failure to maintain the security of your account and password.&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&#34;font-size:10.5pt;font-family:Arial;letter-spacing:-0.2pt;&#34;&gt;You cannot use 360HRIS for any illegal or unauthorized purpose nor may you, in the use of the service, violate any laws in your jurisdiction (including but not limited to copyright laws).&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&#34;font-size:10.5pt;font-family:Arial;letter-spacing:-0.2pt;&#34;&gt;You are responsible for all activity and content (data, images, documents, etc.) that is added in your HR system.&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&#34;font-size:10.5pt;font-family:Arial;letter-spacing:-0.2pt;&#34;&gt;You must not transmit any worms or viruses or any code of a destructive nature.&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&#34;font-size:10.5pt;font-family:Arial;letter-spacing:-0.2pt;&#34;&gt;360HRIS reserves the right to terminate your account in case of a breach or violation of our terms and conditions.&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&#34;font-size:10.5pt;font-family:Arial;letter-spacing:-0.2pt;&#34;&gt;360HRIS reserves the right to refuse this service to anyone without providing any reasons.&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&#34;font-size:10.5pt;font-family:Arial;letter-spacing:-0.2pt;&#34;&gt;You use this service at your own risk, the service is provided on an &#34;as is&#34; and &#34;as available&#34; basis without any warranty or condition, express, implied or statutory.&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&#34;font-size:10.5pt;font-family:Arial;letter-spacing:-0.2pt;&#34;&gt;360HRIS does not warranty the 100% uptime of this application; we will however make sure the application is up and running 99.99% of the time.&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&#34;font-size:10.5pt;font-family:Arial;letter-spacing:-0.2pt;&#34;&gt;360HRIS does not warrant the reliability &amp;amp; accuracy of the results obtained from the use of this service.&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&#34;font-size:10.5pt;font-family:Arial;letter-spacing:-0.2pt;&#34;&gt;We may, but have no obligation to, remove Content and Accounts containing Content that we determine in our sole discretion are unlawful, offensive, threatening, libelous, defamatory, pornographic, obscene or otherwise objectionable or violates any party&#39;s intellectual property or these Terms of Service.&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&#34;font-size:10.5pt;font-family:Arial;letter-spacing:-0.2pt;&#34;&gt;360HRIS does not warrant that the quality of any products, services, information, or other material purchased or obtained by you through the Service will meet your expectations.&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&#34;font-size:10.5pt;font-family:Arial;letter-spacing:-0.2pt;&#34;&gt;360HRIS shall not be liable for any direct, indirect, incidental, special, consequential or exemplary damages, including but not limited to, damages for loss of profits, goodwill, use, data or other intangible losses resulting from the use of or inability to use the service.&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&#34;font-size:10.5pt;font-family:Arial;letter-spacing:-0.2pt;&#34;&gt;Technical and sales support is provided via one of the following methods: Phone, Email, Support Tickets, Live Chat, Skype.&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&#34;font-size:10.5pt;font-family:Arial;letter-spacing:-0.2pt;&#34;&gt;You agree not to reproduce, duplicate, copy, sell, resell or exploit any portion of the Service, use of the Service, or access to the Service without the express written permission by 360HRIS.&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&#34;font-size:10.5pt;font-family:Arial;letter-spacing:-0.2pt;&#34;&gt;360HRIS reserves the right to use your company&#39;s logo on its website, under the Clients section.&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&#34;font-size:10.5pt;font-family:Arial;letter-spacing:-0.2pt;&#34;&gt;360HRIS does not pre-screen your content; you are sole responsible for adding information / uploading documents on your HR system.&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&#34;font-size:10.5pt;font-family:Arial;letter-spacing:-0.2pt;&#34;&gt;360HRIS may send emails to the administrator or employees of the company for any promotional campaigns.&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&#34;font-size:10.5pt;font-family:Arial;letter-spacing:-0.2pt;&#34;&gt;If 360HRIS sends a proposal to your company with special terms, it will be valid for 15 days from the time it was submitted.&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&#34;font-family:Arial;&#34;&gt;&lt;/span&gt;&lt;span style=&#34;font-family:Arial;&#34;&gt;&lt;/span&gt;&lt;/li&gt;&lt;/ul&gt;&lt;span style=&#34;font-family:Arial;&#34;&gt;&lt;/span&gt;', 1),
(3, 'Home Page', 'main_content', '&lt;section class=&#34;services__area grey-bg-3 pt-120 mt-0 pb-60 p-relative&#34;&gt;&lt;div class=&#34;services__shape-2&#34;&gt;&lt;img class=&#34;services-2-circle&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-2/services-circle.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;services-2-circle-2&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-2/services-circle-2.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;row align-items-end&#34;&gt;&lt;div class=&#34;col-xxl-4 col-lg-5 col-md-7&#34;&gt;&lt;div class=&#34;section__title-wrapper mb-70 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;span class=&#34;section__pre-title purple&#34;&gt;REASONS WHY&lt;/span&gt; &lt;h2 class=&#34;section__title section__title-2&#34;&gt;Everything you need in one HR software.&lt;/h2&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-8 col-lg-7 col-md-5&#34;&gt;&lt;div class=&#34;services__more mb-70 text-sm-end wow fadeInUp&#34; data-wow-delay=&#34;.5s&#34; style=&#34;visibility:visible;animation-delay:0.5s;animation-name:fadeInUp;&#34;&gt;&lt;a href=&#34;features&#34; class=&#34;w-btn w-btn-blue w-btn-6 w-btn-3&#34;&gt;view more&lt;/a&gt; &lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__inner services__inner-2 hover__active mb-30&#34;&gt;&lt;div class=&#34;services__item-2 transition-3 white-bg &#34;&gt;&lt;div class=&#34;services__icon-2&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-2/services-1.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-2&#34;&gt;&lt;h3 class=&#34;services__title-2&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Workmates&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;An employee experience platform to rethink communication, engagement, recognition and rewards, and so much more.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.5s&#34; style=&#34;visibility:visible;animation-delay:0.5s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__inner services__inner-2 hover__active active mb-30&#34;&gt;&lt;div class=&#34;services__item-2 transition-3 white-bg &#34;&gt;&lt;div class=&#34;services__icon-2&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-2/services-2.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-2&#34;&gt;&lt;h3 class=&#34;services__title-2&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Onboard&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Automate the entire onboarding experience--even before it officially starts--to make new hires first day great.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.7s&#34; style=&#34;visibility:visible;animation-delay:0.7s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__inner services__inner-2 hover__active mb-30&#34;&gt;&lt;div class=&#34;services__item-2 transition-3 white-bg&#34;&gt;&lt;div class=&#34;services__icon-2&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-2/services-3.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-2&#34;&gt;&lt;h3 class=&#34;services__title-2&#34;&gt;&lt;a href=&#34;#!&#34;&gt;People HRMS&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Powerful, proven, comprehensive HR solution delivers all the tools HR teams need to manage the entire employee lifecycle.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;&lt;section class=&#34;about__area grey-bg-3 pt-40 pb-120 p-relative&#34;&gt;&lt;div class=&#34;about__shape-2&#34;&gt;&lt;img class=&#34;about-2-circle&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/about/home-2/about-circle.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;about-2-circle-2&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/about/home-2/about-circle-2.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-7 col-xl-7 col-lg-6 col-md-8&#34;&gt;&lt;div class=&#34;about__thumb-3 wow fadeInLeft&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInLeft;&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/services/01.png&#34; alt=&#34;&#34; width=&#34;525&#34; /&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-5 col-xl-5 col-lg-6 col-md-8&#34;&gt;&lt;div class=&#34;about__content-3 pt-55&#34;&gt;&lt;div class=&#34;section__title-wrapper section__title-wrapper-2 mb-55 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;span class=&#34;section__pre-title pink&#34;&gt;Features&lt;/span&gt; &lt;h2 class=&#34;section__title section__title-2&#34;&gt;Save Time and Money&lt;/h2&gt;&lt;p&gt;Automated Core HR solution provides business perks like decreased costs. An HR employee has more time on more meaningful tasks, while a company has increased savings..&lt;/p&gt;&lt;/div&gt;&lt;a href=&#34;register&#34; class=&#34;w-btn w-btn-blue w-btn-3 w-btn-1&#34;&gt;Get Started&lt;/a&gt; &lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;&lt;section class=&#34;services__area p-relative pt-150 pb-130&#34;&gt;&lt;div class=&#34;services__shape&#34;&gt;&lt;img class=&#34;services-circle-1&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-1/circle-1.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;services-circle-2&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-1/circle-2.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;services-dot&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-1/dot.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;services-triangle&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-1/triangle.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-6 col-md-10 offset-md-1 p-0&#34;&gt;&lt;div class=&#34;section__title-wrapper text-center mb-75 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;h2 class=&#34;section__title&#34;&gt;Give your most valuable asset &amp;mdash; your employees -&lt;/h2&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6&#34;&gt;&lt;div class=&#34;services__inner hover__active mb-30 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item white-bg text-center transition-3 &#34;&gt;&lt;div class=&#34;services__icon mb-25 d-flex align-items-end justify-content-center&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-1/services-1.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content&#34;&gt;&lt;h3 class=&#34;services__title&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Approve Requests&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Get notifications for all approvals that require your action. Speed up the entire approval process and streamline communication.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6&#34;&gt;&lt;div class=&#34;services__inner hover__active mb-30 wow fadeInUp active&#34; data-wow-delay=&#34;.5s&#34; style=&#34;visibility:visible;animation-delay:0.5s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item white-bg mb-30 text-center transition-3&#34;&gt;&lt;div class=&#34;services__icon mb-25 d-flex align-items-end justify-content-center&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-1/services-2.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content&#34;&gt;&lt;h3 class=&#34;services__title&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Track Attendance&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Request and approve time-off requests with ease, visualize absences in real-time with shared Out-of-office Calendar.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6&#34;&gt;&lt;div class=&#34;services__inner hover__active mb-30 wow fadeInUp&#34; data-wow-delay=&#34;.9s&#34; style=&#34;visibility:visible;animation-delay:0.9s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item white-bg text-center transition-3&#34;&gt;&lt;div class=&#34;services__icon mb-25 d-flex align-items-end justify-content-center&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-1/services-4.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content&#34;&gt;&lt;h3 class=&#34;services__title&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Personal Data&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Access your personal employee records, including job contracts and documents. Upload and edit files on the go.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;&lt;section class=&#34;why__area pt-135 pb-90&#34;&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-7 col-xl-8 col-lg-8&#34;&gt;&lt;div class=&#34;why__wrapper&#34;&gt;&lt;div class=&#34;section__title-wrapper section__title-wrapper-3 mb-45 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;span class=&#34;section__pre-title-img&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/title/why.png&#34; alt=&#34;&#34; /&gt;&lt;/span&gt; &lt;h2 class=&#34;section__title section__title-3&#34;&gt;Where great companies hire great people&lt;/h2&gt;&lt;p&gt;TimeHRM is proud of our accomplishments and we think you will be too!&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;why__counter&#34;&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;why__item text-center white-bg mb-30&#34;&gt;&lt;div class=&#34;why__icon mb-15&#34;&gt;&lt;em class=&#34;icon_star&#34;&gt;&lt;/em&gt;&lt;/div&gt;&lt;div class=&#34;why__content&#34;&gt;&lt;h3 class=&#34;why__title&#34;&gt;&lt;span class=&#34;counter&#34;&gt;4.9&lt;/span&gt; Stars&lt;/h3&gt;&lt;p&gt;Average Rating&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 wow fadeInUp&#34; data-wow-delay=&#34;.5s&#34; style=&#34;visibility:visible;animation-delay:0.5s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;why__item text-center white-bg mb-30&#34;&gt;&lt;div class=&#34;why__icon mb-15&#34;&gt;&lt;em class=&#34;icon_ribbon&#34;&gt;&lt;/em&gt;&lt;/div&gt;&lt;div class=&#34;why__content&#34;&gt;&lt;h3 class=&#34;why__title&#34;&gt;&lt;span class=&#34;counter&#34;&gt;4000&lt;/span&gt;+&lt;/h3&gt;&lt;p&gt;Global Clients&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 wow fadeInUp&#34; data-wow-delay=&#34;.7s&#34; style=&#34;visibility:visible;animation-delay:0.7s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;why__item text-center white-bg mb-30&#34;&gt;&lt;div class=&#34;why__icon mb-15&#34;&gt;&lt;em class=&#34;icon_star&#34;&gt;&lt;/em&gt;&lt;/div&gt;&lt;div class=&#34;why__content&#34;&gt;&lt;h3 class=&#34;why__title&#34;&gt;&lt;span class=&#34;counter&#34;&gt;1000&lt;/span&gt;+&lt;/h3&gt;&lt;p&gt;Client Testimonials&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 offset-xxl-1 col-xl-4 col-lg-4 col-md-6&#34;&gt;&lt;div class=&#34;why__features white-bg wow fadeInUp&#34; data-wow-delay=&#34;.9s&#34; style=&#34;visibility:visible;animation-delay:0.9s;animation-name:fadeInUp;&#34;&gt;&lt;ul&gt;&lt;li&gt;Free Setup&lt;/li&gt;&lt;li&gt;Free Support&lt;/li&gt;&lt;li&gt;Free Training&lt;/li&gt;&lt;li&gt;No Maintenance Fees&lt;/li&gt;&lt;li&gt;Free Updates/Upgrades&lt;/li&gt;&lt;/ul&gt;&lt;a href=&#34;contact&#34;&gt;Contact Us&lt;/a&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;&lt;section class=&#34;cta__area mb--149 p-relative&#34;&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;cta__inner p-relative fix z-index-1 wow fadeInUp&#34; data-wow-delay=&#34;.5s&#34; style=&#34;visibility:visible;animation-delay:0.5s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-12&#34;&gt;&lt;div class=&#34;cta__wrapper d-lg-flex justify-content-between align-items-center&#34;&gt;&lt;div class=&#34;cta__content&#34;&gt;&lt;h3 class=&#34;cta__title&#34;&gt;&lt;/h3&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;', 0),
(4, 'Features', 'main_content', '&lt;section class=&#34;services__area pt-120 pb-110 p-relative&#34;&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-8 offset-xxl-2 col-xl-10 offset-xl-1&#34;&gt;&lt;div class=&#34;section__title-wrapper section__title-wrapper-3 text-center section-padding-3 mb-80 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;span class=&#34;section__pre-title-img&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/title/services.png&#34; alt=&#34;&#34; /&gt;&lt;/span&gt; &lt;h2 class=&#34;section__title section__title-3&#34;&gt;HR Software that Improves the employee experience.&lt;/h2&gt;&lt;p&gt;HR Software that Improves the Employee Experience and Drives Business Results.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item-3 white-bg transition-3 mb-30 text-center&#34;&gt;&lt;div class=&#34;services__icon-3&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-3/services-1.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-3&#34;&gt;&lt;h3 class=&#34;services__title-3&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Secure login&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Log in safely and securely with the username and password provided by your employer.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.5s&#34; style=&#34;visibility:visible;animation-delay:0.5s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item-3 white-bg transition-3 mb-30 text-center&#34;&gt;&lt;div class=&#34;services__icon-3&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-3/services-2.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-3&#34;&gt;&lt;h3 class=&#34;services__title-3&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Everything in one place&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Get a complete overview of your employees, including finance, salary, and other add-ons all in one place.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.7s&#34; style=&#34;visibility:visible;animation-delay:0.7s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item-3 white-bg transition-3 mb-30 text-center&#34;&gt;&lt;div class=&#34;services__icon-3&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-3/services-3.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-3&#34;&gt;&lt;h3 class=&#34;services__title-3&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Core HR&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Automate essential HR processes, create transparency with accessible modules, and maintain centralized storage.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;&lt;section class=&#34;about__area pb-120 p-relative&#34;&gt;&lt;div class=&#34;about__shape&#34;&gt;&lt;img class=&#34;about-triangle&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/about/home-1/triangle.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;about-circle&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/about/home-1/circle.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;about-circle-2&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/about/home-1/circle-2.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;about-circle-3&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/about/home-1/circle-3.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;row align-items-center&#34;&gt;&lt;div class=&#34;col-xxl-5 col-xl-6 col-lg-6 col-md-9&#34;&gt;&lt;div class=&#34;about__wrapper mb-10&#34;&gt;&lt;div class=&#34;section__title-wrapper mb-25&#34;&gt;&lt;h2 class=&#34;section__title&#34;&gt;Time and attendance&lt;/h2&gt;&lt;p&gt;Setup company attendance policies, track and approve both paid and unpaid time off, and register time spent on other work-related activities through a Employee Self Service portal.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-6 offset-xxl-1 col-xl-6 col-lg-6 col-md-10 order-first order-lg-last&#34;&gt;&lt;div class=&#34;about__thumb-wrapper p-relative ml-40 fix text-end&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/about/home-1/about-bg.png&#34; alt=&#34;&#34; /&gt;&lt;div class=&#34;about__thumb p-absolute&#34;&gt;&lt;img class=&#34;bounceInUp wow about-big&#34; data-wow-delay=&#34;.3s&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/about/home-1/about-1.png&#34; alt=&#34;&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:bounceInUp;&#34; /&gt;&lt;img class=&#34;about-sm&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/about/home-1/about-1-1.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;&lt;section class=&#34;features__area pt-135 pb-120 p-relative&#34;&gt;&lt;div class=&#34;features__shape-2&#34;&gt;&lt;img class=&#34;features-2-dot&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/features/home-2/features-dot.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;features-2-dot-2&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/features/home-2/features-dot-2.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;features-2-dot-3&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/features/home-2/features-dot-3.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;features-2-triangle-1&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/features/home-2/features-triangle-1.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;features-2-triangle-2&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/features/home-2/features-triangle-2.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;features-2-triangle-3&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/features/home-2/features-triangle-3.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-6 offset-xxl-3 col-xl-8 offset-xl-2 col-lg-8 offset-lg-2&#34;&gt;&lt;div class=&#34;section__title-wrapper section__title-wrapper-2 text-center mb-75 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;span class=&#34;section__pre-title purple&#34;&gt;Features&lt;/span&gt; &lt;h2 class=&#34;section__title section__title-2&#34;&gt;Highly Creative Soultions&lt;/h2&gt;&lt;p&gt;software which you can handle every business transactions in a single system&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-1 col-lg-8 col-md-8&#34;&gt;&lt;div class=&#34;features__tab-content&#34;&gt;&lt;div class=&#34;tab-content&#34; id=&#34;feaTabContent&#34;&gt;&lt;div class=&#34;tab-pane fade&#34; id=&#34;sync&#34; role=&#34;tabpanel&#34; aria-labelledby=&#34;sync-tab&#34;&gt;&lt;div class=&#34;features__thumb&#34;&gt;&lt;div class=&#34;features__thumb-inner&#34;&gt;&lt;img class=&#34;fea-thumb&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/features/home-2/fea-thumb-2.jpg&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;fea-sm&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/features/home-2/fea-sm.jpg&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;fea-sm-2&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/features/home-2/fea-sm-2.jpg&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;fea-2-shape&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/features/home-2/features-shape.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;tab-pane fade show active&#34; id=&#34;security&#34; role=&#34;tabpanel&#34; aria-labelledby=&#34;security-tab&#34;&gt;&lt;div class=&#34;features__thumb&#34;&gt;&lt;div class=&#34;features__thumb-inner&#34;&gt;&lt;img class=&#34;fea-thumb&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/features/home-2/fea-thumb.jpg&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;fea-sm&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/features/home-2/fea-sm.jpg&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;fea-sm-2&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/features/home-2/fea-sm-2.jpg&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;fea-2-shape&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/features/home-2/features-shape.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;tab-pane fade&#34; id=&#34;multitask&#34; role=&#34;tabpanel&#34; aria-labelledby=&#34;multitask-tab&#34;&gt;&lt;div class=&#34;features__thumb&#34;&gt;&lt;div class=&#34;features__thumb-inner&#34;&gt;&lt;img class=&#34;fea-thumb&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/features/home-2/fea-thumb-3.jpg&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;fea-sm&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/features/home-2/fea-sm.jpg&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;fea-sm-2&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/features/home-2/fea-sm-2.jpg&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;fea-2-shape&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/features/home-2/features-shape.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;&lt;section class=&#34;services__area pt-120 pb-110 p-relative&#34;&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-8 offset-xxl-2 col-xl-10 offset-xl-1&#34;&gt;&lt;div class=&#34;section__title-wrapper section__title-wrapper-3 text-center section-padding-3 mb-80 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;span class=&#34;section__pre-title-img&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/title/services.png&#34; alt=&#34;&#34; /&gt;&lt;/span&gt; &lt;h2 class=&#34;section__title section__title-3&#34;&gt;Why Use TimeHRM Solution?&lt;/h2&gt;&lt;p&gt;With a wide variety of core HR services on the market&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item-3 white-bg transition-3 mb-30 text-center&#34;&gt;&lt;div class=&#34;services__icon-3&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-3/services-4.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-3&#34;&gt;&lt;h3 class=&#34;services__title-3&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Track of Employees&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;stay aware of how many employees work for the company/department, what roles are occupied.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.5s&#34; style=&#34;visibility:visible;animation-delay:0.5s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item-3 white-bg transition-3 mb-30 text-center&#34;&gt;&lt;div class=&#34;services__icon-3&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-3/services-5.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-3&#34;&gt;&lt;h3 class=&#34;services__title-3&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Enhanced analytics&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Create different types of reports or dashboards, adjust them according to your personalized business needs.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.7s&#34; style=&#34;visibility:visible;animation-delay:0.7s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item-3 white-bg transition-3 mb-30 text-center&#34;&gt;&lt;div class=&#34;services__icon-3&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-3/services-6.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-3&#34;&gt;&lt;h3 class=&#34;services__title-3&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Solution alternative&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;offers cloud and on-premises solutions: make a choice depending on your budget and business needs.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-12 wow fadeInUp&#34; data-wow-delay=&#34;.9s&#34; style=&#34;visibility:visible;animation-delay:0.9s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__more text-center mt-30&#34;&gt;&lt;a href=&#34;register&#34; class=&#34;w-btn w-btn-purple w-btn-purple-2 w-btn-3 w-btn-6&#34; title=&#34;Try for free&#34;&gt;Try for free&lt;/a&gt; &lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;&lt;section class=&#34;services__area pt-90 pb-110&#34;&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-6 offset-xl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1&#34;&gt;&lt;div class=&#34;section__title-wrapper section__title-wrapper-4 text-center mb-65 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;h2 class=&#34;section__title section__title-4 section__title-4-p-2&#34;&gt;Bring your team together&lt;/h2&gt;&lt;p&gt;TimeHRM solutions give HR teams a new advantage over past approaches.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-6 col-xl-6 col-lg-6 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item-4 white-bg mb-30&#34;&gt;&lt;div class=&#34;services__thumb-4 text-center d-flex align-items-end justify-content-center&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/services/home-4/services-1.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-4&#34;&gt;&lt;h3 class=&#34;services__title-4&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Employee self service&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Increase employee engagement, create ownership, save time / costs, and improve collaboration with Employee Self Service (ESS) and Manager Self Service (MSS) portals.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-6 col-xl-6 col-lg-6 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.5s&#34; style=&#34;visibility:visible;animation-delay:0.5s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item-4 white-bg mb-30&#34;&gt;&lt;div class=&#34;services__thumb-4 text-center d-flex align-items-end justify-content-center&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/services/home-4/services-2.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-4&#34;&gt;&lt;h3 class=&#34;services__title-4&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Performance&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Empower and engage high performers by setting clear goals and streamlining employee appraisal and feedback processes. Focus on productivity, creating a thriving company culture.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;&lt;section class=&#34;cta__area blue-bg-10 pt-140 pb-130 p-relative fix z-index-1&#34;&gt;&lt;div class=&#34;cta__shape&#34;&gt;&lt;img class=&#34;cta-4-shape&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/cta/home-4/cta-shape.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-8 offset-xxl-2&#34;&gt;&lt;div class=&#34;cta__content-4 text-center&#34;&gt;&lt;div class=&#34;section__title-wrapper section__title-wrapper-4 section__title-white text-center mb-45 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;h2 class=&#34;section__title section__title-4&#34;&gt;Our Free Trial for 14-days Today&lt;/h2&gt;&lt;p&gt;Spend less time scheduling and more time investing in your team and business.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;cta__form mb-25 wow fadeInUp&#34; data-wow-delay=&#34;.5s&#34; style=&#34;visibility:visible;animation-delay:0.5s;animation-name:fadeInUp;&#34;&gt;&lt;a href=&#34;register&#34; class=&#34;w-btn w-btn-3 w-btn-1&#34;&gt;Start Free Trial&lt;/a&gt; &lt;/div&gt;&lt;div class=&#34;cta__features wow fadeInUp&#34; data-wow-delay=&#34;.7s&#34; style=&#34;visibility:visible;animation-delay:0.7s;animation-name:fadeInUp;&#34;&gt;&lt;ul&gt;&lt;li&gt;Product support&lt;/li&gt;&lt;li&gt;Free Trial&lt;/li&gt;&lt;li&gt;Connect Customer&lt;/li&gt;&lt;/ul&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;', 0),
(5, 'About Us', 'footer', '&lt;span style=&#34;font-family:Arial;&#34;&gt;&lt;/span&gt;&lt;span id=&#34;docs-internal-guid-a0be3009-7fff-b887-f94e-d38c2d12fa3a&#34; style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;color:#6c6a8a;font-family:&#39;Open Sans&#39;, sans-serif;font-size:15px;background-color:#ffffff;&#34;&gt;&lt;p dir=&#34;ltr&#34; style=&#34;box-sizing:border-box;margin-top:0pt;margin-bottom:0pt;padding:0px;transition:all 0.3s ease-out 0s;line-height:1.2;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;color:#000033;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;font-family:Arial;&#34;&gt;360HRIS is an online human resource management platform that offers you all the necessary tools and functions for effective human resource management. The platform derives its inspiration from the experiences and difficulties faced while being a small business itself. Therefore, the management and developers of 360HRIS &lt;/span&gt;&lt;span style=&#34;color:#000033;font-size:12pt;white-space:pre-wrap;font-family:Arial;&#34;&gt;is an online human resource management platform that offers you all the necessary tools and functions for effective human resource management. The platform derives its inspiration from the experiences and difficulties faced while being a small business itself. Therefore, the management and developers of 360HRIS have considerable insight into the obstacles to effective Human Resource Management faced by many small and medium-scale enterprises. We understand your needs regarding project management, assignment management, offering tasks to employees, and managing employee payrolls in detail. Therefore, our team has incorporated the management needs of all such procedures in a single platform, ensuring high efficiency and utility throughout the process.&lt;/span&gt;&lt;/p&gt;&lt;span id=&#34;docs-internal-guid-a0be3009-7fff-b887-f94e-d38c2d12fa3a&#34; style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;color:#6c6a8a;font-family:&#39;Open Sans&#39;, sans-serif;font-size:15px;background-color:#ffffff;&#34;&gt;&lt;h2 dir=&#34;ltr&#34; style=&#34;box-sizing:border-box;margin:0pt 0px;padding:0px;line-height:1.2;font-size:36px;transition:all 0.3s ease-out 0s;color:#070337;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;color:#000033;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;font-family:Arial;&#34;&gt;Mission Statement&lt;/span&gt;&lt;/h2&gt;&lt;p dir=&#34;ltr&#34; style=&#34;box-sizing:border-box;margin-top:0pt;margin-bottom:0pt;padding:0px;transition:all 0.3s ease-out 0s;line-height:1.2;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;color:#000033;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;font-family:Arial;&#34;&gt;Offer an online human resource management platform that brings together all functionalities required by small-scale businesses to manage their human resource.&lt;/span&gt;&lt;/p&gt;&lt;h2 dir=&#34;ltr&#34; style=&#34;box-sizing:border-box;margin:0pt 0px;padding:0px;line-height:1.2;font-size:36px;transition:all 0.3s ease-out 0s;color:#070337;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;color:#000033;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;font-family:Arial;&#34;&gt;Vision&lt;/span&gt;&lt;/h2&gt;&lt;p dir=&#34;ltr&#34; style=&#34;box-sizing:border-box;margin-top:0pt;margin-bottom:0pt;padding:0px;transition:all 0.3s ease-out 0s;line-height:1.2;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;color:#000033;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;font-family:Arial;&#34;&gt;We are helping small-scale businesses to expand through effective online human resource management services.&lt;/span&gt;&lt;/p&gt;&lt;h2 dir=&#34;ltr&#34; style=&#34;box-sizing:border-box;margin:0pt 0px;padding:0px;line-height:1.2;font-size:36px;transition:all 0.3s ease-out 0s;color:#070337;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;color:#000033;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;font-family:Arial;&#34;&gt;Our Core Values&lt;/span&gt;&lt;/h2&gt;&lt;p dir=&#34;ltr&#34; style=&#34;box-sizing:border-box;margin-top:0pt;margin-bottom:0pt;padding:0px;transition:all 0.3s ease-out 0s;line-height:1.2;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;color:#000033;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;font-family:Arial;&#34;&gt;360HRIS follows a set of unique core values that sets our organization apart from other competitors:&lt;/span&gt;&lt;/p&gt;&lt;p dir=&#34;ltr&#34; style=&#34;box-sizing:border-box;margin-top:0pt;margin-bottom:0pt;padding:0px;transition:all 0.3s ease-out 0s;line-height:1.2;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;color:#000033;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;font-family:Arial;&#34;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;/span&gt;&lt;ul dir=&#34;ltr&#34; role=&#34;presentation&#34; style=&#34;box-sizing:border-box;margin:0pt 0px;padding:0px;color:#6c6a8a;font-family:&#39;Open Sans&#39;, sans-serif;font-size:15px;background-color:#ffffff;line-height:1.2;&#34;&gt;&lt;li style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;list-style:none;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;color:#000000;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;color:#000033;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;font-weight:bolder;font-family:Arial;&#34;&gt;Client-First Approach:&lt;/span&gt;&lt;span style=&#34;font-family:Arial;&#34;&gt; For us, you, the users, are the most critical factor in our services. No matter how excellent a service we provide, it needs improvement if it does not satisfy our users. This focus has helped us improve our products highly over time&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/li&gt;&lt;li style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;list-style:none;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;color:#000000;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;color:#000033;&#34;&gt;&lt;span style=&#34;font-family:Arial;&#34;&gt;&amp;nbsp;&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/li&gt;&lt;li style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;list-style:none;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;color:#000000;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;color:#000033;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;font-weight:bolder;font-family:Arial;&#34;&gt;High-End Functionality:&lt;/span&gt;&lt;span style=&#34;font-family:Arial;&#34;&gt; A platform with a great idea but an undermining framework is likely to offer lower value to clients than possible. Therefore, 360HRIS focuses on refining each function to the point of perfection.&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/li&gt;&lt;li style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;list-style:none;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;color:#000000;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;color:#000033;&#34;&gt;&lt;span style=&#34;font-family:Arial;&#34;&gt;&amp;nbsp;&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/li&gt;&lt;li style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;list-style:none;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;color:#000000;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;color:#000033;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;font-weight:bolder;font-family:Arial;&#34;&gt;Affordable Pricing:&lt;/span&gt;&lt;span style=&#34;font-family:Arial;&#34;&gt; We are here to support small and medium-scale businesses. For us, their success matters more than their money. Therefore, all packages of 360HRIS are priced competitively despite offering numerous more functions than other competing platforms.&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;color:#000000;&#34;&gt;&lt;/span&gt;&lt;/li&gt;&lt;/ul&gt;&lt;span id=&#34;docs-internal-guid-a0be3009-7fff-b887-f94e-d38c2d12fa3a&#34; style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;color:#6c6a8a;font-family:&#39;Open Sans&#39;, sans-serif;font-size:15px;background-color:#ffffff;&#34;&gt;&lt;h2 dir=&#34;ltr&#34; style=&#34;box-sizing:border-box;margin:0pt 0px;padding:0px;line-height:1.2;font-size:36px;transition:all 0.3s ease-out 0s;color:#070337;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;white-space:pre-wrap;color:#000033;font-family:Arial;&#34;&gt;&amp;nbsp;&lt;/span&gt;&lt;/h2&gt;&lt;/span&gt;&lt;/span&gt;', 1);
INSERT INTO `ci_cms_pages` (`page_id`, `page_name`, `page_type`, `page_description`, `is_active`) VALUES
(6, 'Communications', 'footer', '&lt;span style=&#34;font-family:Arial;&#34;&gt;&lt;/span&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;strong&gt;&lt;span style=&#34;font-size:12pt;font-family:Arial;color:#000033;&#34;&gt;On Platform Communications&lt;/span&gt;&lt;/strong&gt;&lt;strong&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;span style=&#34;font-size:12pt;font-family:Arial;color:#000033;&#34;&gt;Teams collaborating on the platform can communicate in many ways:&lt;/span&gt;&lt;/p&gt;&lt;ul style=&#34;margin-top:0cm;&#34; type=&#34;disc&#34;&gt;&lt;li data-list=&#34;0&#34; data-level=&#34;1&#34; style=&#34;color:#6C6A8A;margin-bottom:0cm;line-height:normal;tab-stops:list 36.0pt;background:white;vertical-align:baseline;&#34;&gt;&lt;span style=&#34;font-size:12pt;font-family:Arial;color:#000033;&#34;&gt;Team members can leave notes to different employees and management members about the performance and evaluations involved in the job.&lt;/span&gt;&lt;/li&gt;&lt;li data-list=&#34;0&#34; data-level=&#34;1&#34; style=&#34;color:#6C6A8A;margin-bottom:0cm;line-height:normal;tab-stops:list 36.0pt;background:white;vertical-align:baseline;&#34;&gt;&lt;span style=&#34;font-size:12pt;font-family:Arial;color:#000033;&#34;&gt;Time and Attendance data is communicated in the form of numbers and graphs.&amp;nbsp;&lt;/span&gt;&lt;/li&gt;&lt;li data-list=&#34;0&#34; data-level=&#34;1&#34; style=&#34;color:#6C6A8A;margin-bottom:0cm;line-height:normal;tab-stops:list 36.0pt;background:white;vertical-align:baseline;&#34;&gt;&lt;span style=&#34;font-size:12pt;font-family:Arial;color:#000033;&#34;&gt;Well-designed and easy-to-read graphs display most reports and analytical data from the platform.&lt;/span&gt;&lt;/li&gt;&lt;li data-list=&#34;0&#34; data-level=&#34;1&#34; style=&#34;color:#6C6A8A;margin-bottom:0cm;line-height:normal;tab-stops:list 36.0pt;background:white;vertical-align:baseline;&#34;&gt;&lt;span style=&#34;font-size:12pt;font-family:Arial;color:#000033;&#34;&gt;Employee self-service information is communicated to the management team on and off the platform, making all information fully synchronized.&lt;/span&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;strong&gt;&lt;span style=&#34;font-size:12pt;font-family:Arial;color:#000033;&#34;&gt;&amp;nbsp;&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;strong&gt;&lt;span style=&#34;font-size:12pt;font-family:Arial;color:#000033;&#34;&gt;How to Communicate with the 360HRIS Team?&lt;/span&gt;&lt;/strong&gt;&lt;strong&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;span style=&#34;font-size:12pt;font-family:Arial;color:#000033;&#34;&gt;You can 360HRIS&amp;rsquo;s team in multiple ways:&lt;/span&gt;&lt;/p&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;span style=&#34;font-size:12pt;font-family:Arial;color:#000033;&#34;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;ul style=&#34;margin-top:0cm;&#34; type=&#34;disc&#34;&gt;&lt;li data-list=&#34;1&#34; data-level=&#34;1&#34; style=&#34;color:#6C6A8A;margin-bottom:0cm;line-height:normal;tab-stops:list 36.0pt;background:white;vertical-align:baseline;&#34;&gt;&lt;span style=&#34;font-size:12pt;font-family:Arial;color:#000033;&#34;&gt;Please leave us an email on our official email account. Our team will get in touch with you shortly and try our best to resolve your issue. Use the email: admin@360HRIS.com.&lt;/span&gt;&lt;/li&gt;&lt;li data-list=&#34;1&#34; data-level=&#34;1&#34; style=&#34;color:#6C6A8A;margin-bottom:0cm;line-height:normal;tab-stops:list 36.0pt;background:white;vertical-align:baseline;&#34;&gt;&lt;span style=&#34;font-size:12pt;font-family:Arial;color:#000033;&#34;&gt;Try contacting us through our official contact form placed on our website. This form is openly accessible and can be used to leave a brief message. We get back to sender as soon as possible and help them resolve their query.&lt;/span&gt;&lt;/li&gt;&lt;li data-list=&#34;1&#34; data-level=&#34;1&#34; style=&#34;color:#6C6A8A;margin-bottom:0cm;line-height:normal;tab-stops:list 36.0pt;background:white;vertical-align:baseline;&#34;&gt;&lt;span style=&#34;font-size:12pt;font-family:Arial;color:#000033;&#34;&gt;You may open up a support ticket for our team to solve.&lt;/span&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p style=&#34;margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:36.0pt;line-height:normal;background:white;vertical-align:baseline;&#34;&gt;&lt;span style=&#34;font-size:12pt;font-family:Arial;color:#000033;&#34;&gt;&lt;/span&gt;&lt;span style=&#34;font-size:12pt;font-family:Arial;color:#000033;&#34;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;span style=&#34;font-size:12pt;font-family:Arial;color:#000033;&#34;&gt;360HRIS keeps all communications official, with a complete record of the communications maintained for future reference. We believe that maintaining communication data ensures optimum service quality and the best service experience for our clients.&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&#34;font-family:Arial;&#34;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;', 1),
(7, 'How It Works', 'footer', '&lt;span style=&#34;font-family:Arial;&#34;&gt;&lt;/span&gt;&lt;span style=&#34;font-size:small;&#34;&gt;&lt;/span&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;span style=&#34;font-family:Arial;color:#000033;font-size:small;&#34;&gt;360HRIS uses a closely integrated and well-managed system to ensure that all our features are available to the customers and users of the platform.&lt;/span&gt;&lt;/p&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;span style=&#34;font-family:Arial;color:#000033;font-size:small;&#34;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;span style=&#34;font-family:Arial;color:#000033;font-size:small;&#34;&gt;Whenever a client makes an account on the website, a separate workspace is created for them and their team based on their selected package. Here, they can add team members and their relevant details. Details of the team members can include their names, email addresses, phone numbers, and all other work details. Once the team members are added, they are forwarded and invited to become part of the team on the platform. This way, your entire team can come together in one place.&lt;/span&gt;&lt;/p&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;span style=&#34;font-family:Arial;color:#000033;font-size:small;&#34;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;span style=&#34;font-family:Arial;color:#000033;font-size:small;&#34;&gt;Next, we ensure secure login so that the independent accounts of everyone are completely safe. Now, from the dashboard of 360HRIS, you can add all the information such as financial dealings, salary, and other information regarding the employees to their profiles. Also, multiple add-ons are available as well to enhance the functionality of the platform.&lt;/span&gt;&lt;/p&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;span style=&#34;font-family:Arial;color:#000033;font-size:small;&#34;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;span style=&#34;font-family:Arial;color:#000033;font-size:small;&#34;&gt;Similarly, all modules are easily accessible and can be automated as well. For example, enter the date when your employees have to be paid. The system will automatically calculate their salaries on those dates based on the earning information you have entered beforehand.&lt;/span&gt;&lt;/p&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;span style=&#34;font-family:Arial;color:#000033;font-size:small;&#34;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;span style=&#34;font-family:Arial;color:#000033;font-size:small;&#34;&gt;Additionally, on the portal, you can access analytical reports such as employees paid and unpaid time on the job that they have logged on to the system. Similarly, attendance policies can be set in advance, which the employees can view through their self-service portals.&lt;/span&gt;&lt;/p&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;span style=&#34;font-family:Arial;color:#000033;font-size:small;&#34;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;span style=&#34;font-family:Arial;color:#000033;font-size:small;&#34;&gt;Furthermore, two different portals are offered for the team members. The first is the employee self-service portal used by employees to receive important employment information and review their policies. They can also collaborate on the platform and create ownership of different aspects of their works. Similarly, there is a Management Self Service portal where the team manager will manage the teams, track their performance information, and use advanced analytics to make business decisions.&lt;/span&gt;&lt;/p&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;span style=&#34;font-family:Arial;color:#000033;font-size:small;&#34;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;span style=&#34;font-family:Arial;color:#000033;font-size:small;&#34;&gt;If you have a stable internet connection in your area, you can use the cloud-based model of the solution. This way, the solution can be accessed from anywhere in the world, with all your information completely safe and intact. On the other hand, you may opt for the offline module with the same features if you are more comfortable using it. Another aspect that must be considered is the budget and requirements of the business. Some businesses are small-scale and may require an offline solution only. Other large-scale businesses may have employees spread out in different locations, increasing the need for online, cloud-based solutions.&lt;/span&gt;&lt;/p&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;span style=&#34;font-family:Arial;color:#000033;font-size:small;&#34;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;span style=&#34;font-family:Arial;color:#000033;font-size:small;&#34;&gt;You can set clear goals for your employees and offer them appraisals for their performance using the platform. Such a system ensures higher productivity and an organizational culture where everyone is fully connected.&lt;/span&gt;&lt;/p&gt;&lt;p style=&#34;margin-bottom:0cm;line-height:normal;background:white;&#34;&gt;&lt;span style=&#34;font-family:Arial;color:#000033;font-size:small;&#34;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;', 1),
(8, 'Disclaimers', 'footer', '&lt;span style=&#34;font-family:Arial;&#34;&gt;&lt;/span&gt;&lt;p dir=&#34;ltr&#34; style=&#34;box-sizing:border-box;margin-top:0pt;margin-bottom:0pt;padding:0px;transition:all 0.3s ease-out 0s;font-family:&#39;Open Sans&#39;, sans-serif;font-size:15px;color:#6c6a8a;line-height:1.2;background-color:#ffffff;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;color:#000033;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;font-family:Arial;&#34;&gt;360HRIS tries its best to deliver the best functionality as offered originally in our services. However, due to software and platform changes, functionalities and offers can change with time. Therefore, under any circumstances, all users must be aware of the following disclaimer:&lt;/span&gt;&lt;/p&gt;&lt;ul style=&#34;box-sizing:border-box;margin:0px;padding:0px;color:#6c6a8a;font-family:&#39;Open Sans&#39;, sans-serif;font-size:15px;background-color:#ffffff;padding-inline-start:48px;&#34;&gt;&lt;li dir=&#34;ltr&#34; aria-level=&#34;1&#34; style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;list-style:disc;font-size:12pt;font-family:&#39;Times New Roman&#39;;color:#0e101a;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre;&#34;&gt;&lt;p dir=&#34;ltr&#34; role=&#34;presentation&#34; style=&#34;box-sizing:border-box;margin-top:0pt;margin-bottom:0pt;padding:0px;transition:all 0.3s ease-out 0s;font-family:&#39;Open Sans&#39;, sans-serif;font-size:15px;color:#6c6a8a;line-height:1.2;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;color:#000033;font-family:Arial;&#34;&gt;Functions can change on the platform at any time, without prior notice.&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;&lt;li dir=&#34;ltr&#34; aria-level=&#34;1&#34; style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;list-style:disc;font-size:12pt;font-family:&#39;Times New Roman&#39;;color:#0e101a;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre;&#34;&gt;&lt;p dir=&#34;ltr&#34; role=&#34;presentation&#34; style=&#34;box-sizing:border-box;margin-top:0pt;margin-bottom:0pt;padding:0px;transition:all 0.3s ease-out 0s;font-family:&#39;Open Sans&#39;, sans-serif;font-size:15px;color:#6c6a8a;line-height:1.2;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;color:#000033;font-family:Arial;&#34;&gt;We may adjust our services to reflect new platform changes at any time.&lt;/span&gt;&lt;/p&gt;&lt;p dir=&#34;ltr&#34; role=&#34;presentation&#34; style=&#34;box-sizing:border-box;margin-top:0pt;margin-bottom:0pt;padding:0px;transition:all 0.3s ease-out 0s;font-family:&#39;Open Sans&#39;, sans-serif;font-size:15px;color:#6c6a8a;line-height:1.2;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;color:#000033;font-family:Arial;&#34;&gt;&lt;/span&gt;&lt;span style=&#34;color:#000033;font-size:12pt;white-space:pre-wrap;font-family:Arial;&#34;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p dir=&#34;ltr&#34; style=&#34;box-sizing:border-box;margin-top:0pt;margin-bottom:0pt;padding:0px;transition:all 0.3s ease-out 0s;font-family:&#39;Open Sans&#39;, sans-serif;font-size:15px;color:#6c6a8a;line-height:1.2;background-color:#ffffff;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;color:#000033;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;font-family:Arial;&#34;&gt;Similarly, any glitch in the platform can cause data issues as well. Therefore, it is recommended that you always keep separate backups of the data available.&lt;/span&gt;&lt;/p&gt;&lt;ul style=&#34;box-sizing:border-box;margin:0px;padding:0px;color:#6c6a8a;font-family:&#39;Open Sans&#39;, sans-serif;font-size:15px;background-color:#ffffff;padding-inline-start:48px;&#34;&gt;&lt;li dir=&#34;ltr&#34; aria-level=&#34;1&#34; style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;list-style:disc;font-size:12pt;font-family:&#39;Times New Roman&#39;;color:#0e101a;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre;&#34;&gt;&lt;p dir=&#34;ltr&#34; role=&#34;presentation&#34; style=&#34;box-sizing:border-box;margin-top:0pt;margin-bottom:0pt;padding:0px;transition:all 0.3s ease-out 0s;font-family:&#39;Open Sans&#39;, sans-serif;font-size:15px;color:#6c6a8a;line-height:1.2;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;color:#000033;font-family:Arial;&#34;&gt;Data protection is ensured as much as possible. However, online platforms are always vulnerable to a breach. In case of a violation of data, &lt;/span&gt;&lt;span style=&#34;color:#000033;font-family:Arial;font-size:16px;white-space:pre-wrap;background-color:#ffffff;&#34;&gt;360HRIS&lt;/span&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;color:#000033;font-family:Arial;&#34;&gt; and its developers shall not be liable.&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;&lt;li dir=&#34;ltr&#34; aria-level=&#34;1&#34; style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;list-style:disc;font-size:12pt;font-family:&#39;Times New Roman&#39;;color:#0e101a;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre;&#34;&gt;&lt;p dir=&#34;ltr&#34; role=&#34;presentation&#34; style=&#34;box-sizing:border-box;margin-top:0pt;margin-bottom:0pt;padding:0px;transition:all 0.3s ease-out 0s;font-family:&#39;Open Sans&#39;, sans-serif;font-size:15px;color:#6c6a8a;line-height:1.2;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;color:#000033;font-family:Arial;&#34;&gt;Platform coding issues may cause differences in the attendance tracking, request approval, HRMS, onboard experience, and workmates system offered on the platform. It is advised to keep a manual record side by side as well.&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;&lt;li dir=&#34;ltr&#34; aria-level=&#34;1&#34; style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;list-style:disc;font-size:12pt;font-family:&#39;Times New Roman&#39;;color:#0e101a;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre;&#34;&gt;&lt;p dir=&#34;ltr&#34; role=&#34;presentation&#34; style=&#34;box-sizing:border-box;margin-top:0pt;margin-bottom:0pt;padding:0px;transition:all 0.3s ease-out 0s;font-family:&#39;Open Sans&#39;, sans-serif;font-size:15px;color:#6c6a8a;line-height:1.2;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;color:#000033;font-family:Arial;&#34;&gt;Server downtime and other maintenance requirements may make the platform inaccessible for varying lengths. In such a case, no compensation will be provided during the downtime.&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;&lt;li dir=&#34;ltr&#34; aria-level=&#34;1&#34; style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;list-style:disc;font-size:12pt;font-family:&#39;Times New Roman&#39;;color:#0e101a;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre;&#34;&gt;&lt;p dir=&#34;ltr&#34; role=&#34;presentation&#34; style=&#34;box-sizing:border-box;margin-top:0pt;margin-bottom:0pt;padding:0px;transition:all 0.3s ease-out 0s;font-family:&#39;Open Sans&#39;, sans-serif;font-size:15px;color:#6c6a8a;line-height:1.2;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;color:#000033;font-family:Arial;&#34;&gt;Tracking systems may change, including the analytical platforms, requiring a change in usage methods without previous communication.&lt;/span&gt;&lt;/p&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p dir=&#34;ltr&#34; style=&#34;box-sizing:border-box;margin-top:0pt;margin-bottom:0pt;padding:0px;transition:all 0.3s ease-out 0s;font-family:&#39;Open Sans&#39;, sans-serif;font-size:15px;color:#6c6a8a;line-height:1.2;background-color:#ffffff;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;color:#000033;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;font-family:Arial;&#34;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;p dir=&#34;ltr&#34; style=&#34;box-sizing:border-box;margin-top:0pt;margin-bottom:0pt;padding:0px;transition:all 0.3s ease-out 0s;font-family:&#39;Open Sans&#39;, sans-serif;font-size:15px;color:#6c6a8a;line-height:1.2;background-color:#ffffff;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;color:#000033;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;font-family:Arial;&#34;&gt;Furthermore, &lt;/span&gt;&lt;span style=&#34;color:#000033;font-family:Arial;font-size:16px;white-space:pre-wrap;background-color:#ffffff;&#34;&gt;360HRIS&lt;/span&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;color:#000033;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;font-family:Arial;&#34;&gt; does not assume responsibility for the actions of any employee or user on the platform. Using the platform places everyone to maintain moral standards and ethical directives of normal social conduct. In case of any breach, we may or may not take action against the accused.&lt;/span&gt;&lt;/p&gt;&lt;p dir=&#34;ltr&#34; style=&#34;box-sizing:border-box;margin-top:0pt;margin-bottom:0pt;padding:0px;transition:all 0.3s ease-out 0s;font-family:&#39;Open Sans&#39;, sans-serif;font-size:15px;color:#6c6a8a;line-height:1.2;background-color:#ffffff;&#34;&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;color:#000033;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;font-family:Arial;&#34;&gt;Use the platform safely and help others use it safely as well!&lt;/span&gt;&lt;/p&gt;&lt;div&gt;&lt;span style=&#34;box-sizing:border-box;margin:0px;padding:0px;transition:all 0.3s ease-out 0s;font-size:12pt;color:#000033;font-variant-numeric:normal;font-variant-east-asian:normal;vertical-align:baseline;white-space:pre-wrap;&#34;&gt;&lt;br /&gt;&lt;/span&gt;&lt;/div&gt;', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_company_membership`
--

CREATE TABLE `ci_company_membership` (
  `company_membership_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `membership_id` int(11) NOT NULL,
  `subscription_type` varchar(25) NOT NULL,
  `update_at` varchar(100) DEFAULT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_company_membership`
--

INSERT INTO `ci_company_membership` (`company_membership_id`, `company_id`, `membership_id`, `subscription_type`, `update_at`, `created_at`) VALUES
(2, 12, 1, '1', '18-05-2021 01:59:05', '16-05-2021 04:25:57'),
(9, 23, 1, '1', '22-11-2021 11:20:01', '22-11-2021 11:20:01'),
(10, 24, 1, '1', '23-12-2021 01:38:56', '23-11-2021 10:09:31');

-- --------------------------------------------------------

--
-- Table structure for table `ci_company_tickets`
--

CREATE TABLE `ci_company_tickets` (
  `ticket_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `ticket_code` varchar(200) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `ticket_priority` varchar(255) NOT NULL,
  `category_id` int(111) NOT NULL,
  `description` mediumtext NOT NULL,
  `ticket_remarks` mediumtext DEFAULT NULL,
  `ticket_status` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_company_tickets`
--

INSERT INTO `ci_company_tickets` (`ticket_id`, `company_id`, `ticket_code`, `subject`, `ticket_priority`, `category_id`, `description`, `ticket_remarks`, `ticket_status`, `created_by`, `created_at`) VALUES
(2, 2, '32oEJI', 'Finance module issues', '3', 0, 'We have an issue with finance module, please check', 'Thank you', '2', 2, '05-08-2021 05:07:22'),
(3, 24, 'wlIKOJ', 'Test', '1', 0, 'Test - Company', '', '1', 24, '05-01-2022 05:18:27'),
(4, 26, '9Kkq2k', 'Ticket Test', '3', 0, 'Ticket Test to super admin', '', '1', 26, '06-01-2022 10:22:55'),
(5, 26, 'K1L33I', 'Testing super admin', '3', 0, 'Testing super admin', '', '1', 26, '06-01-2022 12:10:08');

-- --------------------------------------------------------

--
-- Table structure for table `ci_company_tickets_reply`
--

CREATE TABLE `ci_company_tickets_reply` (
  `ticket_reply_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `ticket_id` int(111) NOT NULL,
  `sent_by` int(11) NOT NULL,
  `assign_to` int(11) NOT NULL,
  `reply_text` text DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_company_tickets_reply`
--

INSERT INTO `ci_company_tickets_reply` (`ticket_reply_id`, `company_id`, `ticket_id`, `sent_by`, `assign_to`, `reply_text`, `created_at`) VALUES
(1, 1, 1, 1, 1, 'We have an issue with Employee module', '05-08-2021 03:01:57'),
(2, 2, 2, 2, 2, 'We have an issue with finance module, please check', '05-08-2021 05:07:22'),
(3, 2, 2, 2, 2, 'There?', '05-08-2021 05:10:11'),
(4, 1, 2, 1, 2, 'The issue has been fixed.', '05-08-2021 03:10:26'),
(5, 24, 3, 24, 24, 'Test - Company', '05-01-2022 05:18:27'),
(6, 26, 4, 26, 26, 'Ticket Test to super admin', '06-01-2022 10:22:55'),
(7, 26, 5, 26, 26, 'Testing super admin', '06-01-2022 12:10:08');

-- --------------------------------------------------------

--
-- Table structure for table `ci_complaints`
--

CREATE TABLE `ci_complaints` (
  `complaint_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `complaint_from` int(111) NOT NULL,
  `title` varchar(255) NOT NULL,
  `complaint_date` varchar(255) NOT NULL,
  `complaint_against` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `status` tinyint(2) NOT NULL,
  `notify_send_to` text DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_contract_options`
--

CREATE TABLE `ci_contract_options` (
  `contract_option_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `salay_type` varchar(200) DEFAULT NULL,
  `contract_tax_option` int(11) NOT NULL,
  `is_fixed` int(11) NOT NULL,
  `option_title` varchar(200) DEFAULT NULL,
  `contract_amount` decimal(65,2) DEFAULT 0.00
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_contract_options`
--

INSERT INTO `ci_contract_options` (`contract_option_id`, `user_id`, `salay_type`, `contract_tax_option`, `is_fixed`, `option_title`, `contract_amount`) VALUES
(1, 3, 'allowances', 1, 1, 'Dearness Allowance', '150.00'),
(2, 3, 'allowances', 1, 1, 'Conveyance Allowance', '100.00'),
(3, 3, 'allowances', 1, 1, 'Medical Allowance', '50.00'),
(4, 3, 'statutory', 0, 1, 'Provident Fund', '20.00'),
(5, 3, 'statutory', 0, 1, 'Professional Tax', '50.00'),
(6, 3, 'commissions', 1, 1, 'Sales Target', '50.00'),
(7, 3, 'other_payments', 1, 1, 'Hospitalization', '80.00'),
(8, 3, 'other_payments', 1, 1, 'Travelling', '50.00');

-- --------------------------------------------------------

--
-- Table structure for table `ci_countries`
--

CREATE TABLE `ci_countries` (
  `country_id` int(11) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `country_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_countries`
--

INSERT INTO `ci_countries` (`country_id`, `country_code`, `country_name`) VALUES
(1, '+93', 'Afghanistan'),
(2, '+355', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'ES', 'Spain'),
(203, 'LK', 'Sri Lanka'),
(204, 'SH', 'St. Helena'),
(205, 'PM', 'St. Pierre and Miquelon'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania, United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TG', 'Togo'),
(218, 'TK', 'Tokelau'),
(219, 'TO', 'Tonga'),
(220, 'TT', 'Trinidad and Tobago'),
(221, 'TN', 'Tunisia'),
(222, 'TR', 'Turkey'),
(223, 'TM', 'Turkmenistan'),
(224, 'TC', 'Turks and Caicos Islands'),
(225, 'TV', 'Tuvalu'),
(226, 'UG', 'Uganda'),
(227, 'UA', 'Ukraine'),
(228, 'AE', 'United Arab Emirates'),
(229, 'GB', 'United Kingdom'),
(230, 'US', 'United States'),
(231, 'UM', 'United States minor outlying islands'),
(232, 'UY', 'Uruguay'),
(233, 'UZ', 'Uzbekistan'),
(234, 'VU', 'Vanuatu'),
(235, 'VA', 'Vatican City State'),
(236, 'VE', 'Venezuela'),
(237, 'VN', 'Vietnam'),
(238, 'VG', 'Virgin Islands (British)'),
(239, 'VI', 'Virgin Islands (U.S.)'),
(240, 'WF', 'Wallis and Futuna Islands'),
(241, 'EH', 'Western Sahara'),
(242, 'YE', 'Yemen'),
(243, 'ZR', 'Zaire'),
(244, 'ZM', 'Zambia'),
(245, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `ci_currencies`
--

CREATE TABLE `ci_currencies` (
  `currency_id` int(11) NOT NULL,
  `country_name` varchar(150) NOT NULL,
  `currency_name` varchar(20) NOT NULL,
  `currency_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_currencies`
--

INSERT INTO `ci_currencies` (`currency_id`, `country_name`, `currency_name`, `currency_code`) VALUES
(1, 'Afghanistan', 'Afghan afghani', 'AFN'),
(2, 'Albania', 'Albanian lek', 'ALL'),
(3, 'Algeria', 'Algerian dinar', 'DZD'),
(6, 'Angola', 'Angolan kwanza', 'AOA'),
(10, 'Argentina', 'Argentine peso', 'ARS'),
(11, 'Armenia', 'Armenian dram', 'AMD'),
(12, 'Aruba', 'Aruban florin', 'AWG'),
(13, 'Australia', 'Australian dollar', 'AUD'),
(15, 'Azerbaijan', 'Azerbaijani manat', 'AZN'),
(16, 'Bahamas', 'Bahamian dollar', 'BSD'),
(17, 'Bahrain', 'Bahraini dinar', 'BHD'),
(18, 'Bangladesh', 'Bangladeshi taka', 'BDT'),
(19, 'Barbados', 'Barbadian dollar', 'BBD'),
(20, 'Belarus', 'Belarusian ruble', 'BYR'),
(22, 'Belize', 'Belize dollar', 'BZD'),
(24, 'Bermuda', 'Bermudian dollar', 'BMD'),
(25, 'Bhutan', 'Bhutanese ngultrum', 'BTN'),
(26, 'Bolivia', 'Bolivian boliviano', 'BOB'),
(27, 'Bosnia and Herzegovina', 'Bosnia and Herzegovi', 'BAM'),
(30, 'Brazil', 'Brazilian real', 'BRL'),
(33, 'Bulgaria', 'Bulgarian lev', 'BGN'),
(35, 'Burundi', 'Burundian franc', 'BIF'),
(36, 'Cambodia', 'Cambodian riel', 'KHR'),
(38, 'Canada', 'Canadian dollar', 'CAD'),
(39, 'Cape Verde', 'Cape Verdean escudo', 'CVE'),
(40, 'Cayman Islands', 'Cayman Islands dolla', 'KYD'),
(43, 'Chile', 'Chilean peso', 'CLP'),
(44, 'China', 'Chinese yuan', 'CNY'),
(47, 'Colombia', 'Colombian peso', 'COP'),
(48, 'Comoros', 'Comorian franc', 'KMF'),
(49, 'Congo', 'Congolese franc', 'CDF'),
(52, 'Costa Rica', 'Costa Rican', 'CRC'),
(54, 'Croatia (Hrvatska)', 'Croatian kuna', 'HRK'),
(55, 'Cuba', 'Cuban convertible pe', 'CUC'),
(57, 'Czech Republic', 'Czech koruna', 'CZK'),
(58, 'Denmark', 'Danish krone', 'DKK'),
(59, 'Djibouti', 'Djiboutian franc', 'DJF'),
(60, 'Dominica', 'East Caribbean dolla', 'XCD'),
(61, 'Dominican Republic', 'Dominican peso', 'DOP'),
(64, 'Egypt', 'Egyptian pound', 'EGP'),
(67, 'Eritrea', 'Eritrean nakfa', 'ERN'),
(69, 'Ethiopia', 'Ethiopian birr', 'ETB'),
(71, 'Falkland Islands', 'Falkland Islands pou', 'FKP'),
(73, 'Fiji Islands', 'Fiji Dollars', 'FJD'),
(79, 'Gabon', 'Central African CFA ', 'XAF'),
(80, 'Gambia The', 'Gambian dalasi', 'GMD'),
(81, 'Georgia', 'Georgian lari', 'GEL'),
(83, 'Ghana', 'Ghana cedi', 'GHS'),
(84, 'Gibraltar', 'Gibraltar pound', 'GIP'),
(90, 'Guatemala', 'Guatemalan quetzal', 'GTQ'),
(92, 'Guinea', 'Guinean franc', 'GNF'),
(94, 'Guyana', 'Guyanese dollar', 'GYD'),
(95, 'Haiti', 'Haitian gourde', 'HTG'),
(97, 'Honduras', 'Honduran lempira', 'HNL'),
(98, 'Hong Kong S.A.R.', 'Hong Kong dollar', 'HKD'),
(99, 'Hungary', 'Hungarian forint', 'HUF'),
(100, 'Iceland', 'Icelandic króna\n', 'ISK'),
(101, 'India', 'Indian rupee', 'INR'),
(102, 'Indonesia', 'Indonesian rupiah', 'IDR'),
(103, 'Iran', 'Iranian rial', 'IRR'),
(104, 'Iraq', 'Iraqi dinar', 'IQD'),
(106, 'Israel', 'Israeli new shekel', 'ILS'),
(108, 'Jamaica', 'Jamaican dollar', 'JMD'),
(109, 'Japan', 'Japanese yen', 'JPY'),
(111, 'Jordan', 'Jordanian dinar', 'JOD'),
(112, 'Kazakhstan', 'Kazakhstani tenge', 'KZT'),
(113, 'Kenya', 'Kenyan shilling', 'KES'),
(115, 'Korea North', 'North Korean won', 'KPW'),
(116, 'Korea South', 'Korea (South) Won', 'KRW'),
(117, 'Kuwait', 'Kuwaiti dinar', 'KWD'),
(118, 'Kyrgyzstan', 'Kyrgyzstani som', 'KGS'),
(119, 'Laos', 'Lao kip', 'LAK'),
(121, 'Lebanon', 'Lebanese pound', 'LBP'),
(122, 'Lesotho', 'Lesotho loti', 'LSL'),
(123, 'Liberia', 'Liberian dollar', 'LRD'),
(124, 'Libya', 'Libyan dinar', 'LYD'),
(128, 'Macau S.A.R.', 'Macanese pataca', 'MOP'),
(129, 'Macedonia', 'Macedonian denar', 'MKD'),
(130, 'Madagascar', 'Malagasy ariary', 'MGA'),
(131, 'Malawi', 'Malawian kwacha', 'MWK'),
(132, 'Malaysia', 'Malaysian ringgit', 'MYR'),
(133, 'Maldives', 'Maldivian rufiyaa', 'MVR'),
(134, 'Mali', 'West African CFA fra', 'XOF'),
(136, 'Man (Isle of)', 'Manx pound', 'IMP'),
(139, 'Mauritania', 'Mauritanian ouguiya', 'MRO'),
(140, 'Mauritius', 'Mauritian rupee', 'MUR'),
(142, 'Mexico', 'Mexican peso', 'MXN'),
(144, 'Moldova', 'Moldovan leu', 'MDL'),
(146, 'Mongolia', 'Mongolian tögrög', 'MNT'),
(148, 'Morocco', 'Moroccan dirham', 'MAD'),
(149, 'Mozambique', 'Mozambican metical', 'MZN'),
(150, 'Myanmar', 'Burmese kyat', 'MMK'),
(151, 'Namibia', 'Namibian dollar', 'NAD'),
(153, 'Nepal', 'Nepalese rupee', 'NPR'),
(154, 'Netherlands Antilles', 'Dutch Guilder', 'ANG'),
(157, 'New Zealand', 'New Zealand dollar', 'NZD'),
(158, 'Nicaragua', 'Nicaraguan córdoba', 'NIO'),
(160, 'Nigeria', 'Nigerian naira', 'NGN'),
(164, 'Norway', 'Norwegian krone', 'NOK'),
(165, 'Oman', 'Omani rial', 'OMR'),
(166, 'Pakistan', 'Pakistani rupee', 'PKR'),
(169, 'Panama', 'Panamanian balboa', 'PAB'),
(170, 'Papua new Guinea', 'Papua New Guinean ki', 'PGK'),
(171, 'Paraguay', 'Paraguayan guaraní\n', 'PYG'),
(172, 'Peru', 'Peruvian nuevo sol', 'PEN'),
(173, 'Philippines', 'Philippine peso', 'PHP'),
(175, 'Poland', 'Polish z?oty\n', 'PLN'),
(178, 'Qatar', 'Qatari riyal', 'QAR'),
(180, 'Romania', 'Romanian leu', 'RON'),
(181, 'Russia', 'Russian ruble', 'RUB'),
(182, 'Rwanda', 'Rwandan franc', 'RWF'),
(183, 'Saint Helena', 'Saint Helena pound', 'SHP'),
(188, 'Samoa', 'Samoan t?l?\n', 'WST'),
(191, 'Saudi Arabia', 'Saudi riyal', 'SAR'),
(193, 'Serbia', 'Serbian dinar', 'RSD'),
(194, 'Seychelles', 'Seychellois rupee', 'SCR'),
(195, 'Sierra Leone', 'Sierra Leonean leone', 'SLL'),
(196, 'Singapore', 'Singapore dollar\n', 'SGD'),
(200, 'Solomon Islands', 'Solomon Islands doll', 'SBD'),
(201, 'Somalia', 'Somali shilling', 'SOS'),
(202, 'South Africa', 'South African rand', 'ZAR'),
(204, 'South Sudan', 'South Sudanese pound', 'SSP'),
(205, 'Spain', 'Euro', 'EUR'),
(206, 'Sri Lanka', 'Sri Lankan rupee', 'LKR'),
(207, 'Sudan', 'Sudanese pound', 'SDG'),
(208, 'Suriname', 'Surinamese dollar', 'SRD'),
(210, 'Swaziland', 'Swazi lilangeni', 'SZL'),
(211, 'Sweden', 'Swedish krona', 'SEK'),
(212, 'Switzerland', 'Swiss franc', 'CHF'),
(213, 'Syria', 'Syrian pound', 'SYP'),
(214, 'Taiwan', 'New Taiwan dollar', 'TWD'),
(215, 'Tajikistan', 'Tajikistani somoni', 'TJS'),
(216, 'Tanzania', 'Tanzanian shilling', 'TZS'),
(217, 'Thailand', 'Thai baht', 'THB'),
(220, 'Tonga', 'Tongan pa?anga\n', 'TOP'),
(221, 'Trinidad And Tobago', 'Trinidad and Tobago ', 'TTD'),
(222, 'Tunisia', 'Tunisian dinar', 'TND'),
(223, 'Turkey', 'Turkish lira', 'TRY'),
(224, 'Turkmenistan', 'Turkmenistan manat', 'TMT'),
(227, 'Uganda', 'Ugandan shilling', 'UGX'),
(228, 'Ukraine', 'Ukrainian hryvnia', 'UAH'),
(229, 'United Arab Emirates', 'United Arab Emirates', 'AED'),
(230, 'United Kingdom', 'British pound', 'GBP'),
(231, 'United States', 'United States Dollar', 'USD'),
(233, 'Uruguay', 'Uruguayan peso', 'UYU'),
(234, 'Uzbekistan', 'Uzbekistani som', 'UZS'),
(235, 'Vanuatu', 'Vanuatu vatu', 'VUV'),
(237, 'Venezuela', 'Venezuelan bolívar\n', 'VEF'),
(238, 'Vietnam', 'Vietnamese dong\n', 'VND'),
(241, 'Wallis And Futuna Islands', 'CFP franc', 'XPF'),
(243, 'Yemen', 'Yemeni rial', 'YER'),
(244, 'Yugoslavia', 'Yugoslav dinar', 'YUM'),
(245, 'Zambia', 'Zambian kwacha', 'ZMW'),
(246, 'Zimbabwe', 'Botswana pula', 'BWP');

-- --------------------------------------------------------

--
-- Table structure for table `ci_database_backup`
--

CREATE TABLE `ci_database_backup` (
  `backup_id` int(111) NOT NULL,
  `backup_file` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_departments`
--

CREATE TABLE `ci_departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(200) NOT NULL,
  `company_id` int(11) NOT NULL,
  `department_head` int(11) DEFAULT 0,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_departments`
--

INSERT INTO `ci_departments` (`department_id`, `department_name`, `company_id`, `department_head`, `added_by`, `created_at`) VALUES
(1, 'Engineering', 2, 4, 2, '15-05-2021 05:20:49'),
(2, 'Training', 2, 0, 2, '15-05-2021 05:21:04'),
(3, 'Human Resources', 2, 5, 2, '15-05-2021 05:21:48'),
(4, 'Finance', 2, 0, 2, '15-05-2021 05:21:50'),
(5, 'Marketing', 2, 0, 2, '15-05-2021 05:22:08'),
(6, 'Sales', 2, 0, 2, '16-05-2021 10:24:16'),
(7, 'Finance', 24, 0, 24, '23-11-2021 09:26:32'),
(8, 'IT', 24, 0, 24, '23-11-2021 09:26:45'),
(9, 'Human Resources', 24, 0, 24, '23-11-2021 09:26:53'),
(10, 'Administration', 24, 0, 24, '23-11-2021 09:27:01');

-- --------------------------------------------------------

--
-- Table structure for table `ci_designations`
--

CREATE TABLE `ci_designations` (
  `designation_id` int(11) NOT NULL,
  `department_id` int(200) NOT NULL,
  `company_id` int(11) NOT NULL,
  `designation_name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_designations`
--

INSERT INTO `ci_designations` (`designation_id`, `department_id`, `company_id`, `designation_name`, `description`, `created_at`) VALUES
(1, 1, 2, 'Project Manager', 'Project Manager', '15-05-2021 05:26:52'),
(2, 1, 2, 'Head Engineering', 'Head Engineering', '15-05-2021 05:27:03'),
(3, 1, 2, 'Software Engineer', 'Software Engineer', '15-05-2021 05:27:15'),
(4, 2, 2, 'General Manager', 'General Manager', '15-05-2021 05:27:36'),
(5, 2, 2, 'Training Head', 'Training Head', '15-05-2021 05:27:46'),
(6, 2, 2, 'Senior Manager', 'Senior Manager', '15-05-2021 05:28:04'),
(7, 3, 2, 'HR Manager', 'HR Manager', '15-05-2021 05:28:26'),
(8, 4, 2, 'Manager', 'Manager', '15-05-2021 05:28:44'),
(9, 5, 2, 'Marketing Manager', 'Marketing Manager', '15-05-2021 05:29:12'),
(10, 5, 2, 'General Manager', 'General Manager', '15-05-2021 05:30:07'),
(11, 9, 24, 'HR Manager', '', '23-11-2021 09:27:20'),
(12, 9, 24, 'HR Assistant 1', '', '23-11-2021 09:27:39'),
(13, 9, 24, 'HR Assistant 2', '', '23-11-2021 09:28:00'),
(14, 9, 24, 'Generalist', '', '23-11-2021 09:28:13'),
(15, 8, 24, 'IT Manager', '', '23-11-2021 09:28:31'),
(16, 8, 24, 'Help Desk', '', '23-11-2021 09:28:38'),
(17, 7, 24, 'Finance Manager', '', '23-11-2021 09:29:22'),
(18, 7, 24, 'Finance Clerk 1', '', '23-11-2021 09:29:49'),
(19, 10, 24, 'Office Manager', '', '23-11-2021 09:30:37'),
(20, 10, 24, 'Administrative Assistant', '', '23-11-2021 09:30:51');

-- --------------------------------------------------------

--
-- Table structure for table `ci_email_configuration`
--

CREATE TABLE `ci_email_configuration` (
  `email_config_id` int(11) NOT NULL,
  `email_type` enum('smtp','mailgun') COLLATE utf8_unicode_ci NOT NULL,
  `smtp_host` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_username` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_password` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_port` int(11) NOT NULL,
  `smtp_secure` enum('tls','ssl') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ci_email_configuration`
--

INSERT INTO `ci_email_configuration` (`email_config_id`, `email_type`, `smtp_host`, `smtp_username`, `smtp_password`, `smtp_port`, `smtp_secure`) VALUES
(1, 'smtp', 'mail.360hris.com', 'admin@360hris.com', 'Hris2525!', 465, 'tls');

-- --------------------------------------------------------

--
-- Table structure for table `ci_email_template`
--

CREATE TABLE `ci_email_template` (
  `template_id` int(111) NOT NULL,
  `template_code` varchar(255) NOT NULL,
  `template_type` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_email_template`
--

INSERT INTO `ci_email_template` (`template_id`, `template_code`, `template_type`, `name`, `subject`, `message`, `status`) VALUES
(1, 'code1', 'super_admin', 'Forgot Password', 'Forgot Password', '&lt;p&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Hi There,&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;There was recently a request for password for your {site_name} account.&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#4e5155;font-family:Roboto, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Oxygen, Ubuntu, Cantarell, \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif;font-size:14.304px;background-color:#ffffff;\"&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;To reset password, visit the following link&lt;/span&gt;&amp;nbsp;&lt;a href=\"{site_url}erp/verified-password?v={user_id}\" title=\"Reset Password\" target=\"_blank\"&gt;&lt;strong&gt;&lt;span style=\"forced-color-adjust:none;color:#6699cc;\"&gt;Reset Password&lt;/span&gt;&lt;/strong&gt;&lt;/a&gt;&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#4e5155;font-family:Roboto, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Oxygen, Ubuntu, Cantarell, \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif;font-size:14.304px;background-color:#ffffff;\"&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;If this was a mistake, just ignore this email and nothing will happen.&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#4e5155;font-family:Roboto, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Oxygen, Ubuntu, Cantarell, \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif;font-size:14.304px;background-color:#ffffff;\"&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;----&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;Thank You,&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;{site_name}&lt;/span&gt;&lt;/p&gt;', 1),
(2, 'code1', 'super_admin', 'Password Changed Successfully', 'Password Changed Successfully', '&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#4e5155;font-family:Roboto, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Oxygen, Ubuntu, Cantarell, \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif;font-size:14.304px;background-color:#ffffff;\"&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;Hi There,&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#4e5155;font-family:Roboto, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Oxygen, Ubuntu, Cantarell, \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif;font-size:14.304px;background-color:#ffffff;\"&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;Congratulations! Your password has been updated successfully.&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#4e5155;font-family:Roboto, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Oxygen, Ubuntu, Cantarell, \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif;font-size:14.304px;background-color:#ffffff;\"&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;Your Username is: {username}&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#4e5155;font-family:Roboto, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Oxygen, Ubuntu, Cantarell, \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif;font-size:14.304px;background-color:#ffffff;\"&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;Your new password is: {password}&lt;/span&gt;&lt;br /&gt;&lt;/p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;----&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Thank You,&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;{site_name}&lt;/span&gt;', 1),
(3, 'code1', 'super_admin', 'Add New Company | From Backend', 'Warm Welcome', '&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, &#39;Helvetica Neue&#39;, Arial, &#39;Noto Sans&#39;, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;span style=&#34;forced-color-adjust:none;box-sizing:border-box;&#34;&gt;Hello {user_name}&lt;/span&gt;,&lt;/p&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, &#39;Helvetica Neue&#39;, Arial, &#39;Noto Sans&#39;, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;Welcome to {site_name}. Your subscription plan is {plan_title}&lt;/p&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, &#39;Helvetica Neue&#39;, Arial, &#39;Noto Sans&#39;, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;We have listed your sign-in details below, please make sure you keep them safe.&lt;/p&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, &#39;Helvetica Neue&#39;, Arial, &#39;Noto Sans&#39;, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;Your Username is: {user_username}&lt;/p&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, &#39;Helvetica Neue&#39;, Arial, &#39;Noto Sans&#39;, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;Your Password is: {user_password}&lt;/p&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, &#39;Helvetica Neue&#39;, Arial, &#39;Noto Sans&#39;, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;a href=&#34;{site_url}erp/login&#34; title=&#34;Login Here&#34; target=&#34;_blank&#34;&gt;Login Here&lt;/a&gt;&lt;/p&gt;&lt;p class=&#34;mt-4&#34; style=&#34;margin-bottom:0px;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, &#39;Helvetica Neue&#39;, Arial, &#39;Noto Sans&#39;, sans-serif;font-size:14px;background-color:#ffffff;margin-top:1.5rem !important;&#34;&gt;----&lt;br style=&#34;box-sizing:border-box;&#34; /&gt;Thank You&lt;br style=&#34;box-sizing:border-box;&#34; /&gt;&lt;span style=&#34;forced-color-adjust:none;&#34;&gt;{site_name}&lt;/span&gt;&lt;/p&gt;', 1),
(4, 'code1', 'super_admin', 'Signup Company | From Frontend', 'Verify your email', '&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, &#39;Helvetica Neue&#39;, Arial, &#39;Noto Sans&#39;, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;span style=&#34;forced-color-adjust:none;box-sizing:border-box;&#34;&gt;Welcome {user_name}&lt;/span&gt;,&lt;/p&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, &#39;Helvetica Neue&#39;, Arial, &#39;Noto Sans&#39;, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;You are receiving this email because you have registered on our site.&lt;/p&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, &#39;Helvetica Neue&#39;, Arial, &#39;Noto Sans&#39;, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;Your Username is: {user_username}&lt;/p&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, &#39;Helvetica Neue&#39;, Arial, &#39;Noto Sans&#39;, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;Your Username is: {user_password}&lt;/p&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, &#39;Helvetica Neue&#39;, Arial, &#39;Noto Sans&#39;, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;Click the link below to active your {site_name} account as a Trial version.&lt;/p&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, &#39;Helvetica Neue&#39;, Arial, &#39;Noto Sans&#39;, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;span style=&#34;color:#8094ae;font-family:Roboto, sans-serif, &#39;Helvetica Neue&#39;, Arial, &#39;Noto Sans&#39;, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;Note: Above username and password will not work until you active your account.&lt;/span&gt;&lt;/p&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, &#39;Helvetica Neue&#39;, Arial, &#39;Noto Sans&#39;, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;a href=&#34;{site_url}confirm?v={user_id}&#34; title=&#34;Verify&#34; target=&#34;_blank&#34;&gt;Verify&lt;/a&gt;&lt;/p&gt;&lt;p class=&#34;mt-4&#34; style=&#34;margin-bottom:0px;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, &#39;Helvetica Neue&#39;, Arial, &#39;Noto Sans&#39;, sans-serif;font-size:14px;background-color:#ffffff;margin-top:1.5rem !important;&#34;&gt;----&lt;br style=&#34;box-sizing:border-box;&#34; /&gt;Thank You&lt;br style=&#34;box-sizing:border-box;&#34; /&gt;{site_name}&lt;/p&gt;', 1),
(5, 'code1', 'super_admin', 'Add New Employee|Client|SuperAdmin User', 'Warm Welcome', '&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;span style=\"forced-color-adjust:none;box-sizing:border-box;\"&gt;&lt;/span&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Hi There,&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Welcome to {site_name}. We have listed your sign-in details below, please make sure you keep them safe.&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Your Username is: {user_username}&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Your Password is: {user_password}&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;a href=\"{site_url}erp/login\" title=\"Login Here\" target=\"_blank\"&gt;Login Here&lt;/a&gt;&lt;/p&gt;&lt;p class=\"mt-4\" style=\"margin-bottom:0px;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;margin-top:1.5rem !important;\"&gt;----&lt;br style=\"box-sizing:border-box;\" /&gt;Thank You&lt;br style=\"box-sizing:border-box;\" /&gt;{site_name}&lt;/p&gt;', 1),
(6, 'code1', 'super_admin', 'Free trial over: upgrade/subscribe to continue', 'Free trial over', '&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;span style=\"forced-color-adjust:none;box-sizing:border-box;\"&gt;Hi There,&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Thanks for giving {site_name} a try!&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Your free trial has expired, but you can keep using {site_name} with a paid subscription.&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Login to {site_name} and upgrade your desired subscription plan.&lt;/p&gt;&lt;p class=\"mt-4\" style=\"margin-bottom:0px;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;margin-top:1.5rem !important;\"&gt;----&lt;br style=\"box-sizing:border-box;\" /&gt;Thank You&lt;br style=\"box-sizing:border-box;\" /&gt;{site_name}&lt;/p&gt;', 1),
(7, 'code1', 'super_admin', 'Paid Subscription expiring', 'Subscription expiring', '&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;span style=\"forced-color-adjust:none;box-sizing:border-box;\"&gt;Hello {user_name}&lt;/span&gt;,&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Your plan {plan_name} is coming to close in {total_days}.&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;You have still {total_days} left to try out our premium plans.&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;If you are not ready to upgrade now, that\'s okay too. You can upgrade the plan in future anytime.&lt;/p&gt;&lt;p class=\"mt-4\" style=\"margin-bottom:0px;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;margin-top:1.5rem !important;\"&gt;----&lt;br style=\"box-sizing:border-box;\" /&gt;Thank You&lt;br style=\"box-sizing:border-box;\" /&gt;{site_name}&lt;/p&gt;', 1),
(8, 'code1', 'super_admin', 'Contact Us | From Frontend', 'Contact Us', '&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;span style=\"forced-color-adjust:none;box-sizing:border-box;\"&gt;Hi There,&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;This email was sent through your support contact form on {site_name}.&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;/span&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Sender: {full_name}&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;Subject: {subject}&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;Email: {email}&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Message:&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;{message}&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;You can reply directly to this email to respond to {full_name}&lt;/p&gt;&lt;p class=\"mt-4\" style=\"margin-bottom:0px;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;margin-top:1.5rem !important;\"&gt;----&lt;br style=\"box-sizing:border-box;\" /&gt;Thank You&lt;br style=\"box-sizing:border-box;\" /&gt;{&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;site_name&lt;/span&gt;}&lt;/p&gt;', 1),
(9, 'code1', 'super_admin', 'New Project Assigned', 'New Project Assigned', '&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Hi There,&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;New project has been assigned to you.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Project Name: {project_name}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Project Due Date: {project_due_date}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;----&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;Thank You,&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;{site_name}&lt;/span&gt;&lt;/p&gt;', 1),
(10, 'code1', 'super_admin', 'New Task Assigned', 'New Task Assigned', '&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Hi There,&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;New task has been assigned to you.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Task Name: {task_name}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Task Due Date: {task_due_date}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;----&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;Thank You,&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;{site_name}&lt;/span&gt;&lt;/p&gt;', 1),
(11, 'code1', 'super_admin', 'New Award', 'Award Received', '&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Hi There,&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;You have been awarded with &lt;span style=\"text-decoration:underline;\"&gt;{award_name}&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;You can view this award by logging into the portal.&lt;/span&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;----&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;Thank You,&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;{site_name}&lt;/span&gt;&lt;/p&gt;', 1),
(12, 'code1', 'super_admin', 'New Ticket Inquiry', 'New Inquiry [#{ticket_code}]', '&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Hi There,&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;You have received a new inquiry&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Inquiry code: &lt;span style=\"text-decoration:underline;\"&gt;&lt;strong&gt;#{ticket_code}&lt;/strong&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;You can view this &lt;/span&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;inquiry&amp;nbsp;&lt;/span&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;by logging into the portal.&lt;/span&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;----&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;Thank You,&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;{site_name}&lt;/span&gt;&lt;/p&gt;', 1),
(13, 'code1', 'super_admin', 'New Leave Requested | For Company', 'New Leave Request', '&lt;p style=\"box-sizing:border-box;margin-bottom:1rem;color:#4e5155;font-family:Roboto, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Oxygen, Ubuntu, Cantarell, \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif;font-size:14.304px;background-color:#ffffff;\"&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Hi There,&lt;/span&gt;&lt;/p&gt;&lt;p style=\"box-sizing:border-box;margin-bottom:1rem;color:#4e5155;font-family:Roboto, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Oxygen, Ubuntu, Cantarell, \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif;font-size:14.304px;background-color:#ffffff;\"&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;span style=\"text-decoration:underline;\"&gt;&lt;strong&gt;{employee_name}&lt;/strong&gt;&lt;/span&gt; wants a leave &lt;strong&gt;&lt;span style=\"text-decoration:underline;\"&gt;{leave_type}&lt;/span&gt;&lt;/strong&gt; from you. You can view the leave details by logging into the portal.&lt;/span&gt;&lt;/p&gt;&lt;p style=\"box-sizing:border-box;margin-bottom:1rem;color:#4e5155;font-family:Roboto, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Oxygen, Ubuntu, Cantarell, \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif;font-size:14.304px;background-color:#ffffff;\"&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;----&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;Thank You,&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;{site_name}&lt;/span&gt;&lt;/p&gt;', 1),
(14, 'code1', 'super_admin', 'Leave Approved | For Employee', 'Your Leave Approved', '&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#4e5155;font-family:Roboto, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Oxygen, Ubuntu, Cantarell, \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif;font-size:14.304px;background-color:#ffffff;\"&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;Hi There,&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#4e5155;font-family:Roboto, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Oxygen, Ubuntu, Cantarell, \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif;font-size:14.304px;background-color:#ffffff;\"&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;Congratulations! Your leave &lt;strong&gt;&lt;span style=\"text-decoration:underline;\"&gt;{leave_type}&lt;/span&gt;&lt;/strong&gt; request from {start_date} to {end_date} has been approved by your company management.&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#4e5155;font-family:Roboto, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Oxygen, Ubuntu, Cantarell, \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif;font-size:14.304px;background-color:#ffffff;\"&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, Helvetica Neue, Arial, Noto Sans, sans-serif;\"&gt;&lt;span style=\"font-size:14px;\"&gt;Remarks:&lt;/span&gt;&lt;/span&gt;&lt;br style=\"font-style:normal;font-variant-ligatures:normal;font-variant-caps:normal;font-weight:400;letter-spacing:normal;orphans:2;text-align:start;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"font-style:normal;font-variant-ligatures:normal;font-variant-caps:normal;font-weight:400;letter-spacing:normal;orphans:2;text-align:start;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;{remarks}&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#4e5155;font-family:Roboto, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Oxygen, Ubuntu, Cantarell, \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif;font-size:14.304px;background-color:#ffffff;\"&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;You can view the leave details by logging into the portal.&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#4e5155;font-family:Roboto, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Oxygen, Ubuntu, Cantarell, \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif;font-size:14.304px;background-color:#ffffff;\"&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;----&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;Thank You,&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;{site_name}&lt;/span&gt;&lt;/p&gt;', 1),
(15, 'code1', 'super_admin', 'Leave Rejected | For Employee', 'Your Leave Rejected', '&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#4e5155;font-family:Roboto, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Oxygen, Ubuntu, Cantarell, \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif;font-size:14.304px;background-color:#ffffff;\"&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;Hi There,&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#4e5155;font-family:Roboto, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Oxygen, Ubuntu, Cantarell, \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif;font-size:14.304px;background-color:#ffffff;\"&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;Unfortunately! Your leave&amp;nbsp;&lt;strong&gt;&lt;span style=\"text-decoration-line:underline;\"&gt;{leave_type}&lt;/span&gt;&lt;/strong&gt;&amp;nbsp;request from {start_date} to {end_date} has been rejected by your company management.&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#4e5155;font-family:Roboto, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Oxygen, Ubuntu, Cantarell, \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif;font-size:14.304px;background-color:#ffffff;\"&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, Helvetica Neue, Arial, Noto Sans, sans-serif;\"&gt;&lt;span style=\"font-size:14px;\"&gt;Reject Reason:&lt;/span&gt;&lt;/span&gt;&lt;br style=\"font-style:normal;font-variant-ligatures:normal;font-variant-caps:normal;font-weight:400;letter-spacing:normal;orphans:2;text-align:start;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"font-style:normal;font-variant-ligatures:normal;font-variant-caps:normal;font-weight:400;letter-spacing:normal;orphans:2;text-align:start;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;-webkit-text-stroke-width:0px;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;{remarks}&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#4e5155;font-family:Roboto, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Oxygen, Ubuntu, Cantarell, \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif;font-size:14.304px;background-color:#ffffff;\"&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;You can view the leave details by logging into the portal.&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#4e5155;font-family:Roboto, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Oxygen, Ubuntu, Cantarell, \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif;font-size:14.304px;background-color:#ffffff;\"&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;----&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;Thank You,&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;{site_name}&lt;/span&gt;&lt;/p&gt;', 1),
(16, 'code1', 'super_admin', 'New Job Posted | For Employee', 'New Job Posted', '&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Hi There,&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;We would like to announce a new vacancy for a &lt;strong&gt;&lt;span style=\"text-decoration:underline;\"&gt;{job_title}&lt;/span&gt;&lt;/strong&gt;.&lt;/span&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Suitable applicants can send submit their resumes before &lt;span style=\"text-decoration:underline;\"&gt;&lt;strong&gt;{closing_date}&lt;/strong&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;You can view a complete job description by logging into the portal.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;----&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;Thank You,&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;{site_name}&lt;/span&gt;&lt;/p&gt;', 1),
(17, 'code1', 'super_admin', 'Payslip Created | For Employee', 'Salary Slip for {month_year}', '&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Hi There,&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;New Payslip is created for {month_year}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;You can view this payslip by logging into the portal.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;if you have any question, do not hesitate to contact your HR Department.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;----&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;Thank You,&lt;/span&gt;&lt;br style=\"color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;box-sizing:border-box;\" /&gt;&lt;span style=\"forced-color-adjust:none;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;\"&gt;{company_name}&lt;/span&gt;&lt;/p&gt;', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_employee_accounts`
--

CREATE TABLE `ci_employee_accounts` (
  `account_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `account_name` varchar(200) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_employee_accounts`
--

INSERT INTO `ci_employee_accounts` (`account_id`, `company_id`, `account_name`, `created_at`) VALUES
(3, 2, 'Bank of America', '21-10-2021 01:14:46'),
(4, 2, 'Bank of LA', '21-10-2021 05:35:25');

-- --------------------------------------------------------

--
-- Table structure for table `ci_employee_contacts`
--

CREATE TABLE `ci_employee_contacts` (
  `contact_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `relation` varchar(255) DEFAULT NULL,
  `is_primary` int(111) DEFAULT NULL,
  `is_dependent` int(111) DEFAULT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `work_phone` varchar(255) DEFAULT NULL,
  `work_phone_extension` varchar(255) DEFAULT NULL,
  `mobile_phone` varchar(255) DEFAULT NULL,
  `home_phone` varchar(255) DEFAULT NULL,
  `work_email` varchar(255) DEFAULT NULL,
  `personal_email` varchar(255) DEFAULT NULL,
  `address_1` mediumtext DEFAULT NULL,
  `address_2` mediumtext DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_employee_exit`
--

CREATE TABLE `ci_employee_exit` (
  `exit_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `exit_date` varchar(255) NOT NULL,
  `exit_type_id` int(111) NOT NULL,
  `exit_interview` int(111) NOT NULL,
  `is_inactivate_account` int(111) NOT NULL,
  `reason` mediumtext NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_erp_company_settings`
--

CREATE TABLE `ci_erp_company_settings` (
  `setting_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `default_currency` varchar(255) NOT NULL DEFAULT 'USD',
  `default_currency_symbol` varchar(100) NOT NULL DEFAULT 'USD',
  `notification_position` varchar(255) DEFAULT NULL,
  `notification_close_btn` varchar(255) DEFAULT NULL,
  `notification_bar` varchar(255) DEFAULT NULL,
  `date_format_xi` varchar(255) DEFAULT NULL,
  `default_language` varchar(200) NOT NULL DEFAULT 'en',
  `system_timezone` varchar(200) NOT NULL DEFAULT 'Asia/Bishkek',
  `enable_ip_address` int(11) NOT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `paypal_email` varchar(100) DEFAULT NULL,
  `paypal_sandbox` varchar(10) DEFAULT NULL,
  `paypal_active` varchar(10) DEFAULT NULL,
  `stripe_secret_key` varchar(200) DEFAULT NULL,
  `stripe_publishable_key` varchar(200) DEFAULT NULL,
  `stripe_active` varchar(10) DEFAULT NULL,
  `invoice_terms_condition` text DEFAULT NULL,
  `setup_modules` text DEFAULT NULL,
  `is_enable_ml_payroll` int(11) NOT NULL,
  `setup_languages` text DEFAULT NULL,
  `approval_levels` varchar(200) NOT NULL,
  `bank_account` varchar(255) DEFAULT NULL,
  `vat_number` varchar(255) DEFAULT NULL,
  `hrm_staff_dashboard` int(11) NOT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_erp_company_settings`
--

INSERT INTO `ci_erp_company_settings` (`setting_id`, `company_id`, `default_currency`, `default_currency_symbol`, `notification_position`, `notification_close_btn`, `notification_bar`, `date_format_xi`, `default_language`, `system_timezone`, `enable_ip_address`, `ip_address`, `paypal_email`, `paypal_sandbox`, `paypal_active`, `stripe_secret_key`, `stripe_publishable_key`, `stripe_active`, `invoice_terms_condition`, `setup_modules`, `is_enable_ml_payroll`, `setup_languages`, `approval_levels`, `bank_account`, `vat_number`, `hrm_staff_dashboard`, `updated_at`) VALUES
(1, 2, 'CAD', 'CAD', 'toast-top-center', '0', 'true', 'Y-m-d', 'en', 'America/Vancouver', 0, '000.111.222.333', 'paypal@example.com', 'yes', 'yes', 'stripe_secret_key', 'stripe_publishable_key', 'yes', 'lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt', 'a:14:{s:8:\"projects\";s:1:\"1\";s:11:\"recruitment\";s:1:\"1\";s:7:\"payroll\";s:1:\"1\";s:7:\"finance\";s:1:\"1\";s:6:\"travel\";s:1:\"1\";s:8:\"fmanager\";s:1:\"1\";s:5:\"asset\";s:1:\"1\";s:6:\"events\";s:1:\"1\";s:11:\"performance\";s:1:\"1\";s:5:\"award\";s:1:\"1\";s:8:\"holidays\";s:1:\"1\";s:12:\"visitor_book\";s:1:\"1\";s:8:\"training\";s:1:\"1\";s:9:\"inventory\";s:1:\"1\";}', 0, 'a:2:{i:0;s:2:\"en\";i:1;s:2:\"fr\";}', 'a:4:{i:0;s:1:\"0\";s:6:\"level1\";s:1:\"4\";s:6:\"level2\";s:1:\"5\";s:6:\"level3\";s:1:\"6\";}', NULL, NULL, 0, '15-05-2021 08:11:26'),
(2, 12, 'USD', 'USD', 'toast-top-center', 'true', 'true', 'Y-m-d', 'en', 'Asia/Riyadh', 0, NULL, 'paypal@example.com', 'yes', 'yes', 'stripe_secret_key', 'stripe_publishable_key', 'yes', 'invoice terms condition..', 'a:9:{s:8:\"fmanager\";s:1:\"1\";s:5:\"asset\";s:1:\"1\";s:6:\"events\";s:1:\"1\";s:11:\"performance\";s:1:\"1\";s:5:\"award\";s:1:\"1\";s:8:\"holidays\";s:1:\"1\";s:12:\"visitor_book\";s:1:\"1\";s:8:\"training\";s:1:\"1\";s:9:\"inventory\";s:1:\"1\";}', 1, 'a:2:{i:0;s:2:\"en\";i:1;s:2:\"fr\";}', 'a:4:{i:0;s:1:\"0\";s:6:\"level1\";s:1:\"3\";s:6:\"level2\";s:1:\"4\";s:6:\"level3\";s:1:\"5\";}', NULL, NULL, 0, '16-05-2021 04:25:57'),
(3, 13, 'USD', 'USD', 'toast-top-center', 'true', 'true', 'Y-m-d', 'en', 'Asia/Bishkek', 0, NULL, 'paypal@example.com', 'yes', 'yes', 'stripe_secret_key', 'stripe_publishable_key', 'yes', 'invoice terms condition..', 'a:9:{s:8:\"fmanager\";s:1:\"1\";s:5:\"asset\";s:1:\"1\";s:6:\"events\";s:1:\"1\";s:11:\"performance\";s:1:\"1\";s:5:\"award\";s:1:\"1\";s:8:\"holidays\";s:1:\"1\";s:12:\"visitor_book\";s:1:\"1\";s:8:\"training\";s:1:\"1\";s:9:\"inventory\";s:1:\"1\";}', 1, 'a:2:{i:0;s:2:\"en\";i:1;s:2:\"fr\";}', '', NULL, NULL, 0, '12-08-2021 06:06:49'),
(4, 14, 'USD', 'USD', 'toast-top-center', 'true', 'true', 'Y-m-d', 'en', 'Asia/Riyadh', 0, NULL, 'paypal@example.com', 'yes', 'yes', 'stripe_secret_key', 'stripe_publishable_key', 'yes', 'invoice terms condition..', 'a:9:{s:8:\"fmanager\";s:1:\"1\";s:5:\"asset\";s:1:\"1\";s:6:\"events\";s:1:\"1\";s:11:\"performance\";s:1:\"1\";s:5:\"award\";s:1:\"1\";s:8:\"holidays\";s:1:\"1\";s:12:\"visitor_book\";s:1:\"1\";s:8:\"training\";s:1:\"1\";s:9:\"inventory\";s:1:\"1\";}', 0, 'a:2:{i:0;s:2:\"en\";i:1;s:2:\"fr\";}', '', NULL, NULL, 0, '28-09-2021 09:22:53'),
(5, 16, 'USD', 'USD', 'toast-top-center', 'true', 'true', 'Y-m-d', 'en', 'Asia/Riyadh', 0, NULL, 'paypal@example.com', 'yes', 'yes', 'stripe_secret_key', 'stripe_publishable_key', 'yes', 'invoice terms condition..', 'a:9:{s:8:\"fmanager\";s:1:\"1\";s:5:\"asset\";s:1:\"1\";s:6:\"events\";s:1:\"1\";s:11:\"performance\";s:1:\"1\";s:5:\"award\";s:1:\"1\";s:8:\"holidays\";s:1:\"1\";s:12:\"visitor_book\";s:1:\"1\";s:8:\"training\";s:1:\"1\";s:9:\"inventory\";s:1:\"1\";}', 0, 'a:2:{i:0;s:2:\"en\";i:1;s:2:\"fr\";}', '', NULL, NULL, 0, '03-10-2021 10:33:05'),
(6, 17, 'USD', 'USD', 'toast-top-center', 'true', 'true', 'Y-m-d', 'en', 'Asia/Riyadh', 0, NULL, 'paypal@example.com', 'yes', 'yes', 'stripe_secret_key', 'stripe_publishable_key', 'yes', 'invoice terms condition..', 'a:11:{s:11:\"recruitment\";s:1:\"1\";s:7:\"payroll\";s:1:\"1\";s:6:\"travel\";s:1:\"1\";s:8:\"fmanager\";s:1:\"1\";s:5:\"asset\";s:1:\"1\";s:6:\"events\";s:1:\"1\";s:11:\"performance\";s:1:\"1\";s:5:\"award\";s:1:\"1\";s:8:\"holidays\";s:1:\"1\";s:12:\"visitor_book\";s:1:\"1\";s:8:\"training\";s:1:\"1\";}', 0, 'a:2:{i:0;s:2:\"en\";i:1;s:2:\"fr\";}', '', NULL, NULL, 0, '04-10-2021 03:07:40'),
(7, 18, 'USD', 'USD', 'toast-top-center', 'true', 'true', 'Y-m-d', 'en', 'Asia/Riyadh', 0, '0', 'paypal@example.com', 'yes', 'yes', 'stripe_secret_key', 'stripe_publishable_key', 'yes', 'invoice terms condition..', 'a:11:{s:11:\"recruitment\";s:1:\"1\";s:7:\"payroll\";s:1:\"1\";s:6:\"travel\";s:1:\"1\";s:8:\"fmanager\";s:1:\"1\";s:5:\"asset\";s:1:\"1\";s:6:\"events\";s:1:\"1\";s:11:\"performance\";s:1:\"1\";s:5:\"award\";s:1:\"1\";s:8:\"holidays\";s:1:\"1\";s:12:\"visitor_book\";s:1:\"1\";s:8:\"training\";s:1:\"1\";}', 0, 'a:2:{i:0;s:2:\"en\";i:1;s:2:\"fr\";}', '', NULL, NULL, 0, '25-10-2021 12:44:34'),
(8, 22, 'USD', 'USD', 'toast-top-center', 'true', 'true', 'Y-m-d', 'en', 'Asia/Bishkek', 0, '0', 'paypal@example.com', 'yes', 'yes', 'stripe_secret_key', 'stripe_publishable_key', 'yes', 'invoice terms condition..', 'a:11:{s:11:\"recruitment\";s:1:\"1\";s:7:\"payroll\";s:1:\"1\";s:6:\"travel\";s:1:\"1\";s:8:\"fmanager\";s:1:\"1\";s:5:\"asset\";s:1:\"1\";s:6:\"events\";s:1:\"1\";s:11:\"performance\";s:1:\"1\";s:5:\"award\";s:1:\"1\";s:8:\"holidays\";s:1:\"1\";s:12:\"visitor_book\";s:1:\"1\";s:8:\"training\";s:1:\"1\";}', 0, 'a:2:{i:0;s:2:\"en\";i:1;s:2:\"fr\";}', '', NULL, NULL, 0, '22-11-2021 11:02:06'),
(9, 23, 'USD', 'USD', 'toast-top-center', 'true', 'true', 'Y-m-d', 'en', 'Asia/Bishkek', 0, '0', 'paypal@example.com', 'yes', 'yes', 'stripe_secret_key', 'stripe_publishable_key', 'yes', 'invoice terms condition..', 'a:11:{s:11:\"recruitment\";s:1:\"1\";s:7:\"payroll\";s:1:\"1\";s:6:\"travel\";s:1:\"1\";s:8:\"fmanager\";s:1:\"1\";s:5:\"asset\";s:1:\"1\";s:6:\"events\";s:1:\"1\";s:11:\"performance\";s:1:\"1\";s:5:\"award\";s:1:\"1\";s:8:\"holidays\";s:1:\"1\";s:12:\"visitor_book\";s:1:\"1\";s:8:\"training\";s:1:\"1\";}', 0, 'a:2:{i:0;s:2:\"en\";i:1;s:2:\"fr\";}', '', NULL, NULL, 0, '22-11-2021 11:20:01'),
(10, 24, 'CAD', 'CAD', 'toast-top-center', 'true', 'true', 'Y-m-d', 'en', 'America/Vancouver', 0, '0', 'paypal@example.com', 'yes', 'yes', 'stripe_secret_key', 'stripe_publishable_key', 'yes', 'invoice terms condition..', 'a:18:{s:9:\"re_module\";s:1:\"3\";s:11:\"recruitment\";s:1:\"1\";s:7:\"payroll\";s:1:\"1\";s:7:\"finance\";s:1:\"1\";s:6:\"travel\";s:1:\"1\";s:8:\"fmanager\";s:1:\"1\";s:5:\"asset\";s:1:\"1\";s:11:\"performance\";s:1:\"1\";s:5:\"award\";s:1:\"1\";s:8:\"holidays\";s:1:\"1\";s:12:\"visitor_book\";s:1:\"1\";s:8:\"training\";s:1:\"1\";s:5:\"polls\";s:1:\"1\";s:11:\"suggestions\";s:1:\"1\";s:7:\"warning\";s:1:\"1\";s:11:\"resignation\";s:1:\"1\";s:11:\"termination\";s:1:\"1\";s:6:\"events\";s:1:\"1\";}', 0, 'a:2:{i:0;s:2:\"en\";i:1;s:2:\"fr\";}', '', '', '', 1, '23-11-2021 10:09:31');

-- --------------------------------------------------------

--
-- Table structure for table `ci_erp_constants`
--

CREATE TABLE `ci_erp_constants` (
  `constants_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `field_one` text DEFAULT NULL,
  `field_two` text DEFAULT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_erp_constants`
--

INSERT INTO `ci_erp_constants` (`constants_id`, `company_id`, `type`, `category_name`, `field_one`, `field_two`, `created_at`) VALUES
(3, 81, 'company_type', 'Corporation', 'Null', 'Null', '09-05-2021 06:36:23'),
(4, 81, 'company_type', 'Exempt Organization', 'Null', 'Null', '09-05-2021 06:36:23'),
(5, 81, 'company_type', 'Partnership', 'Null', 'Null', '09-05-2021 06:36:23'),
(6, 81, 'company_type', 'Private Foundation', 'Null', 'Null', '09-05-2021 06:36:23'),
(7, 81, 'company_type', 'Limited Liability Company', 'Null', 'Null', '09-05-2021 06:36:23'),
(16, 81, 'religion', 'Agnosticism', 'Null', 'Null', '09-05-2021 06:36:23'),
(17, 81, 'religion', 'Atheism', 'Null', 'Null', '09-05-2021 06:36:23'),
(18, 81, 'religion', 'Baha\'i', 'Null', 'Null', '09-05-2021 06:36:23'),
(19, 81, 'religion', 'Buddhism', 'Null', 'Null', '09-05-2021 06:36:23'),
(20, 81, 'religion', 'Christianity', 'Null', 'Null', '09-05-2021 06:36:23'),
(21, 81, 'religion', 'Humanism', 'Null', 'Null', '09-05-2021 06:36:23'),
(22, 81, 'religion', 'Hinduism', 'Null', 'Null', '09-05-2021 06:36:23'),
(23, 81, 'religion', 'Islam', 'Null', 'Null', '09-05-2021 06:36:23'),
(24, 81, 'religion', 'Jainism', 'Null', 'Null', '09-05-2021 06:36:23'),
(25, 81, 'religion', 'Judaism', 'Null', 'Null', '09-05-2021 06:36:23'),
(26, 81, 'religion', 'Sikhism', 'Null', 'Null', '09-05-2021 06:36:23'),
(27, 81, 'religion', 'Zoroastrianism', 'Null', 'Null', '09-05-2021 06:36:23'),
(93, 81, 'payment_method', 'Cash', '', '', '09-05-2021 06:36:23'),
(94, 81, 'payment_method', 'Paypal', '', '', '09-05-2021 06:36:23'),
(95, 81, 'payment_method', 'Bank', '', '', '09-05-2021 06:36:23'),
(98, 81, 'payment_method', 'Stripe', '', '', '09-05-2021 06:36:23'),
(99, 81, 'payment_method', 'Paystack', '', '', '09-05-2021 06:36:23'),
(100, 81, 'payment_method', 'Cheque', '', '', '09-05-2021 06:36:23'),
(101, 2, 'competencies', 'Leadership', 'Test Comment', 'Test Description', '15-05-2021 05:37:16'),
(102, 2, 'competencies', 'Professional Impact', 'Test Comment', 'Test Description', '15-05-2021 05:37:59'),
(103, 2, 'competencies', 'Oral Communication', 'Test Comment', 'Test Description', '15-05-2021 05:38:48'),
(104, 2, 'competencies', 'Self Management', 'Test Comment', 'Test Description', '15-05-2021 05:39:03'),
(105, 2, 'competencies', 'Team Work', 'Test Comment', 'Test Description', '15-05-2021 05:39:45'),
(106, 2, 'competencies2', 'Allocating Resources', 'Test Comments', 'Test Description', '15-05-2021 05:40:05'),
(107, 2, 'competencies2', 'Organizational Design', 'Test Comments', 'Test Description', '15-05-2021 05:40:24'),
(108, 2, 'competencies2', 'Organizational Savvy', 'Test Comments', 'Test Description', '15-05-2021 05:40:28'),
(109, 2, 'competencies2', 'Business Process', 'Test Comments', 'Test Description', '15-05-2021 05:40:40'),
(110, 2, 'competencies2', 'Project Management', 'Test Comments', 'Test Description', '15-05-2021 05:40:49'),
(111, 2, 'tax_type', 'Capital Gains', '10', 'percentage', '15-05-2021 02:14:32'),
(112, 2, 'tax_type', 'Value-Added Tax', '5', 'percentage', '15-05-2021 02:15:08'),
(113, 2, 'tax_type', 'Excise Taxes', '12', 'fixed', '15-05-2021 02:15:37'),
(114, 2, 'tax_type', 'Wealth Taxes', '8', 'percentage', '15-05-2021 02:16:02'),
(115, 2, 'tax_type', 'No Tax', '0', 'fixed', '15-05-2021 02:16:28'),
(118, 2, 'leave_type', 'Hospitalisation', 'Null', '1', '15-05-2021 03:23:56'),
(119, 2, 'leave_type', 'Maternity', '7', '1', '15-05-2021 03:24:09'),
(125, 2, 'training_type', 'Technical', 'Null', 'Null', '15-05-2021 03:35:04'),
(126, 2, 'training_type', 'Advanced research skills', 'Null', 'Null', '15-05-2021 03:35:16'),
(127, 2, 'training_type', 'Strong communication skills', 'Null', 'Null', '15-05-2021 03:35:25'),
(128, 2, 'training_type', 'Adaptability skills', 'Null', 'Null', '15-05-2021 03:35:33'),
(129, 2, 'training_type', 'Social media', 'Null', 'Null', '15-05-2021 03:35:47'),
(130, 2, 'training_type', 'Enthusiasm for Learning', 'Null', 'Null', '15-05-2021 03:36:01'),
(131, 2, 'training_type', 'Soft Skills', 'Null', 'Null', '15-05-2021 03:36:09'),
(132, 2, 'training_type', 'Professional Training', 'Null', 'Null', '15-05-2021 03:36:16'),
(133, 2, 'training_type', 'Team Training', 'Null', 'Null', '15-05-2021 03:36:23'),
(134, 2, 'goal_type', 'Revamp Employee experience', 'Null', 'Null', '15-05-2021 03:42:46'),
(135, 2, 'goal_type', 'Talent Retention', 'Null', 'Null', '15-05-2021 03:42:55'),
(136, 2, 'goal_type', 'Talent Acquisition', 'Null', 'Null', '15-05-2021 03:43:09'),
(137, 2, 'goal_type', 'Strengthen the Feedback Structure', 'Null', 'Null', '15-05-2021 04:16:26'),
(138, 2, 'goal_type', 'Boost Company culture', 'Null', 'Null', '15-05-2021 04:17:47'),
(139, 2, 'warning_type', 'Written Notice', 'Null', 'Null', '15-05-2021 04:33:13'),
(140, 2, 'warning_type', 'Letter of Written Reprimand', 'Null', 'Null', '15-05-2021 04:33:25'),
(141, 2, 'warning_type', 'Letter of Suspension', 'Null', 'Null', '15-05-2021 04:33:33'),
(142, 2, 'warning_type', 'Disciplinary Demotion', 'Null', 'Null', '15-05-2021 04:33:40'),
(143, 2, 'warning_type', 'Letter of Discharge', 'Null', 'Null', '15-05-2021 04:34:06'),
(144, 2, 'warning_type', 'Reassignment', 'Null', 'Null', '15-05-2021 04:34:13'),
(145, 2, 'warning_type', 'Non-discrimination', 'Null', 'Null', '15-05-2021 04:34:19'),
(146, 2, 'warning_type', 'Confidentiality', 'Null', 'Null', '15-05-2021 04:34:26'),
(147, 2, 'expense_type', 'Fuel Expense', 'Null', 'Null', '15-05-2021 06:04:48'),
(148, 2, 'expense_type', 'Advertising', 'Null', 'Null', '15-05-2021 06:05:11'),
(149, 2, 'expense_type', 'Salaries Expense', 'Null', 'Null', '15-05-2021 06:05:30'),
(150, 2, 'expense_type', 'Warranty Expense', 'Null', 'Null', '15-05-2021 06:05:58'),
(151, 2, 'expense_type', 'Other Expense', 'Null', 'Null', '15-05-2021 06:06:14'),
(152, 2, 'expense_type', 'Insurance', 'Null', 'Null', '15-05-2021 06:06:27'),
(153, 2, 'expense_type', 'Miscellaneous', 'Null', 'Null', '15-05-2021 06:06:51'),
(154, 2, 'expense_type', 'Payroll Tax', 'Null', 'Null', '15-05-2021 06:07:25'),
(155, 2, 'expense_type', 'Utilities', 'Null', 'Null', '15-05-2021 06:08:00'),
(156, 2, 'income_type', 'Capital Stock', 'Null', 'Null', '15-05-2021 06:09:03'),
(157, 2, 'income_type', 'Cash Over', 'Null', 'Null', '15-05-2021 06:09:15'),
(158, 2, 'income_type', 'Common Stock', 'Null', 'Null', '15-05-2021 06:09:28'),
(159, 2, 'income_type', 'Insurance Payable', 'Null', 'Null', '15-05-2021 06:11:42'),
(160, 2, 'income_type', 'Interest Income', 'Null', 'Null', '15-05-2021 06:11:53'),
(161, 2, 'expense_type', 'Interest Expense', 'Null', 'Null', '15-05-2021 06:12:12'),
(162, 2, 'income_type', 'Investment Income', 'Null', 'Null', '15-05-2021 06:12:55'),
(163, 2, 'income_type', 'Retained Earnings', 'Null', 'Null', '15-05-2021 06:13:39'),
(164, 2, 'income_type', 'Sales', 'Null', 'Null', '15-05-2021 06:14:27'),
(165, 2, 'income_type', 'Other Income', 'Null', 'Null', '15-05-2021 06:15:47'),
(174, 2, 'award_type', 'Best Performance', 'Null', 'Null', '17-05-2021 04:30:45'),
(175, 2, 'travel_type', 'Personal Arrangement', 'Null', 'Null', '29-05-2021 05:25:49'),
(176, 2, 'travel_type', 'Hotel', 'Null', 'Null', '29-05-2021 05:26:02'),
(177, 2, 'travel_type', 'Guest House', 'Null', 'Null', '29-05-2021 05:26:10'),
(178, 2, 'travel_type', 'AirBnB', 'Null', 'Null', '29-05-2021 05:26:17'),
(179, 2, 'assets_category', 'assetcat', 'Null', 'Null', '31-07-2021 05:28:47'),
(180, 2, 'assets_brand', 'assetbrand', 'Null', 'Null', '31-07-2021 05:28:55'),
(181, 81, 'subscription_tax', 'No Tax', '0', 'fixed', '15-05-2021 02:15:08'),
(182, 81, 'subscription_tax', 'VAT', '5', 'fixed', '15-05-2021 02:15:08'),
(183, 81, 'subscription_tax', 'GST', '10', 'percentage', '15-05-2021 02:15:37'),
(188, 2, 'exit_type', 'Test Exit Type', 'Null', 'Null', '07-10-2021 10:36:31'),
(190, 2, 'leave_type', 'Vacation', '10', '1', '22-10-2021 04:00:12'),
(193, 2, 'leave_type', 'Sick', 'Null', '1', '16-11-2021 03:51:30'),
(194, 24, 'leave_type', 'Vacation', 'a:7:{s:20:\"enable_leave_accrual\";s:1:\"1\";s:8:\"is_carry\";s:1:\"1\";s:11:\"carry_limit\";s:2:\"40\";s:17:\"is_negative_quota\";s:1:\"1\";s:14:\"negative_limit\";s:3:\"100\";s:8:\"is_quota\";s:1:\"1\";s:12:\"quota_assign\";a:50:{i:0;s:2:\"50\";i:1;s:3:\"100\";i:2;s:3:\"150\";i:3;s:1:\"0\";i:4;s:1:\"0\";i:5;s:1:\"0\";i:6;s:1:\"0\";i:7;s:1:\"0\";i:8;s:1:\"0\";i:9;s:1:\"0\";i:10;s:1:\"0\";i:11;s:1:\"0\";i:12;s:1:\"0\";i:13;s:1:\"0\";i:14;s:1:\"0\";i:15;s:1:\"0\";i:16;s:1:\"0\";i:17;s:1:\"0\";i:18;s:1:\"0\";i:19;s:1:\"0\";i:20;s:1:\"0\";i:21;s:1:\"0\";i:22;s:1:\"0\";i:23;s:1:\"0\";i:24;s:1:\"0\";i:25;s:1:\"0\";i:26;s:1:\"0\";i:27;s:1:\"0\";i:28;s:1:\"0\";i:29;s:1:\"0\";i:30;s:1:\"0\";i:31;s:1:\"0\";i:32;s:1:\"0\";i:33;s:1:\"0\";i:34;s:1:\"0\";i:35;s:1:\"0\";i:36;s:1:\"0\";i:37;s:1:\"0\";i:38;s:1:\"0\";i:39;s:1:\"0\";i:40;s:1:\"0\";i:41;s:1:\"0\";i:42;s:1:\"0\";i:43;s:1:\"0\";i:44;s:1:\"0\";i:45;s:1:\"0\";i:46;s:1:\"0\";i:47;s:1:\"0\";i:48;s:1:\"0\";i:49;s:1:\"0\";}}', '1', '23-11-2021 09:56:46'),
(195, 24, 'leave_type', 'Sick', 'a:7:{s:20:\"enable_leave_accrual\";s:1:\"0\";s:8:\"is_carry\";s:1:\"0\";s:11:\"carry_limit\";s:1:\"0\";s:17:\"is_negative_quota\";s:1:\"0\";s:14:\"negative_limit\";s:1:\"0\";s:8:\"is_quota\";s:1:\"1\";s:12:\"quota_assign\";a:50:{i:0;s:2:\"20\";i:1;s:2:\"20\";i:2;s:2:\"20\";i:3;s:1:\"0\";i:4;s:1:\"0\";i:5;s:1:\"0\";i:6;s:1:\"0\";i:7;s:1:\"0\";i:8;s:1:\"0\";i:9;s:1:\"0\";i:10;s:1:\"0\";i:11;s:1:\"0\";i:12;s:1:\"0\";i:13;s:1:\"0\";i:14;s:1:\"0\";i:15;s:1:\"0\";i:16;s:1:\"0\";i:17;s:1:\"0\";i:18;s:1:\"0\";i:19;s:1:\"0\";i:20;s:1:\"0\";i:21;s:1:\"0\";i:22;s:1:\"0\";i:23;s:1:\"0\";i:24;s:1:\"0\";i:25;s:1:\"0\";i:26;s:1:\"0\";i:27;s:1:\"0\";i:28;s:1:\"0\";i:29;s:1:\"0\";i:30;s:1:\"0\";i:31;s:1:\"0\";i:32;s:1:\"0\";i:33;s:1:\"0\";i:34;s:1:\"0\";i:35;s:1:\"0\";i:36;s:1:\"0\";i:37;s:1:\"0\";i:38;s:1:\"0\";i:39;s:1:\"0\";i:40;s:1:\"0\";i:41;s:1:\"0\";i:42;s:1:\"0\";i:43;s:1:\"0\";i:44;s:1:\"0\";i:45;s:1:\"0\";i:46;s:1:\"0\";i:47;s:1:\"0\";i:48;s:1:\"0\";i:49;s:1:\"0\";}}', '1', '23-11-2021 09:56:52'),
(196, 24, 'leave_type', 'Bereavement', 'a:7:{s:20:\"enable_leave_accrual\";s:1:\"0\";s:8:\"is_carry\";s:1:\"1\";s:11:\"carry_limit\";s:1:\"0\";s:17:\"is_negative_quota\";s:1:\"1\";s:14:\"negative_limit\";s:1:\"0\";s:8:\"is_quota\";s:1:\"1\";s:12:\"quota_assign\";a:50:{i:0;s:2:\"84\";i:1;s:1:\"0\";i:2;s:1:\"0\";i:3;s:1:\"0\";i:4;s:1:\"0\";i:5;s:1:\"0\";i:6;s:1:\"0\";i:7;s:1:\"0\";i:8;s:1:\"0\";i:9;s:1:\"0\";i:10;s:1:\"0\";i:11;s:1:\"0\";i:12;s:1:\"0\";i:13;s:1:\"0\";i:14;s:1:\"0\";i:15;s:1:\"0\";i:16;s:1:\"0\";i:17;s:1:\"0\";i:18;s:1:\"0\";i:19;s:1:\"0\";i:20;s:1:\"0\";i:21;s:1:\"0\";i:22;s:1:\"0\";i:23;s:1:\"0\";i:24;s:1:\"0\";i:25;s:1:\"0\";i:26;s:1:\"0\";i:27;s:1:\"0\";i:28;s:1:\"0\";i:29;s:1:\"0\";i:30;s:1:\"0\";i:31;s:1:\"0\";i:32;s:1:\"0\";i:33;s:1:\"0\";i:34;s:1:\"0\";i:35;s:1:\"0\";i:36;s:1:\"0\";i:37;s:1:\"0\";i:38;s:1:\"0\";i:39;s:1:\"0\";i:40;s:1:\"0\";i:41;s:1:\"0\";i:42;s:1:\"0\";i:43;s:1:\"0\";i:44;s:1:\"0\";i:45;s:1:\"0\";i:46;s:1:\"0\";i:47;s:1:\"0\";i:48;s:1:\"0\";i:49;s:1:\"0\";}}', '1', '23-11-2021 09:56:58'),
(197, 24, 'leave_type', 'Maternity', 'a:7:{s:20:\"enable_leave_accrual\";s:1:\"1\";s:8:\"is_carry\";s:1:\"1\";s:11:\"carry_limit\";s:1:\"0\";s:17:\"is_negative_quota\";s:1:\"1\";s:14:\"negative_limit\";s:1:\"0\";s:8:\"is_quota\";s:1:\"1\";s:12:\"quota_assign\";a:50:{i:0;s:3:\"108\";i:1;s:1:\"0\";i:2;s:1:\"0\";i:3;s:1:\"0\";i:4;s:1:\"0\";i:5;s:1:\"0\";i:6;s:1:\"0\";i:7;s:1:\"0\";i:8;s:1:\"0\";i:9;s:1:\"0\";i:10;s:1:\"0\";i:11;s:1:\"0\";i:12;s:1:\"0\";i:13;s:1:\"0\";i:14;s:1:\"0\";i:15;s:1:\"0\";i:16;s:1:\"0\";i:17;s:1:\"0\";i:18;s:1:\"0\";i:19;s:1:\"0\";i:20;s:1:\"0\";i:21;s:1:\"0\";i:22;s:1:\"0\";i:23;s:1:\"0\";i:24;s:1:\"0\";i:25;s:1:\"0\";i:26;s:1:\"0\";i:27;s:1:\"0\";i:28;s:1:\"0\";i:29;s:1:\"0\";i:30;s:1:\"0\";i:31;s:1:\"0\";i:32;s:1:\"0\";i:33;s:1:\"0\";i:34;s:1:\"0\";i:35;s:1:\"0\";i:36;s:1:\"0\";i:37;s:1:\"0\";i:38;s:1:\"0\";i:39;s:1:\"0\";i:40;s:1:\"0\";i:41;s:1:\"0\";i:42;s:1:\"0\";i:43;s:1:\"0\";i:44;s:1:\"0\";i:45;s:1:\"0\";i:46;s:1:\"0\";i:47;s:1:\"0\";i:48;s:1:\"0\";i:49;s:1:\"0\";}}', '1', '23-11-2021 09:57:32'),
(198, 24, 'leave_type', 'Leave without pay', 'a:7:{s:20:\"enable_leave_accrual\";s:1:\"1\";s:8:\"is_carry\";s:1:\"1\";s:11:\"carry_limit\";s:1:\"0\";s:17:\"is_negative_quota\";s:1:\"1\";s:14:\"negative_limit\";s:1:\"0\";s:8:\"is_quota\";s:1:\"1\";s:12:\"quota_assign\";a:50:{i:0;s:2:\"96\";i:1;s:1:\"0\";i:2;s:1:\"0\";i:3;s:1:\"0\";i:4;s:1:\"0\";i:5;s:1:\"0\";i:6;s:1:\"0\";i:7;s:1:\"0\";i:8;s:1:\"0\";i:9;s:1:\"0\";i:10;s:1:\"0\";i:11;s:1:\"0\";i:12;s:1:\"0\";i:13;s:1:\"0\";i:14;s:1:\"0\";i:15;s:1:\"0\";i:16;s:1:\"0\";i:17;s:1:\"0\";i:18;s:1:\"0\";i:19;s:1:\"0\";i:20;s:1:\"0\";i:21;s:1:\"0\";i:22;s:1:\"0\";i:23;s:1:\"0\";i:24;s:1:\"0\";i:25;s:1:\"0\";i:26;s:1:\"0\";i:27;s:1:\"0\";i:28;s:1:\"0\";i:29;s:1:\"0\";i:30;s:1:\"0\";i:31;s:1:\"0\";i:32;s:1:\"0\";i:33;s:1:\"0\";i:34;s:1:\"0\";i:35;s:1:\"0\";i:36;s:1:\"0\";i:37;s:1:\"0\";i:38;s:1:\"0\";i:39;s:1:\"0\";i:40;s:1:\"0\";i:41;s:1:\"0\";i:42;s:1:\"0\";i:43;s:1:\"0\";i:44;s:1:\"0\";i:45;s:1:\"0\";i:46;s:1:\"0\";i:47;s:1:\"0\";i:48;s:1:\"0\";i:49;s:1:\"0\";}}', '1', '01-12-2021 11:15:22'),
(199, 24, 'leave_type', 'Banked', 'a:7:{s:20:\"enable_leave_accrual\";s:1:\"0\";s:8:\"is_carry\";s:1:\"1\";s:11:\"carry_limit\";s:1:\"0\";s:17:\"is_negative_quota\";s:1:\"1\";s:14:\"negative_limit\";s:1:\"0\";s:8:\"is_quota\";s:1:\"1\";s:12:\"quota_assign\";a:50:{i:0;s:2:\"72\";i:1;s:1:\"0\";i:2;s:1:\"0\";i:3;s:1:\"0\";i:4;s:1:\"0\";i:5;s:1:\"0\";i:6;s:1:\"0\";i:7;s:1:\"0\";i:8;s:1:\"0\";i:9;s:1:\"0\";i:10;s:1:\"0\";i:11;s:1:\"0\";i:12;s:1:\"0\";i:13;s:1:\"0\";i:14;s:1:\"0\";i:15;s:1:\"0\";i:16;s:1:\"0\";i:17;s:1:\"0\";i:18;s:1:\"0\";i:19;s:1:\"0\";i:20;s:1:\"0\";i:21;s:1:\"0\";i:22;s:1:\"0\";i:23;s:1:\"0\";i:24;s:1:\"0\";i:25;s:1:\"0\";i:26;s:1:\"0\";i:27;s:1:\"0\";i:28;s:1:\"0\";i:29;s:1:\"0\";i:30;s:1:\"0\";i:31;s:1:\"0\";i:32;s:1:\"0\";i:33;s:1:\"0\";i:34;s:1:\"0\";i:35;s:1:\"0\";i:36;s:1:\"0\";i:37;s:1:\"0\";i:38;s:1:\"0\";i:39;s:1:\"0\";i:40;s:1:\"0\";i:41;s:1:\"0\";i:42;s:1:\"0\";i:43;s:1:\"0\";i:44;s:1:\"0\";i:45;s:1:\"0\";i:46;s:1:\"0\";i:47;s:1:\"0\";i:48;s:1:\"0\";i:49;s:1:\"0\";}}', '1', '01-12-2021 11:15:42'),
(200, 24, 'incident_type', 'WCB', 'Null', 'Null', '24-12-2021 06:30:15'),
(201, 24, 'goal_type', 'Attendance', 'Null', 'Null', '29-12-2021 09:44:11'),
(202, 24, 'warning_type', 'First Warning', 'Null', 'Null', '05-01-2022 04:39:05');

-- --------------------------------------------------------

--
-- Table structure for table `ci_erp_settings`
--

CREATE TABLE `ci_erp_settings` (
  `setting_id` int(111) NOT NULL,
  `application_name` varchar(255) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `trading_name` varchar(100) DEFAULT NULL,
  `registration_no` varchar(100) DEFAULT NULL,
  `government_tax` varchar(100) DEFAULT NULL,
  `company_type_id` int(11) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `country` int(11) NOT NULL DEFAULT 0,
  `address_1` text DEFAULT NULL,
  `address_2` text DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `zipcode` varchar(200) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `default_currency` varchar(255) NOT NULL DEFAULT 'USD',
  `is_ssl_available` varchar(11) NOT NULL DEFAULT 'on',
  `currency_converter` mediumtext DEFAULT NULL,
  `notification_position` varchar(255) NOT NULL,
  `notification_close_btn` varchar(255) NOT NULL,
  `notification_bar` varchar(255) NOT NULL,
  `date_format_xi` varchar(255) NOT NULL,
  `enable_email_notification` varchar(255) NOT NULL,
  `email_type` varchar(100) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `favicon` varchar(200) NOT NULL,
  `frontend_logo` varchar(200) NOT NULL,
  `other_logo` varchar(255) DEFAULT NULL,
  `animation_effect` varchar(255) NOT NULL,
  `animation_effect_modal` varchar(255) NOT NULL,
  `animation_effect_topmenu` varchar(255) NOT NULL,
  `default_language` varchar(200) NOT NULL DEFAULT 'en',
  `system_timezone` varchar(200) NOT NULL DEFAULT 'Asia/Bishkek',
  `paypal_email` varchar(100) NOT NULL,
  `paypal_sandbox` varchar(10) NOT NULL,
  `paypal_active` varchar(10) NOT NULL,
  `stripe_secret_key` varchar(200) NOT NULL,
  `stripe_publishable_key` varchar(200) NOT NULL,
  `stripe_active` varchar(10) NOT NULL,
  `razorpay_keyid` text NOT NULL,
  `razorpay_key_secret` text NOT NULL,
  `razorpay_active` varchar(100) NOT NULL DEFAULT 'yes',
  `paystack_key_secret` text DEFAULT NULL,
  `paystack_public_secret` text DEFAULT NULL,
  `paystack_active` varchar(11) NOT NULL DEFAULT 'no',
  `flutterwave_public_key` text DEFAULT NULL,
  `flutterwave_secret_key` text DEFAULT NULL,
  `flutterwave_active` varchar(10) NOT NULL DEFAULT 'no',
  `online_payment_account` int(11) NOT NULL,
  `tax_type` int(11) NOT NULL,
  `enable_tax` int(11) NOT NULL DEFAULT 0,
  `invoice_terms_condition` text DEFAULT NULL,
  `auth_background` varchar(255) DEFAULT NULL,
  `enable_sms_notification` int(11) NOT NULL DEFAULT 0,
  `sms_from` varchar(100) DEFAULT NULL,
  `sms_service_plan_id` text DEFAULT NULL,
  `sms_bearer_token` text DEFAULT NULL,
  `header_background` varchar(50) NOT NULL DEFAULT 'bg-dark',
  `login_page` int(11) NOT NULL DEFAULT 1,
  `login_page_text` text DEFAULT NULL,
  `light_sidebar` int(11) NOT NULL DEFAULT 1,
  `template_option` int(11) NOT NULL,
  `hr_version` varchar(200) NOT NULL,
  `hr_release_date` varchar(100) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_erp_settings`
--

INSERT INTO `ci_erp_settings` (`setting_id`, `application_name`, `company_name`, `trading_name`, `registration_no`, `government_tax`, `company_type_id`, `email`, `contact_number`, `country`, `address_1`, `address_2`, `city`, `zipcode`, `state`, `default_currency`, `is_ssl_available`, `currency_converter`, `notification_position`, `notification_close_btn`, `notification_bar`, `date_format_xi`, `enable_email_notification`, `email_type`, `logo`, `favicon`, `frontend_logo`, `other_logo`, `animation_effect`, `animation_effect_modal`, `animation_effect_topmenu`, `default_language`, `system_timezone`, `paypal_email`, `paypal_sandbox`, `paypal_active`, `stripe_secret_key`, `stripe_publishable_key`, `stripe_active`, `razorpay_keyid`, `razorpay_key_secret`, `razorpay_active`, `paystack_key_secret`, `paystack_public_secret`, `paystack_active`, `flutterwave_public_key`, `flutterwave_secret_key`, `flutterwave_active`, `online_payment_account`, `tax_type`, `enable_tax`, `invoice_terms_condition`, `auth_background`, `enable_sms_notification`, `sms_from`, `sms_service_plan_id`, `sms_bearer_token`, `header_background`, `login_page`, `login_page_text`, `light_sidebar`, `template_option`, `hr_version`, `hr_release_date`, `updated_at`) VALUES
(1, '360HRIS', '360HRIS', '360HRIS', '', '', 3, 'admin@360hris.com', '1-888-447-2545', 38, '7-2070', 'Harvey Avenue', 'Kelowna', 'V1Y 8P8', 'British Columbia', 'CAD', '1', 'a:160:{s:3:\"USD\";s:1:\"1\";s:3:\"AED\";s:4:\"3.67\";s:3:\"AFN\";s:5:\"84.97\";s:3:\"ALL\";s:6:\"105.08\";s:3:\"AMD\";s:6:\"478.12\";s:3:\"ANG\";s:4:\"1.79\";s:3:\"AOA\";s:6:\"601.02\";s:3:\"ARS\";s:5:\"98.96\";s:3:\"AUD\";s:4:\"1.36\";s:3:\"AWG\";s:4:\"1.79\";s:3:\"AZN\";s:3:\"1.7\";s:3:\"BAM\";s:4:\"1.69\";s:3:\"BBD\";s:1:\"2\";s:3:\"BDT\";s:5:\"85.55\";s:3:\"BGN\";s:4:\"1.69\";s:3:\"BHD\";s:5:\"0.376\";s:3:\"BIF\";s:7:\"1983.15\";s:3:\"BMD\";s:1:\"1\";s:3:\"BND\";s:4:\"1.35\";s:3:\"BOB\";s:4:\"6.89\";s:3:\"BRL\";s:4:\"5.53\";s:3:\"BSD\";s:1:\"1\";s:3:\"BTN\";s:5:\"75.35\";s:3:\"BWP\";s:5:\"11.29\";s:3:\"BYN\";s:4:\"2.47\";s:3:\"BZD\";s:1:\"2\";s:3:\"CAD\";s:4:\"1.24\";s:3:\"CDF\";s:7:\"1982.45\";s:3:\"CHF\";s:5:\"0.926\";s:3:\"CLP\";s:6:\"824.54\";s:3:\"CNY\";s:4:\"6.44\";s:3:\"COP\";s:7:\"3731.42\";s:3:\"CRC\";s:6:\"626.28\";s:3:\"CUC\";s:1:\"1\";s:3:\"CUP\";s:2:\"25\";s:3:\"CVE\";s:4:\"95.2\";s:3:\"CZK\";s:5:\"21.98\";s:3:\"DJF\";s:6:\"177.72\";s:3:\"DKK\";s:4:\"6.44\";s:3:\"DOP\";s:5:\"56.19\";s:3:\"DZD\";s:6:\"137.47\";s:3:\"EGP\";s:4:\"15.7\";s:3:\"ERN\";s:2:\"15\";s:3:\"ETB\";s:5:\"46.52\";s:3:\"EUR\";s:5:\"0.863\";s:3:\"FJD\";s:4:\"2.09\";s:3:\"FKP\";s:5:\"0.733\";s:3:\"FOK\";s:4:\"6.44\";s:3:\"GBP\";s:5:\"0.733\";s:3:\"GEL\";s:4:\"3.13\";s:3:\"GGP\";s:5:\"0.733\";s:3:\"GHS\";s:4:\"6.06\";s:3:\"GIP\";s:5:\"0.733\";s:3:\"GMD\";s:5:\"52.23\";s:3:\"GNF\";s:7:\"9727.17\";s:3:\"GTQ\";s:4:\"7.73\";s:3:\"GYD\";s:6:\"208.51\";s:3:\"HKD\";s:4:\"7.78\";s:3:\"HNL\";s:5:\"24.08\";s:3:\"HRK\";s:4:\"6.51\";s:3:\"HTG\";s:5:\"98.98\";s:3:\"HUF\";s:6:\"311.76\";s:3:\"IDR\";s:8:\"14153.56\";s:3:\"ILS\";s:4:\"3.24\";s:3:\"IMP\";s:5:\"0.733\";s:3:\"INR\";s:5:\"75.35\";s:3:\"IQD\";s:7:\"1457.64\";s:3:\"IRR\";s:8:\"42004.45\";s:3:\"ISK\";s:6:\"129.82\";s:3:\"JMD\";s:6:\"149.58\";s:3:\"JOD\";s:5:\"0.709\";s:3:\"JPY\";s:6:\"113.44\";s:3:\"KES\";s:6:\"110.66\";s:3:\"KGS\";s:5:\"84.62\";s:3:\"KHR\";s:7:\"4068.82\";s:3:\"KID\";s:4:\"1.36\";s:3:\"KMF\";s:6:\"424.77\";s:3:\"KRW\";s:7:\"1192.44\";s:3:\"KWD\";s:3:\"0.3\";s:3:\"KYD\";s:5:\"0.833\";s:3:\"KZT\";s:6:\"425.44\";s:3:\"LAK\";s:8:\"10096.63\";s:3:\"LBP\";s:6:\"1507.5\";s:3:\"LKR\";s:6:\"200.74\";s:3:\"LRD\";s:6:\"168.01\";s:3:\"LSL\";s:5:\"14.84\";s:3:\"LYD\";s:4:\"4.55\";s:3:\"MAD\";s:4:\"9.07\";s:3:\"MDL\";s:5:\"17.33\";s:3:\"MGA\";s:7:\"3962.42\";s:3:\"MKD\";s:5:\"53.32\";s:3:\"MMK\";s:7:\"1928.68\";s:3:\"MNT\";s:7:\"2848.17\";s:3:\"MOP\";s:4:\"8.01\";s:3:\"MRU\";s:5:\"36.15\";s:3:\"MUR\";s:5:\"42.74\";s:3:\"MVR\";s:5:\"15.42\";s:3:\"MWK\";s:6:\"813.79\";s:3:\"MXN\";s:5:\"20.67\";s:3:\"MYR\";s:4:\"4.16\";s:3:\"MZN\";s:4:\"63.7\";s:3:\"NAD\";s:5:\"14.84\";s:3:\"NGN\";s:6:\"421.93\";s:3:\"NIO\";s:5:\"35.19\";s:3:\"NOK\";s:4:\"8.52\";s:3:\"NPR\";s:6:\"120.56\";s:3:\"NZD\";s:4:\"1.44\";s:3:\"OMR\";s:5:\"0.384\";s:3:\"PAB\";s:1:\"1\";s:3:\"PEN\";s:4:\"4.04\";s:3:\"PGK\";s:4:\"3.52\";s:3:\"PHP\";s:5:\"50.69\";s:3:\"PKR\";s:6:\"170.64\";s:3:\"PLN\";s:4:\"3.96\";s:3:\"PYG\";s:7:\"6895.86\";s:3:\"QAR\";s:4:\"3.64\";s:3:\"RON\";s:4:\"4.28\";s:3:\"RSD\";s:6:\"101.59\";s:3:\"RUB\";s:5:\"71.86\";s:3:\"RWF\";s:7:\"1015.68\";s:3:\"SAR\";s:4:\"3.75\";s:3:\"SBD\";s:4:\"7.97\";s:3:\"SCR\";s:5:\"13.55\";s:3:\"SDG\";s:6:\"439.88\";s:3:\"SEK\";s:4:\"8.73\";s:3:\"SGD\";s:4:\"1.35\";s:3:\"SHP\";s:5:\"0.733\";s:3:\"SLL\";s:8:\"10613.83\";s:3:\"SOS\";s:6:\"577.53\";s:3:\"SRD\";s:5:\"21.42\";s:3:\"SSP\";s:6:\"177.59\";s:3:\"STN\";s:5:\"21.15\";s:3:\"SYP\";s:7:\"1684.35\";s:3:\"SZL\";s:5:\"14.84\";s:3:\"THB\";s:5:\"33.26\";s:3:\"TJS\";s:5:\"11.29\";s:3:\"TMT\";s:4:\"3.49\";s:3:\"TND\";s:4:\"2.82\";s:3:\"TOP\";s:4:\"2.26\";s:3:\"TRY\";s:4:\"9.06\";s:3:\"TTD\";s:4:\"6.78\";s:3:\"TVD\";s:4:\"1.36\";s:3:\"TWD\";s:5:\"28.09\";s:3:\"TZS\";s:7:\"2300.22\";s:3:\"UAH\";s:5:\"26.27\";s:3:\"UGX\";s:7:\"3589.54\";s:3:\"UYU\";s:5:\"43.41\";s:3:\"UZS\";s:8:\"10660.63\";s:3:\"VES\";s:4:\"4.17\";s:3:\"VND\";s:8:\"22719.95\";s:3:\"VUV\";s:6:\"111.51\";s:3:\"WST\";s:4:\"2.58\";s:3:\"XAF\";s:6:\"566.36\";s:3:\"XCD\";s:3:\"2.7\";s:3:\"XDR\";s:4:\"0.71\";s:3:\"XOF\";s:6:\"566.36\";s:3:\"XPF\";s:6:\"103.03\";s:3:\"YER\";s:6:\"249.99\";s:3:\"ZAR\";s:5:\"14.84\";s:3:\"ZMW\";s:5:\"16.85\";}', 'toast-top-center', '0', 'true', 'F j, Y', '1', 'smtp', '360hris_logo.svg', 'fav-icon.png', 'frontend_logo.png', 'other_logo.png', 'fadeInDown', 'tada', 'tada', 'en', 'America/Vancouver', 'paypal@example.com', 'yes', 'no', 'sk_test_51IrqtWJck1huBCXGjafHHFZzzK28jEJq7dsRRzegUH9uQ5X7nYMhPwcSueFUlixy1M86E4o3LhZU1jsSYgCAclNW00BXVEUbwX', 'pk_test_51IrqtWJck1huBCXGe7b6UalwItsUyRcMaqRgiWINpavr859Rcd3XYLnlm3pI9rVV3cVkaLKSIQMgTxupa6774r3b00PkCajPhD', 'yes', 'rzp_test_tru3zv1YXSMlWw', 'mDSgHTiNAVp9A7MjzOmLs62d', 'yes', 'sk_test_75369aaa404d431399f92617e9ba280764e0b15c', 'pk_test_9632a18a275a520050b2f14256db3a2a4d1fade6', 'yes', 'FLWPUBK_TEST-9e3d33d126c6efd62c0bd2de00e35306-X', 'FLWSECK_TEST-1ae23b3116453d3e3cbd6d9978da8476-X', 'yes', 2, 183, 1, 'lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor', '2815767', 0, '+966541234567', '609f61e80185423e92805b90936c8d60', 'c3c86f49e18046de9490baa140f67dc2', 'bg-primary', 1, '360HRIS provides you with a powerful and cost-effective HR platform to ensure you get the best from your employees and managers. 360HRIS is a timely solution to upgrade and modernize your HR team to make it more efficient and consolidate your employee information into one intuitive HR system.', 1, 0, '1.0.0', '2021-05-09', '09-05-2021 06:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `ci_erp_users`
--

CREATE TABLE `ci_erp_users` (
  `user_id` int(11) NOT NULL,
  `user_role_id` int(11) DEFAULT NULL,
  `user_type` varchar(50) NOT NULL,
  `company_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `trading_name` varchar(100) DEFAULT NULL,
  `registration_no` varchar(100) DEFAULT NULL,
  `government_tax` varchar(100) DEFAULT NULL,
  `company_type_id` int(11) DEFAULT NULL,
  `profile_photo` varchar(255) NOT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `gender` varchar(20) NOT NULL,
  `address_1` text DEFAULT NULL,
  `address_2` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `last_login_date` varchar(255) DEFAULT NULL,
  `last_logout_date` varchar(200) DEFAULT NULL,
  `last_login_ip` varchar(255) DEFAULT NULL,
  `is_logged_in` int(11) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `kiosk_code` varchar(4) DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_erp_users`
--

INSERT INTO `ci_erp_users` (`user_id`, `user_role_id`, `user_type`, `company_id`, `first_name`, `last_name`, `email`, `username`, `password`, `company_name`, `trading_name`, `registration_no`, `government_tax`, `company_type_id`, `profile_photo`, `contact_number`, `gender`, `address_1`, `address_2`, `city`, `state`, `zipcode`, `country`, `last_login_date`, `last_logout_date`, `last_login_ip`, `is_logged_in`, `is_active`, `kiosk_code`, `created_at`) VALUES
(1, 1, 'super_user', 0, 'Super', 'Admin', 'admin@360hris.com', 'super.admin', '$2y$12$.crazK9WVT7SO/MTziEBS.NZiYvCliw4TFOh0e0hZahdh6Ot.lQgK', '360HRIS', '', '', '', 3, '1641527193_db70f0489f7374100cf1.jpg', '12506419910', '2', 'XX', 'XX', 'Vancouver', 'British Colombia', 'XXX-XXX', 38, '30-01-2022 14:16:58', '24-01-2022 10:00:08', '127.0.0.1', 1, 1, NULL, '09-05-2021 06:36:23'),
(3, 1, 'staff', 2, 'Joe', 'Larson', 'joe.larson@timehrm.com', 'joe.larson', '$2y$12$O8uQGsZWjE33DuMnSz1NsuEz6uNGLGq2Ecyo1UArMSWsNHVIlvwc6', 'TimeHRM', '', '', '', 0, 'b-sm.jpg', '+6234567890', '1', '', '', 'Surrey', 'BC', '', 38, '28-11-2021 01:55:22', '27-11-2021 23:55:33', '212.112.122.246', 0, 1, NULL, '15-05-2021 05:42:11'),
(4, 1, 'staff', 2, 'Alan', 'Butler', 'alan.butler@360hris.com', 'alan.butler', '$2y$12$TdkZb5/9FgPezP7YgafgQ.fRgFnvkNXmFhHG6Ggvv6ePXg5b8EV4e', 'TimeHRM', '', '', '', 0, 'd-sm.jpg', '6044219283', '2', '', '', 'VANCOUVER', 'British Columbia', 'V5A 3A8', 38, '0', '20-06-2021 11:42:20', '0', 0, 1, NULL, '15-05-2021 05:43:25'),
(5, 1, 'staff', 2, 'Patrick', 'Newman', 'pat.nman@360hris.com', 'patrick.newman', '$2y$12$r.kVkrsEfKEJP27ezxnWbeEA9J6RZb06A8YfvztYD9tdPDGJPurq.', 'TimeHRM', '', '', '', 0, 'avatar-4_3.jpg', '+523658963', '1', '', '', 'Langley', 'BC', '', 38, '0', '20-06-2021 11:42:20', '0', 0, 1, NULL, '15-05-2021 05:46:03'),
(6, 1, 'staff', 2, 'Jane', 'Harris', 'jane.harris@360hris.com', 'jane.harris', '$2y$12$VB0yK/LveIIpBu.tPHFu2ONczSjTxPLRuThmBVUZ4URjCyIuKdIMW', 'TimeHRM', '', '', '', 0, 'c-sm.jpg', '+2198532101', '1', '', '', 'Vancouver', 'BC', '', 38, '0', '20-06-2021 11:42:20', '0', 0, 1, NULL, '15-05-2021 05:47:43'),
(7, 1, 'staff', 2, 'Ashley', 'Lawson', 'ashley.lawson@360hris.com', 'ashley.lawson', '$2y$12$lahXYVI6XPR7fbi/Q/60a.XzCWWd/4NsR/TaEWAfnoBJOeRhw5sjS', 'TimeHRM', '', '', '', 0, 'avatar-5_3.jpg', '+425930287', '1', '', '', 'Toronto', 'ON', '20834', 38, '21-11-2021 20:27:59', '21-11-2021 18:28:39', '24.85.223.110', 0, 1, NULL, '15-05-2021 05:51:36'),
(8, 1, 'staff', 2, 'Garrett', 'Winters', 'garrett.win@360hris.com', 'garrett.win', '$2y$12$2Iq1QLUjMJ.VEXGd6Z5d9un4eXONZBzQmbs5HiCA6/kc4MzcarOMa', 'TimeHRM', '', '', '', 0, 'avatar-2_1.jpg', '+802596301', '1', '', '', 'Calgary', 'AB', '', 38, '21-11-2021 19:35:35', '21-11-2021 20:35:49', '24.85.223.110', 0, 1, NULL, '15-05-2021 05:53:51'),
(9, 0, 'customer', 2, 'Cedric', 'Kelly', 'cedric.kelly@timehrm.com', 'cedric.kelly', '$2y$12$ic7cyb.bYKS.A.iPQtbRN.C/vG0RNARXRbJWcs/o0dNRQWQyH6hrG', 'TimeHRM', '', '', '', 0, '1.png', '1238478202', '1', 'Sadovnicheskaya embankment 79', 'MD 20815', 'Moscow', 'Moscow', '20834', 182, '23-11-2021 23:13:44', '23-11-2021 21:14:46', '24.85.223.110', 0, 1, NULL, '15-05-2021 12:33:00'),
(11, 0, 'customer', 2, 'Ashton', 'Cox', 'ashton@timehrm.com', 'ashton.cox', '$2y$12$AT0tUcjZ.gRY0wC0WLb19e.wXRRvF9ek7WdLLWBK4Ic8YD5/du0PO', 'TimeHRM', '', '', '', 0, '5.png', '9632587451', '1', 'Sadovnicheskaya embankment 79', 'MD 20815', 'Moscow', 'Moscow', '20834', 182, '0', '20-06-2021 11:42:20', '0', 0, 1, NULL, '15-05-2021 01:48:45'),
(12, 0, 'company', 0, 'Thomas', 'Fleming', 'time.hrms@timehrm.com', 'timehrms', '$2y$12$9Mewzx./9i1ST9VDgqBt9Otzf2pBQRvXqROR033riL50O69pwE45a', 'Timehrm2', '', '', '', 3, 'no', '0123456789', '1', '', '', '', '', '', 230, '16-05-2021 16:27:02', '20-06-2021 11:42:20', '::1', 0, 1, NULL, '16-05-2021 04:25:57'),
(15, 0, 'candidate', 2, 'asdfsdf', 'sdfsdfas', 'dfasdfsdf@asdas.com', 'candidate', '$2y$12$zysr/.129TEtCwW9kfxhfenAkBdRY4E5cCBYPdiyhIoq2UZDk/dP.', '', '', '', '', 0, 'avatar-3.jpg', '123123121222', '1', 'Testtt address data', '', 'Ca1', 'St1', '12345', 3, '28-10-2021 01:47:46', '16-10-2021 14:26:25', '::1', 1, 1, NULL, '01-10-2021 12:24:49'),
(20, 1, 'staff', 2, 'John', 'Sanders', 'johnsanders@360hris.com', 'John.Sanders', '$2y$12$XUKkILc2CwKfMlH7fB6w5Oo8VmoyT3h/VtiHRryhHDVTE7BbmNd5a', 'TimeHRM', '', '', '', 0, '', '123456789', '1', '', '', 'Vancouver', 'BC', '', 0, '22-11-2021 16:22:50', '22-11-2021 14:23:39', '24.85.223.110', 0, 1, NULL, '06-11-2021 05:06:58'),
(23, 0, 'company', 0, 'Nicholas', 'Persaud', 'nicholas.persaud@gmail.com', '715833', '$2y$12$LmkhNc5LT9l3Qah1FEs50ed/nrZHgr29ZFrMd4jusVFIlruOVRk1O', 'Metlakatla Development Corporation', '', '', '', 3, 'no', '2506419919', '1', '', '', '', '', '', 230, '0', '0', '0', 0, 1, NULL, '22-11-2021 11:20:01'),
(24, 0, 'company', 0, 'Human Resources', 'Information System', 'demo@360hris.com', 'demo.company', '$2y$12$ZL0XRUxZZwdoPD1208SRf.6.vkn7OeLawJ0cu8wyL2uiBzhnilzfK', 'Demo Company', '', '', '', 3, 'Nexgen Logo - Transparent (2).png', '12345678', '1', '123 Test Avenue', '', 'Vancouver', 'BC', 'V9S 8H3', 38, '18-01-2022 19:57:23', '18-01-2022 08:24:43', '24.85.223.110', 1, 1, NULL, '23-11-2021 10:09:31'),
(25, 4, 'staff', 24, 'Patrick ', 'Simon', 'Patrick.simon@demo.com', 'demo.manager', '$2y$12$NLh5sDeairfTlMA4IDoeAeiVH1kJJVeAomr/59ZTxsuyEeE0ome6i', 'Demo Company', '', '', '', 0, '1637694296_5013e33828308aa5c781.jpg', '+1 259687126', '1', '', '', 'Vancouver', 'BC', '', 38, '02-02-2022 11:38:54', '31-01-2022 10:36:26', '127.0.0.1', 1, 1, NULL, '23-11-2021 09:49:56'),
(26, 5, 'staff', 24, 'Mary', 'Lisbon', 'mary.lisbon@gmail.com', 'demo.employee', '$2y$12$3Q3yU5ToOQ.DHXRfXRBXxuwtfXj6IGlduINqKM88CPcqezYsjQt.y', 'Demo Company', '', '', '', 0, '1637694350_9d00618cb0e870e6c074.jpg', '123456789', '2', '', '', '', '', '', 0, '31-01-2022 12:36:34', '31-01-2022 10:43:50', '127.0.0.1', 0, 1, '1234', '23-11-2021 09:51:40'),
(27, 4, 'staff', 24, 'Jhon', 'Davis', 'jhon.davis@demo.com', 'jhon.davis', '$2y$12$RQoCWqRtZJtClBv4rFOT1uUddq4x.JlchCaTVQEtLNfjK9nrUio5e', 'Demo Company', '', '', '', 0, '1637697058_9e7dc76ff868a885b7df.jpg', '+1 123456789', '1', '', '', '', '', '', 0, '12-01-2022 20:46:11', '12-01-2022 19:07:10', '24.85.223.110', 0, 1, '9872', '23-11-2021 10:49:52'),
(28, 5, 'staff', 24, 'Roberta', 'Parker', 'roberta.parker@demo.com', 'roberta.parker', '$2y$12$YxFKB0xUk2oFcFm12EOPweSf.QRu41L3MaUa2PsLpLCLJxBSCqlo2', 'Demo Company', '', '', '', 0, '1637697643_add9506381cc3f440009.jpg', '+1 23456789', '2', '', '', '', '', '', 0, '08-01-2022 00:20:11', '07-01-2022 22:21:16', '24.85.223.110', 0, 1, '4321', '23-11-2021 11:00:43'),
(29, 5, 'staff', 24, 'Alexa', 'Chan', 'alexa.chan@demo.com', 'alexa.chan', '$2y$12$GrElyF./cJQALj5lg3S/SeIvRhcN72I1WTm0CXCce85vrFQufZ7Za', 'Demo Company', '', '', '', 0, '1637697769_5a5d1377aec57de608e4.jpg', '+1 98765432', '2', '', '', '', '', '', 0, '0', '0', '0', 0, 1, '5612', '23-11-2021 11:02:49'),
(30, 4, 'staff', 24, 'Dave', 'miller', 'dave.miller@demo.com', 'dave.miller', '$2y$12$yj9ac6dUXPn9j/.Nzf4mtu4yahe8NW/LPUSdxHYwW4GJE6MZB2sOG', 'Demo Company', '', '', '', 0, '1637698048_689d0810315c9e466a04.jpg', '+1 25896325', '1', '', '', '', '', '', 0, '23-11-2021 14:24:24', '23-11-2021 23:25:41', '24.85.223.110', 0, 1, NULL, '23-11-2021 11:07:28'),
(31, 5, 'staff', 24, 'Sophia', 'Jones', 'sophia.jones@gmail.com', 'sophia.jones', '$2y$12$UdAABzd9ZaLvzWRE1UppU.fzKdgAFAALjcyKF7kcyklI7Rp6RLBEW', 'Demo Company', '', '', '', 0, '1637698324_fc0310d4bdeb74b4a944.jpg', '+1 365478963', '2', '', '', '', '', '', 0, '23-11-2021 14:25:47', '23-11-2021 23:30:59', '24.85.223.110', 0, 1, NULL, '23-11-2021 11:11:44'),
(33, 5, 'staff', 24, 'Rogers', 'Smith', 'rogers.smith@test.com', 'rogers.smith', '$2y$12$EGKS1ybDyyRn7nTEEdUiH.pJBW8ZAtm6u38JhRpO9SwPvwEsleOWe', 'Demo Company', '', '', '', 0, '', '1112223333', '1', '', '', '', '', '', 0, '08-12-2021 10:46:06', '08-12-2021 08:47:37', '24.85.223.110', 0, 1, NULL, '08-12-2021 08:38:45'),
(34, 4, 'staff', 24, 'Rose', 'Brown', 'rose.brown@test.com', 'rose.brown', '$2y$12$FINRmvaaOYmt7VlwuTSJMej4sXjr8AQwqlKKMeAsDPqhCjD4N6upC', 'Demo Company', '', '', '', 0, '', '111', '2', '', '', '', '', '', 0, '0', '0', '0', 0, 1, NULL, '08-12-2021 09:57:46'),
(35, 4, 'staff', 24, 'Test', 'Test', 'test@test.com', 'test123', '$2y$12$HCHajd0iXa0Xp.PIRt968uW8mcMrTJTTAznCBWyihDwvzI9wwl4WW', 'Demo Company', '', '', '', 0, '', '2222222', '1', '', '', '', '', '', 0, '0', '0', '0', 0, 1, NULL, '08-12-2021 10:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `ci_erp_users_details`
--

CREATE TABLE `ci_erp_users_details` (
  `staff_details_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `reporting_manager` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `office_shift_id` int(11) NOT NULL,
  `basic_salary` decimal(65,2) NOT NULL,
  `hourly_rate` decimal(65,2) NOT NULL,
  `salay_type` int(11) NOT NULL,
  `role_description` mediumtext DEFAULT NULL,
  `date_of_joining` varchar(200) DEFAULT NULL,
  `contract_end` int(11) NOT NULL DEFAULT 0,
  `date_of_leaving` varchar(200) DEFAULT NULL,
  `date_of_birth` varchar(200) DEFAULT NULL,
  `marital_status` int(11) DEFAULT NULL,
  `religion_id` int(11) DEFAULT NULL,
  `blood_group` varchar(200) DEFAULT NULL,
  `citizenship_id` int(11) DEFAULT NULL,
  `bio` mediumtext DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `fb_profile` mediumtext DEFAULT NULL,
  `twitter_profile` mediumtext DEFAULT NULL,
  `gplus_profile` mediumtext DEFAULT NULL,
  `linkedin_profile` mediumtext DEFAULT NULL,
  `account_title` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `bank_name` int(11) NOT NULL,
  `iban` varchar(255) DEFAULT NULL,
  `swift_code` varchar(255) DEFAULT NULL,
  `bank_branch` mediumtext DEFAULT NULL,
  `default_language` varchar(50) DEFAULT NULL,
  `contact_full_name` varchar(200) DEFAULT NULL,
  `contact_phone_no` varchar(200) DEFAULT NULL,
  `contact_email` varchar(200) DEFAULT NULL,
  `contact_address` mediumtext DEFAULT NULL,
  `ml_tax_category` int(11) NOT NULL,
  `ml_empployee_epf_rate` varchar(100) NOT NULL DEFAULT '0',
  `ml_empployer_epf_rate` varchar(100) NOT NULL DEFAULT '0',
  `ml_eis_contribution` int(11) NOT NULL,
  `ml_socso_category` int(11) NOT NULL,
  `ml_pcb_socso` varchar(100) NOT NULL DEFAULT '2021',
  `ml_hrdf` int(11) NOT NULL,
  `ml_tax_citizenship` int(11) NOT NULL DEFAULT 1,
  `zakat_fund` decimal(65,2) NOT NULL DEFAULT 0.00,
  `job_type` int(11) NOT NULL,
  `assigned_hours` varchar(100) DEFAULT NULL,
  `leave_options` text DEFAULT NULL,
  `approval_levels` varchar(255) DEFAULT NULL,
  `is_accrual_pause` int(11) NOT NULL DEFAULT 0,
  `pause_start_date` varchar(255) DEFAULT NULL,
  `pause_start_end` varchar(255) DEFAULT NULL,
  `created_at` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_erp_users_details`
--

INSERT INTO `ci_erp_users_details` (`staff_details_id`, `company_id`, `user_id`, `employee_id`, `reporting_manager`, `department_id`, `designation_id`, `office_shift_id`, `basic_salary`, `hourly_rate`, `salay_type`, `role_description`, `date_of_joining`, `contract_end`, `date_of_leaving`, `date_of_birth`, `marital_status`, `religion_id`, `blood_group`, `citizenship_id`, `bio`, `experience`, `fb_profile`, `twitter_profile`, `gplus_profile`, `linkedin_profile`, `account_title`, `account_number`, `bank_name`, `iban`, `swift_code`, `bank_branch`, `default_language`, `contact_full_name`, `contact_phone_no`, `contact_email`, `contact_address`, `ml_tax_category`, `ml_empployee_epf_rate`, `ml_empployer_epf_rate`, `ml_eis_contribution`, `ml_socso_category`, `ml_pcb_socso`, `ml_hrdf`, `ml_tax_citizenship`, `zakat_fund`, `job_type`, `assigned_hours`, `leave_options`, `approval_levels`, `is_accrual_pause`, `pause_start_date`, `pause_start_end`, `created_at`) VALUES
(1, 2, 3, '105765', 0, 3, 5, 1, '6337.00', '10.00', 1, 'Enter role description here..', '2021-05-15', 0, '', '2020-11-07', 0, 0, '', 0, 'Enter staff bio here..', 0, '', '', '', '', 'Joe Larson', '0028938712785412', 3, '00US0028938712785412', 'SW8596271', 'Test Branch', 'en', '', '', '', '', 13, '7', '13', 1, 1, '2021', 1, 1, '100.00', 1, NULL, 'a:4:{i:118;a:12:{i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";i:7;s:1:\"2\";i:8;s:1:\"2\";i:9;s:1:\"2\";i:10;s:1:\"2\";i:11;s:1:\"2\";i:12;s:1:\"2\";}i:119;a:12:{i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";i:7;s:1:\"2\";i:8;s:1:\"2\";i:9;s:1:\"2\";i:10;s:1:\"2\";i:11;s:1:\"2\";i:12;s:1:\"2\";}i:190;a:12:{i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";i:7;s:1:\"2\";i:8;s:1:\"2\";i:9;s:1:\"2\";i:10;s:1:\"2\";i:11;s:1:\"2\";i:12;s:1:\"2\";}i:193;a:12:{i:1;s:1:\"0\";i:2;s:1:\"3\";i:3;s:1:\"0\";i:4;s:1:\"0\";i:5;s:1:\"0\";i:6;s:1:\"0\";i:7;s:1:\"0\";i:8;s:1:\"0\";i:9;s:1:\"0\";i:10;s:1:\"0\";i:11;s:1:\"0\";i:12;s:1:\"0\";}}', NULL, 0, NULL, NULL, '15-05-2021 05:42:11'),
(2, 2, 4, '981675', 3, 1, 1, 1, '1526.00', '10.00', 1, 'Enter role description here..', '2018-11-17', 1, '2021-10-01', '1999-11-07', 0, 20, 'A+', 38, 'Enter staff bio here..', 0, '', '', '', '', 'Alan Butler', '1263366999', 4, '874531321315', 'SW859633', 'test branch', 'en', '', '', '', '', 0, '0', '0', 0, 0, '2021', 0, 1, '0.00', 0, NULL, 'a:3:{i:118;a:12:{i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";i:7;s:1:\"2\";i:8;s:1:\"2\";i:9;s:1:\"2\";i:10;s:1:\"2\";i:11;s:1:\"2\";i:12;s:1:\"2\";}i:119;a:12:{i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";i:7;s:1:\"2\";i:8;s:1:\"2\";i:9;s:1:\"2\";i:10;s:1:\"2\";i:11;s:1:\"2\";i:12;s:1:\"2\";}i:190;a:12:{i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";i:7;s:1:\"2\";i:8;s:1:\"2\";i:9;s:1:\"2\";i:10;s:1:\"2\";i:11;s:1:\"2\";i:12;s:1:\"2\";}}', 'a:3:{s:6:\"level1\";s:1:\"3\";s:6:\"level2\";s:0:\"\";s:6:\"level3\";s:0:\"\";}', 0, NULL, NULL, '15-05-2021 05:43:25'),
(3, 2, 5, '943726', 7, 3, 7, 1, '3142.00', '10.00', 1, 'Enter role description here..', '2021-02-15', 0, '2021-10-13', '2021-10-03', 0, 0, '', 0, 'Enter staff bio here..', 0, '', '', '', '', '', '', 0, '', '', '', 'en', '', '', '', '', 0, '4', '6', 1, 1, '2021', 1, 2, '0.00', 0, NULL, 'a:4:{i:118;a:12:{i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";i:7;s:1:\"2\";i:8;s:1:\"2\";i:9;s:1:\"2\";i:10;s:1:\"2\";i:11;s:1:\"2\";i:12;s:1:\"2\";}i:119;a:12:{i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";i:7;s:1:\"2\";i:8;s:1:\"2\";i:9;s:1:\"2\";i:10;s:1:\"2\";i:11;s:1:\"2\";i:12;s:1:\"2\";}i:190;a:12:{i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";i:7;s:1:\"2\";i:8;s:1:\"2\";i:9;s:1:\"2\";i:10;s:1:\"2\";i:11;s:1:\"2\";i:12;s:1:\"2\";}i:193;a:12:{i:1;s:1:\"0\";i:2;s:1:\"0\";i:3;s:1:\"0\";i:4;s:1:\"0\";i:5;s:1:\"0\";i:6;s:1:\"0\";i:7;s:1:\"0\";i:8;s:1:\"0\";i:9;s:1:\"0\";i:10;s:1:\"0\";i:11;s:1:\"0\";i:12;s:1:\"0\";}}', NULL, 0, NULL, NULL, '15-05-2021 05:46:03'),
(4, 2, 6, '282349', 4, 3, 7, 2, '1200.00', '10.00', 1, 'Enter role description here..', '2021-05-15', 0, '', '2021-10-02', 0, 0, '', 38, 'Enter staff bio here..', 0, '', '', '', '', '', '', 0, '', '', '', 'en', '', '', '', '', 0, '0', '0', 0, 0, '2021', 0, 1, '0.00', 0, NULL, 'a:3:{i:118;a:12:{i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";i:7;s:1:\"2\";i:8;s:1:\"2\";i:9;s:1:\"2\";i:10;s:1:\"2\";i:11;s:1:\"2\";i:12;s:1:\"2\";}i:119;a:12:{i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";i:7;s:1:\"2\";i:8;s:1:\"2\";i:9;s:1:\"2\";i:10;s:1:\"2\";i:11;s:1:\"2\";i:12;s:1:\"2\";}i:190;a:12:{i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";i:7;s:1:\"2\";i:8;s:1:\"2\";i:9;s:1:\"2\";i:10;s:1:\"2\";i:11;s:1:\"2\";i:12;s:1:\"2\";}}', NULL, 0, NULL, NULL, '15-05-2021 05:47:43'),
(5, 2, 7, '712246', 4, 3, 8, 1, '1500.00', '10.00', 1, 'Enter role description here..', '2021-03-15', 0, '', '', 0, 0, '', 38, 'Enter staff bio here..', 0, '', '', '', '', '', '', 0, '', '', '', 'en', '', '', '', '', 0, '0', '0', 0, 0, '2021', 0, 1, '0.00', 0, NULL, 'a:3:{i:118;a:12:{i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";i:7;s:1:\"2\";i:8;s:1:\"2\";i:9;s:1:\"2\";i:10;s:1:\"2\";i:11;s:1:\"2\";i:12;s:1:\"2\";}i:119;a:12:{i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";i:7;s:1:\"2\";i:8;s:1:\"2\";i:9;s:1:\"2\";i:10;s:1:\"2\";i:11;s:1:\"2\";i:12;s:1:\"2\";}i:190;a:12:{i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";i:7;s:1:\"2\";i:8;s:1:\"2\";i:9;s:1:\"2\";i:10;s:1:\"2\";i:11;s:1:\"2\";i:12;s:1:\"2\";}}', NULL, 0, NULL, NULL, '15-05-2021 05:51:36'),
(6, 2, 8, '457245', 7, 3, 9, 1, '1500.00', '10.00', 1, 'Enter role description here..', '2021-10-10', 0, '2021-10-02', '2021-10-03', 0, 0, '', 38, 'Enter staff bio here..', 0, '', '', '', '', '', '', 0, '', '', '', 'en', '', '', '', '', 0, '0', '0', 0, 0, '2021', 0, 1, '0.00', 0, NULL, 'a:4:{i:118;a:12:{i:1;s:1:\"0\";i:2;s:1:\"0\";i:3;s:1:\"0\";i:4;s:1:\"0\";i:5;s:1:\"0\";i:6;s:1:\"0\";i:7;s:1:\"0\";i:8;s:1:\"0\";i:9;s:1:\"0\";i:10;s:1:\"0\";i:11;s:1:\"0\";i:12;s:1:\"0\";}i:119;a:12:{i:1;s:1:\"0\";i:2;s:1:\"0\";i:3;s:1:\"0\";i:4;s:1:\"0\";i:5;s:1:\"0\";i:6;s:1:\"0\";i:7;s:1:\"0\";i:8;s:1:\"0\";i:9;s:1:\"0\";i:10;s:1:\"0\";i:11;s:1:\"0\";i:12;s:1:\"0\";}i:190;a:12:{i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";i:7;s:1:\"2\";i:8;s:1:\"2\";i:9;s:1:\"2\";i:10;s:1:\"2\";i:11;s:1:\"2\";i:12;s:1:\"2\";}i:193;a:12:{i:1;s:1:\"2\";i:2;s:1:\"2\";i:3;s:1:\"2\";i:4;s:1:\"2\";i:5;s:1:\"2\";i:6;s:1:\"2\";i:7;s:1:\"2\";i:8;s:1:\"2\";i:9;s:1:\"2\";i:10;s:1:\"2\";i:11;s:1:\"2\";i:12;s:1:\"2\";}}', 'a:3:{s:6:\"level1\";s:1:\"7\";s:6:\"level2\";s:1:\"4\";s:6:\"level3\";s:1:\"3\";}', 0, NULL, NULL, '15-05-2021 05:53:51'),
(9, 2, 20, '112233', 4, 1, 1, 1, '750.00', '0.00', 1, 'Enter role description here..', '2021-11-06', 0, '2021-11-10', '', 0, 0, '', 0, 'Enter staff bio here..', 0, '', '', '', '', '', '', 0, '', '', '', 'en', '', '', '', '', 0, '0', '0', 0, 0, '2021', 0, 1, '0.00', 1, NULL, NULL, NULL, 0, NULL, NULL, '06-11-2021 05:06:58'),
(10, 2, 21, '036991', 5, 1, 1, 1, '1000.00', '0.00', 1, 'Enter role description here..', '2021-11-11', 0, '', '', 0, 0, '', 0, 'Enter staff bio here..', 0, '', '', '', '', '', '', 0, '', '', '', 'en', '', '', '', '', 0, '0', '0', 0, 0, '2021', 0, 1, '0.00', 1, NULL, '', NULL, 0, NULL, NULL, '11-11-2021 12:59:40'),
(11, 24, 25, '059080', 0, 9, 11, 3, '100000.00', '0.00', 1, 'Enter role description here..', '2021-11-23', 0, '', '', 0, 0, '', 0, 'Enter staff bio here..', 0, '', '', '', '', '', '', 0, '', '', '', NULL, '', '', '', '', 0, '0', '0', 0, 0, '2021', 0, 1, '0.00', 1, 'a:6:{i:194;s:3:\"120\";i:195;s:2:\"96\";i:196;s:2:\"96\";i:197;s:3:\"120\";i:198;s:3:\"156\";i:199;s:3:\"192\";}', 'a:5:{i:194;a:12:{i:1;s:2:\"10\";i:2;s:2:\"10\";i:3;s:2:\"10\";i:4;s:2:\"10\";i:5;s:2:\"10\";i:6;s:2:\"10\";i:7;s:2:\"10\";i:8;s:2:\"10\";i:9;s:2:\"10\";i:10;s:2:\"10\";i:11;s:2:\"10\";i:12;s:2:\"10\";}i:195;a:12:{i:1;s:1:\"8\";i:2;s:1:\"8\";i:3;s:1:\"8\";i:4;s:1:\"8\";i:5;s:1:\"8\";i:6;s:1:\"8\";i:7;s:1:\"8\";i:8;s:1:\"8\";i:9;s:1:\"8\";i:10;s:1:\"8\";i:11;s:1:\"8\";i:12;s:1:\"8\";}i:197;a:12:{i:1;s:2:\"10\";i:2;s:2:\"10\";i:3;s:2:\"10\";i:4;s:2:\"10\";i:5;s:2:\"10\";i:6;s:2:\"10\";i:7;s:2:\"10\";i:8;s:2:\"10\";i:9;s:2:\"10\";i:10;s:2:\"10\";i:11;s:2:\"10\";i:12;s:2:\"10\";}i:198;a:12:{i:1;s:2:\"13\";i:2;s:2:\"13\";i:3;s:2:\"13\";i:4;s:2:\"13\";i:5;s:2:\"13\";i:6;s:2:\"13\";i:7;s:2:\"13\";i:8;s:2:\"13\";i:9;s:2:\"13\";i:10;s:2:\"13\";i:11;s:2:\"13\";i:12;s:2:\"13\";}s:16:\"pause_date_start\";a:1:{i:0;s:1:\"0\";}}', NULL, 0, '', '', '23-11-2021 09:49:56'),
(12, 24, 26, '595213', 25, 9, 12, 3, '75000.00', '0.00', 1, 'Enter role description here..', '2021-01-01', 0, '', '', 0, 0, '', 0, 'Enter staff bio here..', 0, '', '', '', '', '', '', 0, '', '', '', 'en', '', '', '', '', 0, '0', '0', 0, 0, '2021', 0, 1, '0.00', 1, 'a:6:{i:194;s:2:\"60\";i:195;s:3:\"100\";i:196;s:2:\"84\";i:197;s:3:\"108\";i:198;s:2:\"96\";i:199;s:2:\"72\";}', 'a:8:{i:194;a:12:{i:1;s:1:\"5\";i:2;s:1:\"5\";i:3;s:1:\"5\";i:4;s:1:\"5\";i:5;s:1:\"5\";i:6;s:1:\"5\";i:7;s:1:\"5\";i:8;s:1:\"5\";i:9;s:1:\"5\";i:10;s:1:\"5\";i:11;s:1:\"5\";i:12;s:1:\"5\";}i:195;a:12:{i:1;s:3:\"8.3\";i:2;s:3:\"8.3\";i:3;s:3:\"8.3\";i:4;s:3:\"8.3\";i:5;s:3:\"8.3\";i:6;s:3:\"8.3\";i:7;s:3:\"8.3\";i:8;s:3:\"8.3\";i:9;s:3:\"8.3\";i:10;s:3:\"8.3\";i:11;s:3:\"8.3\";i:12;s:3:\"8.3\";}i:196;a:12:{i:1;s:1:\"7\";i:2;s:1:\"7\";i:3;s:1:\"7\";i:4;s:1:\"7\";i:5;s:1:\"7\";i:6;s:1:\"7\";i:7;s:1:\"7\";i:8;s:1:\"7\";i:9;s:1:\"7\";i:10;s:1:\"7\";i:11;s:1:\"7\";i:12;s:1:\"7\";}i:197;a:12:{i:1;s:1:\"9\";i:2;s:1:\"9\";i:3;s:1:\"9\";i:4;s:1:\"9\";i:5;s:1:\"9\";i:6;s:1:\"9\";i:7;s:1:\"9\";i:8;s:1:\"9\";i:9;s:1:\"9\";i:10;s:1:\"9\";i:11;s:1:\"9\";i:12;s:1:\"9\";}i:198;a:12:{i:1;s:1:\"8\";i:2;s:1:\"8\";i:3;s:1:\"8\";i:4;s:1:\"8\";i:5;s:1:\"8\";i:6;s:1:\"8\";i:7;s:1:\"8\";i:8;s:1:\"8\";i:9;s:1:\"8\";i:10;s:1:\"8\";i:11;s:1:\"8\";i:12;s:1:\"8\";}i:199;a:12:{i:1;s:1:\"6\";i:2;s:1:\"6\";i:3;s:1:\"6\";i:4;s:1:\"6\";i:5;s:1:\"6\";i:6;s:1:\"6\";i:7;s:1:\"6\";i:8;s:1:\"6\";i:9;s:1:\"6\";i:10;s:1:\"6\";i:11;s:1:\"6\";i:12;s:1:\"6\";}s:16:\"pause_date_start\";s:7:\"2021-12\";s:14:\"pause_date_end\";s:7:\"2021-12\";}', 'a:3:{s:6:\"level1\";s:2:\"25\";s:6:\"level2\";s:2:\"27\";s:6:\"level3\";s:0:\"\";}', 0, NULL, NULL, '23-11-2021 09:51:40'),
(13, 24, 27, '437398', 25, 8, 15, 3, '125000.00', '0.00', 1, 'Enter role description here..', '2021-11-23', 0, '', '', 0, 0, '', 0, 'Enter staff bio here..', 0, '', '', '', '', '', '', 0, '', '', '', NULL, '', '', '', '', 0, '0', '0', 0, 0, '2021', 0, 1, '0.00', 1, NULL, '', 'a:3:{s:6:\"level1\";s:2:\"25\";s:6:\"level2\";s:0:\"\";s:6:\"level3\";s:0:\"\";}', 0, NULL, NULL, '23-11-2021 10:49:52'),
(14, 24, 28, '656243', 27, 8, 16, 3, '65000.00', '0.00', 1, 'Enter role description here..', '2021-11-23', 0, '', '', 0, 0, '', 0, 'Enter staff bio here..', 0, '', '', '', '', '', '', 0, '', '', '', NULL, '', '', '', '', 0, '0', '0', 0, 0, '2021', 0, 1, '0.00', 1, NULL, '', NULL, 0, NULL, NULL, '23-11-2021 11:00:43'),
(15, 24, 29, '397932', 27, 8, 16, 3, '0.00', '0.00', 2, 'Enter role description here..', '2020-01-01', 0, '', '', 0, 0, '', 0, 'Enter staff bio here..', 0, '', '', '', '', '', '', 0, '', '', '', 'en', '', '', '', '', 0, '0', '0', 0, 0, '2021', 0, 1, '0.00', 1, 'a:6:{i:194;s:3:\"140\";i:195;s:1:\"0\";i:196;s:1:\"0\";i:197;s:1:\"0\";i:198;s:1:\"0\";i:199;s:1:\"0\";}', 'a:6:{i:194;a:12:{i:1;s:1:\"3\";i:2;s:1:\"3\";i:3;s:1:\"3\";i:4;s:1:\"3\";i:5;s:1:\"3\";i:6;s:1:\"3\";i:7;s:1:\"3\";i:8;s:1:\"3\";i:9;s:1:\"3\";i:10;s:1:\"3\";i:11;s:1:\"3\";i:12;s:1:\"3\";}i:195;a:12:{i:1;s:1:\"3\";i:2;s:1:\"3\";i:3;s:1:\"3\";i:4;s:1:\"3\";i:5;s:1:\"3\";i:6;s:1:\"3\";i:7;s:1:\"3\";i:8;s:1:\"3\";i:9;s:1:\"3\";i:10;s:1:\"3\";i:11;s:1:\"3\";i:12;s:1:\"3\";}i:196;a:12:{i:1;s:1:\"0\";i:2;s:1:\"0\";i:3;s:1:\"0\";i:4;s:1:\"0\";i:5;s:1:\"0\";i:6;s:1:\"0\";i:7;s:1:\"0\";i:8;s:1:\"0\";i:9;s:1:\"0\";i:10;s:1:\"0\";i:11;s:1:\"0\";i:12;s:1:\"0\";}i:197;a:12:{i:1;s:1:\"0\";i:2;s:1:\"0\";i:3;s:1:\"0\";i:4;s:1:\"0\";i:5;s:1:\"0\";i:6;s:1:\"0\";i:7;s:1:\"0\";i:8;s:1:\"0\";i:9;s:1:\"0\";i:10;s:1:\"0\";i:11;s:1:\"0\";i:12;s:1:\"0\";}i:198;a:12:{i:1;s:1:\"0\";i:2;s:1:\"0\";i:3;s:1:\"0\";i:4;s:1:\"0\";i:5;s:1:\"0\";i:6;s:1:\"0\";i:7;s:1:\"0\";i:8;s:1:\"0\";i:9;s:1:\"0\";i:10;s:1:\"0\";i:11;s:1:\"0\";i:12;s:1:\"0\";}i:199;a:12:{i:1;s:1:\"0\";i:2;s:1:\"0\";i:3;s:1:\"0\";i:4;s:1:\"0\";i:5;s:1:\"0\";i:6;s:1:\"0\";i:7;s:1:\"0\";i:8;s:1:\"0\";i:9;s:1:\"0\";i:10;s:1:\"0\";i:11;s:1:\"0\";i:12;s:1:\"0\";}}', 'a:3:{s:6:\"level1\";s:2:\"27\";s:6:\"level2\";s:2:\"25\";s:6:\"level3\";s:0:\"\";}', 0, NULL, NULL, '23-11-2021 11:02:49'),
(16, 24, 30, '093083', 25, 7, 17, 3, '120000.00', '0.00', 1, 'Enter role description here..', '2021-11-23', 0, '', '', 0, 0, '', 0, 'Enter staff bio here..', 0, '', '', '', '', '', '', 0, '', '', '', NULL, '', '', '', '', 0, '0', '0', 0, 0, '2021', 0, 1, '0.00', 1, NULL, '', NULL, 0, NULL, NULL, '23-11-2021 11:07:28'),
(17, 24, 31, '370549', 30, 7, 18, 3, '0.00', '0.00', 1, 'Enter role description here..', '2021-11-23', 0, '', '', 0, 0, '', 0, 'Enter staff bio here..', 0, '', '', '', '', '', '', 0, '', '', '', NULL, '', '', '', '', 0, '0', '0', 0, 0, '2021', 0, 1, '0.00', 1, 'a:6:{i:194;s:2:\"50\";i:195;s:3:\"100\";i:196;s:2:\"84\";i:197;s:3:\"108\";i:198;s:2:\"96\";i:199;s:2:\"72\";}', 'a:4:{i:194;a:12:{i:1;s:1:\"3\";i:2;s:1:\"3\";i:3;s:1:\"3\";i:4;s:1:\"3\";i:5;s:1:\"3\";i:6;s:1:\"3\";i:7;s:1:\"3\";i:8;s:1:\"3\";i:9;s:1:\"3\";i:10;s:1:\"3\";i:11;s:1:\"3\";i:12;s:1:\"3\";}i:197;a:12:{i:1;s:1:\"9\";i:2;s:1:\"9\";i:3;s:1:\"9\";i:4;s:1:\"9\";i:5;s:1:\"9\";i:6;s:1:\"9\";i:7;s:1:\"9\";i:8;s:1:\"9\";i:9;s:1:\"9\";i:10;s:1:\"9\";i:11;s:1:\"9\";i:12;s:1:\"9\";}i:198;a:12:{i:1;s:1:\"8\";i:2;s:1:\"8\";i:3;s:1:\"8\";i:4;s:1:\"8\";i:5;s:1:\"8\";i:6;s:1:\"8\";i:7;s:1:\"8\";i:8;s:1:\"8\";i:9;s:1:\"8\";i:10;s:1:\"8\";i:11;s:1:\"8\";i:12;s:1:\"8\";}s:16:\"pause_date_start\";a:1:{i:0;s:1:\"0\";}}', 'a:3:{s:6:\"level1\";s:2:\"30\";s:6:\"level2\";s:2:\"25\";s:6:\"level3\";s:0:\"\";}', 0, '', '', '23-11-2021 11:11:44'),
(18, 24, 32, '300828', 28, 7, 17, 3, '0.00', '0.00', 1, 'Enter role description here..', '2021-12-08', 0, '', '', 0, 0, '', 0, 'Enter staff bio here..', 0, '', '', '', '', '', '', 0, '', '', '', NULL, '', '', '', '', 0, '0', '0', 0, 0, '2021', 0, 1, '0.00', 1, '', '', NULL, 0, NULL, NULL, '08-12-2021 04:37:24'),
(19, 24, 33, '430980', 25, 7, 18, 3, '50000.00', '0.00', 1, 'Enter role description here..', '2020-01-01', 0, '', '', 0, 0, '', 0, 'Enter staff bio here..', 0, '', '', '', '', '', '', 0, '', '', '', 'en', '', '', '', '', 0, '0', '0', 0, 0, '2021', 0, 1, '0.00', 1, '', '', NULL, 0, NULL, NULL, '08-12-2021 08:38:45'),
(20, 24, 34, '632999', 25, 7, 17, 3, '50000.00', '0.00', 1, 'Enter role description here..', '2020-01-08', 0, '', '', 0, 0, '', 0, 'Enter staff bio here..', 0, '', '', '', '', '', '', 0, '', '', '', 'en', '', '', '', '', 0, '0', '0', 0, 0, '2021', 0, 1, '0.00', 1, '', '', NULL, 0, NULL, NULL, '08-12-2021 09:57:46'),
(21, 24, 35, '085405', 25, 7, 18, 3, '0.00', '0.00', 1, 'Enter role description here..', '2021-08-01', 0, '', '', 0, 0, '', 0, 'Enter staff bio here..', 0, '', '', '', '', '', '', 0, '', '', '', 'en', '', '', '', '', 0, '0', '0', 0, 0, '2021', 0, 1, '0.00', 1, '', '', NULL, 0, NULL, NULL, '08-12-2021 10:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `ci_erp_users_role`
--

CREATE TABLE `ci_erp_users_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(200) DEFAULT NULL,
  `role_access` varchar(200) DEFAULT NULL,
  `role_resources` text DEFAULT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_erp_users_role`
--

INSERT INTO `ci_erp_users_role` (`role_id`, `role_name`, `role_access`, `role_resources`, `created_at`) VALUES
(1, 'Super Admin', '1', '0,1,2,4,5,3,6,7,8,9', '09-05-2021 06:36:23'),
(2, 'Normal Role', '2', '0,1,4,3,6,7,8,9', '09-05-2021 06:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `ci_estimates`
--

CREATE TABLE `ci_estimates` (
  `estimate_id` int(111) NOT NULL,
  `estimate_number` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `project_id` int(111) NOT NULL,
  `estimate_month` varchar(255) DEFAULT NULL,
  `estimate_date` varchar(255) NOT NULL,
  `estimate_due_date` varchar(255) NOT NULL,
  `sub_total_amount` decimal(65,2) NOT NULL DEFAULT 0.00,
  `discount_type` varchar(11) NOT NULL,
  `discount_figure` decimal(65,2) NOT NULL DEFAULT 0.00,
  `total_tax` decimal(65,2) NOT NULL DEFAULT 0.00,
  `tax_type` varchar(100) DEFAULT NULL,
  `total_discount` decimal(65,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(65,2) NOT NULL DEFAULT 0.00,
  `estimate_note` mediumtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_estimates`
--

INSERT INTO `ci_estimates` (`estimate_id`, `estimate_number`, `company_id`, `client_id`, `project_id`, `estimate_month`, `estimate_date`, `estimate_due_date`, `sub_total_amount`, `discount_type`, `discount_figure`, `total_tax`, `tax_type`, `total_discount`, `grand_total`, `estimate_note`, `status`, `payment_method`, `created_at`) VALUES
(5, '652007', 2, 11, 1, '2021-06', '2021-06-18', '2021-06-18', '128.01', '2', '3.00', '10.24', '114', '3.84', '134.41', 'lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt', 1, 0, '17-06-2021 05:04:24'),
(6, '970576', 2, 11, 1, '2021-06', '2021-06-20', '2021-06-20', '12.00', '1', '0.00', '1.20', '111', '0.00', '13.20', 'asdasdsa', 0, 0, '19-06-2021 06:46:11'),
(7, '928811', 2, 11, 1, '2021-06', '2021-06-24', '2021-06-25', '20.00', '1', '0.00', '2.00', '111', '0.00', '22.00', 'sdfdfad', 2, 0, '22-06-2021 06:39:08');

-- --------------------------------------------------------

--
-- Table structure for table `ci_estimates_items`
--

CREATE TABLE `ci_estimates_items` (
  `estimate_item_id` int(111) NOT NULL,
  `estimate_id` int(111) NOT NULL,
  `project_id` int(111) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_qty` varchar(255) NOT NULL,
  `item_unit_price` decimal(65,2) NOT NULL DEFAULT 0.00,
  `item_sub_total` decimal(65,2) NOT NULL DEFAULT 0.00,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_estimates_items`
--

INSERT INTO `ci_estimates_items` (`estimate_item_id`, `estimate_id`, `project_id`, `item_name`, `item_qty`, `item_unit_price`, `item_sub_total`, `created_at`) VALUES
(1, 1, 1, 'Invest Management', '1', '512.00', '512.00', '15-05-2021 14:19:12'),
(2, 2, 2, '6 months premium support', '1', '500.00', '500.00', '15-05-2021 14:23:05'),
(3, 2, 2, 'Front-end Development', '1', '200.00', '200.00', '15-05-2021 14:23:05'),
(4, 3, 2, 'UX Research', '1', '150.00', '150.00', '15-05-2021 14:24:02'),
(5, 3, 2, 'UX Design', '1', '180.00', '180.00', '15-05-2021 14:24:02'),
(6, 4, 2, 'Search Engines Optimization', '1', '250.00', '250.00', '15-05-2021 15:20:10'),
(8, 5, 1, 'Test12', '1', '128.01', '128.01', '17-06-2021 17:04:24'),
(9, 2, 2, 'Development 2', '1', '14.00', '14.00', '17-06-2021 17:23:26'),
(10, 6, 1, 'asdasdsa', '1', '12.00', '12.00', '19-06-2021 18:46:11'),
(11, 7, 1, 'asdasdsa', '1', '20.00', '20.00', '22-06-2021 06:39:08');

-- --------------------------------------------------------

--
-- Table structure for table `ci_events`
--

CREATE TABLE `ci_events` (
  `event_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `event_title` varchar(255) NOT NULL,
  `event_date` varchar(255) NOT NULL,
  `event_time` varchar(255) NOT NULL,
  `event_note` mediumtext NOT NULL,
  `event_color` varchar(200) NOT NULL,
  `is_show_calendar` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_events`
--

INSERT INTO `ci_events` (`event_id`, `company_id`, `employee_id`, `event_title`, `event_date`, `event_time`, `event_note`, `event_color`, `is_show_calendar`, `created_at`) VALUES
(1, 2, '0,3,5', 'asdsa', '2021-08-01', '02:15', 'sdfdsfd', '#7267EF', 0, '31-07-2021 05:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `ci_finance_accounts`
--

CREATE TABLE `ci_finance_accounts` (
  `account_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_balance` decimal(65,2) NOT NULL DEFAULT 0.00,
  `account_opening_balance` decimal(65,2) NOT NULL DEFAULT 0.00,
  `account_number` varchar(255) NOT NULL,
  `branch_code` varchar(255) NOT NULL,
  `bank_branch` text NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_finance_accounts`
--

INSERT INTO `ci_finance_accounts` (`account_id`, `company_id`, `account_name`, `account_balance`, `account_opening_balance`, `account_number`, `branch_code`, `bank_branch`, `created_at`) VALUES
(1, 2, 'Sberbank', '10000000.00', '10000000.00', 'RU89652373', 'R8526978', 'Moscow, Russia', '15-05-2021 04:40:24'),
(2, 2, 'PromSvyaz Bank', '10000000.00', '10000000.00', 'RU85963217', 'R785635', 'Moscow, Russia', '15-05-2021 04:41:11'),
(3, 2, 'UniCredit Bank', '10000000.00', '10000000.00', 'RU85296324', 'R8526391', 'Moscow, Russia', '15-05-2021 04:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `ci_finance_entity`
--

CREATE TABLE `ci_finance_entity` (
  `entity_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `type` varchar(15) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_finance_membership_invoices`
--

CREATE TABLE `ci_finance_membership_invoices` (
  `membership_invoice_id` int(11) NOT NULL,
  `invoice_id` varchar(50) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `membership_id` int(11) NOT NULL,
  `subscription_id` varchar(50) DEFAULT NULL,
  `membership_type` varchar(200) NOT NULL,
  `subscription` varchar(200) NOT NULL,
  `invoice_month` varchar(255) DEFAULT NULL,
  `membership_price` decimal(65,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(200) NOT NULL,
  `transaction_date` varchar(200) NOT NULL,
  `description` mediumtext NOT NULL,
  `receipt_url` longtext DEFAULT NULL,
  `source_info` varchar(10) DEFAULT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_finance_membership_invoices`
--

INSERT INTO `ci_finance_membership_invoices` (`membership_invoice_id`, `invoice_id`, `company_id`, `membership_id`, `subscription_id`, `membership_type`, `subscription`, `invoice_month`, `membership_price`, `payment_method`, `transaction_date`, `description`, `receipt_url`, `source_info`, `created_at`) VALUES
(4, 'txn_1IrrDtJck1huBCXGA8vOl02B', 2, 6, '100585963', 'Pro Plan', '2', '2021-05', '29.55', 'Stripe', '2021-05-16 05:10:07', 'Free server unlimited approx 255k+ Premium collection', 'https://pay.stripe.com/receipts/acct_1IrqtWJck1huBCXG/ch_1IrrDtJck1huBCXGqfwL3dq1/rcpt_JUqvscRiEiwQefQT3A2WohxrEf7vOIx', 'visa', '2021-05-16 05:10:07'),
(6, 'WBXJXJ8893AY6', 2, 6, '100585963', 'Pro Plan', '2', '2021-05', '29.55', 'PayPal', '2021-05-17 04:07:01', 'Free server unlimited approx 255k+ Premium collection', 'paypal invoice', 'paypal', '2021-05-17 04:07:01'),
(21, 'pay_Hg4KYzYKLmCtsc', 2, 6, '100585963', 'Pro Plan', '2', '2021-08', '2167.79', 'Razorpay', '2021-08-01 04:40:12', 'Free server unlimited approx 255k+ Premium collection', 'razorpay invoice', 'razorpay', '2021-08-01 04:40:12'),
(27, 'txn_3JLZ7WJck1huBCXG0czFTGaT', 2, 6, '100585963', 'Pro Plan', '2', '2021-08', '34.55', 'Stripe', '2021-08-06 03:54:19', 'Free server unlimited approx 255k+ Premium collection', 'https://pay.stripe.com/receipts/acct_1IrqtWJck1huBCXG/ch_3JLZ7WJck1huBCXG0WBWgahw/rcpt_JzYDEFpfQnT5IbtgDYZzQqclUFXTht7', 'visa', '2021-08-06 03:54:19'),
(28, 'txn_3JLZ8lJck1huBCXG0jFdlOlk', 2, 2, '100142725', 'Silver Plan', '3', '2021-08', '109.88', 'Stripe', '2021-08-06 03:55:36', 'Free server unlimited approx 255k+', 'https://pay.stripe.com/receipts/acct_1IrqtWJck1huBCXG/ch_3JLZ8lJck1huBCXG0Tskxwc1/rcpt_JzYFbYHfrpdnF1ZzNDYxQDAHqLcJ0So', 'visa', '2021-08-06 03:55:36'),
(29, 'WBXJXJ8893AY6', 2, 6, '100585963', 'Pro Plan', '2', '2021-08', '32.51', 'PayPal', '2021-08-06 03:56:16', 'Free server unlimited approx 255k+ Premium collection', 'paypal invoice', 'paypal', '2021-08-06 03:56:16'),
(30, 'WBXJXJ8893AY6', 2, 2, '100142725', 'Silver Plan', '3', '2021-08', '109.88', 'PayPal', '2021-08-06 03:59:00', 'Free server unlimited approx 255k+', 'paypal invoice', 'paypal', '2021-08-06 03:59:00'),
(31, 'WBXJXJ8893AY6', 2, 6, '100585963', 'Pro Plan', '2', '2021-08', '34.55', 'PayPal', '2021-08-06 04:00:15', 'Free server unlimited approx 255k+ Premium collection', 'paypal invoice', 'paypal', '2021-08-06 04:00:15'),
(32, 'WBXJXJ8893AY6', 2, 2, '100142725', 'Silver Plan', '3', '2021-08', '3.30', 'PayPal', '2021-08-06 06:36:42', 'Free server unlimited approx 255k+', 'paypal invoice', 'paypal', '2021-08-06 06:36:42'),
(33, 'WBXJXJ8893AY6', 2, 6, '100585963', 'Pro Plan', '2', '2021-08', '2.20', 'PayPal', '2021-08-06 06:38:48', 'Free server unlimited approx 255k+ Premium collection', 'paypal invoice', 'paypal', '2021-08-06 06:38:48'),
(34, '919086271', 2, 2, '100142725', 'Silver Plan', '3', '2021-08', '1393.66', 'Paystack', '2021-08-08 11:21:09', 'Free server unlimited approx 255k+', 'paystack invoice', 'paystack', '2021-08-08 11:21:09'),
(35, '287471808', 2, 6, '100585963', 'Pro Plan', '2', '2021-09', '929.10', 'Paystack', '2021-08-08 11:21:31', 'Free server unlimited approx 255k+ Premium collection', 'paystack invoice', 'paystack', '2021-08-08 11:21:31'),
(36, '280226020', 2, 2, '100142725', 'Silver Plan', '3', '2021-09', '1393.66', 'Paystack', '2021-08-08 11:25:56', 'Free server unlimited approx 255k+', 'paystack invoice', 'paystack', '2021-08-08 11:25:56'),
(37, '541452556', 2, 6, '100585963', 'Pro Plan', '2', '2021-10', '844.64', 'Flutterwave', '2021-08-09 05:43:34', 'Free server unlimited approx 255k+ Premium collection', 'Flutterwave invoice', 'Flutterwav', '2021-08-09 05:43:34'),
(38, '53984043', 2, 2, '100142725', 'Silver Plan', '3', '2021-10', '1266.96', 'Flutterwave', '2021-08-09 05:44:44', 'Free server unlimited approx 255k+', 'Flutterwave invoice', 'Flutterwav', '2021-08-09 05:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `ci_finance_transactions`
--

CREATE TABLE `ci_finance_transactions` (
  `transaction_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `transaction_date` varchar(255) NOT NULL,
  `transaction_type` varchar(100) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `entity_type` varchar(100) DEFAULT NULL,
  `entity_category_id` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `amount` decimal(65,2) NOT NULL DEFAULT 0.00,
  `dr_cr` enum('dr','cr') NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `reference` varchar(100) DEFAULT NULL,
  `attachment_file` varchar(100) DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_finance_transactions`
--

INSERT INTO `ci_finance_transactions` (`transaction_id`, `account_id`, `company_id`, `staff_id`, `transaction_date`, `transaction_type`, `entity_id`, `entity_type`, `entity_category_id`, `description`, `amount`, `dr_cr`, `payment_method_id`, `reference`, `attachment_file`, `created_at`) VALUES
(1, 2, 2, 2, '2021-05-16', 'income', 4, 'payer', 157, 'lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt', '1500.00', 'cr', 93, 'R8596321', '1.png', '15-05-2021 06:17:14'),
(2, 2, 2, 2, '2021-05-16', 'expense', 5, 'payee', 152, 'lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt', '1400.00', 'dr', 93, 'E8596324', '1.png', '15-05-2021 06:18:48'),
(3, 3, 2, 2, '2021-05-16', 'expense', 3, 'payee', 155, 'lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do', '1200.00', 'dr', 95, 'B785925', '1.png', '15-05-2021 06:19:30'),
(4, 1, 2, 2, '2021-05-16', 'income', 7, 'payer', 158, 'lorem ipsum dolor sit amet, consectetur adipisicing elit', '1300.00', 'cr', 99, 'PY852963', '1.png', '15-05-2021 06:20:14');

-- --------------------------------------------------------

--
-- Table structure for table `ci_forms`
--

CREATE TABLE `ci_forms` (
  `forms_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `supervisor_id` int(11) NOT NULL,
  `form_name` varchar(255) DEFAULT NULL,
  `json_data` text DEFAULT NULL,
  `assigned_to` text DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_forms`
--

INSERT INTO `ci_forms` (`forms_id`, `company_id`, `category_id`, `supervisor_id`, `form_name`, `json_data`, `assigned_to`, `status`, `created_at`) VALUES
(2, 24, 1, 28, 'Test Form', '[{\"type\":\"text\",\"required\":true,\"label\":\"Text Field 1\",\"className\":\"form-control\",\"name\":\"text-1642442352227-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"Text Field 2\",\"className\":\"form-control\",\"name\":\"text-1642442359468-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"text\",\"required\":true,\"label\":\"Text Field 3\",\"className\":\"form-control\",\"name\":\"text-1642442362054-0\",\"access\":false,\"subtype\":\"text\"}]', '0,25,26,27', 0, '17-01-2022'),
(3, 24, 1, 26, 'Off site work form TEST 2', '[{\"type\":\"text\",\"required\":false,\"label\":\"Employee Name\",\"className\":\"form-control\",\"name\":\"text-1642443338900-0\",\"access\":false,\"subtype\":\"text\"},{\"type\":\"date\",\"required\":true,\"label\":\"Date Field\",\"className\":\"form-control\",\"name\":\"date-1642443373347-0\",\"access\":false},{\"type\":\"select\",\"required\":false,\"label\":\"Location Worked\",\"className\":\"form-control\",\"name\":\"select-1642443383677-0\",\"access\":false,\"multiple\":false,\"values\":[{\"label\":\"One\",\"value\":\"City 1\",\"selected\":true},{\"label\":\"Two\",\"value\":\"City 2\",\"selected\":false},{\"label\":\"Three\",\"value\":\"City 3\",\"selected\":false}]},{\"type\":\"checkbox-group\",\"required\":false,\"label\":\"How many hours did you work\",\"description\":\"Write number of hours\",\"toggle\":false,\"inline\":false,\"name\":\"checkbox-group-1642467614622-0\",\"access\":true,\"other\":true,\"role\":\"1\",\"values\":[{\"label\":\"One Hour\",\"value\":\"\",\"selected\":true},{\"label\":\"Two Hour\",\"value\":\"\",\"selected\":true}]},{\"type\":\"text\",\"required\":false,\"label\":\"Other Comment\",\"className\":\"form-control\",\"name\":\"text-1642520280298-0\",\"access\":false,\"subtype\":\"text\"}]', '0,25', 0, '17-01-2022');

-- --------------------------------------------------------

--
-- Table structure for table `ci_form_completed_fields`
--

CREATE TABLE `ci_form_completed_fields` (
  `completed_field_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `field_key` varchar(255) DEFAULT NULL,
  `field_value` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_form_completed_fields`
--

INSERT INTO `ci_form_completed_fields` (`completed_field_id`, `company_id`, `form_id`, `staff_id`, `field_key`, `field_value`, `status`, `created_at`) VALUES
(1, 24, 3, 26, 'text-1642443338900-0', 'Mary Lisbon', 0, '17-01-2022'),
(2, 24, 3, 26, 'date-1642443373347-0', '2022-01-18', 0, '17-01-2022'),
(3, 24, 3, 26, 'select-1642443383677-0', 'City 3', 0, '17-01-2022'),
(4, 24, 3, 26, 'text-1642443338900-0', '', 0, '17-01-2022'),
(5, 24, 3, 26, 'date-1642443373347-0', '2022-01-17', 0, '17-01-2022'),
(6, 24, 3, 26, 'select-1642443383677-0', 'City 1', 0, '17-01-2022');

-- --------------------------------------------------------

--
-- Table structure for table `ci_form_fields`
--

CREATE TABLE `ci_form_fields` (
  `form_field_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `field_type` varchar(200) NOT NULL,
  `field_key` varchar(200) NOT NULL,
  `field_label` varchar(200) DEFAULT NULL,
  `sort_order` int(11) NOT NULL,
  `json_data` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_form_fields`
--

INSERT INTO `ci_form_fields` (`form_field_id`, `company_id`, `form_id`, `field_type`, `field_key`, `field_label`, `sort_order`, `json_data`, `status`, `created_at`) VALUES
(1, 24, 2, 'text', 'text-1642442352227-0', 'Text Field 1', 0, '{\"type\":\"text\",\"required\":true,\"label\":\"Text Field 1\",\"className\":\"form-control\",\"name\":\"text-1642442352227-0\",\"access\":false,\"subtype\":\"text\"}', 0, '17-01-2022'),
(2, 24, 2, 'text', 'text-1642442359468-0', 'Text Field 2', 1, '{\"type\":\"text\",\"required\":true,\"label\":\"Text Field 2\",\"className\":\"form-control\",\"name\":\"text-1642442359468-0\",\"access\":false,\"subtype\":\"text\"}', 0, '17-01-2022'),
(3, 24, 2, 'text', 'text-1642442362054-0', 'Text Field 3', 2, '{\"type\":\"text\",\"required\":true,\"label\":\"Text Field 3\",\"className\":\"form-control\",\"name\":\"text-1642442362054-0\",\"access\":false,\"subtype\":\"text\"}', 0, '17-01-2022'),
(20, 24, 3, 'text', 'text-1642443338900-0', 'Employee Name', 0, '{\"type\":\"text\",\"required\":false,\"label\":\"Employee Name\",\"className\":\"form-control\",\"name\":\"text-1642443338900-0\",\"access\":false,\"subtype\":\"text\"}', 0, '18-01-2022'),
(21, 24, 3, 'date', 'date-1642443373347-0', 'Date Field', 1, '{\"type\":\"date\",\"required\":true,\"label\":\"Date Field\",\"className\":\"form-control\",\"name\":\"date-1642443373347-0\",\"access\":false}', 0, '18-01-2022'),
(22, 24, 3, 'select', 'select-1642443383677-0', 'Location Worked', 2, '{\"type\":\"select\",\"required\":false,\"label\":\"Location Worked\",\"className\":\"form-control\",\"name\":\"select-1642443383677-0\",\"access\":false,\"multiple\":false,\"values\":[{\"label\":\"One\",\"value\":\"City 1\",\"selected\":true},{\"label\":\"Two\",\"value\":\"City 2\",\"selected\":false},{\"label\":\"Three\",\"value\":\"City 3\",\"selected\":false}]}', 0, '18-01-2022'),
(23, 24, 3, 'checkbox-group', 'checkbox-group-1642467614622-0', 'How many hours did you work', 3, '{\"type\":\"checkbox-group\",\"required\":false,\"label\":\"How many hours did you work\",\"description\":\"Write number of hours\",\"toggle\":false,\"inline\":false,\"name\":\"checkbox-group-1642467614622-0\",\"access\":true,\"other\":true,\"role\":\"1\",\"values\":[{\"label\":\"One Hour\",\"value\":\"\",\"selected\":true},{\"label\":\"Two Hour\",\"value\":\"\",\"selected\":true}]}', 0, '18-01-2022'),
(24, 24, 3, 'text', 'text-1642520280298-0', 'Other Comment', 4, '{\"type\":\"text\",\"required\":false,\"label\":\"Other Comment\",\"className\":\"form-control\",\"name\":\"text-1642520280298-0\",\"access\":false,\"subtype\":\"text\"}', 0, '18-01-2022');

-- --------------------------------------------------------

--
-- Table structure for table `ci_frontend_content`
--

CREATE TABLE `ci_frontend_content` (
  `frontend_id` int(11) NOT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `about_short` text DEFAULT NULL,
  `fb_profile` text DEFAULT NULL,
  `twitter_profile` text DEFAULT NULL,
  `linkedin_profile` text DEFAULT NULL,
  `updated_at` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_frontend_content`
--

INSERT INTO `ci_frontend_content` (`frontend_id`, `youtube_url`, `about_short`, `fb_profile`, `twitter_profile`, `linkedin_profile`, `updated_at`) VALUES
(1, 'https://vimeo.com/649568494', '360HRIS is  a Human Resource Information System (HRIS) that makes it effortless for you to manage your employees and continue running your business.', 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.linkedin.com/', '2021-10-14');

-- --------------------------------------------------------

--
-- Table structure for table `ci_holidays`
--

CREATE TABLE `ci_holidays` (
  `holiday_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `event_name` varchar(200) NOT NULL,
  `description` mediumtext NOT NULL,
  `start_date` varchar(200) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `is_publish` tinyint(1) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_holidays`
--

INSERT INTO `ci_holidays` (`holiday_id`, `company_id`, `event_name`, `description`, `start_date`, `end_date`, `is_publish`, `created_at`) VALUES
(1, 2, 'kljk', 'jkjkjklkl', '2021-08-01', '2021-08-01', 1, '31-07-2021 05:19:17'),
(2, 24, 'Christmas', 'Christmas', '2021-12-25', '2021-12-25', 1, '23-11-2021 03:46:09'),
(3, 24, 'New Years Eve', 'New Years Eve', '2021-12-31', '2021-12-31', 1, '09-12-2021 06:16:22'),
(4, 24, 'Christmas Eve', 'Christmas Eve', '2021-12-24', '2021-12-24', 1, '09-12-2021 06:20:25');

-- --------------------------------------------------------

--
-- Table structure for table `ci_incidents`
--

CREATE TABLE `ci_incidents` (
  `incident_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(200) NOT NULL,
  `incident_type_id` int(200) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `incident_date` varchar(200) NOT NULL,
  `incident_time` varchar(200) NOT NULL,
  `incident_file` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `notify_send_to` text DEFAULT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_invoices`
--

CREATE TABLE `ci_invoices` (
  `invoice_id` int(111) NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `project_id` int(111) NOT NULL,
  `invoice_month` varchar(255) DEFAULT NULL,
  `invoice_date` varchar(255) NOT NULL,
  `invoice_due_date` varchar(255) NOT NULL,
  `sub_total_amount` decimal(65,2) NOT NULL DEFAULT 0.00,
  `discount_type` varchar(11) NOT NULL,
  `discount_figure` decimal(65,2) NOT NULL DEFAULT 0.00,
  `total_tax` decimal(65,2) NOT NULL DEFAULT 0.00,
  `tax_type` varchar(100) DEFAULT NULL,
  `total_discount` decimal(65,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(65,2) NOT NULL DEFAULT 0.00,
  `invoice_note` mediumtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `payment_date` varchar(100) DEFAULT NULL,
  `deposit_to` int(11) NOT NULL,
  `with_holding_taxid` int(11) NOT NULL,
  `with_holding_tax` decimal(65,2) NOT NULL,
  `pay_full` int(11) NOT NULL,
  `total_amount` decimal(65,2) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_invoices`
--

INSERT INTO `ci_invoices` (`invoice_id`, `invoice_number`, `company_id`, `client_id`, `project_id`, `invoice_month`, `invoice_date`, `invoice_due_date`, `sub_total_amount`, `discount_type`, `discount_figure`, `total_tax`, `tax_type`, `total_discount`, `grand_total`, `invoice_note`, `status`, `payment_method`, `payment_date`, `deposit_to`, `with_holding_taxid`, `with_holding_tax`, `pay_full`, `total_amount`, `created_at`) VALUES
(1, '546081', 2, 11, 1, '2021-05', '2021-05-26', '2021-06-04', '512.00', '1', '5.00', '40.96', '114', '5.00', '547.96', 'lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 1, 93, NULL, 0, 0, '0.00', 0, '0.00', '15-05-2021 02:19:12'),
(2, '140249', 2, 9, 2, '2021-05', '2021-05-30', '2021-06-04', '700.00', '2', '5.00', '12.00', '113', '35.00', '781.94', 'lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 0, 95, '2021-08-08', 2, 112, '37.24', 1, '781.94', '15-05-2021 02:23:05'),
(3, '236984', 2, 9, 2, '2021-06', '2021-06-04', '2021-06-15', '330.00', '1', '10.00', '26.40', '114', '10.00', '346.40', 'lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 1, 95, NULL, 0, 0, '0.00', 0, '0.00', '15-05-2021 02:24:02'),
(4, '195233', 2, 9, 2, '2021-06', '2021-06-10', '2021-06-23', '370.00', '2', '10.00', '12.00', '113', '37.00', '345.00', 'lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 0, 0, NULL, 0, 0, '0.00', 0, '0.00', '15-05-2021 03:20:10'),
(8, '652007', 2, 11, 1, '2021-06', '2021-06-18', '2021-06-18', '128.01', '2', '3.00', '10.24', '114', '3.84', '134.41', 'lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt', 1, 93, NULL, 0, 0, '0.00', 0, '0.00', '19-06-2021 09:58:37'),
(9, '051872', 2, 11, 1, '2021-08', '2021-08-08', '2021-08-08', '125.00', '1', '5.00', '6.25', '112', '5.00', '126.25', 'jkhkjhkhk', 0, 0, '08-08-2021 02:12:12', 0, 0, '0.00', 0, '126.25', '08-08-2021 02:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `ci_invoices_items`
--

CREATE TABLE `ci_invoices_items` (
  `invoice_item_id` int(111) NOT NULL,
  `invoice_id` int(111) NOT NULL,
  `project_id` int(111) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_qty` varchar(255) NOT NULL,
  `item_unit_price` decimal(65,2) NOT NULL DEFAULT 0.00,
  `item_sub_total` decimal(65,2) NOT NULL DEFAULT 0.00,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_invoices_items`
--

INSERT INTO `ci_invoices_items` (`invoice_item_id`, `invoice_id`, `project_id`, `item_name`, `item_qty`, `item_unit_price`, `item_sub_total`, `created_at`) VALUES
(1, 1, 1, 'Invest Management', '1', '512.00', '512.00', '15-05-2021 14:19:12'),
(2, 2, 2, '6 months premium support', '1', '500.00', '500.00', '15-05-2021 14:23:05'),
(3, 2, 2, 'Front-end Development', '1', '200.00', '200.00', '15-05-2021 14:23:05'),
(4, 3, 2, 'UX Research', '1', '150.00', '150.00', '15-05-2021 14:24:02'),
(5, 3, 2, 'UX Design', '1', '180.00', '180.00', '15-05-2021 14:24:02'),
(6, 4, 2, 'Search Engines Optimization', '1', '250.00', '250.00', '15-05-2021 15:20:10'),
(7, 4, 2, 'Website Development', '1', '120.00', '120.00', '15-05-2021 15:20:10'),
(12, 7, 1, 'Test12', '1', '128.01', '128.01', '19-06-2021 08:31:49'),
(13, 8, 1, 'Test12', '1', '128.01', '128.01', '19-06-2021 09:58:37'),
(14, 9, 1, 'jkhkj', '1', '125.00', '125.00', '08-08-2021 14:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `ci_kiosk`
--

CREATE TABLE `ci_kiosk` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `sign_in_time` varchar(20) DEFAULT NULL,
  `sign_out_time` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_kiosk`
--

INSERT INTO `ci_kiosk` (`id`, `user_id`, `date`, `sign_in_time`, `sign_out_time`, `created_at`, `updated_at`) VALUES
(1, 26, '2022-01-22', '11:16 AM', '11:16 AM', '2022-01-23 00:16:08', '2022-01-23 00:16:34');

-- --------------------------------------------------------

--
-- Table structure for table `ci_languages`
--

CREATE TABLE `ci_languages` (
  `language_id` int(111) NOT NULL,
  `language_name` varchar(255) NOT NULL,
  `language_code` varchar(255) NOT NULL,
  `language_flag` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_languages`
--

INSERT INTO `ci_languages` (`language_id`, `language_name`, `language_code`, `language_flag`, `is_active`, `created_at`) VALUES
(1, 'English', 'en', 'en.gif', 1, '09-05-2021 06:36:23'),
(3, 'Russian', 'ru', 'ru.gif', 1, '14-05-2021 08:22:21'),
(4, 'Dutch', 'nl', 'nl.gif', 1, '14-05-2021 09:39:11'),
(5, 'Portuguese', 'br', 'br.gif', 0, '15-05-2021 12:28:41'),
(6, 'Vietnamese', 'vn', 'vn.gif', 0, '15-05-2021 12:29:04'),
(7, 'Spanish', 'es', 'es.gif', 1, '15-05-2021 12:30:13'),
(8, 'Italiano', 'it', 'it.gif', 1, '15-05-2021 12:30:54'),
(9, 'Turkish', 'tr', 'tr.gif', 1, '15-05-2021 12:31:21'),
(10, 'French', 'fr', 'fr.gif', 1, '15-05-2021 12:31:39'),
(11, 'Chinese', 'cn', 'cn.gif', 1, '15-05-2021 12:31:59');

-- --------------------------------------------------------

--
-- Table structure for table `ci_leads`
--

CREATE TABLE `ci_leads` (
  `lead_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `gender` int(11) NOT NULL,
  `address_1` text DEFAULT NULL,
  `address_2` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `country` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_leads`
--

INSERT INTO `ci_leads` (`lead_id`, `company_id`, `first_name`, `last_name`, `email`, `profile_photo`, `contact_number`, `gender`, `address_1`, `address_2`, `city`, `state`, `zipcode`, `country`, `status`, `created_at`) VALUES
(1, 2, 'Thomas', 'Fleming', 'hrd1salesoft@gmail.com', '1.png', '0123456789', 1, '', '', '', '', '', 2, 1, '15-06-2021 01:52:20');

-- --------------------------------------------------------

--
-- Table structure for table `ci_leads_followup`
--

CREATE TABLE `ci_leads_followup` (
  `followup_id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `next_followup` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_leads_followup`
--

INSERT INTO `ci_leads_followup` (`followup_id`, `lead_id`, `company_id`, `next_followup`, `description`, `created_at`) VALUES
(4, 1, 2, '2021-06-15', 'TasDTeasdss', '16-06-2021 08:29:58'),
(5, 1, 2, '2021-06-16', 'TestAbccc', '16-06-2021 08:56:47');

-- --------------------------------------------------------

--
-- Table structure for table `ci_leave_adjustment`
--

CREATE TABLE `ci_leave_adjustment` (
  `adjustment_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `adjust_hours` varchar(200) NOT NULL DEFAULT '0',
  `reason_adjustment` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_leave_adjustment`
--

INSERT INTO `ci_leave_adjustment` (`adjustment_id`, `company_id`, `employee_id`, `leave_type_id`, `adjust_hours`, `reason_adjustment`, `status`, `created_at`) VALUES
(2, 24, 26, 194, '-8.3', 'Test', 1, '17-01-2022 10:41:52'),
(3, 24, 26, 195, '5', 'sickness', 0, '31-01-2022 10:38:13');

-- --------------------------------------------------------

--
-- Table structure for table `ci_leave_applications`
--

CREATE TABLE `ci_leave_applications` (
  `leave_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(222) NOT NULL,
  `leave_type_id` int(222) NOT NULL,
  `from_date` varchar(200) NOT NULL,
  `to_date` varchar(200) NOT NULL,
  `leave_hours` varchar(100) DEFAULT NULL,
  `particular_date` varchar(100) DEFAULT NULL,
  `leave_month` varchar(50) DEFAULT NULL,
  `leave_year` varchar(100) DEFAULT NULL,
  `reason` mediumtext NOT NULL,
  `remarks` mediumtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_half_day` tinyint(1) DEFAULT NULL,
  `leave_attachment` varchar(255) DEFAULT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_leave_applications`
--

INSERT INTO `ci_leave_applications` (`leave_id`, `company_id`, `employee_id`, `leave_type_id`, `from_date`, `to_date`, `leave_hours`, `particular_date`, `leave_month`, `leave_year`, `reason`, `remarks`, `status`, `is_half_day`, `leave_attachment`, `created_at`) VALUES
(13, 24, 33, 194, '2021-12-09', '', '7', '2021-12-08', '12', '2021', '', 'Approved', 2, 0, '', '08-12-2021 08:42:13'),
(17, 24, 34, 194, '2021-12-13', '2021-12-17', '35', '2021-12-08', '12', '2021', '', 'approved', 2, 0, '', '08-12-2021 10:03:08'),
(36, 24, 25, 194, '2022-01-10', '2022-01-10', '7', '2022-01-08', '1', '2022', '', '', 1, 0, '', '08-01-2022 03:59:47'),
(37, 24, 25, 194, '2022-01-11', '2022-01-11', '4', '2022-01-11', '1', '2022', 'test', 'test', 1, 0, '', '08-01-2022 04:01:00'),
(39, 24, 31, 194, '2022-01-11', '2022-01-11', '7', '2022-01-11', '1', '2022', '', 'test', 2, 0, '', '12-01-2022 09:39:53'),
(40, 24, 31, 195, '2022-01-17', '2022-01-17', '7', '2022-01-12', '1', '2022', '', 'test', 2, 0, '', '12-01-2022 10:07:33'),
(41, 24, 31, 196, '2022-01-18', '2022-01-18', '7', '2022-01-12', '1', '2022', 'test', 'test', 2, 0, '', '12-01-2022 10:09:39'),
(42, 24, 31, 197, '2022-01-19', '2022-01-19', '7', '2022-01-12', '1', '2022', 'test', 'test', 2, 0, '', '12-01-2022 10:10:30'),
(43, 24, 31, 199, '2022-01-24', '2022-01-24', '7', '2022-01-12', '1', '2022', 'test', 'test', 2, 0, '', '12-01-2022 10:14:04'),
(44, 24, 31, 198, '2022-01-28', '2022-01-28', '7', '2022-01-12', '1', '2022', 'test', 'test', 2, 0, '', '12-01-2022 10:16:05'),
(45, 24, 34, 194, '2022-01-13', '2022-01-14', '14', '2022-01-13', '1', '2022', '', 'test', 2, 0, '', '13-01-2022 12:32:13'),
(46, 24, 29, 194, '2022-01-13', '2022-01-13', '7', '2022-01-13', '1', '2022', 'test', 'test', 2, 0, '', '13-01-2022 12:43:55'),
(48, 24, 26, 195, '2022-01-31', '2022-01-31', '00', '2022-01-30', '1', '2022', '', 'testing', 2, 0, '', '30-01-2022 10:27:15');

-- --------------------------------------------------------

--
-- Table structure for table `ci_meetings`
--

CREATE TABLE `ci_meetings` (
  `meeting_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `meeting_title` varchar(255) NOT NULL,
  `meeting_date` varchar(255) NOT NULL,
  `meeting_time` varchar(255) NOT NULL,
  `meeting_room` varchar(255) NOT NULL,
  `meeting_note` mediumtext NOT NULL,
  `meeting_color` varchar(200) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_meetings`
--

INSERT INTO `ci_meetings` (`meeting_id`, `company_id`, `employee_id`, `meeting_title`, `meeting_date`, `meeting_time`, `meeting_room`, `meeting_note`, `meeting_color`, `created_at`) VALUES
(1, 2, '0,3,5', 'xcvxc', '2021-11-14', '02:23', 'ff', 'dfgfgdf', '#A226FF', '31-07-2021 05:23:47');

-- --------------------------------------------------------

--
-- Table structure for table `ci_membership`
--

CREATE TABLE `ci_membership` (
  `membership_id` int(11) NOT NULL,
  `subscription_id` varchar(100) DEFAULT NULL,
  `membership_type` varchar(200) NOT NULL,
  `price` decimal(65,2) NOT NULL DEFAULT 0.00,
  `plan_duration` int(11) NOT NULL,
  `total_employees` int(11) NOT NULL DEFAULT 0,
  `plan_icon` varchar(100) DEFAULT NULL,
  `description` mediumtext NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_membership`
--

INSERT INTO `ci_membership` (`membership_id`, `subscription_id`, `membership_type`, `price`, `plan_duration`, `total_employees`, `plan_icon`, `description`, `created_at`) VALUES
(1, '100452187', 'Trial Plan', '0.00', 3, 1000, 'medal-trial.svg', 'Free Plan description goes here..', '09-05-2021 06:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `ci_office_shifts`
--

CREATE TABLE `ci_office_shifts` (
  `office_shift_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `shift_name` varchar(255) NOT NULL,
  `monday_in_time` varchar(222) NOT NULL,
  `monday_out_time` varchar(222) NOT NULL,
  `tuesday_in_time` varchar(222) NOT NULL,
  `tuesday_out_time` varchar(222) NOT NULL,
  `wednesday_in_time` varchar(222) NOT NULL,
  `wednesday_out_time` varchar(222) NOT NULL,
  `thursday_in_time` varchar(222) NOT NULL,
  `thursday_out_time` varchar(222) NOT NULL,
  `friday_in_time` varchar(222) NOT NULL,
  `friday_out_time` varchar(222) NOT NULL,
  `saturday_in_time` varchar(222) NOT NULL,
  `saturday_out_time` varchar(222) NOT NULL,
  `sunday_in_time` varchar(222) NOT NULL,
  `sunday_out_time` varchar(222) NOT NULL,
  `monday_lunch_break` varchar(100) DEFAULT NULL,
  `tuesday_lunch_break` varchar(100) DEFAULT NULL,
  `wednesday_lunch_break` varchar(100) DEFAULT NULL,
  `thursday_lunch_break` varchar(100) DEFAULT NULL,
  `friday_lunch_break` varchar(100) DEFAULT NULL,
  `saturday_lunch_break` varchar(100) DEFAULT NULL,
  `sunday_lunch_break` varchar(100) DEFAULT NULL,
  `monday_lunch_break_out` varchar(100) DEFAULT NULL,
  `tuesday_lunch_break_out` varchar(100) DEFAULT NULL,
  `wednesday_lunch_break_out` varchar(100) DEFAULT NULL,
  `thursday_lunch_break_out` varchar(100) DEFAULT NULL,
  `friday_lunch_break_out` varchar(100) DEFAULT NULL,
  `saturday_lunch_break_out` varchar(100) DEFAULT NULL,
  `sunday_lunch_break_out` varchar(100) DEFAULT NULL,
  `created_at` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_office_shifts`
--

INSERT INTO `ci_office_shifts` (`office_shift_id`, `company_id`, `shift_name`, `monday_in_time`, `monday_out_time`, `tuesday_in_time`, `tuesday_out_time`, `wednesday_in_time`, `wednesday_out_time`, `thursday_in_time`, `thursday_out_time`, `friday_in_time`, `friday_out_time`, `saturday_in_time`, `saturday_out_time`, `sunday_in_time`, `sunday_out_time`, `monday_lunch_break`, `tuesday_lunch_break`, `wednesday_lunch_break`, `thursday_lunch_break`, `friday_lunch_break`, `saturday_lunch_break`, `sunday_lunch_break`, `monday_lunch_break_out`, `tuesday_lunch_break_out`, `wednesday_lunch_break_out`, `thursday_lunch_break_out`, `friday_lunch_break_out`, `saturday_lunch_break_out`, `sunday_lunch_break_out`, `created_at`) VALUES
(1, 2, 'Morning Shift', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:08', '17:25', '', '', '13:00', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15-05-2021 05:15:05'),
(2, 2, 'Second Shift', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '15:00', '', '', '', '', '13:49', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16-05-2021 10:19:42');

-- --------------------------------------------------------

--
-- Table structure for table `ci_official_documents`
--

CREATE TABLE `ci_official_documents` (
  `document_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `license_name` varchar(255) NOT NULL,
  `document_type` varchar(255) NOT NULL,
  `license_no` varchar(200) DEFAULT NULL,
  `expiry_date` varchar(200) DEFAULT NULL,
  `document_file` varchar(255) NOT NULL,
  `created_at` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_payslips`
--

CREATE TABLE `ci_payslips` (
  `payslip_id` int(11) NOT NULL,
  `payslip_key` varchar(200) NOT NULL,
  `company_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `salary_month` varchar(200) NOT NULL,
  `wages_type` int(11) NOT NULL,
  `payslip_type` varchar(50) NOT NULL,
  `basic_salary` decimal(65,2) NOT NULL DEFAULT 0.00,
  `daily_wages` decimal(65,2) NOT NULL DEFAULT 0.00,
  `hours_worked` varchar(50) NOT NULL DEFAULT '0',
  `total_allowances` decimal(65,2) NOT NULL DEFAULT 0.00,
  `total_commissions` decimal(65,2) NOT NULL DEFAULT 0.00,
  `total_statutory_deductions` decimal(65,2) NOT NULL DEFAULT 0.00,
  `total_other_payments` decimal(65,2) NOT NULL DEFAULT 0.00,
  `net_salary` decimal(65,2) NOT NULL DEFAULT 0.00,
  `payment_method` int(11) NOT NULL,
  `pay_comments` mediumtext NOT NULL,
  `is_payment` int(11) NOT NULL,
  `year_to_date` varchar(200) NOT NULL,
  `is_advance_salary_deduct` int(11) NOT NULL,
  `advance_salary_amount` decimal(65,2) DEFAULT NULL,
  `is_loan_deduct` int(11) NOT NULL,
  `loan_amount` decimal(65,2) NOT NULL,
  `eis_value` decimal(65,2) NOT NULL DEFAULT 0.00,
  `employer_eis_value` decimal(65,2) NOT NULL DEFAULT 0.00,
  `epf_value` decimal(65,2) NOT NULL DEFAULT 0.00,
  `employer_epf_value` decimal(65,2) NOT NULL DEFAULT 0.00,
  `socso_value` decimal(65,2) NOT NULL DEFAULT 0.00,
  `employer_socso_value` decimal(65,2) NOT NULL DEFAULT 0.00,
  `pcb_tax_value` decimal(65,2) NOT NULL DEFAULT 0.00,
  `ihrdf_value` decimal(65,2) NOT NULL DEFAULT 0.00,
  `status` int(11) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_payslip_allowances`
--

CREATE TABLE `ci_payslip_allowances` (
  `payslip_allowances_id` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `is_taxable` int(11) NOT NULL,
  `is_fixed` int(11) NOT NULL,
  `pay_title` varchar(200) NOT NULL,
  `pay_amount` decimal(65,2) NOT NULL DEFAULT 0.00,
  `salary_month` varchar(200) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_payslip_allowances`
--

INSERT INTO `ci_payslip_allowances` (`payslip_allowances_id`, `payslip_id`, `staff_id`, `is_taxable`, `is_fixed`, `pay_title`, `pay_amount`, `salary_month`, `created_at`) VALUES
(1, 2, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-05', '16-05-2021 11:20:51'),
(2, 2, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-05', '16-05-2021 11:20:51'),
(3, 2, 3, 1, 1, 'Medical Allowance', '50.00', '2021-05', '16-05-2021 11:20:51'),
(4, 3, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-05', '16-05-2021 11:21:08'),
(5, 3, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-05', '16-05-2021 11:21:08'),
(6, 3, 3, 1, 1, 'Medical Allowance', '50.00', '2021-05', '16-05-2021 11:21:08'),
(7, 4, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-05', '16-05-2021 11:21:17'),
(8, 4, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-05', '16-05-2021 11:21:17'),
(9, 4, 3, 1, 1, 'Medical Allowance', '50.00', '2021-05', '16-05-2021 11:21:17'),
(10, 5, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-05', '16-05-2021 11:21:27'),
(11, 5, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-05', '16-05-2021 11:21:27'),
(12, 5, 3, 1, 1, 'Medical Allowance', '50.00', '2021-05', '16-05-2021 11:21:27'),
(13, 11, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-06', '21-06-2021 08:22:31'),
(14, 11, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-06', '21-06-2021 08:22:31'),
(15, 11, 3, 1, 1, 'Medical Allowance', '50.00', '2021-06', '21-06-2021 08:22:31'),
(16, 12, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-06', '21-06-2021 08:37:39'),
(17, 12, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-06', '21-06-2021 08:37:39'),
(18, 12, 3, 1, 1, 'Medical Allowance', '50.00', '2021-06', '21-06-2021 08:37:39'),
(19, 13, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-06', '21-06-2021 09:43:03'),
(20, 13, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-06', '21-06-2021 09:43:03'),
(21, 13, 3, 1, 1, 'Medical Allowance', '50.00', '2021-06', '21-06-2021 09:43:03'),
(22, 14, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-06', '21-06-2021 09:48:19'),
(23, 14, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-06', '21-06-2021 09:48:19'),
(24, 14, 3, 1, 1, 'Medical Allowance', '50.00', '2021-06', '21-06-2021 09:48:19'),
(25, 15, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-06', '21-06-2021 09:48:30'),
(26, 15, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-06', '21-06-2021 09:48:30'),
(27, 15, 3, 1, 1, 'Medical Allowance', '50.00', '2021-06', '21-06-2021 09:48:30'),
(28, 16, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-06', '21-06-2021 09:48:49'),
(29, 16, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-06', '21-06-2021 09:48:49'),
(30, 16, 3, 1, 1, 'Medical Allowance', '50.00', '2021-06', '21-06-2021 09:48:49'),
(31, 17, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-06', '21-06-2021 09:48:55'),
(32, 17, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-06', '21-06-2021 09:48:55'),
(33, 17, 3, 1, 1, 'Medical Allowance', '50.00', '2021-06', '21-06-2021 09:48:55'),
(34, 18, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-06', '21-06-2021 09:49:00'),
(35, 18, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-06', '21-06-2021 09:49:00'),
(36, 18, 3, 1, 1, 'Medical Allowance', '50.00', '2021-06', '21-06-2021 09:49:00'),
(37, 19, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-06', '21-06-2021 09:49:05'),
(38, 19, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-06', '21-06-2021 09:49:05'),
(39, 19, 3, 1, 1, 'Medical Allowance', '50.00', '2021-06', '21-06-2021 09:49:05'),
(40, 20, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-06', '21-06-2021 09:49:22'),
(41, 20, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-06', '21-06-2021 09:49:22'),
(42, 20, 3, 1, 1, 'Medical Allowance', '50.00', '2021-06', '21-06-2021 09:49:22'),
(43, 21, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-06', '21-06-2021 09:50:01'),
(44, 21, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-06', '21-06-2021 09:50:01'),
(45, 21, 3, 1, 1, 'Medical Allowance', '50.00', '2021-06', '21-06-2021 09:50:01'),
(46, 22, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-06', '21-06-2021 09:52:30'),
(47, 22, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-06', '21-06-2021 09:52:30'),
(48, 22, 3, 1, 1, 'Medical Allowance', '50.00', '2021-06', '21-06-2021 09:52:30'),
(49, 23, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-06', '21-06-2021 09:53:28'),
(50, 23, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-06', '21-06-2021 09:53:28'),
(51, 23, 3, 1, 1, 'Medical Allowance', '50.00', '2021-06', '21-06-2021 09:53:28'),
(52, 24, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-06', '21-06-2021 10:26:32'),
(53, 24, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-06', '21-06-2021 10:26:32'),
(54, 24, 3, 1, 1, 'Medical Allowance', '50.00', '2021-06', '21-06-2021 10:26:32'),
(55, 25, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-06', '21-06-2021 12:30:52'),
(56, 25, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-06', '21-06-2021 12:30:52'),
(57, 25, 3, 1, 1, 'Medical Allowance', '50.00', '2021-06', '21-06-2021 12:30:52'),
(58, 26, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-06', '21-06-2021 03:30:15'),
(59, 26, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-06', '21-06-2021 03:30:15'),
(60, 26, 3, 1, 1, 'Medical Allowance', '50.00', '2021-06', '21-06-2021 03:30:15'),
(61, 27, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-06', '21-06-2021 03:32:59'),
(62, 27, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-06', '21-06-2021 03:32:59'),
(63, 27, 3, 1, 1, 'Medical Allowance', '50.00', '2021-06', '21-06-2021 03:32:59'),
(64, 28, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-06', '28-06-2021 06:33:18'),
(65, 28, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-06', '28-06-2021 06:33:18'),
(66, 28, 3, 1, 1, 'Medical Allowance', '50.00', '2021-06', '28-06-2021 06:33:18'),
(67, 31, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-08', '29-08-2021 01:34:27'),
(68, 31, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-08', '29-08-2021 01:34:27'),
(69, 31, 3, 1, 1, 'Medical Allowance', '50.00', '2021-08', '29-08-2021 01:34:27'),
(70, 34, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-08', '29-08-2021 04:35:54'),
(71, 34, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-08', '29-08-2021 04:35:54'),
(72, 34, 3, 1, 1, 'Medical Allowance', '50.00', '2021-08', '29-08-2021 04:35:54'),
(73, 35, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-08', '29-08-2021 05:04:26'),
(74, 35, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-08', '29-08-2021 05:04:26'),
(75, 35, 3, 1, 1, 'Medical Allowance', '50.00', '2021-08', '29-08-2021 05:04:26'),
(76, 37, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-08', '29-08-2021 05:20:56'),
(77, 37, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-08', '29-08-2021 05:20:56'),
(78, 37, 3, 1, 1, 'Medical Allowance', '50.00', '2021-08', '29-08-2021 05:20:56'),
(79, 41, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-08', '30-08-2021 08:24:31'),
(80, 41, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-08', '30-08-2021 08:24:31'),
(81, 41, 3, 1, 1, 'Medical Allowance', '50.00', '2021-08', '30-08-2021 08:24:31'),
(82, 42, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-10', '20-10-2021 11:58:25'),
(83, 42, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-10', '20-10-2021 11:58:25'),
(84, 42, 3, 1, 1, 'Medical Allowance', '50.00', '2021-10', '20-10-2021 11:58:25'),
(85, 43, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-10', '28-10-2021 06:06:04'),
(86, 43, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-10', '28-10-2021 06:06:04'),
(87, 43, 3, 1, 1, 'Medical Allowance', '50.00', '2021-10', '28-10-2021 06:06:04'),
(88, 44, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-11', '04-11-2021 10:52:49'),
(89, 44, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-11', '04-11-2021 10:52:49'),
(90, 44, 3, 1, 1, 'Medical Allowance', '50.00', '2021-11', '04-11-2021 10:52:49'),
(91, 45, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-11', '04-11-2021 01:08:32'),
(92, 45, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-11', '04-11-2021 01:08:32'),
(93, 45, 3, 1, 1, 'Medical Allowance', '50.00', '2021-11', '04-11-2021 01:08:32'),
(94, 46, 3, 1, 1, 'Dearness Allowance', '150.00', '2021-11', '04-11-2021 01:13:23'),
(95, 46, 3, 1, 1, 'Conveyance Allowance', '100.00', '2021-11', '04-11-2021 01:13:23'),
(96, 46, 3, 1, 1, 'Medical Allowance', '50.00', '2021-11', '04-11-2021 01:13:23');

-- --------------------------------------------------------

--
-- Table structure for table `ci_payslip_commissions`
--

CREATE TABLE `ci_payslip_commissions` (
  `payslip_commissions_id` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `is_taxable` int(11) NOT NULL,
  `is_fixed` int(11) NOT NULL,
  `pay_title` varchar(200) NOT NULL,
  `pay_amount` decimal(65,2) NOT NULL DEFAULT 0.00,
  `salary_month` varchar(200) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_payslip_commissions`
--

INSERT INTO `ci_payslip_commissions` (`payslip_commissions_id`, `payslip_id`, `staff_id`, `is_taxable`, `is_fixed`, `pay_title`, `pay_amount`, `salary_month`, `created_at`) VALUES
(1, 2, 3, 1, 1, 'Sales Target', '50.00', '2021-05', '16-05-2021 11:20:51'),
(2, 3, 3, 1, 1, 'Sales Target', '50.00', '2021-05', '16-05-2021 11:21:08'),
(3, 4, 3, 1, 1, 'Sales Target', '50.00', '2021-05', '16-05-2021 11:21:17'),
(4, 5, 3, 1, 1, 'Sales Target', '50.00', '2021-05', '16-05-2021 11:21:27'),
(5, 11, 3, 1, 1, 'Sales Target', '50.00', '2021-06', '21-06-2021 08:22:31'),
(6, 12, 3, 1, 1, 'Sales Target', '50.00', '2021-06', '21-06-2021 08:37:39'),
(7, 13, 3, 1, 1, 'Sales Target', '50.00', '2021-06', '21-06-2021 09:43:03'),
(8, 14, 3, 1, 1, 'Sales Target', '50.00', '2021-06', '21-06-2021 09:48:19'),
(9, 15, 3, 1, 1, 'Sales Target', '50.00', '2021-06', '21-06-2021 09:48:30'),
(10, 16, 3, 1, 1, 'Sales Target', '50.00', '2021-06', '21-06-2021 09:48:49'),
(11, 17, 3, 1, 1, 'Sales Target', '50.00', '2021-06', '21-06-2021 09:48:55'),
(12, 18, 3, 1, 1, 'Sales Target', '50.00', '2021-06', '21-06-2021 09:49:00'),
(13, 19, 3, 1, 1, 'Sales Target', '50.00', '2021-06', '21-06-2021 09:49:05'),
(14, 20, 3, 1, 1, 'Sales Target', '50.00', '2021-06', '21-06-2021 09:49:22'),
(15, 21, 3, 1, 1, 'Sales Target', '50.00', '2021-06', '21-06-2021 09:50:01'),
(16, 22, 3, 1, 1, 'Sales Target', '50.00', '2021-06', '21-06-2021 09:52:30'),
(17, 23, 3, 1, 1, 'Sales Target', '50.00', '2021-06', '21-06-2021 09:53:28'),
(18, 24, 3, 1, 1, 'Sales Target', '50.00', '2021-06', '21-06-2021 10:26:32'),
(19, 25, 3, 1, 1, 'Sales Target', '50.00', '2021-06', '21-06-2021 12:30:52'),
(20, 26, 3, 1, 1, 'Sales Target', '50.00', '2021-06', '21-06-2021 03:30:15'),
(21, 27, 3, 1, 1, 'Sales Target', '50.00', '2021-06', '21-06-2021 03:32:59'),
(22, 28, 3, 1, 1, 'Sales Target', '50.00', '2021-06', '28-06-2021 06:33:18'),
(23, 31, 3, 1, 1, 'Sales Target', '50.00', '2021-08', '29-08-2021 01:34:27'),
(24, 34, 3, 1, 1, 'Sales Target', '50.00', '2021-08', '29-08-2021 04:35:54'),
(25, 35, 3, 1, 1, 'Sales Target', '50.00', '2021-08', '29-08-2021 05:04:26'),
(26, 37, 3, 1, 1, 'Sales Target', '50.00', '2021-08', '29-08-2021 05:20:56'),
(27, 41, 3, 1, 1, 'Sales Target', '50.00', '2021-08', '30-08-2021 08:24:31'),
(28, 42, 3, 1, 1, 'Sales Target', '50.00', '2021-10', '20-10-2021 11:58:25'),
(29, 43, 3, 1, 1, 'Sales Target', '50.00', '2021-10', '28-10-2021 06:06:04'),
(30, 44, 3, 1, 1, 'Sales Target', '50.00', '2021-11', '04-11-2021 10:52:49'),
(31, 45, 3, 1, 1, 'Sales Target', '50.00', '2021-11', '04-11-2021 01:08:32'),
(32, 46, 3, 1, 1, 'Sales Target', '50.00', '2021-11', '04-11-2021 01:13:23');

-- --------------------------------------------------------

--
-- Table structure for table `ci_payslip_other_payments`
--

CREATE TABLE `ci_payslip_other_payments` (
  `payslip_other_payment_id` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `is_taxable` int(11) NOT NULL,
  `is_fixed` int(11) NOT NULL,
  `pay_title` varchar(200) NOT NULL,
  `pay_amount` decimal(65,2) NOT NULL DEFAULT 0.00,
  `salary_month` varchar(200) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_payslip_other_payments`
--

INSERT INTO `ci_payslip_other_payments` (`payslip_other_payment_id`, `payslip_id`, `staff_id`, `is_taxable`, `is_fixed`, `pay_title`, `pay_amount`, `salary_month`, `created_at`) VALUES
(1, 2, 3, 1, 1, 'Hospitalization', '80.00', '2021-05', '16-05-2021 11:20:51'),
(2, 2, 3, 1, 1, 'Travelling', '50.00', '2021-05', '16-05-2021 11:20:51'),
(3, 3, 3, 1, 1, 'Hospitalization', '80.00', '2021-05', '16-05-2021 11:21:08'),
(4, 3, 3, 1, 1, 'Travelling', '50.00', '2021-05', '16-05-2021 11:21:08'),
(5, 4, 3, 1, 1, 'Hospitalization', '80.00', '2021-05', '16-05-2021 11:21:17'),
(6, 4, 3, 1, 1, 'Travelling', '50.00', '2021-05', '16-05-2021 11:21:17'),
(7, 5, 3, 1, 1, 'Hospitalization', '80.00', '2021-05', '16-05-2021 11:21:27'),
(8, 5, 3, 1, 1, 'Travelling', '50.00', '2021-05', '16-05-2021 11:21:27'),
(9, 11, 3, 1, 1, 'Hospitalization', '80.00', '2021-06', '21-06-2021 08:22:31'),
(10, 11, 3, 1, 1, 'Travelling', '50.00', '2021-06', '21-06-2021 08:22:31'),
(11, 12, 3, 1, 1, 'Hospitalization', '80.00', '2021-06', '21-06-2021 08:37:39'),
(12, 12, 3, 1, 1, 'Travelling', '50.00', '2021-06', '21-06-2021 08:37:39'),
(13, 13, 3, 1, 1, 'Hospitalization', '80.00', '2021-06', '21-06-2021 09:43:03'),
(14, 13, 3, 1, 1, 'Travelling', '50.00', '2021-06', '21-06-2021 09:43:03'),
(15, 14, 3, 1, 1, 'Hospitalization', '80.00', '2021-06', '21-06-2021 09:48:19'),
(16, 14, 3, 1, 1, 'Travelling', '50.00', '2021-06', '21-06-2021 09:48:19'),
(17, 15, 3, 1, 1, 'Hospitalization', '80.00', '2021-06', '21-06-2021 09:48:30'),
(18, 15, 3, 1, 1, 'Travelling', '50.00', '2021-06', '21-06-2021 09:48:30'),
(19, 16, 3, 1, 1, 'Hospitalization', '80.00', '2021-06', '21-06-2021 09:48:49'),
(20, 16, 3, 1, 1, 'Travelling', '50.00', '2021-06', '21-06-2021 09:48:49'),
(21, 17, 3, 1, 1, 'Hospitalization', '80.00', '2021-06', '21-06-2021 09:48:55'),
(22, 17, 3, 1, 1, 'Travelling', '50.00', '2021-06', '21-06-2021 09:48:55'),
(23, 18, 3, 1, 1, 'Hospitalization', '80.00', '2021-06', '21-06-2021 09:49:00'),
(24, 18, 3, 1, 1, 'Travelling', '50.00', '2021-06', '21-06-2021 09:49:00'),
(25, 19, 3, 1, 1, 'Hospitalization', '80.00', '2021-06', '21-06-2021 09:49:05'),
(26, 19, 3, 1, 1, 'Travelling', '50.00', '2021-06', '21-06-2021 09:49:05'),
(27, 20, 3, 1, 1, 'Hospitalization', '80.00', '2021-06', '21-06-2021 09:49:22'),
(28, 20, 3, 1, 1, 'Travelling', '50.00', '2021-06', '21-06-2021 09:49:22'),
(29, 21, 3, 1, 1, 'Hospitalization', '80.00', '2021-06', '21-06-2021 09:50:01'),
(30, 21, 3, 1, 1, 'Travelling', '50.00', '2021-06', '21-06-2021 09:50:01'),
(31, 22, 3, 1, 1, 'Hospitalization', '80.00', '2021-06', '21-06-2021 09:52:30'),
(32, 22, 3, 1, 1, 'Travelling', '50.00', '2021-06', '21-06-2021 09:52:30'),
(33, 23, 3, 1, 1, 'Hospitalization', '80.00', '2021-06', '21-06-2021 09:53:28'),
(34, 23, 3, 1, 1, 'Travelling', '50.00', '2021-06', '21-06-2021 09:53:28'),
(35, 24, 3, 1, 1, 'Hospitalization', '80.00', '2021-06', '21-06-2021 10:26:32'),
(36, 24, 3, 1, 1, 'Travelling', '50.00', '2021-06', '21-06-2021 10:26:32'),
(37, 25, 3, 1, 1, 'Hospitalization', '80.00', '2021-06', '21-06-2021 12:30:52'),
(38, 25, 3, 1, 1, 'Travelling', '50.00', '2021-06', '21-06-2021 12:30:52'),
(39, 26, 3, 1, 1, 'Hospitalization', '80.00', '2021-06', '21-06-2021 03:30:15'),
(40, 26, 3, 1, 1, 'Travelling', '50.00', '2021-06', '21-06-2021 03:30:15'),
(41, 27, 3, 1, 1, 'Hospitalization', '80.00', '2021-06', '21-06-2021 03:32:59'),
(42, 27, 3, 1, 1, 'Travelling', '50.00', '2021-06', '21-06-2021 03:32:59'),
(43, 28, 3, 1, 1, 'Hospitalization', '80.00', '2021-06', '28-06-2021 06:33:18'),
(44, 28, 3, 1, 1, 'Travelling', '50.00', '2021-06', '28-06-2021 06:33:18'),
(45, 31, 3, 1, 1, 'Hospitalization', '80.00', '2021-08', '29-08-2021 01:34:27'),
(46, 31, 3, 1, 1, 'Travelling', '50.00', '2021-08', '29-08-2021 01:34:28'),
(47, 34, 3, 1, 1, 'Hospitalization', '80.00', '2021-08', '29-08-2021 04:35:54'),
(48, 34, 3, 1, 1, 'Travelling', '50.00', '2021-08', '29-08-2021 04:35:54'),
(49, 35, 3, 1, 1, 'Hospitalization', '80.00', '2021-08', '29-08-2021 05:04:26'),
(50, 35, 3, 1, 1, 'Travelling', '50.00', '2021-08', '29-08-2021 05:04:26'),
(51, 37, 3, 1, 1, 'Hospitalization', '80.00', '2021-08', '29-08-2021 05:20:56'),
(52, 37, 3, 1, 1, 'Travelling', '50.00', '2021-08', '29-08-2021 05:20:56'),
(53, 41, 3, 1, 1, 'Hospitalization', '80.00', '2021-08', '30-08-2021 08:24:31'),
(54, 41, 3, 1, 1, 'Travelling', '50.00', '2021-08', '30-08-2021 08:24:31'),
(55, 42, 3, 1, 1, 'Hospitalization', '80.00', '2021-10', '20-10-2021 11:58:25'),
(56, 42, 3, 1, 1, 'Travelling', '50.00', '2021-10', '20-10-2021 11:58:25'),
(57, 43, 3, 1, 1, 'Hospitalization', '80.00', '2021-10', '28-10-2021 06:06:04'),
(58, 43, 3, 1, 1, 'Travelling', '50.00', '2021-10', '28-10-2021 06:06:04'),
(59, 44, 3, 1, 1, 'Hospitalization', '80.00', '2021-11', '04-11-2021 10:52:49'),
(60, 44, 3, 1, 1, 'Travelling', '50.00', '2021-11', '04-11-2021 10:52:49'),
(61, 45, 3, 1, 1, 'Hospitalization', '80.00', '2021-11', '04-11-2021 01:08:32'),
(62, 45, 3, 1, 1, 'Travelling', '50.00', '2021-11', '04-11-2021 01:08:32'),
(63, 46, 3, 1, 1, 'Hospitalization', '80.00', '2021-11', '04-11-2021 01:13:23'),
(64, 46, 3, 1, 1, 'Travelling', '50.00', '2021-11', '04-11-2021 01:13:23');

-- --------------------------------------------------------

--
-- Table structure for table `ci_payslip_statutory_deductions`
--

CREATE TABLE `ci_payslip_statutory_deductions` (
  `payslip_deduction_id` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `is_fixed` int(11) NOT NULL,
  `pay_title` varchar(200) NOT NULL,
  `pay_amount` decimal(65,2) NOT NULL DEFAULT 0.00,
  `salary_month` varchar(200) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_payslip_statutory_deductions`
--

INSERT INTO `ci_payslip_statutory_deductions` (`payslip_deduction_id`, `payslip_id`, `staff_id`, `is_fixed`, `pay_title`, `pay_amount`, `salary_month`, `created_at`) VALUES
(1, 2, 3, 1, 'Provident Fund', '20.00', '2021-05', '16-05-2021 11:20:51'),
(2, 2, 3, 1, 'Professional Tax', '50.00', '2021-05', '16-05-2021 11:20:51'),
(3, 3, 3, 1, 'Provident Fund', '20.00', '2021-05', '16-05-2021 11:21:08'),
(4, 3, 3, 1, 'Professional Tax', '50.00', '2021-05', '16-05-2021 11:21:08'),
(5, 4, 3, 1, 'Provident Fund', '20.00', '2021-05', '16-05-2021 11:21:17'),
(6, 4, 3, 1, 'Professional Tax', '50.00', '2021-05', '16-05-2021 11:21:17'),
(7, 5, 3, 1, 'Provident Fund', '20.00', '2021-05', '16-05-2021 11:21:27'),
(8, 5, 3, 1, 'Professional Tax', '50.00', '2021-05', '16-05-2021 11:21:27'),
(9, 11, 3, 1, 'Provident Fund', '20.00', '2021-06', '21-06-2021 08:22:31'),
(10, 11, 3, 1, 'Professional Tax', '50.00', '2021-06', '21-06-2021 08:22:31'),
(11, 12, 3, 1, 'Provident Fund', '20.00', '2021-06', '21-06-2021 08:37:39'),
(12, 12, 3, 1, 'Professional Tax', '50.00', '2021-06', '21-06-2021 08:37:39'),
(13, 13, 3, 1, 'Provident Fund', '20.00', '2021-06', '21-06-2021 09:43:03'),
(14, 13, 3, 1, 'Professional Tax', '50.00', '2021-06', '21-06-2021 09:43:03'),
(15, 14, 3, 1, 'Provident Fund', '20.00', '2021-06', '21-06-2021 09:48:19'),
(16, 14, 3, 1, 'Professional Tax', '50.00', '2021-06', '21-06-2021 09:48:19'),
(17, 15, 3, 1, 'Provident Fund', '20.00', '2021-06', '21-06-2021 09:48:30'),
(18, 15, 3, 1, 'Professional Tax', '50.00', '2021-06', '21-06-2021 09:48:30'),
(19, 16, 3, 1, 'Provident Fund', '20.00', '2021-06', '21-06-2021 09:48:49'),
(20, 16, 3, 1, 'Professional Tax', '50.00', '2021-06', '21-06-2021 09:48:49'),
(21, 17, 3, 1, 'Provident Fund', '20.00', '2021-06', '21-06-2021 09:48:55'),
(22, 17, 3, 1, 'Professional Tax', '50.00', '2021-06', '21-06-2021 09:48:55'),
(23, 18, 3, 1, 'Provident Fund', '20.00', '2021-06', '21-06-2021 09:49:00'),
(24, 18, 3, 1, 'Professional Tax', '50.00', '2021-06', '21-06-2021 09:49:00'),
(25, 19, 3, 1, 'Provident Fund', '20.00', '2021-06', '21-06-2021 09:49:05'),
(26, 19, 3, 1, 'Professional Tax', '50.00', '2021-06', '21-06-2021 09:49:05'),
(27, 20, 3, 1, 'Provident Fund', '20.00', '2021-06', '21-06-2021 09:49:22'),
(28, 20, 3, 1, 'Professional Tax', '50.00', '2021-06', '21-06-2021 09:49:22'),
(29, 21, 3, 1, 'Provident Fund', '20.00', '2021-06', '21-06-2021 09:50:01'),
(30, 21, 3, 1, 'Professional Tax', '50.00', '2021-06', '21-06-2021 09:50:01'),
(31, 22, 3, 1, 'Provident Fund', '20.00', '2021-06', '21-06-2021 09:52:30'),
(32, 22, 3, 1, 'Professional Tax', '50.00', '2021-06', '21-06-2021 09:52:30'),
(33, 23, 3, 1, 'Provident Fund', '20.00', '2021-06', '21-06-2021 09:53:28'),
(34, 23, 3, 1, 'Professional Tax', '50.00', '2021-06', '21-06-2021 09:53:28'),
(35, 24, 3, 1, 'Provident Fund', '20.00', '2021-06', '21-06-2021 10:26:32'),
(36, 24, 3, 1, 'Professional Tax', '50.00', '2021-06', '21-06-2021 10:26:32'),
(37, 25, 3, 1, 'Provident Fund', '20.00', '2021-06', '21-06-2021 12:30:52'),
(38, 25, 3, 1, 'Professional Tax', '50.00', '2021-06', '21-06-2021 12:30:52'),
(39, 26, 3, 1, 'Provident Fund', '20.00', '2021-06', '21-06-2021 03:30:15'),
(40, 26, 3, 1, 'Professional Tax', '50.00', '2021-06', '21-06-2021 03:30:15'),
(41, 27, 3, 1, 'Provident Fund', '20.00', '2021-06', '21-06-2021 03:32:59'),
(42, 27, 3, 1, 'Professional Tax', '50.00', '2021-06', '21-06-2021 03:32:59'),
(43, 28, 3, 1, 'Provident Fund', '20.00', '2021-06', '28-06-2021 06:33:18'),
(44, 28, 3, 1, 'Professional Tax', '50.00', '2021-06', '28-06-2021 06:33:18'),
(45, 31, 3, 1, 'Provident Fund', '20.00', '2021-08', '29-08-2021 01:34:28'),
(46, 31, 3, 1, 'Professional Tax', '50.00', '2021-08', '29-08-2021 01:34:28'),
(47, 34, 3, 1, 'Provident Fund', '20.00', '2021-08', '29-08-2021 04:35:54'),
(48, 34, 3, 1, 'Professional Tax', '50.00', '2021-08', '29-08-2021 04:35:54'),
(49, 35, 3, 1, 'Provident Fund', '20.00', '2021-08', '29-08-2021 05:04:26'),
(50, 35, 3, 1, 'Professional Tax', '50.00', '2021-08', '29-08-2021 05:04:26'),
(51, 37, 3, 1, 'Provident Fund', '20.00', '2021-08', '29-08-2021 05:20:56'),
(52, 37, 3, 1, 'Professional Tax', '50.00', '2021-08', '29-08-2021 05:20:56'),
(53, 41, 3, 1, 'Provident Fund', '20.00', '2021-08', '30-08-2021 08:24:31'),
(54, 41, 3, 1, 'Professional Tax', '50.00', '2021-08', '30-08-2021 08:24:31'),
(55, 42, 3, 1, 'Provident Fund', '20.00', '2021-10', '20-10-2021 11:58:25'),
(56, 42, 3, 1, 'Professional Tax', '50.00', '2021-10', '20-10-2021 11:58:25'),
(57, 43, 3, 1, 'Provident Fund', '20.00', '2021-10', '28-10-2021 06:06:04'),
(58, 43, 3, 1, 'Professional Tax', '50.00', '2021-10', '28-10-2021 06:06:04'),
(59, 44, 3, 1, 'Provident Fund', '20.00', '2021-11', '04-11-2021 10:52:49'),
(60, 44, 3, 1, 'Professional Tax', '50.00', '2021-11', '04-11-2021 10:52:49'),
(61, 45, 3, 1, 'Provident Fund', '20.00', '2021-11', '04-11-2021 01:08:32'),
(62, 45, 3, 1, 'Professional Tax', '50.00', '2021-11', '04-11-2021 01:08:32'),
(63, 46, 3, 1, 'Provident Fund', '20.00', '2021-11', '04-11-2021 01:13:23'),
(64, 46, 3, 1, 'Professional Tax', '50.00', '2021-11', '04-11-2021 01:13:23');

-- --------------------------------------------------------

--
-- Table structure for table `ci_performance_appraisal`
--

CREATE TABLE `ci_performance_appraisal` (
  `performance_appraisal_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `appraisal_year_month` varchar(255) NOT NULL,
  `remarks` mediumtext NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_performance_appraisal`
--

INSERT INTO `ci_performance_appraisal` (`performance_appraisal_id`, `company_id`, `employee_id`, `title`, `appraisal_year_month`, `remarks`, `added_by`, `created_at`) VALUES
(1, 2, 3, 'Faculty & Staff Attendance', '2021-04', 'lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt', 2, '15-05-2021 04:27:31'),
(2, 2, 4, 'Behaviors', '2021-08', 'lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt        ', 2, '15-05-2021 04:31:16'),
(3, 24, 26, 'Engagement', '2021-10', '', 26, '27-11-2021 03:47:09');

-- --------------------------------------------------------

--
-- Table structure for table `ci_performance_appraisal_options`
--

CREATE TABLE `ci_performance_appraisal_options` (
  `performance_appraisal_options_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `appraisal_id` int(11) NOT NULL,
  `appraisal_type` varchar(200) NOT NULL,
  `appraisal_option_id` int(11) NOT NULL,
  `appraisal_option_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_performance_appraisal_options`
--

INSERT INTO `ci_performance_appraisal_options` (`performance_appraisal_options_id`, `company_id`, `appraisal_id`, `appraisal_type`, `appraisal_option_id`, `appraisal_option_value`) VALUES
(1, 2, 1, 'technical', 101, 5),
(2, 2, 1, 'technical', 102, 5),
(3, 2, 1, 'technical', 103, 5),
(4, 2, 1, 'technical', 104, 5),
(5, 2, 1, 'technical', 105, 5),
(6, 2, 1, 'organizational', 106, 5),
(7, 2, 1, 'organizational', 107, 4),
(8, 2, 1, 'organizational', 108, 5),
(9, 2, 1, 'organizational', 109, 4),
(10, 2, 1, 'organizational', 110, 5),
(11, 2, 2, 'technical', 101, 5),
(12, 2, 2, 'technical', 102, 5),
(13, 2, 2, 'technical', 103, 5),
(14, 2, 2, 'technical', 104, 5),
(15, 2, 2, 'technical', 105, 5),
(16, 2, 2, 'organizational', 106, 5),
(17, 2, 2, 'organizational', 107, 5),
(18, 2, 2, 'organizational', 108, 5),
(19, 2, 2, 'organizational', 109, 5),
(20, 2, 2, 'organizational', 110, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ci_performance_indicator`
--

CREATE TABLE `ci_performance_indicator` (
  `performance_indicator_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `designation_id` int(111) NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_performance_indicator`
--

INSERT INTO `ci_performance_indicator` (`performance_indicator_id`, `company_id`, `title`, `designation_id`, `added_by`, `created_at`) VALUES
(1, 2, 'Research Grants', 2, 2, '15-05-2021 04:26:25'),
(2, 2, 'Training Sessions Per Year', 3, 2, '15-05-2021 04:28:03');

-- --------------------------------------------------------

--
-- Table structure for table `ci_performance_indicator_options`
--

CREATE TABLE `ci_performance_indicator_options` (
  `performance_indicator_options_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `indicator_id` int(11) NOT NULL,
  `indicator_type` varchar(200) NOT NULL,
  `indicator_option_id` int(11) NOT NULL,
  `indicator_option_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_performance_indicator_options`
--

INSERT INTO `ci_performance_indicator_options` (`performance_indicator_options_id`, `company_id`, `indicator_id`, `indicator_type`, `indicator_option_id`, `indicator_option_value`) VALUES
(1, 2, 1, 'technical', 101, 5),
(2, 2, 1, 'technical', 102, 4),
(3, 2, 1, 'technical', 103, 5),
(4, 2, 1, 'technical', 104, 3),
(5, 2, 1, 'technical', 105, 4),
(6, 2, 1, 'organizational', 106, 5),
(7, 2, 1, 'organizational', 107, 5),
(8, 2, 1, 'organizational', 108, 5),
(9, 2, 1, 'organizational', 109, 5),
(10, 2, 1, 'organizational', 110, 4),
(11, 2, 2, 'technical', 101, 5),
(12, 2, 2, 'technical', 102, 5),
(13, 2, 2, 'technical', 103, 5),
(14, 2, 2, 'technical', 104, 5),
(15, 2, 2, 'technical', 105, 5),
(16, 2, 2, 'organizational', 106, 5),
(17, 2, 2, 'organizational', 107, 5),
(18, 2, 2, 'organizational', 108, 5),
(19, 2, 2, 'organizational', 109, 4),
(20, 2, 2, 'organizational', 110, 5);

-- --------------------------------------------------------

--
-- Table structure for table `ci_policies`
--

CREATE TABLE `ci_policies` (
  `policy_id` int(111) NOT NULL,
  `company_id` int(111) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_policies`
--

INSERT INTO `ci_policies` (`policy_id`, `company_id`, `title`, `description`, `attachment`, `added_by`, `created_at`) VALUES
(5, 2, 'asdsadas', 'asdasdsadsadsadas', '1636489952_59088452f2be5404c44d.png', 2, '09-11-2021 03:32:32'),
(6, 2, 'asdsa', 'dsadsadsads', '1636489973_22512e880a5170a14b82.docx', 2, '09-11-2021 03:32:53'),
(7, 2, 'zfsdf', 'sdfsdfds', '1636489997_974210c9e48567a8321b.pdf', 2, '09-11-2021 03:33:17'),
(10, 24, 'Table of Contents', 'Table of Contents', '1638058320_e093b1244afbf32e77b9.pdf', 24, '27-11-2021 04:12:00'),
(11, 24, 'Collective Agreement', 'Collective Agreement', '1640313929_233833590398dd360b76.pdf', 24, '23-12-2021 06:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `ci_polls`
--

CREATE TABLE `ci_polls` (
  `poll_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `poll_title` varchar(255) DEFAULT NULL,
  `poll_question` varchar(255) DEFAULT NULL,
  `poll_start_date` varchar(200) DEFAULT NULL,
  `poll_end_date` varchar(200) DEFAULT NULL,
  `poll_answer1` varchar(255) DEFAULT NULL,
  `poll_answer2` varchar(255) DEFAULT NULL,
  `poll_answer3` varchar(255) DEFAULT NULL,
  `poll_answer4` varchar(255) DEFAULT NULL,
  `poll_answer5` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`poll_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

CREATE TABLE `ci_polls_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_ref_id` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `poll_question` varchar(255) DEFAULT NULL,
  `poll_answer1` varchar(255) DEFAULT NULL,
  `poll_answer2` varchar(255) DEFAULT NULL,
  `poll_answer3` varchar(255) DEFAULT NULL,
  `poll_answer4` varchar(255) DEFAULT NULL,
  `poll_answer5` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

--
-- Dumping data for table `ci_polls`
--

INSERT INTO `ci_polls` (`poll_id`, `company_id`, `poll_question`, `poll_start_date`, `poll_end_date`, `poll_answer1`, `poll_answer2`, `poll_answer3`, `poll_answer4`, `poll_answer5`, `notes`, `added_by`, `is_active`, `created_at`) VALUES
(1, 2, 'Test question right?', '2021-11-03', '2021-11-06', 'Lorem Ipsum Dolor Sit Amet', 'Contrary to popular belief', 'Sed ut perspiciatis unde omnis', 'The point of using Lorem Ipsum is that', 'There are many variations of passages', 'Test note..', 2, 0, '02-11-2021 03:27:13');

-- --------------------------------------------------------

--
-- Table structure for table `ci_polls_votes`
--

CREATE TABLE `ci_polls_votes` (
  `polls_vote_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `poll_question_id` varchar(255) DEFAULT NULL,
  `poll_answer` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`polls_vote_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

--
-- Dumping data for table `ci_polls_votes`
--

INSERT INTO `ci_polls_votes` (`polls_vote_id`, `company_id`, `poll_id`, `poll_answer`, `user_id`, `created_at`) VALUES
(16, 2, 1, '5', 5, '03-11-2021 07:16:13'),
(17, 2, 1, '5', 6, '03-11-2021 07:16:32'),
(18, 2, 1, '4', 7, '03-11-2021 07:16:44'),
(19, 2, 1, '3', 8, '03-11-2021 07:16:56'),
(20, 2, 1, '2', 9, '03-11-2021 07:17:11'),
(21, 2, 1, '1', 10, '03-11-2021 07:17:25'),
(22, 2, 1, '5', 11, '03-11-2021 07:17:36'),
(23, 2, 1, '3', 2, '03-11-2021 07:17:47'),
(24, 2, 1, '5', 3, '03-11-2021 03:06:34');

-- --------------------------------------------------------

--
-- Table structure for table `ci_projects`
--

CREATE TABLE `ci_projects` (
  `project_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `assigned_to` mediumtext DEFAULT NULL,
  `associated_goals` text DEFAULT NULL,
  `priority` varchar(255) NOT NULL,
  `project_no` varchar(255) DEFAULT NULL,
  `budget_hours` varchar(255) DEFAULT NULL,
  `summary` mediumtext NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `project_progress` varchar(255) NOT NULL,
  `project_note` longtext DEFAULT NULL,
  `status` tinyint(2) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_projects`
--

INSERT INTO `ci_projects` (`project_id`, `company_id`, `client_id`, `title`, `start_date`, `end_date`, `assigned_to`, `associated_goals`, `priority`, `project_no`, `budget_hours`, `summary`, `description`, `project_progress`, `project_note`, `status`, `added_by`, `created_at`) VALUES
(1, 2, 11, 'Advertising Platform', '2021-05-20', '2021-05-25', '0,3,4,5', '0', '1', '', '12', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. When an unknown printer took a galley of type and scrambled it.', '&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;p style=&#34;box-sizing:border-box;margin-bottom:1rem;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;font-size:0.9375rem;&#34;&gt;What we need&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;box-sizing:border-box;margin-bottom:1rem;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20 col-sm-12&#34; style=&#34;box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;div class=&#34;row&#34; style=&#34;box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;&#34;&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;box-sizing:border-box;margin-bottom:1rem;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;box-sizing:border-box;margin-bottom:1rem;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;font-size:0.9375rem;&#34;&gt;Requirements&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;box-sizing:border-box;margin-bottom:1rem;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;', '33', '', 1, 2, '15-05-2021 12:51:43'),
(2, 2, 9, 'Frontend Development', '2021-05-26', '2021-06-04', '0,6,7', '0', '2', '', '20', 'Ipsum is simply dummy text of the printing and typesetting industry.', '&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;What we need&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20 col-sm-12&#34; style=&#34;box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;div class=&#34;row&#34; style=&#34;box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;&#34;&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;Requirements&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;', '83', '', 3, 2, '15-05-2021 12:56:26'),
(3, 2, 9, 'Oberlo Development', '2021-05-24', '2021-05-31', '0,7,8', '0,136', '1', '', '22', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;What we need&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20 col-sm-12&#34; style=&#34;box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;div class=&#34;row&#34; style=&#34;box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;&#34;&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;Requirements&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;', '0', '', 0, 2, '15-05-2021 12:57:55'),
(4, 2, 9, 'Hospital Administration', '2021-06-02', '2021-06-17', '0,4,7,8', NULL, '3', '', '30', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;What we need&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20 col-sm-12&#34; style=&#34;box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;div class=&#34;row&#34; style=&#34;box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;&#34;&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;Requirements&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;', '100', '', 2, 2, '15-05-2021 01:03:34'),
(5, 2, 9, 'Database Upgrade', '2021-05-26', '2021-05-30', '0,5,6,7', NULL, '1', '', '10', 'After the functional mockups are approved the remainder of the site will be built.', '&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;What we need&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20 col-sm-12&#34; style=&#34;box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;div class=&#34;row&#34; style=&#34;box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;&#34;&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;Requirements&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;', '47', '', 4, 2, '15-05-2021 01:05:52'),
(6, 2, 11, 'Create UI design model', '2021-05-29', '2021-05-31', '0,4,7,8', NULL, '1', '', '20', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. When an unknown printer took a galley of type and scrambled it.', '&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;What we need&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20 col-sm-12&#34; style=&#34;box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;div class=&#34;row&#34; style=&#34;box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;&#34;&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;Requirements&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;', '0', '', 0, 2, '28-05-2021 06:15:49');

-- --------------------------------------------------------

--
-- Table structure for table `ci_projects_bugs`
--

CREATE TABLE `ci_projects_bugs` (
  `project_bug_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `bug_note` text DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_projects_discussion`
--

CREATE TABLE `ci_projects_discussion` (
  `project_discussion_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `discussion_text` text DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_projects_files`
--

CREATE TABLE `ci_projects_files` (
  `project_file_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `file_title` varchar(255) NOT NULL,
  `attachment_file` mediumtext NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_projects_notes`
--

CREATE TABLE `ci_projects_notes` (
  `project_note_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `project_note` text DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_projects_timelogs`
--

CREATE TABLE `ci_projects_timelogs` (
  `timelogs_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `total_hours` varchar(255) NOT NULL,
  `timelogs_memo` text NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_projects_timelogs`
--

INSERT INTO `ci_projects_timelogs` (`timelogs_id`, `project_id`, `company_id`, `employee_id`, `start_time`, `end_time`, `start_date`, `end_date`, `total_hours`, `timelogs_memo`, `created_at`) VALUES
(2, 1, 2, 4, '11:38', '13:35', '2021-06-22', '2021-06-22', '1:57', 'sdfdfasffd', '22-06-2021 02:38:19'),
(3, 1, 2, 4, '02:44', '02:56', '2021-06-23', '2021-06-23', '0:12', 'sdfasdfdsfd', '22-06-2021 05:44:15');

-- --------------------------------------------------------

--
-- Table structure for table `ci_recent_activity`
--

CREATE TABLE `ci_recent_activity` (
  `activity_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `module_type` varchar(200) NOT NULL,
  `is_read` int(11) NOT NULL DEFAULT 0,
  `added_by` int(11) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_rec_candidates`
--

CREATE TABLE `ci_rec_candidates` (
  `candidate_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `job_id` int(111) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `message` mediumtext NOT NULL,
  `job_resume` mediumtext NOT NULL,
  `application_status` int(11) NOT NULL DEFAULT 0,
  `application_remarks` mediumtext NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_rec_candidates`
--

INSERT INTO `ci_rec_candidates` (`candidate_id`, `company_id`, `job_id`, `designation_id`, `staff_id`, `message`, `job_resume`, `application_status`, `application_remarks`, `created_at`) VALUES
(2, 2, 6, 3, 15, 'Praesent efficitur dui eget condimentum viverra. Sed non maximus ipsum, non consequat nulla. Vivamus nec convallis nisi, sit amet egestas magna. Quisque vulputate lorem sit amet ornare efficitur. Duis aliquam est elit, sed tincidunt enim commodo sed. Fusce tempus magna id sagittis laoreet. Proin porta luctus ante eu ultrices. Sed porta consectetur purus, rutrum tincidunt magna dictum tempus.\n', 'img-avatar-1.jpg', 1, 'application remarks here', '30-09-2021 05:18:16'),
(3, 2, 3, 3, 15, 'Quisque vulputate lorem sit amet ornare efficitur. Duis aliquam est elit, sed tincidunt enim commodo sed. Fusce tempus magna id sagittis laoreet. Proin porta luctus ante eu ultrices.', 'img-avatar-1.jpg', 3, 'application remarks here', '30-09-2021 06:21:17');

-- --------------------------------------------------------

--
-- Table structure for table `ci_rec_interviews`
--

CREATE TABLE `ci_rec_interviews` (
  `job_interview_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `job_id` int(111) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `staff_id` varchar(11) NOT NULL,
  `interview_place` varchar(255) NOT NULL,
  `interview_date` varchar(255) NOT NULL,
  `interview_time` varchar(255) NOT NULL,
  `interviewer_id` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `interview_remarks` text DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_rec_interviews`
--

INSERT INTO `ci_rec_interviews` (`job_interview_id`, `company_id`, `job_id`, `designation_id`, `staff_id`, `interview_place`, `interview_date`, `interview_time`, `interviewer_id`, `description`, `interview_remarks`, `status`, `created_at`) VALUES
(1, 2, 6, 3, '15', 'Testtt', '2021-10-01', '06:59', 3, 'Testtttt', 'interview marks goes here', 2, '30-09-2021 09:59:24');

-- --------------------------------------------------------

--
-- Table structure for table `ci_rec_jobs`
--

CREATE TABLE `ci_rec_jobs` (
  `job_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `designation_id` int(111) NOT NULL,
  `job_type` int(225) NOT NULL,
  `job_vacancy` int(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `minimum_experience` varchar(255) NOT NULL,
  `date_of_closing` varchar(200) NOT NULL,
  `short_description` mediumtext NOT NULL,
  `long_description` mediumtext NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_rec_jobs`
--

INSERT INTO `ci_rec_jobs` (`job_id`, `company_id`, `job_title`, `designation_id`, `job_type`, `job_vacancy`, `gender`, `minimum_experience`, `date_of_closing`, `short_description`, `long_description`, `status`, `created_at`) VALUES
(1, 2, 'Web Designer / Developer', 1, 1, 10, '0', '0', '2021-06-30', 'Company is a 2016 Iowa City-born start-up that develops consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est.', '&lt;p&gt;Company is a 2016 Iowa City-born start-up that develops consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Required Knowledge, Skills, and Abilities&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Ability to write code &amp;ndash; HTML &amp;amp; CSS (SCSS flavor of SASS preferred when writing CSS)&lt;/li&gt;&lt;li&gt;Proficient in Photoshop, Illustrator, bonus points for familiarity with Sketch (Sketch is our preferred concepting)&lt;/li&gt;&lt;li&gt;Cross-browser and platform testing as standard practice&lt;/li&gt;&lt;li&gt;Experience using Invision a plus&lt;/li&gt;&lt;li&gt;Experience in video production a plus or, at a minimum, a willingness to learn&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;strong&gt;Education + Experience&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Advanced degree or equivalent experience in graphic and web design&lt;/li&gt;&lt;li&gt;3 or more years of professional design experience&lt;/li&gt;&lt;li&gt;Direct response email experience&lt;/li&gt;&lt;li&gt;Ecommerce website design experience&lt;/li&gt;&lt;li&gt;Familiarity with mobile and web apps preferred&lt;/li&gt;&lt;li&gt;Excellent communication skills, most notably a demonstrated ability to solicit and address creative and design feedback&lt;/li&gt;&lt;li&gt;Must be able to work under pressure and meet deadlines while maintaining a positive attitude and providing exemplary customer service&lt;/li&gt;&lt;li&gt;Ability to work independently and to carry out assignments to completion within parameters of instructions given, prescribed routines, and standard accepted practices&lt;br /&gt;&lt;/li&gt;&lt;/ul&gt;', 1, '15-05-2021 11:04:04'),
(2, 3, 'Marketing Dairector', 9, 1, 5, '0', '0', '2021-06-29', '&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;p style=&#34;box-sizing:border-box;margin-bottom:1rem;&#34;&gt;Company is a 2016 Iowa City-born start-up that develops consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est&lt;/p&gt;&lt;div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;/div&gt;', '&lt;p&gt;Company is a 2016 Iowa City-born start-up that develops consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Required Knowledge, Skills, and Abilities&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Ability to write code &amp;ndash; HTML &amp;amp; CSS (SCSS flavor of SASS preferred when writing CSS)&lt;/li&gt;&lt;li&gt;Proficient in Photoshop, Illustrator, bonus points for familiarity with Sketch (Sketch is our preferred concepting)&lt;/li&gt;&lt;li&gt;Cross-browser and platform testing as standard practice&lt;/li&gt;&lt;li&gt;Experience using Invision a plus&lt;/li&gt;&lt;li&gt;Experience in video production a plus or, at a minimum, a willingness to learn&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;strong&gt;Education + Experience&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Advanced degree or equivalent experience in graphic and web design&lt;/li&gt;&lt;li&gt;3 or more years of professional design experience&lt;/li&gt;&lt;li&gt;Direct response email experience&lt;/li&gt;&lt;li&gt;Ecommerce website design experience&lt;/li&gt;&lt;li&gt;Familiarity with mobile and web apps preferred&lt;/li&gt;&lt;li&gt;Excellent communication skills, most notably a demonstrated ability to solicit and address creative and design feedback&lt;/li&gt;&lt;li&gt;Must be able to work under pressure and meet deadlines while maintaining a positive attitude and providing exemplary customer service&lt;/li&gt;&lt;li&gt;Ability to work independently and to carry out assignments to completion within parameters of instructions given, prescribed routines, and standard accepted practices&lt;/li&gt;&lt;/ul&gt;', 1, '15-05-2021 11:19:29'),
(3, 2, ' Application Developer', 3, 1, 4, '0', '0', '2021-07-14', 'Company is a 2016 Iowa City-born start-up that develops consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est.', '&lt;p&gt;Company is a 2016 Iowa City-born start-up that develops consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Required Knowledge, Skills, and Abilities&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Ability to write code &amp;ndash; HTML &amp;amp; CSS (SCSS flavor of SASS preferred when writing CSS)&lt;/li&gt;&lt;li&gt;Proficient in Photoshop, Illustrator, bonus points for familiarity with Sketch (Sketch is our preferred concepting)&lt;/li&gt;&lt;li&gt;Cross-browser and platform testing as standard practice&lt;/li&gt;&lt;li&gt;Experience using Invision a plus&lt;/li&gt;&lt;li&gt;Experience in video production a plus or, at a minimum, a willingness to learn&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;strong&gt;Education + Experience&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Advanced degree or equivalent experience in graphic and web design&lt;/li&gt;&lt;li&gt;3 or more years of professional design experience&lt;/li&gt;&lt;li&gt;Direct response email experience&lt;/li&gt;&lt;li&gt;Ecommerce website design experience&lt;/li&gt;&lt;li&gt;Familiarity with mobile and web apps preferred&lt;/li&gt;&lt;li&gt;Excellent communication skills, most notably a demonstrated ability to solicit and address creative and design feedback&lt;/li&gt;&lt;li&gt;Must be able to work under pressure and meet deadlines while maintaining a positive attitude and providing exemplary customer service&lt;/li&gt;&lt;li&gt;Ability to work independently and to carry out assignments to completion within parameters of instructions given, prescribed routines, and standard accepted practices&lt;/li&gt;&lt;/ul&gt;', 1, '15-05-2021 11:20:58'),
(4, 2, 'Product Redesign', 1, 2, 3, '0', '0', '2021-06-30', 'Company is a 2016 Iowa City-born start-up that develops consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est.', '&lt;p&gt;Company is a 2016 Iowa City-born start-up that develops consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Required Knowledge, Skills, and Abilities&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Ability to write code &amp;ndash; HTML &amp;amp; CSS (SCSS flavor of SASS preferred when writing CSS)&lt;/li&gt;&lt;li&gt;Proficient in Photoshop, Illustrator, bonus points for familiarity with Sketch (Sketch is our preferred concepting)&lt;/li&gt;&lt;li&gt;Cross-browser and platform testing as standard practice&lt;/li&gt;&lt;li&gt;Experience using Invision a plus&lt;/li&gt;&lt;li&gt;Experience in video production a plus or, at a minimum, a willingness to learn&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;strong&gt;Education + Experience&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Advanced degree or equivalent experience in graphic and web design&lt;/li&gt;&lt;li&gt;3 or more years of professional design experience&lt;/li&gt;&lt;li&gt;Direct response email experience&lt;/li&gt;&lt;li&gt;Ecommerce website design experience&lt;/li&gt;&lt;li&gt;Familiarity with mobile and web apps preferred&lt;/li&gt;&lt;li&gt;Excellent communication skills, most notably a demonstrated ability to solicit and address creative and design feedback&lt;/li&gt;&lt;li&gt;Must be able to work under pressure and meet deadlines while maintaining a positive attitude and providing exemplary customer service&lt;/li&gt;&lt;li&gt;Ability to work independently and to carry out assignments to completion within parameters of instructions given, prescribed routines, and standard accepted practices&lt;/li&gt;&lt;/ul&gt;', 1, '15-05-2021 11:21:51'),
(5, 2, 'Custom Php Developer', 3, 4, 6, '0', '9', '2021-06-25', '&lt;strong&gt;&lt;/strong&gt;Company is a 2016 Iowa City-born start-up that develops consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est.', '&lt;p&gt;Company is a 2016 Iowa City-born start-up that develops consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Required Knowledge, Skills, and Abilities&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Ability to write code &amp;ndash; HTML &amp;amp; CSS (SCSS flavor of SASS preferred when writing CSS)&lt;/li&gt;&lt;li&gt;Proficient in Photoshop, Illustrator, bonus points for familiarity with Sketch (Sketch is our preferred concepting)&lt;/li&gt;&lt;li&gt;Cross-browser and platform testing as standard practice&lt;/li&gt;&lt;li&gt;Experience using Invision a plus&lt;/li&gt;&lt;li&gt;Experience in video production a plus or, at a minimum, a willingness to learn&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Education + Experience&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Advanced degree or equivalent experience in graphic and web design&lt;/li&gt;&lt;li&gt;3 or more years of professional design experience&lt;/li&gt;&lt;li&gt;Direct response email experience&lt;/li&gt;&lt;li&gt;Ecommerce website design experience&lt;/li&gt;&lt;li&gt;Familiarity with mobile and web apps preferred&lt;/li&gt;&lt;li&gt;Excellent communication skills, most notably a demonstrated ability to solicit and address creative and design feedback&lt;/li&gt;&lt;li&gt;Must be able to work under pressure and meet deadlines while maintaining a positive attitude and providing exemplary customer service&lt;/li&gt;&lt;li&gt;Ability to work independently and to carry out assignments to completion within parameters of instructions given, prescribed routines, and standard accepted practices&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 1, '15-05-2021 11:22:46'),
(6, 2, 'Marketing Coordinator - SEO / SEM Experience', 3, 1, 7, '0', '8', '2021-06-24', 'Company is a 2016 Iowa City-born start-up that develops consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est.', '&lt;p&gt;Company is a 2016 Iowa City-born start-up that develops consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Required Knowledge, Skills, and Abilities&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Ability to write code &amp;ndash; HTML &amp;amp; CSS (SCSS flavor of SASS preferred when writing CSS)&lt;/li&gt;&lt;li&gt;Proficient in Photoshop, Illustrator, bonus points for familiarity with Sketch (Sketch is our preferred concepting)&lt;/li&gt;&lt;li&gt;Cross-browser and platform testing as standard practice&lt;/li&gt;&lt;li&gt;Experience using Invision a plus&lt;/li&gt;&lt;li&gt;Experience in video production a plus or, at a minimum, a willingness to learn&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;strong&gt;Education + Experience&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Advanced degree or equivalent experience in graphic and web design&lt;/li&gt;&lt;li&gt;3 or more years of professional design experience&lt;/li&gt;&lt;li&gt;Direct response email experience&lt;/li&gt;&lt;li&gt;Ecommerce website design experience&lt;/li&gt;&lt;li&gt;Familiarity with mobile and web apps preferred&lt;/li&gt;&lt;li&gt;Excellent communication skills, most notably a demonstrated ability to solicit and address creative and design feedback&lt;/li&gt;&lt;li&gt;Must be able to work under pressure and meet deadlines while maintaining a positive attitude and providing exemplary customer service&lt;/li&gt;&lt;li&gt;Ability to work independently and to carry out assignments to completion within parameters of instructions given, prescribed routines, and standard accepted practices&lt;/li&gt;&lt;/ul&gt;', 1, '15-05-2021 11:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `ci_resignations`
--

CREATE TABLE `ci_resignations` (
  `resignation_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `notice_date` varchar(255) NOT NULL,
  `resignation_date` varchar(255) NOT NULL,
  `document_file` varchar(255) DEFAULT NULL,
  `is_signed` int(11) NOT NULL,
  `signed_file` varchar(255) DEFAULT NULL,
  `signed_date` varchar(255) DEFAULT NULL,
  `reason` mediumtext NOT NULL,
  `added_by` int(111) NOT NULL,
  `status` int(11) NOT NULL,
  `notify_send_to` text DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_resignations`
--

INSERT INTO `ci_resignations` (`resignation_id`, `company_id`, `employee_id`, `notice_date`, `resignation_date`, `document_file`, `is_signed`, `signed_file`, `signed_date`, `reason`, `added_by`, `status`, `notify_send_to`, `created_at`) VALUES
(2, 2, 3, '2021-10-09', '2021-10-09', '1633727431_e9f59bf7b9755d389658.pdf', 1, '1633729428_55b01f8885d7728a5d23.pdf', '08-10-2021 05:43:48', 'Test res', 2, 0, NULL, '08-10-2021 05:10:31');

-- --------------------------------------------------------

--
-- Table structure for table `ci_signature_documents`
--

CREATE TABLE `ci_signature_documents` (
  `document_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `folder_id` int(11) NOT NULL,
  `share_with_employees` int(10) NOT NULL DEFAULT 1,
  `document_file` varchar(255) NOT NULL,
  `document_name` varchar(255) DEFAULT NULL,
  `document_size` varchar(100) DEFAULT NULL,
  `signature_task` int(11) NOT NULL,
  `created_at` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_signature_documents`
--

INSERT INTO `ci_signature_documents` (`document_id`, `company_id`, `folder_id`, `share_with_employees`, `document_file`, `document_name`, `document_size`, `signature_task`, `created_at`) VALUES
(11, 2, 2, 3, '1633374747_2dd82cd39514d19a27bf.pdf', 'Doc File Testing', '41180', 1, '05-11-2021 03:00:00'),
(10, 2, 2, 0, '1633649999_7bf351b91ca153736907.pdf', 'Eagle Intake', '337748', 1, '07-10-2021 07:39:59');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sms_template`
--

CREATE TABLE `ci_sms_template` (
  `template_id` int(11) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sms_template`
--

INSERT INTO `ci_sms_template` (`template_id`, `subject`, `message`, `created_at`) VALUES
(1, 'New Project Assigned', 'Hello {firstname}, you have been assigned a new project {project_name}', '2021-07-01'),
(2, 'New Task Assigned', 'Hello {firstname}, you have been assigned a new task {task_name}', '2021-07-01'),
(3, 'New Award', 'Hello {firstname}, you have been awarded with {award_name}', '2021-07-01'),
(4, 'Leave Approved', 'Hello {firstname}, you leave has been approved {leave_name}', '2021-07-01'),
(5, 'Leave Rejected', 'Hello {firstname}, you leave has been rejected {leave_name}', '2021-07-01'),
(6, 'Payslip Created', 'Hello {firstname}, your salary has been paid. Amount {salary_amount}', '2021-07-01');

-- --------------------------------------------------------

--
-- Table structure for table `ci_staff_roles`
--

CREATE TABLE `ci_staff_roles` (
  `role_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `role_name` varchar(200) NOT NULL,
  `role_access` varchar(200) NOT NULL,
  `role_resources` longtext NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_staff_roles`
--

INSERT INTO `ci_staff_roles` (`role_id`, `company_id`, `role_name`, `role_access`, `role_resources`, `created_at`) VALUES
(1, 2, 'Master Role', '1', '0,attendance,hr_projects,project1,project1,project2,project3,project4,project5,project6,project7,project8,project9,project10,project11,projects_calendar,projects_sboard,pay_history,hradvance_salary,advance_salary1,advance_salary2,advance_salary3,advance_salary4,hrloan,loan1,loan2,loan3,loan4,hr_assets,asset1,asset1,asset2,asset3,asset4,asset_cat1,asset_cat1,asset_cat2,asset_cat3,asset_cat4,asset_brand1,asset_brand1,asset_brand2,asset_brand3,asset_brand4,hr_awards,award1,award1,award2,award3,award4,award_type1,award_type1,award_type2,award_type3,award_type4,hr_travel,travel1,travel1,travel2,travel3,travel4,travel5,travel_type1,travel_type1,travel_type2,travel_type3,travel_type4,travel_calendar,hr_leave,leave1,leave2,leave3,leave4,leave6,leave7,leave_calendar,leave_type1,leave_type1,leave_type2,leave_type3,leave_type4,overtime_req1,overtime_req1,overtime_req2,overtime_req3,overtime_req4,disciplinary1,upattendance1,upattendance1,upattendance2,upattendance3,upattendance4,hr_leads,leads1,leads2,leads3,leads4,leads5,hr_events,hr_event1,hr_event1,hr_event2,hr_event3,hr_event4,events_calendar,hr_conference,conference1,conference1,conference2,conference3,conference4,conference_calendar,hr_holidays,holiday1,holiday1,holiday2,holiday3,holiday4,holidays_calendar,hr_visitors,visitor1,visitor2,visitor3,visitor4,todo_ist,system_calendar,system_reports', '15-05-2021 05:15:20'),
(2, 2, 'Normal Role', '2', '0,attendance,project1,project2,project3,project4,project5,project6,project7,project8,project9,project10,projects_calendar,projects_sboard,hr_tasks,task1,task1,task2,task3,task4,task5,task6,task7,task8,tasks_calendar,tasks_sboard,pay1,pay1,pay2,pay3,pay_history,hr_helpdesk,helpdesk1,helpdesk2,helpdesk3,helpdesk4,helpdesk5,helpdesk6,helpdesk7,helpdesk8,hr_training,training1,training2,training3,training4,training6,training5,training7,trainer1,trainer1,trainer2,trainer3,trainer4,training_skill1,training_skill1,training_skill2,training_skill3,training_skill4,training_calendar,hr_assets,asset1,asset1,asset2,asset3,asset4,asset_cat1,asset_cat1,asset_cat2,asset_cat3,asset_cat4,asset_brand1,asset_brand1,asset_brand2,asset_brand3,asset_brand4,hr_awards,award1,award1,award2,award3,award4,award_type1,award_type1,award_type2,award_type3,award_type4,hr_travel,travel1,travel1,travel2,travel3,travel4,travel5,travel_type1,travel_type1,travel_type2,travel_type3,travel_type4,travel_calendar,hr_leave,leave1,leave2,leave3,leave4,leave6,leave7,leave_calendar,leave_type1,leave_type1,leave_type2,leave_type3,leave_type4,overtime_req1,overtime_req1,overtime_req2,overtime_req3,overtime_req4,hr_complaints,complaint1,complaint2,complaint3,complaint4,hr_resignations,resignation1,resignation2,resignation3,resignation4,hr_disciplinary,disciplinary1,disciplinary1,disciplinary2,disciplinary3,disciplinary5,case_type1,case_type1,case_type2,case_type3,case_type4,hr_picture,hr_events,hr_event1,hr_event1,hr_event2,hr_event3,hr_event4,events_calendar,hr_visitors,visitor1,visitor2,visitor3,visitor4,hr_files,file1,file1,file2,file3,file4,officialfile1,officialfile1,officialfile2,officialfile3,officialfile4,todo_ist', '16-05-2021 01:00:04'),
(3, 2, 'Third Role', '1', '0,attendance,hr_projects,project1,project1,project2,project3,project4,project5,project6,project7,project8,project9,project10,projects_calendar,projects_sboard,hr_tasks,task1,task1,task2,task3,task4,task5,task6,task7,task8,tasks_calendar,tasks_sboard,hr_payroll,pay1,pay1,pay2,pay3,pay_history,hr_helpdesk,helpdesk1,helpdesk2,helpdesk3,helpdesk4,helpdesk5,helpdesk6,helpdesk7,helpdesk8,hr_training,training1,training2,training3,training4,training6,training5,training7,trainer1,trainer1,trainer2,trainer3,trainer4,training_skill1,training_skill1,training_skill2,training_skill3,training_skill4,training_calendar,hr_assets,asset1,asset1,asset2,asset3,asset4,asset_cat1,asset_cat1,asset_cat2,asset_cat3,asset_cat4,asset_brand1,asset_brand1,asset_brand2,asset_brand3,asset_brand4,hr_awards,award1,award1,award2,award3,award4,award_type1,award_type1,award_type2,award_type3,award_type4,hr_travel,travel1,travel1,travel2,travel3,travel4,travel5,travel_type1,travel_type1,travel_type2,travel_type3,travel_type4,travel_calendar,hr_leave,leave1,leave2,leave3,leave4,leave6,leave7,leave_calendar,leave_type1,leave_type1,leave_type2,leave_type3,leave_type4,overtime_req1,overtime_req1,overtime_req2,overtime_req3,overtime_req4,hr_complaints,complaint1,complaint2,complaint3,complaint4,hr_resignations,resignation1,resignation2,resignation3,resignation4,hr_disciplinary,disciplinary1,disciplinary1,disciplinary2,disciplinary3,disciplinary5,case_type1,case_type1,case_type2,case_type3,case_type4,hr_staff,staff2,staff2,staff3,staff4,staff5,shift1,shift1,shift2,shift3,shift4,staffexit1,staffexit1,staffexit2,staffexit3,staffexit4,exit_type1,exit_type1,exit_type2,exit_type3,exit_type4,hr_profile,hr_basic_info,hr_personal_info,hr_picture,account_info,hr_documents,change_password,hr_ats,ats2,ats2,ats3,ats4,ats5,candidate,interview,promotion,core_hr,news1,news1,news2,news3,news4,department1,department1,department2,department3,department4,designation1,designation1,designation2,designation3,designation4,policy1,policy1,policy2,policy3,policy4,policy5,timesheet,upattendance1,upattendance1,upattendance2,upattendance3,upattendance4,monthly_time,hr_finance,accounts1,accounts1,accounts2,accounts3,accounts4,deposit1,deposit1,deposit2,deposit3,deposit4,expense1,expense1,expense2,expense3,expense4,transaction1,dep_cat1,dep_cat1,dep_cat2,dep_cat3,dep_cat4,exp_cat1,exp_cat1,exp_cat2,exp_cat3,exp_cat4,hr_talent,indicator1,indicator1,indicator2,indicator3,indicator4,appraisal1,appraisal1,appraisal2,appraisal3,appraisal4,competency1,competency1,competency2,competency3,competency4,tracking1,tracking1,tracking2,tracking3,tracking4,tracking5,track_type1,track_type1,track_type2,track_type3,track_type4,track_calendar,hr_clients,client1,client2,client3,client4,hr_invoices,invoice1,invoice2,invoice3,invoice4,invoice5,invoice_payments,invoice_calendar,tax_type1,tax_type1,tax_type2,tax_type3,tax_type4,hr_events,hr_event1,hr_event1,hr_event2,hr_event3,hr_event4,events_calendar,hr_conference,conference1,conference1,conference2,conference3,conference4,conference_calendar,hr_holidays,holiday1,holiday1,holiday2,holiday3,holiday4,holidays_calendar,hr_visitors,visitor1,visitor2,visitor3,visitor4,hr_files,file1,file1,file2,file3,file4,officialfile1,officialfile1,officialfile2,officialfile3,officialfile4,todo_ist,system_calendar,system_reports', '16-05-2021 10:13:30'),
(4, 24, 'Manager', '2', '0,attendance,hr_projects,project1,project1,project2,project3,project4,project5,project6,project7,project8,project9,project10,project11,projects_calendar,projects_sboard,hr_tasks,task1,task1,task2,task3,task4,task5,task6,task7,task8,tasks_calendar,tasks_sboard,hr_helpdesk,helpdesk1,helpdesk2,helpdesk3,helpdesk4,helpdesk5,helpdesk6,helpdesk7,helpdesk8,hr_assets,asset1,asset1,asset2,asset3,asset4,asset_cat1,asset_cat1,asset_cat2,asset_cat3,asset_cat4,asset_brand1,asset_brand1,asset_brand2,asset_brand3,asset_brand4,hr_incidents,incident1,incident1,incident2,incident3,incident4,incident_type1,incident_type1,incident_type2,incident_type3,incident_type4,hr_awards,award1,award1,award2,award3,award4,award_type1,award_type1,award_type2,award_type3,award_type4,hr_travel,travel1,travel1,travel2,travel3,travel4,travel5,travel_type1,travel_type1,travel_type2,travel_type3,travel_type4,travel_calendar,hr_leave,leave1,leave2,leave3,leave4,leave6,leave7,leave_calendar,leave_adjustment,leave_adjustment,leave_adjustment1,leave_adjustment2,leave_adjustment3,leave_adjustment4,leave_type1,leave_type1,leave_type2,leave_type3,leave_type4,overtime_req1,overtime_req1,overtime_req2,overtime_req3,overtime_req4,hr_complaints,complaint1,complaint2,complaint3,complaint4,hr_resignations,resignation1,resignation2,resignation3,resignation4,hr_disciplinary,disciplinary1,disciplinary1,disciplinary2,disciplinary3,disciplinary5,case_type1,case_type1,case_type2,case_type3,case_type4,hr_transfers,transfers1,transfers2,transfers3,transfers4,staff2,staff2,staff3,staff4,staff5,shift1,shift1,shift2,shift3,shift4,staffexit1,staffexit1,staffexit2,staffexit3,staffexit4,exit_type1,exit_type1,exit_type2,exit_type3,exit_type4,news1,news1,news2,news3,news4,department1,designation1,designation1,designation2,designation3,designation4,policy1,policy1,policy2,policy3,policy4,policy5,org_chart,timesheet,upattendance1,upattendance1,upattendance2,upattendance3,upattendance4,monthly_time,hr_talent,indicator1,indicator1,indicator2,indicator3,indicator4,appraisal1,appraisal1,appraisal2,appraisal3,appraisal4,competency1,competency1,competency2,competency3,competency4,tracking1,tracking1,tracking2,tracking3,tracking4,tracking5,track_type1,track_type1,track_type2,track_type3,track_type4,track_calendar,hr_events,hr_event1,hr_event1,hr_event2,hr_event3,hr_event4,events_calendar,hr_conference,conference1,conference1,conference2,conference3,conference4,conference_calendar,hr_holidays,holiday1,holiday1,holiday2,holiday3,holiday4,holidays_calendar,hr_files,file1,file1,file2,file3,file4,officialfile1,officialfile1,officialfile2,officialfile3,officialfile4,todo_ist,system_calendar,system_reports', '23-11-2021 09:19:33'),
(5, 24, 'Employee', '2', '0,attendance,hr_projects,project1,project1,project2,project3,project4,project5,project6,project7,project8,project9,project10,project11,projects_calendar,projects_sboard,hr_tasks,task1,task1,task2,task3,task4,task5,task6,task7,task8,tasks_calendar,tasks_sboard,hr_helpdesk,helpdesk1,helpdesk2,helpdesk3,helpdesk4,helpdesk5,helpdesk6,helpdesk7,helpdesk8,hr_assets,asset1,asset1,asset2,asset3,asset4,asset_cat1,asset_cat1,asset_cat2,asset_cat3,asset_cat4,asset_brand1,asset_brand1,asset_brand2,asset_brand3,asset_brand4,hr_incidents,incident1,incident1,incident2,incident3,incident4,incident_type1,incident_type1,incident_type2,incident_type3,incident_type4,hr_awards,award1,award1,award2,award3,award4,award_type1,award_type1,award_type2,award_type3,award_type4,travel1,travel2,travel3,travel_type1,travel_type1,travel_type2,travel_type3,travel_type4,travel_calendar,leave2,leave3,leave_calendar,leave_adjustment,leave_adjustment1,leave_adjustment2,leave_adjustment3,leave_type1,overtime_req1,overtime_req2,hr_complaints,complaint1,complaint2,complaint3,complaint4,hr_resignations,resignation1,resignation2,resignation3,resignation4,disciplinary1,case_type1,hr_transfers,transfers1,transfers2,transfers3,transfers4,staff2,staff4,staffexit1,staffexit1,staffexit2,staffexit3,staffexit4,exit_type1,exit_type1,exit_type2,exit_type3,exit_type4,hr_profile,hr_basic_info,hr_personal_info,hr_picture,account_info,hr_documents,change_password,news1,department1,designation1,policy1,policy5,org_chart,upattendance1,upattendance2,monthly_time,hr_event1,events_calendar,conference1,conference2,conference3,conference_calendar,holidays_calendar,file1,todo_ist,system_calendar', '23-11-2021 10:10:37');

-- --------------------------------------------------------

--
-- Table structure for table `ci_staff_signature_documents`
--

CREATE TABLE `ci_staff_signature_documents` (
  `document_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `signature_file_id` int(11) NOT NULL,
  `signature_task` varchar(100) NOT NULL,
  `is_signed` int(11) NOT NULL,
  `signed_file` varchar(255) DEFAULT NULL,
  `signed_date` varchar(100) DEFAULT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_staff_signature_documents`
--

INSERT INTO `ci_staff_signature_documents` (`document_id`, `company_id`, `staff_id`, `signature_file_id`, `signature_task`, `is_signed`, `signed_file`, `signed_date`, `created_at`) VALUES
(14, 2, 3, 10, '1', 1, '1633650086_527fe936bdbe5e80f70b.pdf', '07-10-2021 07:41:26', '07-10-2021 07:39:59'),
(15, 2, 4, 10, '1', 0, '', '', '07-10-2021 07:39:59'),
(16, 2, 5, 10, '1', 0, '', '', '07-10-2021 07:39:59'),
(17, 2, 6, 10, '1', 0, '', '', '07-10-2021 07:39:59'),
(18, 2, 7, 10, '1', 0, '', '', '07-10-2021 07:39:59'),
(19, 2, 8, 10, '1', 0, '', '', '07-10-2021 07:39:59'),
(20, 2, 3, 11, '1', 0, '', '', '05-11-2021 03:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ci_stock_orders`
--

CREATE TABLE `ci_stock_orders` (
  `order_id` int(111) NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `invoice_month` varchar(255) DEFAULT NULL,
  `invoice_date` varchar(255) NOT NULL,
  `invoice_due_date` varchar(255) NOT NULL,
  `sub_total_amount` decimal(65,2) NOT NULL DEFAULT 0.00,
  `discount_type` varchar(11) NOT NULL,
  `discount_figure` decimal(65,2) NOT NULL DEFAULT 0.00,
  `total_tax` decimal(65,2) NOT NULL DEFAULT 0.00,
  `tax_type` varchar(100) DEFAULT NULL,
  `total_discount` decimal(65,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(65,2) NOT NULL DEFAULT 0.00,
  `invoice_note` mediumtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_stock_order_items`
--

CREATE TABLE `ci_stock_order_items` (
  `order_item_id` int(111) NOT NULL,
  `order_id` int(111) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `item_qty` varchar(255) NOT NULL,
  `item_unit_price` decimal(65,2) NOT NULL DEFAULT 0.00,
  `item_sub_total` decimal(65,2) NOT NULL DEFAULT 0.00,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_stock_order_quotes`
--

CREATE TABLE `ci_stock_order_quotes` (
  `quote_id` int(111) NOT NULL,
  `quote_number` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `quote_month` varchar(255) DEFAULT NULL,
  `quote_date` varchar(255) NOT NULL,
  `quote_due_date` varchar(255) NOT NULL,
  `sub_total_amount` decimal(65,2) NOT NULL DEFAULT 0.00,
  `discount_type` varchar(11) NOT NULL,
  `discount_figure` decimal(65,2) NOT NULL DEFAULT 0.00,
  `total_tax` decimal(65,2) NOT NULL DEFAULT 0.00,
  `tax_type` varchar(100) DEFAULT NULL,
  `total_discount` decimal(65,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(65,2) NOT NULL DEFAULT 0.00,
  `quote_note` mediumtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_stock_order_quote_items`
--

CREATE TABLE `ci_stock_order_quote_items` (
  `quote_item_id` int(111) NOT NULL,
  `quote_id` int(111) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `item_qty` varchar(255) NOT NULL,
  `item_unit_price` decimal(65,2) NOT NULL DEFAULT 0.00,
  `item_sub_total` decimal(65,2) NOT NULL DEFAULT 0.00,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_stock_products`
--

CREATE TABLE `ci_stock_products` (
  `product_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_qty` int(11) NOT NULL,
  `reorder_stock` int(11) NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `barcode_type` varchar(255) DEFAULT NULL,
  `warehouse_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_sku` varchar(255) DEFAULT NULL,
  `product_serial_number` varchar(255) DEFAULT NULL,
  `purchase_price` decimal(65,2) NOT NULL,
  `retail_price` decimal(65,2) NOT NULL,
  `expiration_date` varchar(255) DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_description` longtext DEFAULT NULL,
  `product_rating` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_stock_purchases`
--

CREATE TABLE `ci_stock_purchases` (
  `purchase_id` int(111) NOT NULL,
  `purchase_number` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `purchase_month` varchar(255) DEFAULT NULL,
  `purchase_date` varchar(255) NOT NULL,
  `sub_total_amount` decimal(65,2) NOT NULL DEFAULT 0.00,
  `discount_type` varchar(11) NOT NULL,
  `discount_figure` decimal(65,2) NOT NULL DEFAULT 0.00,
  `total_tax` decimal(65,2) NOT NULL DEFAULT 0.00,
  `tax_type` varchar(100) DEFAULT NULL,
  `total_discount` decimal(65,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(65,2) NOT NULL DEFAULT 0.00,
  `purchase_note` mediumtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_stock_purchase_items`
--

CREATE TABLE `ci_stock_purchase_items` (
  `purchase_item_id` int(111) NOT NULL,
  `purchase_id` int(111) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_qty` varchar(255) NOT NULL,
  `item_unit_price` decimal(65,2) NOT NULL DEFAULT 0.00,
  `item_sub_total` decimal(65,2) NOT NULL DEFAULT 0.00,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_stock_suppliers`
--

CREATE TABLE `ci_stock_suppliers` (
  `supplier_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `supplier_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `registration_no` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `contact_number` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `address_1` text CHARACTER SET utf8 DEFAULT NULL,
  `address_2` text CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `zipcode` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `country` int(111) NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ci_stock_warehouses`
--

CREATE TABLE `ci_stock_warehouses` (
  `warehouse_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `warehouse_name` varchar(200) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `pickup_location` tinyint(1) NOT NULL,
  `address_1` text DEFAULT NULL,
  `address_2` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `country` int(111) NOT NULL,
  `added_by` int(111) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_suggestions`
--

CREATE TABLE `ci_suggestions` (
  `suggestion_id` int(111) NOT NULL,
  `company_id` int(111) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_suggestions`
--

INSERT INTO `ci_suggestions` (`suggestion_id`, `company_id`, `title`, `description`, `attachment`, `added_by`, `created_at`) VALUES
(9, 2, 'Shift Calendar', 'New Suggestion 2 Desc', '1637265255_7e434fe83d2da803b469.png', 2, '18-11-2021 02:33:06'),
(10, 24, 'Test ', 'Test suggestion', '', 25, '13-01-2022 12:52:21');

-- --------------------------------------------------------

--
-- Table structure for table `ci_suggestion_comments`
--

CREATE TABLE `ci_suggestion_comments` (
  `comment_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `suggestion_id` int(11) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `suggestion_comment` text DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_suggestion_comments`
--

INSERT INTO `ci_suggestion_comments` (`comment_id`, `company_id`, `suggestion_id`, `employee_id`, `suggestion_comment`, `created_at`) VALUES
(1, 2, 2, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '15-05-2021 03:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `ci_support_tickets`
--

CREATE TABLE `ci_support_tickets` (
  `ticket_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `ticket_code` varchar(200) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `ticket_priority` varchar(255) NOT NULL,
  `department_id` int(111) NOT NULL,
  `description` mediumtext NOT NULL,
  `ticket_remarks` mediumtext DEFAULT NULL,
  `ticket_status` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_support_tickets`
--

INSERT INTO `ci_support_tickets` (`ticket_id`, `company_id`, `ticket_code`, `subject`, `employee_id`, `ticket_priority`, `department_id`, `description`, `ticket_remarks`, `ticket_status`, `created_by`, `created_at`) VALUES
(1, 2, 'WKEKlK', 'Support for website', 3, '2', 1, '&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;h6 style=\"font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;\"&gt;More Information&lt;/h6&gt;&lt;hr style=\"box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);\" /&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=\"m-b-20 col-sm-12\" style=\"box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;div class=\"row\" style=\"box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;\"&gt;&lt;div class=\"col-md-12 col-lg-6\" style=\"box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;\"&gt;&lt;div class=\"text-primary f-14 m-b-10\" style=\"box-sizing:border-box;margin-bottom:10px;color:#7267ef;\"&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=\"col-md-12 col-lg-6\" style=\"box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;\"&gt;&lt;div class=\"text-primary f-14 m-b-10\" style=\"box-sizing:border-box;margin-bottom:10px;color:#7267ef;\"&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;span style=\"color:#060606;font-size:0.9375rem;\"&gt;&lt;/span&gt;&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;&lt;/p&gt;&lt;/div&gt;', '', '1', 2, '15-05-2021 02:05:18'),
(2, 2, 'lJ0eOO', 'Unable to set automated email response', 5, '3', 3, '&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;h6 style=\"font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;\"&gt;More Information&lt;/h6&gt;&lt;hr style=\"box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);\" /&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=\"m-b-20 col-sm-12\" style=\"box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;div class=\"row\" style=\"box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;\"&gt;&lt;div class=\"col-md-12 col-lg-6\" style=\"box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;\"&gt;&lt;div class=\"text-primary f-14 m-b-10\" style=\"box-sizing:border-box;margin-bottom:10px;color:#7267ef;\"&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=\"col-md-12 col-lg-6\" style=\"box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;\"&gt;&lt;div class=\"text-primary f-14 m-b-10\" style=\"box-sizing:border-box;margin-bottom:10px;color:#7267ef;\"&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;span style=\"color:#060606;font-size:0.9375rem;\"&gt;&lt;/span&gt;&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;&lt;/p&gt;&lt;/div&gt;', '', '1', 2, '15-05-2021 02:09:43'),
(3, 2, '1er1OO', 'Setup Local Payment Gateway', 6, '4', 4, '&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;h6 style=\"font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;\"&gt;What we need&lt;/h6&gt;&lt;hr style=\"box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);\" /&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=\"m-b-20 col-sm-12\" style=\"box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;div class=\"row\" style=\"box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;\"&gt;&lt;div class=\"col-md-12 col-lg-6\" style=\"box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;\"&gt;&lt;div class=\"text-primary f-14 m-b-10\" style=\"box-sizing:border-box;margin-bottom:10px;color:#7267ef;\"&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=\"col-md-12 col-lg-6\" style=\"box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;\"&gt;&lt;div class=\"text-primary f-14 m-b-10\" style=\"box-sizing:border-box;margin-bottom:10px;color:#7267ef;\"&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;h6 style=\"font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;\"&gt;Requirements&lt;/h6&gt;&lt;hr style=\"box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);\" /&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;', '', '1', 2, '15-05-2021 02:10:38'),
(4, 2, '03KK8q', 'Payment was rejected', 3, '3', 1, '&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;h6 style=\"font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;\"&gt;What we need&lt;/h6&gt;&lt;hr style=\"box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);\" /&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=\"m-b-20 col-sm-12\" style=\"box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;div class=\"row\" style=\"box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;\"&gt;&lt;div class=\"col-md-12 col-lg-6\" style=\"box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;\"&gt;&lt;div class=\"text-primary f-14 m-b-10\" style=\"box-sizing:border-box;margin-bottom:10px;color:#7267ef;\"&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=\"col-md-12 col-lg-6\" style=\"box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;\"&gt;&lt;div class=\"text-primary f-14 m-b-10\" style=\"box-sizing:border-box;margin-bottom:10px;color:#7267ef;\"&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;h6 style=\"font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;\"&gt;Requirements&lt;/h6&gt;&lt;hr style=\"box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);\" /&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;', '', '1', 2, '15-05-2021 02:11:05'),
(5, 24, '0KW3Io', 'Testing Ticket system', 26, '3', 9, 'Testing Ticket system', '', '1', 26, '31-12-2021 11:45:45'),
(6, 24, '8K8lo3', 'Testing ticket - Employee', 26, '3', 9, 'Testing', '', '1', 26, '05-01-2022 05:17:05');

-- --------------------------------------------------------

--
-- Table structure for table `ci_support_ticket_files`
--

CREATE TABLE `ci_support_ticket_files` (
  `ticket_file_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `file_title` varchar(255) NOT NULL,
  `attachment_file` mediumtext NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_support_ticket_notes`
--

CREATE TABLE `ci_support_ticket_notes` (
  `ticket_note_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `ticket_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `ticket_note` text DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_support_ticket_reply`
--

CREATE TABLE `ci_support_ticket_reply` (
  `ticket_reply_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `ticket_id` int(111) NOT NULL,
  `sent_by` int(11) NOT NULL,
  `assign_to` int(11) NOT NULL,
  `reply_text` text DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_support_ticket_reply`
--

INSERT INTO `ci_support_ticket_reply` (`ticket_reply_id`, `company_id`, `ticket_id`, `sent_by`, `assign_to`, `reply_text`, `created_at`) VALUES
(1, 2, 1, 2, 3, '&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;h6 style=\"font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;\"&gt;More Information&lt;/h6&gt;&lt;hr style=\"box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);\" /&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=\"m-b-20 col-sm-12\" style=\"box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;div class=\"row\" style=\"box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;\"&gt;&lt;div class=\"col-md-12 col-lg-6\" style=\"box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;\"&gt;&lt;div class=\"text-primary f-14 m-b-10\" style=\"box-sizing:border-box;margin-bottom:10px;color:#7267ef;\"&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=\"col-md-12 col-lg-6\" style=\"box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;\"&gt;&lt;div class=\"text-primary f-14 m-b-10\" style=\"box-sizing:border-box;margin-bottom:10px;color:#7267ef;\"&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;span style=\"color:#060606;font-size:0.9375rem;\"&gt;&lt;/span&gt;&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;&lt;/p&gt;&lt;/div&gt;', '15-05-2021 02:05:18'),
(2, 2, 2, 2, 5, '&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;h6 style=\"font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;\"&gt;More Information&lt;/h6&gt;&lt;hr style=\"box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);\" /&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=\"m-b-20 col-sm-12\" style=\"box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;div class=\"row\" style=\"box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;\"&gt;&lt;div class=\"col-md-12 col-lg-6\" style=\"box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;\"&gt;&lt;div class=\"text-primary f-14 m-b-10\" style=\"box-sizing:border-box;margin-bottom:10px;color:#7267ef;\"&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=\"col-md-12 col-lg-6\" style=\"box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;\"&gt;&lt;div class=\"text-primary f-14 m-b-10\" style=\"box-sizing:border-box;margin-bottom:10px;color:#7267ef;\"&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;span style=\"color:#060606;font-size:0.9375rem;\"&gt;&lt;/span&gt;&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;&lt;/p&gt;&lt;/div&gt;', '15-05-2021 02:09:43'),
(3, 2, 3, 2, 6, '&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;h6 style=\"font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;\"&gt;What we need&lt;/h6&gt;&lt;hr style=\"box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);\" /&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=\"m-b-20 col-sm-12\" style=\"box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;div class=\"row\" style=\"box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;\"&gt;&lt;div class=\"col-md-12 col-lg-6\" style=\"box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;\"&gt;&lt;div class=\"text-primary f-14 m-b-10\" style=\"box-sizing:border-box;margin-bottom:10px;color:#7267ef;\"&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=\"col-md-12 col-lg-6\" style=\"box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;\"&gt;&lt;div class=\"text-primary f-14 m-b-10\" style=\"box-sizing:border-box;margin-bottom:10px;color:#7267ef;\"&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;h6 style=\"font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;\"&gt;Requirements&lt;/h6&gt;&lt;hr style=\"box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);\" /&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;', '15-05-2021 02:10:38'),
(4, 2, 4, 2, 3, '&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;h6 style=\"font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;\"&gt;What we need&lt;/h6&gt;&lt;hr style=\"box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);\" /&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=\"m-b-20 col-sm-12\" style=\"box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;div class=\"row\" style=\"box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;\"&gt;&lt;div class=\"col-md-12 col-lg-6\" style=\"box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;\"&gt;&lt;div class=\"text-primary f-14 m-b-10\" style=\"box-sizing:border-box;margin-bottom:10px;color:#7267ef;\"&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=\"col-md-12 col-lg-6\" style=\"box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;\"&gt;&lt;div class=\"text-primary f-14 m-b-10\" style=\"box-sizing:border-box;margin-bottom:10px;color:#7267ef;\"&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=\"m-b-20\" style=\"box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;h6 style=\"font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;\"&gt;Requirements&lt;/h6&gt;&lt;hr style=\"box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);\" /&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;\"&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;', '15-05-2021 02:11:05'),
(5, 24, 5, 26, 26, 'Testing Ticket system', '31-12-2021 11:45:45'),
(6, 24, 6, 26, 26, 'Testing', '05-01-2022 05:17:05');

-- --------------------------------------------------------

--
-- Table structure for table `ci_system_documents`
--

CREATE TABLE `ci_system_documents` (
  `document_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `document_type` varchar(255) NOT NULL,
  `document_file` varchar(255) NOT NULL,
  `created_at` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_tasks`
--

CREATE TABLE `ci_tasks` (
  `task_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `project_id` int(111) NOT NULL,
  `task_type` varchar(200) NOT NULL DEFAULT 'project',
  `task_name` varchar(255) NOT NULL,
  `assigned_to` varchar(255) DEFAULT NULL,
  `associated_goals` text DEFAULT NULL,
  `start_date` varchar(200) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `task_hour` varchar(200) DEFAULT NULL,
  `task_progress` varchar(200) DEFAULT NULL,
  `summary` text NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `task_status` int(5) NOT NULL,
  `task_note` mediumtext DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_tasks`
--

INSERT INTO `ci_tasks` (`task_id`, `company_id`, `project_id`, `task_type`, `task_name`, `assigned_to`, `associated_goals`, `start_date`, `end_date`, `task_hour`, `task_progress`, `summary`, `description`, `task_status`, `task_note`, `created_by`, `created_at`) VALUES
(1, 2, 4, 'project', 'Patient Profile add', '0,5,6,7', '0,136,135,134', '2021-05-18', '2021-05-20', '10', '30', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. When an unknown printer took a galley of type and scrambled it.', '&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;What we need&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20 col-sm-12&#34; style=&#34;box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;div class=&#34;row&#34; style=&#34;box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;&#34;&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;Requirements&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;', 1, '', 2, '15-05-2021 01:51:41'),
(2, 2, 3, 'project', ' Layout Featuring', '0,3,6', NULL, '2021-05-31', '2021-06-05', '10', '65', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. When an unknown printer took a galley of type and scrambled it.', '&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;What we need&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20 col-sm-12&#34; style=&#34;box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;div class=&#34;row&#34; style=&#34;box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;&#34;&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;Requirements&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;', 3, '', 2, '15-05-2021 01:53:06'),
(3, 2, 2, 'project', 'Private chat module', '0,4,5,7', NULL, '2021-05-26', '2021-06-08', '20', '100', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. When an unknown printer took a galley of type and scrambled it.', '&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;What we need&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20 col-sm-12&#34; style=&#34;box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;div class=&#34;row&#34; style=&#34;box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;&#34;&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;Requirements&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;', 2, '', 2, '15-05-2021 01:54:15'),
(4, 2, 4, 'project', 'asdsads', '0,3,5', '0', '2021-06-23', '2021-06-23', '2', '0', 'asdasdasdfsd fsdfasdf adsfdsf sdfsdafdsfdsfdsdsf sdf sdfsdfd sdafsadfds asdfsdfdf', 'asdasdasds', 0, '', 2, '23-06-2021 07:20:43'),
(6, 2, 0, 'general', 'General Task 1', '0,3,4', '0', '2021-11-19', '2021-11-20', '12', '0', 'General Task 1General Task 1General Task 1General Task 1General Task 1', 'General Task 1', 0, '', 2, '19-11-2021 10:44:55'),
(7, 2, 0, 'general', 'hjgjhg', '0,5,7', '0', '2021-11-20', '2021-11-21', '2', '33', 'sadfdf dfasdf sadfdf dfasdf sadfdf dfasdf sadfdf dfasdf sadfdf dfasdf ', 'sadfdf dfasdf sadfdf dfasdf sadfdf dfasdf sadfdf dfasdf sadfdf dfasdf&amp;nbsp;', 1, '', 2, '20-11-2021 12:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `ci_tasks_discussion`
--

CREATE TABLE `ci_tasks_discussion` (
  `task_discussion_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `discussion_text` text DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_tasks_files`
--

CREATE TABLE `ci_tasks_files` (
  `task_file_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `file_title` varchar(255) NOT NULL,
  `attachment_file` mediumtext NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_tasks_notes`
--

CREATE TABLE `ci_tasks_notes` (
  `task_note_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `task_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `task_note` text DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_terminations`
--

CREATE TABLE `ci_terminations` (
  `termination_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `notice_date` varchar(255) NOT NULL,
  `termination_date` varchar(255) NOT NULL,
  `document_file` varchar(255) DEFAULT NULL,
  `is_signed` int(11) NOT NULL,
  `signed_file` varchar(255) DEFAULT NULL,
  `signed_date` varchar(255) DEFAULT NULL,
  `reason` mediumtext NOT NULL,
  `added_by` int(111) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_terminations`
--

INSERT INTO `ci_terminations` (`termination_id`, `company_id`, `employee_id`, `notice_date`, `termination_date`, `document_file`, `is_signed`, `signed_file`, `signed_date`, `reason`, `added_by`, `status`, `created_at`) VALUES
(3, 2, 3, '2021-11-01', '2021-11-01', '1635784055_721ca4f97e96c8223457.pdf', 0, '', '', 'sdasdasdasds22', 2, 0, '01-11-2021 12:27:35');

-- --------------------------------------------------------

--
-- Table structure for table `ci_timesheet`
--

CREATE TABLE `ci_timesheet` (
  `time_attendance_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `attendance_date` varchar(255) NOT NULL,
  `clock_in` varchar(255) NOT NULL,
  `clock_in_ip_address` varchar(255) NOT NULL,
  `clock_out` varchar(255) NOT NULL,
  `clock_out_ip_address` varchar(255) NOT NULL,
  `clock_in_out` varchar(255) NOT NULL,
  `clock_in_latitude` varchar(150) NOT NULL,
  `clock_in_longitude` varchar(150) NOT NULL,
  `clock_out_latitude` varchar(150) NOT NULL,
  `clock_out_longitude` varchar(150) NOT NULL,
  `time_late` varchar(255) NOT NULL,
  `early_leaving` varchar(255) NOT NULL,
  `overtime` varchar(255) NOT NULL,
  `total_work` varchar(255) NOT NULL,
  `total_rest` varchar(255) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `work_from_home` int(11) NOT NULL,
  `lunch_breakin` varchar(200) DEFAULT NULL,
  `lunch_breakout` varchar(200) DEFAULT NULL,
  `attendance_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_timesheet`
--

INSERT INTO `ci_timesheet` (`time_attendance_id`, `company_id`, `employee_id`, `attendance_date`, `clock_in`, `clock_in_ip_address`, `clock_out`, `clock_out_ip_address`, `clock_in_out`, `clock_in_latitude`, `clock_in_longitude`, `clock_out_latitude`, `clock_out_longitude`, `time_late`, `early_leaving`, `overtime`, `total_work`, `total_rest`, `shift_id`, `work_from_home`, `lunch_breakin`, `lunch_breakout`, `attendance_status`) VALUES
(20, 2, 3, '2021-11-07', '2021-11-07 02:25:39', '::1', '2021-11-07 02:30:41', '::1', '0', '1', '1', '1', '1', '2021-11-07 02:25:39', '2021-11-07 02:30:41', '2021-11-07 02:30:41', '0:5', '', 1, 1, '0', '0', 'Present'),
(40, 2, 4, '2021-11-08', '2021-11-08 06:01:00', '1', '2021-11-08 06:30:00', '1', '0', '1', '1', '1', '1', '2021-11-08 06:01:00', '2021-11-08 06:30:00', '2021-11-08 06:30:00', '0:29', '0', 1, 0, '0', '0', 'Present'),
(41, 2, 5, '2021-11-08', '2021-11-08 18:01:00', '1', '2021-11-08 18:20:00', '1', '0', '1', '1', '1', '1', '2021-11-08 18:01:00', '2021-11-08 18:20:00', '2021-11-08 18:20:00', '0:19', '0', 1, 0, '0', '0', 'Present'),
(42, 2, 3, '2021-11-09', '2021-11-09 06:01:00', '1', '2021-11-09 06:20:00', '1', '0', '1', '1', '1', '1', '2021-11-09 06:01:00', '2021-11-09 06:20:00', '2021-11-09 06:20:00', '0:19', '0', 1, 0, '0', '0', 'Present'),
(43, 2, 5, '2021-11-09', '2021-11-09 18:01:00', '1', '2021-11-09 18:20:00', '1', '0', '1', '1', '1', '1', '2021-11-09 18:01:00', '2021-11-09 18:20:00', '2021-11-09 18:20:00', '0:19', '0', 1, 0, '0', '0', 'Present'),
(44, 2, 3, '2021-11-20', '2021-11-20 10:09:16', '24.85.223.110', '2021-11-20 10:22:52', '24.85.223.110', '0', '49.0453254', '-122.7689099', '49.0391218', '-122.7853524', '2021-11-20 10:09:16', '2021-11-20 10:22:52', '2021-11-20 10:22:52', '0:13', '', 1, 0, '0', '0', 'Present'),
(45, 2, 3, '2021-11-20', '2021-11-20 10:22:58', '24.85.223.110', '2021-11-20 14:58:31', '24.85.223.110', '0', '49.0391218', '-122.7853524', '49.0391218', '-122.7853524', '2021-11-20 10:22:58', '2021-11-20 14:58:31', '2021-11-20 14:58:31', '4:35', '0:0', 1, 0, '2021-11-20 14:58:07', '2021-11-20 14:58:26', 'Present'),
(46, 2, 3, '2021-11-21', '2021-11-21 01:49:26', '24.85.223.110', '2021-11-21 01:52:43', '24.85.223.110', '0', '49.045326', '-122.7689041', '49.0451679', '-122.7689391', '2021-11-21 01:49:26', '2021-11-21 01:52:43', '2021-11-21 01:52:43', '0:3', '', 1, 0, '2021-11-21 01:49:40', '0', 'Present'),
(48, 2, 3, '2021-11-21', '2021-11-21 01:53:40', '24.85.223.110', '2021-11-21 03:02:13', '24.85.223.110', '0', '49.0451679', '-122.7689391', '49.0391218', '-122.7853524', '2021-11-21 01:53:40', '2021-11-21 03:02:13', '2021-11-21 03:02:13', '1:8', '0:0', 1, 1, '0', '0', 'Present'),
(49, 2, 3, '2021-11-21', '2021-11-21 03:02:18', '24.85.223.110', '2021-11-21 17:44:45', '24.85.223.110', '0', '49.0391218', '-122.7853524', '49.0480615', '-122.7581998', '2021-11-21 03:02:18', '2021-11-21 17:44:45', '2021-11-21 17:44:45', '14:42', '0:0', 1, 0, '0', '0', 'Present'),
(50, 2, 3, '2021-11-21', '2021-11-21 17:44:50', '24.85.223.110', '2021-11-21 17:51:36', '24.85.223.110', '0', '49.0480615', '-122.7581998', '49.0480615', '-122.7581998', '2021-11-21 17:44:50', '2021-11-21 17:51:36', '2021-11-21 17:51:36', '0:6', '0:0', 1, 0, '2021-11-21 17:48:50', '2021-11-21 17:50:13', 'Present'),
(51, 2, 3, '2021-11-22', '2021-11-22 10:09:37', '24.85.223.110', '2021-11-22 10:17:37', '24.85.223.110', '0', '49.0453466', '-122.7688722', '49.0480615', '-122.7581998', '2021-11-22 10:09:37', '2021-11-22 10:17:37', '2021-11-22 10:17:37', '0:8', '', 1, 1, '2021-11-22 10:13:58', '2021-11-22 10:17:32', 'Present'),
(53, 2, 3, '2021-11-23', '2021-11-23 09:00:00', '1', '2021-11-23 17:00:00', '1', '0', '1', '1', '1', '1', '2021-11-23 09:00:00', '2021-11-23 17:00:00', '2021-11-23 17:00:00', '8:0', '0', 1, 0, '0', '0', 'Present'),
(54, 2, 4, '2021-11-23', '2021-11-23 09:00:00', '1', '2021-11-23 17:00:00', '1', '0', '1', '1', '1', '1', '2021-11-23 09:00:00', '2021-11-23 17:00:00', '2021-11-23 17:00:00', '8:0', '0', 1, 0, '0', '0', 'Present'),
(55, 2, 3, '2021-11-24', '2021-11-24 09:00:00', '1', '2021-11-24 17:00:00', '1', '0', '1', '1', '1', '1', '2021-11-24 09:00:00', '2021-11-24 17:00:00', '2021-11-24 17:00:00', '8:0', '0', 1, 0, '0', '0', 'Present'),
(56, 2, 4, '2021-11-24', '2021-11-24 09:00:00', '1', '2021-11-24 17:00:00', '1', '0', '1', '1', '1', '1', '2021-11-24 09:00:00', '2021-11-24 17:00:00', '2021-11-24 17:00:00', '8:0', '0', 1, 0, '0', '0', 'Present'),
(57, 2, 4, '2021-11-15', '2021-11-15 09:00:00', '1', '2021-11-15 17:00:00', '1', '0', '1', '1', '1', '1', '2021-11-15 09:00:00', '2021-11-15 17:00:00', '2021-11-15 17:00:00', '8:0', '0', 1, 0, '0', '0', 'Present'),
(58, 2, 4, '2021-11-16', '2021-11-16 09:00:00', '1', '2021-11-16 17:00:00', '1', '0', '1', '1', '1', '1', '2021-11-16 09:00:00', '2021-11-16 17:00:00', '2021-11-16 17:00:00', '8:0', '0', 1, 0, '0', '0', 'Present'),
(59, 2, 4, '2021-11-17', '2021-11-17 09:00:00', '1', '2021-11-17 17:00:00', '1', '0', '1', '1', '1', '1', '2021-11-17 09:00:00', '2021-11-17 17:00:00', '2021-11-17 17:00:00', '8:0', '0', 1, 0, '0', '0', 'Present'),
(60, 2, 4, '2021-11-18', '2021-11-18 09:00:00', '1', '2021-11-18 17:00:00', '1', '0', '1', '1', '1', '1', '2021-11-18 09:00:00', '2021-11-18 17:00:00', '2021-11-18 17:00:00', '8:0', '0', 1, 0, '0', '0', 'Present'),
(61, 2, 4, '2021-11-19', '2021-11-19 09:00:00', '1', '2021-11-19 17:00:00', '1', '0', '1', '1', '1', '1', '2021-11-19 09:00:00', '2021-11-19 17:00:00', '2021-11-19 17:00:00', '8:0', '0', 1, 0, '0', '0', 'Present'),
(62, 24, 25, '2021-11-24', '2021-11-24 02:14:33', '24.85.223.110', '2021-11-24 08:46:51', '24.85.223.110', '0', '49.0480615', '-122.7581998', '49.0480615', '-122.7581998', '2021-11-24 02:14:33', '2021-11-24 08:46:51', '2021-11-24 08:46:51', '6:32', '', 3, 0, '0', '0', 'Present'),
(64, 24, 25, '2021-11-23', '2021-11-23 21:00:06', '24.85.223.110', '2021-11-23 21:00:18', '24.85.223.110', '0', '49.0480615', '-122.7581998', '49.0480615', '-122.7581998', '2021-11-23 21:00:06', '2021-11-23 21:00:18', '2021-11-23 21:00:18', '0:0', '', 3, 0, '2021-11-23 21:00:12', '2021-11-23 21:00:15', 'Present'),
(65, 24, 25, '2021-11-24', '2021-11-24 10:42:08', '24.85.223.110', '2021-11-24 10:47:11', '24.85.223.110', '0', '49.0480615', '-122.7581998', '49.0480615', '-122.7581998', '2021-11-24 10:42:08', '2021-11-24 10:47:11', '2021-11-24 10:47:11', '0:5', '1:55', 3, 0, '2021-11-24 10:46:17', '2021-11-24 10:46:26', 'Present'),
(123, 24, 25, '2021-12-10', '2021-12-10 16:15:45', '209.145.96.38', '', '1', '0', '54.3136145', '-130.3261376', '1', '1', '2021-12-10 16:15:45', '2021-12-10 16:15:45', '2021-12-10 16:15:45', '00:00', '', 3, 0, '0', '0', 'Present'),
(134, 24, 25, '2022-01-03', '2022-01-03 08:47:25', '24.85.223.110', '', '1', '0', '49.0480615', '-122.7581998', '1', '1', '2022-01-03 08:47:25', '2022-01-03 08:47:25', '2022-01-03 08:47:25', '00:00', '', 3, 0, '0', '0', 'Present'),
(150, 24, 27, '2022-02-01', '2022-02-01 9:00:00', '1', '2022-02-01 17:00:00', '1', '0', '1', '1', '1', '1', '2022-02-01 9:00:00', '2022-02-01 17:00:00', '2022-02-01 17:00:00', '8:0', '0', 3, 0, '0', '0', 'Present'),
(155, 24, 25, '2022-01-11', '2022-01-11 08:00:03', '209.145.96.38', '', '1', '0', '54.3137076', '-130.3260688', '1', '1', '2022-01-11 08:00:03', '2022-01-11 08:00:03', '2022-01-11 08:00:03', '00:00', '', 3, 0, '0', '0', 'Present'),
(156, 24, 25, '2022-01-10', '2022-01-10 9:00:00', '1', '2022-01-10 17:00:00', '1', '0', '1', '1', '1', '1', '2022-01-10 9:00:00', '2022-01-10 17:00:00', '2022-01-10 17:00:00', '8:0', '0', 3, 0, '0', '0', 'Present'),
(157, 24, 31, '2022-01-03', '2022-01-03 9:00:00', '1', '2022-01-03 17:00:00', '1', '0', '1', '1', '1', '1', '2022-01-03 9:00:00', '2022-01-03 17:00:00', '2022-01-03 17:00:00', '8:0', '0', 3, 0, '0', '0', 'Present'),
(158, 24, 31, '2022-01-04', '2022-01-04 9:00:00', '1', '2022-01-04 17:00:00', '1', '0', '1', '1', '1', '1', '2022-01-04 9:00:00', '2022-01-04 17:00:00', '2022-01-04 17:00:00', '8:0', '0', 3, 0, '0', '0', 'Present'),
(168, 24, 26, '2022-01-26', '2022-01-26 12:09:08', '127.0.0.1', '2022-01-26 12:09:37', '127.0.0.1', '0', '1', '1', '1', '1', '2022-01-26 12:09:08', '2022-01-26 12:09:37', '2022-01-26 12:09:37', '0:0', '', 3, 0, '2022-01-26 12:09:08', '2022-01-26 12:09:08', 'Present'),
(169, 24, 26, '2022-01-26', '2022-01-26 12:09:43', '127.0.0.1', '2022-01-26 12:09:49', '127.0.0.1', '0', '1', '1', '1', '1', '2022-01-26 12:09:43', '2022-01-26 12:09:49', '2022-01-26 12:09:49', '0:0', '0:0', 3, 0, '2022-01-26 12:09:43', '2022-01-26 12:09:43', 'Present'),
(171, 24, 26, '2022-01-26', '2022-01-26 11:29:49', '127.0.0.1', '2022-01-26 11:42:29', '127.0.0.1', '0', '1', '1', '1', '1', '2022-01-26 11:29:49', '2022-01-26 11:42:29', '2022-01-26 11:42:29', '0:12', '0:40', 3, 0, '2022-01-26 11:29:49', '2022-01-26 11:29:49', 'Present'),
(172, 24, 26, '2022-01-26', '2022-01-26 11:43:36', '127.0.0.1', '2022-01-26 11:48:44', '127.0.0.1', '0', '1', '1', '1', '1', '2022-01-26 11:43:36', '2022-01-26 11:48:44', '2022-01-26 11:48:44', '0:5', '0:1', 3, 0, '2022-01-26 11:43:36', '2022-01-26 11:43:36', 'Present'),
(173, 24, 26, '2022-01-26', '2022-01-26 11:49:13', '127.0.0.1', '2022-01-26 11:49:24', '127.0.0.1', '0', '1', '1', '1', '1', '2022-01-26 11:49:13', '2022-01-26 11:49:24', '2022-01-26 11:49:24', '0:0', '0:0', 3, 0, '2022-01-26 11:49:13', '2022-01-26 11:49:13', 'Present'),
(174, 24, 26, '2022-01-26', '2022-01-26 11:58:43', '127.0.0.1', '2022-01-26 12:11:50', '127.0.0.1', '0', '1', '1', '1', '1', '2022-01-26 11:58:43', '2022-01-26 12:11:50', '2022-01-26 12:11:50', '0:13', '0:9', 3, 0, '2022-01-26 11:58:43', '2022-01-26 11:58:43', 'Present'),
(175, 24, 26, '2022-01-26', '2022-01-26 12:12:09', '127.0.0.1', '2022-01-26 12:28:27', '127.0.0.1', '0', '1', '1', '1', '1', '2022-01-26 12:12:09', '2022-01-26 12:28:27', '2022-01-26 12:28:27', '0:16', '0:0', 3, 0, '2022-01-26 12:12:09', '2022-01-26 12:12:09', 'Present'),
(176, 24, 26, '2022-01-26', '2022-01-26 12:28:34', '127.0.0.1', '', '1', '0', '1', '1', '1', '1', '2022-01-26 12:28:34', '2022-01-26 12:28:34', '2022-01-26 12:28:34', '00:00', '0:0', 3, 0, '2022-01-26 12:28:34', '2022-01-26 12:28:34', 'Present'),
(177, 24, 26, '2022-01-27', '2022-01-27 11:43:57', '127.0.0.1', '', '1', '0', '1', '1', '1', '1', '2022-01-27 11:43:57', '2022-01-27 11:43:57', '2022-01-27 11:43:57', '00:00', '', 3, 0, '2022-01-27 11:43:57', '2022-01-27 11:43:57', 'Present'),
(178, 24, 26, '2022-01-30', '2022-01-30 12:51:55', '127.0.0.1', '', '1', '0', '1', '1', '1', '1', '2022-01-30 12:51:55', '2022-01-30 12:51:55', '2022-01-30 12:51:55', '00:00', '', 3, 0, '2022-01-30 12:51:55', '2022-01-30 12:51:55', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `ci_timesheet_request`
--

CREATE TABLE `ci_timesheet_request` (
  `time_request_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `request_date` varchar(255) NOT NULL,
  `request_month` varchar(255) NOT NULL,
  `clock_in` varchar(200) NOT NULL,
  `clock_out` varchar(200) NOT NULL,
  `total_hours` varchar(255) NOT NULL,
  `request_reason` mediumtext NOT NULL,
  `is_approved` tinyint(1) NOT NULL,
  `overtime_reason` int(11) NOT NULL,
  `additional_work_hours` int(11) NOT NULL,
  `straight` varchar(200) DEFAULT NULL,
  `time_a_half` varchar(200) DEFAULT NULL,
  `double_overtime` varchar(200) DEFAULT NULL,
  `compensation_type` int(11) NOT NULL,
  `compensation_banked` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_timesheet_request`
--

INSERT INTO `ci_timesheet_request` (`time_request_id`, `company_id`, `staff_id`, `request_date`, `request_month`, `clock_in`, `clock_out`, `total_hours`, `request_reason`, `is_approved`, `overtime_reason`, `additional_work_hours`, `straight`, `time_a_half`, `double_overtime`, `compensation_type`, `compensation_banked`, `created_at`) VALUES
(10, 24, 26, '2021-12-29', '2021-12', '2021-12-29 16:00:00', '2021-12-29 19:22:00', '3:22', 'Test', 1, 1, 0, '0', '0', '0', 1, '3:22', '28-12-2021 11:14:22'),
(11, 24, 26, '2021-12-27', '2021-12', '2021-12-27 17:00:00', '2021-12-27 20:00:00', '3:0', 'Extra Work', 1, 5, 3, '0', '0', '06:00', 1, '3:0', '30-12-2021 06:42:03'),
(12, 24, 26, '2021-12-24', '2021-12', '2021-12-24 17:00:00', '2021-12-24 21:00:00', '4:0', 'Overtime request', 1, 5, 2, '0', '06:00', '0', 2, '', '30-12-2021 06:50:26'),
(13, 24, 26, '2022-01-07', '2022-01', '2022-01-07 17:00:00', '2022-01-07 20:00:00', '3:0', 'Extra work', 1, 5, 2, '0', '04:30', '0', 1, '3:0', '02-01-2022 09:51:43'),
(14, 24, 26, '2022-01-07', '2022-01', '2022-01-07 17:00:00', '2022-01-07 20:00:00', '3:0', 'Overtime', 1, 1, 0, '0', '0', '0', 2, '', '04-01-2022 12:26:56'),
(15, 24, 26, '2022-01-11', '2022-01', '2022-01-11 17:00:00', '2022-01-11 20:00:00', '3:0', 'Overtime', 1, 5, 3, '0', '0', '06:00', 2, '', '04-01-2022 09:20:50'),
(16, 24, 31, '2022-01-05', '2022-01', '2022-01-05 17:00:00', '2022-01-05 20:00:00', '3:0', 'Test', 1, 5, 3, '0', '0', '06:00', 2, '', '13-01-2022 05:27:01'),
(17, 24, 31, '2022-01-04', '2022-01', '2022-01-04 12:00:00', '2022-01-04 12:30:00', '0:30', 'Test', 1, 2, 0, '0', '0', '0', 2, '', '12-01-2022 09:27:59'),
(18, 24, 31, '2022-01-03', '2022-01', '2022-01-03 17:00:00', '2022-01-03 18:00:00', '1:0', 'test', 1, 5, 1, '1:0', '0', '0', 2, '', '12-01-2022 09:29:03'),
(19, 24, 31, '2022-01-08', '2022-01', '2022-01-08 7:00:00', '2022-01-08 12:00:00', '5:0', 'test', 1, 1, 0, '0', '0', '0', 2, '', '12-01-2022 09:31:02'),
(20, 24, 31, '2022-01-10', '2022-01', '2022-01-10 9:00:00', '2022-01-10 17:00:00', '8:0', 'test', 1, 3, 0, '0', '0', '0', 2, '', '12-01-2022 09:31:54'),
(21, 24, 31, '2022-01-31', '2022-01', '2022-01-31 17:00:00', '2022-01-31 22:00:00', '5:0', 'test', 0, 5, 3, '0', '0', '10:00', 1, '5:0', '13-01-2022 06:19:28'),
(22, 24, 26, '2022-01-22', '2022-01', '2022-01-22 00:00:00', '2022-01-22 12:00:00', '12:0', 'testing', 0, 3, 0, '0', '0', '0', 2, '', '21-01-2022 11:54:40'),
(23, 24, 26, '2022-02-10', '2022-01', '2022-02-10 00:00:00', '2022-02-10 12:00:00', '12:0', 'testing', 0, 2, 0, '0', '0', '0', 2, '', '30-01-2022 10:31:02');

-- --------------------------------------------------------

--
-- Table structure for table `ci_todo_items`
--

CREATE TABLE `ci_todo_items` (
  `todo_item_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `is_done` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_todo_items`
--

INSERT INTO `ci_todo_items` (`todo_item_id`, `company_id`, `user_id`, `description`, `is_done`, `created_at`) VALUES
(1, 2, 3, 'Test', 0, '20-11-2021 01:35:20'),
(2, 24, 25, 'test', 1, '23-11-2021 09:10:20'),
(3, 24, 25, 'Test', 0, '10-12-2021 04:16:57'),
(4, 24, 26, 'text ', 1, '30-12-2021 08:20:14');

-- --------------------------------------------------------

--
-- Table structure for table `ci_track_goals`
--

CREATE TABLE `ci_track_goals` (
  `tracking_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `tracking_type_id` int(200) NOT NULL,
  `start_date` varchar(200) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `target_achiement` varchar(255) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `goal_work` text DEFAULT NULL,
  `goal_progress` varchar(200) DEFAULT NULL,
  `goal_status` int(11) NOT NULL DEFAULT 0,
  `goal_rating` int(11) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_track_goals`
--

INSERT INTO `ci_track_goals` (`tracking_id`, `company_id`, `tracking_type_id`, `start_date`, `end_date`, `subject`, `target_achiement`, `description`, `goal_work`, `goal_progress`, `goal_status`, `goal_rating`, `created_at`) VALUES
(1, 2, 136, '2021-05-30', '2021-05-31', 'New recruitment targets', 'Increase our hiring process in 2021', '&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;What we need&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20 col-sm-12&#34; style=&#34;box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;div class=&#34;row&#34; style=&#34;box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;&#34;&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;Requirements&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;', 'a:5:{s:7:\"project\";s:1:\"3\";s:4:\"task\";s:1:\"1\";s:5:\"award\";s:3:\"174\";s:8:\"training\";s:3:\"126\";s:6:\"travel\";s:3:\"175\";}', '72', 1, 4, '15-05-2021 04:19:55'),
(2, 2, 135, '2021-06-01', '2021-06-03', 'Annual retention rate', 'Reduce our annual retention rate', '&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;What we need&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20 col-sm-12&#34; style=&#34;box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;div class=&#34;row&#34; style=&#34;box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;&#34;&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;Requirements&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;', NULL, '100', 2, 4, '15-05-2021 04:22:07'),
(3, 2, 134, '2021-06-04', '2021-06-05', 'Boost employee experience', 'Boost employee experience with rewards and recognition', '&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;What we need&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20 col-sm-12&#34; style=&#34;box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;div class=&#34;row&#34; style=&#34;box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;&#34;&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;Requirements&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;', 'a:5:{s:7:\"project\";s:0:\"\";s:4:\"task\";s:1:\"1\";s:5:\"award\";s:0:\"\";s:8:\"training\";s:0:\"\";s:6:\"travel\";s:3:\"175\";}', '79', 1, 5, '15-05-2021 04:23:39');

-- --------------------------------------------------------

--
-- Table structure for table `ci_trainers`
--

CREATE TABLE `ci_trainers` (
  `trainer_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `expertise` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_trainers`
--

INSERT INTO `ci_trainers` (`trainer_id`, `company_id`, `first_name`, `last_name`, `contact_number`, `email`, `expertise`, `address`, `created_at`) VALUES
(1, 2, 'Airi', 'Satou', '632587452', 'airi.satou@timehrm.com', 'lorem, ipsum, dolor', 'Sadovnicheskaya embankment 79, MD 20815, Moscow', '15-05-2021 03:38:20');

-- --------------------------------------------------------

--
-- Table structure for table `ci_training`
--

CREATE TABLE `ci_training` (
  `training_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` varchar(200) NOT NULL,
  `training_type_id` int(200) NOT NULL,
  `associated_goals` text DEFAULT NULL,
  `trainer_id` int(200) NOT NULL,
  `start_date` varchar(200) NOT NULL,
  `finish_date` varchar(200) NOT NULL,
  `training_cost` decimal(65,2) DEFAULT NULL,
  `training_status` int(200) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `performance` varchar(200) DEFAULT NULL,
  `remarks` mediumtext DEFAULT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_training`
--

INSERT INTO `ci_training` (`training_id`, `company_id`, `employee_id`, `training_type_id`, `associated_goals`, `trainer_id`, `start_date`, `finish_date`, `training_cost`, `training_status`, `description`, `performance`, `remarks`, `created_at`) VALUES
(1, 2, '0,3,4', 126, '0,136,135', 1, '2021-05-26', '2021-05-28', '1500.00', 2, '&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;What we need&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20 col-sm-12&#34; style=&#34;box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;div class=&#34;row&#34; style=&#34;box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;&#34;&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;Requirements&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;', '1', 'is simply dummy text of the printing', '15-05-2021 03:39:39'),
(2, 2, '0,6,7,8', 127, NULL, 1, '2021-05-29', '2021-05-31', '1200.00', 1, '&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;What we need&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20 col-sm-12&#34; style=&#34;box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;div class=&#34;row&#34; style=&#34;box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;&#34;&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;Requirements&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;', '2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '15-05-2021 03:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `ci_training_notes`
--

CREATE TABLE `ci_training_notes` (
  `training_note_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `training_note` text DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_training_notes`
--

INSERT INTO `ci_training_notes` (`training_note_id`, `company_id`, `training_id`, `employee_id`, `training_note`, `created_at`) VALUES
(1, 2, 2, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '15-05-2021 03:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `ci_transfers`
--

CREATE TABLE `ci_transfers` (
  `transfer_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `transfer_date` varchar(255) NOT NULL,
  `transfer_department` int(111) NOT NULL,
  `transfer_designation` int(11) NOT NULL,
  `reason` mediumtext NOT NULL,
  `status` tinyint(2) NOT NULL,
  `added_by` int(111) NOT NULL,
  `notify_send_to` text DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_transfers`
--

INSERT INTO `ci_transfers` (`transfer_id`, `company_id`, `employee_id`, `transfer_date`, `transfer_department`, `transfer_designation`, `reason`, `status`, `added_by`, `notify_send_to`, `created_at`) VALUES
(4, 2, 6, '2021-06-20', 4, 8, 'asdasdasdsads', 0, 3, NULL, '19-06-2021 06:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `ci_travels`
--

CREATE TABLE `ci_travels` (
  `travel_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `associated_goals` text DEFAULT NULL,
  `visit_purpose` varchar(255) NOT NULL,
  `visit_place` varchar(255) NOT NULL,
  `travel_mode` int(111) DEFAULT NULL,
  `arrangement_type` int(111) DEFAULT NULL,
  `expected_budget` decimal(65,2) NOT NULL DEFAULT 0.00,
  `actual_budget` decimal(65,2) NOT NULL DEFAULT 0.00,
  `description` mediumtext NOT NULL,
  `status` tinyint(2) NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_travels`
--

INSERT INTO `ci_travels` (`travel_id`, `company_id`, `employee_id`, `start_date`, `end_date`, `associated_goals`, `visit_purpose`, `visit_place`, `travel_mode`, `arrangement_type`, `expected_budget`, `actual_budget`, `description`, `status`, `added_by`, `created_at`) VALUES
(1, 24, 26, '2022-02-27', '2022-02-28', '0,136,135,134', 'Business Trip', 'Bishkek Business Suite', 2, 175, '1500.00', '1500.00', '&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;What we need&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20 col-sm-12&#34; style=&#34;box-sizing:border-box;position:relative;width:726.125px;padding-right:15px;padding-left:15px;flex:0 0 100%;max-width:100%;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;div class=&#34;row&#34; style=&#34;box-sizing:border-box;display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px;&#34;&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;1. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;col-md-12 col-lg-6&#34; style=&#34;box-sizing:border-box;position:relative;width:363.062px;padding-right:15px;padding-left:15px;flex:0 0 50%;max-width:50%;&#34;&gt;&lt;div class=&#34;text-primary f-14 m-b-10&#34; style=&#34;box-sizing:border-box;margin-bottom:10px;color:#7267ef;&#34;&gt;2. The standard Lorem Ipsum passage&lt;/div&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;m-b-20&#34; style=&#34;box-sizing:border-box;margin-bottom:20px;color:#293240;font-family:Inter, sans-serif;font-size:14px;background-color:#ffffff;&#34;&gt;&lt;h6 style=&#34;font-size:0.9375rem;box-sizing:border-box;margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#060606;&#34;&gt;Requirements&lt;/h6&gt;&lt;hr style=&#34;box-sizing:content-box;height:0px;overflow:visible;margin-top:1rem;margin-bottom:1rem;border-right:0px;border-bottom:0px;border-left:0px;border-image:initial;border-top-style:solid;border-top-color:rgba(0, 0, 0, 0.1);&#34; /&gt;&lt;p style=&#34;margin-bottom:1rem;box-sizing:border-box;&#34;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;/div&gt;', 1, 26, '21-02-2022 05:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `ci_users_documents`
--

CREATE TABLE `ci_users_documents` (
  `document_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `document_type` varchar(255) NOT NULL,
  `document_file` varchar(255) NOT NULL,
  `created_at` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_visitors`
--

CREATE TABLE `ci_visitors` (
  `visitor_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `visit_purpose` varchar(255) DEFAULT NULL,
  `visitor_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `visit_date` varchar(255) DEFAULT NULL,
  `check_in` varchar(255) DEFAULT NULL,
  `check_out` varchar(255) DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_erp_balance_history`
--

CREATE TABLE `ci_erp_balance_history` (
  `id` INT (11) NOT NULL AUTO_INCREMENT,
  `user_id` INT (11) NULL DEFAULT NULL,
  `year` VARCHAR (250) NULL DEFAULT NULL,
  `leave_type` VARCHAR (250) NULL DEFAULT NULL,
  `balance` VARCHAR (250) NULL DEFAULT NULL,
  `company_id` INT (11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = INNODB ;



--
-- Table structure for table `ci_warnings`
--

--
-- Dumping data for table `ci_warnings`
--

INSERT INTO `ci_warnings` (`warning_id`, `company_id`, `warning_to`, `warning_by`, `warning_date`, `warning_type_id`, `attachment`, `subject`, `description`, `status`, `notify_send_to`, `created_at`) VALUES
(1, 2, 4, 2, '2021-08-01', 139, 'pr22od-22.jpg', 'test', 'asdasds', 0, NULL, '31-07-2021 04:58:04'),
(2, 2, 3, 2, '2021-11-09', 140, 'dash12.png', 'asdasd', 'sadasds', 0, NULL, '08-11-2021 02:34:35'),
(3, 24, 26, 25, '2022-01-05', 202, '1641429647_09b9f46a371b6f21beb1.docx', 'Test', 'Test', 0, '0,26', '05-01-2022 04:40:47'),
(4, 24, 26, 25, '2022-01-06', 202, '1641502921_25269f3a109f0a49a0c3.docx', 'Test', 'Test', 0, '0,26', '06-01-2022 01:02:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_advance_salary`
--
ALTER TABLE `ci_advance_salary`
  ADD PRIMARY KEY (`advance_salary_id`);

--
-- Indexes for table `ci_announcements`
--
ALTER TABLE `ci_announcements`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `ci_announcement_comments`
--
ALTER TABLE `ci_announcement_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `ci_assets`
--
ALTER TABLE `ci_assets`
  ADD PRIMARY KEY (`assets_id`);

--
-- Indexes for table `ci_awards`
--
ALTER TABLE `ci_awards`
  ADD PRIMARY KEY (`award_id`);

--
-- Indexes for table `ci_cms_pages`
--
ALTER TABLE `ci_cms_pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `ci_company_membership`
--
ALTER TABLE `ci_company_membership`
  ADD PRIMARY KEY (`company_membership_id`);

--
-- Indexes for table `ci_company_tickets`
--
ALTER TABLE `ci_company_tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `ci_company_tickets_reply`
--
ALTER TABLE `ci_company_tickets_reply`
  ADD PRIMARY KEY (`ticket_reply_id`);

--
-- Indexes for table `ci_complaints`
--
ALTER TABLE `ci_complaints`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `ci_contract_options`
--
ALTER TABLE `ci_contract_options`
  ADD PRIMARY KEY (`contract_option_id`);

--
-- Indexes for table `ci_countries`
--
ALTER TABLE `ci_countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `ci_currencies`
--
ALTER TABLE `ci_currencies`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `ci_database_backup`
--
ALTER TABLE `ci_database_backup`
  ADD PRIMARY KEY (`backup_id`);

--
-- Indexes for table `ci_departments`
--
ALTER TABLE `ci_departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `ci_designations`
--
ALTER TABLE `ci_designations`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `ci_email_configuration`
--
ALTER TABLE `ci_email_configuration`
  ADD PRIMARY KEY (`email_config_id`);

--
-- Indexes for table `ci_email_template`
--
ALTER TABLE `ci_email_template`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `ci_employee_accounts`
--
ALTER TABLE `ci_employee_accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `ci_employee_contacts`
--
ALTER TABLE `ci_employee_contacts`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `ci_employee_exit`
--
ALTER TABLE `ci_employee_exit`
  ADD PRIMARY KEY (`exit_id`);

--
-- Indexes for table `ci_erp_company_settings`
--
ALTER TABLE `ci_erp_company_settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `ci_erp_constants`
--
ALTER TABLE `ci_erp_constants`
  ADD PRIMARY KEY (`constants_id`);

--
-- Indexes for table `ci_erp_settings`
--
ALTER TABLE `ci_erp_settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `ci_erp_users`
--
ALTER TABLE `ci_erp_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `ci_erp_users_details`
--
ALTER TABLE `ci_erp_users_details`
  ADD PRIMARY KEY (`staff_details_id`);

--
-- Indexes for table `ci_erp_users_role`
--
ALTER TABLE `ci_erp_users_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `ci_estimates`
--
ALTER TABLE `ci_estimates`
  ADD PRIMARY KEY (`estimate_id`);

--
-- Indexes for table `ci_estimates_items`
--
ALTER TABLE `ci_estimates_items`
  ADD PRIMARY KEY (`estimate_item_id`);

--
-- Indexes for table `ci_events`
--
ALTER TABLE `ci_events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `ci_finance_accounts`
--
ALTER TABLE `ci_finance_accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `ci_finance_entity`
--
ALTER TABLE `ci_finance_entity`
  ADD PRIMARY KEY (`entity_id`);

--
-- Indexes for table `ci_finance_membership_invoices`
--
ALTER TABLE `ci_finance_membership_invoices`
  ADD PRIMARY KEY (`membership_invoice_id`);

--
-- Indexes for table `ci_finance_transactions`
--
ALTER TABLE `ci_finance_transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `ci_forms`
--
ALTER TABLE `ci_forms`
  ADD PRIMARY KEY (`forms_id`);

--
-- Indexes for table `ci_form_completed_fields`
--
ALTER TABLE `ci_form_completed_fields`
  ADD PRIMARY KEY (`completed_field_id`);

--
-- Indexes for table `ci_form_fields`
--
ALTER TABLE `ci_form_fields`
  ADD PRIMARY KEY (`form_field_id`);

--
-- Indexes for table `ci_frontend_content`
--
ALTER TABLE `ci_frontend_content`
  ADD PRIMARY KEY (`frontend_id`);

--
-- Indexes for table `ci_holidays`
--
ALTER TABLE `ci_holidays`
  ADD PRIMARY KEY (`holiday_id`);

--
-- Indexes for table `ci_incidents`
--
ALTER TABLE `ci_incidents`
  ADD PRIMARY KEY (`incident_id`);

--
-- Indexes for table `ci_invoices`
--
ALTER TABLE `ci_invoices`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `ci_invoices_items`
--
ALTER TABLE `ci_invoices_items`
  ADD PRIMARY KEY (`invoice_item_id`);

--
-- Indexes for table `ci_kiosk`
--
ALTER TABLE `ci_kiosk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_languages`
--
ALTER TABLE `ci_languages`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `ci_leads`
--
ALTER TABLE `ci_leads`
  ADD PRIMARY KEY (`lead_id`);

--
-- Indexes for table `ci_leads_followup`
--
ALTER TABLE `ci_leads_followup`
  ADD PRIMARY KEY (`followup_id`);

--
-- Indexes for table `ci_leave_adjustment`
--
ALTER TABLE `ci_leave_adjustment`
  ADD PRIMARY KEY (`adjustment_id`);

--
-- Indexes for table `ci_leave_applications`
--
ALTER TABLE `ci_leave_applications`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `ci_meetings`
--
ALTER TABLE `ci_meetings`
  ADD PRIMARY KEY (`meeting_id`);

--
-- Indexes for table `ci_membership`
--
ALTER TABLE `ci_membership`
  ADD PRIMARY KEY (`membership_id`);

--
-- Indexes for table `ci_office_shifts`
--
ALTER TABLE `ci_office_shifts`
  ADD PRIMARY KEY (`office_shift_id`);

--
-- Indexes for table `ci_official_documents`
--
ALTER TABLE `ci_official_documents`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `ci_payslips`
--
ALTER TABLE `ci_payslips`
  ADD PRIMARY KEY (`payslip_id`);

--
-- Indexes for table `ci_payslip_allowances`
--
ALTER TABLE `ci_payslip_allowances`
  ADD PRIMARY KEY (`payslip_allowances_id`);

--
-- Indexes for table `ci_payslip_commissions`
--
ALTER TABLE `ci_payslip_commissions`
  ADD PRIMARY KEY (`payslip_commissions_id`);

--
-- Indexes for table `ci_payslip_other_payments`
--
ALTER TABLE `ci_payslip_other_payments`
  ADD PRIMARY KEY (`payslip_other_payment_id`);

--
-- Indexes for table `ci_payslip_statutory_deductions`
--
ALTER TABLE `ci_payslip_statutory_deductions`
  ADD PRIMARY KEY (`payslip_deduction_id`);

--
-- Indexes for table `ci_performance_appraisal`
--
ALTER TABLE `ci_performance_appraisal`
  ADD PRIMARY KEY (`performance_appraisal_id`);

--
-- Indexes for table `ci_performance_appraisal_options`
--
ALTER TABLE `ci_performance_appraisal_options`
  ADD PRIMARY KEY (`performance_appraisal_options_id`);

--
-- Indexes for table `ci_performance_indicator`
--
ALTER TABLE `ci_performance_indicator`
  ADD PRIMARY KEY (`performance_indicator_id`);

--
-- Indexes for table `ci_performance_indicator_options`
--
ALTER TABLE `ci_performance_indicator_options`
  ADD PRIMARY KEY (`performance_indicator_options_id`);

--
-- Indexes for table `ci_policies`
--
ALTER TABLE `ci_policies`
  ADD PRIMARY KEY (`policy_id`);

--
-- Indexes for table `ci_polls`
--
ALTER TABLE `ci_polls`
  ADD PRIMARY KEY (`poll_id`);

--
-- Indexes for table `ci_polls_votes`
--
ALTER TABLE `ci_polls_votes`
  ADD PRIMARY KEY (`polls_vote_id`);

--
-- Indexes for table `ci_projects`
--
ALTER TABLE `ci_projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `ci_projects_bugs`
--
ALTER TABLE `ci_projects_bugs`
  ADD PRIMARY KEY (`project_bug_id`);

--
-- Indexes for table `ci_projects_discussion`
--
ALTER TABLE `ci_projects_discussion`
  ADD PRIMARY KEY (`project_discussion_id`);

--
-- Indexes for table `ci_projects_files`
--
ALTER TABLE `ci_projects_files`
  ADD PRIMARY KEY (`project_file_id`);

--
-- Indexes for table `ci_projects_notes`
--
ALTER TABLE `ci_projects_notes`
  ADD PRIMARY KEY (`project_note_id`);

--
-- Indexes for table `ci_projects_timelogs`
--
ALTER TABLE `ci_projects_timelogs`
  ADD PRIMARY KEY (`timelogs_id`);

--
-- Indexes for table `ci_recent_activity`
--
ALTER TABLE `ci_recent_activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `ci_rec_candidates`
--
ALTER TABLE `ci_rec_candidates`
  ADD PRIMARY KEY (`candidate_id`);

--
-- Indexes for table `ci_rec_interviews`
--
ALTER TABLE `ci_rec_interviews`
  ADD PRIMARY KEY (`job_interview_id`);

--
-- Indexes for table `ci_rec_jobs`
--
ALTER TABLE `ci_rec_jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `ci_resignations`
--
ALTER TABLE `ci_resignations`
  ADD PRIMARY KEY (`resignation_id`);

--
-- Indexes for table `ci_signature_documents`
--
ALTER TABLE `ci_signature_documents`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `ci_staff_roles`
--
ALTER TABLE `ci_staff_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `ci_staff_signature_documents`
--
ALTER TABLE `ci_staff_signature_documents`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `ci_stock_orders`
--
ALTER TABLE `ci_stock_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `ci_stock_order_items`
--
ALTER TABLE `ci_stock_order_items`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `ci_stock_order_quotes`
--
ALTER TABLE `ci_stock_order_quotes`
  ADD PRIMARY KEY (`quote_id`);

--
-- Indexes for table `ci_stock_order_quote_items`
--
ALTER TABLE `ci_stock_order_quote_items`
  ADD PRIMARY KEY (`quote_item_id`);

--
-- Indexes for table `ci_stock_products`
--
ALTER TABLE `ci_stock_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `ci_stock_purchases`
--
ALTER TABLE `ci_stock_purchases`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `ci_stock_purchase_items`
--
ALTER TABLE `ci_stock_purchase_items`
  ADD PRIMARY KEY (`purchase_item_id`);

--
-- Indexes for table `ci_stock_suppliers`
--
ALTER TABLE `ci_stock_suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `ci_stock_warehouses`
--
ALTER TABLE `ci_stock_warehouses`
  ADD PRIMARY KEY (`warehouse_id`);

--
-- Indexes for table `ci_suggestions`
--
ALTER TABLE `ci_suggestions`
  ADD PRIMARY KEY (`suggestion_id`);

--
-- Indexes for table `ci_suggestion_comments`
--
ALTER TABLE `ci_suggestion_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `ci_support_tickets`
--
ALTER TABLE `ci_support_tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `ci_support_ticket_files`
--
ALTER TABLE `ci_support_ticket_files`
  ADD PRIMARY KEY (`ticket_file_id`);

--
-- Indexes for table `ci_support_ticket_notes`
--
ALTER TABLE `ci_support_ticket_notes`
  ADD PRIMARY KEY (`ticket_note_id`);

--
-- Indexes for table `ci_support_ticket_reply`
--
ALTER TABLE `ci_support_ticket_reply`
  ADD PRIMARY KEY (`ticket_reply_id`);

--
-- Indexes for table `ci_system_documents`
--
ALTER TABLE `ci_system_documents`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `ci_tasks`
--
ALTER TABLE `ci_tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `ci_tasks_discussion`
--
ALTER TABLE `ci_tasks_discussion`
  ADD PRIMARY KEY (`task_discussion_id`);

--
-- Indexes for table `ci_tasks_files`
--
ALTER TABLE `ci_tasks_files`
  ADD PRIMARY KEY (`task_file_id`);

--
-- Indexes for table `ci_tasks_notes`
--
ALTER TABLE `ci_tasks_notes`
  ADD PRIMARY KEY (`task_note_id`);

--
-- Indexes for table `ci_terminations`
--
ALTER TABLE `ci_terminations`
  ADD PRIMARY KEY (`termination_id`);

--
-- Indexes for table `ci_timesheet`
--
ALTER TABLE `ci_timesheet`
  ADD PRIMARY KEY (`time_attendance_id`);

--
-- Indexes for table `ci_timesheet_request`
--
ALTER TABLE `ci_timesheet_request`
  ADD PRIMARY KEY (`time_request_id`);

--
-- Indexes for table `ci_todo_items`
--
ALTER TABLE `ci_todo_items`
  ADD PRIMARY KEY (`todo_item_id`);

--
-- Indexes for table `ci_track_goals`
--
ALTER TABLE `ci_track_goals`
  ADD PRIMARY KEY (`tracking_id`);

--
-- Indexes for table `ci_trainers`
--
ALTER TABLE `ci_trainers`
  ADD PRIMARY KEY (`trainer_id`);

--
-- Indexes for table `ci_training`
--
ALTER TABLE `ci_training`
  ADD PRIMARY KEY (`training_id`);

--
-- Indexes for table `ci_training_notes`
--
ALTER TABLE `ci_training_notes`
  ADD PRIMARY KEY (`training_note_id`);

--
-- Indexes for table `ci_transfers`
--
ALTER TABLE `ci_transfers`
  ADD PRIMARY KEY (`transfer_id`);

--
-- Indexes for table `ci_travels`
--
ALTER TABLE `ci_travels`
  ADD PRIMARY KEY (`travel_id`);

--
-- Indexes for table `ci_users_documents`
--
ALTER TABLE `ci_users_documents`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `ci_visitors`
--
ALTER TABLE `ci_visitors`
  ADD PRIMARY KEY (`visitor_id`);

--
-- Indexes for table `ci_warnings`
--
ALTER TABLE `ci_warnings`
  ADD PRIMARY KEY (`warning_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ci_advance_salary`
--
ALTER TABLE `ci_advance_salary`
  MODIFY `advance_salary_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ci_announcements`
--
ALTER TABLE `ci_announcements`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ci_announcement_comments`
--
ALTER TABLE `ci_announcement_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ci_assets`
--
ALTER TABLE `ci_assets`
  MODIFY `assets_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_awards`
--
ALTER TABLE `ci_awards`
  MODIFY `award_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ci_cms_pages`
--
ALTER TABLE `ci_cms_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ci_company_membership`
--
ALTER TABLE `ci_company_membership`
  MODIFY `company_membership_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ci_company_tickets`
--
ALTER TABLE `ci_company_tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ci_company_tickets_reply`
--
ALTER TABLE `ci_company_tickets_reply`
  MODIFY `ticket_reply_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ci_complaints`
--
ALTER TABLE `ci_complaints`
  MODIFY `complaint_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_contract_options`
--
ALTER TABLE `ci_contract_options`
  MODIFY `contract_option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ci_countries`
--
ALTER TABLE `ci_countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `ci_currencies`
--
ALTER TABLE `ci_currencies`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `ci_database_backup`
--
ALTER TABLE `ci_database_backup`
  MODIFY `backup_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_departments`
--
ALTER TABLE `ci_departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ci_designations`
--
ALTER TABLE `ci_designations`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ci_email_configuration`
--
ALTER TABLE `ci_email_configuration`
  MODIFY `email_config_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_email_template`
--
ALTER TABLE `ci_email_template`
  MODIFY `template_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ci_employee_accounts`
--
ALTER TABLE `ci_employee_accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ci_employee_contacts`
--
ALTER TABLE `ci_employee_contacts`
  MODIFY `contact_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_employee_exit`
--
ALTER TABLE `ci_employee_exit`
  MODIFY `exit_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_erp_company_settings`
--
ALTER TABLE `ci_erp_company_settings`
  MODIFY `setting_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ci_erp_constants`
--
ALTER TABLE `ci_erp_constants`
  MODIFY `constants_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `ci_erp_settings`
--
ALTER TABLE `ci_erp_settings`
  MODIFY `setting_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_erp_users`
--
ALTER TABLE `ci_erp_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `ci_erp_users_details`
--
ALTER TABLE `ci_erp_users_details`
  MODIFY `staff_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ci_erp_users_role`
--
ALTER TABLE `ci_erp_users_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ci_estimates`
--
ALTER TABLE `ci_estimates`
  MODIFY `estimate_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ci_estimates_items`
--
ALTER TABLE `ci_estimates_items`
  MODIFY `estimate_item_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ci_events`
--
ALTER TABLE `ci_events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_finance_accounts`
--
ALTER TABLE `ci_finance_accounts`
  MODIFY `account_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ci_finance_entity`
--
ALTER TABLE `ci_finance_entity`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_finance_membership_invoices`
--
ALTER TABLE `ci_finance_membership_invoices`
  MODIFY `membership_invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `ci_finance_transactions`
--
ALTER TABLE `ci_finance_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ci_forms`
--
ALTER TABLE `ci_forms`
  MODIFY `forms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ci_form_completed_fields`
--
ALTER TABLE `ci_form_completed_fields`
  MODIFY `completed_field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ci_form_fields`
--
ALTER TABLE `ci_form_fields`
  MODIFY `form_field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `ci_frontend_content`
--
ALTER TABLE `ci_frontend_content`
  MODIFY `frontend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_holidays`
--
ALTER TABLE `ci_holidays`
  MODIFY `holiday_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ci_incidents`
--
ALTER TABLE `ci_incidents`
  MODIFY `incident_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_invoices`
--
ALTER TABLE `ci_invoices`
  MODIFY `invoice_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ci_invoices_items`
--
ALTER TABLE `ci_invoices_items`
  MODIFY `invoice_item_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ci_kiosk`
--
ALTER TABLE `ci_kiosk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_languages`
--
ALTER TABLE `ci_languages`
  MODIFY `language_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ci_leads`
--
ALTER TABLE `ci_leads`
  MODIFY `lead_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_leads_followup`
--
ALTER TABLE `ci_leads_followup`
  MODIFY `followup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ci_leave_adjustment`
--
ALTER TABLE `ci_leave_adjustment`
  MODIFY `adjustment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ci_leave_applications`
--
ALTER TABLE `ci_leave_applications`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `ci_meetings`
--
ALTER TABLE `ci_meetings`
  MODIFY `meeting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_membership`
--
ALTER TABLE `ci_membership`
  MODIFY `membership_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_office_shifts`
--
ALTER TABLE `ci_office_shifts`
  MODIFY `office_shift_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ci_official_documents`
--
ALTER TABLE `ci_official_documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_payslips`
--
ALTER TABLE `ci_payslips`
  MODIFY `payslip_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_payslip_allowances`
--
ALTER TABLE `ci_payslip_allowances`
  MODIFY `payslip_allowances_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `ci_payslip_commissions`
--
ALTER TABLE `ci_payslip_commissions`
  MODIFY `payslip_commissions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `ci_payslip_other_payments`
--
ALTER TABLE `ci_payslip_other_payments`
  MODIFY `payslip_other_payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `ci_payslip_statutory_deductions`
--
ALTER TABLE `ci_payslip_statutory_deductions`
  MODIFY `payslip_deduction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `ci_performance_appraisal`
--
ALTER TABLE `ci_performance_appraisal`
  MODIFY `performance_appraisal_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ci_performance_appraisal_options`
--
ALTER TABLE `ci_performance_appraisal_options`
  MODIFY `performance_appraisal_options_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ci_performance_indicator`
--
ALTER TABLE `ci_performance_indicator`
  MODIFY `performance_indicator_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ci_performance_indicator_options`
--
ALTER TABLE `ci_performance_indicator_options`
  MODIFY `performance_indicator_options_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ci_policies`
--
ALTER TABLE `ci_policies`
  MODIFY `policy_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ci_polls`
--
ALTER TABLE `ci_polls`
  MODIFY `poll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_polls_votes`
--
ALTER TABLE `ci_polls_votes`
  MODIFY `polls_vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `ci_projects`
--
ALTER TABLE `ci_projects`
  MODIFY `project_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ci_projects_bugs`
--
ALTER TABLE `ci_projects_bugs`
  MODIFY `project_bug_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_projects_discussion`
--
ALTER TABLE `ci_projects_discussion`
  MODIFY `project_discussion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_projects_files`
--
ALTER TABLE `ci_projects_files`
  MODIFY `project_file_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_projects_notes`
--
ALTER TABLE `ci_projects_notes`
  MODIFY `project_note_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_projects_timelogs`
--
ALTER TABLE `ci_projects_timelogs`
  MODIFY `timelogs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ci_recent_activity`
--
ALTER TABLE `ci_recent_activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_rec_candidates`
--
ALTER TABLE `ci_rec_candidates`
  MODIFY `candidate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ci_rec_interviews`
--
ALTER TABLE `ci_rec_interviews`
  MODIFY `job_interview_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_rec_jobs`
--
ALTER TABLE `ci_rec_jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ci_resignations`
--
ALTER TABLE `ci_resignations`
  MODIFY `resignation_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ci_signature_documents`
--
ALTER TABLE `ci_signature_documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ci_staff_roles`
--
ALTER TABLE `ci_staff_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ci_staff_signature_documents`
--
ALTER TABLE `ci_staff_signature_documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ci_stock_orders`
--
ALTER TABLE `ci_stock_orders`
  MODIFY `order_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_stock_order_items`
--
ALTER TABLE `ci_stock_order_items`
  MODIFY `order_item_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_stock_order_quotes`
--
ALTER TABLE `ci_stock_order_quotes`
  MODIFY `quote_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_stock_order_quote_items`
--
ALTER TABLE `ci_stock_order_quote_items`
  MODIFY `quote_item_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_stock_products`
--
ALTER TABLE `ci_stock_products`
  MODIFY `product_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_stock_purchases`
--
ALTER TABLE `ci_stock_purchases`
  MODIFY `purchase_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_stock_purchase_items`
--
ALTER TABLE `ci_stock_purchase_items`
  MODIFY `purchase_item_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_stock_suppliers`
--
ALTER TABLE `ci_stock_suppliers`
  MODIFY `supplier_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_stock_warehouses`
--
ALTER TABLE `ci_stock_warehouses`
  MODIFY `warehouse_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_suggestions`
--
ALTER TABLE `ci_suggestions`
  MODIFY `suggestion_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ci_suggestion_comments`
--
ALTER TABLE `ci_suggestion_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_support_tickets`
--
ALTER TABLE `ci_support_tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ci_support_ticket_files`
--
ALTER TABLE `ci_support_ticket_files`
  MODIFY `ticket_file_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_support_ticket_notes`
--
ALTER TABLE `ci_support_ticket_notes`
  MODIFY `ticket_note_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_support_ticket_reply`
--
ALTER TABLE `ci_support_ticket_reply`
  MODIFY `ticket_reply_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ci_system_documents`
--
ALTER TABLE `ci_system_documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_tasks`
--
ALTER TABLE `ci_tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ci_tasks_discussion`
--
ALTER TABLE `ci_tasks_discussion`
  MODIFY `task_discussion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_tasks_files`
--
ALTER TABLE `ci_tasks_files`
  MODIFY `task_file_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_tasks_notes`
--
ALTER TABLE `ci_tasks_notes`
  MODIFY `task_note_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_terminations`
--
ALTER TABLE `ci_terminations`
  MODIFY `termination_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ci_timesheet`
--
ALTER TABLE `ci_timesheet`
  MODIFY `time_attendance_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT for table `ci_timesheet_request`
--
ALTER TABLE `ci_timesheet_request`
  MODIFY `time_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `ci_todo_items`
--
ALTER TABLE `ci_todo_items`
  MODIFY `todo_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ci_track_goals`
--
ALTER TABLE `ci_track_goals`
  MODIFY `tracking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ci_trainers`
--
ALTER TABLE `ci_trainers`
  MODIFY `trainer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_training`
--
ALTER TABLE `ci_training`
  MODIFY `training_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ci_training_notes`
--
ALTER TABLE `ci_training_notes`
  MODIFY `training_note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_transfers`
--
ALTER TABLE `ci_transfers`
  MODIFY `transfer_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ci_travels`
--
ALTER TABLE `ci_travels`
  MODIFY `travel_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_users_documents`
--
ALTER TABLE `ci_users_documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_visitors`
--
ALTER TABLE `ci_visitors`
  MODIFY `visitor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_warnings`
--
ALTER TABLE `ci_warnings`
  MODIFY `warning_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

  ALTER TABLE `ci_erp_users`
  ADD COLUMN  `fiscal_date` varchar(255)  NULL;

  ALTER TABLE `ci_timesheet`
  ADD COLUMN  `status` varchar(255)  default Pending;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
