<?php session_start(); ?>
<?php include ("function.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }
    </style>
</head>

<body>
<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        extract($_POST);
        $customer_verification = dataClean($customer_verification);

        $messages = array();

        if (empty($customer_verification)) {
            $messages['customer_verification'] = "The verificarion code should not be empty ..!";
        }
        if (!empty($customer_verification)) {
            $db = dbConn();
            $cid = $_SESSION['regcustomer_id'];
            $sql = "SELECT * FROM  tbl_customers WHERE customer_id = '$cid' and customer_verification='$customer_verification'";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                echo "<script>
                Swal.fire({
                    title: 'Verified!',
                    text: 'Verification Success !.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'http://localhost/SMS/web/login.php'; // Redirect to Home Page
                });
        </script>";                     
            } else {
                $messages['customer_verification'] = "The verificarion code is wrong";
            }

}
    }
?>

<div class="login-container">
        <h1 class="text-center">Verification of the user</h1>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="mb-3">
                <label for="text" class="form-label">Enter the verification code</label>
                <input type="text" class="form-control" name="customer_verification" value="<?= @$customer_verification ?>"
                    placeholder="Enter your Verification code here">
                <span class="text-danger"><?= @$messages['customer_verification'] ?></span>
            </div>
            <button type="submit" class="btn btn-primary">Veify</button>
            </form>
    </div>
</body>

</html>