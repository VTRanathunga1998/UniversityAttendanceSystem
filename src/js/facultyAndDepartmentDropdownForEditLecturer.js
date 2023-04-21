var faculty_dropdown = document.getElementById("facultyDropdownEditLecturer");
var department_dropdown = document.getElementById(
  "departmentDropdownEditLecturer"
);

async function getFacultyForEditLecturer() {
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

async function getDepartmentForEditLecturer(facID) {
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

// clear department dropdown
function clearDepartmentDropdownForEditLecturer(department_dropdown) {
  if (department_dropdown !== null) {
    // card is set
    department_dropdown.innerHTML = ""; // set the innerHTML of the parent node to an empty string
  }
}

$(document).ready(function () {
  getFacultyForEditLecturer();

  $("#facultyDropdownEditLecturer").change(function () {
    clearDepartmentDropdownForEditLecturer(department_dropdown);
    getDepartmentForEditLecturer(faculty_dropdown.value);
  });
});
