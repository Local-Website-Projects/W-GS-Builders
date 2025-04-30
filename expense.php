<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once('includes/css.php');
    if (isset($_POST['addexpense'])) {
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $category_id = $_POST['category_id'];
        $sub_category_id = $_POST['sub_category_id'];
        $proposed_amount = $_POST['proposed_amount'];
        $expense_amount = $_POST['expense_amount'];
        $amount = $_POST['amount'];
        $due_amount = $_POST['due_amount'];
        $expense_date = $_POST['expense_date'];
        $expense_note = $_POST['expense_note'];
        $entry_date = $dt->format('Y-m-d');
        $comment = $_POST['comment'];


        $sql = "INSERT INTO `expenses`(`category_id`, `sub_category_id`, `proposed_amount`, `expense_amount`, `amount`, `due_amount`, `expense_date`, `expense_note`, `entry_date`, `comment`) VALUES ('$category_id','$sub_category_id','$proposed_amount','$expense_amount','$amount','$due_amount','$expense_date','$expense_note','$entry_date','$comment')";
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
                                <br>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#bs-example-modal-lg">খরচ যুক্ত করুন
                                </button>
                                <br><br>
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
    <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">খরচ যুক্ত করুন</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="validate_form" class="p-3" method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>প্রধান খাত<b class="text-danger">(*)</b></label>
                                <select name="category_id" class="form-select" onchange="categoryName(this.value);"
                                        required>
                                    <option disabled="disabled" selected="selected" value="">প্রধান খাত নির্বাচন করুন*
                                    </option>
                                    <?php
                                    if ($admin_type == 0) {
                                        $fetch = "SELECT * from categories";
                                    } else {
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
                                <select class="form-select" name="sub_category_id" id="subcategory" required>
                                    <option class="text-dark" disabled="disabled" selected="selected">উপ খাত নির্বাচন
                                        করুন
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>দা‌খিলকৃত বিল <strong class="text-danger">(অবশ্যই ইং‌রে‌জি হর‌ফে)</strong></label>
                                <input type="number" name="proposed_amount" id="proposed_amount" value="<?php echo $row['proposed_amount']; ?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>প্রস্তা‌বিত বিল<strong class="text-danger">(অবশ্যই ইং‌রে‌জি হর‌ফে)</strong></label>
                                <input type="number" name="expense_amount" id="expense_amount" value="<?php echo $row['expense_amount']; ?>" onkeyup="expenseBill(this.value);" onkeydown="expenseBill(this.value);" class="form-control" required>
                                <span id="expense_bill"></span>
                            </div>
                            <div class="mb-3">
                                <label>প‌রি‌শো‌ধিত বিল <strong class="text-danger">(অবশ্যই ইং‌রে‌জি হর‌ফে)</strong></label>
                                <input type="number" name="amount" id="amount" value="<?php echo $row['amount']; ?>" onkeyup="bill(this.value);" onkeydown="bill(this.value);" class="form-control" required>
                                <span id="amount_bill"></span>
                            </div>
                            <div class="mb-3">
                                <label>বকেয়া বিল <strong class="text-danger">(অবশ্যই ইং‌রে‌জি হর‌ফে)</strong></label>
                                <input type="number" name="due_amount" id="due_amount" value="<?php echo $row['due_amount']; ?>" class="form-control" required readonly>
                            </div>
                            <div class="mb-3">
                                <label>তা‌রিখ<b class="text-danger">(*)</b></label>
                                <?php
                                $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                ?>
                                <input type="date" name="expense_date" value="<?php echo $dt->format('Y-m-d'); ?>"
                                       class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>খরচের বিবরন</label>
                                <textarea name="expense_note" rows="4" cols="50" class="form-control"
                                          placeholder="কেন খরচ হ‌য়ে‌ছে সেটা বর্ণনা করুন"></textarea>
                            </div>
                            <div class="mb-3">
                                <label>মন্তব্য</label>
                                <textarea name="comment" rows="4" cols="50" class="form-control"
                                          placeholder="মন্তব্য"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="ladda-button btn btn-info" name="addexpense" id="addexpense" dir="ltr"
                                    data-style="expand-right">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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
        function bill(value){

            let expense_amount=parseFloat(document.getElementById("expense_amount").value);
            if (expense_amount<parseFloat(value)){
                document.getElementById("addexpense").disabled = true;
                document.getElementById("amount_bill").innerHTML = "পরিশোধিত বিল প্রস্তাবিত দিল আপক্ষা বেশি হয়েছে।"+expense_amount;

            }else{
                document.getElementById("addexpense").disabled = false;
                let amount=parseFloat(document.getElementById("amount").value);
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