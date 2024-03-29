<?php
    session_start();

    if (!isset($_SESSION["userName"])) {
      header("Location: login/login.php");
      exit();
    }

  define('BASE_DIR', '../../Components/');

  include_once '../../../database.php';

  // Set page title
  $page_title = "Dashboard";

  //Set the heading
  $head_title = "Dashboard";

  //Sub Title
  $sub_title = "View faculty";

  $isDashboard = "active";
  
  include BASE_DIR . 'header.php';
?>

<div class="mb-3 action-bar" style="
  disay:flex;
  flex-direction:row;
  align-items:center;
  justify-content:space-between;
">

  <div>
    <a href="/UniversityAttendanceSystem/src/pages/Admin/admin.php" class="btn button-icon btn-primary-soft btn-icon-back" >
      Back
    </a>
  </div>
  <div>
    <button type="button" class="btn btn-primary button-icon" data-bs-toggle="modal" data-bs-target="#addFaculty" style="background-image: url('../../Assets/images/icons/add.svg');"> 
    Add faculty</button>
  </div>
</div>
<div class="d-flex flex-wrap" id="faculty-card">
<?php
  try {
    // Select data from the "faculty" table
    $sql = "SELECT * FROM faculty";
    $result = $connect->query($sql);

    // Check if there are any rows in the result set
    if ($result->num_rows > 0) {
      // Counter to keep track of cards in the current row
      $cardCount = 0;

      // Output data of each row
      while ($row = $result->fetch_assoc()) {
        if (isset($row['facPic'])) {
          $image_src = $row['facPic'];
        } else {
          $image_src = "../../Assets/images/university.jpg";
        }

        // Display the data on Bootstrap cards
        echo '<div class="card g-4" style="width: calc(33.33% - 20px); margin-right: 20px; margin-bottom: 20px;">
          <img src='.$image_src.' class="card-img-top" alt="...">
          <div class="card-body" >
            <h5 class="card-title text-center">'. $row["facName"] .'</h5>
            <p class="card-text text-center" style="padding-top: 20px; padding-bottom: 20px;">'. substr($row["description"],0,100).'...<a href='.$row['email'].' target="_blank">See more</a></p>
          </div>
        </div>';

        // Increment the card count
        $cardCount++;

        // Check if three cards are displayed in the current row
        if ($cardCount >= 3) {
          echo '</div><div class="d-flex flex-wrap" id="faculty-card">';
          $cardCount = 0;
        }
      }

      // Close any remaining open row
      if ($cardCount > 0) {
        echo '</div>';
      }
    } else {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
              0 Results
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
  } catch (mysqli_sql_exception $e) {
    echo "Error";
  }

  // Close the database connection
  $connect->close();
?>
</div>


<?php
  include '../../Components/modal.php';
  include  BASE_DIR . 'footertop.php';
?>

<script>
    $(document).ready(function(){
    // check if the "showModal" parameter is present in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const showModal = urlParams.get('showModal');
    const status = urlParams.get('status');
    if (showModal === 'true' && status==='success') {
        // show the modal popup
        $('#success').modal('show');
        // hide the modal popup after 1 seconds
        setTimeout(function(){
        $('#success').modal('hide');
        }, 1000);

        //jQuery code to clear URL parameters on modal close with delay
        window.history.replaceState({}, document.title, window.location.pathname);
    }
    });
</script>

<?php
  include  BASE_DIR . 'footer.php';
?>