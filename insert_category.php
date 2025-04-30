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
$cat_name = $_POST['category_name'];
$admin_type = $_POST['admin_type'];
$insert_query = "INSERT INTO `categories` (`unique_id`, `category_name`, `admin_type`) VALUES ('$unique_id', '$cat_name', '$admin_type')";
$result = mysqli_query($con, $insert_query);
if ($result == true) {
    $_SESSION['msg'] = "";
    $_SESSION['status'] = "সফলভা‌বে যুক্ত হ‌য়ে‌ছে!";
    $_SESSION['status_code'] = "success";
    ?>
    <script>
        window.location.href = "Add-Category";
    </script>
<?php
} else {
    $_SESSION['msg'] = "";
    $_SESSION['status'] = "দুঃখিত কিছু ভুল হয়ে গেছে, আবার চেষ্টা করুন";
    $_SESSION['status_code'] = "error";
    ?>
    <script>
        window.location.href = "Add-Category";
    </script>
    <?php
}
