<!--
INFO20003 Assignment 3
Name:Derek Chen
Student ID: 766509
orderSubmit.php file
-->

<html>
<head>
<title>Order Submission</title>
<link rel="stylesheet" href="style.css">

<?php
      include_once "db.php";

    ?>
</head>

<body>
<div>
<h1>Order Submission</h1>

<!-- Navagation buttons-->
<a href='order.php'><input type='button' class='button' value='Order Page'/></a>
<a href='browse.php'><input type='button' class='button' value='Browse Page'/></a>

<br>



<?php





//initialise the variables for data that was posted (i.e submitted from the Order page)
$CustomerDetails = $_POST['CustomerDetails'];
$ResponsibleStaffMember = $_POST['ResponsibleStaffMember'];
$Quantity = $_POST['Quantity'];



/*FIRSTLY checks if staff entered a non null, in ResponsibleStaffMember
and CustomerDetails since they're mandatory*/

//boolean to stop all operations if staff member did not fill in forms
$emptyField = false;
if($ResponsibleStaffMember == "" || $CustomerDetails == "" ){
	echo"Order Error: Must fill in Both Responsible Staff Member and Customer Details fields.<br>";
	$emptyField = true;
}


//boolean to stop all operations if staff member did not fill in appropriate forms
if(!$emptyField){
//---------------------Sorting out the quantities (i.e subtract ordered quantity from current quantity)


$i=0;//dummy counting variable

$spatulaQuantityInStock = mysqli_query($con,"SELECT idSpatula,QuantityInStock 
											FROM Spatula 
											WHERE QuantityInStock > 0");
/*initialise an associative array with key as 
idSpatula and value as the quantity*/
$idSpatulaArray = array();
while($row = mysqli_fetch_array($spatulaQuantityInStock)){
	$idSpatulaArray[$row['idSpatula']] = $Quantity[$i];
	$i++;
}

$spatulaQuantityInStock = mysqli_query($con,"SELECT idSpatula,QuantityInStock 
											FROM Spatula 
											WHERE QuantityInStock > 0");

//ensures only one entry is entered into order table

$ensureOneOrderer = false;
$numDiffOrder = 0;//number of different spatula orders

//while loop which reduces the quantity if possible
while($row = mysqli_fetch_array($spatulaQuantityInStock)){
	$currentQuantity = $row['QuantityInStock'];
	$orderQuantity = $idSpatulaArray[$row['idSpatula']];
	$idSpatula = $row['idSpatula'];

	//if staff entered a quantity value
	if($orderQuantity > 0){
		
		//successful order ---------------------------------------------------------
		if($currentQuantity-$orderQuantity >= 0){

			$update_QuantityInStock = mysqli_query($con,
				"UPDATE Spatula 
				SET QuantityInStock = $currentQuantity - $orderQuantity 
				WHERE idSpatula = $idSpatula;");
			
			//insert in Order with one successful purchase
			if($ensureOneOrderer == false){
				$insert_Order = mysqli_query($con,"INSERT INTO `Order` VALUES (DEFAULT,NOW(),
					'$ResponsibleStaffMember','$CustomerDetails');");
				$ensureOneOrderer = true;

				//grab the current primary key value for idOrder as a numeric array
				$sql_string = mysqli_query($con,"SELECT idOrder FROM `Order` ORDER BY idOrder DESC LIMIT 1;");
				$grab_currentidOrderDefault = mysqli_fetch_array($sql_string,MYSQLI_NUM);
				$currentidOrderDefault = $grab_currentidOrderDefault[0];
			}


			//keep track of the different items bought into the insert_OrderLineItem table
			$insert_OrderLineItem = mysqli_query($con,"INSERT INTO OrderLineItem 
														VALUES ($idSpatula,$currentidOrderDefault,$orderQuantity);");

			echo"Order Successful for Spatula ID = $idSpatula.<br>";
			$numDiffOrder++;

		//if staff entered a greater order quantity than current quantity#######################
		}else{
			echo"Order Error: Cannot order more quantity than the current in stock quantity for Spatula ID = $idSpatula.<br>";
		}

	//if staff entered a negative non valid value################################
	}else if($orderQuantity < 0){
		echo"Order Error: Cannot have negative quantities when ordering for Spatula ID = $idSpatula.<br>";
	}
}
// must have at least one valid entry in quantity
if($numDiffOrder == 0){
	echo"Order Error: Must have at least ONE valid quantity entry.<br>";
}


}//closing braces for the emptyField boolean #######################

mysqli_close($con);
?>

</div>
</body>
</html>

