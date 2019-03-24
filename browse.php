<!--
INFO20003 Assignment 3
Name:Derek Chen
Student ID: 766509
browse.php file
-->

<html>
<head>
<title>Browse</title>
<link rel="stylesheet" href="style.css">

<?php
      include_once "db.php";

    ?>

</head>

<body>
<div>
<h1>Browse Spatulas</h1>

<!-- Navagation buttons-->
<a href='order.php'><input type='button' class='button' value='Order Page'/></a>
<a href='browse.php'><input type='button' class='buttonOnPage' value='Browse Page'/></a>
<br>



<?php



echo "<form method='POST' action='results.php'>";
echo"<h2>Filter Search</h2><h4>(leave fields empty to see all spatulas)</h4><br>";
//all the browsing attributes go here
echo"<div class='browse'>";



echo "Spatula Name: <input type='text' name='Name' /> <br><br><br>";

//for Type: only show existing ones in data base
$result = mysqli_query($con,"SELECT DISTINCT Type FROM Spatula ORDER BY Type");
echo "Type: <select name='Type'>";


echo "<option></option>";

while($row = mysqli_fetch_array($result)) {
	echo "<option value = '".$row['Type']."'>";
	echo$row['Type'];
	echo "</option>";
}
echo "</select><br><br><br>";

echo "Size (in cm): <input type='text' name='Size' /> <br><br><br>";
echo "Colour: <input type='text' name='Colour' /> <br><br><br>";
echo "Price (\$AU): <input type='text' name='Price' /> <br><br><br>";
echo"</div>";

echo "<input type = 'submit' value='Search...'/>";

echo "</form>";

mysqli_close($con);
?>

</div>
</body>
</html>

