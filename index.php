<?php
$page_title = "Home";

session_start();
if (isset($_SESSION["userName"])) {
    header("Location:src/pages/Admin/admin.php");
}
?>

    <?php include "src/Components/mainHeader.php"; ?>

    <div class="py-5">
        <div class="container">
            <div class="row flex-grow-1 justify-content-center">
                <div class="col-md-12 text-center ">
                    <div class="clearfix">
                        <img src="src/Assets/images/SUSL_logo.png" class="rounded mx-auto d-block img-fluid" alt="SUSL">
                    </div>
                    <h2>Automated Attendance System</h2>
                    <h5>Sabaragamuwa University Of Sri Lanka</h5>
                    <?php if (isset($_SESSION["loginMessage"])) {
                        echo $_SESSION["loginMessage"];
                        unset($_SESSION["loginMessage"]);
                    } ?>
                </div>
            </div>
        </div>
    </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>