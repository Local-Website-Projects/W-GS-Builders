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
    $unique_id = $_GET['unique_id'];
    $sql = "SELECT * FROM admin_table WHERE unique_id = '$unique_id'";
    $result =  mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    if (isset($_POST['adminProfileUpdate'])) {
        $admin_name = $_POST["admin_name"];
        $admin_email = $_POST["admin_email"];
        $admin_contact_no = $_POST["admin_contact_no"];
        $data = $con->query("select * from admin_table where admin_type = $admin_type")->fetch_assoc();
        if ($_FILES["image"]["name"] == '') {
            $image = $data['image'];
        } else {
            $fileName = $_FILES['image']['tmp_name'];
            $sourceProperties = getimagesize($fileName);
            $resizeFileName = time();
            $uploadPath = "website/";
            $fileExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
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

            $image = $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
        }

        $update_sql = "UPDATE admin_table SET admin_name='$admin_name',admin_email='$admin_email',admin_contact_no='$admin_contact_no',image='$image'  WHERE unique_id='$unique_id' ";

        $update_result = mysqli_query($con, $update_sql);
        if ($update_result == TRUE) {
            $_SESSION['msg'] = "Profile!";
            $_SESSION['status'] = "সফলভাবে আপডেট হয়েছে!";
            $_SESSION['status_code'] = "success";
            ?>
            <script>
                window.location.href = 'Profile';
            </script>
        <?php
        } else {
        $_SESSION['msg'] = "Sorry!";
        $_SESSION['status'] = "দুঃখিত কিছু ভুল হয়ে গেছে, আবার চেষ্টা করুন";
        $_SESSION['status_code'] = "error";
        ?>
            <script>
                window.location.href = 'Profile';
            </script>
            <?php
        }
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
                        <h4 class="page-title">প্রোফাইল</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">প্রোফাইল সম্পাদন</h4>
                            <br>

                            <div class="row">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label>Name*</label>
                                        <input type="text" onKeyDown="javascript: var keycode = keyPressed(event); if(keycode==32){ return false; }" name="admin_name" id="admin_name" value="<?php echo $row['admin_name'] ?>" class="form-control" required />
                                    </div>
                                    <div class="mb-3">
                                        <label>Email*</label>
                                        <input type="text" onKeyDown="javascript: var keycode = keyPressed(event); if(keycode==32){ return false; }" name="admin_email" id="admin_email" value="<?php echo $row['admin_email'] ?>" class="form-control" required />
                                    </div>
                                    <div class="mb-3">
                                        <label>Contact Number*</label>
                                        <input type="text" onKeyDown="javascript: var keycode = keyPressed(event); if(keycode==32){ return false; }" name="admin_contact_no" id="admin_contact_no" value="<?php echo $row['admin_contact_no'] ?>" class="form-control" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="cname">Profile Image</label>
                                        <input type="file" class="form-control" name="image">
                                        <br>
                                        <img src="<?php echo $row['image']; ?>" width="60" height="60"/>
                                    </div>
                                    <button type="submit" name="adminProfileUpdate" id="submit" class="btn btn-dark btn-rounded btn-block">Save Changes</button>
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
include ("includes/js.php");
?>

</body>

</html>