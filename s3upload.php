<?php
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
	//require '/path/to/vendor/autoload.php';
	require '../../../home/ubuntu/vendor/autoload.php';

	$config = [ 
        's3-access' => [ 
            'key' => 'KEY_ID', 
            'secret' => 'SECRET_KEY_ID', 
            'bucket' => 'zoodifyfilesbucket', 
            'region' => 'ap-south-1', 
            'version' => 'latest', 
            'acl' => 'public-read', 
            'private-acl' => 'private' 
        ] 
    ]; 
	
	if(isset($_FILES['fileToUpload'])){
	// AWS Info
	$file_name = $_FILES['fileToUpload']['name'];   
		$temp_file_location = $_FILES['fileToUpload']['tmp_name']; 
		echo $file_name . $temp_file_location;
	// Connect to AWS
	$file = $_FILES['fileToUpload'];
	print_r($file);

	$s3 = new Aws\S3\S3Client([
		'region'  => 'ap-south-1',
		'version' => 'latest',
		'credentials' => [
			'key'    => "AKIAJYVYIIGGJQHBMDSA",
			'secret' => "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",
		]
	]);	
	
	//print_r($s3);

	$result = $s3->putObject([
		'Bucket' => 'zoodifyfilesbucket',
		'Key'    => $file_name,
		'SourceFile' => $temp_file_location,
		'ACL' => $config['s3-access']['acl'] 	//gives public read access to file		
	]);

	var_dump($result);
    print_r($result);
}
	
?>

