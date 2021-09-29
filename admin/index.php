<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../view/css/bootstrap.min.css" rel="stylesheet">
<script src="../view/js/jquery.min.js"></script>
<script src="../view/js/bootstrap.min.js"></script>
<style>
	table, th, td {

		font-family: Georgia, 'Times New Roman', Times, serif;
		font-style:italic;
		border: 2px solid black;
		padding: 5px;
	}
		</style>
</head>

<body>
<div align="center">
  <a href="index.php"><h1 class="style2" style="font-family:Georgia, 'Times New Roman', Times, serif">Administrator</h1></a>
  <p>&nbsp;</p>
  <form id="form1" name="form1" method="post" action="">
  	
    <table class="table table-striped table-bordered table-hover table-condensed" style="width: 50%">
      <tr>
        <th><div>Delete Product: </div></th>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <th>
          <input type="text" class="form-control" name="ItemID" placeholder="Enter product ID" />
        </th>
        <td><input class="form-control" name="dltpr" type="submit" id="dltpr" value="Delete Product" /></td>
      </tr>
      <tr>
        <th><div>Delete User: </div></th>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <th><div>
          <input type="text" class="form-control" name="UserID" placeholder="Enter user ID" />
        </div></th>
        <td><input class="form-control" name="dltuser" type="submit" id="dltuser" value="Delete User" /></td>
      </tr>
      <tr>
        <th><div>Bidding time for Product </div></th>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <th><div>
          <label>Product ID:&nbsp; &nbsp; 
          <input type="text" class="form-control" name="prid" placeholder="Enter product ID" style="width: 215px" />
          </label>
          <label>Date &amp; Time:
            <input type="text" class="form-control" name="bidtime" placeholder="YYYY-MM-DD hh:mm:ss" style="width: 305px" />
           </label>
          
        </div></th>
        <td><input class="form-control" name="EndTime" type="submit" id="EndTime" value="Update Time" /></td>
      </tr>
    </table>
  </form>
  <hr>
</div>
<div style="width: 100%">
<?php

$conn = new mysqli("localhost", "root", "", "shop");
if ($conn -> connect_error) {
die("Connection failed:" . $conn -> connect_error);
}

//------------------delete product----------------------

if (isset($_POST['dltpr'])) {
	echo '<div style="width:49%; float:left;"><h2>Product Table</h2>';
	$id=$_REQUEST['ItemID'];
	$sql = "DELETE FROM item WHERE ItemID=$id";
	$conn -> query($sql);
	
	$sql = "SELECT ItemID,ItemName,CategoryID,EndTime FROM item ORDER BY ItemID";
	$result = $conn -> query($sql);
	if ($result -> num_rows > 0) {
	echo '
	<table class="table table-striped table-bordered table-hover table-condensed" align="center" style="width:50%">
	<tr class="info">
	<th>ID</th>
	<th>ItemName</th>
	<th>CategoryID</th>
	<th>EndTime</th>
	</tr>';

	while ($row = $result -> fetch_assoc()) {
	echo "
	<tr>
		<td>" . $row["ItemID"] . "</td><td>" . $row["ItemName"] . "</td><td>" . $row["CategoryID"] . "</td><td>" . $row["EndTime"] . "</td>
	</tr>";
	}

	echo "</table></div>";
	} else {
	echo "0 results";
	}
}

//--------------------delete user----------------------

elseif (isset($_POST['dltuser'])) {
	echo '<div style="width=49%; float:left;"><h2>User Table</h2>';
	$id=$_REQUEST['UserID'];
	$sql = "DELETE FROM user WHERE UserID=$id";
	$result = $conn -> query($sql);
	
	$sql = "SELECT UserID,Username,Password FROM user ORDER BY UserID";
	$result = $conn -> query($sql);
	if ($result -> num_rows > 0) {
	echo '
	<table class="table table-striped table-bordered table-hover table-condensed" align="center" style="width:50%">
	<tr class="info">
	<th>ID</th>
	<th>Username</th>
	<th>Password</th>	
	</tr>';

	while ($row = $result -> fetch_assoc()) {
	echo "
	<tr>
		<td>" . $row["UserID"] . "</td><td>" . $row["Username"] . "</td><td>" . $row["Password"] . "</td>
	</tr>";
	}

	echo "</table></div>";
	} else {
	echo "0 results";
	}
	
}

//-----------------------update bid time------------------------

elseif (isset($_POST['EndTime' ])) {
	echo '<div style="width:49%; float:left;"><h2>Product Table</h2>';
	$id=$_REQUEST['prid'];
	$EndTime=$_REQUEST['bidtime'];	
	
	$sql = "UPDATE item SET EndTime='$EndTime' WHERE ItemID=$id";
	$result = $conn -> query($sql);
	
	$sql = "SELECT ItemID,ItemName,CategoryID,EndTime FROM item ORDER BY ItemID";
	$result = $conn -> query($sql);
	if ($result -> num_rows > 0) {
	echo '
	<table class="table table-striped table-bordered table-hover table-condensed" align="center" style="width:50%">
	<tr class="info">
	<th>ID</th>
	<th>ItemName</th>
	<th>CategoryID</th>
	<th>Bidtime</th>
	</tr>';

	while ($row = $result -> fetch_assoc()) {
	echo "
	<tr>
		<td>" . $row["ItemID"] . "</td><td>" . $row["ItemName"] . "</td><td>" . $row["CategoryID"] . "</td><td>" . $row["EndTime"] . "</td>
	</tr>";
	}

	echo "</table></div>";
	} else {
	echo "0 results";
	}
	}
	
	
else {
	
	//--------------------------product---------------------------
	
	echo '<div style="width:49%; float:left;"><h2>Product Table</h2>';
	$sql = "SELECT ItemID,ItemName,CategoryID,EndTime FROM item ORDER BY ItemID";
	$result = $conn -> query($sql);

	if ($result -> num_rows > 0) {
	echo '
	<table class="table table-striped table-bordered table-hover table-condensed" align="center" style="width:50%">
	<tr class="info">
	<th>ID</th>
	<th>ItemName</th>
	<th>CategoryID</th>
	<th>Bidtime</th>
	</tr>';

	while ($row = $result -> fetch_assoc()) {
	echo "
	<tr>
		<td>" . $row["ItemID"] . "</td><td>" . $row["ItemName"] . "</td><td>" . $row["CategoryID"] . "</td><td>" . $row["EndTime"] . "</td>
	</tr>";
	}

	echo "</table></div>";
	} else {
	echo "0 results";
	}
	
	//------------------user----------------------------
	
	echo '<div style="width:49%; float:left;"><h2>User Table</h2>';
	$sql = "SELECT UserID,Username,Password,Contact_No FROM user ORDER BY UserID";
	$result = $conn -> query($sql);

	if ($result -> num_rows > 0) {
	echo '
	<table class="table table-striped table-bordered table-hover table-condensed" align="center" style="width:50%">
	<tr class="info">
	<th>ID</th>
	<th>Username</th>
	<th>Password</th>
    <th>Contact_No</th>
	</tr>';

	while ($row = $result -> fetch_assoc()) {
	echo "
	<tr>
		<td>" . $row["UserID"] . "</td><td>" . $row["Username"] . "</td><td>" . $row["Password"] . "</td><td>" . $row["Contact_No"] . "</td>
	</tr>";
	}

	echo "</table></div>";
	} else {
	echo "0 results";
	}
	}
    //--------------------Feedback--------------------
   /**/ /*echo '<div style="width:49%; float:left;"><h2>User Table</h2>';
	$sql = "SELECT First FROM user ORDER BY UserID";
	$result = $conn -> query($sql);

	if ($result -> num_rows > 0) {
	echo '
	<table class="table table-striped table-bordered table-hover table-condensed" align="center" style="width:50%">
	<tr class="info">
	<th>ID</th>
	<th>Username</th>
	<th>Password</th>
	</tr>';

	while ($row = $result -> fetch_assoc()) {
	echo "
	<tr>
		<td>" . $row["UserID"] . "</td><td>" . $row["Username"] . "</td><td>" . $row["Password"] . "</td>
	</tr>";
	}

	echo "</table></div>";
	} else {
	echo "0 results";
	}
	}*/
	//------------------bid----------------------------
	
	echo '<div style="width:49%; float:left;"><h2>Bid Table</h2>';
	$sql = "SELECT ItemID,BidderID,BidAmount FROM bids ORDER BY ItemID";
	$result = $conn -> query($sql);

	if ($result -> num_rows > 0) {
	echo '
	<table class="table table-striped table-bordered table-hover table-condensed" align="center" style="width:50%">
	<tr class="info">
	<th>ItemID</th>
	<th>BidderID</th>
	<th>BidAmount</th>
	</tr>';

	while ($row = $result -> fetch_assoc()) {
	echo "
	<tr>
		<td>" . $row["ItemID"] . "</td><td>" . $row["BidderID"] . "</td><td>" . $row["BidAmount"] . "</td>
	</tr>";
	}

	echo "</table></div>";
	} else {
	echo "0 results";
	}
	
?>
</div>
</body>
</html>