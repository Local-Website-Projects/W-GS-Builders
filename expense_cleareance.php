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
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">বকেয়া পরিশোধ করুন</h4>
                                <br>
                                <form method="POST" action="money_give.php" id="validate_form">
                                    <div class="row">
                                        <div class="mt-3 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
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
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="name">তারিখ থেকে</label>
                                                <input type="date" name="fromdate" class="form-control" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="name">তারিখ পর্যন্ত</label>
                                                <input type="date" name="todate" class="form-control" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <center><input type="submit" value="বকেয়া পরিশোধ করুন" name="submit" class="btn btn-info btn-rounded"></center>
                                </form>

                            </div> <!-- end card body-->
                        </div>
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
        <?php
        if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
            ?>
            <script>
                swal.fire({
                    position: 'top-end',
                    icon: "<?php echo $_SESSION['status_code']; ?>",
                    title: "<?php echo $_SESSION['status']; ?>",
                    showConfirmButton: false,
                    timer: 4000
                });
            </script>
            <?php
            unset($_SESSION['status']);
        }
        ?>


</body>

</html>