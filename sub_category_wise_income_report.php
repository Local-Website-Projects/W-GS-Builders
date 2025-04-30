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
                                    $subcategoryid = $_POST['sub_category_id'];
                                    ?>
                                    <b>আয়ের রি‌পোর্ট</b>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-2">
                            <table class="table table-bordered text-center">
                                <thead>
                                <tr>
                                    <?php
                                    $query = "SELECT `sub_category_id`,`sub_category_name` FROM `sub_categories` WHERE sub_category_id = $subcategoryid";
                                    $result1 = mysqli_query($con, $query);
                                    while ($row = mysqli_fetch_array($result1)) {
                                    ?>
                                <tr>
                                    <td colspan="5"><h4> <?php echo $row["sub_category_name"];?> (বরাদ্দ)</h4></td>
                                </tr>
                                <?php
                                }
                                ?>
                                </tr>
                                <tr>
                                    <th>ক্রম</th>
                                    <th>আয়ের বিবরণ</th>
                                    <th>তারিখ</th>
                                    <th>অর্থের পরিমান</th>
                                    <th>মন্তব্য</th>
                                </tr>
                                </thead>
                                <?php
                                $query1 = "SELECT * FROM incomes,categories,sub_categories WHERE incomes.cat_id = categories.category_id AND incomes.sub_cat_id = sub_categories.sub_category_id AND incomes.sub_cat_id = '$subcategoryid'";
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
                                        <?php
                                        if ($row["comment"] == null){
                                            ?>
                                            <td>N/A</td>
                                            <?php
                                        }else{
                                            ?>
                                            <td><?php echo $row["comment"]; ?></td>
                                            <?php
                                        }
                                        ?>
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
                                    <td class="font-weight-bold" colspan="2">মোট</td>
                                    <td class="font-weight-bold"><?php echo number_format($totalpa, 2); ?></td>
                                    <td class="font-weight-bold"></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="table-responsive p-2">
                            <table class="table table-bordered text-center">
                                <thead>
                                <tr>
                                    <?php
                                    $query = "SELECT `sub_category_id`,`sub_category_name` FROM `sub_categories` WHERE sub_category_id = $subcategoryid";
                                    $result1 = mysqli_query($con, $query);
                                    while ($row = mysqli_fetch_array($result1)) {
                                    ?>
                                <tr>
                                    <td colspan="5"><h4> <?php echo $row["sub_category_name"];?> (উত্তোলন)</h4></td>
                                </tr>
                                <?php
                                }
                                ?>
                                </tr>
                                <tr>
                                    <th>ক্রম</th>
                                    <th>বিবরণ</th>
                                    <th>তারিখ</th>
                                    <th>উত্তোলনকৃত অর্থের পরিমান</th>
                                    <th>মন্তব্য</th>
                                </tr>
                                </thead>
                                <?php
                                $query1 = "SELECT * FROM withdraw,categories,sub_categories WHERE withdraw.cat_id = categories.category_id AND withdraw.sub_cat_id = sub_categories.sub_category_id AND withdraw.sub_cat_id = '$subcategoryid'";
                                $result = mysqli_query($con, $query1);
                                $serial_no = 1;
                                $pa = 0;
                                $ea = 0;
                                $totalu = 0;
                                $totalea = 0;
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tbody>
                                    <tr>
                                        <td><?php echo $serial_no; ?></td>
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
                                        <?php
                                        if ($row["comment"] == null){
                                            ?>
                                            <td>N/A</td>
                                            <?php
                                        }else{
                                            ?>
                                            <td><?php echo $row["comment"]; ?></td>
                                            <?php
                                        }
                                        ?>
                                        <?php $pa = $row["amount"]; ?>
                                    </tr>
                                    </tbody>
                                    <?php
                                    $serial_no++;
                                    $totalu += $pa;
                                }
                                ?>
                                <tfoot>
                                <tr>
                                    <td class="font-weight-bold"></td>
                                    <td class="font-weight-bold" colspan="2">মোট</td>
                                    <td class="font-weight-bold"><?php echo number_format($totalu, 2); ?></td>
                                    <td class="font-weight-bold"></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="table-responsive p-2">
                            <table class="table table-bordered text-center">
                                <tr>
                                    <td>অবশিষ্ট বরাদ্দের পরিমান</td>
                                    <td><?php echo number_format($totalpa - $totalu, 2)?></td>
                                </tr>
                            </table>
                        </div>
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