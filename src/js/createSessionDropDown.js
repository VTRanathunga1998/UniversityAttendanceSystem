var faculty_dropdown = document.getElementById("faculty");
var department_dropdown = document.getElementById("department");
var semester = document.getElementById("semester");
var subject_dropdown = document.getElementById("subject");
var batch_dropdown = document.getElementById("batch");

async function getFaculty() {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php"
  );

  var json_data = await response.json();

  // console.log(json_data);

  faculty_dropdown.innerHTML = "Choose Faculty";
  json_data.forEach((item, index) => {
    var option = document.createElement("option");
    option.text = item.facName;
    option.value = item.facID;

    faculty_dropdown.appendChild(option);
  });
}

async function getDepartment(facID) {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php?type=department&facID=" +
      facID
  );

  var json_data = await response.json();

  // console.log(json_data);

  department_dropdown.innerHTML = "";
  json_data.forEach((item, index) => {
    var option = document.createElement("option");
    option.value = item.depID;
    option.text = item.depName;

    department_dropdown.appendChild(option);
  });
}

async function getSubject(depID, semester) {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php?type=subject&depID=" +
      depID +
      "&semester=" +
      semester
  );

  var json_data = await response.json();

  // console.log(json_data);

  subject_dropdown.innerHTML = "";
  json_data.forEach((item, index) => {
    var option = document.createElement("option");
    option.value = item.subName;
    option.text = item.subCode;

    subject_dropdown.appendChild(option);
  });
}

async function getBatch() {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php?type=batch"
  );

  var json_data = await response.json();

  json_data.forEach((item, index) => {
    var option = document.createElement("option");
    option.value = item.batch;
    option.text = item.batch;

    batch_dropdown.appendChild(option);
  });
}

$(document).ready(function () {
  getFaculty();
  getBatch();

  $("#faculty").change(function () {
    getDepartment(faculty_dropdown.value);
    getSubject(department_dropdown.value, semester.value);
  });

  $("#semester").change(function () {
    getSubject(department_dropdown.value, semester.value);
  });

  $("#department").change(function () {
    getSubject(department_dropdown.value, semester.value);
  });
});
