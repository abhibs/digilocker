<?php
include("sendRequest.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $json_data = file_get_contents('php://input');
    $request_data = json_decode($json_data, true);

    if ($request_data['type'] == "Digilocker") {
        $url = "https://www.truthscreen.com/api/v1.0/eaadhaardigilocker";
        $body = [
            "trans_id" => "1234567",
            "doc_type" => "472",
            "action" => "LINK",
            "callback_url" => "",
            "redirect_url" => "",
        ];
        $decrypted = sendRequest($url, $body);


        echo json_encode($decrypted);
        exit;
    }


    if ($request_data['type'] == "Digilocker-Aadhar") {
        $url = "https://www.truthscreen.com/api/v1.0/eaadhaardigilocker";
        $body = [
            "ts_trans_id" => $request_data['ts_trans_id'],
            "doc_type" => "472",
            "action" => "STATUS"
        ];
        $decrypted = sendRequest($url, $body);

        echo json_encode($decrypted);
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aadhaar DigiLocker</title>
    <script>
        async function showTransactionId() {
            try {
                let requestData = {
                    type: "Digilocker" 
                };

                let response = await fetch('DigiLocker.php', {  
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(requestData)
                });

                if (!response.ok) {
                    throw new Error('Failed to fetch transaction ID');
                }

                let data = await response.json();

                if (data && data.ts_trans_id && data.data && data.data.url) {
                    alert("Your Transaction ID: " + data.ts_trans_id);
                    alert("DigiLocker link generated successfully.");
                    window.open(data.data.url, '_blank'); 
                } else {
                    alert("Failed to retrieve transaction details. Check API response.");
                }
            } catch (error) {
                alert("Error: " + error.message);
            }
        }
    </script>
</head>

<body>
    <form id="form1">
        <button type="button" onclick="showTransactionId()">Click to display the transaction ID</button>
    </form>

</body>

</html>