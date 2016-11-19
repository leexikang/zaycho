<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use \mysqli as mysqli;

class StartupController extends Controller
{
    /**
     * undocumented function
     *
     * @return void
     */
    public function startup(){
        return view('startup');
    }
    public function initDatabase()
    {
        // Specify You Database cridentifl here
        $servername = env('DB_HOST');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        //        $dbname = env('DB_DATABASE');
        $dbname = 'testBulk';

        $conn = new mysqli($servername, $username, $password);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error . "</br>");
        }

        // Create database
        $sql = "CREATE DATABASE " . $dbname;
        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully <br/>";
        } else {
            echo "Error creating database: " . $conn->error , "</br>";
        }

        $conn->close();


        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error) . "</br>";
        } 

        $sql = "CREATE TABLE `users` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`))";

        if ($conn->query($sql) === TRUE) {
            echo "Table Users created successfully <br/>";
        } else {
            echo "Error creating table: " . $conn->error . "<br/>";
        }


        $sql = "CREATE TABLE `categories` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            PRIMARY KEY (`id`))";


        if ($conn->query($sql) === TRUE) {
            echo "Table categories created successfully <br/>";
        } else {
            echo "Error creating table: " . $conn->error . "<br/>";
        }

        $sql = "CREATE TABLE `orders` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `archive` tinyint(1) NOT NULL DEFAULT '0',
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            `user_id` int(10) unsigned DEFAULT NULL,
            `checkout` tinyint(1) NOT NULL DEFAULT '0',
            PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE)";

        if ($conn->query($sql) === TRUE) {
            echo "Table orders created successfully <br/>";
        } else {
            echo "Error creating table: " . $conn->error . "<br/>";
        }

        $sql = "CREATE TABLE `deliveries` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `ship` tinyint(1) NOT NULL DEFAULT '0',
            `arrive` tinyint(1) NOT NULL DEFAULT '0',
            `arrival_date` datetime NULL DEFAULT NULL,
            `order_id` int(10) unsigned NOT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
  KEY `deliveries_order_id_foreign` (`order_id`),
  CONSTRAINT `deliveries_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE)";

        if ($conn->query($sql) === TRUE) {
            echo "Table deliveries created successfully <br/>";
        } else {
            echo "Error creating table: " . $conn->error . "<br/>";
        }


        $sql = "CREATE TABLE `invoices` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `order_id` int(10) unsigned NOT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
  KEY `invoices_order_id_foreign` (`order_id`),
  CONSTRAINT `invoices_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE)";

        if ($conn->query($sql) === TRUE) {
            echo "Table invoices created successfully <br/>";
        } else {
            echo "Error creating table: " . $conn->error . "<br/>";
        }
        $sql = "CREATE TABLE `suppliers` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            PRIMARY KEY (`id`))";

        if ($conn->query($sql) === TRUE) {
            echo "Table suppliers created successfully <br/>";
        } else {
            echo "Error creating table: " . $conn->error . "<br/>";
        }

        $sql = "CREATE TABLE `products` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            `price` int(11) NOT NULL,
            `minimun_sale` int(11) NOT NULL DEFAULT '0',
            `bought` int(11) DEFAULT '0',
            `due_date` datetime ,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            `category_id` int(10) unsigned DEFAULT NULL,
            `supplier_id` int(10) unsigned DEFAULT NULL,
            PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_supplier_id_foreign` (`supplier_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE)";

        if ($conn->query($sql) === TRUE) {
            echo "Table products created successfully <br/>";
        } else {
            echo "Error creating table: " . $conn->error . "<br/>";
        }

        $sql = "CREATE TABLE `order_details` (
            `product_id` int(10) unsigned NOT NULL,
            `order_id` int(10) unsigned NOT NULL,
            `quantity` int(11) NOT NULL DEFAULT '1',
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            KEY `order_details_product_id_foreign` (`product_id`),
  KEY `order_details_order_id_foreign` (`order_id`),
  CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE)";

        if ($conn->query($sql) === TRUE) {
            echo "Table order_details created successfully <br/>";
        } else {
            echo "Error creating table: " . $conn->error . "<br/>";
        }

        $sql = "CREATE TABLE `staffs` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
  UNIQUE KEY `staffs_email_unique` (`email`))";

        if ($conn->query($sql) === TRUE) {
            echo "Table staffs created successfully <br/>";
        } else {
            echo "Error creating table: " . $conn->error . "<br/>";
        }

        $sql = "CREATE TABLE `photos` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            `main` tinyint(1) NOT NULL,
            `thumbnail_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            `product_id` int(10) unsigned NOT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
  KEY `photos_product_id_foreign` (`product_id`),
  CONSTRAINT `photos_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE)";

        if ($conn->query($sql) === TRUE) {
            echo "Table photos created successfully <br/>";
        } else {
            echo "Error creating table: " . $conn->error . "<br/>";
        }

        $sql = "CREATE TABLE `payments` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `pay` tinyint(1) NOT NULL DEFAULT '0',
            `user_id` int(10) unsigned DEFAULT NULL,
            `order_id` int(10) unsigned DEFAULT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
  KEY `payments_user_id_foreign` (`user_id`),
  KEY `payments_order_id_foreign` (`order_id`),
  CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE)";

        if ($conn->query($sql) === TRUE) {
            echo "Table payments created successfully <br/>";
        } else {
            echo "Error creating table: " . $conn->error . "<br/>";
        }

        $sql  =  "INSERT INTO `suppliers` VALUES (1,'Quitzon-Rempel','50371 Terry Fork Suite 669'),(2,'Kessler-Turner','26202 Dortha Vista Suite 616'),(3,'Jones Ltd','329 Cydney Mews'),(4,'Waters-VonRueden','2213 Welch Burg'),(5,'Maggio LLC','222 Davin Forks Suite 528'),(6,'Hodkiewicz, Herzog and Considine','73780 Enrique Brook Suite 226'),(7,'Bode Ltd','21788 Anabelle Drive'),(8,'Marks-Schmeler','550 Spencer Fork Suite 999'),(9,'Feil, Howell and Shields','1718 Osbaldo Road'),(10,'Howell, O\'Connell and Von','9350 Thelma Walks Apt. 464');";
        if (mysqli_query($conn, $sql)) {
            echo "Suppliers record created successfully <br/>";

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        $sql = "INSERT INTO `categories` VALUES (1,'Eletronices'),(2,'Sport'),(3,'Home&Garden'),(4,'Health&Beauty'),(5,'Fashion'),(6,'Food&Drink');";

        if (mysqli_query($conn, $sql)) {
            echo "categories record created successfully <br/>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        $sql = " INSERT INTO `products` VALUES (1,'Samsung9629',481,200,187,'2016-03-17 00:00:00','2016-11-18 09:38:35','2016-11-18 09:38:35',4,7),(2,'Samsung9930',125,200,291,'2016-10-24 00:00:00','2016-11-18 09:38:36','2016-11-18 09:38:36',1,5),(3,'Samsung474',754,200,153,'2016-01-17 00:00:00','2016-11-18 09:38:36','2016-11-18 09:38:36',3,2),(4,'Samsung7606',575,200,170,'2016-08-06 00:00:00','2016-11-18 09:38:36','2016-11-18 09:38:36',4,6),(5,'Samsung2761',181,200,300,'2016-11-27 00:00:00','2016-11-18 09:38:36','2016-11-18 09:38:36',4,10),(6,'Samsung1355',464,200,118,'2016-08-16 00:00:00','2016-11-18 09:38:36','2016-11-18 09:38:36',2,7),(7,'Samsung8691',473,200,294,'2016-03-01 00:00:00','2016-11-18 09:38:36','2016-11-18 09:38:36',2,3),(8,'Samsung9521',954,200,152,'2016-07-14 00:00:00','2016-11-18 09:38:36','2016-11-18 09:38:36',2,4),(9,'Samsung780',204,200,259,'2016-02-11 00:00:00','2016-11-18 09:38:36','2016-11-18 09:38:36',1,1),(10,'Samsung5361',546,200,182,'2016-09-28 00:00:00','2016-11-18 09:38:36','2016-11-18 09:38:36',2,4),(11,'Samsung5074',381,200,219,'2016-04-06 00:00:00','2016-11-18 09:38:36','2016-11-18 09:38:36',3,5),(12,'Samsung1126',937,200,271,'2016-10-09 00:00:00','2016-11-18 09:38:36','2016-11-18 09:38:36',2,6),(13,'Samsung7861',257,200,196,'2016-08-10 00:00:00','2016-11-18 09:38:36','2016-11-18 09:38:36',1,1),(14,'Samsung7424',882,200,290,'2016-07-18 00:00:00','2016-11-18 09:38:36','2016-11-18 09:38:36',4,3),(15,'Samsung9860',260,200,263,'2016-05-10 00:00:00','2016-11-18 09:38:36','2016-11-18 09:38:36',1,7),(16,'Samsung5877',885,200,185,'2016-10-28 00:00:00','2016-11-18 09:38:36','2016-11-18 09:38:36',4,2),(17,'Samsung1515',395,200,271,'2016-10-02 00:00:00','2016-11-18 09:38:36','2016-11-18 09:38:36',5,4),(18,'Samsung204',692,200,151,'2016-07-28 00:00:00','2016-11-18 09:38:36','2016-11-18 09:38:36',5,3),(19,'Samsung6259',355,200,166,'2016-05-19 00:00:00','2016-11-18 09:38:37','2016-11-18 09:38:37',2,10),(20,'Samsung6579',527,200,272,'2016-05-19 00:00:00','2016-11-18 09:38:37','2016-11-18 09:38:37',5,9),(21,'The North Face Jacket',85000,40,0,'2016-11-29 00:00:00','2016-11-18 19:55:53','2016-11-18 19:55:53',2,10),(22,'Camel Hiking Stick',12000,50,0,'2016-12-19 00:00:00','2016-11-18 19:56:41','2016-11-18 19:56:41',2,5),(24,'Lehone Kitchen Slice',10000,50,0,'2016-11-28 00:00:00','2016-11-18 19:59:16','2016-11-18 19:59:16',3,5),(29,'Yi Action Camera',50000,80,0,'2017-01-19 00:00:00','2016-11-18 20:04:02','2016-11-18 20:05:13',1,6),(30,'VoKoLa Blazer',200000,50,0,'2017-01-19 00:00:00','2016-11-18 20:14:53','2016-11-18 20:14:53',4,10),(31,'ManTop Hoodie',10000,20,0,'2017-01-10 00:00:00','2016-11-18 20:15:36','2016-11-18 20:15:36',4,5),(32,'Hizaki 3D Printer',200000,50,0,'2017-01-20 00:00:00','2016-11-18 20:16:26','2016-11-18 20:16:26',1,8),(33,'Mi Note 3',150000,40,0,'2017-01-08 00:00:00','2016-11-18 20:17:00','2016-11-18 20:17:00',1,4),(34,'Pategonia Hiking Jacket',10000,100,0,'2017-01-19 00:00:00','2016-11-18 20:18:28','2016-11-18 20:20:09',2,7),(35,'Lezaka Headphone',30000,50,0,'2017-01-19 00:00:00','2016-11-18 20:19:31','2016-11-18 20:19:31',1,9);";

        if (mysqli_query($conn, $sql)) {
            echo "products record created successfully <br/>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        $sql = "INSERT INTO `staffs` VALUES (1,'Min San','min@gmail.com','password','2016-11-18 09:38:51','2016-11-18 09:38:51'),(2,'Mariam Bogan','brau@example.net','password','2016-11-18 09:38:51','2016-11-18 09:38:51'),(3,'Royce Keebler','stevie.corwin@example.net','password','2016-11-18 09:38:51','2016-11-18 09:38:51'),(4,'Eleanora Schulist','bins.sarai@example.org','password','2016-11-18 09:38:51','2016-11-18 09:38:51'),(5,'Dr. Jeremie Zieme Sr.','btromp@example.org','password','2016-11-18 09:38:51','2016-11-18 09:38:51'),(6,'Tabitha Abernathy','noemy.considine@example.org','password','2016-11-18 09:38:51','2016-11-18 09:38:51'),(7,'Ruben Botsford','lauryn.leannon@example.net','password','2016-11-18 09:38:51','2016-11-18 09:38:51'),(8,'Carolyne Ebert','wnicolas@example.com','password','2016-11-18 09:38:51','2016-11-18 09:38:51'),(9,'Dr. Bryon Grant Sr.','mtillman@example.com','password','2016-11-18 09:38:51','2016-11-18 09:38:51'),(10,'Rosemary O\'Hara','shanahan.trever@example.org','password','2016-11-18 09:38:51','2016-11-18 09:38:51'),(11,'Maximillian Morar','funk.eduardo@example.org','password','2016-11-18 09:38:51','2016-11-18 09:38:51');";

        if (mysqli_query($conn, $sql)) {
            echo "staffs record created successfully <br/>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        $sql = "INSERT INTO `photos` VALUES (1,'img/650x450.png',1,'img/100x100.png',1,'2016-11-18 09:38:37','2016-11-18 09:38:37'),(2,'img/650x450.png',0,'img/100x100.png',1,'2016-11-18 09:38:37','2016-11-18 09:38:37'),(3,'img/650x450.png',0,'img/100x100.png',1,'2016-11-18 09:38:37','2016-11-18 09:38:37'),(4,'img/650x450.png',0,'img/100x100.png',1,'2016-11-18 09:38:37','2016-11-18 09:38:37'),(5,'img/650x450.png',1,'img/100x100.png',2,'2016-11-18 09:38:37','2016-11-18 09:38:37'),(6,'img/650x450.png',0,'img/100x100.png',2,'2016-11-18 09:38:37','2016-11-18 09:38:37'),(7,'img/650x450.png',0,'img/100x100.png',2,'2016-11-18 09:38:37','2016-11-18 09:38:37'),(8,'img/650x450.png',0,'img/100x100.png',2,'2016-11-18 09:38:37','2016-11-18 09:38:37'),(9,'img/650x450.png',1,'img/100x100.png',3,'2016-11-18 09:38:37','2016-11-18 09:38:37'),(10,'img/650x450.png',0,'img/100x100.png',3,'2016-11-18 09:38:38','2016-11-18 09:38:38'),(11,'img/650x450.png',0,'img/100x100.png',3,'2016-11-18 09:38:38','2016-11-18 09:38:38'),(12,'img/650x450.png',0,'img/100x100.png',3,'2016-11-18 09:38:38','2016-11-18 09:38:38'),(13,'img/650x450.png',1,'img/100x100.png',4,'2016-11-18 09:38:38','2016-11-18 09:38:38'),(14,'img/650x450.png',0,'img/100x100.png',4,'2016-11-18 09:38:38','2016-11-18 09:38:38'),(15,'img/650x450.png',0,'img/100x100.png',4,'2016-11-18 09:38:38','2016-11-18 09:38:38'),(16,'img/650x450.png',0,'img/100x100.png',4,'2016-11-18 09:38:38','2016-11-18 09:38:38'),(17,'img/650x450.png',1,'img/100x100.png',5,'2016-11-18 09:38:38','2016-11-18 09:38:38'),(18,'img/650x450.png',0,'img/100x100.png',5,'2016-11-18 09:38:38','2016-11-18 09:38:38'),(19,'img/650x450.png',0,'img/100x100.png',5,'2016-11-18 09:38:38','2016-11-18 09:38:38'),(20,'img/650x450.png',0,'img/100x100.png',5,'2016-11-18 09:38:38','2016-11-18 09:38:38'),(21,'img/650x450.png',1,'img/100x100.png',6,'2016-11-18 09:38:38','2016-11-18 09:38:38'),(22,'img/650x450.png',0,'img/100x100.png',6,'2016-11-18 09:38:38','2016-11-18 09:38:38'),(23,'img/650x450.png',0,'img/100x100.png',6,'2016-11-18 09:38:38','2016-11-18 09:38:38'),(24,'img/650x450.png',0,'img/100x100.png',6,'2016-11-18 09:38:38','2016-11-18 09:38:38'),(25,'img/650x450.png',1,'img/100x100.png',7,'2016-11-18 09:38:39','2016-11-18 09:38:39'),(26,'img/650x450.png',0,'img/100x100.png',7,'2016-11-18 09:38:39','2016-11-18 09:38:39'),(27,'img/650x450.png',0,'img/100x100.png',7,'2016-11-18 09:38:39','2016-11-18 09:38:39'),(28,'img/650x450.png',0,'img/100x100.png',7,'2016-11-18 09:38:39','2016-11-18 09:38:39'),(29,'img/650x450.png',1,'img/100x100.png',8,'2016-11-18 09:38:39','2016-11-18 09:38:39'),(30,'img/650x450.png',0,'img/100x100.png',8,'2016-11-18 09:38:39','2016-11-18 09:38:39'),(31,'img/650x450.png',0,'img/100x100.png',8,'2016-11-18 09:38:39','2016-11-18 09:38:39'),(32,'img/650x450.png',0,'img/100x100.png',8,'2016-11-18 09:38:39','2016-11-18 09:38:39'),(33,'img/650x450.png',1,'img/100x100.png',9,'2016-11-18 09:38:39','2016-11-18 09:38:39'),(34,'img/650x450.png',0,'img/100x100.png',9,'2016-11-18 09:38:39','2016-11-18 09:38:39'),(35,'img/650x450.png',0,'img/100x100.png',9,'2016-11-18 09:38:39','2016-11-18 09:38:39'),(36,'img/650x450.png',0,'img/100x100.png',9,'2016-11-18 09:38:39','2016-11-18 09:38:39'),(37,'img/650x450.png',1,'img/100x100.png',10,'2016-11-18 09:38:39','2016-11-18 09:38:39'),(38,'img/650x450.png',0,'img/100x100.png',10,'2016-11-18 09:38:39','2016-11-18 09:38:39'),(39,'img/650x450.png',0,'img/100x100.png',10,'2016-11-18 09:38:40','2016-11-18 09:38:40'),(40,'img/650x450.png',0,'img/100x100.png',10,'2016-11-18 09:38:40','2016-11-18 09:38:40'),(41,'img/650x450.png',1,'img/100x100.png',11,'2016-11-18 09:38:40','2016-11-18 09:38:40'),(42,'img/650x450.png',0,'img/100x100.png',11,'2016-11-18 09:38:40','2016-11-18 09:38:40'),(43,'img/650x450.png',0,'img/100x100.png',11,'2016-11-18 09:38:40','2016-11-18 09:38:40'),(44,'img/650x450.png',0,'img/100x100.png',11,'2016-11-18 09:38:40','2016-11-18 09:38:40'),(45,'img/650x450.png',1,'img/100x100.png',12,'2016-11-18 09:38:40','2016-11-18 09:38:40'),(46,'img/650x450.png',0,'img/100x100.png',12,'2016-11-18 09:38:40','2016-11-18 09:38:40'),(47,'img/650x450.png',0,'img/100x100.png',12,'2016-11-18 09:38:40','2016-11-18 09:38:40'),(48,'img/650x450.png',0,'img/100x100.png',12,'2016-11-18 09:38:40','2016-11-18 09:38:40'),(49,'img/650x450.png',1,'img/100x100.png',13,'2016-11-18 09:38:40','2016-11-18 09:38:40'),(50,'img/650x450.png',0,'img/100x100.png',13,'2016-11-18 09:38:40','2016-11-18 09:38:40'),(51,'img/650x450.png',0,'img/100x100.png',13,'2016-11-18 09:38:40','2016-11-18 09:38:40'),(52,'img/650x450.png',0,'img/100x100.png',13,'2016-11-18 09:38:40','2016-11-18 09:38:40'),(53,'img/650x450.png',1,'img/100x100.png',14,'2016-11-18 09:38:41','2016-11-18 09:38:41'),(54,'img/650x450.png',0,'img/100x100.png',14,'2016-11-18 09:38:41','2016-11-18 09:38:41'),(55,'img/650x450.png',0,'img/100x100.png',14,'2016-11-18 09:38:41','2016-11-18 09:38:41'),(56,'img/650x450.png',0,'img/100x100.png',14,'2016-11-18 09:38:41','2016-11-18 09:38:41'),(57,'img/650x450.png',1,'img/100x100.png',15,'2016-11-18 09:38:41','2016-11-18 09:38:41'),(58,'img/650x450.png',0,'img/100x100.png',15,'2016-11-18 09:38:41','2016-11-18 09:38:41'),(59,'img/650x450.png',0,'img/100x100.png',15,'2016-11-18 09:38:41','2016-11-18 09:38:41'),(60,'img/650x450.png',0,'img/100x100.png',15,'2016-11-18 09:38:41','2016-11-18 09:38:41'),(61,'img/650x450.png',1,'img/100x100.png',16,'2016-11-18 09:38:41','2016-11-18 09:38:41'),(62,'img/650x450.png',0,'img/100x100.png',16,'2016-11-18 09:38:41','2016-11-18 09:38:41'),(63,'img/650x450.png',0,'img/100x100.png',16,'2016-11-18 09:38:41','2016-11-18 09:38:41'),(64,'img/650x450.png',0,'img/100x100.png',16,'2016-11-18 09:38:41','2016-11-18 09:38:41'),(65,'img/650x450.png',1,'img/100x100.png',17,'2016-11-18 09:38:41','2016-11-18 09:38:41'),(66,'img/650x450.png',0,'img/100x100.png',17,'2016-11-18 09:38:41','2016-11-18 09:38:41'),(67,'img/650x450.png',0,'img/100x100.png',17,'2016-11-18 09:38:41','2016-11-18 09:38:41'),(68,'img/650x450.png',0,'img/100x100.png',17,'2016-11-18 09:38:42','2016-11-18 09:38:42'),(69,'img/650x450.png',1,'img/100x100.png',18,'2016-11-18 09:38:42','2016-11-18 09:38:42'),(70,'img/650x450.png',0,'img/100x100.png',18,'2016-11-18 09:38:42','2016-11-18 09:38:42'),(71,'img/650x450.png',0,'img/100x100.png',18,'2016-11-18 09:38:42','2016-11-18 09:38:42'),(72,'img/650x450.png',0,'img/100x100.png',18,'2016-11-18 09:38:42','2016-11-18 09:38:42'),(73,'img/650x450.png',1,'img/100x100.png',19,'2016-11-18 09:38:42','2016-11-18 09:38:42'),(74,'img/650x450.png',0,'img/100x100.png',19,'2016-11-18 09:38:42','2016-11-18 09:38:42'),(75,'img/650x450.png',0,'img/100x100.png',19,'2016-11-18 09:38:42','2016-11-18 09:38:42'),(76,'img/650x450.png',0,'img/100x100.png',19,'2016-11-18 09:38:43','2016-11-18 09:38:43'),(77,'img/650x450.png',1,'img/100x100.png',20,'2016-11-18 09:38:43','2016-11-18 09:38:43'),(78,'img/650x450.png',0,'img/100x100.png',20,'2016-11-18 09:38:43','2016-11-18 09:38:43'),(79,'img/650x450.png',0,'img/100x100.png',20,'2016-11-18 09:38:43','2016-11-18 09:38:43'),(80,'img/650x450.png',0,'img/100x100.png',20,'2016-11-18 09:38:43','2016-11-18 09:38:43'),(81,'product/photos/1479522362TB1Le85LXXXXXaLXVXXXXXXXXXX_!!0-item_pic.jpg_430x430q90-min.jpg',1,'product/photos/tn-1479522362TB1Le85LXXXXXaLXVXXXXXXXXXX_!!0-item_pic.jpg_430x430q90-min.jpg',21,'2016-11-18 19:56:02','2016-11-18 19:56:02'),(82,'product/photos/1479522370TB2lsn7aBzA11Bjy0FbXXcRXVXa_!!928417138-min.jpg',0,'',21,'2016-11-18 19:56:10','2016-11-18 19:56:10'),(83,'product/photos/1479522370TB2GRkSbunAQeBjSZFGXXazoFXa_!!928417138-min.jpg',0,'',21,'2016-11-18 19:56:10','2016-11-18 19:56:10'),(84,'product/photos/1479522405TB1KS.NJpXXXXaVXFXXXXXXXXXX_!!0-item_pic.jpg_430x430q90-min.jpg',1,'product/photos/tn-1479522405TB1KS.NJpXXXXaVXFXXXXXXXXXX_!!0-item_pic.jpg_430x430q90-min.jpg',22,'2016-11-18 19:56:45','2016-11-18 19:56:45'),(85,'product/photos/1479522421TB2OlrmgXXXXXc9XXXXXXXXXXXX_!!676872413-min.jpg',0,'',22,'2016-11-18 19:57:01','2016-11-18 19:57:01'),(86,'product/photos/1479522421TB2RsHqgXXXXXcJXXXXXXXXXXXX_!!676872413-min.jpg',0,'',22,'2016-11-18 19:57:01','2016-11-18 19:57:01'),(87,'product/photos/1479522421TB25rcdnXXXXXceXpXXXXXXXXXX_!!676872413-min.jpg',0,'',22,'2016-11-18 19:57:01','2016-11-18 19:57:01'),(88,'product/photos/1479522421TB220wEnXXXXXbUXXXXXXXXXXXX_!!676872413-min.jpg',0,'',22,'2016-11-18 19:57:01','2016-11-18 19:57:01'),(93,'product/photos/1479522560kitchen-min.jpg',1,'product/photos/tn-1479522560kitchen-min.jpg',24,'2016-11-18 19:59:20','2016-11-18 19:59:20'),(94,'product/photos/1479522568kitchen1-min.jpg',0,'',24,'2016-11-18 19:59:28','2016-11-18 19:59:28'),(95,'product/photos/1479522568kitchen2-min.jpg',0,'',24,'2016-11-18 19:59:28','2016-11-18 19:59:28'),(96,'product/photos/1479522569kitchen3-min.jpg',0,'',24,'2016-11-18 19:59:29','2016-11-18 19:59:29'),(112,'product/photos/1479522852YiCamera-min.jpg',1,'product/photos/tn-1479522852YiCamera-min.jpg',29,'2016-11-18 20:04:12','2016-11-18 20:04:12'),(113,'product/photos/1479522858YiCamera1-min.jpg',0,'',29,'2016-11-18 20:04:18','2016-11-18 20:04:18'),(114,'product/photos/1479522858YiCamera2-min.jpg',0,'',29,'2016-11-18 20:04:18','2016-11-18 20:04:18'),(115,'product/photos/1479522858YiCamera3-min.jpg',0,'',29,'2016-11-18 20:04:18','2016-11-18 20:04:18'),(116,'product/photos/1479523502blazer-min.jpg',1,'product/photos/tn-1479523502blazer-min.jpg',30,'2016-11-18 20:15:02','2016-11-18 20:15:02'),(117,'product/photos/1479523507blazer1-min.jpg',0,'',30,'2016-11-18 20:15:07','2016-11-18 20:15:07'),(118,'product/photos/1479523507blazer2-min.jpg',0,'',30,'2016-11-18 20:15:07','2016-11-18 20:15:07'),(119,'product/photos/1479523549hoodie-min.jpg',1,'product/photos/tn-1479523549hoodie-min.jpg',31,'2016-11-18 20:15:49','2016-11-18 20:15:49'),(120,'product/photos/1479523557hoodie2-min.jpg',0,'',31,'2016-11-18 20:15:57','2016-11-18 20:15:57'),(121,'product/photos/1479523557hoodie4-min.jpg',0,'',31,'2016-11-18 20:15:57','2016-11-18 20:15:57'),(122,'product/photos/14795235903DPrinter-min.jpg',1,'product/photos/tn-14795235903DPrinter-min.jpg',32,'2016-11-18 20:16:30','2016-11-18 20:16:30'),(123,'product/photos/14795235953DPrinter1-min.jpg',0,'',32,'2016-11-18 20:16:35','2016-11-18 20:16:35'),(124,'product/photos/14795235953DPrinter2-min.jpg',0,'',32,'2016-11-18 20:16:35','2016-11-18 20:16:35'),(125,'product/photos/14795235953DPrinter4-min.jpg',0,'',32,'2016-11-18 20:16:35','2016-11-18 20:16:35'),(126,'product/photos/1479523658xiaomi-min.jpg',1,'product/photos/tn-1479523658xiaomi-min.jpg',33,'2016-11-18 20:17:38','2016-11-18 20:17:38'),(127,'product/photos/1479523664xiaomi1-min.jpg',0,'',33,'2016-11-18 20:17:44','2016-11-18 20:17:44'),(128,'product/photos/1479523664xiaomi2-min.jpg',0,'',33,'2016-11-18 20:17:44','2016-11-18 20:17:44'),(129,'product/photos/1479523664xiaomi3-min.jpg',0,'',33,'2016-11-18 20:17:44','2016-11-18 20:17:44'),(130,'product/photos/1479523664xiaomi4-min.jpg',0,'',33,'2016-11-18 20:17:44','2016-11-18 20:17:44'),(131,'product/photos/1479523721hikingjacker-min.jpg',1,'product/photos/tn-1479523721hikingjacker-min.jpg',34,'2016-11-18 20:18:41','2016-11-18 20:18:41'),(132,'product/photos/1479523726hikingjacker3-min.jpg',0,'',34,'2016-11-18 20:18:46','2016-11-18 20:18:46'),(133,'product/photos/1479523726HikingJacker1.jpg-min.jpg',0,'',34,'2016-11-18 20:18:46','2016-11-18 20:18:46'),(134,'product/photos/1479523726HikingJacker2-min.jpg',0,'',34,'2016-11-18 20:18:46','2016-11-18 20:18:46'),(135,'product/photos/1479523779earphone-min.jpg',1,'product/photos/tn-1479523779earphone-min.jpg',35,'2016-11-18 20:19:39','2016-11-18 20:19:40'),(136,'product/photos/1479523783earphone1-min.jpg',0,'',35,'2016-11-18 20:19:43','2016-11-18 20:19:43'),(137,'product/photos/1479523784earphone2-min.jpg',0,'',35,'2016-11-18 20:19:44','2016-11-18 20:19:44'),(138,'product/photos/1479523784earphone3-min.jpg',0,'',35,'2016-11-18 20:19:44','2016-11-18 20:19:44');";

        if (mysqli_query($conn, $sql)) {
            echo "photos record created successfully <br/>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        $sql = 'INSERT INTO users VALUES (1,"Min San","min@gmail.com","$2y$10$bJwVRRjsl6x27jOZWMgNF.D9FTcLmzmA6EUlhavaXeheVrwuex.K6","1969 Boyle Mills","w47HpMzDlV","2016-11-18 09:38:30","2016-11-18 09:38:30"),(2,"Eldred Harris","erika96@example.org","$2y$10$Hr2fmC5AjtbkeTLWunKTOuOp/XsSRGhULvjHIgAXxGpR3PzLM90ai","43517 Abernathy Valley Suite 718","riwEdimM4H","2016-11-18 09:38:33","2016-11-18 09:38:33"),(3,"Dolly Pagac","phagenes@example.org","$2y$10$eosubtDIE8h9hN7XhLTWhOgZgsV8kqFKAHlWnRwOzj/voYhH639AO","723 Angelita Center Suite 397","jtTCVzhgPH","2016-11-18 09:38:33","2016-11-18 09:38:33"),(4,"Ms. Virgie Trantow","laurie.hackett@example.org","$2y$10$KNxcQNvYpP3KQaa4lyjavujsncftSOnmj1MBheofQ31ZZWAmWX/A.","262 Gene Forks","YegkLab2X5","2016-11-18 09:38:34","2016-11-18 09:38:34"),(5,"Dr. Brooklyn Padberg","henry26@example.com","$2y$10$/A7hhJqbjkMF9bH8/jQnDeyZEtHQyWLxzciweJt2vcMXEvFDELLlu","309 Rosamond Flats Apt. 976","A9YBAMirKv","2016-11-18 09:38:34","2016-11-18 09:38:34"),(6,"Dr. Isadore Grant V","goldner.caroline@example.com","$2y$10$Dx5Ymk489HFCfWQrLVtNKOD65HpbOoChOem2cNsqG0YlHZWQpQa.u","788 Geovany Parkways","hUK3YqRmbS","2016-11-18 09:38:34","2016-11-18 09:38:34"),(7,"Olen Dibbert DVM","mitchell.alberta@example.com","$2y$10$AWp2mXK0EBKCCIpFgH0dFOBOLAbrONqTlkMXo9MAORTsj/73QYGXO","83523 Howell Cliffs","NO7rVNxO5J","2016-11-18 09:38:34","2016-11-18 09:38:34"),(8,"Prof. Tom Feest II","baumbach.kaden@example.org","$2y$10$qteiXFOAK/QH2E7bXFSjsefG.9yXGwZMFYNAoa2GTOBwQWqnn/1Te","161 Adela Loop","G7IdXGiM3Q","2016-11-18 09:38:34","2016-11-18 09:38:34"),(9,"Eriberto Macejkovic I","scarlett66@example.com","$2y$10$1u3L11unNfY.9ogERecXceCBazWuBFPa8y7N1QFBTCEw9PTMAUKTa","118 Kreiger Spurs","YHJARCx6bg","2016-11-18 09:38:34","2016-11-18 09:38:34"),(10,"Brent Bechtelar","mmraz@example.org","$2y$10$RKqdMtA.86tP.j4LEsZbmerhlip2VviGSRJkGlVuAnfYcq3Aq12LK","49201 Olson Island Apt. 505","5vZzj3FE7s","2016-11-18 09:38:34","2016-11-18 09:38:34"),(11,"Mr. Brandon Olson IV","emmanuelle.marquardt@example.com","$2y$10$BDPtGgI656b5ZOSGEx34POWhcIKxhxv94jYUC96n/GRPaZHlq0BNO","850 Kuhn Locks Suite 061","MyfqgKeRRs","2016-11-18 09:38:34","2016-11-18 09:38:34");';

        if (mysqli_query($conn, $sql)) {
            echo "users created successfully <br/>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        $sql = "INSERT INTO `orders` VALUES 
        (1,0,'2016-11-18 09:38:43','2016-11-18 09:38:43',9,0),
        (2,0,'2016-11-18 09:38:43','2016-11-18 09:38:43',8,0),
        (3,0,'2016-11-18 09:38:43','2016-11-18 09:38:43',10,0),
        (4,0,'2016-11-18 09:38:43','2016-11-18 09:38:43',5,0),
        (5,0,'2016-11-18 09:38:43','2016-11-18 09:38:43',5,0),
        (6,0,'2016-11-18 09:38:43','2016-11-18 09:38:43',10,0),
        (7,0,'2016-11-18 09:38:44','2016-11-18 09:38:44',7,0),
        (8,0,'2016-11-18 09:38:44','2016-11-18 09:38:44',9,0),
        (9,0,'2016-11-18 09:38:44','2016-11-18 09:38:44',4,0),
        (10,0,'2016-11-18 09:38:44','2016-11-18 09:38:44',7,0),
        (11,0,'2016-11-18 09:38:44','2016-11-18 09:38:44',5,0),
        (12,0,'2016-11-18 09:38:44','2016-11-18 09:38:44',2,0),
        (13,0,'2016-11-18 09:38:44','2016-11-18 09:38:44',4,0),
        (14,0,'2016-11-18 09:38:44','2016-11-18 09:38:44',10,0),
        (15,0,'2016-11-18 09:38:44','2016-11-18 09:38:44',9,0),
        (16,0,'2016-11-18 09:38:44','2016-11-18 09:38:44',7,0),
        (17,0,'2016-11-18 09:38:44','2016-11-18 09:38:44',10,0),
        (18,0,'2016-11-18 09:38:44','2016-11-18 09:38:44',7,0),
        (19,0,'2016-11-18 09:38:44','2016-11-18 09:38:44',2,0),
        (20,0,'2016-11-18 09:38:44','2016-11-18 09:38:44',6,0);";

        if (mysqli_query($conn, $sql)) {
            echo "orders created successfully <br/>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }


        $sql = "INSERT INTO `order_details` VALUES (5,1,1,'2016-11-18 09:38:45','2016-11-18 09:38:45'),(9,2,1,'2016-11-18 09:38:45','2016-11-18 09:38:45'),(19,3,1,'2016-11-18 09:38:46','2016-11-18 09:38:46'),(11,4,1,'2016-11-18 09:38:46','2016-11-18 09:38:46'),(10,5,1,'2016-11-18 09:38:46','2016-11-18 09:38:46'),(7,6,1,'2016-11-18 09:38:47','2016-11-18 09:38:47'),(9,7,1,'2016-11-18 09:38:47','2016-11-18 09:38:47'),(12,8,1,'2016-11-18 09:38:47','2016-11-18 09:38:47'),(2,9,1,'2016-11-18 09:38:47','2016-11-18 09:38:47'),(8,10,1,'2016-11-18 09:38:48','2016-11-18 09:38:48'),(1,11,1,'2016-11-18 09:38:48','2016-11-18 09:38:48'),(1,12,1,'2016-11-18 09:38:48','2016-11-18 09:38:48'),(10,13,1,'2016-11-18 09:38:49','2016-11-18 09:38:49'),(10,14,1,'2016-11-18 09:38:49','2016-11-18 09:38:49'),(8,15,1,'2016-11-18 09:38:49','2016-11-18 09:38:49'),(3,16,1,'2016-11-18 09:38:50','2016-11-18 09:38:50'),(18,17,1,'2016-11-18 09:38:50','2016-11-18 09:38:50'),(5,18,1,'2016-11-18 09:38:50','2016-11-18 09:38:50'),(12,19,1,'2016-11-18 09:38:50','2016-11-18 09:38:50'),(12,20,1,'2016-11-18 09:38:51','2016-11-18 09:38:51');";

        if (mysqli_query($conn, $sql)) {
            echo "order_details record created successfully <br/>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        
        $sql = "INSERT INTO `payments` VALUES (1,0,9,1,'2016-11-18 09:38:44','2016-11-18 09:38:44'),(2,0,8,2,'2016-11-18 09:38:45','2016-11-18 09:38:45'),(3,0,10,3,'2016-11-18 09:38:45','2016-11-18 09:38:45'),(4,0,5,4,'2016-11-18 09:38:46','2016-11-18 09:38:46'),(5,0,5,5,'2016-11-18 09:38:46','2016-11-18 09:38:46'),(6,0,10,6,'2016-11-18 09:38:47','2016-11-18 09:38:47'),(7,0,7,7,'2016-11-18 09:38:47','2016-11-18 09:38:47'),(8,0,9,8,'2016-11-18 09:38:47','2016-11-18 09:38:47'),(9,0,4,9,'2016-11-18 09:38:47','2016-11-18 09:38:47'),(10,0,7,10,'2016-11-18 09:38:48','2016-11-18 09:38:48'),(11,0,5,11,'2016-11-18 09:38:48','2016-11-18 09:38:48'),(12,0,2,12,'2016-11-18 09:38:48','2016-11-18 09:38:48'),(13,0,4,13,'2016-11-18 09:38:49','2016-11-18 09:38:49'),(14,0,10,14,'2016-11-18 09:38:49','2016-11-18 09:38:49'),(15,0,9,15,'2016-11-18 09:38:49','2016-11-18 09:38:49'),(16,0,7,16,'2016-11-18 09:38:49','2016-11-18 09:38:49'),(17,0,10,17,'2016-11-18 09:38:50','2016-11-18 09:38:50'),(18,0,7,18,'2016-11-18 09:38:50','2016-11-18 09:38:50'),(19,0,2,19,'2016-11-18 09:38:50','2016-11-18 09:38:50'),(20,0,6,20,'2016-11-18 09:38:50','2016-11-18 09:38:50');";

        if (mysqli_query($conn, $sql)) {
            echo "payments created successfully <br/>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        $sql = "INSERT INTO `deliveries` (id, ship, arrive, order_id, created_at, updated_at) VALUES 
        (1,0,0,1,'2016-11-18 09:38:45','2016-11-18 09:38:45'),
        (2,0,0,2,'2016-11-18 09:38:45','2016-11-18 09:38:45'),
        (3,0,0,3,'2016-11-18 09:38:46','2016-11-18 09:38:46'),
        (4,0,0,4,'2016-11-18 09:38:46','2016-11-18 09:38:46'),
        (5,0,0,5,'2016-11-18 09:38:46','2016-11-18 09:38:46'),
        (6,0,0,6,'2016-11-18 09:38:47','2016-11-18 09:38:47'),
        (7,0,0,7,'2016-11-18 09:38:47','2016-11-18 09:38:47'),
        (8,0,0, 8,'2016-11-18 09:38:47','2016-11-18 09:38:47'),
        (9,0,0,9,'2016-11-18 09:38:47','2016-11-18 09:38:47'),
        (10,0,0,10,'2016-11-18 09:38:48','2016-11-18 09:38:48'),
        (11,0,0,11,'2016-11-18 09:38:48','2016-11-18 09:38:48'),
        (12,0,0,12,'2016-11-18 09:38:48','2016-11-18 09:38:48'),
        (13,0,0,13,'2016-11-18 09:38:49','2016-11-18 09:38:49'),
        (14,0,0,14,'2016-11-18 09:38:49','2016-11-18 09:38:49'),
        (15,0,0,15,'2016-11-18 09:38:49','2016-11-18 09:38:49'),
        (16,0,0,16,'2016-11-18 09:38:50','2016-11-18 09:38:50'),
        (17,0,0,17,'2016-11-18 09:38:50','2016-11-18 09:38:50'),
        (18,0,0,18,'2016-11-18 09:38:50','2016-11-18 09:38:50'),
        (19,0,0,19,'2016-11-18 09:38:50','2016-11-18 09:38:50'),
        (20,0,0,20,'2016-11-18 09:38:51','2016-11-18 09:38:51');";


        if (mysqli_query($conn, $sql)) {
            echo "delivers created successfully <br/>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        $sql = "INSERT INTO `invoices` VALUES (1,1,'2016-11-18 09:38:45','2016-11-18 09:38:45'),(2,2,'2016-11-18 09:38:45','2016-11-18 09:38:45'),(3,3,'2016-11-18 09:38:46','2016-11-18 09:38:46'),(4,4,'2016-11-18 09:38:46','2016-11-18 09:38:46'),(5,5,'2016-11-18 09:38:46','2016-11-18 09:38:46'),(6,6,'2016-11-18 09:38:47','2016-11-18 09:38:47'),(7,7,'2016-11-18 09:38:47','2016-11-18 09:38:47'),(8,8,'2016-11-18 09:38:47','2016-11-18 09:38:47'),(9,9,'2016-11-18 09:38:48','2016-11-18 09:38:48'),(10,10,'2016-11-18 09:38:48','2016-11-18 09:38:48'),(11,11,'2016-11-18 09:38:48','2016-11-18 09:38:48'),(12,12,'2016-11-18 09:38:48','2016-11-18 09:38:48'),(13,13,'2016-11-18 09:38:49','2016-11-18 09:38:49'),(14,14,'2016-11-18 09:38:49','2016-11-18 09:38:49'),(15,15,'2016-11-18 09:38:49','2016-11-18 09:38:49'),(16,16,'2016-11-18 09:38:50','2016-11-18 09:38:50'),(17,17,'2016-11-18 09:38:50','2016-11-18 09:38:50'),(18,18,'2016-11-18 09:38:50','2016-11-18 09:38:50'),(19,19,'2016-11-18 09:38:50','2016-11-18 09:38:50'),(20,20,'2016-11-18 09:38:51','2016-11-18 09:38:51');";

        if (mysqli_query($conn, $sql)) {
            echo "invoices created successfully <br/>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }


        return view('initdatabase');
    }

    
}

