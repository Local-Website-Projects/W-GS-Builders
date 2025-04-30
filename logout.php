<?php
session_start();
include('config/dbconfig.php');
/*$unique_id = $_SESSION['unique_id'];
$query = "SELECT unique_id,activity_log_id from activity_log_table WHERE unique_id='$unique_id' ORDER BY activity_log_id DESC LIMIT 1";
$data = mysqli_query($con, $query);
$total = mysqli_num_rows($data);

$last_unique_id = "";
$activity_log_id = "";
if ($total != 0) {
   while ($result = mysqli_fetch_assoc($data)) {
      $last_unique_id = $result['unique_id'];
      $activity_log_id = $result['activity_log_id'];
   }
} else {
   "No Records Found!!!";
}
$dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
$currentDateTime = $dt->format('Y-m-d H:i:s');
$last_logout_time_update = "UPDATE `activity_log_table` SET `last_log_out_time`='$currentDateTime' WHERE activity_log_id='$activity_log_id'";
$logout_result = mysqli_query($con, $last_logout_time_update);*/
session_unset();
session_destroy();
?>
    <script>
        window.location.href = "Welcome";
    </script>
<?php
