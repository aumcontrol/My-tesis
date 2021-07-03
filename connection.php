<?php 

$conn = mysqli_connect('localhost', 'root', '', 'projectjop');

    if (!$conn) {
        die("ไม่สามารถเชื่อต่อกับฐานข้อมูลได้ " . mysqli_error($conn));
    }

?>