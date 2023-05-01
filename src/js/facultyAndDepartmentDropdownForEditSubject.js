var faculty_dropdown___ = document.getElementById("facultyDropdownEditSubject");
var department_dropdown___ = document.getElementById(
  "departmentDropdownEditSubject"
);

async function getFacultyForEditSubject() {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php"
  );

  var json_data = await response.json();

  json_data.forEach((item, index) => {
    var option = document.createElement("option");
    option.text = item.facName;
    option.value = item.facID;

    faculty_dropdown___.appendChild(option);
  });
}

async function getDepartmentForEditSubject(facID) {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php?type=department&facID=" +
      facID
  );

  var json_data = await response.json();

  json_data.forEach((item) => {
    var option = document.createElement("option");
    option.value = item.depID;
    option.text = item.depName;

    department_dropdown___.appendChild(option);
  });
}

// clear department dropdown
function clearDepartmentDropdownForEditSubject(department_dropdown___) {
  department_dropdown___.innerHTML = ""; // set the innerHTML of the parent node to an empty string
}

$(document).ready(function () {
  getFacultyForEditSubject();

  $("#facultyDropdownEditSubject").change(function () {
    clearDepartmentDropdownForEditSubject(department_dropdown___);
    getDepartmentForEditSubject(faculty_dropdown___.value);
  });
});
