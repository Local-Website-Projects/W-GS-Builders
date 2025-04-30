<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once('includes/css.php');
    $sub_category_id = $_GET['sub_category_id'];
    $sql = "SELECT * FROM sub_categories,categories WHERE sub_categories.category_id = categories.category_id AND sub_categories.sub_category_id = '$sub_category_id'";
    $result =  mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    if (isset($_POST['update'])) {
        $category_id = $_POST["category_id"];
        $sub_category_name = $_POST["sub_category_name"];

        $update_sql = "UPDATE `sub_categories` SET `category_id`='$category_id',`sub_category_name`='$sub_category_name' WHERE sub_category_id = '$sub_category_id' ";

        $update_result = mysqli_query($con, $update_sql);
        if ($update_result == TRUE) {
            $_SESSION['msg'] = "";
            $_SESSION['status'] = "সফলভাবে আপডেট হয়েছে!";
            $_SESSION['status_code'] = "success";
            ?>
            <script>
                window.location.href = 'Add-Sub-Category';
            </script>
        <?php

        } else {
        $_SESSION['msg'] = "Sorry!";
        $_SESSION['status'] = "দুঃখিত কিছু ভুল হয়ে গেছে, আবার চেষ্টা করুন";
        $_SESSION['status_code'] = "error";
        ?>
            <script>
                window.location.href = 'Add-Sub-Category';
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
                                        <label for="simpleinput" class="form-label">প্রধান খাত*</label>
                                        <select name="category_id" class="form-select js-select2">
                                            <?php
                                            $fetch = "SELECT categories.category_id,categories.category_name FROM categories,admin_table where categories.admin_type = admin_table.admin_type and admin_table.admin_type = $admin_type";
                                            $result = mysqli_query($con, $fetch);
                                            while ($rows = mysqli_fetch_array($result)) {
                                                ?>
                                                <option value="<?php echo $rows['category_id']; ?>" <?php if ($rows['category_id'] == $row['category_id']) {
                                                    echo "selected";
                                                } else {
                                                    echo "";
                                                } ?>><?php echo $rows['category_name']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>উপ খা‌তের নাম</label>
                                        <input type="text" name="sub_category_name" value="<?php echo $row['sub_category_name']; ?>" class="form-control" pattern=".*\S+.*" />
                                    </div>
                                    <button type="submit" name="update" id="submit" class="btn btn-dark btn-block btn-rounded">Save Changes</button>
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