<?php
	session_start();
	if(!empty($_SESSION))
	{
		if(empty($_SESSION['status']))
		{
			header('location:logout.php');
		}
	}
	else
	{
		if(empty($_COOKIE['status']))
		{
			header('location:logout.php');
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
</head>
<body>
	<table align="center" border="1">
		<tr>
			<td colspan="4" align="center">
				<h6>Users</h6>
			</td>
		</tr>
		<tr>
			<td>ID</td>
			<td>NAME</td>
			<td>EMAIL</td>
			<td>PASSWORD</td>
		</tr>
		<?php
			$connection = mysqli_connect('127.0.0.1', 'root', '', 'miniproject');
			$result= mysqli_query($connection, "select * from registration;");
			foreach ($result as $data)
			{
				echo "<tr><td>".$data['id']."</td><td>".$data['name']."</td><td>".$data['email']."</td><td>".$data['usertype']."</td></tr>";
			}
		?>

		<tr>
			<td colspan="4" align="right">
				<a href="home.php">Go Home</a>
			</td>
		</tr>
		
	</table>

</body>
</html>
