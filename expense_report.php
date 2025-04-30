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
                            <h4 class="page-title">খর‌চের রি‌পোর্ট</h4>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 text-center">
                    <div class="col-4 col-md-4 col-sm-12">
                        <a href="expense_report_daily.php" class="btn btn-outline-primary btn-rounded waves-effect waves-light" target="_blank">আজ‌কের রি‌পোর্ট (<?php echo $dt->format('Y-m-d'); ?>)</a>
                    </div>
                    <div class="col-4 col-md-4 col-sm-12">
                        <a href="expense_report_monthly.php" class="btn btn-outline-secondary btn-rounded waves-effect waves-light" target="_blank">চল‌তি মা‌সের রি‌পোর্ট (<?php echo $dt->format('F'); ?>)</a>
                    </div>
                    <div class="col-4 col-md-4 col-sm-12">
                        <a href="expense_report_yearly.php" class="btn btn-outline-blue btn-rounded waves-effect waves-light" target="_blank">চল‌তি বছ‌রের রি‌পোর্ট (<?php echo $dt->format('Y'); ?>)</a>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">খর‌চের তালিকা</h4>
                                <br>
                                <form method="POST" action="category_wise_report.php" target="_blank" id="validate_form">
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
                                <form method="POST" action="sub_category_wise_report.php" target="_blank" id="validate_form">
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

                <div class="row">
                    <div class="col-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">তারিখ অনুসারে প্রধান খাতের রিপোর্ট</h4>
                                <br>
                                <form method="POST" action="datewise_category_report.php" target="_blank" id="validate_form">
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
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">তারিখ থেকে</label>
                                        <input type="date" name="fromdate" class="form-control" autocomplete="off" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">তারিখ পর্যন্ত</label>
                                        <input type="date" name="todate" class="form-control" autocomplete="off" required>
                                    </div>
                                    <center><input type="submit" value="তারিখ অনুসারে প্রধান খাতের রিপোর্ট" name="submit" class="btn btn-info btn-rounded"></center>
                                </form>

                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div>
                    <div class="col-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">তারিখ অনুসারে উপখাতের রিপোর্ট</h4>
                                <br>
                                <form method="POST" action="datewise_subcategory_report.php" target="_blank" id="validate_form">
                                    <div class="mb-3">
                                        <select name="sub_category_id" class="form-select js-select2" style="width:100%;">
                                            <option disabled="disabled" selected="selected" value="">উপ খাত নির্বাচন করুন*</option>
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
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">তারিখ থেকে</label>
                                        <input type="date" name="fromdate" class="form-control" autocomplete="off" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">তারিখ পর্যন্ত</label>
                                        <input type="date" name="todate" class="form-control" autocomplete="off" required>
                                    </div>
                                    <center><input type="submit" value="তারিখ অনুসারে উপখাতের রিপোর্ট" name="submit" class="btn btn-info btn-rounded"></center>
                                </form>

                            </div> <!-- end card body-->
                    </div>
                </div>

            </div> <!-- content -->
<?php if($admin_type ==0 OR $admin_type == 999){?>
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">তারিখ অনুসারে উপখাতের রিপোর্ট</h4>
                            <br>
                            <form method="POST" action="datewise_expense_report.php" target="_blank" id="validate_form">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="name">তারিখ থেকে</label>
                                            <input type="date" name="fromdate" class="form-control" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="name">তারিখ পর্যন্ত</label>
                                            <input type="date" name="todate" class="form-control" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <center><input type="submit" value="তা‌রিখ অনুযায়ী রি‌পোর্ট" name="submit" class="btn btn-info btn-rounded"></center>
                            </form>

                        </div> <!-- end card body-->
                    </div>
                </div>
<?php
}
?>

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