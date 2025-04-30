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
                            <h4 class="page-title">উপখা‌ত</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">উপখা‌ত</h4>
                                <br>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#con-close-modal">উপখা‌ত যুক্ত করুন</button>
                                <br><br>
                                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>ক্রম</th>
                                        <th>উপ খা‌তের নাম</th>
                                        <th>প্রধান খাতের নাম</th>
                                        <th><i class="fa fa-pencil-square-o" aria-hidden="true"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ($admin_type == 0){
                                        $query = "SELECT * FROM sub_categories,categories WHERE sub_categories.category_id = categories.category_id ORDER BY sub_categories.sub_category_id DESC";
                                    }else{
                                        $query = "SELECT * FROM sub_categories,categories,admin_table WHERE sub_categories.category_id = categories.category_id AND categories.admin_type = admin_table.admin_type and admin_table.admin_type = $admin_type ORDER BY sub_categories.sub_category_id DESC";
                                    }
                                    $data = mysqli_query($con, $query);
                                    $serial_no = 1;
                                    if (mysqli_num_rows($data) > 0) {
                                        while ($row = mysqli_fetch_assoc($data)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $serial_no; ?></td>
                                                <td><?php echo $row["sub_category_name"]; ?></td>
                                                <td><?php echo $row["category_name"]; ?></td>
                                                <td><a href="sub_category_edit.php?sub_category_id=<?php echo $row["sub_category_id"]; ?>" class="btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
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

    <!-- sample modal content -->
    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal Content is Responsive</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="insert_sub_category.php" id="validate_form" class="p-3" method="POST">
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="add_sub_category_field">
                                <thead>
                                <tr>
                                    <td>প্রধান খাত</td>
                                    <td>
                                        <select name="category_id" class="form-select" required>
                                            <option value="" class="text-dark" disabled="disabled" selected="selected">প্রধান খাত নির্বাচন করুন</option>
                                            <?php
                                            if ($admin_type == 0){
                                                $q = "SELECT categories.category_id,categories.category_name FROM categories";
                                            }else{
                                                $q = "SELECT categories.category_id,categories.category_name,admin_table.admin_type FROM categories,admin_table where categories.admin_type = admin_table.admin_type and admin_table.admin_type = $admin_type";
                                            }
                                            $result = mysqli_query($con, $q);
                                            while ($rows = mysqli_fetch_array($result)) {
                                                ?>
                                                <option value="<?php echo $rows['category_id']; ?>"><?php echo $rows['category_name']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>উপ খা‌তের নাম</td>
                                    <td>আরো যোগ করুন</td>
                                </tr>
                                </thead>
                                <tr>
                                    <td><input type="text" name="sub_category_name[]" id="subcatName" placeholder="উপ খা‌তের নাম" class="form-control" required /></td>
                                    <td><button type="button" name="addSubCategory" id="addSubCategory" class="btn btn-dark btn-rounded"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="ladda-button btn btn-info" name="addhead" id="addexpense" dir="ltr" data-style="expand-right">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->


    <!-- Vendor js -->
    <?php
    include("includes/js.php");
    ?>
    <script>
        $(document).ready(function() {
            var i = 1;
            $('#addSubCategory').click(function() {
                var cName = document.getElementById('subcatName').value;
                if (cName == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Sorry! At least one Sub category name name is required!'
                    });
                } else {
                    i++;
                    $('#add_sub_category_field').append('<tr id="row' + i + '"><td><input type="text" name="sub_category_name[]" placeholder="উপ খা‌তের নাম" class="form-control" /></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove btn-rounded"><i class="fa fa-times" aria-hidden="true"></i></button></td></tr>');
                }
            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
        });
    </script>

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