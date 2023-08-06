var faculty_dropdown_ = document.getElementById("facultyDropdownAddLecturer");
var department_dropdown_ = document.getElementById(
  "departmentDropdownAddLecturer"
);

async function getFacultyForAddLecturer() {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php"
  );

  var json_data = await response.json();

  json_data.forEach((item, index) => {
    var option = document.createElement("option");
    option.text = item.facName;
    option.value = item.facID;

    faculty_dropdown_.appendChild(option);
  });
}

async function getDepartmentForAddLecturer(facID) {
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
function clearDepartmentDropdownForAddLecturer(department_dropdown_) {
  if (department_dropdown_ !== null) {
    // card is set
    department_dropdown_.innerHTML = ""; // set the innerHTML of the parent node to an empty string
  }
}

$(document).ready(function () {
  getFacultyForAddLecturer();

  $("#facultyDropdownAddLecturer").change(function () {
    clearDepartmentDropdownForAddLecturer(department_dropdown_);
    getDepartmentForAddLecturer(faculty_dropdown_.value);
  });
});
