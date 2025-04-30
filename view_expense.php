<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once('includes/css.php');
    /*Delete Query*/
    if (isset($_POST['DeleteUserbtn'])) {
        $delete_id = $_POST['delete_id'];
        $sql = "DELETE FROM `expenses` WHERE expense_id = $delete_id ";
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
                            <h4 class="page-title">খরচ</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">খর‌চের তালিকা</h4>
                                <br><br>
                                <table id="basic-datatable" class="table table-responsive dt-responsive nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th><i class="fa fa-trash" aria-hidden="true"></i></th>
                                        <th><i class="fa fa-pencil-square-o" aria-hidden="true"></i></th>
                                        <th>অবস্থা</th>
                                        <th>ক্রম</th>
                                        <th>তা‌রিখ</th>
                                        <th>প্রধান খাত</th>
                                        <th>উপখাতের নাম</th>
                                        <th>দা‌খিলকৃত বিল</th>
                                        <th>প্রস্তা‌বিত বিল</th>
                                        <th>প‌রি‌শো‌ধিত বিল</th>
                                        <th>বকেয়া বিল</th>
                                        <th>খর‌চের বিবরণ</th>
                                        <th>মন্তব্য</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ($admin_type == 0) {
                                        $query = "SELECT * FROM expenses,categories,sub_categories WHERE expenses.category_id = categories.category_id AND expenses.sub_category_id = sub_categories.sub_category_id ORDER BY expenses.expense_date DESC limit 100";
                                    } else {
                                        $month = date('m');
                                        $query = "SELECT * FROM expenses, categories, sub_categories, admin_table WHERE expenses.category_id = categories.category_id AND categories.admin_type = '1' AND categories.admin_type = admin_table.admin_type AND expenses.sub_category_id = sub_categories.sub_category_id AND expenses.expense_date >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) ORDER BY expenses.expense_date DESC";

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
                                            <tr>
                                                <td>
                                                    <button type="button" value="<?php echo $row["expense_id"]; ?>"
                                                            class="btn deletebtn"><i class="fa fa-trash"
                                                                                     aria-hidden="true"></i></button>
                                                </td>
                                                <td>
                                                    <a href="expense_edit.php?expense_id=<?php echo $row["expense_id"]; ?>"
                                                       class="btn" target="_blank"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i></a></td>
                                                <?php
                                                if ($row["due_amount"] > 0) {
                                                    ?>
                                                    <td><span class="badge badge-outline-danger">বকেয়া</span></td>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <td><span class="badge badge-outline-success">নগদ ক্রয়</span></td>
                                                    <?php
                                                }
                                                ?>
                                                <td><?php echo $serial_no; ?></td>
                                                <td><?php echo date_format(date_create_from_format('Y-m-d', $row["expense_date"]), 'd-m-Y'); ?></td>
                                                <td><?php echo $row["category_name"]; ?></td>
                                                <td><?php echo $row["sub_category_name"]; ?></td>
                                                <td><?php echo number_format($row["proposed_amount"], 2); ?></td>
                                                <td><?php echo number_format($row["expense_amount"], 2); ?></td>
                                                <td><?php echo number_format($row["amount"], 2); ?></td>
                                                <td><?php echo number_format($row["due_amount"], 2); ?></td>
                                                <td><?php echo $row["expense_note"]; ?></td>
                                                <td><?php echo $row["comment"]; ?></td>
                                                <?php $pa = $row["proposed_amount"]; ?>
                                                <?php $ea = $row["expense_amount"]; ?>
                                            </tr>
                                            <?php
                                            $serial_no++;
                                            $totalpa += $pa;
                                            $totalea += $ea;
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
                success: function (result) {
                    $('#subcategory').html(result);
                }
            });
        }
    </script>

    <!-- delete modal js code start here -->
    <script>
        $(document).ready(function () {
            $('.deletebtn').click(function (e) {
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
    <script>
        function bill(value) {

            let expense_amount = parseFloat(document.getElementById("expense_amount").value);
            if (expense_amount < parseFloat(value)) {
                document.getElementById("addexpense").disabled = true;
                document.getElementById("amount_bill").innerHTML = "পরিশোধিত বিল প্রস্তাবিত দিল আপক্ষা বেশি হয়েছে।" + expense_amount;

            } else {
                document.getElementById("addexpense").disabled = false;
                let amount = parseFloat(document.getElementById("amount").value);
                let due_amount = expense_amount - amount;
                document.getElementById("amount_bill").innerHTML = "";
                document.getElementById("due_amount").value = due_amount;
            }
        }
    </script>
    <script>
        function expenseBill(value) {
            let proposed_amount = parseFloat(document.getElementById("proposed_amount").value);
            if (proposed_amount < parseFloat(value)) {
                document.getElementById("addexpense").disabled = true;
                document.getElementById("expense_bill").innerHTML = "প্রস্তা‌বিত বিল দাখিলকৃত দিল আপক্ষা বেশি হয়েছে।";

            } else {
                document.getElementById("addexpense").disabled = false;
                document.getElementById("expense_bill").innerHTML = "";
            }
        }
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