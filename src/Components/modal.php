<!-- Modal for create session-->
<div class="modal fade" id="addSession" tabindex="-1" aria-labelledby="addSessionModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
	<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Add a Session</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<form action="createAttendanceSession.php" method="POST">									
				<div class="mb-3" id="faculty_div">
					<label class="form-label">Faculty</label>
					<div class="frm-select" >             
						<select id="faculty" class="form-control" name="chooseFac" required></select>
					</div>
				</div>

				<div class="mb-3" id="department_div">
					<label class="form-label">Department</label>
					<div class="frm-select" >              
						<select id="department" class="form-control" name="chooseDep"required></select>
					</div>
				</div>

				<div class="mb-3" id="semester_div">
					<label class="form-label">Semester</label>
					<div class="frm-select" >             
						<select name="chooseSem" id="semester" class="form-select mb-2" required>
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

				<div class="mb-3" id="subject_div">
					<label class="form-label">Subject</label>
					<div class="frm-select" >             
						<select id="subject" class="form-control" name="chooseSub" required></select>
					</div>
				</div>

				<div class="mb-3" id="activity_div">
					<label class="form-label">Activity Type</label>
					<div class="frm-select">             
						<select name="chooseActType" id="" class="form-select mb-2" required>
							<option value="Theory">Theory</option>
							<option value="Lab">Lab</option>
						</select>
					</div> 
				</div>   

				<div class="mb-3" id="batch_div">
					<label class="form-label">Batch</label>
					<div class="frm-select">             
						<select name="chooseBatch" id="batch" class="form-select mb-2" required></select>
					</div>
				</div>

				<div class="mb-3" id="timeslot_div">
					<label class="form-label">Time Slot</label>
					<div class="frm-select timeslot">             
						<select name="timeStartHH" id="" class="form-select mb-2 time-slot" required>
							<option value="06" selected>06</option>
							<option value="07">07</option>
							<option value="08">08</option>
							<option value="09">09</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							
						</select>
									
						<select name="timeStartMM" id="" class="form-select mb-2 time-slot" required>
							<option value="00">00</option>
							<option value="15">15</option>
							<option value="30">30</option>
							<option value="45">45</option>

						</select>

						<div>to</div>

						<select name="timeEndHH" id="" class="form-select mb-2 time-slot" required>
							<option value="06">06</option>
							<option value="07">07</option>
							<option value="08" selected>08</option>
							<option value="09">09</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							
						</select>
									
						<select name="timeEndMM" id="" class="form-select mb-2 time-slot" required>
							<option value="00">00</option>
							<option value="15">15</option>
							<option value="30">30</option>
							<option value="45">45</option>

						</select>
					</div>
				</div> 
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" name="newSession" class="btn btn-primary">Create</button>
				</div>
			</form>
		</div>		
	</div>
	</div>
</div> 


<!-- Modal for view Class-->
<div class="modal fade" id="viewClass" tabindex="-1" aria-labelledby="viewClassModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
	<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Find your class</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<form action="viewAttendanceShow.php" method="post">									
				<div class="mb-3" id="faculty_div">
					<label class="form-label">Faculty</label>
					<div class="frm-select" >             
						<select id="Viewfaculty" class="form-control" name="chooseFac" required></select>
					</div>
				</div>

				<div class="mb-3" id="departmentDiv">
					<label class="form-label">Department</label>
					<div class="frm-select" >              
						<select id="Viewdepartment" class="form-control" name="chooseDep"required></select>
					</div>
				</div>

				<div class="mb-3" id="semesterDiv">
					<label class="form-label">Semester</label>
					<div class="frm-select" >             
						<select name="chooseSem" id="Viewsemester" class="form-select mb-2" required>
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

				<div class="mb-3" id="subjectDiv">
					<label class="form-label">Subject</label>
					<div class="frm-select" >             
						<select id="Viewsubject" class="form-control" name="chooseSub" required></select>
					</div>
				</div>

				<div class="mb-3" id="activityDiv">
					<label class="form-label">Activity Type</label>
					<div class="frm-select">             
						<select name="chooseActType" id="" class="form-select mb-2" required>
							<option value="Theory">Theory</option>
							<option value="Lab">Lab</option>
						</select>
					</div> 
				</div>   

				<div class="mb-3" id="batchDiv">
					<label class="form-label">Batch</label>
					<div class="frm-select">             
						<select name="chooseBatch" id="Viewbatch" class="form-select mb-2" required></select>
					</div>
				</div>

				<div class="mb-3" id="dateDiv">
					<label class="form-label">Date</label>
					<div >             
						<input type="date" class="form-control" id="birthday" name="chooseDate" required>						
					</div>
				</div>

				<div class="mb-3" id="timeslotDiv">
					<label class="form-label">Time Slot</label>
					<div class="frm-select timeslot">             
						<select name="timeStartHH" id="" class="form-select mb-2 time-slot" required>
							<option value="06" selected>06</option>
							<option value="07">07</option>
							<option value="08">08</option>
							<option value="09">09</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							
						</select>
									
						<select name="timeStartMM" id="" class="form-select mb-2 time-slot" required>
							<option value="00">00</option>
							<option value="15">15</option>
							<option value="30">30</option>
							<option value="45">45</option>

						</select>

						<div>to</div>

						<select name="timeEndHH" id="" class="form-select mb-2 time-slot" required>
							<option value="06">06</option>
							<option value="07">07</option>
							<option value="08" selected>08</option>
							<option value="09">09</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							
						</select>
									
						<select name="timeEndMM" id="" class="form-select mb-2 time-slot" required>
							<option value="00">00</option>
							<option value="15">15</option>
							<option value="30">30</option>
							<option value="45">45</option>
						</select>
					</div>
				</div> 
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" name="viewClass" class="btn btn-primary">Find</button>
				</div>
			</form>
		</div>		
	</div>
	</div>
</div> 


<!-- Modal for mark attendance -->
<div class="modal fade" id="mark_attendance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-body" style=" ">
        <div style=" margin:0 !important; display:flex; align-items:center; justify-content:center;">
			<img width=20% src="/UniversityAttendanceSystem/src/Assets/images/icons/checked.png" alt="checked">
		</div>
		<div style=" margin:0 !important; display:flex; align-items:center; justify-content:center;">
			<p class="mt-3"><?php if (isset($_GET['id'])) {
										echo $_GET['id'];
										}?> 
			Added successfully</p>
		</div>
      </div>
      
    </div>
  </div>
</div>

<!--Modal for success-->
<div class="modal fade" id="success" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">     
      <div class="modal-body" style=" ">
        <div style=" margin:0 !important; display:flex; align-items:center; justify-content:center;">
			<img width=20% src="/UniversityAttendanceSystem/src/Assets/images/icons/checked.png" alt="success">
		</div>
		<div style=" margin:0 !important; display:flex; align-items:center; justify-content:center;">
			<h1>Success</h1>
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


