<?php

// Specify You Database cridentifl here
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "testBulk";

$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE " . $dbname;
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql = "CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
)";



if ($conn->query($sql) === TRUE) {
    echo "Table categories created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE `deliveries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ship` tinyint(1) NOT NULL DEFAULT '0',
  `arrive` tinyint(1) NOT NULL DEFAULT '0',
  `arrival_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `order_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deliveries_order_id_foreign` (`order_id`),
  CONSTRAINT `deliveries_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE)";

if ($conn->query($sql) === TRUE) {
    echo "Table deliveries created successfully";
} else {
    echo "Error creating table: " . $conn->error;
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
    echo "Table invoices created successfully";
} else {
    echo "Error creating table: " . $conn->error;
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
    echo "Table invoices created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
