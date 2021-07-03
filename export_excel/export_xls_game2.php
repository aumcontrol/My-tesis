<?php

session_start();
include('../connection.php');

if (!$_SESSION['userid']) {
  header("Location: ../index.php");
} else {

?>
<?php 
      $id = $_GET['id'];
          $query = mysqli_query($conn,"SELECT * , DATE_FORMAT(create_at, '%d-%m-%Y %H:%i:%s') AS create_at FROM play_game2_table g  INNER JOIN patient_table p ON g.hn_id = p.hn_id WHERE g.hn_id = $id ORDER BY DATE_FORMAT(create_at, '%Y-%m-%d %H:%i:%s') DESC"); // Get data from Database from  

          $delimiter = ",";
          $filename = "MatchPicture " . date('dmY') . ".csv"; // Create file name
           
          //create a file pointer
          $f = fopen('php://memory', 'w'); 
           
          //set column headers
          $fields = array('Hospital Number', 'Firstname', 'Lastname', 'Score Plus', 
          'Score Sub', 'Time(s)', 'Level', 'Date', 'Status');
          fputcsv($f, $fields, $delimiter);
           
          //output each row of the data, format line as csv and write to file pointer
          while($row = $query->fetch_assoc()){
              $lineData = array($row['hn_id'], $row['first_name'], $row['last_name'],$row['score_game2_plus']
              ,$row['score_game2_sub'],$row['time_game2'],$row['level_id'],$row['create_at'],$row['status_game2']);
              fputcsv($f, $lineData, $delimiter);
          }
           
          //move back to beginning of file
          fseek($f, 0);
           
          //set headers to download file rather than displayed
          header('Content-Type: text/csv');
          header('Content-Disposition: attachment; filename="' . $filename . '";');
           
          //output all remaining data on a file pointer
          fpassthru($f);
          ?>
  
<?php } ?>