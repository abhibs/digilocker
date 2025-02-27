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
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Aadhaar Digilocker</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Basic-icons.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body class="bg-color">
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-3 offset-0">
                <div class="row">
                    <div class="col-2 col-xl-1"><i class="far fa-user color" style="font-size:18px;"></i></div>
                    <div class="col-10">
                        <h5 class="head-color">NEW CUSTOMER</h5>
                    </div>
                </div>
            </div>
            <div class="col-3 offset-6">
                <div class="row text-bg-light">
                    <div class="col offset-2"><i class="fas fa-warehouse color" style="font-size:18px;"></i></div>
                    <div class="col">
                        <h5 class="color">Mandya</h5>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation"><a class="nav-link active" role="tab" data-bs-toggle="tab"
                        href="#tab-1">Check Aadhaar</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab"
                        href="#tab-2">Aadhar eKYC</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab"
                        href="#tab-3">Verify Aadhar</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab"
                        href="#tab-4">DigiLocker</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab"
                        href="#tab-5">Manual</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" role="tabpanel" id="tab-1">
                    <p>Shruti</p>
                </div>
                <div class="tab-pane" role="tabpanel" id="tab-2">
                    <p>Shahil</p>
                </div>
                <div class="tab-pane" role="tabpanel" id="tab-3">
                    <p>Chandrika</p>
                </div>
                <div class="tab-pane" role="tabpanel" id="tab-4">
                    <div class="container-fluid mt-3">
                        <div class="row">
                            <div class="col-2">
                                <!-- <button class="btn btn-primary" type="button">Click to display
                                    Transaction ID</button> -->

                                <form id="form1">
                                    <button type="button" class="btn btn-primary" onclick="showTransactionId()">Click to display the transaction ID</button>
                                </form>
                            </div>
                            <div class="col-5">
                                <div class="card mb-5">
                                    <div class="card-body p-sm-12">
                                        <form>
                                            <h5>Enter Mobile Number</h5>
                                            <div class="mb-3">
                                                <input class="form-control" type="number" id="mobile" placeholder="Enter Mobile Number">
                                            </div>

                                            <h5>Enter Generated Digilocker Link</h5>
                                            <div class="mb-3">
                                                <input class="form-control" type="text" id="link" placeholder="Enter Generated Digilocker Link">
                                            </div>
                                            <button class="btn btn-primary" onclick="shareOnWhatsApp()">Share In What's Up</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <div class="col-5">
                                <div class="card mb-5">
                                    <div class="card-body p-sm-12">
                                        <h5 style="color: #123C69;">Enter Transaction ID</h5>
                                        <!-- <form method="post">
                                            <div class="mb-3"><input class="form-control" type="text" id="name-2"
                                                    name="name" placeholder="Enter Transaction ID"></div>
                                            <div><button class="btn btn-primary" type="submit">Submit</button></div>
                                        </form> -->
                                        <form onsubmit="displayOutput(event)">
                                            <div class="form-group">
                                                <input type="text" id="transId" name="transId" required placeholder="Generated Transaction ID" class="form-control" autocomplete="off">
                                            </div>

                                            <button class="btn btn-success mt-3" type="submit">
                                                <span style="color:#ffcf40" class="fa fa-save"></span> Submit
                                            </button>
                                        </form>
                                        <div id="output" style="margin-top: 20px; white-space: pre-wrap;"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane" role="tabpanel" id="tab-5">
                    <p>Saraswati</p>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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

        async function displayOutput(event) {
            event.preventDefault();

            let transId = document.getElementById("transId").value;

            if (!transId) {
                alert("Please enter a valid Transaction ID.");
                return;
            }

            let requestData = {
                type: "Digilocker-Aadhar",
                ts_trans_id: transId
            };

            try {
                let response = await fetch('DigiLocker.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(requestData)
                });

                if (!response.ok) {
                    throw new Error('Failed to fetch DigiLocker data.');
                }

                let data = await response.json();

                let outputDiv = document.getElementById("output");
                outputDiv.innerHTML = `<pre>${JSON.stringify(data, null, 2)}</pre>`;

            } catch (error) {
                alert("Error: " + error.message);
            }
        }

        function shareOnWhatsApp() {
            let mobile = document.getElementById("mobile").value.trim();
            let link = document.getElementById("link").value.trim();

            if (mobile && link) {
                let message = `Here is your Digilocker link: ${link}`;
                let whatsappURL = `https://wa.me/${mobile}?text=${encodeURIComponent(message)}`;

                // Redirect to WhatsApp with the message
                window.open(whatsappURL, '_blank');
            } else {
                alert("Enter both Mobile Number and Link!");
            }
        }
    </script>
</body>

</html>