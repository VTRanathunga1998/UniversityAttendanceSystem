var facultyDropdown = document.getElementById("facultyDropdown");

async function getFacultyForAddDepartment() {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php"
  );

  var json_data = await response.json();

  console.log(json_data);

  json_data.forEach((item) => {
    var option = document.createElement("option");
    option.text = item.facName;
    option.value = item.facID;

    facultyDropdown.appendChild(option);
  });
}

$(document).ready(function () {
  getFacultyForAddDepartment();
});
