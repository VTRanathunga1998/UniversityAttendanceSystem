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