<?php
session_start();
error_reporting(0);
include 'connect.php';

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link href="favicon1.png" rel="icon" type="image/x-icon" />
		<title>print</title>
	</head>
	<body class=" m-5">
		<?php echo "<h4><u><b><center>Transaction Details for Account Number : ".$_SESSION['c_id']."</center></b></u></h4>"; ?>
		<table id="datatablesSimple">
			<thead class="card-header text-center pr-2'">
				<tr>
					<th class='text-center px-2'>s.no</th>
					<th class='text-center px-2'>Date</th>	
				  <th class='text-center px-2'>Withdrawl Amount</th>
					<th class='text-center px-2' colspan="3">Notes Description<h6>(2000|500|100)</h6></th>
					<th class='text-center px-2'>Remaining balence</th>
					</tr>
			</thead>
			<tbody>
				<?php
				$sql = "SELECT * FROM `c_trans_details` WHERE c_id = '".$_SESSION['c_id']."' ";
				if($result = mysqli_query($conn,$sql)){
				for($i=1; $i<=mysqli_num_rows($result); $i++){
				$row = mysqli_fetch_assoc($result);
				$notes = explode('|', $row['2000 | 500 | 100']);
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td class='text-center px-2'><?php echo date("d/m/y", strtotime($row["date_time"]));?></td>
					<td class='text-center px-2'><?php echo $row["c_withdraw_amt"] ; ?></td>
					<td class='text-center px-2'><?php echo $notes[0]; ?></td>
					<td class='text-center px-2'><?php echo $notes[1]; ?></td>
					<td class='text-center px-2'><?php echo $notes[2]; ?></td>
					<td class='text-center px-2'><?php echo $row["c_up_bal"] ; ?></td>
				</tr>
				<?php
				}
				if(!isset($_SESSION['c_id'])){
					header('location:find consumer detail.php');
				}
				mysqli_free_result($result);
				session_destroy();
				mysqli_close($conn);
				} ?>
			</tbody>
		</table>
		<a href="/find consumer detail.php"><input type="submit" name="back" value="Back" style="background-color: red; color:white; font-size: 1.2rem; padding:3px 20px;" /></a>
	</body>
	      <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
</html>