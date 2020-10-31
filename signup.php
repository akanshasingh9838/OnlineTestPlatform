<?php
include('admin/config.php');
$message="";
$errors=array();
if(isset($_POST['submit'])){
	$username=isset($_POST['username'])?$_POST['username']:'';
	$password=isset($_POST['password'])?$_POST['password']:'';
	$repassword=isset($_POST['repassword'])?$_POST['repassword']:'';
	$email=isset($_POST['email'])?$_POST['email']:'';
	//echo($username." ".$password." ".$repassword." ".$email);
	if($password != $repassword){
		$errors[]=array("input"=>"password","msg"=>"password didn't match");
	}

	if(strlen($password) < 6){
		$errors[]=array("input"=>"password","msg"=>"Password length should be greater than 6 characters");		
	}

	//check db for existing user with same username or email'	
	$sql = "SELECT * FROM usersignup WHERE `username`='$username' or `email` ='$email'LIMIT 1";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	// output data of each row
		while($row = $result->fetch_assoc()) {
			//echo "username: " . $row["username"]. " - email: " . $row["email"]."<br>";
			if($row["username"]===$username){
				$errors[]=array("input"=>"username","msg"=>"username already exists");
			}
			if($row["email"]===$email){
				$errors[]=array("input"=>"email","msg"=>"Email already exists");
			}
		}
	}
	
	if(sizeof($errors)==0){
		$sql='INSERT INTO usersignup(`username`,`password`,`email`)VALUES("'.$username.'","'.$password.'","'.$email.'")';
        if ($conn->query($sql) === TRUE) {
			$message="New record created successfully";
			header('Location:login.php');
        } else {
            $errors=array('input'=>'form','msg'=>$conn->error);
            echo "Error: " . $sql . "<br>" . $conn->error;
        }        
        $conn->close();
		}				
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Register
	</title>
	<link  type="text/css" rel="stylesheet"  href="admin/style1.css"  >
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
		<div id="signup-form">
			<h2>Sign Up</h2>
			<form action="signup.php" method="POST" id="signup">
				<p>
					<label for="username">Username: <input type="text" name="username" required</label>
				</p>
				<p>
					<label for="password">Password: <input type="password" name="password" required ></label>
				</p>
				<p>
					<label for="repassword">Re-Password: <input type="password" name="repassword" required ></label>
				</p>
				<p>
					<label for="email">Email: <input type="email" name="email" required></label>
				</p>
				<p>
					<input type="submit" name="submit" value="Submit">
				</p>
				<p class="already">
					Already a user??
					<a href="index.php"><b>Log In</b></a>
				</p>
			</form>
		</div>	 
</body>
</html>