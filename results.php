<!--
INFO20003 Assignment 3
Name:Derek Chen
Student ID: 766509
browse.php file
-->

<html>
<head>
<title>Spatula Details</title>
<link rel="stylesheet" href="style.css">

<?php
      include_once "db.php";

    ?>
</head>

<body>
<div>
<h1>Spatula Results</h1>

<!-- Navagation buttons-->
<a href='order.php'><input type='button' class='button' value='Order Page'/></a>
<a href='browse.php'><input type='button' class='button' value='Browse Page'/></a>
<br>

<?php

//sql query implementing the combination function
if(isset($_POST['Name']) && $_POST['Type'] && $_POST['Size'] && $_POST['Colour'] && $_POST['Price']  ){
	


}

//initialise all the post from browse.php
$Name = $_POST['Name'];
$Type = $_POST['Type'];
$Size = $_POST['Size'];
$Colour = $_POST['Colour'];
$Price = $_POST['Price'];

$sql_string =  "SELECT * FROM Spatula WHERE idSpatula IS NOT NULL".combinationFunc($Name,"Name")
.combinationFunc($Size,"Size").combinationFunc($Type,"Type").combinationFunc($Colour,"Colour")
.combinationFunc($Price,"Price").';';

$result = mysqli_query($con,$sql_string);




//table of results
echo"<h4>Click on spatula name to get its details</h4>";
echo"<div class='table'>";
echo "<table>";
echo "<tr>";
	echo "<th>Spatula Name</th>";
echo "</tr>";

while($row = mysqli_fetch_array($result)) {

echo "<tr>";
	//staff can click on the spatula name to get its details
	echo "<td><a href='browseDetail.php?idSpatula=".$row['idSpatula']."'>". $row['Name'] ."</a></td>";
echo "</tr>";
}

echo "</table>";
echo"</div>";


mysqli_close($con);


// helper functions-===========================

/*Function to produce a combination spatula searches, checks if the field that staff
 entered is non empty to filter out there WHERE Clause*/
 function combinationFunc($column,$columnName){
	if($column == ''){
			return '';
	}else{
		return ' AND '.$columnName.'="'.$column.'"' ;
	}
}

?>

</div>
</body>
</html>

