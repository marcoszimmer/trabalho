<?php 

	include('db/db_connect.php');

	$email = $title = $ingredients = '';
	
	$erros = array('email'=>'', 'title'=>'', 'ingredients'=>'');


	if(isset($_POST['submit'])) {

		if(empty($_POST['email'])) {
				$erros['email'] = 'precisamos de um email';
		} else {
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$erros['email'] = 'email nao eh valido';
			}
		}
		if(empty($_POST['title'])) {
			$erros['title'] = 'precisamos de um nome da pizza';
		} else {
			$title = $_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)) {
				$erros['title'] = 'nome da pizza nao pode estar em binario';
			}
		}
		if(empty($_POST['ingredients'])) {
			$erros['ingredients'] = 'precisamos de ingredientes';
		} else {
			$ingredients = $_POST['ingredients'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
			$erros['ingredients'] = 'que tipo de ingrediente voce esta falando?';
		}

		}
		if(array_filter($erros)) {
			//echo 'formulario invalido';
		} else {

			$email = mysqli_real_escape_string($banco, $_POST['email']);
			$title = mysqli_real_escape_string($banco, $_POST['title']);
			$ingredients = mysqli_real_escape_string($banco, $_POST['ingredients']);

			$sql = "INSERT INTO pizzas(title, email, ingredients) VALUES('$title', '$email', '$ingredients')";
			//echo 'formulario valido';
			

			if(mysqli_query($banco, $sql)) {
				// success
				header('Location: index.php');
			} else {
				//error
				echo 'query error: ' . mysqli_error($banco);
			}

		}

	}

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<section class="container grey-text">
		<h4 class="center"> Add a pizza!</h4>
		<form class="white" action="add.php" method="POST">
			<label>Passa email.</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
			<div class="red-text"><?php echo $erros['email']; ?></div>
			
			<label>Nome da pizza.</label>
			<input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
			<div class="red-text"><?php echo $erros['title']; ?></div>
			
			<label>Ingredientes separados por vírgula.</label>
			<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients); ?>">
			<div class="red-text"><?php echo $erros['ingredients']; ?></div>
			
			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
			</div>
		</form>

	</section>

<?php include('templates/footer.php'); ?>

</html>