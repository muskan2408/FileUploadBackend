<?php 
   //Create Connection

      $conn = mysqli_connect('mysql-instance1.cfodycxlzsrb.ap-south-1.rds.amazonaws.com','zoodify','zoodify123','zoodify';

      //Check Connection
      if(mysqli_connect_errno()){

      	echo 'Failed to connect to MYSQL'. mysqli_connect_errno();
      }

?>