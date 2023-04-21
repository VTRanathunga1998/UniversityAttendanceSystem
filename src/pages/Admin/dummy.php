<?php
//Get all the batches 
try{
    $query = "SELECT batch FROM batch";
    
    // 
    if (!($result_set = mysqli_query($connect,$query))) {
      throw new mysqli_sql_exception("Failed to connect to MySQL: ");
    }

    $batch = '';

    while($result = mysqli_fetch_assoc($result_set)){
      $batch .= "<option value = \"{$result['batch']}\">{$result['batch']}</option>";
    }
  } catch (mysqli_sql_exception $e) {
    // Handle the exception
    header("Location:viewAttendance.php?showModal=true&status=unsuccess&message=Database connection error");
  }
?>




<?php
    try{
      // Select data from the "department" table
      $sql = "SELECT * FROM department";
      $result = $connect->query($sql);

      // Check if there are any rows in the result set
    if ($result->num_rows > 0) {
      // Output data of each row
      while($row = $result->fetch_assoc()) {
          // Display the data on Bootstrap cards
          echo '<div>
            <div class="card mb-3 h-100 shadow department-card" style="border:none;">
              <img src="/UniversityAttendanceSystem/src/Assets/images/university.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h4 class="card-title">'. $row["depName"] .'</h4>
              
            </div>
          </div>
          </div>';
      }
      } else {
        echo "0 results";
      }

    } catch(mysqli_sql_exception $e){
      echo "Error";
    }

    // Close the database connection
    $connect->close();

  ?>





async function getFaculty() {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php"
  );

  var json_data = await response.json();

  json_data.forEach((item, index) => {
    var option = document.createElement("option");
    option.text = item.facName;
    option.value = item.facID;

    faculty_dropdown.appendChild(option);
  });
}

// Get gepartment
async function getDepartment(facID) {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php?type=department&facID=" +
      facID
  );

  var json_data = await response.json();

  console.log(json_data);

  json_data.forEach((item) => {
    var cardElementRoot = document.createElement("div");

    var cardElement = document.createElement("div");
    cardElement.classList = "card mb-3 h-100 shadow department-card";
    cardElement.style.border = "none";

    var cardImage = document.createElement("img");
    cardImage.classList = "card-img-top";
    cardImage.src =
      "/UniversityAttendanceSystem/src/Assets/images/university.jpg";

    var cardBody = document.createElement("div");
    cardBody.classList = "card-body";
    cardBody.style.cssText =
      "display:flex; align-items:center; justify-content:center;";

    var cardTitle = document.createElement("h5");
    cardTitle.classList = "card-title text-center";
    cardTitle.textContent = item.depName;

    var cardFooter = document.createElement("div");
    cardFooter.classList = "card-footer text-center";
    cardFooter.style.cssText = "border:none";

    var footerButton = document.createElement("a");
    footerButton.classList = "link-primary";
    footerButton.href = "www.google.com";
    footerButton.style.cssText = "cursor:pointer;";
    footerButton.textContent = "See more...";

    if (card !== null) {
      // department_dropdown is set
      card.appendChild(cardElementRoot);
      cardElementRoot.appendChild(cardElement);
      cardElement.appendChild(cardImage);
      cardElement.appendChild(cardBody);
      cardElement.appendChild(cardFooter);
      cardFooter.appendChild(footerButton);
      cardBody.appendChild(cardTitle);
    }
  });

  json_data.forEach((item) => {
    if (department_dropdown !== null) {
      var option = document.createElement("option");
      option.value = item.depID;
      option.text = item.depName;

      department_dropdown.appendChild(option);
    }
  });
}
//Get Student
async function getStudent(facID, depID) {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php?type=student&facID=" +
      facID +
      "&depID=" +
      depID
  );

  var json_data = await response.json();

  json_data.forEach((item) => {
    var cardElementRoot = document.createElement("div");

    var cardElement = document.createElement("div");
    cardElement.classList = "card mb-3 h-100 shadow department-card";
    cardElement.style.border = "none";

    var cardImage = document.createElement("img");
    cardImage.classList = "card-img-top";
    cardImage.src =
      "/UniversityAttendanceSystem/src/Assets/images/university.jpg";

    var cardBody = document.createElement("div");
    cardBody.classList = "card-body";
    cardBody.style.cssText =
      "display:flex; align-items:center; justify-content:center;";

    var cardTitle = document.createElement("h5");
    cardTitle.classList = "card-title text-center";
    cardTitle.textContent = item.depName;

    var cardFooter = document.createElement("div");
    cardFooter.classList = "card-footer text-center";
    cardFooter.style.cssText = "border:none";

    var footerButton = document.createElement("a");
    footerButton.classList = "link-primary";
    footerButton.href = "www.google.com";
    footerButton.style.cssText = "cursor:pointer;";
    footerButton.textContent = "See more...";

    if (studentcard !== null) {
      // department_dropdown is set
      studentcard.appendChild(cardElementRoot);
      cardElementRoot.appendChild(cardElement);
      cardElement.appendChild(cardImage);
      cardElement.appendChild(cardBody);
      cardElement.appendChild(cardFooter);
      cardFooter.appendChild(footerButton);
      cardBody.appendChild(cardTitle);
    }

    if (department_dropdown !== null) {
      var option = document.createElement("option");
      option.value = item.depID;
      option.text = item.depName;

      department_dropdown.appendChild(option);
    }
  });
}

//Get Lecturer
async function getLecturer(facID = null, depID = null) {
  let url =
    "http://localhost/UniversityAttendanceSystem/api_data.php?type=lecturer";

  if (facID !== null && depID !== null) {
    url += "&facID=" + facID + "&depID=" + depID;
  } else if (facID !== null) {
    url += "&facID=" + facID;
  } else if (depID !== null) {
    url += "&depID=" + depID;
  }

  var response = await fetch(url);

  console.log(response);

  var json_data = await response.json();

  json_data.forEach((item) => {
    var cardElementRoot = document.createElement("div");

    var cardElement = document.createElement("div");
    cardElement.classList = "card mb-3 h-100 shadow department-card";
    cardElement.style.border = "none";

    var cardImage = document.createElement("img");
    cardImage.classList = "card-img-top";
    cardImage.src =
      "/UniversityAttendanceSystem/src/Assets/images/university.jpg";

    var cardBody = document.createElement("div");
    cardBody.classList = "card-body";
    cardBody.style.cssText =
      "display:flex; align-items:center; justify-content:center;";

    var cardTitle = document.createElement("h5");
    cardTitle.classList = "card-title text-center";
    cardTitle.textContent = item.firstName;

    var cardFooter = document.createElement("div");
    cardFooter.classList = "card-footer text-center";
    cardFooter.style.cssText = "border:none";

    var footerButton = document.createElement("a");
    footerButton.classList = "link-primary";
    footerButton.href = "www.google.com";
    footerButton.style.cssText = "cursor:pointer;";
    footerButton.textContent = "See more...";

    if (lecturercard !== null) {
      // department_dropdown is set
      lecturercard.appendChild(cardElementRoot);
      cardElementRoot.appendChild(cardElement);
      cardElement.appendChild(cardImage);
      cardElement.appendChild(cardBody);
      cardElement.appendChild(cardFooter);
      cardFooter.appendChild(footerButton);
      cardBody.appendChild(cardTitle);
    }
  });
}

// clear department card
function clearDepartment(card) {
  if (card !== null) {
    // card is set
    card.innerHTML = ""; // set the innerHTML of the parent node to an empty string
  }
}

// clear department dropdown
function clearDepartmentDropdown(department_dropdown) {
  if (department_dropdown !== null) {
    // card is set
    department_dropdown.innerHTML = ""; // set the innerHTML of the parent node to an empty string
  }
}

//clear student card
function clearStudent(studentcard) {
  if (studentcard !== null) {
    // card is set
    studentcard.innerHTML = ""; // set the innerHTML of the parent node to an empty string
  }
}

//clear lecturer card
function clearLecturer(lecturercard) {
  if (lecturercard !== null) {
    // card is set
    lecturercard.innerHTML = ""; // set the innerHTML of the parent node to an empty string
  }
}

$(document).ready(function () {
  getFaculty();
  $("#facultydrop").change(function () {
    clearDepartment(card);
    clearDepartmentDropdown(department_dropdown);
    getDepartment(faculty_dropdown.value);

    if (lecturercard !== null) {
      clearLecturer(lecturercard);
      var facName =
        faculty_dropdown.options[faculty_dropdown.selectedIndex].innerHTML;
      getLecturer(facName);
    }

    console.log(department_dropdown.value);
  });

  $("#departmentdrop").change(function () {
    if (lecturercard !== null) {
      clearLecturer(lecturercard);

      let depID =
        department_dropdown.options[department_dropdown.selectedIndex]
          .innerHTML;
      let facID =
        faculty_dropdown.options[faculty_dropdown.selectedIndex].innerHTML;

      getLecturer(facID, depID);
    } else if (studentcard !== null) {
      clearStudent(studentcard);

      let depID =
        department_dropdown.options[department_dropdown.selectedIndex]
          .innerHTML;
      let facID =
        faculty_dropdown.options[faculty_dropdown.selectedIndex].innerHTML;

      getStudent(facID, depID);
    }
  });
});


<?php

    session_start();

    include 'database.php';

    if(isset($_POST['addMember'])){
        $id = $_POST['id'];
        $role = $_POST['chooseRole'];
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $nic = $_POST['nic'];
        $email = $_POST['email'];
        $gender = $_POST['chooseGender'];
        $mobNum = $_POST['mobNum'];
        $faculty = $_POST['chooseFac'];
        $department = $_POST['chooseDep'];
        $batch = $_POST['chooseBatch'];
        $profilePic = file_get_contents($_FILES['profilePic']['tmp_name']);
    }

    $sql = "SELECT faculty.facName,department.depName FROM faculty INNER JOIN department ON department.facID = faculty.facID WHERE department.depID = ?";

    if ($stmt = mysqli_prepare($connect, $sql)) {

        mysqli_stmt_bind_param($stmt, "i", $department);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) == 1){
            while($row = mysqli_fetch_assoc($result)){  

                $faculty = $row['facName'];
                $department = $row['depName']; 

                $hashedPass = password_hash("@Abc123",PASSWORD_DEFAULT);

                $sql = "INSERT INTO user(userName,password,role) VALUES(?,?,?)";
                if ($stmt = mysqli_prepare($connect, $sql)) {

                    mysqli_stmt_bind_param($stmt, "sss", $id, $hashedPass, $role);
                    mysqli_stmt_execute($stmt);

                    if($role == "Admin"){
                        $sql = "INSERT INTO admin(adminID,firstName,lastName,faculty,nic,mobileNum,gender,email,department,userName,profilePic) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
                        if ($stmt = mysqli_prepare($connect, $sql)) {

                            mysqli_stmt_bind_param($stmt, "sssssssssss", $id, $fName, $lName, $faculty, $nic, $mobNum, $gender, $email, $department, $id, $profilePic);
                            mysqli_stmt_execute($stmt);

                            echo '<script>if(confirm("Successfully added")) document.location = "adminProfile.php";</script>';
                            exit();
                        }
                    }elseif($role == "Student"){
                        $sql = "INSERT INTO student(RegNum,firstName,lastName,email,faculty,department,gender,mobileNum,userName,nic,batch,profilePic) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
                        if ($stmt = mysqli_prepare($connect, $sql)) {

                            mysqli_stmt_bind_param($stmt, "ssssssssssss", $id, $fName, $lName, $email, $faculty, $department, $gender, $mobNum, $id, $nic, $batch, $profilePic);
                            mysqli_stmt_execute($stmt);

                            echo '<script>if(confirm("Successfully added")) document.location = "adminProfile.php";</script>';
                            exit();
                        }
                    }elseif($role == "Lecturer"){
                        $sql = "INSERT INTO lecturer(lecturerID,firstName,lastName,gender,nic,faculty,department,email,userName,profilePic) VALUES(?,?,?,?,?,?,?,?,?,?)";
                        if ($stmt = mysqli_prepare($connect, $sql)) {

                            mysqli_stmt_bind_param($stmt, "ssssssssss", $id, $fName,$lName, $email, $faculty, $department, $gender, $mobNum, $id, $nic, $batch, $profilePic);
                            mysqli_stmt_execute($stmt);

                            echo '<script>if(confirm("Successfully added")) document.location = "adminProfile.php";</script>';
                            exit();
                        }
                    }
                }
            }
        }
    }                    

?> 



<?php
    $sql = "SELECT facPic FROM faculty WHERE facID = 'gs_susl'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);
    
    $image = $row['facPic'];
    $image_src = "../../Assets/uploads/".$image;
?>
<img src="<?php echo $image_src; ?>" >