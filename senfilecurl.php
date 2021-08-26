<?php 
	//ENVIAR ARQUIVOS VIA POST COM CURL
	
	//inicializa o curl
	$ch = curl_init('http://localhost:8080/files/upload');
	
	//configura basic auth
	$header = [		
	     'Authorization: Basic '.base64_encode('user:pass')
	];
	
	//cria o curfile
	$cfile = new CURLFile('D:\teste.txt', 'text/plain', 'teste.txt');
	
	//aplica configuracoes
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, ['file' => $cfile]);

	//executa
	$response = curl_exec($ch);
	
	//print retorno
	echo $response;
?>
