-- MySQL dump 10.13  Distrib 5.6.16-64.2, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: app
-- ------------------------------------------------------
-- Server version	5.6.16-64.2-569.precise

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alerts`
--

DROP TABLE IF EXISTS `alerts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alerts` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `msg` varchar(1500) NOT NULL,
  `bootstraptype` varchar(15) NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `path` varchar(255) NOT NULL,
  `archived` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `isFavorite` tinyint(1) NOT NULL DEFAULT '0',
  `filterName` varchar(50) NOT NULL,
  `ofBaby` tinyint(4) NOT NULL,
  `cvajson` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=965 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `passcode` varchar(50) NOT NULL,
  `lastactivity` datetime NOT NULL,
  `lastview` int(11) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `isArchived` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-12 13:05:59


CREATE TABLE `filter` (
  `filter_id` int(11) NOT NULL AUTO_INCREMENT,
  `visiblename` varchar(50) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`filter_id`)
);


INSERT INTO `user` (username, passcode, isAdmin) VALUES ('admin', 'admin', 0);

insert into filter (visiblename,filename,type,isArchived) VALUES
('Aquarium<br>&nbsp;','Aquarium.png','geo',0),
('Autoshow','Autoshow.png','event',1),
('Birth<br>Day','BDay.png','holiday',0),
('Bowling<br>&nbsp;','Bowling.png','geo',0),
('Build a<br>Bear','BuildABear.png','event',1),
('Car<br>','Car.png','fun',0),
('Carnival<br>&nbsp;','Carni2017.png','holiday',0),
('Cat Fat','Cat1.png','fun',0),
('Cat Corner','Cat2.png','fun',0),
('Christmas<br>&nbsp;','Christmas.png','holiday',0),
('Chuck E<br>Cheese','ChuckECheese.png','geo',0),
('Church<br>','Church.png','event',1),
('Cookie','Cookie.png','fun',0),
('Discovery<br>Museum','DM.png','geo',0),
('Easter<br>&nbsp;','Easter.png','holiday',0),
('Johnsons<br>Farm','Farm.png','geo',0),
('Franklin<br>Institute','FI.png','geo',0),
('The<br>Funplex','Funplex.png','geo',0),
('GhostBusters','GB.png','fun',0),
('At<br>Grandparents','Grandparents.png','geo',0),
('Gregs Home<br>Movies','GregsHomeMovies.png','fun',1),
('Halloween<br>&nbsp;','Halloween.png','holiday',0),
('July<br>4th','JulyFourth.png','holiday',0),
('Kid<br>Fit','KidFit.png','geo',0),
('Lego','Lego.png','fun',0),
('Library<br>&nbsp;','Library.png','geo',0),
('Little<br>Sport','LS.png','geo',0),
('French Fry','MCD.png','fun',0),
('Mothers<br>Day','md17.png','holiday',1),
('Mickey','Mickey.png','fun',0),
('My Little<br>Adventures','MLA.png','geo',0),
('Music Notes 1','Notes01.png','fun',0),
('Music Notes 2','Notes02.png','fun',0),
('OC<br>MD','OCMD.png','geo',1),
('Painting','Paint.png','fun',0),
('Park<br>&nbsp;','Park.png','geo',0),
('Paws<br>Farm','PawsFarm.png','geo',0),
('Philly<br>&nbsp;','Philly.png','geo',0),
('Pump It<br>Up','PIU.png','geo',0),
('Pool<br>&nbsp;','Pool.png','geo',0),
('Plz Touch<br>Museum','PTM.png','geo',0),
('Sesame<br>Place','Sesame.png','geo',0),
('Six<br>Flags','SixFlags.png','geo',0),
('Sky<br>Zone','SkyZone.png','geo',0),
('Snow','Snow.png','fun',0),
('St. Paddy<br>Day','StPatrickDay.png','holiday',0),
('Test<br>Pattern','TestPattern.png','fun',1),
('Train','Train.png','fun',0),
('Turkey<br>Day','Turkey.png','holiday',0),
('Valentines<br>Day','VDay.png','holiday',0),
('Water','Water.png','fun',0),
('Wizard<br>World','Wizardworld.png','event',1),
('We Rock<br>Spectrum','WRS.png','geo',0),
('Zoo<br>&nbsp;','Zoo.png','geo',0);