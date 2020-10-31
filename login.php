<?php
session_start();
include('admin/config.php');
$message="";
$errors=array();

if(isset($_POST['submit'])){
	$username=isset($_POST['username'])?$_POST['username']:'';
	$password=isset($_POST['password'])?$_POST['password']:'';
	
	if(sizeof($errors)==0){
		$sql = "SELECT * FROM usersignup WHERE `username`='".$username."' AND `password`='".$password."'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$_SESSION['userdata']=array('username'=>$row['username'],'user_id'=>$row['user_id']);
				$message="Login Successfully";
				header('Location: userpanel.php');
			}
		} 
		else {
			$errors[]=array('input'=>'form','msg'=>'Invalid login details');
		}
		
		$conn->close();
		}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Login
	</title>
	<link rel="stylesheet" type="text/css" href="admin/style1.css">
</head>
<body>
	<div id="message"><?php echo $message; ?></div>
	<div id="errors">
		<?php if(sizeof($errors)>0):?>
			<ul>
			<?php foreach($errors as $error):?>
				<li><?php echo $error['msg']; ?></li>
			<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>
	<div id="login-form">
		<h2>Login</h2>
		<form action="" method="POST">
			<p>
				<label for="username">Username: <input type="text" name="username" required></label>
			</p>
			<p>
				<label for="password">Password: <input type="password" name="password" required></label>
			</p>
			<p>
				<input type="submit" name="submit" value="Submit">
			</p>
			<p class="already">
				Not a user??
				<a href="signup.php"><b>Register Here</b></a>
			</p>
		</form>
	</div>
	
</body>
</html>