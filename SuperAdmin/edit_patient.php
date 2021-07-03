<?php

session_start();
include('../connection.php');

if ($_SESSION['userlevel'] == 'm') {
    header("Location: ../index");
}

if ($_SESSION['userlevel'] == 'a') {
    header("Location: ../index");
  }

if (!$_SESSION['userid']) {
    header("Location: ../index");
} else {

?>

<?php

    if(isset($_POST['editdata'])){
        $id = $_POST['hnid'];
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];

        $query = "UPDATE patient_table SET first_name='$fname',last_name='$lname' WHERE hn_id='$id' ";
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
            echo 'alert("ดำเนินการไม่สำเร็จ");';
            echo 'window.location.replace("find_patient");';
            echo "</script>";
        }
    }
?>



<?php } ?>