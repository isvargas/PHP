<?php
	include_once('db.php');
?>
<html>
<head><title>IMPETHO - Impacto Eterno Hoje</title><head>
<body>
<center>
<h1>IMPETHO</h1>
Impacto Eterno Hoje<br>
<small>missoesimpacto@gmail.com</small>
</center>
<br>
Testando conexao...
<?php
    try {
		$db = new DB();
		$con = $db->getConnection();
		if ($con) {
			echo "<br>Conectado!";
			
			//$db->run('insert into usuarios(nome,email) values(?,?)',array('Teste','teste'));
			
			$r = $db->run('select * from usuarios',null);
			if ($r) {
				echo "<br>Registros encontrados: " . $r->rowCount() . "<br>";
				while ($row = $r->fetchObject()) {
					echo $row->id . " - " . $row->nome . "<br>";
				}
			}else {
				echo "<br>Nao retornou dados.";
			}
		}else {
			echo "<br>Não conectado.";			
		}
	} catch (PDOException $e) {
        print "Error: " . $e->getMessage() . "<br/>";
        die();
    }
?>

</body>
</html>
