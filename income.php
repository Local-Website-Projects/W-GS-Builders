<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $page = '';
    require_once('includes/css.php');
    if (isset($_POST['addincome'])) {
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $category_id = $_POST['category_id'];
        $sub_category_id = $_POST['sub_category_id'];
        $proposed_amount = $_POST['proposed_amount'];
        $expense_date = $_POST['expense_date'];
        $expense_note = $_POST['expense_note'];
        $comment = $_POST['comment'];
        $entry_date = $dt->format('Y-m-d');

        $sql = "INSERT INTO `incomes`(`cat_id`, `sub_cat_id`, `amount`, `date`, `description`, `entry_date`,`comment`) VALUES ('$category_id','$sub_category_id','$proposed_amount','$expense_date','$expense_note','$entry_date','$comment')";
        $result = mysqli_query($con, $sql);
        if ($result == true) {
            $_SESSION['msg'] = "";
            $_SESSION['status'] = "সফলভা‌বে যুক্ত হ‌য়ে‌ছে!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['msg'] = "Sorry!";
            $_SESSION['status'] = "দুঃখিত কিছু ভুল হয়েছে, আবার চেষ্টা করুন";
            $_SESSION['status_code'] = "error";
        }
    }
    /*Delete Query*/
    if (isset($_POST['DeleteUserbtn'])) {
        $delete_id = $_POST['delete_id'];
        $sql = "DELETE FROM `incomes` WHERE income_id = $delete_id ";
        $result = mysqli_query($con, $sql);
        if ($result == true) {
            $_SESSION['msg'] = "";
            $_SESSION['status'] = "সফলভা‌বে ডিলিট হ‌য়ে‌ছে!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['msg'] = "Sorry!";
            $_SESSION['status'] = "দুঃখিত কিছু ভুল হয়েছে, আবার চেষ্টা করুন";
            $_SESSION['status_code'] = "error";
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

            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">আয়</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">আয়ের তালিকা</h4>
                                <br>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg">আয় যুক্ত করুন</button>
                                <br><br>
                                <table id="basic-datatable" class="table table-responsive dt-responsive nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th><i class="fa fa-trash" aria-hidden="true"></i></th>
                                        <th><i class="fa fa-pencil-square-o" aria-hidden="true"></i></th>
                                        <th>ক্রম</th>
                                        <th>প্রধান খাত</th>
                                        <th>উপখাতের নাম</th>
                                        <th>তা‌রিখ</th>
                                        <th>বরাদ্দের পরিমান</th>
                                        <th>আয়ের বিবরণ</th>
                                        <th>মন্তব্য</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if($admin_type == 0)
                                    {
                                        $query = "SELECT * FROM incomes,categories,sub_categories WHERE incomes.cat_id = categories.category_id AND incomes.sub_cat_id = sub_categories.sub_category_id ORDER BY incomes.date DESC";
                                    }else{
                                        $query = "SELECT * FROM incomes,categories,sub_categories,admin_table WHERE incomes.cat_id = categories.category_id AND categories.admin_type=$admin_type AND categories.admin_type= admin_table.admin_type AND incomes.sub_cat_id = sub_categories.sub_category_id ORDER BY incomes.date DESC";
                                    }
                                    $data = mysqli_query($con, $query);
                                    $serial_no = 1;
                                    $pa = 0;
                                    $ea = 0;
                                    $totalpa = 0;
                                    $totalea = 0;
                                    if (mysqli_num_rows($data) > 0) {
                                        while ($row = mysqli_fetch_assoc($data)) {
                                            ?>
                                            <tr><td> <button type="button" value="<?php echo $row["income_id"]; ?>" class="btn deletebtn"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                                                <td><a href="income_edit.php?income_id=<?php echo $row["income_id"]; ?>" class="btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                                <td><?php echo $serial_no; ?></td>
                                                <td><?php echo $row["category_name"]; ?></td>
                                                <td><?php echo $row["sub_category_name"]; ?></td>
                                                <td><?php echo date_format(date_create_from_format('Y-m-d', $row["date"]), 'd-m-Y'); ?></td>
                                                <td><?php echo number_format($row["amount"], 2); ?></td>
                                                <td><?php echo $row["description"]; ?></td>
                                                <td><?php echo $row["comment"]; ?></td>
                                                <?php $pa = $row["amount"]; ?>
                                                </tr>
                                            <?php
                                            $serial_no++;
                                            $totalpa += $pa;
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

    <!--  Modal content for the Large example -->
    <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">আয় যুক্ত করুন</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="validate_form" class="p-3" method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>প্রধান খাত(*)</label>
                                <select name="category_id" class="form-select" style="width:100%;" onchange="categoryName(this.value);" required>
                                    <option disabled="disabled" selected="selected" value="">প্রধান খাত নির্বাচন করুন*</option>
                                    <?php
                                    if ($admin_type == 0){
                                        $fetch = "SELECT * from categories";
                                    }else{
                                        $fetch = "SELECT * from categories where categories.admin_type = $admin_type";
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
                                <label>উপ খাত<b class="text-danger">(*)</b></label>
                                <select class="form-select" style="width:100%;" name="sub_category_id" id="subcategory" required>
                                    <option class="text-dark" disabled="disabled" selected="selected">উপ খাত নির্বাচন করুন</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>আয়/বরাদ্দের পরিমান <strong class="text-danger">(অবশ্যই ইং‌রে‌জি হর‌ফে)</strong></label>
                                <input type="text" name="proposed_amount" placeholder="আয়/বরাদ্দের পরিমান" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>তা‌রিখ(*)</label>
                                <?php
                                $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                ?>
                                <input type="date" name="expense_date" value="<?php echo $dt->format('Y-m-d'); ?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>আয়ের বিবরন(*)</label>
                                <textarea name="expense_note" rows="4" cols="50" class="form-control" placeholder="বর্ণনা করুন"></textarea>
                            </div>
                            <div class="mb-3">
                                <label>মন্তব্য</label>
                                <textarea name="comment" rows="4" cols="50" class="form-control" placeholder="মন্তব্য"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="ladda-button btn btn-info" name="addincome" id="addexpense" dir="ltr" data-style="expand-right">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        $(document).ready(function() {
            $('.deletebtn').click(function(e) {
                e.preventDefault();
                var user_id = $(this).val();
                console.log(user_id);
                $('.delete_user_id').val(user_id);
                $('#DeleteModal').modal('show');
            });
        });
    </script>
    <!-- delete modal js code end here -->

    <!--Delete modal starts here-->
    <div class="modal" id="DeleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">খরচ মুছে ফেলুন</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" method="POST">
                    <div class="modal-body">
                        <input type="text" name="delete_id" class="delete_user_id" hidden>
                        <p>
                            আপনি কি নিশ্চিত??
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">না</button>
                        <button type="submit" name="DeleteUserbtn" class="btn btn-danger">হ্যাঁ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- delete modal js code start here -->


    <!-- Vendor js -->
    <?php
    include("includes/js.php");
    ?>
    <!--- alert pop up area --->
    <?php
    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
        ?>
        <script>
            toastr.<?php echo $_SESSION['status_code']; ?>("<?php echo $_SESSION['status']; ?>", "<?php echo $_SESSION['msg']; ?>", {
                progressBar: !0
            });
        </script>
        <?php
        unset($_SESSION['status']);
    }
    ?>
    <!--- alert pop up end--->
    <script type="text/javascript">
        function categoryName(subcatvalue) {
            $.ajax({

                url: 'fetch_sub_category.php',
                type: 'POST',
                data: {
                    thissubcategory: subcatvalue
                },
                success: function(result) {
                    $('#subcategory').html(result);
                }
            });
        }
    </script>

</body>

</html>