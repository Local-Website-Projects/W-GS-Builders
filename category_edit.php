<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once('includes/css.php');
    $category_id = $_GET['category_id'];
    $sql = "SELECT * FROM categories WHERE category_id = '$category_id'";
    $result =  mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    if (isset($_POST['update'])) {
        $category_name = $_POST["category_name"];
        $admin_type = $_POST["admin_type"];

        $update_sql = "UPDATE `categories` SET `category_name`='$category_name', `admin_type`= '$admin_type' WHERE category_id = '$category_id'";
        $update_result = mysqli_query($con, $update_sql);
        if ($update_result == TRUE) {
            $_SESSION['msg'] = "";
            $_SESSION['status'] = "সফলভাবে আপডেট হয়েছে!";
            $_SESSION['status_code'] = "success";
            ?>
            <script>
                window.location.href = 'Add-Category';
            </script>
        <?php

        } else {
        $_SESSION['msg'] = "";
        $_SESSION['status'] = "দুঃখিত কিছু ভুল হয়ে গেছে, আবার চেষ্টা করুন";
        $_SESSION['status_code'] = "error";
        ?>
            <script>
                window.location.href = 'Add-Category';
            </script>
            <?php
        }
    }
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
                        <h4 class="page-title">খাত</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">প্রধান খা‌তের তথ্য আপডেট করুন।</h4>
                            <br>

                            <div class="row">
                                    <form method="post">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">খা‌তের নাম*</label>
                                            <input type="text" name="category_name" value="<?php echo $row['category_name'] ?>" class="form-control" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-select" class="form-label">দায়িত্বপ্রাপ্ত কর্মকর্তার নাম</label>
                                            <select name="admin_type" class="form-select js-select2" required>
                                                <?php
                                                $admin_type = $row['admin_type'];
                                                $query = "SELECT `category_name`, `admin_type` FROM `categories` WHERE categories.admin_type = $admin_type";
                                                $result1 = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result)){
                                                    ?>
                                                    <option value="<?php echo $row['admin_type'];?>" class="text-dark" disabled="disabled" selected="selected"><?php echo $row['category_name']?></option>
                                                    <?php
                                                }
                                                $q = "SELECT `admin_name`, `admin_type` FROM `admin_table`";
                                                $result = mysqli_query($con, $q);
                                                while ($rows = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <option value="<?php echo $rows['admin_type']; ?>"><?php echo $rows['admin_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="button-list">
                                            <button type="submit" name="update" class="btn btn-outline-success btn-rounded waves-effect waves-light">Success</button>
                                        </div>
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