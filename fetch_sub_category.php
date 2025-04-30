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

$subcat = $_POST['thissubcategory'];

$q = "SELECT * FROM sub_categories WHERE category_id = '$subcat' order by sub_category_id desc";

$result = mysqli_query($con, $q);
?>
    <option value="">উপ খাত নির্বাচন করুন</option>
<?php
while ($rows = mysqli_fetch_array($result)) {
    ?>
    <option value="<?php echo $rows['sub_category_id']; ?>"><?php echo $rows['sub_category_name']; ?></option>
    <?php
}
?>
