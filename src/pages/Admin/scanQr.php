<?php   
    session_start();
    // if(empty($_SESSION['userName'])){
    //     header("Location:logindenied.php");
    // }

    if(empty($_SESSION['sessionID'])){
        header("Location:admin.php?showModal=true&status=unsuccess&message=The session is not created");
        exit();
    } else {
        $sessionID = $_SESSION['sessionID'];
    }

    include_once '../../../database.php';

    define('BASE_DIR', '../../Components/');

    if(isset($_GET['id']) && isset($_GET['status']) ){
        if($_GET['status'] === "success"){
            $index_num = $_GET['id'];

            try{
                $sql = "SELECT * FROM student WHERE RegNum = '$index_num'";

                $result = mysqli_query($connect,$sql);

                while($row = mysqli_fetch_assoc($result)){
                    $studentName = $row['firstName'] ." ". $row['lastName'];
                    $profilePic = @$row['profilePic'];
                }



            } catch (mysqli_sql_exception $e) {
                // Handle the exception
                header("Location:scanQr.php?showModal=true&status=unsuccess&message=Database error");
            } catch(TypeError $ex){
                header("Location:scanQr.php?showModal=true&status=unsuccess&message=Type Error");
            } catch(Exception $e){
                header("Location:scanQr.php?showModal=true&status=unsuccess&message=something went wrong");
            }
        }    
    }

?>


<?php
  // Set page title
  $page_title = "scan qr";

  //Set the heading
  $head_title = "Take attendance";

  //Sub Title
  $sub_title = "scan qr";

  $isTakeattendance = "active";
  
  include BASE_DIR . 'header.php';
?>

<h4><?php echo 'sessionID : '.$sessionID; ?></h4>

<div class="scanning-area">
    <div class="scanner mb-3">
        <form action="markAttendance.php"  class="getQR" method="POST">
            <div>
                <div class="mb-2">
                    <video autoplay="true" id="preview" width="100%"></video>
                </div> 
                
                <div class="mb-3">
                    <label class="form-label">Index Number</label>
                    <input type="text" class="form-control" name="qrcode" id="qrcode" required>
                    <div  class="form-text">Enter index number manually</div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>       
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#end_class">End class</button>       
        </form>
    </div>
    <div class="scan-area"></div>
    <div class="student-details">
        <div class="card text-center student-card" style="width: 18rem; background-color:var(--grey); border:none;">
            
            <?php 
                try{
                    if(isset($profilePic) && $profilePic !== null){
                        echo '
                            <img class="img-fluid mx-auto d-block"
                            src="data:image/jpeg;base64,'.base64_encode( $profilePic ).'"
                            alt="PROFILE PICTURE"
                            style="
                                width: 30% !important;
                                border-radius: 50%;
                                transition: all 0.3s;
                                margin:auto;
                                margin-top: 1rem;
                            "
                            />';
                    } else{
                        echo '
                        <img class="img-fluid mx-auto d-block"
                        src="/UniversityAttendanceSystem/src/Assets/images/profile.jpg"
                        alt="PROFILE PICTURE"
                        style="
                            width: 30% !important;
                            border-radius: 50%;
                            transition: all 0.3s;
                            margin:auto;
                            margin-top: 1rem;
                        "
                        />';
                    }
                } catch(Exception $e){
                    header("Location:scanQr.php?showModal=true&status=unsuccess&message=something went wrong");
                }
            ?>

            <div class="card-body">
                <h5 class="card-title">
                    <?php 
                        if(isset($_GET['id'])){
                            echo $_GET['id'];
                        } else {
                            echo "Index Number";
                        }
                    ?>
                </h5>
                        
                <p class="card-text">
                    <?php 
                        if(isset($studentName)){
                            echo $studentName;
                        } else {
                            echo "Student Name";
                        }
                    ?>
                </p>
                <a 
                    href="studentProfile.php?stdid=<?php 
                                                        if(isset($_GET['id'])){
                                                            echo $_GET['id'];
                                                        }
                                                    ?>" 
                    class="btn btn-primary">View profile
                </a>
            </div>
        </div>
    </div>
</div>    

<?php include BASE_DIR . 'modal.php'; ?>
<?php include BASE_DIR . 'Modals/endClassModal.php'; ?>
<?php include BASE_DIR . 'footertop.php'; ?>

<script>
    $(document).ready(function(){
    // check if the "showModal" parameter is present in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const showModal = urlParams.get('showModal');
    const status = urlParams.get('status');
    if (showModal === 'true' && status==='success') {
        // show the modal popup
        $('#mark_attendance').modal('show');

        window.history.replaceState({}, document.title, window.location.pathname);

        // hide the modal popup after 1 seconds
        setTimeout(function(){
        $('#mark_attendance').modal('hide');
        }, 1000);
    }
    });
</script>



<!--For scan QR-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>

<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> 


<script>
    function requestCamera() {
        // Request access to the camera
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function(stream) {
                // Show the video stream
                var video = document.getElementById('preview');
                video.srcObject = stream;
                video.play();
            })
            .catch(function(error) {
                // Show a prompt to the user if the access is denied or not granted
                alert('Failed to access camera: ' + error.message);
            });
    }

    // Call the requestCamera function when the page loads
    window.addEventListener('load', function() {
        requestCamera();
    });
    
    var scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    
    Instascan.Camera.getCameras().then(function(cameras){

        if(cameras.length > 0){

            scanner.start(cameras[0]);

        }else{

            alert('No cameras found');

        }

    }).catch(function(e) { 
        console.error(e);
    });

    scanner.addListener('scan', function(c){
        document.getElementById('qrcode').value=c;
        // alert(document.getElementById('qrcode').textContent);
        document.forms[1].submit();       
    });
</script>



<?php
  include  BASE_DIR . 'footer.php';
?>