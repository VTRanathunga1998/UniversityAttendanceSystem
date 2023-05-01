<!--Modal for Remove Subject-->
<div class="modal fade" id="removeSubject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">     
      <div class="modal-body" style=" ">
        <div style=" margin:0 !important; display:flex; align-items:center; justify-content:center;">
			<img width=20% src="/UniversityAttendanceSystem/src/Assets/images/icons/cross.png" alt="Unsuccess">
		</div>
		<div style=" margin:0 !important; display:flex; align-items:center; justify-content:center;">
			<h1>Are you sure?</h1>
		</div>
		<div style=" margin:0 !important; display:flex; align-items:center; justify-content:center;">
			<p class="mt-3 text-center">
				Do you really want to remove this subject? This process cannot be undone.
			</p>
		</div>
		<div class="modal-footer " style=" display:flex; align-items:center; justify-content:center;">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<a href="removeSubject.php?subCode=<?php echo $_GET['subCode'] ?>" type="button" class="btn btn-danger">Remove</a>
      </div>
      </div>   
    </div>
  </div>
</div>