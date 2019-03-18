<?php 
   require('config/db.php');
   $type = htmlentities($_POST['type']);

      switch($type){

     case "InsertUser":  
        if(isset($_POST['filename'])){
            $name = htmlentities($_POST['filename']);
            $path = htmlentities($_POST['pathname']);
            $data=['filename'=>$name,
                     'pathname'=>$path,
                  'id'=>$id];
          echo json_encode($data);
         }
      
        echo $query1 = "INSERT INTO Test (filename,pathname) VALUES(\"$name\",\"$path\")";
         $reult1 = mysqli_query($conn,$query1);

      //Free Result
      mysqli_free_result($result1);
       
      //Close Connection
      mysqli_close($conn);

               break;
     case "FetchData":
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
               break;
     case "UploadFile":
          
          $PdfUploadFolder = 'files_upload_folder/';
      
          $ServerURL = 'http://ec2-13-126-233-69.ap-south-1.compute.amazonaws.com/website8/full_api.php/'.$PdfUploadFolder; 
           
          $target_dir = "http://ec2-13-126-233-69.ap-south-1.compute.amazonaws.com/website8/full_api.php/files_upload_folder/";
         $target_file_name = $target_dir.basename($_FILES["file"]["name"]);
          $response = array();

          if(isset($_FILES["file"]))
       {
             $file = $_FILES['file'];
             print_r($file);
             $file_name = $_FILES['file']['name'];
             $file_type =  $_FILES['file']['type'];
             $file_size =  $_FILES['file']['size'];
             $file_tem_loc = $_FILES['file']['tmp_name'];
             $file_store = "pdfupload/".$file_name;
             move_uploaded_file($file_tem_loc,$file_store);
            if(move_uploaded_file($_FILES["file"]["tmp_name"],$target_file_name))
                 {
                $success = true;
               $message = "Uploaded!!!";
                   }
             else
               {
                     $success = false;
                      $message = "NOT Uploaded!!! _ Error While Uploading";
                }
           }
           else{
             $success = false;
              $message = "missing field";
               }
                $response["success"] = $success;
                $response["message"] = $message;
                 echo json_encode($response);   
               break;     

            }



        $PdfUploadFolder = 'files_upload_folder/';
      
        $ServerURL = 'http://ec2-13-126-233-69.ap-south-1.compute.amazonaws.com/website8/full_api.php/'.$PdfUploadFolder; 
         
        $target_dir = "http://ec2-13-126-233-69.ap-south-1.compute.amazonaws.com/website8/full_api.php/files_upload_folder/";
       $target_file_name = $target_dir.basename($_FILES["file"]["name"]);
        $response = array();

        if(isset($_FILES["file"]))
     {
           $file = $_FILES['file'];
           print_r($file);
           $file_name = $_FILES['file']['name'];
           $file_type =  $_FILES['file']['type'];
           $file_size =  $_FILES['file']['size'];
           $file_tem_loc = $_FILES['file']['tmp_name'];
           $file_store = "pdfupload/".$file_name;
           move_uploaded_file($file_tem_loc,$file_store);
           print_r($file_name,$file_type,$file_tem_loc,$file_store);
          if(move_uploaded_file($file_tem_loc,$file_store))
               {
              $success = true;
             $message = "Uploaded!!!";
                 }
           else
             {
                   $success = false;
                    $message = "NOT Uploaded!!! _ Error While Uploading";
              }
         }
         else{
           $success = false;
            $message = "missing field";
             }
              $response["success"] = $success;
              $response["message"] = $message;
               echo json_encode($response);   
          

       
       
       
       
       ?>