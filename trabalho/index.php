<?php 

include('db/db_connect.php');

//selecionar info
$sql = 'SELECT title, ingredients, id, imagem FROM pizzas ORDER BY created_at';

$result = mysqli_query($banco, $sql);

$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

//limpar memoria
mysqli_free_result($result);

mysqli_close($banco);

// print_r(explode(',', $pizzas[0]['ingredients']));
 ?>



<!DOCTYPE html>
<html>

	<?php include('templates/header.php'); ?>

	<h4 class="center grey-text">Pizzas!</h4>

	<div class="container">
	<div class="row">
		<?php foreach ($pizzas as $pizza) : ?>
			
			<div class="col s6 md3">
				<div class="card z-depth-0">
					<div class="card-content center">
						<h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
						<div>
							<?php foreach(explode(',', $pizza['ingredients']) as $ing): ?>
								<li><?php echo htmlspecialchars($ing); ?></li>
							<?php endforeach; ?>
						</div>
						<div><IMG src="triangulo-pitagorico.jpg" alt="Getz/Gilberto"></div>
					</div>
					<div class="card-action right-align">
						<a class="brand-text" href="details.php?id=<?php echo $pizza['id']?>">Mais informacoes</a>
					</div>
				</div>				
			</div>

		<?php endforeach; ?>
	</div>	
	</div>

	<?php include('templates/footer.php'); ?>

</html>