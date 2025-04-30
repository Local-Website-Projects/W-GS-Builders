<?php
include ("config/dbconfig.php");
$fdate = $_POST['fromdate'];
$tdate = $_POST['todate'];
$subcategoryid = $_POST['sub_category_id'];


$sql = "SELECT * FROM `expenses` WHERE `sub_category_id` = $subcategoryid and (`expense_date` BETWEEN '$fdate' and '$tdate')";
$result = mysqli_query($con,$sql);
if($result == true) {
    while ($rows = mysqli_fetch_array($result)) {
        $expense_amount = $rows["expense_amount"];
        $expense_id = $rows["expense_id"];
        $sql1 = "UPDATE `expenses` SET `amount`=$expense_amount,`due_amount`=0 WHERE expense_id = $expense_id";
        $result1 = mysqli_query($con, $sql1);
    }
    $_SESSION['msg'] = "";
    $_SESSION['status'] = "সফলভা‌বে যুক্ত হ‌য়ে‌ছে!";
    $_SESSION['status_code'] = "success";
    ?>
    <script>
        alert("সফলভা‌বে আপডেট হ‌য়ে‌ছে!");
        window.location.href = 'Add-Expense';
    </script>
    <?php

}else{
    $_SESSION['msg'] = "";
    $_SESSION['status'] = "দুঃখিত কিছু ভুল হয়ে গেছে, আবার চেষ্টা করুন";
    $_SESSION['status_code'] = "error";
    ?>
    <script>
        alert("দুঃখিত কিছু ভুল হয়ে গেছে, আবার চেষ্টা করুন");
        window.location.href = 'Add-Expense';
    </script>
    <?php
}
