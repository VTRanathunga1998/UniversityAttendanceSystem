<!-- Modal for Edit lecturer profile-->
<div class="modal fade" id="editStudent" tabindex="-1" aria-labelledby="UpdateStudentModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
	<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Edit profile</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<form action="updateStudent.php" method="POST" enctype="multipart/form-data" >		

				<div class="mb-3">
					<label  class="form-label">Student ID</label>
					<input type="text" class="form-control" name="chooseLecID" value="<?php echo $row['RegNum'] ?>" id="" required>
				</div>

				<div class="mb-3">
					<label  class="form-label">First Name</label>
					<input type="text" class="form-control" name="chooseFirstName" value="<?php echo $row['firstName'] ?>" id="" pattern="[A-Za-z ]{3,}" title="only letters" required>
				</div>

				<div class="mb-3">
					<label  class="form-label">Last Name</label>
					<input type="text" class="form-control" name="chooseLastName" value="<?php echo $row['lastName'] ?>" id="" pattern="[A-Za-z ]{3,}" title="only letters" required>
				</div>

				<div class="mb-3">
					<label  class="form-label">NIC</label>
					<input type="text" name="chooseNIC" class="form-control" value="<?php echo $row['nic'] ?>" id="">
				</div>

				<div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="chooseMail" value="<?php echo $row['email'] ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>

				<div class="mb-3">
					<label  class="form-label">Mobile Number</label>
					<input type="text" name="chooseMobile" class="form-control" value="<?php echo $row['mobileNum'] ?>" id="" pattern="[0-9]{10}">
				</div>

                <div class="mb-3" id="faculty_div">
					<label class="form-label">Faculty</label>
					<div class="frm-select" >             
						<select id="facultyDropdownEditStudent" class="form-control" name="chooseFac" required></select>
					</div>
				</div>

				<div class="mb-3" id="department_div">
					<label class="form-label">Department</label>
					<div class="frm-select" >              
						<select id="departmentDropdownEditStudent" class="form-control" name="chooseDep"required></select>
					</div>
				</div>

                <div class="mb-3" id="batch_div">
					<label class="form-label">Batch</label>
					<div class="frm-select" >              
						<select id="batchDropdownEditStudent" class="form-control" name="chooseBatch"required></select>
					</div>
				</div>

				<div class="mb-3" id="gender_div">
					<label class="form-label">Gender</label>
					<div class="frm-select">             
						<select name="chooseGender" id="" class="form-select mb-2" required>
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
					</div> 
				</div> 

                <div class="mb-3">
					<label  class="form-label">Profile Picture</label>
					<input type="file" class="form-control" name="stdPic" id="stdPic" >
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" name="updateStudent" class="btn btn-primary">Update</button>
				</div>

			</form>		
				
		
			</form>
		</div>		
	</div>
	</div>
</div> 