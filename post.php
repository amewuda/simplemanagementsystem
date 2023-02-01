<?php
session_start();
require('./connect.php');
require('./config.php');
if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
    header('location: login.php');
}
//For the delete
if(isset($_POST['delete'])){
	//Get form data
	$delete_id = mysqli_real_escape_string($connection, $_POST['delete_id']);
	//create query
	$query = "DELETE FROM personnel WHERE id={$delete_id}";

	if(mysqli_query($connection, $query)){
		header('Location: '.ROOT_URL. '');
	}else{
		echo 'ERROR: '. mysqli_error($connection);
	}
}

$id = mysqli_real_escape_string($connection, $_GET['id']);
//Create Query
$query = 'SELECT * FROM personnel WHERE id=' .$id;
//Get result
$result = mysqli_query($connection, $query);
//Fetch a Single Data
$post = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<?php include 'inc/header.php'; ?>

    <div class="container">
    	<button><a href="<?php echo ROOT_URL;?>" class="btn btn-default">Back</a>
    	</button>
        <div class="well">
            <h3><?php echo $post['title']; ?></h3>
            <small>Created on <?php echo $post['created_at']; ?> by
                <?php echo $post['author']; ?></small> 
            <p><?php echo $post['body']; ?></p>

            <form class="pull-right" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            	<input type="hidden" name="delete_id" value="<?php echo $post['id']; ?>">
            	<input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>

            <button>
            	<a class="btn btn-primary" href="<?php echo ROOT_URL; ?>editpost.php?id=<?php echo $post['id']; ?>" >Edit Post</a>
            </button>
        </div>
       
        
    </div>
<?php include 'inc/footer.php'; ?>
</html>