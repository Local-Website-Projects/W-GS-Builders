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

$q = "SELECT SUM(i.amount) as income FROM incomes as i WHERE i.sub_cat_id = $subcat";

$result = mysqli_query($con, $q);

while ($rows = mysqli_fetch_array($result)) {
    $income = $rows['income'];
}

$q1 = "SELECT SUM(w.amount) as withdraw FROM withdraw as w WHERE w.sub_cat_id = $subcat";
$result1 = mysqli_query($con, $q1);
while ($row = mysqli_fetch_array($result1)){
    $withdraw = $row['withdraw'];
}
echo $income - $withdraw;
?>
