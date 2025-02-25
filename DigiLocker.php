<?php
	include("sendRequest.php");

	$json_data = file_get_contents('php://input');
	$request_data = json_decode($json_data, true);

	if($request_data['type'] == "Digilocker"){
		$url = "https://www.truthscreen.com/api/v1.0/eaadhaardigilocker";
		$body = [
			"trans_id"=>"1234567",
			"doc_type"=> "472",
			"action"=> "LINK",
			"callback_url"=>"",
			"redirect_url"=> "",
		];
		$decrypted = sendRequest($url, $body);


		echo json_encode($decrypted);
	}                                              


	if($request_data['type'] == "Digilocker-Aadhar"){
		$url = "https://www.truthscreen.com/api/v1.0/eaadhaardigilocker";
		$body = [
			"ts_trans_id"=>$request_data['ts_trans_id'],
			"doc_type" => "472",
    		"action" => "STATUS"
		];		
		$decrypted = sendRequest($url, $body);

		echo json_encode($decrypted);
	}

?>