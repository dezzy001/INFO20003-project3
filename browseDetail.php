<!--
INFO20003 Assignment 3
Name:Derek Chen
Student ID: 766509
browseDetail.php file
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
<h1>Spatula Details</h1>

<!-- Navagation buttons-->
<a href='order.php'><input type='button' class='button' value='Order Page'/></a>
<a href='browse.php'><input type='button' class='button' value='Browse Page'/></a>

<br>



<?php


//select the spatula with the spatula id sent
$sql_string = "SELECT * FROM Spatula";
if (isset( $_GET['idSpatula'])) {
$sql_string = $sql_string . " WHERE idSpatula = ". $_GET['idSpatula'];
}
$result = mysqli_query($con,$sql_string);

echo"<div class='table'>";
echo "<table>";
echo "<tr>";
	echo "<th>Spatula ID</th>";
	echo "<th>Name</th>";
	echo "<th>Type</th>";
	echo "<th>Size</th>";
	echo "<th>Colour</th>";
	echo "<th>Price (\$AU)</th>";
	echo "<th>Quantity currently in stock</th>";
echo "</tr>";

while($row = mysqli_fetch_array($result)) {
echo "<tr>";
	echo "<td>" . $row['idSpatula'] . "</td><td>" 
	. $row['Name'] . "</td><td>"
	. $row['Type'] . "</td><td>"
	. $row['Size'] . "</td><td>"
	. $row['Colour'] . "</td><td>"
	. $row['Price'] . "</td><td>"
	. $row['QuantityInStock'] . "</td>";
echo "</tr>";
}
echo "</table>";
echo"</div>";






mysqli_close($con);
?>

</div>
</body>
</html>

