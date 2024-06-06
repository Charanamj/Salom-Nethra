<?php

include 'header.php';
include 'assets/phpmail/mail.php';
?>
<main id="main">
    <!-- ======= Contact Us Section ======= -->
    <section>
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Customer</h2>
                <p>Register</p>
            </div>

            <div class="row justify-content-center">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    extract($_POST);
                    $customer_title = dataClean($customer_title);
                    //$customer_gender = dataClean($customer_gender);
                    $customer_title = dataClean($customer_title);
                    $customer_firstname = dataClean($customer_firstname);
                    $customer_lastname = dataClean($customer_lastname);
                    $customer_email = dataClean($customer_email);
                    $customer_mobilenumber = dataClean($customer_mobilenumber);
                    $customer_nic = dataClean($customer_nic);
                    $customer_addressline1 = dataClean($customer_addressline1);
                    $customer_addressline2 = dataClean($customer_addressline2);
                    $customer_district = dataClean($customer_district);
                    $customer_username = dataClean($customer_username);
                    $customer_password = dataClean($customer_password);
                    $customer_conpassword = dataClean($customer_conpassword);
                    $customer_image = $_FILES['customer_image'];

                    $message = array();
                    if (empty($customer_title)) {
                        $message['customer_title'] = "The customer title should be select...!";
                    }
                    if (empty($customer_gender)) {
                        $message['customer_gender'] = "The customer gender should be select...!";
                    }
                    if (empty($customer_firstname)) {
                        $message['customer_firstname'] = "The first name should not be blank...!";
                    }
                    if (empty($customer_lastname)) {
                        $message['customer_lastname'] = "The last name should not be blank...!";
                    }
                    if (empty($customer_image)) {
                        $message['customer_image'] = "The image should be select...!";
                    }
                    if (empty($customer_email)) {
                        $message['customer_email'] = "The first name should not be blank...!";
                    }
                    if (empty($customer_mobilenumber)) {
                        $message['customer_mobilenumber'] = "Mobile number should not be blank...!";
                    }
                    if (empty($customer_nic)) {
                        $message['customer_nic'] = "Customer NIC should not be blank...!";
                    }
                    if (!empty($customer_nic)) {

                        $niclength = strlen($customer_nic);
                        if ($niclength == 10 || $niclength == 12) {

                        } else {
                            $message['customer_nic'] = "The NIC  length should 10 or 12!";
                        }
                    }
                    if (!empty($customer_nic)) {
                        $db = dbConn();
                        $sql = "SELECT * FROM  tbl_customers WHERE customer_nic='$customer_nic'";
                        $result = $db->query($sql);
                        if ($result->num_rows > 0) {
                            $message['customer_nic'] = "This ID number is already in the database";
                        }
                    }
                    if (empty($customer_addressline1)) {
                        $message['customer_addressline1'] = "Address line 1 should not be blank...!";
                    }
                    if (empty($customer_addressline2)) {
                        $message['customer_addressline2'] = "Address line 2 should not be blank...!";
                    }
                    if (empty($customer_district)) {
                        $message['customer_district'] = "district should be select...!";
                    }
                    if (empty($customer_username)) {
                        $message['customer_username'] = "User Name is required";
                    }
                    if (empty($customer_password)) {
                        $message['customer_password'] = "password is required";
                    }
                    if (empty($customer_conpassword)) {
                        $message['customer_conpassword'] = "confirm password is required";
                    }
                    if (!empty($customer_password)) {
                        $uppercase = preg_match('@[A-Z]@', $customer_password);
                        $lowercase = preg_match('@[a-z]@', $customer_password);
                        $number = preg_match('@[0-9]@', $customer_password);
                        $specialChars = preg_match('@[^\w]@', $customer_password);
                        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($customer_password) < 8) {
                            $message['customer_password'] = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character";
                        }
                        if ((!empty($customer_password)) && (!empty($customer_conpassword))) {
                            if ($customer_password != $customer_conpassword) {
                                $message['customer_password'] = " Passwords are not match";
                            }
                        }


                        //Advance validation------------------------------------------------
                        if (ctype_alpha(str_replace(' ', '', $customer_firstname)) === false) {
                            $message['customer_firstname'] = "Only letters and white space allowed";
                        }
                        if (ctype_alpha(str_replace(' ', '', $customer_lastname)) === false) {
                            $message['customer_lastname'] = "Only letters and white space allowed";
                        }
                        if (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
                            $message['customer_email'] = "Invalid Email Address...!";
                        } else {
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_customers WHERE customer_email='$customer_email'";
                            $result = $db->query($sql);

                            if ($result->num_rows > 0) {
                                $message['customer_email'] = "This Email address already exsist...!";
                            }
                        }
                        if ($_FILES['customer_image']['name'] != "") {
                            $customer_image = $_FILES['customer_image'];
                            $filename = $customer_image['name'];
                            $filetmpname = $customer_image['tmp_name'];
                            $filesize = $customer_image['size'];
                            $fileerror = $customer_image['error'];
                            //take file extension
                            $file_ext = explode(".", $filename);
                            $file_ext = strtolower(end($file_ext));
                            //select allowed file type
                            $allowed = array("jpg", "jpeg", "png", "gif");
                            //check wether the file type is allowed
                            if (in_array($file_ext, $allowed)) {
                                if ($fileerror === 0) {
                                    //file size gives in bytes
                                    if ($filesize <= 40000000) {
                                        //giving appropriate file name. Can be duplicate have to validate using function
                                        $file_name_new = uniqid('', true) . $customer_username . '.' . $file_ext;
                                        //directing file destination
                                        $file_path = "assets/img/customers/" . $file_name_new;
                                        //moving binary data into given destination
                                        if (move_uploaded_file($filetmpname, $file_path)) {
                                            "The file is uploaded successfully";
                                        } else {
                                            $message['file_error'] = "File is not uploaded";
                                        }
                                    } else {
                                        $message['file_error'] = "File size is invalid";
                                    }
                                } else {
                                    $message['file_error'] = "File has an error";
                                }
                            } else {
                                $message['file_error'] = "Invalid File type";
                            }
                        }

                        if (!empty($customer_username)) {
                            $db = dbConn();
                            $sql = "SELECT * FROM tbl_customers WHERE customer_username='$customer_username'";
                            $result = $db->query($sql);

                            if ($result->num_rows > 0) {
                                $message['customer_username'] = "This User Name already exsist...!";
                            }
                        }

                        if (!empty($customer_password)) {
                            if (strlen($customer_password) < 8) {
                                $message['customer_password'] = "The password should be 8 characters or more";
                            }
                        }

                        if (empty($message)) {
                            //Use bcrypt hasing algorithem
                            //$pw = password_hash($password, PASSWORD_DEFAULT);
                            $db = dbConn();
                            $AddDate = date('y-m-d');
                            $status = 1;
                            $customer_verification = rand(100000, 999999);
                            $_SESSION['CNO'] = $customer_verification;
                            $newpsw = sha1($customer_password);
                            $customer_status = 1;
                            $sql = "INSERT INTO tbl_customers(customer_title, customer_gender, 
                                customer_firstname, customer_lastname, customer_image, 
                                customer_email, customer_mobilenumber, customer_nic, customer_addressline1, 
                                customer_addressline2, customer_district, customer_status, customer_username, 
                                customer_password, customer_verification) VALUES ('$customer_title','$customer_gender',
                                '$customer_firstname','$customer_lastname', '$file_name_new', '$customer_email', 
                                '$customer_mobilenumber', '$customer_nic', '$customer_addressline1','$customer_addressline2',
                                '$customer_district','$customer_status','$customer_username', '$newpsw', '$customer_verification')";
                            $db->query($sql);
                            $regcustomer_id = $db->insert_id;
                            $_SESSION['regcustomer_id'] = $regcustomer_id;
                        
                            $to = $customer_email;
                            $toname = $customer_firstname . $customer_lastname;
                            $subject = 'Verification of the Customer';
                            $body = "<h1>Welcome to the Salon Nethra</h1> <p>Your Account has been successfully created</p> <p>Verification Code is:</p> <h1>" . $customer_verification . "</h1> <a href='http://localhost/SMS/web/register_success.php'>Click here to verify your account</a>";
                            $alt = 'Customer Registration';
                            send_email($to, $toname, $subject, $body, $alt);

                    //         echo "<script>
                    //         Swal.fire({
                    //             title: 'Registerd!',
                    //             text: 'Registration Successful !.',
                    //             icon: 'success',
                    //             confirmButtonText: 'OK'
                    //         }).then(() => {
                    //             window.location.href = 'http://localhost/SMS/web/register_success.php'; // Redirect to success page
                    //         });
                    // </script>";
                        }
                    }
                }

                ?>

                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="customer_title">Customer Title</label>
                            <select type="text" class="form-control" id="exampleInputName1" name="customer_title"
                                value="<?= @$customer_title ?>">
                                <option value="">- -</option>
                                <option value="Mr" <?php
                                if (@$customer_title == "Mr") {
                                    echo "selected";
                                }
                                ?>>Mr.</option>
                                <option value="Mrs" <?php
                                if (@$customer_title == "Mrs") {
                                    echo "selected";
                                }
                                ?>>Mrs.</option>
                                <option value="Miss" <?php
                                if (@$customer_title == "Miss") {
                                    echo "selected";
                                }
                                ?>>Miss.</option>
                            </select>
                            <span class="text-danger"><?= @$message['customer_title'] ?></span>
                        </div>
                        <div class="form-group col-md-6 mt-3 mt-md-0">
                            <label for="first_name">First Name</label>
                            <input type="text" name="customer_firstname"
                                class="form-control border border-1 border-dark" value="<?= @$customer_firstname ?>"
                                placeholder="Enter your first name here">
                            <span class="text-danger"><?= @$message['customer_firstname'] ?></span>
                        </div>
                        <div class="form-group col-md-6 mt-3 mt-md-0">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control border border-1 border-dark" name="customer_lastname"
                                value="<?= @$customer_lastname ?>" placeholder="Enter your last name here">
                            <span class="text-danger"><?= @$message['customer_lastname'] ?></span>
                        </div>
                        <div class="form-group col-md-6 mt-3 mt-md-0">
                            <label for="last_name">ID Number</label>
                            <input type="text" class="form-control border border-1 border-dark" name="customer_nic"
                                value="<?= @$customer_nic ?>" placeholder="Enter your ID number here">
                            <span class="text-danger"><?= @$message['customer_nic'] ?></span>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="email">Email</label>
                        <input type="text" class="form-control border border-1 border-dark" name="customer_email"
                            value="<?= @$customer_email ?>" placeholder="Enter your email here">
                        <span class="text-danger"><?= @$message['customer_email'] ?></span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="address_line1">Address Line 1</label>
                        <input type="text" class="form-control border border-1 border-dark" name="customer_addressline1"
                            value="<?= @$customer_addressline1 ?>" id="address_line1"
                            placeholder="Enter your address here">
                        <span class="text-danger"><?= @$message['customer_addressline1'] ?></span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="address_line2">Address Line 2</label>
                        <input type="text" class="form-control border border-1 border-dark" name="customer_addressline2"
                            value="<?= @$customer_addressline2 ?>" id="address_line2"
                            placeholder="Enter your address here">
                        <span class="text-danger"><?= @$message['customer_addressline2'] ?></span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="mobno">Mobile No.</label>
                        <input type="text" class="form-control border border-1 border-dark" name="customer_mobilenumber"
                            value="<?= @$customer_mobilenumber ?>" id="mobile_no"
                            placeholder="Enter your mobile number here">
                        <span class="text-danger"><?= @$message['customer_mobilenumber'] ?></span>
                    </div>
                    <div class="form-group mt-3">
                        <label>Select Gender</label>
                        <div class="form-check">
                            <input class="form-check-input border border-1 border-dark" type="radio"
                                name="customer_gender" <?php if (isset($customer_gender) && $customer_gender == "male")
                                    echo "checked"; ?> id="male" value="male">
                            <label class="form-check-label" for="male">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input border border-1 border-dark" type="radio"
                                name="customer_gender" <?php if (isset($customer_gender) && $customer_gender == "female")
                                    echo "checked"; ?> id="female" value="female">
                            <label class="form-check-label" for="female">
                                Female
                            </label>
                        </div>
                        <div class="text-danger mt-4"><?= @$message['customer_gender'] ?></div>
                    </div>
                    <div class="form-group mt-3">
                        <?php
                        $db = dbConn();
                        $sqldistrict = "SELECT * FROM  districts";
                        $resultdistrict = $db->query($sqldistrict);
                        ?>
                        <label for="district">District</label>
                        <select name="customer_district" id="district"
                            class="form-select form-select-lg mb-3 border border-1 border-dark"
                            aria-label="Large select example">
                            <option value="">--</option>
                            <?php
                            while ($rowdistrict = $resultdistrict->fetch_assoc()) {
                                ?>
                                <option value="<?= $rowdistrict['Id'] ?>" <?= @$customer_district == $rowdistrict['Id'] ? 'selected' : '' ?>>
                                    <?= $rowdistrict['Name'] ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                        <span class="text-danger"><?= @$message['customer_district'] ?></span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="user_name">User Name</label>
                        <input type="text" class="form-control border border-1 border-dark" name="customer_username"
                            value="<?= @$customer_username ?>" id="user_name" placeholder="Enter a username here">
                        <span class="text-danger"><?= @$message['customer_username'] ?></span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control border border-1 border-dark" name="customer_password"
                            value="<?= @$customer_password ?>" id="password" placeholder="Enter a password here">
                        <span class="text-danger"><?= @$message['customer_password'] ?></span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="password">Confirm the Password</label>
                        <input type="password" class="form-control border border-1 border-dark"
                            name="customer_conpassword" value="<?= @$customer_conpassword ?>" id="cpassword"
                            placeholder="confirm the above entered password here">
                        <span class="text-danger"><?= @$message['customer_conpassword'] ?></span>
                    </div>
                    <div class="form-group mt-3">
                        <label>Customer Image</label><br>
                        <input type="file" name="customer_image" value="<?= @$customer_image ?>">
                        <span class="text-danger"><?= @$message['customer_image'] ?></span>
                    </div>
                    <div class="text-center"><button type="submit">Submit</button></div>
                </form>
            </div>

        </div>

        </div>

    </section><!-- End Contact Us Section -->
</main>
<?php
include 'footer.php';
?>