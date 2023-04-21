var vc_faculty_dropdown = document.getElementById("Viewfaculty");
var vc_department_dropdown = document.getElementById("Viewdepartment");
var vc_semester = document.getElementById("Viewsemester");
var vc_subject_dropdown = document.getElementById("Viewsubject");
var vc_batch_dropdown = document.getElementById("Viewbatch");

async function getFaculty() {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php"
  );

  var json_data = await response.json();

  // console.log(json_data);

  vc_faculty_dropdown.innerHTML = "Choose Faculty";
  json_data.forEach((item, index) => {
    var option = document.createElement("option");
    option.text = item.facName;
    option.value = item.facID;

    vc_faculty_dropdown.appendChild(option);
  });
}

async function getDepartment(facID) {
  var response = await fetch(
    "http://localhost/UniversityAttendanceSystem/api_data.php?type=department&facID=" +
      facID
  );

  var json_data = await response.json();

  // console.log(json_data);

  vc_department_dropdown.innerHTML = "";
  json_data.forEach((item, index) => {
    var option = document.createElement("option");
    option.value = item.depID;
    option.text = item.depName;

    vc_department_dropdown.appendChild(option);
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

  vc_subject_dropdown.innerHTML = "";
  json_data.forEach((item, index) => {
    var option = document.createElement("option");
    option.value = item.subName;
    option.text = item.subCode;

    vc_subject_dropdown.appendChild(option);
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

    vc_batch_dropdown.appendChild(option);
  });
}

$(document).ready(function () {
  getFaculty();
  getBatch();

  $("#Viewfaculty").change(function () {
    getDepartment(vc_faculty_dropdown.value);
    getSubject(vc_department_dropdown.value, vc_semester.value);
  });

  $("#Viewsemester").change(function () {
    getSubject(vc_department_dropdown.value, vc_semester.value);
  });

  $("#Viewdepartment").change(function () {
    getSubject(vc_department_dropdown.value, vc_semester.value);
  });
});
