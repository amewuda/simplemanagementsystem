<?php 
	session_start();
	require('connect.php');
	if (isset($_POST) and !empty($_POST)){
		$email = mysqli_real_escape_string($connection, $_POST['email']);
		$password = md5(mysqli_real_escape_string($connection, $_POST['password']));
		$query = "SELECT * FROM users WHERE email ='$email' and password ='$password'";
		//query = 'SELECT name, password, id FROM users';

		$result = mysqli_query($connection, $query);
		$count = mysqli_num_rows($result);
		if ($count == 1){
			$_SESSION['email'] = $email;
			header('location: index.php');
			//echo "user exits";
		} else{
			echo "Login credentials not right";
		}
	}

	if(isset($_POST['submit'])){
		$email = $_SESSION['email'];
		echo "Hello " . $email . " ";
		echo "<a href='logout.php'>Logout</a>";
	}else{
		echo " Login please";
	}
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'inc/header.php'; ?>
	
	<form method="POST">
		<label for="add">Your email</label>
		<input id="add" type="email" name="email" placeholder="Write your email"><br>
		<label for="added">Your password</label>
		<input id="added" type="password" name="password" placeholder="Write your password" required>
		<input type="submit" name="submit" value="Submit">
		
	</form>
<?php include 'inc/footer.php'; ?>
</html>