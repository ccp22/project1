<html>
<head>
	<title>CSV Data</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
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
	//Check for appropriate parameter by get method.
	if (isset($_GET["fileName"])) {
		$filename = $_GET["fileName"];
		if($filename != "") {
			$myOb = new TableDisplay();
			$myOb->generateTable($filename);
		}else {
			echo "<h1>Filename not valid!</h1>";	
		}
	}else{
		echo "<h1>Invalid request!</h1>";
	}	
	?>
</body>
</html>
