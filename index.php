<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("includes/css.php");
    ?>
<style>
#marquee {
font-size: 2em;
color: red;
font-family: Arial;
font-weight: bold;
}
</style>
</head>

<!-- body start -->
<body class="loading"
      data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

<!-- Begin page -->
<div id="wrapper">
    <!-- Topbar Start -->
    <?php
    include("includes/topbar.php");
    ?>
    <!-- end Topbar -->
    <!-- ========== Left Sidebar Start ========== -->
    <?php
    include("includes/sidebar.php");
    ?>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <div class="card" id="tooltip-container">
                            <div class="card-body">
                                <h4 class="mt-0 font-16">আজ‌কের খরচ</h4>
                                <?php
                                $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                $date = $dt->format('Y-m-d');
                                $sql = "SELECT SUM(`expense_amount`) AS dailyexpense,expense_date FROM `expenses` WHERE expense_date='$date'";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $dailyexpense = $row["dailyexpense"];
                                    }
                                }
                                ?>
                                <h2 class="text-primary my-3 text-center"><span
                                            data-plugin="counterup"><?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($dailyexpense)); ?></span>
                                    টাকা
                                </h2>
                                <!--<p class="text-muted mb-0">Total income: $22506 <span class="float-end"><i
                                                class="fa fa-caret-up text-success me-1"></i>10.25%</span></p>-->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card" id="tooltip-container1">
                            <div class="card-body">
                                <h4 class="mt-0 font-16">চল‌তি মা‌সের খরচ</h4>
                                <?php
                                $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                $month = $dt->format('m');
                                $sql = "SELECT SUM(`expense_amount`) AS monthlyexpense,expense_date FROM `expenses` WHERE MONTH(expense_date)='$month'";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $monthlyexpense = $row["monthlyexpense"];
                                    }
                                }
                                ?>
                                <h2 class="text-primary my-3 text-center"><span
                                            data-plugin="counterup"><?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($monthlyexpense)); ?></span>
                                    টাকা </h2>
                                <!--<p class="text-muted mb-0">Total sales: 2398 <span class="float-end"><i
                                                class="fa fa-caret-down text-danger me-1"></i>7.85%</span></p>-->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card" id="tooltip-container2">
                            <div class="card-body">
                                <h4 class="mt-0 font-16">আজ‌কের আয়/বরাদ্দ</h4>
                                <?php
                                $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                $date = $dt->format('Y-m-d');
                                $sql = "SELECT SUM(`amount`) AS dailyexpense,date FROM `incomes` WHERE date='$date'";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $dailyexpense = $row["dailyexpense"];
                                    }
                                }
                                ?>
                                <h2 class="text-primary my-3 text-center"><span
                                            data-plugin="counterup"><?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($dailyexpense)); ?></span>
                                    টাকা </h2>
                                <!--<p class="text-muted mb-0">Total users: 121 M <span class="float-end"><i
                                                class="fa fa-caret-up text-success me-1"></i>3.64%</span></p>-->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card" id="tooltip-container3">
                            <div class="card-body">
                                <h4 class="mt-0 font-16">চল‌তি মা‌সের আয়/বরাদ্দ</h4>
                                <?php
                                $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                $month = $dt->format('m');
                                $sql = "SELECT SUM(`amount`) AS monthlyexpense,date FROM `incomes` WHERE MONTH(date)='$month'";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $monthlyexpense = $row["monthlyexpense"];
                                    }
                                }
                                ?>
                                <h2 class="text-primary my-3 text-center"><span
                                            data-plugin="counterup"><?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($monthlyexpense)); ?></span>টাকা
                                </h2>
                                <!-- <p class="text-muted mb-0">Total revenue: $1.2 M <span class="float-end"><i
                                                 class="fa fa-caret-up text-success me-1"></i>17.48%</span></p>-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">বাৎসরিক আয়-ব্যায়ের হিসাব</h4>
                                <div class="row mt-4 text-center">
                                    <div class="col-4">
                                        <p class="text-muted font-15 mb-1 text-truncate">মোট আয়/বরাদ্দ</p>
                                        <?php
                                        $sql = "SELECT SUM(`amount`) as total FROM `incomes`";
                                        $result = mysqli_query($con, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $total = $row["total"];
                                            }
                                        }
                                        ?>
                                        <h4><?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($total)); ?>
                                            টাকা</h4>
                                    </div>
                                    <div class="col-4">
                                        <p class="text-muted font-15 mb-1 text-truncate">মোট দা‌খিলকৃত বিল</p>
                                        <?php
                                        $sql = "SELECT SUM(`proposed_amount`) as total FROM `expenses`";
                                        $result = mysqli_query($con, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $total = $row["total"];
                                            }
                                        }
                                        ?>
                                        <h4><?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($total)); ?>
                                            টাকা</h4>
                                    </div>
                                    <div class="col-4">
                                        <p class="text-muted font-15 mb-1 text-truncate">মোট প্রস্তা‌বিত/প‌রি‌শো‌ধিত
                                            বিল</p>
                                        <?php
                                        $sql = "SELECT SUM(`expense_amount`) as total FROM `expenses`";
                                        $result = mysqli_query($con, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $total = $row["total"];
                                            }
                                        }
                                        ?>
                                        <h4><?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($total)); ?>
                                            টাকা</h4>
                                    </div>
                                </div>
                                <div class="mt-3 chartjs-chart">
                                    <canvas id="projections-actuals-chart" data-colors="#7638ff,#e3eaef"
                                            height="300"></canvas>
                                </div>
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col -->

                    <div class="col-lg-4">
                        <!-- Portlet card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-0">খাত অনুসারে ব্যায়ের তথ্য</h4>

                                <div id="cardCollpase1" class="collapse pt-3 show">
                                    <div class="text-center">
                                        <div class="row mt-2">
                                            <div class="col-4">
                                                <?php
                                                $sql = "SELECT COUNT(`category_id`) AS totalcategory FROM `categories`";
                                                $result = mysqli_query($con, $sql);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $totalcategory = $row["totalcategory"];
                                                    }
                                                }
                                                ?>
                                                <h3 data-plugin="counterup"><?php
                                                    echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $totalcategory);
                                                    ?></h3>
                                                <p class="text-muted font-13 mb-0 text-truncate">প্রধান খাতগুলির
                                                    সংখ্যা</p>
                                            </div>
                                            <div class="col-4">
                                                <?php
                                                $sql = "SELECT COUNT(`sub_category_id`) AS totalsubcategory FROM `sub_categories`";
                                                $result = mysqli_query($con, $sql);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $totalsubcategory = $row["totalsubcategory"];
                                                    }
                                                }
                                                ?>
                                                <h3 data-plugin="counterup"><?php
                                                    echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $totalsubcategory);
                                                    ?></h3>
                                                <p class="text-muted font-13 mb-0 text-truncate">উপ খা‌তের সংখ্যা</p>
                                            </div>
                                            <div class="col-4">
                                                <?php
                                                $sql = "SELECT COUNT(`expense_id`) as totalexpense FROM `expenses`";
                                                $result = mysqli_query($con, $sql);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $totalexpense = $row["totalexpense"];
                                                    }
                                                }
                                                ?>
                                                <h3 data-plugin="counterup"> <?php echo $totalexpense; ?></h3>
                                                <p class="text-muted font-13 mb-0 text-truncate">বিলের সংখ্যা</p>
                                            </div>
                                        </div> <!-- end row -->

                                        <div dir="ltr">
                                            <div id="lifetime-sales" data-colors="#4fc6e1,#6658dd,#ebeff2"
                                                 style="height: 270px;" class="morris-chart mt-3"></div>
                                        </div>
                                    </div>
                                    </br>
                                </div> <!-- end collapse-->
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">প্রধান খাত অনুযায়ী আয় ব্যয়</h4>
                                <div class="mt-4 chartjs-chart">
                                    <canvas id="line-chart-example" height="350" data-colors="#1abc9c,#f1556c"></canvas>
                                </div>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end row -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title mb-3">‌সর্ব‌শেষ ৫ টি আয়ের তা‌লিকা</h4>

                                <div class="table-responsive">
                                    <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                        <thead class="table-light">
                                        <tr>
                                            <th>ক্রম</th>
                                            <th>প্রধান খাত</th>
                                            <th>উপখাতের নাম</th>
                                            <th>তা‌রিখ</th>
                                            <th>বরাদ্দের পরিমান</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $query = "SELECT * FROM incomes,categories,sub_categories WHERE incomes.cat_id = categories.category_id AND incomes.sub_cat_id = sub_categories.sub_category_id ORDER BY incomes.date DESC LIMIT 5";
                                        $data = mysqli_query($con, $query);
                                        $serial_no = 1;
                                        $pa = 0;
                                        $ea = 0;
                                        $totalpa = 0;
                                        $totalea = 0;
                                        if (mysqli_num_rows($data) > 0) {
                                            while ($row = mysqli_fetch_assoc($data)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $serial_no; ?></td>
                                                    <td><?php echo $row["category_name"]; ?></td>
                                                    <td><?php echo $row["sub_category_name"]; ?></td>
                                                    <td><?php echo date_format(date_create_from_format('Y-m-d', $row["date"]), 'd-m-Y'); ?></td>
                                                    <td><?php echo number_format($row["amount"], 2); ?></td>
                                                </tr>
                                                <?php
                                                $serial_no++;
                                            }
                                        }
                                        ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title mb-3">‌সর্ব‌শেষ ৫ টি খর‌চের তা‌লিকা</h4>

                                <div class="table-responsive">
                                    <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                        <thead class="table-light">
                                        <tr>
                                            <th>ক্রম</th>
                                            <th>তা‌রিখ</th>
                                            <th>প্রধান খাত</th>
                                            <th>উপখাতের নাম</th>
                                            <th>দা‌খিলকৃত বিল</th>
                                            <th>প্রস্তা‌বিত/প‌রি‌শো‌ধিত বিল</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $query = "SELECT * FROM expenses,categories,sub_categories WHERE expenses.category_id = categories.category_id AND expenses.sub_category_id = sub_categories.sub_category_id ORDER BY expenses.expense_date DESC LIMIT 5";
                                        $data = mysqli_query($con, $query);
                                        
                                        $serial_no = 1;
                                        $pa = 0;
                                        $ea = 0;
                                        $totalpa = 0;
                                        $totalea = 0;
                                        if (mysqli_num_rows($data) > 0) {
                                            while ($row = mysqli_fetch_assoc($data)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $serial_no; ?></td>
                                                    <td><?php echo date_format(date_create_from_format('Y-m-d', $row["expense_date"]), 'd-m-Y'); ?></td>
                                                    <td><?php echo $row["category_name"]; ?></td>
                                                    <td><?php echo $row["sub_category_name"]; ?></td>
                                                    <td><?php echo number_format($row["proposed_amount"], 2); ?></td>
                                                    <td><?php echo number_format($row["expense_amount"], 2); ?></td>
                                                </tr>
                                                <?php
                                                $serial_no++;
                                            }
                                        }
                                        ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->

                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
        <?php
        include("includes/footer.php");
        ?>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

<!-- Vendor js -->
<?php
include("includes/js.php");
?>
<!--Dashboard income and expense chart-->
<script>
    function hexToRGB(a, e) {
        var r = parseInt(a.slice(1, 3), 16), t = parseInt(a.slice(3, 5), 16), o = parseInt(a.slice(5, 7), 16);
        return e ? "rgba(" + r + ", " + t + ", " + o + ", " + e + ")" : "rgb(" + r + ", " + t + ", " + o + ")"
    }

    !function (i) {
        "use strict";

        function a() {
            this.$body = i("body"), this.charts = []
        }

        a.prototype.respChart = function (e, r, t, o) {
            var s = e.get(0).getContext("2d");
            Chart.defaults.global.defaultFontColor = "#8391a2", Chart.defaults.scale.gridLines.color = "#8391a2";
            var n = i(e).parent();
            return function () {
                var a;
                switch (e.attr("width", i(n).width()), r) {
                    case"Bar":
                        a = new Chart(s, {type: "bar", data: t, options: o});
                        break;
                }
                return a
            }()
        }, a.prototype.initCharts = function () {
            var a = [], e = ["#1abc9c", "#f1556c", "#1abc9c", "#e3eaef"];
            if (0 < i("#projections-actuals-chart").length) {
                var t, o, s = {
                    labels: ["Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar", "Apr", "May", "Jun"],
                    datasets: [{
                        label: "ব্যায়ের হিসাব",
                        backgroundColor: (o = (t = i("#projections-actuals-chart").data("colors")) ? t.split(",") : e.concat())[0],
                        borderColor: o[0],
                        hoverBackgroundColor: "#A36Eff",
                        hoverBorderColor: o[0],
                        data: <?php

                        error_reporting(0);
                        include('config/dbconfig.php');

                        function search($month, $data, $x)
                        {
                            for ($i = 0; $i < 12; $i++) {
                                if ($month[$i] == $x) {
                                    return $data[$i];
                                    break;
                                }
                            }
                            return -1;
                        }


                        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));

                        $year = $dt->format('Y');
                        $month = $dt->format('m');

                        $fromdate = '';
                        $todate = '';

                        if ($month > 6) {
                            $fromdate = $dt->format('07/01/' . $year);
                            $explodedDate = explode("/", $fromdate);
                            $fromdate = $explodedDate[2] . '-' . $explodedDate[0] . '-' . $explodedDate[1];

                            $todate = $dt->format('06/30/' . ($year + 1));
                            $explodedDate = explode("/", $todate);
                            $todate = $explodedDate[2] . '-' . $explodedDate[0] . '-' . $explodedDate[1];
                        } else {
                            $fromdate = $dt->format('07/01/' . ($year - 1));
                            $todate = $dt->format('06/30/' . $year);
                        }


                        $data = "[";

                        $data_month = "";

                        $q = "SELECT SUM(`expense_amount`) AS amount,MONTH(expense_date) as mon FROM `expenses` where (expense_date BETWEEN '$fromdate' AND '$todate') GROUP BY MONTH(expense_date) ORDER BY expense_date ASC";

                        $result = mysqli_query($con, $q);


                        while ($rows = mysqli_fetch_array($result)) {
                            $data .= $rows['amount'] . ',';
                            $data_month .= $rows['mon'] . ',';
                        }

                        $new_data = rtrim($data, ", ");
                        $new_data_month = rtrim($data_month, ", ");

                        $new_data .= ']';
                        $new_data_month .= ']';

                        $month_data = explode(",", $new_data_month);

                        $amount_data = explode(",", $new_data);

                        $rearrange_data = '[';

                        $result_7 = search($month_data, $amount_data, 7);
                        if ($result_7 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_7 . ',';
                        }

                        $result_8 = search($month_data, $amount_data, 8);
                        if ($result_8 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_8 . ',';
                        }

                        $result_9 = search($month_data, $amount_data, 9);
                        if ($result_9 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_9 . ',';
                        }

                        $result_10 = search($month_data, $amount_data, 10);
                        if ($result_10 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_10 . ',';
                        }

                        $result_11 = search($month_data, $amount_data, 11);
                        if ($result_11 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_11 . ',';
                        }

                        $result_12 = search($month_data, $amount_data, 12);
                        if ($result_12 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_12 . ',';
                        }

                        $result_1 = search($month_data, $amount_data, 1);
                        if ($result_1 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_1 . ',';
                        }

                        $result_2 = search($month_data, $amount_data, 2);
                        if ($result_2 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_2 . ',';
                        }

                        $result_3 = search($month_data, $amount_data, 3);
                        if ($result_3 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_3 . ',';
                        }

                        $result_4 = search($month_data, $amount_data, 4);
                        if ($result_4 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_4 . ',';
                        }

                        $result_5 = search($month_data, $amount_data, 5);
                        if ($result_1 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_5 . ',';
                        }

                        $result_6 = search($month_data, $amount_data, 6);
                        if ($result_6 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_6 . ',';
                        }

                        $rearrange_data = rtrim($rearrange_data, ", ");
                        $rearrange_data .= ']';

                        echo '[' . str_replace(array('[', ']'), '', $rearrange_data) . ']';
                        ?>,
                        barPercentage: .7,
                        categoryPercentage: .9
                    }, {
                        label: "আয়ের হিসাব",
                        backgroundColor: "#FDA600",
                        borderColor: o[1],
                        hoverBackgroundColor: "#FDD559",
                        hoverBorderColor: o[1],
                        data: <?php

                        error_reporting(0);
                        include('config/dbconfig.php');

                        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));

                        $year = $dt->format('Y');
                        $month = $dt->format('m');

                        $fromdate = '';
                        $todate = '';

                        if ($month > 6) {
                            $fromdate = $dt->format('07/01/' . $year);
                            $explodedDate = explode("/", $fromdate);
                            $fromdate = $explodedDate[2] . '-' . $explodedDate[0] . '-' . $explodedDate[1];

                            $todate = $dt->format('06/30/' . ($year + 1));
                            $explodedDate = explode("/", $todate);
                            $todate = $explodedDate[2] . '-' . $explodedDate[0] . '-' . $explodedDate[1];
                        } else {
                            $fromdate = $dt->format('07/01/' . ($year - 1));
                            $todate = $dt->format('06/30/' . $year);
                        }


                        $data = "[";

                        $data_month = "";

                        $q = "SELECT SUM(`amount`) AS amount,MONTH(date) as mon FROM `incomes` where (date BETWEEN '$fromdate' AND '$todate') GROUP BY MONTH(date) ORDER BY date ASC";

                        $result = mysqli_query($con, $q);


                        while ($rows = mysqli_fetch_array($result)) {
                            $data .= $rows['amount'] . ',';
                            $data_month .= $rows['mon'] . ',';
                        }

                        $new_data = rtrim($data, ", ");
                        $new_data_month = rtrim($data_month, ", ");

                        $new_data .= ']';
                        $new_data_month .= ']';

                        $month_data = explode(",", $new_data_month);

                        $amount_data = explode(",", $new_data);

                        $rearrange_data = '[';

                        $result_7 = search($month_data, $amount_data, 7);
                        if ($result_7 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_7 . ',';
                        }

                        $result_8 = search($month_data, $amount_data, 8);
                        if ($result_8 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_8 . ',';
                        }

                        $result_9 = search($month_data, $amount_data, 9);
                        if ($result_9 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_9 . ',';
                        }

                        $result_10 = search($month_data, $amount_data, 10);
                        if ($result_10 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_10 . ',';
                        }

                        $result_11 = search($month_data, $amount_data, 11);
                        if ($result_11 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_11 . ',';
                        }

                        $result_12 = search($month_data, $amount_data, 12);
                        if ($result_12 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_12 . ',';
                        }

                        $result_1 = search($month_data, $amount_data, 1);
                        if ($result_1 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_1 . ',';
                        }

                        $result_2 = search($month_data, $amount_data, 2);
                        if ($result_2 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_2 . ',';
                        }

                        $result_3 = search($month_data, $amount_data, 3);
                        if ($result_3 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_3 . ',';
                        }

                        $result_4 = search($month_data, $amount_data, 4);
                        if ($result_4 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_4 . ',';
                        }

                        $result_5 = search($month_data, $amount_data, 5);
                        if ($result_1 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_5 . ',';
                        }

                        $result_6 = search($month_data, $amount_data, 6);
                        if ($result_6 == -1) {
                            $rearrange_data .= '0' . ',';
                        } else {
                            $rearrange_data .= $result_6 . ',';
                        }

                        $rearrange_data = rtrim($rearrange_data, ", ");
                        $rearrange_data .= ']';

                        echo '[' . str_replace(array('[', ']'), '', $rearrange_data) . ']';
                        ?>,
                        barPercentage: .7,
                        categoryPercentage: .9
                    }]
                };
                a.push(this.respChart(i("#projections-actuals-chart"), "Bar", s, {
                    maintainAspectRatio: !1,
                    legend: {display: !1},
                    scales: {
                        yAxes: [{gridLines: {display: !1}, stacked: !1, ticks: {stepSize: 20}}],
                        xAxes: [{stacked: !1, gridLines: {color: "rgba(0,0,0,0.01)"}}]
                    }
                }))
            }
            return a
        }, a.prototype.init = function () {
            var e = this;
            Chart.defaults.global.defaultFontFamily = "Nunito,sans-serif", e.charts = this.initCharts(), i(window).on("resize", function (a) {
                i.each(e.charts, function (a, e) {
                    try {
                        e.destroy()
                    } catch (a) {
                    }
                }), e.charts = e.initCharts()
            })
        }, i.ChartJs = new a, i.ChartJs.Constructor = a
    }(window.jQuery), function () {
        "use strict";
        window.jQuery.ChartJs.init()
    }();
</script>

<!--Dashboard category chart -->
<script>
    !function (e) {
        "use strict";

        function a() {
        }

        a.prototype.createDonutChart = function (a, t, e) {
            Morris.Donut({
                element: a,
                data: t,
                barSize: .2,
                resize: !0,
                colors: ["#7638ff", "#FDA600", "#0D8D80", "#6a139c", "#cccccc"],
                backgroundColor: "transparent"
            })
        }, a.prototype.init = function () {
            var t;
            a = ["#7638ff", "#FDA600", "#0D8D80", "#6a139c", "#cccccc"];
            (t = e("#lifetime-sales").data("colors")) && (a = t.split(",")), this.createDonutChart("lifetime-sales",
                [<?php
                    error_reporting(0);
                    include('config/dbconfig.php');

                    $q = "SELECT SUM(e.expense_amount) as amount, c.category_name as cat_name FROM `expenses` as e, `categories` as c WHERE c.category_id=e.category_id GROUP by e.category_id";

                    $result = mysqli_query($con, $q);

                    $data = '';

                    while ($rows = mysqli_fetch_array($result)) {
                        $data .= '{label: "' . $rows['cat_name'] . '", value: ' . $rows['amount'] . '},';
                    }

                    $new_data = rtrim($data, ", ");

                    echo $new_data;
                    ?>], a)
        }, e.Dashboard4 = new a, e.Dashboard4.Constructor = a
    }(window.jQuery), function () {
        "use strict";
        window.jQuery.Dashboard4.init()
    }();
</script>

<?php
if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    ?>
    <?php
    $unique_id = $_SESSION['unique_id'];
    $name_fetch = "SELECT admin_name FROM admin_table WHERE unique_id = '$unique_id' ";
    $result_adminname = mysqli_query($con, $name_fetch);
    $particular_user = mysqli_num_rows($result_adminname);

    $adminname = "";
    if ($result_adminname != '') {
        while ($result_u = mysqli_fetch_assoc($result_adminname)) {
            $adminname = $result_u['admin_name'];
        }
    } else {
        "No Records Found!!!";
    } ?>
    <script>
        swal.fire({
            position: 'top-end',
            icon: "<?php echo $_SESSION['status_code']; ?>",
            title: "<?php echo $_SESSION['status'] . "&nbsp;" . "$adminname"; ?>",
            showConfirmButton: false,
            timer: 4000
        });
    </script>
    <?php
    unset($_SESSION['status']);
}
?>

<!--Dashboard category chart -->
<script>
    function hexToRGB(a, r) {
        var e = parseInt(a.slice(1, 3), 16), t = parseInt(a.slice(3, 5), 16), o = parseInt(a.slice(5, 7), 16);
        return r ? "rgba(" + e + ", " + t + ", " + o + ", " + r + ")" : "rgb(" + e + ", " + t + ", " + o + ")"
    }

    !function (d) {
        "use strict";

        function a() {
            this.$body = d("body"), this.charts = []
        }

        a.prototype.respChart = function (r, e, t, o) {
            var n = r.get(0).getContext("2d"), l = d(r).parent();
            return Chart.defaults.global.defaultFontColor = "#8391a2", Chart.defaults.scale.gridLines.color = "#8391a2", function () {
                var a;
                switch (r.attr("width", d(l).width()), e) {
                    case"Line":
                        a = new Chart(n, {type: "line", data: t, options: o});
                }
                return a
            }()
        }, a.prototype.initCharts = function () {
            var a = [], r = ["#1abc9c", "#f1556c", "#4a81d4", "#e3eaef"];
            if (0 < d("#line-chart-example").length) {
                var e = {
                    labels: [<?php
                        error_reporting(0);
                        include('config/dbconfig.php');

                        $q = "SELECT category_id, category_name FROM categories order by category_id";

                        $result = mysqli_query($con, $q);

                        $data = '';

                        while ($rows = mysqli_fetch_array($result)) {
                            $data.='"'.$rows['category_name'].'",';
                        }

                        $new_data = rtrim($data, ", ");

                        echo $new_data;
                        ?>],
                    datasets: [{
                        label: "আয়",
                        backgroundColor: hexToRGB((s = (i = d("#line-chart-example").data("colors")) ? i.split(",") : r.concat())[0], .3),
                        borderColor: s[0],
                        data: [<?php
                                error_reporting(0);
                                include('config/dbconfig.php');
                                
                                $q = "SELECT sum(amount) as income, incomes.cat_id as c_id  FROM `incomes`, categories where categories.category_id=incomes.cat_id group by cat_id order by cat_id";
                                
                                $result = mysqli_query($con, $q);
                                
                                $income_amount= array();
                                $income_cat_id= array();
                                
                                while ($rows = mysqli_fetch_array($result)) {
                                    array_push($income_amount, $rows['income']);
                                    array_push($income_cat_id, $rows['c_id']);
                                }
                                
                                $q = "SELECT category_id, category_name FROM categories order by category_id";
                                
                                $result = mysqli_query($con, $q);
                                
                                $cat_name= array();
                                $cat_id= array();
                                
                                while ($rows = mysqli_fetch_array($result)) {
                                    array_push($cat_name, $rows['category_name']);
                                    array_push($cat_id, $rows['category_id']);
                                }
                                
                                $data = '';
                                $c=0;
                                
                                for($i=0;$i<count($cat_id);$i++){
                                    $c=0;
                                    for($j=0;$j<=$i;$j++){
                                        if($cat_id[$i]==$income_cat_id[$j]){
                                            $data.=$income_amount[$j];
                                            $c=1;
                                            break;
                                        }
                                    }
                                    if($c==0){
                                        $data.=' 0';
                                    }
                                    $data.=',';
                                }
                                
                                $new_data = rtrim($data, ", ");
                                
                                echo $new_data;
                                ?>]
                    }, {
                        label: "ব্যয়",
                        fill: !0,
                        backgroundColor: "transparent",
                        borderColor: s[1],
                        borderDash: [5, 5],
                        data: [<?php
                            error_reporting(0);
                            include('config/dbconfig.php');

                            $q = "SELECT sum(amount) as expense, expenses.category_id as c_id FROM `expenses`, categories where categories.category_id=expenses.category_id group by expenses.category_id order by expenses.category_id";

                            $result = mysqli_query($con, $q);

                            $expense_amount= array();
                            $expense_cat_id= array();

                            while ($rows = mysqli_fetch_array($result)) {
                                array_push($expense_amount, $rows['expense']);
                                array_push($expense_cat_id, $rows['c_id']);
                            }

                            $q = "SELECT category_id, category_name FROM categories order by category_id";

                            $result = mysqli_query($con, $q);

                            $cat_name= array();
                            $cat_id= array();

                            while ($rows = mysqli_fetch_array($result)) {
                                array_push($cat_name, $rows['category_name']);
                                array_push($cat_id, $rows['category_id']);
                            }

                            $data = '';
                            $c=0;
                            for($i=0;$i<count($cat_id);$i++){
                                $c=0;
                                for($j=0;$j<=$i;$j++){
                                    if($cat_id[$i]==$expense_cat_id[$j]){
                                        $data.=$expense_amount[$j];
                                        $c=1;
                                        break;
                                    }
                                }
                                if($c==0){
                                    $data.=' 0';
                                }
                                $data.=',';
                            }

                            $new_data = rtrim($data, ", ");

                            echo $new_data;
                            ?>]
                    }]
                };
                a.push(this.respChart(d("#line-chart-example"), "Line", e, {
                    maintainAspectRatio: !1,
                    legend: {display: !1},
                    tooltips: {intersect: !1},
                    hover: {intersect: !0},
                    plugins: {filler: {propagate: !1}},
                    scales: {
                        xAxes: [{reverse: !0, gridLines: {color: "rgba(0,0,0,0.05)"}}],
                        yAxes: [{
                            ticks: {stepSize: 20},
                            display: !0,
                            borderDash: [5, 5],
                            gridLines: {color: "rgba(0,0,0,0)", fontColor: "#fff"}
                        }]
                    }
                }))
            }
            if (0 < d("#radar-chart-example").length) {
                var i, s, c = {
                    labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
                    datasets: [{
                        label: "Desktops",
                        backgroundColor: hexToRGB((s = (i = d("#radar-chart-example").data("colors")) ? i.split(",") : r.concat())[0], .3),
                        borderColor: s[0],
                        pointBackgroundColor: s[0],
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: s[0],
                        data: [65, 59, 90, 81, 56, 55, 40]
                    }, {
                        label: "Tablets",
                        backgroundColor: hexToRGB(s[1], .3),
                        borderColor: s[1],
                        pointBackgroundColor: s[1],
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: s[1],
                        data: [28, 48, 40, 19, 96, 27, 100]
                    }]
                };
                a.push(this.respChart(d("#radar-chart-example"), "Radar", c, {maintainAspectRatio: !1}))
            }
            return a
        }, a.prototype.init = function () {
            var r = this;
            Chart.defaults.global.defaultFontFamily = "Nunito,sans-serif", r.charts = this.initCharts(), d(window).on("resize", function (a) {
                d.each(r.charts, function (a, r) {
                    try {
                        r.destroy()
                    } catch (a) {
                    }
                }), r.charts = r.initCharts()
            })
        }, d.ChartJs = new a, d.ChartJs.Constructor = a
    }(window.jQuery), function () {
        "use strict";
        window.jQuery.ChartJs.init()
    }();
</script>
</body>

</html>