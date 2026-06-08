<?php
$host = 'localhost';
$dbname = 'restaurant_db'; // السمية لي درتي فالـ phpMyAdmin
$username = 'root';        // غالبا root ف الـ local
$password = 'issamcodes2005';            // غالبا خاوي ف الـ local

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // تفعيل الـ Errors باش يلا كان شي غلط يبان لينا فالبلاصة
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $e) {
    die("خطأ في الاتصال بقاعدة البيانات: " . $e->getMessage());
}
?>