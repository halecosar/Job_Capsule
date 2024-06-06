-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 02:16 PM
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
-- Database: `jobcapsule`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `recruiterNote` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `user_id`, `job_id`, `status`, `recruiterNote`) VALUES
(13, 36, 1, 2, 'adayla telefon mülakatı yapıldı, başvuruya uygun görünüyor.'),
(14, 37, 6, 4, 'ik mülakatı başarılı geçti, case gönderildi'),
(15, 38, 8, 8, 'adayın maaş beklentisi çok yüksek'),
(16, 35, 1, 1, ''),
(17, 35, 6, 1, ''),
(18, 35, 8, 1, ''),
(19, 35, 14, 6, 'adayın teknik becerisi yeterli, cto ile görüşecek');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `short_description` text NOT NULL,
  `long_description` text NOT NULL,
  `location` varchar(100) NOT NULL,
  `created_on` date NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `last_modified_on` date DEFAULT NULL,
  `last_modified_by` varchar(100) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `short_description`, `long_description`, `location`, `created_on`, `created_by`, `last_modified_on`, `last_modified_by`, `is_deleted`, `isActive`) VALUES
(1, 'Media Category Manager -', 'We are looking for a \'Media Category Manager - Purchasing\' to work in accordance with our', 'We are looking for a \'Media Category Manager - Purchasing\' to work in accordance with our client who is one of the leading companies in white goods industries.\r\n\r\nResponsibilities;\r\n\r\nDirectly responsible to lead all Global Media Pitch Processes, supplier management, negotiations and agreements.\r\nManaging the Media Agency Pitch Documentation: Terms&Conditions, Commitment Table, Media Agency Contract, Media Spending Report Template\r\nResponsible to develop an efficient, measurable, and standardized, transparent media Buying process in HQ and TR and to ensure its continuity.\r\nSupporting ongoing improvement efforts related to Company’s Media Management processes.\r\nEnsuring significant cost advantages by obtaining rebates from Media Agencies through compliant process implementation\r\nReporting, pursuing, and describing the goals assigned by the Purchasing Directorate.\r\nBeing responsible for contract management and supplier relationships.\r\nWorking closely with multi-functional and multinational teams to create and execute global long-term strategies and projects.\r\nMonitoring Digital media and media related technology trends.\r\n\r\nQualifications;\r\n\r\nBachelor\'s Degree in Engineering, Communication, Economics/Business Administration, or Media related departments,\r\nExcellent verbal and written skills in English,\r\nMinimum 5 years of work experience, with at least 3 years at the Media Agencies.\r\nMedia procurement experience highly preferable.\r\nGood knowledge of Microsoft Office Programs,\r\nAble to lead project management, negotiation, and contract management\r\nFollowing and adopting the market trends and new technologies,\r\nOutside the box thinking ability,', 'Istanbul', '2024-05-27', 'test', '2024-06-05', 'admin', 0, 1),
(2, 'test1', 'test1', 'test1', 'test1', '2024-05-27', 'test1', NULL, NULL, 1, 0),
(3, 'test2', 'test2', 'test2', 'test2', '2024-05-27', 'test2', NULL, NULL, 1, 0),
(4, 'a', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', 'a', '0000-00-00', 'admin', '2024-05-28', 'a', 1, 0),
(5, 'ömer', 'ömerömeöemmörmörmrörmrörmrmör', 'ömerömeöemmörmörmrörmrörmrmör', 'e', '0000-00-00', 'admin', '2024-05-28', 'e', 1, 0),
(6, 'Sales Finance Analysis and Reporting Specialist', 'For our business partner, one of the leading players in the Turkish FMCG industry, we are looking fo', 'For our business partner, one of the leading players in the Turkish FMCG industry, we are looking for talented candidates with the following qualifications for the positions of &quot;Sales Finance Analysis and Reporting Specialist &#039;&#039; in Istanbul location.\r\n\r\n\r\n\r\nQUALIFICATIONS\r\n\r\nGraduated from relevant undergraduate programs at universities,\r\nAt least 2 years of experience in Sales Finance field,\r\nStrong analytical thinking skills, team player, and result-oriented,\r\nProficiency in MS Office programs, especially Excel,\r\nGood command of English,\r\nCompleted military service for male candidates.\r\n\r\n\r\n\r\n\r\nJOB DESCRIPTION\r\n\r\nActive involvement in annual target setting efforts, ensuring targets are defined in the system and revised when necessary,\r\nVerification of quarterly sales team incentive calculations for compliance with defined criteria,\r\nConducting monthly budget versus actual expense controls by domestic sales channel,\r\nPreparation and analysis of monthly quantity and net net revenue budget revisions (S&amp;OP) in coordination with Sales and Marketing teams,\r\nReconciliation of incentive agreements with sales channels and customer bases,\r\nEffective support for audit activities,\r\nCalculation, monitoring, and reporting of entitlements related to sales incentives/sales back invoices (revenue premiums, sales incentives, etc.),\r\nVerification of monthly/daily price lists shared by Marketing for compliance with upper management decisions, obtaining approvals through coordination with marketing and customer service,\r\nParticipation in digital transformation efforts (RPA, SAP system development projects).', 'İstanbul', '2024-05-28', 'admin', '0000-00-00', '', 0, 1),
(7, 'asdasd', 'asdasdasdasdasdasdasdasd', 'adasdasdasdasdasdassd', 'asdasd', '2024-05-28', 'admin', '0000-00-00', '', 1, 1),
(8, 'Data Engineer', 'We are looking for a Data Engineer for Sabancı Ageas Health Insurance which is building a team for their new insurance product with new technologies.', 'We are looking for a Data Engineer for Sabancı Ageas Health Insurance which is building a team for their new insurance product with new technologies.\r\n\r\nQualifications\r\n\r\n· Expertise in Qlik Sense as a key skill to manipulate data from multiple sources\r\n\r\n· Strong experience in structured report writing using Qlik Sense for effective business intelligence\r\n\r\n· Data visualization / BI tools knowledge (preferably Qlik Sense)\r\n\r\n· Proficiency in Oracle Data Integrator (ODI) for efficient ETL data transformations\r\n\r\n· Mastery in SQL-led operations for advanced database management and optimization\r\n\r\n· Highly skilled in ETL tools for consistent data movement and transformation\r\n\r\n· Experience in Data Modeling, both logical and physical, for apt data structuring\r\n\r\n· 3-5 years of experience in data engineering, demonstrating a steady career growth and increasing responsibility\r\n\r\n· Having knowledge or experience in big data ecosystems\r\n\r\n· Data Science experience with Python or R programming is a plus\r\n\r\nResponsibilities\r\n\r\n· Analyzing the analytical and reporting needs of the company and ensuring that it is modeled and implemented in the existing Business Intelligence system\r\n\r\n· Design, build and maintain efficient and reliable data pipelines to move and transform large volumes of data\r\n\r\n· To carry out tasks for ETL processes\r\n\r\n· Collaborate with data scientists and analysts to understand their data requirements and provide the necessary infrastructure and tools\r\n\r\n· Develop prototypes and proof-of-concepts for new data processing frameworks and technologies\r\n\r\n· Optimize performance and scalability of data processing and storage systems\r\n\r\n· Troubleshoot and resolve issues related to data pipelines and processing jobs\r\n\r\n· Ensure data quality and integrity through data validation and quality checks\r\n\r\n· Implement security measures to protect sensitive data and comply with privacy regulations\r\n\r\n· Work closely with cross-functional teams to identify and prioritize data engineering needs\r\n\r\n· Stay up to date with the latest trends and advancements in data engineering and recommend improvements to existing processes\r\n\r\n· Collaborate with software engineers to integrate data engineering workflows into the overall application architecture.', 'Sivas', '2024-05-28', 'admin', '0000-00-00', '', 0, 1),
(9, 'TEST', 'We are looking for a Data Engineer for Sabancı Ageas Health Insurance which is building a team for their new insurance product with new technologies.\r\n\r\nQualifications\r\n\r\n· Expertise in Qlik Sense as a key skill to manipulate data from multiple sources\r\n\r\n· Strong experience in structured report writing using Qlik Sense for effective business intelligence\r\n\r\n· Data visualization / BI tools knowledge (preferably Qlik Sense)\r\n\r\n· Proficiency in Oracle Data Integrator (ODI) for efficient ETL data transformations\r\n\r\n· Mastery in SQL-led operations for advanced database management and optimization\r\n\r\n· Highly skilled in ETL tools for consistent data movement and transformation\r\n\r\n· Experience in Data Modeling, both logical and physical, for apt data structuring\r\n\r\n· 3-5 years of experience in data engineering, demonstrating a steady career growth and increasing responsibility\r\n\r\n· Having knowledge or experience in big data ecosystems\r\n\r\n· Data Science experience with Python or R programming is a plus\r\n\r\nResponsibilities\r\n\r\n· Analyzing the analytical and reporting needs of the company and ensuring that it is modeled and implemented in the existing Business Intelligence system\r\n\r\n· Design, build and maintain efficient and reliable data pipelines to move and transform large volumes of data\r\n\r\n· To carry out tasks for ETL processes\r\n\r\n· Collaborate with data scientists and analysts to understand their data requirements and provide the necessary infrastructure and tools\r\n\r\n· Develop prototypes and proof-of-concepts for new data processing frameworks and technologies\r\n\r\n· Optimize performance and scalability of data processing and storage systems\r\n\r\n· Troubleshoot and resolve issues related to data pipelines and processing jobs\r\n\r\n· Ensure data quality and integrity through data validation and quality checks\r\n\r\n· Implement security measures to protect sensitive data and comply with privacy regulations\r\n\r\n· Work closely with cross-functional teams to identify and prioritize data engineering needs\r\n\r\n· Stay up to date with the latest trends and advancements in data engineering and recommend improvements to existing processes\r\n\r\n· Collaborate with software engineers to integrate data engineering workflows into the overall application architecture.\r\nWe are looking for a Data Engineer for Sabancı Ageas Health Insurance which is building a team for their new insurance product with new technologies.\r\n\r\nQualifications\r\n\r\n· Expertise in Qlik Sense as a key skill to manipulate data from multiple sources\r\n\r\n· Strong experience in structured report writing using Qlik Sense for effective business intelligence\r\n\r\n· Data visualization / BI tools knowledge (preferably Qlik Sense)\r\n\r\n· Proficiency in Oracle Data Integrator (ODI) for efficient ETL data transformations\r\n\r\n· Mastery in SQL-led operations for advanced database management and optimization\r\n\r\n· Highly skilled in ETL tools for consistent data movement and transformation\r\n\r\n· Experience in Data Modeling, both logical and physical, for apt data structuring\r\n\r\n· 3-5 years of experience in data engineering, demonstrating a steady career growth and increasing responsibility\r\n\r\n· Having knowledge or experience in big data ecosystems\r\n\r\n· Data Science experience with Python or R programming is a plus\r\n\r\nResponsibilities\r\n\r\n· Analyzing the analytical and reporting needs of the company and ensuring that it is modeled and implemented in the existing Business Intelligence system\r\n\r\n· Design, build and maintain efficient and reliable data pipelines to move and transform large volumes of data\r\n\r\n· To carry out tasks for ETL processes\r\n\r\n· Collaborate with data scientists and analysts to understand their data requirements and provide the necessary infrastructure and tools\r\n\r\n· Develop prototypes and proof-of-concepts for new data processing frameworks and technologies\r\n\r\n· Optimize performance and scalability of data processing and storage systems\r\n\r\n· Troubleshoot and resolve issues related to data pipelines and processing jobs\r\n\r\n· Ensure data quality and integrity through data validation and quality checks\r\n\r\n· Implement security measures to protect sensitive data and comply with privacy regulations\r\n\r\n· Work closely with cross-functional teams to identify and prioritize data engineering needs\r\n\r\n· Stay up to date with the latest trends and advancements in data engineering and recommend improvements to existing processes\r\n\r\n· Collaborate with software engineers to integrate data engineering workflows into the overall application architecture.', 'We are looking for a Data Engineer for Sabancı Ageas Health Insurance which is building a team for their new insurance product with new technologies.\r\n\r\nQualifications\r\n\r\n· Expertise in Qlik Sense as a key skill to manipulate data from multiple sources\r\n\r\n· Strong experience in structured report writing using Qlik Sense for effective business intelligence\r\n\r\n· Data visualization / BI tools knowledge (preferably Qlik Sense)\r\n\r\n· Proficiency in Oracle Data Integrator (ODI) for efficient ETL data transformations\r\n\r\n· Mastery in SQL-led operations for advanced database management and optimization\r\n\r\n· Highly skilled in ETL tools for consistent data movement and transformation\r\n\r\n· Experience in Data Modeling, both logical and physical, for apt data structuring\r\n\r\n· 3-5 years of experience in data engineering, demonstrating a steady career growth and increasing responsibility\r\n\r\n· Having knowledge or experience in big data ecosystems\r\n\r\n· Data Science experience with Python or R programming is a plus\r\n\r\nResponsibilities\r\n\r\n· Analyzing the analytical and reporting needs of the company and ensuring that it is modeled and implemented in the existing Business Intelligence system\r\n\r\n· Design, build and maintain efficient and reliable data pipelines to move and transform large volumes of data\r\n\r\n· To carry out tasks for ETL processes\r\n\r\n· Collaborate with data scientists and analysts to understand their data requirements and provide the necessary infrastructure and tools\r\n\r\n· Develop prototypes and proof-of-concepts for new data processing frameworks and technologies\r\n\r\n· Optimize performance and scalability of data processing and storage systems\r\n\r\n· Troubleshoot and resolve issues related to data pipelines and processing jobs\r\n\r\n· Ensure data quality and integrity through data validation and quality checks\r\n\r\n· Implement security measures to protect sensitive data and comply with privacy regulations\r\n\r\n· Work closely with cross-functional teams to identify and prioritize data engineering needs\r\n\r\n· Stay up to date with the latest trends and advancements in data engineering and recommend improvements to existing processes\r\n\r\n· Collaborate with software engineers to integrate data engineering workflows into the overall application architecture.\r\nWe are looking for a Data Engineer for Sabancı Ageas Health Insurance which is building a team for their new insurance product with new technologies.\r\n\r\nQualifications\r\n\r\n· Expertise in Qlik Sense as a key skill to manipulate data from multiple sources\r\n\r\n· Strong experience in structured report writing using Qlik Sense for effective business intelligence\r\n\r\n· Data visualization / BI tools knowledge (preferably Qlik Sense)\r\n\r\n· Proficiency in Oracle Data Integrator (ODI) for efficient ETL data transformations\r\n\r\n· Mastery in SQL-led operations for advanced database management and optimization\r\n\r\n· Highly skilled in ETL tools for consistent data movement and transformation\r\n\r\n· Experience in Data Modeling, both logical and physical, for apt data structuring\r\n\r\n· 3-5 years of experience in data engineering, demonstrating a steady career growth and increasing responsibility\r\n\r\n· Having knowledge or experience in big data ecosystems\r\n\r\n· Data Science experience with Python or R programming is a plus\r\n\r\nResponsibilities\r\n\r\n· Analyzing the analytical and reporting needs of the company and ensuring that it is modeled and implemented in the existing Business Intelligence system\r\n\r\n· Design, build and maintain efficient and reliable data pipelines to move and transform large volumes of data\r\n\r\n· To carry out tasks for ETL processes\r\n\r\n· Collaborate with data scientists and analysts to understand their data requirements and provide the necessary infrastructure and tools\r\n\r\n· Develop prototypes and proof-of-concepts for new data processing frameworks and technologies\r\n\r\n· Optimize performance and scalability of data processing and storage systems\r\n\r\n· Troubleshoot and resolve issues related to data pipelines and processing jobs\r\n\r\n· Ensure data quality and integrity through data validation and quality checks\r\n\r\n· Implement security measures to protect sensitive data and comply with privacy regulations\r\n\r\n· Work closely with cross-functional teams to identify and prioritize data engineering needs\r\n\r\n· Stay up to date with the latest trends and advancements in data engineering and recommend improvements to existing processes\r\n\r\n· Collaborate with software engineers to integrate data engineering workflows into the overall application architecture.', 'aaa', '2024-05-28', 'admin', '0000-00-00', '', 1, 1),
(10, 'aaaaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'We are looking for a Data Engineer for Sabancı Ageas Health Insurance which is building a team for their new insurance product with new technologies.\r\n\r\nQualifications\r\n\r\n· Expertise in Qlik Sense as a key skill to manipulate data from multiple sources\r\n\r\n· Strong experience in structured report writing using Qlik Sense for effective business intelligence\r\n\r\n· Data visualization / BI tools knowledge (preferably Qlik Sense)\r\n\r\n· Proficiency in Oracle Data Integrator (ODI) for efficient ETL data transformations\r\n\r\n· Mastery in SQL-led operations for advanced database management and optimization\r\n\r\n· Highly skilled in ETL tools for consistent data movement and transformation\r\n\r\n· Experience in Data Modeling, both logical and physical, for apt data structuring\r\n\r\n· 3-5 years of experience in data engineering, demonstrating a steady career growth and increasing responsibility\r\n\r\n· Having knowledge or experience in big data ecosystems\r\n\r\n· Data Science experience with Python or R programming is a plus\r\n\r\nResponsibilities\r\n\r\n· Analyzing the analytical and reporting needs of the company and ensuring that it is modeled and implemented in the existing Business Intelligence system\r\n\r\n· Design, build and maintain efficient and reliable data pipelines to move and transform large volumes of data\r\n\r\n· To carry out tasks for ETL processes\r\n\r\n· Collaborate with data scientists and analysts to understand their data requirements and provide the necessary infrastructure and tools\r\n\r\n· Develop prototypes and proof-of-concepts for new data processing frameworks and technologies\r\n\r\n· Optimize performance and scalability of data processing and storage systems\r\n\r\n· Troubleshoot and resolve issues related to data pipelines and processing jobs\r\n\r\n· Ensure data quality and integrity through data validation and quality checks\r\n\r\n· Implement security measures to protect sensitive data and comply with privacy regulations\r\n\r\n· Work closely with cross-functional teams to identify and prioritize data engineering needs\r\n\r\n· Stay up to date with the latest trends and advancements in data engineering and recommend improvements to existing processes\r\n\r\n· Collaborate with software engineers to integrate data engineering workflows into the overall application architecture.', 'aaa', '2024-05-28', 'admin', '0000-00-00', '', 1, 1),
(11, 'xxxxxx', 'xxxxxxxxxxxxxxxxxxxx', 'We are looking for a Data Engineer for Sabancı Ageas Health Insurance which is building a team for their new insurance product with new technologies.\r\n\r\nQualifications\r\n\r\n· Expertise in Qlik Sense as a key skill to manipulate data from multiple sources\r\n\r\n· Strong experience in structured report writing using Qlik Sense for effective business intelligence\r\n\r\n· Data visualization / BI tools knowledge (preferably Qlik Sense)\r\n\r\n· Proficiency in Oracle Data Integrator (ODI) for efficient ETL data transformations\r\n\r\n· Mastery in SQL-led operations for advanced database management and optimization\r\n\r\n· Highly skilled in ETL tools for consistent data movement and transformation\r\n\r\n· Experience in Data Modeling, both logical and physical, for apt data structuring\r\n\r\n· 3-5 years of experience in data engineering, demonstrating a steady career growth and increasing responsibility\r\n\r\n· Having knowledge or experience in big data ecosystems\r\n\r\n· Data Science experience with Python or R programming is a plus\r\n\r\nResponsibilities\r\n\r\n· Analyzing the analytical and reporting needs of the company and ensuring that it is modeled and implemented in the existing Business Intelligence system\r\n\r\n· Design, build and maintain efficient and reliable data pipelines to move and transform large volumes of data\r\n\r\n· To carry out tasks for ETL processes\r\n\r\n· Collaborate with data scientists and analysts to understand their data requirements and provide the necessary infrastructure and tools\r\n\r\n· Develop prototypes and proof-of-concepts for new data processing frameworks and technologies\r\n\r\n· Optimize performance and scalability of data processing and storage systems\r\n\r\n· Troubleshoot and resolve issues related to data pipelines and processing jobs\r\n\r\n· Ensure data quality and integrity through data validation and quality checks\r\n\r\n· Implement security measures to protect sensitive data and comply with privacy regulations\r\n\r\n· Work closely with cross-functional teams to identify and prioritize data engineering needs\r\n\r\n· Stay up to date with the latest trends and advancements in data engineering and recommend improvements to existing processes\r\n\r\n· Collaborate with software engineers to integrate data engineering workflows into the overall application architecture.', 'İstanbul', '2024-05-28', 'admin', '2024-05-28', 'admin', 1, 1),
(12, 'asdasdasdasdaasdasdasdasdaasdasdasdasdaasdasdasdasdaasdasdasdasda', 'asdasdasdasdaasdasdasdasdaasdasd', 'asdasdasdasdaasdasdasdasdaasdaahrhyhyh', 'asdasdasd213', '2024-05-28', 'admin', '2024-05-28', 'admin', 1, 0),
(13, 'qqqqqqqqqqqqqqqqqqqqqqqqqqqq', 'qqqqqqqqq', 'qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq', 'qqq', '2024-05-28', 'admin', '2024-05-28', 'admin', 1, 1),
(14, 'Frontend Developer', 'We are looking for a “Frontend Developer” for our team. If you are willing to work in the fintech industry and be part of both ParamTech\'s experienced team and global projects as well as technology transformations, we are looking forward to your application.', 'Basic Qualifications;\r\n\r\nGraduated from relevant Engineering, MIS, Computer Science, Computer and Instructional Technologies, or Computer Programming departments of universities,\r\nAt least 2 years of experience in application development with React Native or React.js,\r\nImproved in frontend technologies (React, Redux, TypeScript, REST, Javascript, OOP, HTML5, CSS3, LESS/SCSS, Git, and Responsive Design),\r\nExperienced in developing javascript-based web applications compatible with microservice architecture,\r\nCreating reusable code and libraries,\r\nDeveloped SEO-friendly SSR-compatible applications with Nextjs,\r\nAble to write reusable, testable, and efficient code (Jest, Enzym, Cucumber, React Testing Library),\r\nKnowledgeable about next-generation web and mobile interface design processes and user experience,\r\nWriting high-level fast, quality, secure, and scalable code,\r\nDeveloping existing and upcoming web applications with appropriate technology,\r\nHave a UI/UX design perspective, experienced in cross-browser, browser compatibility, and responsive design,', 'İstanbul', '2024-06-06', 'admin', '2024-06-06', 'admin', 0, 1),
(15, 'Junior Software Developer', 'Mevcut yazılım ürünlerimizin gelişimi ve sürekliliğini sağlarken, teknolojik gelişimi ve dönüşümünde de bizimle birlikte yol almak ister misiniz?', 'Bilgisayar mühendisliği veya ilgili bölümlerden mezun\r\nEn az 1 yıl C# ve .Net teknolojileri ile yazılım geliştirme tecrübesine sahip\r\nNesne yönelimli programlama ve tasarım konusunda bilgili\r\nSQL veritabanı konusunda bilgi sahibi ve T-SQL sorguları yazabilen\r\nMasaüstü yada Web uygulamaları geliştirmiş\r\nWeb Servisleri ile entegrasyonlar konusunda bilgi sahibi\r\nTercihen WPF ile masaüstü uygulama geliştirme konusunda bilgi sahibi\r\nTeknik dokümantasyonları okuyup anlayabilecek düzeyde İngilizceye hâkim\r\nAnalitik düşünebilen, problem çözme becerisi olan, gelişime ve yeniliklere açık\r\nEkip çalışmasına yatkın, sorumluluk sahibi, kendini geliştirme konusunda hevesli\r\nErkek adaylar için askerliğini tamamlamış\r\n\r\n\r\nİlginizi çekebilecek yan haklarımız;\r\n\r\nSürekli öğrenme, eğitim ve gelişim olanakları\r\nÖzel Sağlık Sigortası\r\nYemek kartı, taze atıştırmalıklar&amp;içecekler, mutlu saatler ve ekip motivasyon etkinlikleri', 'Istanbul', '2024-06-06', 'admin', '0000-00-00', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `role` bit(1) NOT NULL DEFAULT b'0',
  `cvfilename` text NOT NULL,
  `isDeleted` bit(1) NOT NULL DEFAULT b'0',
  `lastTitle` text NOT NULL,
  `lastCompany` text NOT NULL,
  `experienceYear` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `mail`, `password`, `phone`, `fullname`, `role`, `cvfilename`, `isDeleted`, `lastTitle`, `lastCompany`, `experienceYear`) VALUES
(34, 'admin@admin.com', '$2y$10$ByL6TaIBgkzhhu5by043d.4P7YcKzV9l9bXHHbn5U3rpplXXiJ.0.', '1234567890', 'Admin', b'1', 'c1d63bfed9ebdb9d5dfb54d1180e3b9a.pdf', b'0', '', '', 0),
(35, 'hale@cosar.com', '$2y$10$XVcXXwHbLowAzgkCGCAAYuOaDuv6KfFf3oje9iE4PD8rvnnGUpy2G', '1234567890', 'Hale Coşar', b'0', '26a834a213d43e522d1a5566066f143e.pdf', b'0', '', '', 0),
(36, 'aday1@aday1.com', '$2y$10$UaxI5f3v44X.EZ5cIdsdFeF5l2YVE/987veMDzbF/I0WbAfTMMQyS', '1234567899', 'aday1', b'0', '3d581e6bc6a22990946df43fe17e3f09.pdf', b'0', 'software developer', 'akbank', 5),
(37, 'aday2@aday2.com', '$2y$10$XhiTAD5IY/rISzl1RhriNOX9MgAlw/9zRJvhZbeAHgt.dis8mnKfm', '1234567890', 'aday2', b'0', 'cf2613e4002804bd9c6d5289c46b726d.pdf', b'0', '', '', 0),
(38, 'aday3@aday3.com', '$2y$10$yZCK.BB/mF.qbGKYU8ZwGOobRMdqY9K0jsBmu3dDiJx97yTGZ1GEm', '1234567890', 'aday3', b'0', 'c7fa5e4c537a22d8a74378ce2f9ab880.pdf', b'0', '', '', 0),
(39, 'aday4@aday4.com', '$2y$10$.yqMMrgALQ8yNvT5rSNZBeZY259nO916UOPNPcPCLRDqNWXcdtfQO', '1234567890', 'aday4', b'0', '5c6f3acc839e0231c3185dfa908ddb7a.pdf', b'0', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
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
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `application_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
