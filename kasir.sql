/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 5.5.38-MariaDB : Database - kasir
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`kasir` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `kasir`;

/*Table structure for table `detailpesanan` */

DROP TABLE IF EXISTS `detailpesanan`;

CREATE TABLE `detailpesanan` (
  `iddetailpesanan` int(11) NOT NULL AUTO_INCREMENT,
  `idpesanan` int(11) DEFAULT NULL,
  `idproduk` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  KEY `iddetailpesanan` (`iddetailpesanan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `detailpesanan` */

insert  into `detailpesanan`(`iddetailpesanan`,`idpesanan`,`idproduk`,`qty`,`total`) values 
(4,33,21,2,4246244);

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `idpelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `namapelanggan` varchar(30) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  PRIMARY KEY (`idpelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pelanggan` */

insert  into `pelanggan`(`idpelanggan`,`namapelanggan`,`notelp`,`alamat`) values 
(18,'Renas','234234234','dasasddcf');

/*Table structure for table `pesanan` */

DROP TABLE IF EXISTS `pesanan`;

CREATE TABLE `pesanan` (
  `idorder` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idpelanggan` int(11) NOT NULL,
  PRIMARY KEY (`idorder`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pesanan` */

insert  into `pesanan`(`idorder`,`tanggal`,`idpelanggan`) values 
(33,'2022-06-16 12:39:22',18);

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `idproduk` int(11) NOT NULL AUTO_INCREMENT,
  `namaproduk` varchar(20) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`idproduk`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

/*Data for the table `produk` */

insert  into `produk`(`idproduk`,`namaproduk`,`deskripsi`,`harga`,`stock`) values 
(21,'tes','sdfsa',2123122,10);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
