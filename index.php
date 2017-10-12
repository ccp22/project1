<html>
<head>
	<title>Upload CSV File</title>
</head>
<body>

	<?php
	class CSVForm {

		public function __construct() {
		}

		public function saveToServer($file, $target) {
			if (file_exists($target)) {
				echo "File". $file["name"] ." already exists.";
			}else {
				if (move_uploaded_file($file["tmp_name"], $target)) {
					echo "The file ". basename( $file["name"]). " has been uploaded.";
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			}	
		}

		public function redirect() {
			header('Location: display.php');
		}
	}

	?>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="csvFile" id="csvFile">
		<input type="submit" value="Upload CSV" name="submit">
	</form>

	<?php
	
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["csvFile"]["name"]);
	$myOb = new CSVForm();
	if(isset($_POST["submit"])) {
		$myOb->saveToServer($_FILES["csvFile"],$target_file);
		$myOb->redirect($_FILES["csvFile"]);
	}

	

	?>

</body>
</html>