<?php
if (!isset($_SESSION['unique_id'])) {
    ?>
    <script>
        window.location.href = "Welcome";
    </script>
    <?php
}
include('config/dbconfig.php');
$query = "SELECT * FROM `setting`";
$data = mysqli_query($con, $query);
$total = mysqli_num_rows($data);
$title = "";
$logo = "";
$favicon = "";
$office_name = "";
$ofiice_address = "";
$office_contact_no = "";
$office_email = "";
$start_time = "";
$end_time = "";
$est_year = "";
$contact_us = "";
$about_us = "";
$privacy_policy = "";
$terms = "";
if ($total != 0) {
    while ($result = mysqli_fetch_assoc($data)) {
        $title = $result['title'];
        $favicon = $result['favicon'];
        $logo = $result['logo'];
        $office_name = $result['office_name'];
        $ofiice_address = $result['ofiice_address'];
        $contact_us = $result['contact_us'];
        $about_us = $result['about_us'];
        $privacy_policy = $result['privacy_policy'];
        $terms = $result['terms'];
        $office_contact_no = $result['office_contact_no'];
        $start_time = $result['start_time'];
        $end_time = $result['end_time'];
        $office_email = $result['office_email'];
        $est_year = $result['est_year'];
    }
} else {
    "No Records Found!!!";
}
$unique_id = $_SESSION['unique_id'];
$query = "SELECT * FROM `admin_table` where unique_id=$unique_id ";
$data = mysqli_query($con, $query);
$total = mysqli_num_rows($data);

$admin_name = "";
$admin_image = "";
$admin_type = "";
if ($total != 0) {
    while ($result = mysqli_fetch_assoc($data)) {
        $admin_name = $result['admin_name'];
        $admin_type = $result['admin_type'];
        $admin_image = $result['image'];
    }
} else {
    "No Records Found!!!";
}
function get_client_ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

//storing the value inside a variable
$ip = get_client_ip();

$sql = "SELECT * FROM approve_ip WHERE ip_address= '$ip'";
$result =  mysqli_query($con, $sql);
if (mysqli_num_rows($result) != 0) {
    ?>
        <script>
            window.location.href = "Denied?ip=$ip";
        </script>
    <?php
} else {
    ?>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Nezarat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo $favicon;?>">


    <!-- Loading button css -->
    <link href="assets/libs/ladda/ladda.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/ladda/ladda-themeless.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="assets/css/config/default/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="assets/css/config/default/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <!-- icons -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- third party css -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <!-- third party css end -->


    <!-- Plugins css -->
    <link href="assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css"/>

    <!-- App css -->
    <link href="assets/css/config/default/bootstrap.min.css" rel="stylesheet" type="text/css"
          id="bs-default-stylesheet"/>
    <link href="assets/css/config/default/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet"/>

    <link href="assets/css/config/default/bootstrap-dark.min.css" rel="stylesheet" type="text/css"
          id="bs-dark-stylesheet"/>
    <link href="assets/css/config/default/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet"/>

    <!-- icons -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">
    <style>
        @import url('https://fonts.maateen.me/solaiman-lipi/font.css');

        font-family:

        'SolaimanLipi'
        ,
        sans-serif

        ;
        * {
            font-family: 'SolaimanLipi', Arial, sans-serif !important;
        }
        #marquee {
            font-size: 2em;
            color: red;
            font-family: Arial;
            font-weight: bold;
        }
    </style>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Toastr -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <?php
}
?>
