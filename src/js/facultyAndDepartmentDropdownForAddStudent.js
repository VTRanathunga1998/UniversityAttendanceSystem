var faculty_dropdown__ = document.getElementById("facultyDropdownAddStudent");
var department_dropdown__ = document.getElementById(
  "departmentDropdownAddStudent"
);
var batch__ = document.getElementById("batchAddStudent");

async function getFacultyForAddStudent() {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php"
  );

  var json_data = await response.json();

  json_data.forEach((item) => {
    var option = document.createElement("option");
    option.text = item.facName;
    option.value = item.facID;

    faculty_dropdown__.appendChild(option);
  });
}

async function getDepartmentForAddStudent(facID) {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php?type=department&facID=" +
      facID
  );

  var json_data = await response.json();

  json_data.forEach((item) => {
    var option = document.createElement("option");
    option.value = item.depID;
    option.text = item.depName;

    department_dropdown__.appendChild(option);
  });
}

async function getBatchForAddStudent() {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php?type=batch"
  );

  var json_data = await response.json();

  json_data.forEach((item) => {
    var option = document.createElement("option");
    option.value = item.batch;
    option.text = item.batch;

    batch__.appendChild(option);
  });
}

// clear department dropdown
function clearDepartmentDropdownForAddStudent(department_dropdown__) {
  if (department_dropdown__ !== null) {
    // card is set
    department_dropdown__.innerHTML = ""; // set the innerHTML of the parent node to an empty string
  }
}

$(document).ready(function () {
  getFacultyForAddStudent();
  getBatchForAddStudent();

  $("#facultyDropdownAddStudent").change(function () {
    clearDepartmentDropdownForAddStudent(department_dropdown__);
    getDepartmentForAddStudent(faculty_dropdown__.value);
  });
});
