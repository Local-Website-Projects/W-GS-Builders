<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("includes/css.php");
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
                            <h4 class="page-title">খাত</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">খাত</h4>
                                <br>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#right-modal">খাত যুক্ত করুন</button>
                                <br><br>
                                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>ক্রম</th>
                                        <th>খাত</th>
                                        <th>দায়িত্বপ্রাপ্ত কর্মকর্তা</th>
                                        <th><i class="fa fa-pencil-square-o" aria-hidden="true"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query = "SELECT * FROM categories,admin_table where categories.admin_type = admin_table.admin_type ORDER BY category_id DESC";
                                    $data = mysqli_query($con, $query);
                                    $serial_no = 1;
                                    if (mysqli_num_rows($data) > 0) {
                                        while ($row = mysqli_fetch_assoc($data)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $serial_no; ?></td>
                                                <td><?php echo $row["category_name"]; ?></td>
                                                <td><?php echo $row["admin_name"]; ?></td>
                                                <td><a href="category_edit.php?category_id=<?php echo $row["category_id"]; ?>" class="btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                            </tr>
                                            <?php
                                            $serial_no++;
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>

                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
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

    <!-- Right modal content -->
    <div id="right-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-right">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <h4 class="mt-0 ml-3">খাত যুক্ত করুন</h4>
                        <form class="px-3" action="insert_category.php" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">খা‌তের নাম</label>
                                <input type="text" name="category_name" id="catName" placeholder="খা‌তের নাম" class="form-control" pattern=".*\S+.*" required />
                            </div>
                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">পদায়িত্বপ্রাপ্ত কর্মকর্তার নাম</label>
                                <select name="admin_type" class="form-select" required>
                                    <option value="" class="text-dark" disabled="disabled" selected="selected">পদায়িত্বপ্রাপ্ত কর্মকর্তার নাম</option>
                                    <?php
                                    $q = "SELECT `admin_name`, `admin_type` FROM `admin_table` where admin_type != 0 and admin_type != 999";
                                    $result = mysqli_query($con, $q);
                                    while ($rows = mysqli_fetch_array($result)) {
                                        ?>
                                        <option value="<?php echo $rows['admin_type']; ?>"><?php echo $rows['admin_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3 text-center">
                                <button class="ladda-button btn btn-info" name="addhead" id="addexpense" dir="ltr" data-style="expand-right">
                                    Submit
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


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