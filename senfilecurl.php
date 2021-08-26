<?php 
	//enviando arquivos via POST com CURL
	
	//Initialise the cURL var
	$ch = curl_init('http://localhost:8080/files/upload');
	
	//basic auth
	$header = [
		//'Content-Type: application/json; charset=utf-8',
		'Authorization: Basic '.base64_encode('atendimento@htisolucoes.com.br:66515fcdce92c88b7bbf3be5fd98fe8d9ea3d46c')
	];
	
	//cria o CurlFile
	$cfile = new CURLFile('D:\teste.txt', 'text/plain', 'teste.txt');
		
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, ['file' => $cfile]);

	// Execute the request
	$response = curl_exec($ch);
	
	//print retorno
	echo $response;
?>