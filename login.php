<?php
	session_start();

	if(isset($_POST['login']))
	{
		if(empty($_POST['userid']) || empty($_POST['password']))
		{
			echo "null submission";

		}
		else
		{
			$connection = mysqli_connect('127.0.0.1', 'root', '', 'miniproject');
			$result= mysqli_query($connection, "select * from registration where id='".$_POST['userid']."' and password = '".$_POST['password']."';");
			$data=mysqli_fetch_assoc($result);
			mysqli_close($connection);
			if(!empty($data))
			{
				if(isset($_POST['rememberme']))
				{
					setcookie('id',$data['id'],time()+10000,'/');
					setcookie('password',md5($data['password']),time()+10000,'/');
					setcookie('name',$data['name'],time()+10000,'/');
					setcookie('email',$data['email'],time()+10000,'/');
					setcookie('usertype',$data['usertype'],time()+10000,'/');
					setcookie('status','set',time()+10000,'/');
					header('location:home.php');

				}
				else
				{
					$_SESSION['id']= $data['id'];
					$_SESSION['password']= $data['password'];
					$_SESSION['name']= $data['name'];
					$_SESSION['email']= $data['email'];
					$_SESSION['usertype'] = $data['usertype'];
					$_SESSION['status']  = "set";
					header('location:home.php');

				}
			}
			else
				echo "invalic userid Or password!!!";
		}

	}
	else
	{
		header("location:login.html");
	}


?>