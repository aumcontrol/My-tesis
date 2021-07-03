<?php

session_start();

if (isset($_POST['username'])) {

    include('connection.php');

    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordenc = md5($password);

    $query = "SELECT * FROM user_table WHERE username = '$username' AND password = '$passwordenc'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_array($result);

        $_SESSION['userid'] = $row['id'];
        $_SESSION['user'] = $row['firstname'] . " " . $row['lastname'];
        $_SESSION['userlevel'] = $row['userlevel'];

        if ($_SESSION['userlevel'] == 's') {
            header("Location: SuperAdmin/OverviewSuperAdmin");
        }
        if ($_SESSION['userlevel'] == 'a') {
            header("Location: admin/OverviewAdmin");
        }

        if ($_SESSION['userlevel'] == 'm') {
            header("Location: member/OverviewMember");
        }
    } else {
        echo "<script language='javascript'>";
        echo 'alert("บัญชีผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง");';
        echo 'window.location.replace("index");';
        echo "</script>";
    }
} else {
    header("Location: index");
}
