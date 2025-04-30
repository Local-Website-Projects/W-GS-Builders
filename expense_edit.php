<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once('includes/css.php');
    $expense_id = $_GET['expense_id'];
    $sql = "SELECT * FROM expenses,categories,sub_categories WHERE expenses.category_id = categories.category_id AND expenses.sub_category_id = sub_categories.sub_category_id AND expenses.expense_id = '$expense_id'";
    $result =  mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    if (isset($_POST['update'])) {
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $category_id = $_POST['category_id'];
        $sub_category_id = $_POST['sub_category_id'];
        $proposed_amount = $_POST['proposed_amount'];
        $expense_amount = $_POST['expense_amount'];
        $amount = $_POST['amount'];
        $due_amount = $_POST['due_amount'];
        $expense_date = $_POST['expense_date'];
        $expense_note = $_POST['expense_note'];
        $comment = $_POST['comment'];
        $entry_date = $dt->format('Y-m-d');

        $update_sql = "UPDATE `expenses` SET `category_id`='$category_id',`sub_category_id`='$sub_category_id',`proposed_amount`='$proposed_amount',`expense_amount`='$expense_amount',`amount`='$amount',`due_amount`='$due_amount',`expense_date`='$expense_date',`expense_note`='$expense_note',`comment`='$comment' WHERE expense_id = '$expense_id' ";

        $update_result = mysqli_query($con, $update_sql);
        if ($update_result == TRUE) {
            $_SESSION['msg'] = "";
            $_SESSION['status'] = "সফলভাবে আপডেট হয়েছে!";
            $_SESSION['status_code'] = "success";
            ?>
            <script>
                window.location.href = 'Add-Expense';
            </script>
        <?php

        } else {
        $_SESSION['msg'] = "Sorry!";
        $_SESSION['status'] = "দুঃখিত কিছু ভুল হয়ে গেছে, আবার চেষ্টা করুন";
        $_SESSION['status_code'] = "error";
        ?>
            <script>
                window.location.href = 'Add-Expense';
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
                        <h4 class="page-title">খর‌চ</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">খর‌চের তথ্য আপডেট করুন</h4>
                            <br>

                            <div class="row">
                                <form method="post">
                                    <div class="mb-3">
                                        <label>প্রধান খাত(*)</label>
                                        <select name="category_id" class="form-select js-select2" style="width:100%;" onchange="categoryName(this.value);">
                                            <option disabled="disabled" selected="selected" value="">প্রধান খাত নির্বাচন করুন*</option>
                                            <?php
                                            $fetch = "SELECT * from categories";
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
                                        <label>উপখাত(*)</label>
                                        <select class="form-select js-select2" name="sub_category_id" id="subcategory" required>
                                            <option class="text-dark" selected="selected" value="<?php echo $row['sub_category_id']; ?>"><?php echo $row['sub_category_name']; ?></option>
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
                                        <input type="number" name="amount" id="amount" value="<?php echo $row['amount']; ?>" onkeyup="Bill(this.value);" onkeydown="Bill(this.value);" class="form-control" required>
                                        <span id="bill"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label>বকেয়া বিল <strong class="text-danger">(অবশ্যই ইং‌রে‌জি হর‌ফে)</strong></label>
                                        <input type="number" name="due_amount" id="due_amount" value="<?php echo $row['due_amount']; ?>" class="form-control" required readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label>তা‌রিখ(*)</label>
                                        <?php
                                        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                        ?>
                                        <input type="date" name="expense_date" value="<?php echo $row['expense_date']; ?>" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>কেন খরচ হ‌য়ে‌ছে সেটা বর্ণনা করুন(*)</label>
                                        <textarea name="expense_note" rows="4" cols="50" class="form-control"><?php echo $row['expense_note']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label>মন্তব্য</label>
                                        <textarea name="comment" rows="4" cols="50" class="form-control"><?php echo $row['comment']; ?></textarea>
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
<script>
    function expenseBill(value){
        let proposed_amount=parseFloat(document.getElementById("proposed_amount").value);
        if (proposed_amount<parseFloat(value)){
            document.getElementById("submit").disabled = true;
            document.getElementById("expense_bill").innerHTML = "পরিশোধিত বিল দাখিলকৃত দিল আপক্ষা বেশি হয়েছে।"+proposed_amount;

        }else{
            document.getElementById("submit").disabled = false;
            document.getElementById("expense_bill").innerHTML = "";
        }
    }
</script>

<script>
    function Bill(value){
        let expense_amount=parseFloat(document.getElementById("expense_amount").value);
        if (expense_amount<parseFloat(value)){
            document.getElementById("submit").disabled = true;
            document.getElementById("bill").innerHTML = "পরিশোধিত বিল প্রস্তাবিত দিল আপক্ষা বেশি হয়েছে।"+expense_amount;

        }else{
            document.getElementById("submit").disabled = false;
            let amount=parseFloat(document.getElementById("amount").value);
            let due_amount = expense_amount - amount;
            document.getElementById("bill").innerHTML = "";
            document.getElementById("due_amount").value = due_amount;
        }
    }
</script>

</body>

</html>