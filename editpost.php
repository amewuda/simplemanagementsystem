<?php
	session_start();
	require('./connect.php');
	require('./config.php');
	if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
	    header('location: login.php');
	}

	if(isset($_POST['submit'])){
		//Get data
		$update_id = mysqli_real_escape_string($connection, $_POST['update_id']);
		$title = mysqli_real_escape_string($connection, $_POST['title']);
		$body = mysqli_real_escape_string($connection, $_POST['body']);
		$author = mysqli_real_escape_string($connection, $_POST['author']);

		$query = "UPDATE personnel SET 
			title = '$title',
			author = '$author',
			body = '$body'
				WHERE id = {$update_id}";


		if(mysqli_query($connection, $query)){
			header('Location: ' .ROOT_URL. '');
		}else{
			echo 'ERROR: '. mysqli_error($connection);
		}
	}
	$id = mysqli_real_escape_string($connection, $_GET['id']);
	// create query
	$query = 'SELECT * FROM personnel WHERE id= '.$id;
	//get result
	$result = mysqli_query($connection, $query);
	//Fetch data
	$post = mysqli_fetch_assoc($result);
	//Free result
	mysqli_free_result($result);
	//close connection
	mysqli_close($connection); 

?>
<!DOCTYPE html>
<html lang="en">
<?php include 'inc/header.php'; ?>
        <div class="container">
		<h2>Edit Post</h2>
		<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" id="title" name="title" value="<?php echo $post['title']; ?>" class="form-control">
			</div>
			
			<div class="form-group">
				<label for="author">Author</label>
				<input type="text" id="author" name="author" value="<?php echo $post['author']; ?>" class="form-control">
			</div>

			<div class="form-group">
				<label for="body">Add Content</label>
				<textarea name="body" value="<?php echo $post['body']; ?>" class="form-control"></textarea>
			</div>
			<div>
				<input type="hidden" name="update_id" value="<?php echo $post['id']; ?>">
			</div>
			<div>
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
<?php include 'inc/footer.php'; ?>
</html>