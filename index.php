<html>
<head>
	<title>Upload CSV File</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

	<?php
	class CSVForm {

		public function __construct() {
		}

		//Function to add uploaded file to server
		public function saveToServer($file, $target) {
			//Will check if file exist.
			if (file_exists($target)) {
				echo "File". $file["name"] ." already exists.";
			}else {
				//Save file to server
				if (move_uploaded_file($file["tmp_name"], $target)) {
					echo "The file ". basename( $file["name"]). " has been uploaded.";
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			}	
		}

		//Function to redirect index page to display page.
		public function redirect($file) {
			header('Location: display.php?fileName='.$file);
		}
	}

	?>
	
	<div class="container">
    <h1></h1>
    <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
		  <label class="control-label col-sm-2">Selected CSV File:</label>
		  <div class="col-sm-10">          
			<input class="form-control" type="file" name="csvFile" id="csvFile">
		  </div>
		</div>
		<div class="form-group">        
		  <div class="col-sm-offset-2 col-sm-10">
			<button class="btn btn-default" type="submit" name="submit">Upload</button>
		  </div>
		</div>
	  </form>
	</div>
    <div class="col-sm-2"></div>
   </div>
   </div>
	

	<?php
	
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["csvFile"]["name"]);
	$myOb = new CSVForm();

	//Will check for response from server
	if(isset($_POST["submit"])) {
		$myOb->saveToServer($_FILES["csvFile"],$target_file);
		$myOb->redirect($_FILES["csvFile"]["name"]);
	}

	
	?>

</body>
</html>