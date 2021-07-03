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

    if(isset($_POST['deletedata'])){
        $id = $_POST['delete_hn'];


        $query = "DELETE FROM patient_table  WHERE hn_id='$id' ";
        $query1 = "DELETE FROM play_game2_table  WHERE hn_id='$id' ";
        $query2 = "DELETE FROM play_game3_table  WHERE hn_id='$id' ";
        $query_run = mysqli_query($conn,$query);
        $query_run1 = mysqli_query($conn,$query1);
        $query_run2 = mysqli_query($conn,$query2);

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