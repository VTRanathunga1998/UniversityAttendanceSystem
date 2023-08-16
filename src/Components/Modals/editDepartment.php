<!-- Modal for Edit lecturer profile-->
<div class="modal fade" id="editDepartment" tabindex="-1" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
	<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Edit department</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<form action="updateDepartment.php" method="POST" enctype="multipart/form-data" >		
<!-- edit .php -->
				<div class="mb-3">
					<label  class="form-label">Department ID</label>
					<input type="text" class="form-control" name="chooseDepID" value="<?php echo $row['depID'] ?>" id="" required>
				</div>

				<div class="mb-3">
					<label  class="form-label">Department Name</label>
					<input type="text" class="form-control" name="chooseDepName" value="<?php echo $row['depName'] ?>" id="" pattern="[A-Za-z ]{3,}" title="only letters" required>
				</div>

				<div class="mb-3">
					<label  class="form-label">Faculty</label>
					<input type="text" class="form-control" name="choosefacID" value="<?php echo $row['facID'] ?>" id="" pattern="[A-Za-z ]{3,}" title="only letters" required>
				</div>

				<div class="mb-3">
					<label  class="form-label">Department URL</label>
					<input type="text" name="chooseDepUrl" class="form-control" value="<?php echo $row['depUrl'] ?>" id="">
				</div>


                <div class="mb-3" id="faculty_div">
					<label class="form-label">Faculty</label>
					<div class="frm-select" >             
						<select id="facultyDropdownEditLecturer" class="form-control" name="chooseFac" required></select>
					</div>
				</div>


                <div class="mb-3">
					<label  class="form-label">Department Picture</label>
					<input type="file" class="form-control" name="depPic" id="depPic" >
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" name="updateDepartment" class="btn btn-primary">Update</button>
				</div>

			</form>		
				
		
			</form>
		</div>		
	</div>
	</div>
</div> 