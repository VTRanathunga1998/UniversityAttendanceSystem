var faculty_dropdown = document.getElementById("facultydrop");
var department_dropdown = document.getElementById("departmentdrop");
var card = document.getElementById("department-card");
var studentcard = document.getElementById("student-card");
var lecturercard = document.getElementById("lecturer-card");
var adminCard = document.getElementById("admin-card");

async function getFaculty() {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php"
  );

  var json_data = await response.json();

  // Create "All" option and prepend it to the dropdown
  var allOption = document.createElement("option");
  allOption.text = "All";
  allOption.value = "all";
  faculty_dropdown.appendChild(allOption);

  // Add options from the database after "All" option
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

//Get Lecturer
async function getLecturer(facID = null, depID = null) {
  var url =
    "http://localhost/UniversityAttendanceSystem/api_data.php?type=lecturer";

  if (facID !== null && depID !== null) {
    url += "&facID=" + facID + "&depID=" + depID;
  } else if (facID !== null) {
    url += "&facID=" + facID;
  } else if (depID !== null) {
    url += "&depID=" + depID;
  }

  var response = await fetch(url);

  var json_data = await response.json();

  json_data.forEach((item) => {
    var card = document.createElement("div");

    // Create the card HTML structure
    var cardHtml = `
            <div>
              <div class="card mb-3 h-100 shadow lecturer-card" style="border:none;">
              <img
              class="img-fluid mx-auto d-block"
              src=${
                item.profilePic
                  ? item.profilePic
                  : "/UniversityAttendanceSystem/src/Assets/images/profile.jpg"
              }
              alt="PROFILE PICTURE"
              style="
                width: 100px !important;
                height: 100px !important;
                border-radius: 50%;
                transition: all 0.3s;
                margin: auto;
                margin-top: 1rem;
              "
            />
                <div class="card-body" 
                  style="display:flex; flex-direction:column; align-items:center; justify-content:center; overflow:hidden"
                >
                  <div> 
                    <h5 class="card-title text-center">${item.firstName} ${
      item.lastName
    }</h5>      
                  </div> 
                  <div>
                    <h6 class="card-title text-center">${item.lecturerID}</h6>
                  </div>
                  <div>
                        <a  href="lecturerProfile.php?lecid=${
                          item.lecturerID
                        }" class="btn btn-primary mt-3">View profile</a >
                  </div>
                </div>
              </div>
            </div>
    `;

    // Set the HTML content of the card element to the cardHtml string
    card.innerHTML = cardHtml;

    // Append the card element to the parent element
    lecturercard.appendChild(card);
  });
}

//Get Admin
async function getAdmin(facID = null, depID = null) {
  var url =
    "http://localhost/UniversityAttendanceSystem/api_data.php?type=admin";

  if (facID !== null && depID !== null) {
    url += "&facID=" + facID + "&depID=" + depID;
  } else if (facID !== null) {
    url += "&facID=" + facID;
  } else if (depID !== null) {
    url += "&depID=" + depID;
  }

  var response = await fetch(url);

  var json_data = await response.json();

  json_data.forEach((item) => {
    var card = document.createElement("div");

    // Create the card HTML structure
    var cardHtml = `
            <div>
              <div class="card mb-3 h-100 shadow admin-card" style="border:none;">
              <img
              class="img-fluid mx-auto d-block"
              src=${
                item.profilePic
                  ? item.profilePic
                  : "/UniversityAttendanceSystem/src/Assets/images/profile.jpg"
              }
              alt="PROFILE PICTURE"
              style="
                width: 100px !important;
                height: 100px !important;
                border-radius: 50%;
                transition: all 0.3s;
                margin: auto;
                margin-top: 1rem;
              "
            />
                <div class="card-body" 
                  style="display:flex; flex-direction:column; align-items:center; justify-content:center; overflow:hidden"
                >
                  <div> 
                    <h5 class="card-title text-center">${item.firstName} ${
      item.lastName
    }</h5>      
                  </div> 
                  <div>
                    <h6 class="card-title text-center">${item.adminID}</h6>
                  </div>
                  <div>
                        <a  href="adminProfile.php?adminid=${
                          item.adminID
                        }" class="btn btn-primary mt-3">View profile</a >
                  </div>
                </div>
              </div>
            </div>
    `;

    // Set the HTML content of the card element to the cardHtml string
    card.innerHTML = cardHtml;

    // Append the card element to the parent element
    adminCard.appendChild(card);
  });
}

//Get Student
async function getStudent(facID = null, depID = null) {
  var url =
    "http://localhost/UniversityAttendanceSystem/api_data.php?type=student";

  if (facID !== null && depID !== null) {
    url += "&facID=" + facID + "&depID=" + depID;
  } else if (facID !== null) {
    url += "&facID=" + facID;
  } else if (depID !== null) {
    url += "&depID=" + depID;
  }

  var response = await fetch(url);

  var json_data = await response.json();

  json_data.forEach((item) => {
    var card = document.createElement("div");

    // Create the card HTML structure
    var cardHtml = `
                <div>
                  <div class="card mb-3 h-100 shadow student-card" style="border:none; ">
                  <img
                    class="img-fluid mx-auto d-block"
                    src=${item.profilePic}
                    alt="PROFILE PICTURE"
                    style="
                      width: 100px !important;
                      height: 100px !important;
                      border-radius: 50%;
                      transition: all 0.3s;
                      margin: auto;
                      margin-top: 1rem;
                    "
                  />
                    <div class="card-body" 
                      style="display:flex; flex-direction:column; align-items:center; justify-content:center; overflow:hidden"
                    >
                      <div> 
                        <h5 class="card-title text-center">${item.firstName} ${item.lastName}</h5>      
                      </div> 
                      <div>
                        <h6 class="card-title text-center">${item.RegNum}</h6>
                      </div> 
                      <div>
                        <a  href="studentProfile.php?stdid=${item.RegNum}" class="btn btn-primary mt-3">View profile</a >
                      </div>     
                    </div>
                  </div>
                </div>
    `;

    // Set the HTML content of the card element to the cardHtml string
    card.innerHTML = cardHtml;

    // Append the card element to the parent element
    studentcard.appendChild(card);
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

//clear lecturer card
function clearAdmin(adminCard) {
  if (adminCard !== null) {
    // card is set
    adminCard.innerHTML = ""; // set the innerHTML of the parent node to an empty string
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

    if (studentcard !== null) {
      clearStudent(studentcard);
      var facName =
        faculty_dropdown.options[faculty_dropdown.selectedIndex].innerHTML;
      getStudent(facName);
    }

    if (adminCard !== null) {
      clearAdmin(adminCard);
      var facName =
        faculty_dropdown.options[faculty_dropdown.selectedIndex].innerHTML;
      getAdmin(facName);
    }
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
    }

    if (studentcard !== null) {
      clearStudent(studentcard);

      let depID =
        department_dropdown.options[department_dropdown.selectedIndex]
          .innerHTML;
      let facID =
        faculty_dropdown.options[faculty_dropdown.selectedIndex].innerHTML;

      getStudent(facID, depID);
    }

    if (adminCard !== null) {
      clearAdmin(adminCard);

      let depID =
        department_dropdown.options[department_dropdown.selectedIndex]
          .innerHTML;
      let facID =
        faculty_dropdown.options[faculty_dropdown.selectedIndex].innerHTML;

      getAdmin(facID, depID);
    }
  });
});
