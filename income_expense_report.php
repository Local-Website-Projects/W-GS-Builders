<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $page = '';
    require_once('includes/css.php');
    $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
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

            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">আয়-খর‌চের রি‌পোর্ট</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">খর‌চের তালিকা</h4>
                                <br>
                                <form method="POST" action="category_wise_ie_report.php" target="_blank" id="validate_form">
                                    <div class="mb-3">
                                        <select name="category_id" class="form-select js-select2" style="width:100%;">
                                            <option disabled="disabled" selected="selected" value="">প্রধান খাত নির্বাচন করুন*</option>
                                            <?php
                                            if ($admin_type == 0 OR $admin_type == 999){
                                                $fetch = "SELECT * from categories";
                                            }else{
                                                $fetch = "SELECT * from categories,admin_table where categories.admin_type = $admin_type and categories.admin_type = admin_table.admin_type";
                                            }
                                            $result = mysqli_query($con, $fetch);
                                            while ($rows = mysqli_fetch_array($result)) {
                                                ?>
                                                <option value="<?php echo $rows['category_id']; ?>"><?php echo $rows['category_name']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <center><input type="submit" value="প্রধান খাত অনুযায়ী রি‌পোর্ট" name="submit" class="btn btn-info btn-rounded"></center>
                                </form>

                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                    <div class="col-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">খর‌চের তালিকা</h4>
                                <br>
                                <form method="POST" action="sub_category_wise_ie_report.php" target="_blank" id="validate_form">
                                    <div class="mb-3">
                                        <select name="sub_category_id" class="form-select js-select2" style="width:100%;">
                                            <option disabled="disabled" selected="selected" value="">উপ খাত/খর‌চের বিবরণ নির্বাচন করুন*</option>
                                            <?php
                                            if ($admin_type == 0 OR $admin_type == 999){
                                                $fetch = "SELECT * from sub_categories";
                                            }else{
                                                $fetch = "SELECT * from sub_categories,categories where categories.admin_type = $admin_type AND sub_categories.category_id = categories.category_id";
                                            }

                                            $result = mysqli_query($con, $fetch);
                                            while ($rows = mysqli_fetch_array($result)) {
                                                ?>
                                                <option value="<?php echo $rows['sub_category_id']; ?>"><?php echo $rows['sub_category_name']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <center><input type="submit" value="উপ খাত অনুযায়ী ‌রি‌পোর্ট" name="submit" class="btn btn-info btn-rounded"></center>
                                </form>

                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>

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
        include("includes/js.php");
        ?>


</body>

</html>