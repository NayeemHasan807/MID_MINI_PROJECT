<?php
	session_start();

	if(isset($_POST['register']))
	{
		if(empty($_POST['id']) || empty($_POST['password']) || empty($_POST['cpassword']) || empty($_POST['name']) || empty($_POST['email']) || empty($_POST['usertype']))
		{
			echo "null submission";
		}
		else 
		{
			$connection = mysqli_connect('127.0.0.1', 'root', '', 'miniproject');
			$result= mysqli_query($connection, "select * from registration where id ='".$_POST['id']."';");
			$data=mysqli_fetch_assoc($result);
			mysqli_close($connection);
			if(empty($data['id']))
			{
				if($_POST['password'] == $_POST['cpassword'])
				{
					$connection = mysqli_connect('127.0.0.1', 'root', '', 'miniproject');
					$result = mysqli_query($connection, "insert into `registration`(`id`, `password`, `name`, `email`, `usertype`) values ('".$_POST['id']."','".$_POST['password']."','".$_POST['name']."','".$_POST['email']."','".$_POST['usertype']."');");
					mysqli_close($connection);
					header('location:login.html');
				}
				else
				{
					echo "password & confirm password must need to be same!";
				}
			}
			else
				echo "This id is not available!";
		}

	}
	else
	{
		header("location:registration.html");
	}

?>