<?php

session_start();
include('../connection.php');

if ($_SESSION['userlevel'] == 'm') {
    header("Location: ../index");
}

if ($_SESSION['userlevel'] == 's') {
    header("Location: ../index");
}

if (!$_SESSION['userid']) {
    header("Location: ../index");
} else {

?>

<?php

    if(isset($_POST['insertdata'])){
        $id = $_POST['hnid'];
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];

        $query = "INSERT INTO patient_table(hn_id,first_name,last_name) VALUES('$id','$fname','$lname')";
        $query_run = mysqli_query($conn,$query);

        if($query_run)
        {
            
            echo "<script language='javascript'>";
            echo 'alert("ดำเนินการสำเร็จ");';
            echo 'window.location.replace("find_patient");';
            echo "</script>";
        }
        else{
            echo "<script language='javascript'>";
            echo 'alert("ดำเนินการไม่สำเร็จ เนื่องจากมีรหัสประจำตัวผู้ป่วยรายนี้อยู่แล้ว");';
            echo 'window.location.replace("find_patient");';
            echo "</script>";
        }
    }
?>



<?php } ?>