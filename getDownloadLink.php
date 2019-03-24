<?php

$name = htmlentities('name');

if(isset($_POST['name'])){
    //echo $_GET['email'];
    //print_r($_GET);

      //require '/path/to/vendor/autoload.php';
      require '../../../home/ubuntu/vendor/autoload.php';
        $bucket = 'zoodifyfilesbucket';
    
       // if(isset($_POST['keyfile'])){
        $config = [ 
            's3-access' => [ 
                'key' => 'AKIAJYVYIIGGJQHBMDSA', 
                'secret' => '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', 
                'bucket' => 'zoodifyfilesbucket', 
                'region' => 'ap-south-1', 
                'version' => 'latest', 
                'acl' => 'public-read', 
                'private-acl' => 'private' 
            ] 
        ]; 
         
        # initializing s3 
        $s3 = Aws\S3\S3Client::factory([ 
            'credentials' => [ 
                'key' => $config['s3-access']['key'], 
                'secret' => $config['s3-access']['secret'] 
            ], 
            'version' => $config['s3-access']['version'], 
            'region' => $config['s3-access']['region'] 
        ]); 
    
    # lets list our files on s3 
    try{ 
      # initializing our object 
      $files = $s3->getIterator('ListObjects', [ # this is a Generator Object (its yields data rather than returning) 
        'Bucket' => $config['s3-access']['bucket'] 
      ]); 
     
      # printing our data 
      foreach($files as $file){ 
          
         //   print_r($file); 
            $Downloadlink = $s3->getObjectUrl($config['s3-access']['bucket'], $file['Key']);
       // echo 'Download link would be: ', $Downloadlink, "\n\n"; 
        }
    }catch(Exception $ex){ 
      echo "Error Occurred\n", $ex->getMessage(); 
    } 
    
          $data = ['name' => $Downloadlink];
          echo json_encode($data);
}

?>