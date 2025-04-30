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
                <h2><b><?php echo $office_name; ?></b></h2>
                <?php
                $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                ?>
                <h6><b>মুদ্রণের তা‌রিখ : <?php echo $dt->format('d-m-Y'); ?>
                        &nbsp;| <?php echo $dt->format('h:i a'); ?></b></h6>
                <hr>
                <h4>
                    <?php
                    $categoryid = $_POST['category_id'];
                    ?>
                    <b>প্রধান খাত অনুসারে খর‌চের রি‌পোর্ট</b>
                </h4>
            </div>
        </div>
    </div>
    <?php
    $query = "SELECT * FROM expenses,categories,sub_categories WHERE expenses.category_id = categories.category_id AND expenses.sub_category_id = sub_categories.sub_category_id AND expenses.category_id='$categoryid' GROUP BY expenses.category_id";
    $data = mysqli_query($con, $query);
    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_assoc($data)) {
            ?>
            <div class="table-responsive p-2">
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
                        <th>দা‌খিলকৃত বিল</th>
                        <th>প্রস্তা‌বিত বিল</th>
                        <th>প‌রি‌শো‌ধিত বিল</th>
                        <th>বকেয়া বিল</th>
                    </tr>
                    </thead>
                    <?php
                    $query1 = "SELECT SUM(expenses.proposed_amount) as sum_of_proposed_amount, SUM(expenses.expense_amount) as sum_of_expense_amount,SUM(expenses.amount) as gamount, SUM(expenses.due_amount) as due_amount, sub_categories.sub_category_name FROM expenses,categories,sub_categories WHERE expenses.category_id = categories.category_id AND expenses.sub_category_id = sub_categories.sub_category_id AND expenses.category_id = '$categoryid' GROUP BY sub_categories.sub_category_id";
                    $result = mysqli_query($con, $query1);
                    $serial_no = 1;
                    $pa = 0;
                    $ea = 0;
                    $totalpa = 0;
                    $totalea = 0;
                    $am = 0;
                    $dm = 0;
                    $tgamount = 0;
                    $sum_of_due_amount = 0;
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tbody>
                        <tr>
                            <td><?php echo $serial_no; ?></td>
                            <td><?php echo $row["sub_category_name"]; ?></td>
                            <td><?php echo number_format($row["sum_of_proposed_amount"], 2); ?></td>
                            <td><?php echo number_format($row["sum_of_expense_amount"], 2); ?></td>
                            <td><?php echo number_format($row["gamount"], 2); ?></td>
                            <td><?php echo number_format($row["due_amount"], 2); ?></td>
                            <?php $pa = $row["sum_of_proposed_amount"]; ?>
                            <?php $ea = $row["sum_of_expense_amount"]; ?>
                            <?php $am = $row["gamount"]; ?>
                            <?php $dm = $row["due_amount"]; ?>
                        </tr>
                        </tbody>
                        <?php
                        $serial_no++;
                        $totalpa += $pa;
                        $totalea += $ea;
                        $tgamount += $am;
                        $sum_of_due_amount += $dm;
                    }
                    ?>
                    <tfoot>
                    <tr>
                        <td class="font-weight-bold"></td>
                        <td class="font-weight-bold">মোট</td>
                        <td class="font-weight-bold"><?php echo number_format($totalpa, 2); ?></td>
                        <td class="font-weight-bold"><?php echo number_format($totalea, 2); ?></td>
                        <td class="font-weight-bold"><?php echo number_format($tgamount, 2); ?></td>
                        <td class="font-weight-bold"><?php echo number_format($sum_of_due_amount, 2); ?></td>
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
    <div class="row text-center">
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