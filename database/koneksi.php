<?php

/**
 *	File config / koneksi untuk menghubungkan database
 */

$databaseHost = 'localhost';
$databaseName = 'web_inven';
$databaseUsername = 'root';
$databasePassword = '';

$db = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

if (!$db) {
	die('Gagal menghubungkan ke database: ' . mysqli_connect_error());
}
