<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once('includes/css.php');
    ?>

</head>

<!-- body start -->
<body class="loading"
      data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

<!-- Begin page -->
<div id="wrapper">
    <!-- Topbar Start -->
    <?php
    include("includes/topbar.php");
    ?>
    <!-- end Topbar -->
    <!-- ========== Left Sidebar Start ========== -->
    <?php
    include("includes/sidebar.php");
    ?>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">পাসওয়ার্ড</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">পাসওয়ার্ড পরিবর্তন</h4>
                            <br>

                            <div class="row">
                                <form action="update/updatepassword.php" method="POST" class="p-2">
                                    <div class="mb-3">
                                        <label class="font-weight-bold">Old Password*</label>
                                        <input type="password" id="password" name="oldpwd" minlength="6" class="form-control" placeholder="old password" autocomplete="off" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="font-weight-bold">New password*</label>
                                        <input type="password" id="cpassword" name="newpwd" minlength="6" class="form-control" minlength="3" placeholder="new password" autocomplete="off" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="font-weight-bold">Confirm Password*</label>
                                        <input type="password" id="ccpassword" name="confrmpwd" minlength="6" class="form-control" placeholder="confirm password" autocomplete="off" required>
                                    </div>
                                    <input type="submit" name="passwordupdate" class="btn btn-outline-primary btn-rounded waves-effect waves-light" value="Submit">
                                </form>
                            </div>
                            <!-- end row-->

                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div>

        </div> <!-- content -->

        <!-- Footer Start -->
        <?php
        include("includes/footer.php");
        ?>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

<!-- Vendor js -->
<?php
include ("includes/js.php");
?>

</body>

</html>