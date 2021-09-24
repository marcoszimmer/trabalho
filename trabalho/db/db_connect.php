<?php 

//conectar com SQL
$banco =mysqli_connect('localhost', 'juliano_marcos', 'comdeustudoposso', 'questoes');

if(!$banco) {
	echo 'erro de conexao' . mysqli_connect_error();
}


 ?>