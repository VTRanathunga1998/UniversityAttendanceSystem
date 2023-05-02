var faculty_dropdown = document.getElementById("facultyDropdownEditAdmin");
var department_dropdown = document.getElementById(
  "departmentDropdownEditAdmin"
);

async function getFacultyForEditAdmin() {
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

async function getDepartmentForEditAdmin(facID) {
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
function clearDepartmentDropdownForEditAdmin(department_dropdown) {
  if (department_dropdown !== null) {
    // card is set
    department_dropdown.innerHTML = ""; // set the innerHTML of the parent node to an empty string
  }
}

$(document).ready(function () {
  getFacultyForEditAdmin();

  $("#facultyDropdownEditAdmin").change(function () {
    clearDepartmentDropdownForEditAdmin(department_dropdown);
    getDepartmentForEditAdmin(faculty_dropdown.value);
  });
});
