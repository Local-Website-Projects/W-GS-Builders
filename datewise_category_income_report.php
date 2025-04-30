<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" data-kit-theme="default">

<head>
    <!---cdn css files area start-->
    <?php $page = '';
    require_once('includes/css.php'); ?>
    <!---cdn css files area end-->
    <!---print button css area--->
    <style>
        @media print {
            #printPageButton {
                display: none;
            }
        }
    </style>
    <!---print button css area end--->
</head>

<body>

<div>
    <div>
        <div>
            <div class="mt-2 text-center">
                <?php
                $fdate = $_POST['fromdate'];
                $tdate = $_POST['todate'];
                ?>
                <h2><b><?php echo $office_name; ?></b></h2>
                <?php
                $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                ?>
                <h6><b>মুদ্রণের তা‌রিখ : <?php echo $dt->format('d-m-Y'); ?>
                        &nbsp;| <?php echo $dt->format('h:i a'); ?></b></h6>
                <hr>
                <?php
                $categoryid = $_POST['category_id'];
                ?>
                <b>আয়ের রি‌পোর্ট <br> <?php echo date_format(date_create_from_format('Y-m-d', $fdate), 'd-m-Y'); ?> থেকে <?php echo date_format(date_create_from_format('Y-m-d', $tdate), 'd-m-Y'); ?></b>
            </div>
        </div>
    </div>
    <?php
    $query = "SELECT * FROM incomes,categories,sub_categories WHERE incomes.cat_id = categories.category_id AND incomes.sub_cat_id = sub_categories.sub_category_id AND incomes.cat_id='$categoryid' AND (incomes.date BETWEEN '$fdate' AND '$tdate') GROUP BY incomes.cat_id";
    $data = mysqli_query($con, $query);
    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_assoc($data)) {
            ?>
            <div class="table-responsive p-2 text-center">
                <?php $categoryid = $row['category_id']; ?>
                <table class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <td colspan="6">
                            <h4><?php echo $row['category_name']; ?></h4>
                        </td>
                    </tr>
                    <tr>
                        <th>ক্রম</th>
                        <th>উপখাতের নাম</th>
                        <th>আয়ের বিবরণ</th>
                        <th>তারিখ</th>
                        <th>অর্থের পরিমান</th>
                        <th>মন্তব্য</th>
                    </tr>
                    </thead>
                    <?php
                    $query1 = "SELECT * FROM incomes,categories,sub_categories WHERE incomes.cat_id = categories.category_id AND incomes.sub_cat_id = sub_categories.sub_category_id AND incomes.cat_id = '$categoryid' AND (incomes.date BETWEEN '$fdate' AND '$tdate')";
                    $result = mysqli_query($con, $query1);
                    $serial_no = 1;
                    $pa = 0;
                    $ea = 0;
                    $totalpa = 0;
                    $totalea = 0;
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tbody>
                        <tr>
                            <td><?php echo $serial_no; ?></td>
                            <td><?php echo $row["sub_category_name"]; ?></td>
                            <?php
                            if ($row["description"] == null){
                                ?>
                                <td>N/A</td>
                                <?php
                            }else{
                                ?>
                                <td><?php echo $row["description"]; ?></td>
                                <?php
                            }
                            ?>
                            <td><?php echo date_format(date_create_from_format('Y-m-d', $row["date"]), 'd-m-Y'); ?></td>
                            <td><?php echo number_format($row["amount"], 2); ?></td>
                            <td><?php echo $row["comment"]; ?></td>
                            <?php $pa = $row["amount"]; ?>
                        </tr>
                        </tbody>
                        <?php
                        $serial_no++;
                        $totalpa += $pa;
                    }
                    ?>
                    <tfoot>
                    <tr>
                        <td class="font-weight-bold"></td>
                        <td class="font-weight-bold" colspan="3">মোট</td>
                        <td class="font-weight-bold"><?php echo number_format($totalpa, 2); ?></td>
                        <td class="font-weight-bold"></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <?php
        }
    }
    ?>
    <div class="table-responsive">
        <table class="table text-center">
            <tbody>
            <tr>
                <td>
                    <br><br><br><br>
                    <hr>
                    সহকারী নাজির
                </td>
                <td>
                    <br><br><br><br>
                    <hr>
                    জেলা নাজির
                </td>
                <td>
                    <br><br><br><br>
                    <hr>
                    নেজারত ডেপুটি কালেক্টর
                </td>
                <td>
                    <br><br><br><br>
                    <hr>
                    অতিরিক্ত জেলা<br> প্রশাসক (সার্বিক)
                </td>
                <td>
                    <br><br><br><br>
                    <hr>
                    জেলা প্রশাসক
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <button id="printPageButton" onclick="window.print()" class="btn btn-rounded btn-block btn-dark"><i
                    class="fa fa-print" aria-hidden="true"></i></button>
    </div>
</div>
<footer>
    <div class="row text-center" style="justify-content: center; align-items: center">
        <p style="align: center"> Powered By <b>FrogBid</b></p>

    </div>
</footer>

<!---Scripts area start-->
<?php require_once('includes/js.php'); ?>
<!---Scripts area end-->
<!---additional scripts area start-->

<!---additional scripts area end-->
</body>

</html>