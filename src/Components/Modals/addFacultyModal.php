<!-- Modal for Add faculty -->
<div class="modal fade" id="addFaculty" tabindex="-1" aria-labelledby="addFacultyModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
	<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Add a faculty</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<form action="addFaculty.php" method="POST" enctype="multipart/form-data">									
				<div class="mb-3">
					<label  class="form-label">Faculty ID</label>
					<input type="text" class="form-control" name="facID" required>
				</div>
				<div class="mb-3">
					<label  class="form-label">Faculty Name</label>
					<input type="text" class="form-control" name="facName" required>
				</div>
				<div class="mb-3">
					<label class="form-label">Description</label>
					<textarea class="form-control" name="facDesc" rows="3"></textarea>
				</div>
				<div class="mb-3">
					<label  class="form-label">Web URL</label>
					<input type="text" class="form-control" name="facURL">
				</div>
				<div class="mb-3">
					<label  class="form-label">Faculty Picture</label>
					<input type="file" class="form-control" name="facPic" id="facPic" >
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" name="addFaculty" class="btn btn-primary">Create</button>
				</div>
			</form>		
				
		
			</form>
		</div>		
	</div>
	</div>
</div> 