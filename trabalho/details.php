<?php 

include('db/db_connect.php');

if(isset($_GET['id'])){
	$id = mysqli_real_escape_string($banco, $_GET['id']);

	$sql = "SELECT * FROM pizzas WHERE id = $id";

	$result = mysqli_query($banco, $sql);
}


 ?>
<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>

<h2>detalhes</h2>

<?php include('templates/footer.php'); ?>
</html>