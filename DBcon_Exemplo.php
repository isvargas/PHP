<?php
	include_once('DBcon.php');
?>
<html>
<head><title>Exemplo</title><head>
<body>
<center>
<h1>EXEMPLO ACESSO DADOS</h1>
</center>
<?php
    try {
		$db = new DB();
		$con = $db->getConnection();
	    
		if ($con) 
		{
			//retorna todos os usuarios		
			$r = $db->run('select * from usuarios where', null);			
			if ($r)
			{
				while ($row = $r->fetchObject()) 
				{
					echo $row->id . " - " . $row->nome . "<br>";
				}
			}
			else 
			{
				echo "Nao retornou dados.<br>";
			}
			
			//retorna dados somente do usuario com ID = 10
			$r = $db->run('select * from usuarios where id = ?', Array(10));
			if ($r) 
			{
				$user = $r->fetchObject();
				echo "Id: $user->id <br>";
				echo "Nome: $user->nome <br>";			
			}
			else {
				echo "Usuario nao encontrado.<br>";	
			}
		}
	    	else 
		{
			echo "Não conectado.<br>";			
		}
	} 
	catch (PDOException $e) 
	{
        	print "Error: " . $e->getMessage() . "<br/>";
        	die();
    }
?>

</body>
</html>
