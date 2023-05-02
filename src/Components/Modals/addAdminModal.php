<!-- Modal for Add admin -->
<div class="modal fade" id="addAdmin" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
	<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Add a admin</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<form action="addAdmin.php" method="POST" enctype="multipart/form-data" >		

				<div class="mb-3">
					<label  class="form-label">Admin ID</label>
					<input type="text" class="form-control" name="chooseAdminID" id="" required>
				</div>

				<div class="mb-3">
					<label  class="form-label">First Name</label>
					<input type="text" class="form-control" name="chooseFirstName" id="" pattern="[A-Za-z ]{3,}" title="only letters" required>
				</div>

				<div class="mb-3">
					<label  class="form-label">Last Name</label>
					<input type="text" class="form-control" name="chooseLastName" id="" pattern="[A-Za-z ]{3,}" title="only letters" required>
				</div>

				<div class="mb-3">
					<label  class="form-label">NIC</label>
					<input type="text" name="chooseNIC" class="form-control" id="">
				</div>

				<div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="chooseMail" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>

				<div class="mb-3">
					<label  class="form-label">Mobile Number</label>
					<input type="text" name="chooseMobile" class="form-control" id="" pattern="[0-9]{10}">
				</div>

                <div class="mb-3" id="faculty_div">
					<label class="form-label">Faculty</label>
					<div class="frm-select" >             
						<select id="facultyDropdownAddAdmin" class="form-control" name="chooseFac" required></select>
					</div>
				</div>

				<div class="mb-3" id="department_div">
					<label class="form-label">Department</label>
					<div class="frm-select" >              
						<select id="departmentDropdownAddAdmin" class="form-control" name="chooseDep"required></select>
					</div>
				</div>

				<div class="mb-3" id="activity_div">
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
					<input type="file" class="form-control" name="adminPic" id="adminPic" >
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" name="addAdmin" class="btn btn-primary">Add</button>
				</div>

			</form>		
				
		
			</form>
		</div>		
	</div>
	</div>
</div> 