<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    ?>
    <script>
        window.location.href = "Welcome";
    </script>
    <?php
}
include('config/dbconfig.php');
$unique_id = $_SESSION['unique_id'];
$data = $_POST;
$count = count($_POST['sub_category_name']);
$category_id = $_POST['category_id'];


for ($i = 0; $i < $count; $i++) {
    $insert_query = "INSERT INTO `sub_categories` (`unique_id`,`category_id`, `sub_category_name`) VALUES ('$unique_id',$category_id, '{$_POST['sub_category_name'][$i]}')";
    $result = mysqli_query($con, $insert_query);
    if ($result == true) {
        $_SESSION['msg'] = "";
        $_SESSION['status'] = "সফলভা‌বে যুক্ত হ‌য়ে‌ছে!";
        $_SESSION['status_code'] = "success";
        ?>
        <script>
            window.location.href = "Add-Sub-Category";
        </script>
        <?php
    } else {
        $_SESSION['msg'] = "";
        $_SESSION['status'] = "দুঃখিত কিছু ভুল হয়ে গেছে, আবার চেষ্টা করুন";
        $_SESSION['status_code'] = "error";
        ?>
        <script>
            window.location.href = "Add-Sub-Category";
        </script>
        <?php
    }
}
