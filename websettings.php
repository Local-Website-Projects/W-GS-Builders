<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!---cdn css files area start-->
    <?php
    require_once('includes/css.php');
    function resizeImage($resourceType, $image_width, $image_height, $resizeWidth, $resizeHeight)
    {
        // $resizeWidth = 100;
        // $resizeHeight = 100;
        $imageLayer = imagecreatetruecolor($resizeWidth, $resizeHeight);
        $background = imagecolorallocate($imageLayer, 0, 0, 0);
        // removing the black from the placeholder
        imagecolortransparent($imageLayer, $background);

        // turning off alpha blending (to ensure alpha channel information
        // is preserved, rather than removed (blending with the rest of the
        // image in the form of black))
        imagealphablending($imageLayer, false);

        // turning on alpha channel information saving (to ensure the full range
        // of transparency is preserved)
        imagesavealpha($imageLayer, true);
        imagecopyresampled($imageLayer, $resourceType, 0, 0, 0, 0, $resizeWidth, $resizeHeight, $image_width, $image_height);
        return $imageLayer;
    }

    ?>

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
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">ওয়েবসাইটের তথ্য</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">ওয়েবসাইটের তথ্য সম্পাদন</h4>
                            <br>

                            <div class="row">
                                <form class="form" method="post" enctype="multipart/form-data">
                                    <div class="form-body row">
                                        <?php
                                        $unique_id = $_GET['unique_id'];
                                        $getkey = $con->query("SELECT * from setting WHERE unique_id='$unique_id'")->fetch_assoc();
                                        ?>
                                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                            <div class="mb-3">
                                                <label for="cname">Office name/title</label>
                                                <input type="text" id="cname" class="form-control" name="office_name"
                                                       value="<?php echo $getkey['office_name']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                            <div class="mb-3">
                                                <label for="cname">Address</label>
                                                <input type="text" id="cname" class="form-control" name="ofiice_address"
                                                       value="<?php echo $getkey['ofiice_address']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                            <div class="mb-3">
                                                <label for="cname">Contact Number</label>
                                                <input type="text" id="cname" class="form-control"
                                                       name="office_contact_no"
                                                       value="<?php echo $getkey['office_contact_no']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                            <div class="mb-3">
                                                <label for="cname">E-mail</label>
                                                <input type="email" id="cname" class="form-control" name="office_email"
                                                       value="<?php echo $getkey['office_email']; ?>">
                                            </div>
                                        </div>


                                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                            <div class="mb-3">
                                                <label for="cname">Start Time</label>
                                                <input type="time" id="cname" class="form-control" name="start_time"
                                                       value="<?php echo $getkey['start_time']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                            <div class="mb-3">
                                                <label for="cname">End Time</label>
                                                <input type="time" id="cname" class="form-control" name="end_time"
                                                       value="<?php echo $getkey['end_time']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                            <div class="mb-3">
                                                <label for="cname">Establishment Year</label>
                                                <input type="number" id="cname" class="form-control" name="est_year"
                                                       value="<?php echo $getkey['est_year']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                            <div class="mb-3">
                                                <label for="cname">Owner name</label>
                                                <input type="text" id="cname" class="form-control" name="owner_name"
                                                       value="<?php echo $getkey['owner_name']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                            <div class="mb-3">
                                                <label for="cname">Sample Logo<b class="text-danger">(Choose Only One
                                                        Letter*)</b></label>
                                                <input type="text" id="cname" maxlength="1" class="form-control"
                                                       name="title" value="<?php echo $getkey['title']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                            <div class="mb-3">
                                                <label for="cname">Website Logo</label>
                                                <input type="file" class="form-control" name="logo">
                                                <br>
                                                <img src="<?php echo $getkey['logo']; ?>" width="60" height="60"/>
                                            </div>
                                        </div>


                                        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                            <div class="mb-3">
                                                <label for="cname">Website Favicon</label>
                                                <input type="file" class="form-control" name="favicon">
                                                <br>
                                                <img src="<?php echo $getkey['favicon']; ?>" width="60" height="60"/>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" name="sub_cat" class="btn btn-outline-primary btn-rounded waves-effect waves-light">Update Setting
                                        </button>
                                    </div>

                                    <?php
                                    if (isset($_POST['sub_cat'])) {
                                        $office_name = $_POST['office_name'];
                                        $ofiice_address = $_POST['ofiice_address'];
                                        $office_contact_no = $_POST['office_contact_no'];
                                        $office_email = $_POST['office_email'];
                                        $title = mysqli_real_escape_string($con, $_POST['title']);
                                        $p_data = $_POST['p_data'];
                                        $a_data = $_POST['a_data'];
                                        $c_data = $_POST['c_data'];
                                        $est_year = $_POST['est_year'];
                                        $terms = $_POST['terms'];
                                        $owner_name = $_POST['owner_name'];
                                        $start_time = $_POST['start_time'];
                                        $end_time = $_POST['end_time'];
                                        $data = $con->query("select * from setting")->fetch_assoc();
                                        if ($_FILES["favicon"]["name"] == '') {
                                            $favicon = $data['favicon'];
                                        } else {
                                            $fileName = $_FILES['favicon']['tmp_name'];
                                            $sourceProperties = getimagesize($fileName);
                                            $resizeFileName = time();
                                            $uploadPath = "website/";
                                            $fileExt = pathinfo($_FILES['favicon']['name'], PATHINFO_EXTENSION);
                                            $uploadImageType = $sourceProperties[2];
                                            $sourceImageWidth = $sourceProperties[0];
                                            $sourceImageHeight = $sourceProperties[1];
                                            $new_width = $sourceImageWidth;
                                            $new_height = $sourceImageHeight;
                                            switch ($uploadImageType) {
                                                case IMAGETYPE_JPEG:
                                                    $resourceType = imagecreatefromjpeg($fileName);
                                                    $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                                                    imagejpeg($imageLayer, $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);
                                                    break;

                                                case IMAGETYPE_GIF:
                                                    $resourceType = imagecreatefromgif($fileName);
                                                    $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                                                    imagegif($imageLayer, $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);
                                                    break;

                                                case IMAGETYPE_PNG:

                                                    $resourceType = imagecreatefrompng($fileName);
                                                    $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                                                    imagepng($imageLayer, $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);

                                                    break;

                                                default:
                                                    $imageProcess = 0;
                                                    break;
                                            }

                                            $favicon = $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                                        }


                                        if ($_FILES["logo"]["name"] == '') {
                                            $logo = $data['logo'];
                                        } else {
                                            $fileName = $_FILES['logo']['tmp_name'];
                                            $sourceProperties = getimagesize($fileName);
                                            $resizeFileName = time();
                                            $uploadPath = "website/";
                                            $fileExt = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
                                            $uploadImageType = $sourceProperties[2];
                                            $sourceImageWidth = $sourceProperties[0];
                                            $sourceImageHeight = $sourceProperties[1];
                                            $new_width = $sourceImageWidth;
                                            $new_height = $sourceImageHeight;
                                            switch ($uploadImageType) {
                                                case IMAGETYPE_JPEG:
                                                    $resourceType = imagecreatefromjpeg($fileName);
                                                    $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                                                    imagejpeg($imageLayer, $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);
                                                    break;

                                                case IMAGETYPE_GIF:
                                                    $resourceType = imagecreatefromgif($fileName);
                                                    $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                                                    imagegif($imageLayer, $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);
                                                    break;

                                                case IMAGETYPE_PNG:

                                                    $resourceType = imagecreatefrompng($fileName);
                                                    $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                                                    imagepng($imageLayer, $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);

                                                    break;

                                                default:
                                                    $imageProcess = 0;
                                                    break;
                                            }

                                            $logo = $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                                        }

                                        $websetting_update_query = $con->query("UPDATE setting set office_name='" . $office_name . "',ofiice_address='" . $ofiice_address . "',office_contact_no='" . $office_contact_no . "',favicon='" . $favicon . "',logo='" . $logo . "',title='" . $title . "',owner_name='" . $owner_name . "',office_email='" . $office_email . "',start_time='" . $start_time . "',end_time='" . $end_time . "',est_year=" . $est_year . " WHERE unique_id='$unique_id'");
                                        if ($websetting_update_query == TRUE) {
                                            $_SESSION['msg'] = "Website info!";
                                            $_SESSION['status'] = "সফলভাবে আপডেট হয়েছে!";
                                            $_SESSION['status_code'] = "success";
                                            ?>
                                            <script>
                                                window.location.href = 'Webinfo';
                                            </script>
                                            <?php
                                        }
                                    }
                                    ?>
                                </form>

                            </div>
                            <!-- end row-->

                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div>

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

</body>

</html>