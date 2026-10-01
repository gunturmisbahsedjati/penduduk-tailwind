<?php
$host = 'db';
$user = 'user_penduduk';
$pass = 'userpassword';
$db   = 'db_penduduk';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
