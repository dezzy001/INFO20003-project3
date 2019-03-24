<!--
INFO20003 Assignment 3
Name:Derek Chen
Student ID: 766509
order.php file
-->

<html>

<head>
<title>Orders</title>
<link rel="stylesheet" href="style.css">

<?php
      include_once "db.php";

    ?>
</head>
<body>

<div>

<h1>Spatula Orders</h1>
<!-- Navagation buttons-->
<a href='order.php'><input type='button' class='buttonOnPage' value='Order Page'/></a>
<a href='browse.php'><input type='button' class='button' value='Browse Page'/></a>

<br>
<br>
<br>



<?php



//beginning of the form ----------------------------------------------------------------

echo "<form method='POST' action='orderSubmit.php'>";

//Insert customer details
echo "Customer Details:<br>";
echo" <textarea style='width:60%;height:150px;' name='CustomerDetails'></textarea> ";
echo "<br><br>";

//Insert Responsible staff Member
echo "Responsible Staff Member: ";
echo "<input type='text'/ name='ResponsibleStaffMember'> ";
echo "<br><br>";



//Table for attributes of the Spatulas in stock and quantity to order
echo "<table>";
$result_In_Stock = mysqli_query($con,"SELECT * FROM Spatula WHERE QuantityInStock > 0");
echo "<tr>";
	echo "<th>Spatula ID</th>";
	echo "<th>Name</th>";
	echo "<th>Type</th>";
	echo "<th>Size</th>";
	echo "<th>Colour</th>";
	echo "<th>Price (\$AU)</th>";
	echo "<th>Quantity currently in stock</th>";
	echo "<th>Order Quantity</th>";
echo "</tr>";




while($row = mysqli_fetch_array($result_In_Stock)) {

echo "<tr>";
	echo "<td>" . $row['idSpatula'] . "</td><td>" 
	. $row['Name'] . "</td><td>"
	. $row['Type'] . "</td><td>"
	. $row['Size'] . "</td><td>"
	. $row['Colour'] . "</td><td>"
	. $row['Price'] . "</td><td>"
	. $row['QuantityInStock'] . "</td><td>

	<input type='text' value='0' name='Quantity[]'/></td>";
	//quantity[] is stored as an indexed array
echo "</tr>";
}
echo "</table>";


echo "<br>";
echo "<input type = 'submit'/>";

echo "</form>";



mysqli_close($con);
?>

</div>
</body>
</html>

