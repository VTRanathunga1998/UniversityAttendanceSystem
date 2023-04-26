<!-- Modal for Add lecturer -->
<div class="modal fade" id="addSubject" tabindex="-1" aria-labelledby="addSubjectModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
	<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Add a Subject</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<form action="addSubject.php" method="POST" enctype="multipart/form-data" >		

				<div class="mb-3">
					<label  class="form-label">Subject ID</label>
					<input type="text" class="form-control" name="chooseSubID" id="" required>
				</div>

				<div class="mb-3">
					<label  class="form-label">Subject Name</label>
					<input type="text" class="form-control" name="chooseSubName" id="" pattern="[A-Za-z ]{3,}" title="only letters" required>
				</div>

                <div class="mb-3" id="faculty_div">
					<label class="form-label">Faculty</label>
					<div class="frm-select" >             
						<select id="facultyDropdownAddSubject" class="form-control" name="chooseFac" required></select>
					</div>
				</div>

				<div class="mb-3" id="department_div">
					<label class="form-label">Department</label>
					<div class="frm-select" >              
						<select id="departmentDropdownAddSubject" class="form-control" name="chooseDep"required></select>
					</div>
				</div>
				
                <div class="mb-3" id="department_div">
					<label class="form-label">Semester</label>
					<div class="frm-select" >              
						<select class="form-control" name="chooseSem" required>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                            <option value="VI">VI</option>
                            <option value="VII">VII</option>
                            <option value="VIII">VIII</option>
                        </select>
					</div>
				</div>



				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" name="addSubject" class="btn btn-primary">Create</button>
				</div>

			</form>		
				
		
			</form>
		</div>		
	</div>
	</div>
</div>