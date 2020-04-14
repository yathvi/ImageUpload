<!DOCTYPE html>
<html>
<title>Image Upload Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
body,h1 {font-family: "Raleway", sans-serif}
body, html {height: 100%}
.bgimg {
  background-image: url('forestbridge.jpg');
  min-height: 100%;
  background-position: center;
  background-size: cover;
}
</style>
<body>

<?php
// Include the database configuration file
include 'dbConfig.php';
$statusMsg = '';

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
		
		$insert = $db->query("INSERT into images (file_name, uploaded_on) VALUES ('".$file_name."', NOW())");
            if($insert){
                $statusMsg = "The file ".$file_name. " has been uploaded successfully.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 

	} else{
    $statusMsg = 'Please select a file to upload.';
}
?>


<div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
  <div class="w3-display-topleft w3-padding-large w3-xlarge">
    Image Upload
  </div>
  <div class="w3-display-middle">
    <h1 class="w3-large w3-animate-top">
	<?php
		// Display status message
		echo $statusMsg;
	?>
    </h1>
    <hr class="w3-border-grey" style="margin:auto;width:40%">
    <p class="w3-large w3-center">
    	<a href="display.php" style="text-decoration:none">Click here to view Images/Quotes</a>
    </p>
  </div>
  <div class="w3-display-bottomleft w3-padding-large">
    Powered by <a href="http://yathvi.com" target="_blank">Yathvi</a>
  </div>
</div>

</body>
</html>

