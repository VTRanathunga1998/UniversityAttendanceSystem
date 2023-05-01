var faculty_dropdown_ = document.getElementById("facultyDropdownAddSubject");
var department_dropdown_ = document.getElementById(
  "departmentDropdownAddSubject"
);

async function getFacultyForAddSubject() {
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

async function getDepartmentForAddSubject(facID) {
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
function clearDepartmentDropdownForAddSubject(department_dropdown) {
  department_dropdown.innerHTML = ""; // set the innerHTML of the parent node to an empty string
}

$(document).ready(function () {
  getFacultyForAddSubject();

  $("#facultyDropdownAddSubject").change(function () {
    clearDepartmentDropdownForAddSubject(department_dropdown_);
    getDepartmentForAddSubject(faculty_dropdown_.value);
  });
});
