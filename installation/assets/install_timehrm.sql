--
-- Database: `erp_timehrm`
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

-- --------------------------------------------------------

--
-- Table structure for table `ci_announcements`
--

CREATE TABLE `ci_announcements` (
  `announcement_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `department_id` varchar(255) NOT NULL,
  `title` varchar(200) NOT NULL,
  `start_date` varchar(200) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `published_by` int(111) NOT NULL,
  `summary` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'Privacy Policy', 'footer', '&lt;h3&gt;PrivacyPolicy - We give the best consulting&lt;/h3&gt;&lt;p&gt;That brown bread spiffing nice one zonked spiffing good time loo so I said bite your arm off argy-bargy, skive off amongst chip shop hanky panky blow off blower it&#39;s your round sloshed, spend a penny mush pukka barmy Harry plastered gutted mate no biggie. Argy-bargy chap a blinding shot twit bits and bobs the wireless Oxford bamboozled pardon you cheers baking cakes mufty.....&lt;/p&gt;', 1),
(2, 'Terms & Conditions', 'footer', '&lt;h3&gt;Terms - We give the best consulting&lt;/h3&gt;&lt;p&gt;That brown bread spiffing nice one zonked spiffing good time loo so I said bite your arm off argy-bargy, skive off amongst chip shop hanky panky blow off blower it&#39;s your round sloshed, spend a penny mush pukka barmy Harry plastered gutted mate no biggie. Argy-bargy chap a blinding shot twit bits and bobs the wireless Oxford bamboozled pardon you cheers baking cakes mufty.....&lt;/p&gt;', 1),
(3, 'Home Page', 'main_content', '&lt;section class=&#34;services__area grey-bg-3 pt-120 mt-0 pb-60 p-relative&#34;&gt;&lt;div class=&#34;services__shape-2&#34;&gt;&lt;img class=&#34;services-2-circle&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-2/services-circle.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;services-2-circle-2&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-2/services-circle-2.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;row align-items-end&#34;&gt;&lt;div class=&#34;col-xxl-4 col-lg-5 col-md-7&#34;&gt;&lt;div class=&#34;section__title-wrapper mb-70 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;span class=&#34;section__pre-title purple&#34;&gt;REASONS WHY&lt;/span&gt; &lt;h2 class=&#34;section__title section__title-2&#34;&gt;Everything you need in one HR software.&lt;/h2&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-8 col-lg-7 col-md-5&#34;&gt;&lt;div class=&#34;services__more mb-70 text-sm-end wow fadeInUp&#34; data-wow-delay=&#34;.5s&#34; style=&#34;visibility:visible;animation-delay:0.5s;animation-name:fadeInUp;&#34;&gt;&lt;a href=&#34;features&#34; class=&#34;w-btn w-btn-blue w-btn-6 w-btn-3&#34;&gt;view more&lt;/a&gt; &lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__inner services__inner-2 hover__active mb-30&#34;&gt;&lt;div class=&#34;services__item-2 transition-3 white-bg &#34;&gt;&lt;div class=&#34;services__icon-2&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-2/services-1.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-2&#34;&gt;&lt;h3 class=&#34;services__title-2&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Workmates&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;An employee experience platform to rethink communication, engagement, recognition and rewards, and so much more.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.5s&#34; style=&#34;visibility:visible;animation-delay:0.5s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__inner services__inner-2 hover__active active mb-30&#34;&gt;&lt;div class=&#34;services__item-2 transition-3 white-bg &#34;&gt;&lt;div class=&#34;services__icon-2&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-2/services-2.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-2&#34;&gt;&lt;h3 class=&#34;services__title-2&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Onboard&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Automate the entire onboarding experience--even before it officially starts--to make new hires first day great.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.7s&#34; style=&#34;visibility:visible;animation-delay:0.7s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__inner services__inner-2 hover__active mb-30&#34;&gt;&lt;div class=&#34;services__item-2 transition-3 white-bg&#34;&gt;&lt;div class=&#34;services__icon-2&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-2/services-3.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-2&#34;&gt;&lt;h3 class=&#34;services__title-2&#34;&gt;&lt;a href=&#34;#!&#34;&gt;People HRMS&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Powerful, proven, comprehensive HR solution delivers all the tools HR teams need to manage the entire employee lifecycle.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;&lt;section class=&#34;about__area grey-bg-3 pt-40 pb-120 p-relative&#34;&gt;&lt;div class=&#34;about__shape-2&#34;&gt;&lt;img class=&#34;about-2-circle&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/about/home-2/about-circle.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;about-2-circle-2&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/about/home-2/about-circle-2.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-7 col-xl-7 col-lg-6 col-md-8&#34;&gt;&lt;div class=&#34;about__thumb-3 wow fadeInLeft&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInLeft;&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/services/01.png&#34; alt=&#34;&#34; width=&#34;525&#34; /&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-5 col-xl-5 col-lg-6 col-md-8&#34;&gt;&lt;div class=&#34;about__content-3 pt-55&#34;&gt;&lt;div class=&#34;section__title-wrapper section__title-wrapper-2 mb-55 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;span class=&#34;section__pre-title pink&#34;&gt;Features&lt;/span&gt; &lt;h2 class=&#34;section__title section__title-2&#34;&gt;Save Time and Money&lt;/h2&gt;&lt;p&gt;Automated Core HR solution provides business perks like decreased costs. An HR employee has more time on more meaningful tasks, while a company has increased savings..&lt;/p&gt;&lt;/div&gt;&lt;a href=&#34;register&#34; class=&#34;w-btn w-btn-blue w-btn-3 w-btn-1&#34;&gt;Get Started&lt;/a&gt; &lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;&lt;section class=&#34;services__area p-relative pt-150 pb-130&#34;&gt;&lt;div class=&#34;services__shape&#34;&gt;&lt;img class=&#34;services-circle-1&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-1/circle-1.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;services-circle-2&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-1/circle-2.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;services-dot&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-1/dot.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;services-triangle&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-1/triangle.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-6 col-md-10 offset-md-1 p-0&#34;&gt;&lt;div class=&#34;section__title-wrapper text-center mb-75 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;h2 class=&#34;section__title&#34;&gt;Give your most valuable asset &amp;mdash; your employees -&lt;/h2&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6&#34;&gt;&lt;div class=&#34;services__inner hover__active mb-30 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item white-bg text-center transition-3 &#34;&gt;&lt;div class=&#34;services__icon mb-25 d-flex align-items-end justify-content-center&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-1/services-1.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content&#34;&gt;&lt;h3 class=&#34;services__title&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Approve Requests&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Get notifications for all approvals that require your action. Speed up the entire approval process and streamline communication.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6&#34;&gt;&lt;div class=&#34;services__inner hover__active mb-30 wow fadeInUp active&#34; data-wow-delay=&#34;.5s&#34; style=&#34;visibility:visible;animation-delay:0.5s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item white-bg mb-30 text-center transition-3&#34;&gt;&lt;div class=&#34;services__icon mb-25 d-flex align-items-end justify-content-center&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-1/services-2.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content&#34;&gt;&lt;h3 class=&#34;services__title&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Track Attendance&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Request and approve time-off requests with ease, visualize absences in real-time with shared Out-of-office Calendar.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6&#34;&gt;&lt;div class=&#34;services__inner hover__active mb-30 wow fadeInUp&#34; data-wow-delay=&#34;.9s&#34; style=&#34;visibility:visible;animation-delay:0.9s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item white-bg text-center transition-3&#34;&gt;&lt;div class=&#34;services__icon mb-25 d-flex align-items-end justify-content-center&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-1/services-4.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content&#34;&gt;&lt;h3 class=&#34;services__title&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Personal Data&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Access your personal employee records, including job contracts and documents. Upload and edit files on the go.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;&lt;section class=&#34;why__area pt-135 pb-90&#34;&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-7 col-xl-8 col-lg-8&#34;&gt;&lt;div class=&#34;why__wrapper&#34;&gt;&lt;div class=&#34;section__title-wrapper section__title-wrapper-3 mb-45 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;span class=&#34;section__pre-title-img&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/title/why.png&#34; alt=&#34;&#34; /&gt;&lt;/span&gt; &lt;h2 class=&#34;section__title section__title-3&#34;&gt;Where great companies hire great people&lt;/h2&gt;&lt;p&gt;TimeHRM is proud of our accomplishments and we think you will be too!&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;why__counter&#34;&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;why__item text-center white-bg mb-30&#34;&gt;&lt;div class=&#34;why__icon mb-15&#34;&gt;&lt;em class=&#34;icon_star&#34;&gt;&lt;/em&gt;&lt;/div&gt;&lt;div class=&#34;why__content&#34;&gt;&lt;h3 class=&#34;why__title&#34;&gt;&lt;span class=&#34;counter&#34;&gt;4.9&lt;/span&gt; Stars&lt;/h3&gt;&lt;p&gt;Average Rating&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 wow fadeInUp&#34; data-wow-delay=&#34;.5s&#34; style=&#34;visibility:visible;animation-delay:0.5s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;why__item text-center white-bg mb-30&#34;&gt;&lt;div class=&#34;why__icon mb-15&#34;&gt;&lt;em class=&#34;icon_ribbon&#34;&gt;&lt;/em&gt;&lt;/div&gt;&lt;div class=&#34;why__content&#34;&gt;&lt;h3 class=&#34;why__title&#34;&gt;&lt;span class=&#34;counter&#34;&gt;4000&lt;/span&gt;+&lt;/h3&gt;&lt;p&gt;Global Clients&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 wow fadeInUp&#34; data-wow-delay=&#34;.7s&#34; style=&#34;visibility:visible;animation-delay:0.7s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;why__item text-center white-bg mb-30&#34;&gt;&lt;div class=&#34;why__icon mb-15&#34;&gt;&lt;em class=&#34;icon_star&#34;&gt;&lt;/em&gt;&lt;/div&gt;&lt;div class=&#34;why__content&#34;&gt;&lt;h3 class=&#34;why__title&#34;&gt;&lt;span class=&#34;counter&#34;&gt;1000&lt;/span&gt;+&lt;/h3&gt;&lt;p&gt;Client Testimonials&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 offset-xxl-1 col-xl-4 col-lg-4 col-md-6&#34;&gt;&lt;div class=&#34;why__features white-bg wow fadeInUp&#34; data-wow-delay=&#34;.9s&#34; style=&#34;visibility:visible;animation-delay:0.9s;animation-name:fadeInUp;&#34;&gt;&lt;ul&gt;&lt;li&gt;Free Setup&lt;/li&gt;&lt;li&gt;Free Support&lt;/li&gt;&lt;li&gt;Free Training&lt;/li&gt;&lt;li&gt;No Maintenance Fees&lt;/li&gt;&lt;li&gt;Free Updates/Upgrades&lt;/li&gt;&lt;/ul&gt;&lt;a href=&#34;contact&#34;&gt;Contact Us&lt;/a&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;&lt;section class=&#34;cta__area mb--149 p-relative&#34;&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;cta__inner p-relative fix z-index-1 wow fadeInUp&#34; data-wow-delay=&#34;.5s&#34; style=&#34;visibility:visible;animation-delay:0.5s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-12&#34;&gt;&lt;div class=&#34;cta__wrapper d-lg-flex justify-content-between align-items-center&#34;&gt;&lt;div class=&#34;cta__content&#34;&gt;&lt;h3 class=&#34;cta__title&#34;&gt;&lt;/h3&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;', 0),
(4, 'Features', 'main_content', '&lt;section class=&#34;services__area pt-120 pb-110 p-relative&#34;&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-8 offset-xxl-2 col-xl-10 offset-xl-1&#34;&gt;&lt;div class=&#34;section__title-wrapper section__title-wrapper-3 text-center section-padding-3 mb-80 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;span class=&#34;section__pre-title-img&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/title/services.png&#34; alt=&#34;&#34; /&gt;&lt;/span&gt; &lt;h2 class=&#34;section__title section__title-3&#34;&gt;HR Software that Improves the employee experience.&lt;/h2&gt;&lt;p&gt;HR Software that Improves the Employee Experience and Drives Business Results.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item-3 white-bg transition-3 mb-30 text-center&#34;&gt;&lt;div class=&#34;services__icon-3&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-3/services-1.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-3&#34;&gt;&lt;h3 class=&#34;services__title-3&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Secure login&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Log in safely and securely with the username and password provided by your employer.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.5s&#34; style=&#34;visibility:visible;animation-delay:0.5s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item-3 white-bg transition-3 mb-30 text-center&#34;&gt;&lt;div class=&#34;services__icon-3&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-3/services-2.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-3&#34;&gt;&lt;h3 class=&#34;services__title-3&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Everything in one place&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Get a complete overview of your employees, including finance, salary, and other add-ons all in one place.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.7s&#34; style=&#34;visibility:visible;animation-delay:0.7s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item-3 white-bg transition-3 mb-30 text-center&#34;&gt;&lt;div class=&#34;services__icon-3&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-3/services-3.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-3&#34;&gt;&lt;h3 class=&#34;services__title-3&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Core HR&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Automate essential HR processes, create transparency with accessible modules, and maintain centralized storage.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;&lt;section class=&#34;about__area pb-120 p-relative&#34;&gt;&lt;div class=&#34;about__shape&#34;&gt;&lt;img class=&#34;about-triangle&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/about/home-1/triangle.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;about-circle&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/about/home-1/circle.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;about-circle-2&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/about/home-1/circle-2.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;about-circle-3&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/about/home-1/circle-3.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;row align-items-center&#34;&gt;&lt;div class=&#34;col-xxl-5 col-xl-6 col-lg-6 col-md-9&#34;&gt;&lt;div class=&#34;about__wrapper mb-10&#34;&gt;&lt;div class=&#34;section__title-wrapper mb-25&#34;&gt;&lt;h2 class=&#34;section__title&#34;&gt;Time and attendance&lt;/h2&gt;&lt;p&gt;Setup company attendance policies, track and approve both paid and unpaid time off, and register time spent on other work-related activities through a Employee Self Service portal.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-6 offset-xxl-1 col-xl-6 col-lg-6 col-md-10 order-first order-lg-last&#34;&gt;&lt;div class=&#34;about__thumb-wrapper p-relative ml-40 fix text-end&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/about/home-1/about-bg.png&#34; alt=&#34;&#34; /&gt;&lt;div class=&#34;about__thumb p-absolute&#34;&gt;&lt;img class=&#34;bounceInUp wow about-big&#34; data-wow-delay=&#34;.3s&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/about/home-1/about-1.png&#34; alt=&#34;&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:bounceInUp;&#34; /&gt;&lt;img class=&#34;about-sm&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/about/home-1/about-1-1.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;&lt;section class=&#34;features__area pt-135 pb-120 p-relative&#34;&gt;&lt;div class=&#34;features__shape-2&#34;&gt;&lt;img class=&#34;features-2-dot&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/features/home-2/features-dot.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;features-2-dot-2&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/features/home-2/features-dot-2.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;features-2-dot-3&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/features/home-2/features-dot-3.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;features-2-triangle-1&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/features/home-2/features-triangle-1.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;features-2-triangle-2&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/features/home-2/features-triangle-2.png&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;features-2-triangle-3&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/features/home-2/features-triangle-3.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-6 offset-xxl-3 col-xl-8 offset-xl-2 col-lg-8 offset-lg-2&#34;&gt;&lt;div class=&#34;section__title-wrapper section__title-wrapper-2 text-center mb-75 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;span class=&#34;section__pre-title purple&#34;&gt;Features&lt;/span&gt; &lt;h2 class=&#34;section__title section__title-2&#34;&gt;Highly Creative Soultions&lt;/h2&gt;&lt;p&gt;software which you can handle every business transactions in a single system&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-1 col-lg-8 col-md-8&#34;&gt;&lt;div class=&#34;features__tab-content&#34;&gt;&lt;div class=&#34;tab-content&#34; id=&#34;feaTabContent&#34;&gt;&lt;div class=&#34;tab-pane fade&#34; id=&#34;sync&#34; role=&#34;tabpanel&#34; aria-labelledby=&#34;sync-tab&#34;&gt;&lt;div class=&#34;features__thumb&#34;&gt;&lt;div class=&#34;features__thumb-inner&#34;&gt;&lt;img class=&#34;fea-thumb&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/features/home-2/fea-thumb-2.jpg&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;fea-sm&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/features/home-2/fea-sm.jpg&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;fea-sm-2&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/features/home-2/fea-sm-2.jpg&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;fea-2-shape&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/features/home-2/features-shape.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;tab-pane fade show active&#34; id=&#34;security&#34; role=&#34;tabpanel&#34; aria-labelledby=&#34;security-tab&#34;&gt;&lt;div class=&#34;features__thumb&#34;&gt;&lt;div class=&#34;features__thumb-inner&#34;&gt;&lt;img class=&#34;fea-thumb&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/features/home-2/fea-thumb.jpg&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;fea-sm&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/features/home-2/fea-sm.jpg&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;fea-sm-2&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/features/home-2/fea-sm-2.jpg&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;fea-2-shape&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/features/home-2/features-shape.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;tab-pane fade&#34; id=&#34;multitask&#34; role=&#34;tabpanel&#34; aria-labelledby=&#34;multitask-tab&#34;&gt;&lt;div class=&#34;features__thumb&#34;&gt;&lt;div class=&#34;features__thumb-inner&#34;&gt;&lt;img class=&#34;fea-thumb&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/features/home-2/fea-thumb-3.jpg&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;fea-sm&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/features/home-2/fea-sm.jpg&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;fea-sm-2&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/features/home-2/fea-sm-2.jpg&#34; alt=&#34;&#34; /&gt;&lt;img class=&#34;fea-2-shape&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/features/home-2/features-shape.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;&lt;section class=&#34;services__area pt-120 pb-110 p-relative&#34;&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-8 offset-xxl-2 col-xl-10 offset-xl-1&#34;&gt;&lt;div class=&#34;section__title-wrapper section__title-wrapper-3 text-center section-padding-3 mb-80 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;span class=&#34;section__pre-title-img&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/title/services.png&#34; alt=&#34;&#34; /&gt;&lt;/span&gt; &lt;h2 class=&#34;section__title section__title-3&#34;&gt;Why Use TimeHRM Solution?&lt;/h2&gt;&lt;p&gt;With a wide variety of core HR services on the market&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item-3 white-bg transition-3 mb-30 text-center&#34;&gt;&lt;div class=&#34;services__icon-3&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-3/services-4.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-3&#34;&gt;&lt;h3 class=&#34;services__title-3&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Track of Employees&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;stay aware of how many employees work for the company/department, what roles are occupied.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.5s&#34; style=&#34;visibility:visible;animation-delay:0.5s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item-3 white-bg transition-3 mb-30 text-center&#34;&gt;&lt;div class=&#34;services__icon-3&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-3/services-5.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-3&#34;&gt;&lt;h3 class=&#34;services__title-3&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Enhanced analytics&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Create different types of reports or dashboards, adjust them according to your personalized business needs.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.7s&#34; style=&#34;visibility:visible;animation-delay:0.7s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item-3 white-bg transition-3 mb-30 text-center&#34;&gt;&lt;div class=&#34;services__icon-3&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/icon/services/home-3/services-6.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-3&#34;&gt;&lt;h3 class=&#34;services__title-3&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Solution alternative&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;offers cloud and on-premises solutions: make a choice depending on your budget and business needs.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-12 wow fadeInUp&#34; data-wow-delay=&#34;.9s&#34; style=&#34;visibility:visible;animation-delay:0.9s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__more text-center mt-30&#34;&gt;&lt;a href=&#34;register&#34; class=&#34;w-btn w-btn-purple w-btn-purple-2 w-btn-3 w-btn-6&#34; title=&#34;Try for free&#34;&gt;Try for free&lt;/a&gt; &lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;&lt;section class=&#34;services__area pt-90 pb-110&#34;&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-6 offset-xl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1&#34;&gt;&lt;div class=&#34;section__title-wrapper section__title-wrapper-4 text-center mb-65 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;h2 class=&#34;section__title section__title-4 section__title-4-p-2&#34;&gt;Bring your team together&lt;/h2&gt;&lt;p&gt;TimeHRM solutions give HR teams a new advantage over past approaches.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-6 col-xl-6 col-lg-6 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item-4 white-bg mb-30&#34;&gt;&lt;div class=&#34;services__thumb-4 text-center d-flex align-items-end justify-content-center&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/services/home-4/services-1.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-4&#34;&gt;&lt;h3 class=&#34;services__title-4&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Employee self service&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Increase employee engagement, create ownership, save time / costs, and improve collaboration with Employee Self Service (ESS) and Manager Self Service (MSS) portals.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&#34;col-xxl-6 col-xl-6 col-lg-6 col-md-6 wow fadeInUp&#34; data-wow-delay=&#34;.5s&#34; style=&#34;visibility:visible;animation-delay:0.5s;animation-name:fadeInUp;&#34;&gt;&lt;div class=&#34;services__item-4 white-bg mb-30&#34;&gt;&lt;div class=&#34;services__thumb-4 text-center d-flex align-items-end justify-content-center&#34;&gt;&lt;img src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/services/home-4/services-2.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;services__content-4&#34;&gt;&lt;h3 class=&#34;services__title-4&#34;&gt;&lt;a href=&#34;#!&#34;&gt;Performance&lt;/a&gt;&lt;/h3&gt;&lt;p&gt;Empower and engage high performers by setting clear goals and streamlining employee appraisal and feedback processes. Focus on productivity, creating a thriving company culture.&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;&lt;section class=&#34;cta__area blue-bg-10 pt-140 pb-130 p-relative fix z-index-1&#34;&gt;&lt;div class=&#34;cta__shape&#34;&gt;&lt;img class=&#34;cta-4-shape&#34; src=&#34;http://localhost/cz/timehrm_local_dav/public/frontend/assets/img/cta/home-4/cta-shape.png&#34; alt=&#34;&#34; /&gt;&lt;/div&gt;&lt;div class=&#34;container&#34;&gt;&lt;div class=&#34;row&#34;&gt;&lt;div class=&#34;col-xxl-8 offset-xxl-2&#34;&gt;&lt;div class=&#34;cta__content-4 text-center&#34;&gt;&lt;div class=&#34;section__title-wrapper section__title-wrapper-4 section__title-white text-center mb-45 wow fadeInUp&#34; data-wow-delay=&#34;.3s&#34; style=&#34;visibility:visible;animation-delay:0.3s;animation-name:fadeInUp;&#34;&gt;&lt;h2 class=&#34;section__title section__title-4&#34;&gt;Our Free Trial for 14-days Today&lt;/h2&gt;&lt;p&gt;Spend less time scheduling and more time investing in your team and business.&lt;/p&gt;&lt;/div&gt;&lt;div class=&#34;cta__form mb-25 wow fadeInUp&#34; data-wow-delay=&#34;.5s&#34; style=&#34;visibility:visible;animation-delay:0.5s;animation-name:fadeInUp;&#34;&gt;&lt;a href=&#34;register&#34; class=&#34;w-btn w-btn-3 w-btn-1&#34;&gt;Start Free Trial&lt;/a&gt; &lt;/div&gt;&lt;div class=&#34;cta__features wow fadeInUp&#34; data-wow-delay=&#34;.7s&#34; style=&#34;visibility:visible;animation-delay:0.7s;animation-name:fadeInUp;&#34;&gt;&lt;ul&gt;&lt;li&gt;Product support&lt;/li&gt;&lt;li&gt;Free Trial&lt;/li&gt;&lt;li&gt;Connect Customer&lt;/li&gt;&lt;/ul&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/section&gt;', 0),
(5, 'About Us', 'footer', '&lt;strong&gt;About Us&lt;/strong&gt;', 1),
(6, 'Communications', 'footer', 'Communications', 1),
(7, 'How It Works', 'footer', 'How It Works', 1),
(8, 'Disclaimers', 'footer', 'Disclaimers', 1);

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
(1, 'smtp', 'smtp.mailtrap.io', '8219689b0a6fbf5', '16c83d18801b3d7', 587, 'tls');

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
(4, 'code1', 'super_admin', 'Signup Company | From Frontend', 'Verify your email', '&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;span style=\"forced-color-adjust:none;box-sizing:border-box;\"&gt;Welcome {user_name}&lt;/span&gt;,&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;You are receiving this email because you have registered on our site.&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;Click the link below to active your {site_name} account as a Trial version.&lt;/p&gt;&lt;p style=\"margin-bottom:1rem;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;\"&gt;&lt;a href=\"{site_url}confirm?v={user_id}\" title=\"Verify\" target=\"_blank\"&gt;Verify&lt;/a&gt;&lt;/p&gt;&lt;p class=\"mt-4\" style=\"margin-bottom:0px;box-sizing:border-box;color:#8094ae;font-family:Roboto, sans-serif, \'Helvetica Neue\', Arial, \'Noto Sans\', sans-serif;font-size:14px;background-color:#ffffff;margin-top:1.5rem !important;\"&gt;----&lt;br style=\"box-sizing:border-box;\" /&gt;Thank You&lt;br style=\"box-sizing:border-box;\" /&gt;{site_name}&lt;/p&gt;', 1),
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
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(190, 2, 'leave_type', 'Vacation', '10', '1', '22-10-2021 04:00:12');

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
(1, 'TimeHRM', 'TimeHRM', 'LG-859636', 'RG-741526333', 'Tx-8593214014', 3, 'info@timehrm.com', '+21258-9636', 119, '9856 Mandani Road', 'Columbia YH POL', 'Missouri', '45896', 'Missouri', 'USD', '0', 'a:160:{s:3:\"USD\";s:1:\"1\";s:3:\"AED\";s:4:\"3.67\";s:3:\"AFN\";s:5:\"84.97\";s:3:\"ALL\";s:6:\"105.08\";s:3:\"AMD\";s:6:\"478.12\";s:3:\"ANG\";s:4:\"1.79\";s:3:\"AOA\";s:6:\"601.02\";s:3:\"ARS\";s:5:\"98.96\";s:3:\"AUD\";s:4:\"1.36\";s:3:\"AWG\";s:4:\"1.79\";s:3:\"AZN\";s:3:\"1.7\";s:3:\"BAM\";s:4:\"1.69\";s:3:\"BBD\";s:1:\"2\";s:3:\"BDT\";s:5:\"85.55\";s:3:\"BGN\";s:4:\"1.69\";s:3:\"BHD\";s:5:\"0.376\";s:3:\"BIF\";s:7:\"1983.15\";s:3:\"BMD\";s:1:\"1\";s:3:\"BND\";s:4:\"1.35\";s:3:\"BOB\";s:4:\"6.89\";s:3:\"BRL\";s:4:\"5.53\";s:3:\"BSD\";s:1:\"1\";s:3:\"BTN\";s:5:\"75.35\";s:3:\"BWP\";s:5:\"11.29\";s:3:\"BYN\";s:4:\"2.47\";s:3:\"BZD\";s:1:\"2\";s:3:\"CAD\";s:4:\"1.24\";s:3:\"CDF\";s:7:\"1982.45\";s:3:\"CHF\";s:5:\"0.926\";s:3:\"CLP\";s:6:\"824.54\";s:3:\"CNY\";s:4:\"6.44\";s:3:\"COP\";s:7:\"3731.42\";s:3:\"CRC\";s:6:\"626.28\";s:3:\"CUC\";s:1:\"1\";s:3:\"CUP\";s:2:\"25\";s:3:\"CVE\";s:4:\"95.2\";s:3:\"CZK\";s:5:\"21.98\";s:3:\"DJF\";s:6:\"177.72\";s:3:\"DKK\";s:4:\"6.44\";s:3:\"DOP\";s:5:\"56.19\";s:3:\"DZD\";s:6:\"137.47\";s:3:\"EGP\";s:4:\"15.7\";s:3:\"ERN\";s:2:\"15\";s:3:\"ETB\";s:5:\"46.52\";s:3:\"EUR\";s:5:\"0.863\";s:3:\"FJD\";s:4:\"2.09\";s:3:\"FKP\";s:5:\"0.733\";s:3:\"FOK\";s:4:\"6.44\";s:3:\"GBP\";s:5:\"0.733\";s:3:\"GEL\";s:4:\"3.13\";s:3:\"GGP\";s:5:\"0.733\";s:3:\"GHS\";s:4:\"6.06\";s:3:\"GIP\";s:5:\"0.733\";s:3:\"GMD\";s:5:\"52.23\";s:3:\"GNF\";s:7:\"9727.17\";s:3:\"GTQ\";s:4:\"7.73\";s:3:\"GYD\";s:6:\"208.51\";s:3:\"HKD\";s:4:\"7.78\";s:3:\"HNL\";s:5:\"24.08\";s:3:\"HRK\";s:4:\"6.51\";s:3:\"HTG\";s:5:\"98.98\";s:3:\"HUF\";s:6:\"311.76\";s:3:\"IDR\";s:8:\"14153.56\";s:3:\"ILS\";s:4:\"3.24\";s:3:\"IMP\";s:5:\"0.733\";s:3:\"INR\";s:5:\"75.35\";s:3:\"IQD\";s:7:\"1457.64\";s:3:\"IRR\";s:8:\"42004.45\";s:3:\"ISK\";s:6:\"129.82\";s:3:\"JMD\";s:6:\"149.58\";s:3:\"JOD\";s:5:\"0.709\";s:3:\"JPY\";s:6:\"113.44\";s:3:\"KES\";s:6:\"110.66\";s:3:\"KGS\";s:5:\"84.62\";s:3:\"KHR\";s:7:\"4068.82\";s:3:\"KID\";s:4:\"1.36\";s:3:\"KMF\";s:6:\"424.77\";s:3:\"KRW\";s:7:\"1192.44\";s:3:\"KWD\";s:3:\"0.3\";s:3:\"KYD\";s:5:\"0.833\";s:3:\"KZT\";s:6:\"425.44\";s:3:\"LAK\";s:8:\"10096.63\";s:3:\"LBP\";s:6:\"1507.5\";s:3:\"LKR\";s:6:\"200.74\";s:3:\"LRD\";s:6:\"168.01\";s:3:\"LSL\";s:5:\"14.84\";s:3:\"LYD\";s:4:\"4.55\";s:3:\"MAD\";s:4:\"9.07\";s:3:\"MDL\";s:5:\"17.33\";s:3:\"MGA\";s:7:\"3962.42\";s:3:\"MKD\";s:5:\"53.32\";s:3:\"MMK\";s:7:\"1928.68\";s:3:\"MNT\";s:7:\"2848.17\";s:3:\"MOP\";s:4:\"8.01\";s:3:\"MRU\";s:5:\"36.15\";s:3:\"MUR\";s:5:\"42.74\";s:3:\"MVR\";s:5:\"15.42\";s:3:\"MWK\";s:6:\"813.79\";s:3:\"MXN\";s:5:\"20.67\";s:3:\"MYR\";s:4:\"4.16\";s:3:\"MZN\";s:4:\"63.7\";s:3:\"NAD\";s:5:\"14.84\";s:3:\"NGN\";s:6:\"421.93\";s:3:\"NIO\";s:5:\"35.19\";s:3:\"NOK\";s:4:\"8.52\";s:3:\"NPR\";s:6:\"120.56\";s:3:\"NZD\";s:4:\"1.44\";s:3:\"OMR\";s:5:\"0.384\";s:3:\"PAB\";s:1:\"1\";s:3:\"PEN\";s:4:\"4.04\";s:3:\"PGK\";s:4:\"3.52\";s:3:\"PHP\";s:5:\"50.69\";s:3:\"PKR\";s:6:\"170.64\";s:3:\"PLN\";s:4:\"3.96\";s:3:\"PYG\";s:7:\"6895.86\";s:3:\"QAR\";s:4:\"3.64\";s:3:\"RON\";s:4:\"4.28\";s:3:\"RSD\";s:6:\"101.59\";s:3:\"RUB\";s:5:\"71.86\";s:3:\"RWF\";s:7:\"1015.68\";s:3:\"SAR\";s:4:\"3.75\";s:3:\"SBD\";s:4:\"7.97\";s:3:\"SCR\";s:5:\"13.55\";s:3:\"SDG\";s:6:\"439.88\";s:3:\"SEK\";s:4:\"8.73\";s:3:\"SGD\";s:4:\"1.35\";s:3:\"SHP\";s:5:\"0.733\";s:3:\"SLL\";s:8:\"10613.83\";s:3:\"SOS\";s:6:\"577.53\";s:3:\"SRD\";s:5:\"21.42\";s:3:\"SSP\";s:6:\"177.59\";s:3:\"STN\";s:5:\"21.15\";s:3:\"SYP\";s:7:\"1684.35\";s:3:\"SZL\";s:5:\"14.84\";s:3:\"THB\";s:5:\"33.26\";s:3:\"TJS\";s:5:\"11.29\";s:3:\"TMT\";s:4:\"3.49\";s:3:\"TND\";s:4:\"2.82\";s:3:\"TOP\";s:4:\"2.26\";s:3:\"TRY\";s:4:\"9.06\";s:3:\"TTD\";s:4:\"6.78\";s:3:\"TVD\";s:4:\"1.36\";s:3:\"TWD\";s:5:\"28.09\";s:3:\"TZS\";s:7:\"2300.22\";s:3:\"UAH\";s:5:\"26.27\";s:3:\"UGX\";s:7:\"3589.54\";s:3:\"UYU\";s:5:\"43.41\";s:3:\"UZS\";s:8:\"10660.63\";s:3:\"VES\";s:4:\"4.17\";s:3:\"VND\";s:8:\"22719.95\";s:3:\"VUV\";s:6:\"111.51\";s:3:\"WST\";s:4:\"2.58\";s:3:\"XAF\";s:6:\"566.36\";s:3:\"XCD\";s:3:\"2.7\";s:3:\"XDR\";s:4:\"0.71\";s:3:\"XOF\";s:6:\"566.36\";s:3:\"XPF\";s:6:\"103.03\";s:3:\"YER\";s:6:\"249.99\";s:3:\"ZAR\";s:5:\"14.84\";s:3:\"ZMW\";s:5:\"16.85\";}', 'toast-top-center', '0', 'true', 'd-m-Y', '0', 'smtp', 'logo.png', 'fav-icon.svg', 'timehrm-logo.svg', 'other-logo.svg', 'fadeInDown', 'tada', 'tada', 'en', 'Asia/Bishkek', 'paypal@example.com', 'yes', 'yes', 'sk_test_51IrqtWJck1huBCXGjafHHFZzzK28jEJq7dsRRzegUH9uQ5X7nYMhPwcSueFUlixy1M86E4o3LhZU1jsSYgCAclNW00BXVEUbwX', 'pk_test_51IrqtWJck1huBCXGe7b6UalwItsUyRcMaqRgiWINpavr859Rcd3XYLnlm3pI9rVV3cVkaLKSIQMgTxupa6774r3b00PkCajPhD', 'yes', 'rzp_test_tru3zv1YXSMlWw', 'mDSgHTiNAVp9A7MjzOmLs62d', 'yes', 'sk_test_75369aaa404d431399f92617e9ba280764e0b15c', 'pk_test_9632a18a275a520050b2f14256db3a2a4d1fade6', 'yes', 'FLWPUBK_TEST-9e3d33d126c6efd62c0bd2de00e35306-X', 'FLWSECK_TEST-1ae23b3116453d3e3cbd6d9978da8476-X', 'yes', 2, 183, 1, 'lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor', '2815767', 0, '+966541234567', '609f61e80185423e92805b90936c8d60', 'c3c86f49e18046de9490baa140f67dc2', 'bg-default', 1, 'TimeHRM provides you with a powerful and cost-effective HR platform to ensure you get the best from your employees and managers. TimeHRM is a timely solution to upgrade and modernize your HR team to make it more efficient and consolidate your employee information into one intuitive HR system.', 1, 1, '1.0.0', '2021-05-09', '09-05-2021 06:36:23');

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
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_erp_users`
--

INSERT INTO `ci_erp_users` (`user_id`, `user_role_id`, `user_type`, `company_id`, `first_name`, `last_name`, `email`, `username`, `password`, `company_name`, `trading_name`, `registration_no`, `government_tax`, `company_type_id`, `profile_photo`, `contact_number`, `gender`, `address_1`, `address_2`, `city`, `state`, `zipcode`, `country`, `last_login_date`, `last_logout_date`, `last_login_ip`, `is_logged_in`, `is_active`, `created_at`) VALUES
(1, 1, 'super_user', 0, 'Super', 'Admin', 'super.admin@timehrm.com', 'super.admin', '$2y$12$1ueUy3OsWRlNC8ktpHlwreuHog6.iSKb6SExd.ITUkQlkQNUL1ujm', 'TimeHRM', 'LG-0158963', 'RG-890258', 'Tx-231485', 5, 'avatar-2.jpg', '12333332', '1', 'Sadovnicheskaya embankment 79', 'MD 20815', 'Moscow', 'Moscow', '20834', 182, '07-11-2021 17:54:57', '08-11-2021 05:55:18', '::1', 0, 1, '09-05-2021 06:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `ci_erp_users_details`
--

CREATE TABLE `ci_erp_users_details` (
  `staff_details_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
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
  `leave_options` text DEFAULT NULL,
  `created_at` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'https://www.youtube.com/watch?v=zIOsMvbkft0', 'Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros.', 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.linkedin.com/', '2021-10-14');

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
  `leave_month` varchar(50) DEFAULT NULL,
  `reason` mediumtext NOT NULL,
  `remarks` mediumtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_half_day` tinyint(1) DEFAULT NULL,
  `leave_attachment` varchar(255) DEFAULT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, '100452187', 'Free Plan', '0.00', 1, 5, 'medal-trial.svg', 'Free Plan description goes here..', '09-05-2021 06:36:23'),
(2, '100142725', 'Bronze Plan', '59.00', 3, 12, 'medal-bronze.svg', 'Free server unlimited approx 255k+', '09-05-2021 06:36:23'),
(6, '100585963', 'Gold Plan', '99.00', 2, 10, 'medal-gold.svg', 'Free server unlimited approx 255k+ Premium collection', '09-05-2021 06:36:23'),
(7, '8031158908', 'Platinum Plan', '159.00', 2, 25, 'medal-platinum.svg', 'Free server unlimited approx 255k+', '28-09-2021 07:52:21'),
(8, '9557317331', 'Silver Plan', '299.00', 3, 50, 'medal-silver.svg', 'Free server unlimited silver collection', '28-09-2021 07:53:05');

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
  `created_at` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `ci_polls`
--

CREATE TABLE `ci_polls` (
  `poll_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `poll_question` varchar(255) NOT NULL,
  `poll_start_date` varchar(200) DEFAULT NULL,
  `poll_end_date` varchar(200) DEFAULT NULL,
  `poll_answer1` varchar(255) DEFAULT NULL,
  `poll_answer2` varchar(255) DEFAULT NULL,
  `poll_answer3` varchar(255) DEFAULT NULL,
  `poll_answer4` varchar(255) DEFAULT NULL,
  `poll_answer5` varchar(255) DEFAULT NULL,
  `notes` text NOT NULL,
  `added_by` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_polls_votes`
--

CREATE TABLE `ci_polls_votes` (
  `polls_vote_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `poll_answer` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Table structure for table `ci_warnings`
--

CREATE TABLE `ci_warnings` (
  `warning_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `warning_to` int(111) NOT NULL,
  `warning_by` int(111) NOT NULL,
  `warning_date` varchar(255) NOT NULL,
  `warning_type_id` int(111) NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_warnings`
--

INSERT INTO `ci_warnings` (`warning_id`, `company_id`, `warning_to`, `warning_by`, `warning_date`, `warning_type_id`, `attachment`, `subject`, `description`, `created_at`) VALUES
(1, 2, 4, 2, '2021-08-01', 139, 'pr22od-22.jpg', 'test', 'asdasds', '31-07-2021 04:58:04');

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
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `ci_company_membership`
--
ALTER TABLE `ci_company_membership`
  MODIFY `company_membership_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ci_company_tickets`
--
ALTER TABLE `ci_company_tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ci_company_tickets_reply`
--
ALTER TABLE `ci_company_tickets_reply`
  MODIFY `ticket_reply_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ci_complaints`
--
ALTER TABLE `ci_complaints`
  MODIFY `complaint_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=418;

--
-- AUTO_INCREMENT for table `ci_database_backup`
--
ALTER TABLE `ci_database_backup`
  MODIFY `backup_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ci_departments`
--
ALTER TABLE `ci_departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ci_designations`
--
ALTER TABLE `ci_designations`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `setting_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ci_erp_constants`
--
ALTER TABLE `ci_erp_constants`
  MODIFY `constants_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `ci_erp_settings`
--
ALTER TABLE `ci_erp_settings`
  MODIFY `setting_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_erp_users`
--
ALTER TABLE `ci_erp_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ci_erp_users_details`
--
ALTER TABLE `ci_erp_users_details`
  MODIFY `staff_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- AUTO_INCREMENT for table `ci_frontend_content`
--
ALTER TABLE `ci_frontend_content`
  MODIFY `frontend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_holidays`
--
ALTER TABLE `ci_holidays`
  MODIFY `holiday_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `ci_leave_applications`
--
ALTER TABLE `ci_leave_applications`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_meetings`
--
ALTER TABLE `ci_meetings`
  MODIFY `meeting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_membership`
--
ALTER TABLE `ci_membership`
  MODIFY `membership_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ci_office_shifts`
--
ALTER TABLE `ci_office_shifts`
  MODIFY `office_shift_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ci_official_documents`
--
ALTER TABLE `ci_official_documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_payslips`
--
ALTER TABLE `ci_payslips`
  MODIFY `payslip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `ci_payslip_allowances`
--
ALTER TABLE `ci_payslip_allowances`
  MODIFY `payslip_allowances_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_payslip_commissions`
--
ALTER TABLE `ci_payslip_commissions`
  MODIFY `payslip_commissions_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_payslip_other_payments`
--
ALTER TABLE `ci_payslip_other_payments`
  MODIFY `payslip_other_payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_payslip_statutory_deductions`
--
ALTER TABLE `ci_payslip_statutory_deductions`
  MODIFY `payslip_deduction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_performance_appraisal`
--
ALTER TABLE `ci_performance_appraisal`
  MODIFY `performance_appraisal_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `policy_id` int(111) NOT NULL AUTO_INCREMENT;

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
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ci_staff_signature_documents`
--
ALTER TABLE `ci_staff_signature_documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ci_stock_orders`
--
ALTER TABLE `ci_stock_orders`
  MODIFY `order_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ci_stock_order_items`
--
ALTER TABLE `ci_stock_order_items`
  MODIFY `order_item_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `ci_stock_order_quotes`
--
ALTER TABLE `ci_stock_order_quotes`
  MODIFY `quote_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ci_stock_order_quote_items`
--
ALTER TABLE `ci_stock_order_quote_items`
  MODIFY `quote_item_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ci_stock_products`
--
ALTER TABLE `ci_stock_products`
  MODIFY `product_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ci_stock_purchases`
--
ALTER TABLE `ci_stock_purchases`
  MODIFY `purchase_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ci_stock_purchase_items`
--
ALTER TABLE `ci_stock_purchase_items`
  MODIFY `purchase_item_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ci_stock_suppliers`
--
ALTER TABLE `ci_stock_suppliers`
  MODIFY `supplier_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ci_stock_warehouses`
--
ALTER TABLE `ci_stock_warehouses`
  MODIFY `warehouse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ci_support_tickets`
--
ALTER TABLE `ci_support_tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `ticket_reply_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ci_system_documents`
--
ALTER TABLE `ci_system_documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ci_tasks`
--
ALTER TABLE `ci_tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `time_attendance_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ci_timesheet_request`
--
ALTER TABLE `ci_timesheet_request`
  MODIFY `time_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ci_todo_items`
--
ALTER TABLE `ci_todo_items`
  MODIFY `todo_item_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `warning_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
