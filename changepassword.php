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
	<title>Change Passwoed</title>
</head>
<body>
	<fieldset>
		<legend>Change Password</legend>
		<form action="changepassword.php" method="post">
			Current Password<br/>
			<input type="password" name="cpassword"><br/>
			New Password<br/>
			<input type="Password" name="npassword"><br/>
			Retype New Password<br/>
			<input type="Password" name="renpassword"><br/>
			<hr/>
			<input type="Submit" name="change" value="Change"> <a href="home.php">Home</a>

		</form>
	</fieldset>
</body>
</html>

<?php

	if(isset($_POST['change']))
	{
		if($_POST['cpassword']!="" and $_POST['npassword']!="" and $_POST['renpassword']!="")
		{
			if(!empty($_SESSION))
			{
				if($_SESSION['password']==$_POST['cpassword'])
				{
					if($_POST['npassword']==$_POST['renpassword'])
					{
						$connection = mysqli_connect('127.0.0.1', 'root', '', 'miniproject');
						$result= mysqli_query($connection, "update `registration` SET `password`='".$_POST['npassword']."' WHERE id='".$_SESSION['id']."'");
						$_SESSION['password']=$_POST['npassword'];
						mysqli_close($connection);

					}
					else
						echo "New Password And Retype New Password Must Need To Be Same!";

				}
				else
					echo "Current Password is Wrong!";

			}
			else
			{
				if($_COOKIE['password']==md5($_POST['cpassword']))
				{
					if($_POST['npassword']==$_POST['renpassword'])
					{
						$connection = mysqli_connect('127.0.0.1', 'root', '', 'miniproject');
						$result= mysqli_query($connection, "update `registration` SET `password`='".$_POST['npassword']."' WHERE id='".$_COOKIE['id']."'");
						setcookie('password',md5($_POST['npassword']),time()+10000,'/');
						mysqli_close($connection);
					}
					else
						echo "New Password And Retype New Password Must Need To Be Same!";

				}
				else
					echo "Current Password is Wrong!";
			}
		}
		else
			echo "Fill All The Info First";

	}
?>