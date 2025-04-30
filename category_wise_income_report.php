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

<body class="air__menu--gray air__layout--contentNoMaxWidth">
<div class="air__layout air__layout--hasSider">

    <!---mobile menu area start-->
    <div class="air__menuLeft__backdrop air__menuLeft__mobileActionToggle"></div>
    <!---mobile menu area end-->

    <div class="air__layout">
        <!---main page content write here-->
        <div class="air__layout__content">
            <div class="air__utils__content">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header">
                            <div class="mt-2 text-center">
                                <h2><b><?php echo $office_name; ?></b></h2>
                                <?php
                                $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                ?>
                                <h6><b>মুদ্রণের তা‌রিখ : <?php echo $dt->format('d-m-Y'); ?>&nbsp;| <?php echo $dt->format('h:i a'); ?></b></h6>
                                <hr>
                                <h4>
                                    <?php
                                    $categoryid = $_POST['category_id'];
                                    ?>
                                    <b>আয়ের রি‌পোর্ট</b>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        $query = "SELECT * FROM incomes,categories,sub_categories WHERE incomes.cat_id = categories.category_id AND incomes.sub_cat_id = sub_categories.sub_category_id AND incomes.cat_id='$categoryid' GROUP BY incomes.cat_id";
                        $data = mysqli_query($con, $query);
                        if (mysqli_num_rows($data) > 0) {
                            while ($row = mysqli_fetch_assoc($data)) {
                                ?>
                                <div class="table-responsive p-2">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                        <tr>
                                            <td colspan="5">
                                                <h4><?php echo $row['category_name']; ?></h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>ক্রম</th>
                                            <th>উপখাতের নাম</th>
                                            <th>মোট বরাদ্দের পরিমান</th>
                                            <th>উত্তোলনকৃত বরাদ্দের পরিমান</th>
                                            <th>অবশিষ্ট বরাদ্দের পরিমান</th>
                                        </tr>
                                        </thead>
                                        <?php
                                        $query1 = "SELECT SUM(incomes.amount) as sum_of_amount,sub_categories.sub_category_name,sub_categories.sub_category_id  FROM incomes,categories,sub_categories WHERE incomes.cat_id = categories.category_id AND incomes.sub_cat_id = sub_categories.sub_category_id AND incomes.cat_id = '$categoryid' GROUP BY sub_categories.sub_category_id";
                                        $result = mysqli_query($con, $query1);
                                        $serial_no = 1;
                                        $pa = 0;
                                        $ea = 0;
                                        $totalpa = 0;
                                        $totalea = 0;
                                        while ($row = mysqli_fetch_array($result)) {
                                            $sub_cat_id = $row['sub_category_id'];
                                            ?>
                                            <tbody>
                                            <tr>
                                                <td><?php echo $serial_no; ?></td>
                                                <td><?php echo $row["sub_category_name"]; ?></td>
                                                <td><?php echo number_format($row["sum_of_amount"], 2); ?></td>
                                                <?php $pa = $row["sum_of_amount"]; ?>
                                                <?php
                                                $q2 = "SELECT SUM(amount) as withdraw FROM `withdraw` WHERE sub_cat_id = '$sub_cat_id'";
                                                $result2 = mysqli_query($con,$q2);
                                                while($row1 = mysqli_fetch_array($result2)){
                                                    $withdraw = $row1["withdraw"];
                                                    ?>
                                                    <td><?php echo number_format($row1["withdraw"], 2); ?></td>
                                                    <?php
                                                }
                                                ?>
                                                <td><?php
                                                    $remain = $pa - $withdraw;
                                                    echo number_format($remain, 2); ?>
                                                </td>
                                            </tr>
                                            </tbody>
                                            <?php
                                            $serial_no++;
                                            $totalpa += $pa;
                                            $totalwithdraw += $withdraw;
                                            $totalremain += $remain;
                                        }
                                        ?>
                                        <tfoot>
                                        <tr>
                                            <td class="font-weight-bold"></td>
                                            <td class="font-weight-bold">মোট</td>
                                            <td class="font-weight-bold"><?php echo number_format($totalpa, 2); ?></td>
                                            <td class="font-weight-bold"><?php echo number_format($totalwithdraw, 2); ?></td>
                                            <td class="font-weight-bold"><?php echo number_format($totalremain, 2); ?></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <br><br><br>
                        <div class="table-responsive">
                            <table class="table text-center border-0">
                                <tbody>
                                <tr>
                                    <td>
                                        <br><br><br><br>
                                        <hr>সহকারী নাজির
                                    </td>
                                    <td>
                                        <br><br><br><br>
                                        <hr>জেলা নাজির
                                    </td>
                                    <td>
                                        <br><br><br><br>
                                        <hr>নেজারত ডেপুটি কালেক্টর
                                    </td>
                                    <td>
                                        <br><br><br><br>
                                        <hr>অতিরিক্ত জেলা প্রশাসক (সার্বিক)
                                    </td>
                                    <td>
                                        <br><br><br><br>
                                        <hr>জেলা প্রশাসক
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <br><br>
                        <div class="m-2">
                            <div class="row">
                                <button id="printPageButton" onclick="window.print()" class="btn btn-rounded btn-block btn-dark"><i class="fa fa-print" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!---main page content write here area end-->
        <!---footer area starts here-->
        <footer>
            <div class="row text-center" style="justify-content: center; align-items: center">
                <p style="align: center"> Powered By <b>FrogBid</b></p>

            </div>
        </footer>
        <!---footer area starts here-->
    </div>
</div>
<!---Scripts area start-->
<?php require_once('includes/js.php'); ?>
<!---Scripts area end-->
<!---additional scripts area start-->

<!---additional scripts area end-->
</body>

</html>