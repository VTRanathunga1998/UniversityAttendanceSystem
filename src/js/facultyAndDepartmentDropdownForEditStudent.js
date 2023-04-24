var faculty_dropdown = document.getElementById("facultyDropdownEditStudent");
var department_dropdown = document.getElementById(
  "departmentDropdownEditStudent"
);
var batch_dropdown = document.getElementById("batchDropdownEditStudent");

async function getFacultyForEditStudent() {
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

async function getDepartmentForEditStudent(facID) {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php?type=department&facID=" +
      facID
  );

  var json_data = await response.json();

  json_data.forEach((item) => {
    var option = document.createElement("option");
    option.value = item.depID;
    option.text = item.depName;

    department_dropdown.appendChild(option);
  });
}

async function getBatchForEditStudent() {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php?type=batch"
  );

  var json_data = await response.json();

  json_data.forEach((item) => {
    var option = document.createElement("option");
    option.value = item.batch;
    option.text = item.batch;

    batch_dropdown.appendChild(option);
  });
}

// clear department dropdown
function clearDepartmentDropdownForEditStudent(department_dropdown) {
  if (department_dropdown !== null) {
    // card is set
    department_dropdown.innerHTML = ""; // set the innerHTML of the parent node to an empty string
  }
}

$(document).ready(function () {
  getFacultyForEditStudent();
  getBatchForEditStudent();

  $("#facultyDropdownEditStudent").change(function () {
    clearDepartmentDropdownForEditStudent(department_dropdown);
    getDepartmentForEditStudent(faculty_dropdown.value);
  });
});
