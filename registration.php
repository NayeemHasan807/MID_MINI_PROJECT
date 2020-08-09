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
			if($_POST['password'] == $_POST['cpassword'])
			{
				
			}
			else
			{
				echo "password & Confirm password must need to be same!";
			}
		}

	}
	else
	{
		header("location:registration.html");
	}

?>