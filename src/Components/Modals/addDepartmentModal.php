<!-- Modal for Add department -->
<div class="modal fade" id="addDepartment" tabindex="-1" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
	<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Add a department</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<form action="addDepartment.php" method="POST" enctype="multipart/form-data">									
				<div class="mb-3">
					<label  class="form-label">Department ID</label>
					<input type="text" class="form-control" name="depID" id="" required>
				</div>
				<div class="mb-3">
					<label  class="form-label">Department Name</label>
					<input type="text" class="form-control" name="depName" id="" required>
				</div>

				<div class="mb-3" id="">
					<label class="form-label">Faculty</label>
					<div class="frm-select" >             
						<select id="facultyDropdown" class="form-control" name="chooseFac" required></select>
					</div>
				</div>

				<div class="mb-3">
					<label  class="form-label">web URL</label>
					<input type="text" class="form-control" name="depURL" id="">
				</div>
				<div class="mb-3">
					<label  class="form-label">Department Picture</label>
					<input type="file" class="form-control" name="depPic" id="depPic" >
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" name="addDepartment" class="btn btn-primary">Create</button>
				</div>
			</form>		
		</div>		
	</div>
	</div>
</div> 