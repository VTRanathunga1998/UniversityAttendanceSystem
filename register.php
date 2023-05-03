<?php 
    $page_title = 'Register';
  session_start();
?>

<?php include 'src/Components/mainHeader.php' ?> 

<div class="p-5 ">

    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <div class="card shadow overflow-auto" > 
                <div class="card-header">
                    <h5>Register Form</h5>
                </div>
                <div class="card-body">
                    <form action="approval.php" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label>Pick up a role</label>
                            <select class="form-select" name="chooseRole" id="role" aria-label="Default select example">
                                <option value="Student" >Student</option>
                                <option value="Lecturer" selected>Lecturer</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">ID</label>
                            <input type="text" class="form-control" name = "id" placeholder="Enter Register Number / Lecturer ID" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">First name</label>
                            <input type="text" class="form-control" name ="fName" placeholder="Enter first name" pattern="[A-Za-z ]{3,}" title="only letters" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Last name</label>
                            <input type="text" class="form-control" name ="lName" placeholder="Enter last name" pattern="[A-Za-z ]{3,}" title="only letters" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">NIC</label>
                            <input type="text" class="form-control" name = "nic" placeholder="Enter nic" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mobile number</label>
                            <input type="text" class="form-control" name = "mobNum" placeholder="Enter mobile number" pattern="[0-9]{10}" title="only numeric values are accepted" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name = "email" placeholder="Enter email" aria-describedby="emailHelp" required>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>

                        <div class="mb-3">
                            <label>Faculty</label>
                            <select class="form-select" name="chooseFac" id="facultyDropdownUserRegister" required></select>
                        </div>

                        <div class="mb-3">
                            <label>Department</label>
                            <select class="form-select" name="chooseDep" id="departmentDropdownUserRegister" required></select>
                        </div>

                        <div class="mb-3">
                            <label>Gender</label>
                            <select class="form-select" name="chooseGender" id="gender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="mb-3" id="batch_div">
                            <label>Batch</label>
                            <select class="form-select" name="chooseBatch" id="batchDropdownUserRegister" required></select>
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Profile picture</label>
                            <input class="form-control" type="file" name = "profilePic" id="profilePic">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name = "password" placeholder="Enter password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                            title="Password is too weak. At least 8-12 characters long but 14 or more is better. A combination of uppercase letters, lowercase letters, numbers, and symbols" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm password</label>
                            <input type="password" class="form-control" name = "confirmPassword" placeholder="Re - enter password" required>
                        </div>

                        <button type="submit" class="btn btn-primary" name="register">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Hide batch -->
<script>
    var role = document.getElementById("role");
    var batch = document.getElementById("batch_div");

    batch_div.style.display = "none";

    function hideBatch(){
        batch_div.style.display = "none";
    }

    function unhideBatch(){
        batch_div.style.display = "block";
    }
    
    $(document).ready(function () {
        $("#role").change(function () {
            if(role.value=="Lecturer"){ 
                hideBatch();
            } else {
                unhideBatch();
            }
        });          
    });
</script>    

<script src="src/js/facultyAndDepartmentDropdownForRegisterUser.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>