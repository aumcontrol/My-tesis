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

if (isset($_POST['deletedata'])) {
  $id = $_POST['delete_hn'];
  $hn = $_POST['hn_id'];


  $query1 = "DELETE FROM play_game2_table  WHERE play_id ='$id' ";
  $query_run1 = mysqli_query($conn, $query1);
  header('Location: read_patient?id='.$hn);

}
?>

<?php } ?>