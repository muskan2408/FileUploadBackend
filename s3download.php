<?php 
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
	//require '/path/to/vendor/autoload.php';
	require '../../../home/ubuntu/vendor/autoload.php';
    $bucket = 'zoodifyfilesbucket';

   // if(isset($_POST['keyfile'])){
    $config = [ 
        's3-access' => [ 
            'key' => 'KEY_ID', 
            'secret' => 'SECRET_KEY', 
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
      
        // print_r($file); 
        // $Downloadlink = $s3->getObjectUrl($config['s3-access']['bucket'], $file['Key']);
		// echo 'Download link would be: ', $Downloadlink, "\n\n"; 
    }
}catch(Exception $ex){ 
	echo "Error Occurred\n", $ex->getMessage(); 
} 

      $data = ['downloadLink' => $Downloadlink];
      echo json_encode($data);
// # lets download our file 
// $file_to_download = 'https://zoodifyfilesbucket.s3.ap-south-1.amazonaws.com/brochure_final.pdf';
// $download_as_path = 'C:\Users\muska\Desktop'; 
 
// # save object to a file 
// $result = $s3->getObject([ 
// 	'Bucket' => $config['s3-access']['bucket'], 
// 	'Key' => $file_to_download, 
// 	'SaveAs' => $download_as_path 
// ]); 

// echo $result;


$file_name = 'brochure_final.pdf';
$file_url = 'https://zoodifyfilesbucket.s3.ap-south-1.amazonaws.com/' . $file_name;
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="' . $file_name . '"');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . filesize($file_url-0000));
header('Accept-Ranges: bytes');
readfile($file_url);
//fpassthru($file_url);
//}
?>
