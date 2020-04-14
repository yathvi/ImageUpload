<?php
	if(isset($_FILES['image'])){
		$file_name = $_FILES['image']['name'];   
		$temp_file_location = $_FILES['image']['tmp_name']; 

		require 'vendor/autoload.php';

		$s3 = new Aws\S3\S3Client([
			'region'  => 'us-west-1',
			'version' => 'latest',
			'credentials' => [
				'key'    => "AKIAJJVNY2T5HNAWVOPQ",
				'secret' => "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",
			]
		]);		

		$result = $s3->putObject([
			'Bucket' => 'yathvi-image-upload',
			'Key'    => $file_name,
			'SourceFile' => $temp_file_location			
		]);

		var_dump($result);
	}
?>

<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">         
	<input type="file" name="image" />
	<input type="submit"/>
</form>
