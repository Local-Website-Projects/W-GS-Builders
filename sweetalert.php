<?php
session_start();
?>
<!--- sweet alert popup area --->
<?php
if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    ?>
    <script>
        swal.fire({
            position: 'top-end',
            icon: "<?php echo $_SESSION['status_code']; ?>",
            title: "<?php echo $_SESSION['status']; ?>",
            showConfirmButton: false,
            timer: 4000
        });
    </script>
    <?php
    unset($_SESSION['status']);
}
?>
<!--- sweet alert popup area end --->