<?php
include ('../app.php');
echo "<!--".PHP_EOL;
print_r($_POST);
echo "-->".PHP_EOL;
if (isset($_POST['filtro'])) {
	$FILTRO = $_POST['filtro'];
	echo "<option></option>";
	switch ($FILTRO) {
	
	case 'cidades':
		$cidades = mysqli_query(DB::$mConnection,"SELECT a.* FROM `cidades` a WHERE a.uf = '{$_POST['estado']}' ORDER BY a.nome ASC");		
	 
		while ($row = mysqli_fetch_array($cidades, MYSQLI_ASSOC)) {			
			echo "<option value='{$row['id']}'>{$row['nome']}</option>";		
		}
		 
		break;		
		 
		
	case 'fabricante':
		$fabricantes = mysqli_query(DB::$mConnection,"SELECT * FROM `fabricante` ORDER BY nome ASC");		
		while ($row = mysqli_fetch_array($fabricantes, MYSQLI_ASSOC)) {			
			echo "<option value='{$row['id']}'>{$row['nome']}</option>";		
		}		
		break;			
	case 'fabricante2':
		$tipo = $_POST['tipo'];
		$fabricantes = mysqli_query(DB::$mConnection,"SELECT * FROM `fabricante` WHERE tipo = '{$tipo}' ORDER BY nome ASC");
		echo "<!--".PHP_EOL;
		echo "SELECT * FROM `fabricante` WHERE tipo = '{$tipo}' ORDER BY nome ASC";
		echo "-->".PHP_EOL;
		while ($row = mysqli_fetch_array($fabricantes, MYSQLI_ASSOC)) {
			echo "<option value='{$row['id']}'>{$row['nome']}</option>";
		}
		if (mysqli_num_rows($fabricantes) <= 0) {
			echo "<option>Nenhum encontrado</option>";
			}
		break;
	case 'modelo':
		$modelos = mysqli_query(DB::$mConnection,"SELECT * FROM modelo WHERE fabricante = {$_POST['fabricante']} ORDER BY nome ASC");
		while ($row = mysqli_fetch_array($modelos, MYSQLI_ASSOC)) {
		echo "<option value='{$row['id']}'>{$row['nome']}</option>";
		}
		break;
	
	default:
		echo "<option>Erro ao filtrar</option>";
		break;
	}
}
?>