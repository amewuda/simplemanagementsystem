<?php
session_start();
require('./connect.php');
require('./config.php');
if(!isset($_SESSION['email']) & empty($_SESSION['email'])){
    header('location: login.php');
}
//create query
$query = "SELECT * FROM personnel ORDER BY created_at DESC";
//Get result
$result = mysqli_query($connection, $query);
//FEtch Data
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
//var_dump($posts);
//Free Result
mysqli_free_result($result);
//Close Connection
mysqli_close($connection);

//VIEW DESIGN NOT COMPLETE
?>


<!DOCTYPE html>
<html lang="en">
<?php include 'inc/header.php'; ?>
 
    <div class="container">
        <h1>Posts</h1>
        <?php foreach ($posts as $post): ?>
            <!-- code... VIEW DESIGN WILL BE PROPERLY DONE LATER-->
            <div class="well">
                <h3><?php echo $post['title']; ?></h3>
                <small>Created on <?php echo $post['created_at']; ?> by
                    <?php echo $post['author']; ?></small> 
                <p><?php echo $post['body']; ?></p>
            </div>
            <button>
                <a class="btn btn-default" href="<?php echo ROOT_URL; ?>post.php?id=<?php echo $post['id']; ?>">Read More</a>
            </button>
            <hr>
        <?php endforeach; ?>

        
    </div>
<?php include 'inc/footer.php'; ?>
</html>