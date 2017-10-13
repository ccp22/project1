<html>
<head>
	<title>CSV Data</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
	class TableDisplay {
		public function __construct() {
		}

		public function generateTable($myfile) {

			//Get columns name
			$file = fopen('uploads/'.$myfile,'r');
			$headings = fgetcsv($file,',');
			echo "<table class=\"table\">";
			echo "<tr>";
			foreach ($headings as $title) {
				echo "<th>".$title."</th>";
			}
			echo "</tr>";
			while(! feof($file))
  			{
  				echo "<tr>";
  				$data = fgetcsv($file);
  				foreach ($data as $value) {
  					echo "<td>".$value."</td>";
  				}
  				echo "</tr>";
  			}
			echo "</table>";
			fclose($file);

		}
	}
	?>
	
	<?php
	if (isset($_GET["fileName"])) {
		$filename = $_GET["fileName"];
		
		$myOb = new TableDisplay();
		$myOb->generateTable($filename);
	}else{
		echo "Nor found!";
	}	
	?>
</body>
</html>
