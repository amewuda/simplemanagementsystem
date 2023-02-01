<?php
session_start();
require('connect.php');
require('./config.php');

if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
    header('location: login.php');
}

if(isset($_POST) & !empty($_POST)){
	print_r($_POST);
	$title = mysqli_real_escape_string($connection, $_POST['title']);
	$body = mysqli_real_escape_string($connection, $_POST['body']);
	$author = mysqli_real_escape_string($connection, $_POST['author']);

	$query = "INSERT INTO personnel(title, author, body) VALUES ('$title', '$author', '$body')";
	if(mysqli_query($connection, $query)){
		header('Location: '.ROOT_URL. '');
	}else{
		echo 'ERROR: '. mysqli_error($connection);
	}

}

?>
<!DOCTYPE html>
<html lang="en">
<?php include 'inc/header.php'; ?>
	<div class="container">
		<h2>Add New Post</h2>
		<form method="POST" method="<?php $_SERVER['PHP_SELF']; ?>">
			<div class="form-group">
				<label for="title">Add Title</label>
				<input type="text" id="title" name="title" placeholder="Write the title" class="form-control">
			</div>
			
			<div class="form-group">
				<label for="author">Author</label>
				<input type="text" id="author" name="author" placeholder="add author" class="form-control">
			</div>

			<div class="form-group">
				<label for="body">Add Content</label>
				<textarea name="body" class="form-control"></textarea>
			</div>
			<div>
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
	


<?php include 'inc/footer.php'; ?>
</html>
