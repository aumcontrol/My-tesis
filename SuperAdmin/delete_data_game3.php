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

if (isset($_POST['deletedata1'])) {
  $id = $_POST['delete_hn1'];
  $hn = $_POST['hn_id1'];


  $query1 = "DELETE FROM play_game3_table  WHERE play_id ='$id' ";
  $query_run1 = mysqli_query($conn, $query1);
  header('Location: read_patient?id='.$hn);

}
?>

<?php } ?>