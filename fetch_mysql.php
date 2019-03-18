<?php 
   require('config/db.php');


   //Create Query
   $query = "SELECT * FROM Test";
  

   //Get Result
   $result = mysqli_query($conn, $query);

   //Fetch Data
   $tests = mysqli_fetch_all($result, MYSQLI_ASSOC);
   var_dump($tests);

   //Free Result
   mysqli_free_result($result);

   //Close Connection
   mysqli_close($conn);
?>