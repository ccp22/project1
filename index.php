<html>
<head>
	<title>Upload CSV File</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
			header('Location: index.php?page=table&fileName='.$file);
		}
	}

	class TableDisplay {
		public function __construct() {
		}
		
		//Function to generate table to display file data
		public function generateTable($myfile) {
			//Open the uploaded file and get the reference
			$file = fopen('uploads/'.$myfile,'r');
			
			//fetch CVS file and parse first line as a column header.
			$headings = fgetcsv($file,',');
			echo "<table class=\"table\">";
			echo "<tr>";
			//Parse through each column value on single line
			foreach ($headings as $title) {
				echo "<th>".$title."</th>";
			}
			echo "</tr>";
			//Fetch rest of the data line by line
			while(! feof($file))
  			{
  				echo "<tr>";
  				//Fetch each value in a single line/row
  				$data = fgetcsv($file);
  				foreach ($data as $value) {
  					echo "<td>".$value."</td>";
  				}
  				echo "</tr>";
  			}
			echo "</table>";
			
			//Closing the opened file.
			fclose($file);
		}
	}


	?>
	
	<?php
	if(isset($_GET["fileName"])) {
		$filename = $_GET["fileName"];
		if($filename != "") {
			$Ob = new TableDisplay();
			$Ob->generateTable($filename);
		}else {
			echo "<h1>Filename not valid!</h1>";	
		}
	}else {
		echo "<div class=\"container\">";
			echo "<h1></h1>";
			echo "<div class=\"row\">";
				echo "<div class=\"col-sm-1\"></div>";
				echo "<div class=\"col-sm-10\">";
					echo "<form class=\"form-horizontal\" action=\"\" method=\"post\" enctype=\"multipart/form-data\">";
						echo "<div class=\"form-group\">";
							echo "<label class=\"control-label col-sm-2\">Select CSV File:</label>";
							echo "<div class=\"col-sm-10\">";          
								echo "<input class=\"form-control\" type=\"file\" name=\"csvFile\" id=\"csvFile\">";
							echo "</div>";
						echo "</div>";
						echo "<div class=\"form-group\">";        
							echo "<div class=\"col-sm-offset-2 col-sm-10\">";
								echo "<button class=\"btn btn-default\" type=\"submit\" name=\"submit\">Upload</button>";
							echo "</div>";
						echo "</div>";
					echo "</form>";
				echo "</div>";
				echo "<div class=\"col-sm-2\"></div>";
			echo "</div>";
		echo "</div>";
	}
	?>
	

	<?php
	
	//Get directory for uploads.
	$target_dir = "uploads/";
	
	//Make target path for file
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