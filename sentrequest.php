<?php 
require 'file/connection.php'; 
session_start();
  if(!isset($_SESSION['rid']))
  {
  header('location:login.php');
  }
  else {
    $rid = $_SESSION['rid'];
    $sql = "select bloodrequest.*, hospitals.* from bloodrequest, hospitals where rid='$rid' && bloodrequest.hid=hospitals.id";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<?php $title="Bloodbank | Sent Requests"; ?>
<?php require 'head.php'; ?>
<style>
    body{
    background: url(image/p5.jpg) no-repeat center;
    background-size: cover;
    min-height: 0;
    height: 650px;
  }
.login-form{
    width: calc(100% - 20px);
    max-height: 650px;
    max-width: 450px;
    background-color: white;
}
/* Set table properties */
table {
  border-collapse: collapse;
  border:1px solid black;
  color:black;
  width: 100%;
  border-radius: 5px;
  -moz-border-radius: 5px !important;
  
}

/* Style table headers */
th {
  background-color:  #49c5b6;
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
  width:10%;
  margin-bottom: 10px;
}

/* Style table rows */
tr {
  border: 1px solid #ddd;
  width:10%;
}

/* Add hover effect on table rows */
tr:hover {
  background-color: #D14836;
  color:white;
  transform: scale(1.01);


}
</style>
<body>
	<?php require 'header.php'; ?>
	<div class="container cont">

		<?php require 'message.php'; ?>
<!-- 
	<table class="table table-responsive table-striped rounded mb-5"> -->
	<table bgcolor="#2779a7">	
	<tr><th colspan="8" class="title">Sent requests</th></tr>
		<tr>
			<th>Sr.NO.</th>
			<th>Name</th>
			<th>Email</th>
			<th>City</th>
			<th>Phone</th>
			<th>Blood Group</th>
			<th>Status</th>
			<th>Action</th>
		</tr>

		    <div>
                <?php
                if ($result) {
                    $row =mysqli_num_rows( $result);
                    if ($row) { //echo "<b> Total ".$row." </b>";
                }else echo '<b style="color:white;background-color:red;padding:7px;border-radius: 15px 50px;">You have not requested yet. </b>';
            }
            ?>
            </div>

		<?php while($row = mysqli_fetch_array($result)) { ?>

		<tr>
			<td><?php echo ++$counter;?></td>
			<td><?php echo $row['hname'];?></td>
			<td><?php echo $row['hemail'];?></td>
			<td><?php echo $row['hcity'];?></td>
			<td><?php echo $row['hphone'];?></td>
			<td><?php echo $row['bg'];?></td>
			<td><?php echo $row['status'];?></td>
			<td><?php if($row['status'] == 'Accepted'){ ?>
			<?php }
			else{ ?>
				<a href="file/cancel.php?reqid=<?php echo $row['reqid'];?>" class="btn btn-danger">Cancel</a>
			<?php } ?>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>
    <?php require 'footer.php'; ?>
</body>
</html>
<?php } ?>