var faculty_dropdown_ = document.getElementById("facultyDropdownUserRegister");
var batch_dropdown_ = document.getElementById("batchDropdownUserRegister");
var department_dropdown_ = document.getElementById(
  "departmentDropdownUserRegister"
);

async function getFacultyForUserRegister() {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php"
  );

  var json_data = await response.json();

  json_data.forEach((item) => {
    var option = document.createElement("option");
    option.text = item.facName;
    option.value = item.facID;

    faculty_dropdown_.appendChild(option);
  });
}

async function getBatchForRegisterUser() {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php?type=batch"
  );

  var json_data = await response.json();

  json_data.forEach((item) => {
    var option = document.createElement("option");
    option.value = item.batch;
    option.text = item.batch;

    batch_dropdown_.appendChild(option);
  });
}

async function getDepartmentForUserRegister(facID) {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php?type=department&facID=" +
      facID
  );

  var json_data = await response.json();

  json_data.forEach((item) => {
    var option = document.createElement("option");
    option.value = item.depID;
    option.text = item.depName;

    department_dropdown_.appendChild(option);
  });
}

// clear department dropdown
function clearDepartmentDropdownForUserRegister(department_dropdown_) {
  if (department_dropdown_ !== null) {
    department_dropdown_.innerHTML = ""; // set the innerHTML of the parent node to an empty string
  }
}

$(document).ready(function () {
  getBatchForRegisterUser();
  getFacultyForUserRegister();

  $("#facultyDropdownUserRegister").change(function () {
    clearDepartmentDropdownForUserRegister(department_dropdown_);
    getDepartmentForUserRegister(faculty_dropdown_.value);
  });
});
