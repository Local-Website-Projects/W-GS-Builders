<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php
require 'config/dbconfig.php';
$query = "SELECT * FROM `setting`";
$data = mysqli_query($con, $query);
$total = mysqli_num_rows($data);
$title = "";
$logo = "";
$favicon = "";
$office_name = "";
$ofiice_address = "";
$office_contact_no = "";
$office_email = "";
$start_time = "";
$end_time = "";
$est_year = "";
$contact_us = "";
$about_us = "";
$privacy_policy = "";
$terms = "";
if ($total != 0) {
    while ($result = mysqli_fetch_assoc($data)) {
        $title = $result['title'];
        $favicon = $result['favicon'];
        $logo = $result['logo'];
        $office_name = $result['office_name'];
        $ofiice_address = $result['ofiice_address'];
        $contact_us = $result['contact_us'];
        $about_us = $result['about_us'];
        $privacy_policy = $result['privacy_policy'];
        $terms = $result['terms'];
        $office_contact_no = $result['office_contact_no'];
        $start_time = $result['start_time'];
        $end_time = $result['end_time'];
        $office_email = $result['office_email'];
        $est_year = $result['est_year'];
    }
} else {
    "No Records Found!!!";
}
$error_msg = '';
if (isset($_POST['login'])) {
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $admin_email = mysqli_real_escape_string($con, $admin_email);
    $admin_password = mysqli_real_escape_string($con, $admin_password);
    $hashkey = "manageoffice";
    $hashpass = hash('gost', $admin_password . $hashkey);

    $query = "SELECT unique_id,admin_password,admin_type,admin_name FROM admin_table where admin_email = '$admin_email' and admin_password= '$hashpass'";
    $data = mysqli_query($con, $query);
    $total = mysqli_num_rows($data);

    $unique_id = "";

    $admin_type = "";
    if ($total != 0) {
        while ($result = mysqli_fetch_assoc($data)) {
            $unique_id = $result['unique_id'];

            $admin_type = $result['admin_type'];

            $admin_name = $result['admin_name'];
        }
    } else {
        "No Records Found!!!";
    }

    $sql = "SELECT unique_id,admin_password,admin_type from admin_table where admin_email = '$admin_email' and admin_password= '$hashpass' ";

    $login_match_query = mysqli_query($con, $sql);

    $row = mysqli_num_rows($login_match_query);

    if ($row == 1) {
        $_SESSION['unique_id'] = $unique_id;
        $_SESSION['admin_type'] = $admin_type;
        if ($admin_type == 0 or $admin_type == 999) {
            $_SESSION['status'] = "স্বাগতম!";
            $_SESSION['status_code'] = "success";
            ?>
        <script>
            window.location.href = "Dashboard";
        </script>
    <?php
        } else {
            $_SESSION['status'] = "স্বাগতম!";
            $_SESSION['status_code'] = "success";
            ?>
        <script>
            window.location.href = "Add-Sub-Category";
        </script>
    <?php
        }
    } else if ($_POST['admin_email'] != $_POST['admin_password']) {
        $error_msg = '<i class="fa fa-exclamation-triangle" aria-hidden="true">&nbsp;ই‌মেইল অথবা পাসওয়ার্ড স‌ঠিক নয়, পুনরায় চেষ্টা করুন</i> ';
    }
}
?>
<head>
    <meta charset="utf-8"/>
    <title>নেজারত শাখা, জেলা প্রশাসকের কার্যালয় খুলনা।</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo $favicon?>">

    <!-- App css -->
    <link href="assets/css/config/default/bootstrap.min.css" rel="stylesheet" type="text/css"
          id="bs-default-stylesheet"/>
    <link href="assets/css/config/default/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet"/>

    <link href="assets/css/config/default/bootstrap-dark.min.css" rel="stylesheet" type="text/css"
          id="bs-dark-stylesheet"/>
    <link href="assets/css/config/default/app-dark.min.css" rel="stylesheet" type="text/css"
          id="app-dark-stylesheet"/>

    <!-- icons -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <style>
        html,body{
            height: 100%;
        }
        body {
            background: url("background.jpg");
            background-position: center center;
            background-repeat:  no-repeat;
            background-attachment: fixed;
            background-size:  cover;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>

<body class="loading auth-fluid-pages pb-0">

<div class="auth-fluid">
    <!--Auth fluid left content -->
    <div class="auth-fluid-form-box">
        <div class="align-items-center d-flex h-100">
            <div class="card-body">

                <!-- Logo -->
                <div class="auth-brand text-center text-lg-start">
                    <div class="auth-logo">
                        <a href="index.html" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="<?php echo $logo; ?>" alt="" height="80">
                                    </span>
                        </a>
                        <h4>জেলা প্রশাসকের কার্যালয়, খুলনা</h4>


                    </div>
                </div>

                <!-- title-->
                <h4 class="mt-0">Sign In</h4>
                <p class="text-muted mb-4">Enter your email address and password to access account.</p>

                <!-- form -->
                <form action="#" method="post">
                    <div class="mb-3">
                        <label for="emailaddress" class="form-label">Email address</label>
                        <input class="form-control" name="admin_email" type="email" id="emailaddress" required=""
                               placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <a href="#" class="text-muted float-end"><small>Forgot your
                                password?</small></a>
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" name="admin_password" id="password" class="form-control"
                                   placeholder="Enter your password">
                            <div class="input-group-text" data-password="false">
                                <span class="fas fa-eye"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkbox-signin">
                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                        </div>
                    </div>
                    <div class="text-center d-grid">
                        <button class="btn btn-primary" name="login" type="submit">Log In</button>
                    </div>
                    <!-- social-->
                </form>
                <!-- end form-->

                <!-- Footer-->
                <footer class="footer footer-alt">
                    <p class="text-muted">Developed with <a href="https://frogbid.com/" class="text-muted ms-1"><b>FrogBid</b></a>
                    </p>
                </footer>

            </div> <!-- end .card-body -->
        </div> <!-- end .align-items-center.d-flex.h-100-->
    </div>
    <!-- end auth-fluid-form-box-->
</div>
<!-- end auth-fluid-->

<!-- Vendor js -->
<script src="assets/js/vendor.min.js"></script>

<!-- App js -->
<script src="assets/js/app.min.js"></script>

</body>
</html>
