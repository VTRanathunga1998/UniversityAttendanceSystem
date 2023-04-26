<!--Modal for unsuccess-->
<div class="modal fade" id="unsuccess" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">     
      <div class="modal-body" style=" ">
        <div style=" margin:0 !important; display:flex; align-items:center; justify-content:center;">
			<img width=20% src="/UniversityAttendanceSystem/src/Assets/images/icons/cross.png" alt="Unsuccess">
		</div>
		<div style=" margin:0 !important; display:flex; align-items:center; justify-content:center;">
			<h1>Unsuccess</h1>
		</div>
		<div style=" margin:0 !important; display:flex; align-items:center; justify-content:center;">
			<p class="mt-3">
				<?php 
					if (isset($_GET['message'])) {
						echo $_GET['message'];
					}
				?> 
			</p>
		</div>
      </div>   
    </div>
  </div>
</div>