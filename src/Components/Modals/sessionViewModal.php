<!--Modal for Session View-->
<div class="modal fade" id="sessionView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Session Details</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<table class="table table-responsive-sm table-hover">
				<tbody>
					<tr>
						<td><strong>Session ID</strong></td>
						<td>
							<?php
								if(isset($session_result['sessionID'])){
									echo $session_result['sessionID'];
								}else{
									echo "";
								} 
							?>	
						</td>						
					</tr>
					<tr>
						<td><strong>Faculty</strong></td>
						<td>
							<?php
								if(isset($session_result['faculty'])){
									echo $session_result['faculty'];
								}else{
									echo "";
								} 
							?>	
						</td>						
					</tr>
					<tr>
						<td><strong>Department</strong></td>
						<td>
							<?php
								if(isset($session_result['department'])){
									echo $session_result['department'];
								}else{
									echo "";
								} 
							?>	
						</td>						
					</tr>
					<tr>
						<td><strong>Subject</strong></td>
						<td>
							<?php
								if(isset($session_result['subject'])){
									echo $session_result['subject'];
								}else{
									echo "";
								} 
							?>	
						</td>						
					</tr>
					<tr>
						<td><strong>Date</strong></td>
						<td>
							<?php
								if(isset($session_result['date'])){
									echo $session_result['date'];
								}else{
									echo "";
								} 
							?>	
						</td>						
					</tr>
					<tr>
						<td><strong>Activity Type</strong></td>
						<td>
							<?php
								if(isset($session_result['activityType'])){
									echo $session_result['activityType'];
								}else{
									echo "";
								} 
							?>	
						</td>						
					</tr>
					<tr>
						<td><strong>Batch</strong></td>
						<td>
							<?php
								if(isset($session_result['batch'])){
									echo $session_result['batch'];
								}else{
									echo "";
								} 
							?>	
						</td>						
					</tr>
					<tr>
						<td><strong>Time Start</strong></td>
						<td>
							<?php
								if(isset($session_result['timeStart'])){
									echo $session_result['timeStart'];
								}else{
									echo "";
								} 
							?>	
						</td>						
					</tr>
					<tr>
						<td><strong>Time End</strong></td>
						<td>
							<?php
								if(isset($session_result['timeEnd'])){
									echo $session_result['timeEnd'];
								}else{
									echo "";
								} 
							?>	
						</td>						
					</tr>
					<tr>
						<td><strong>Semester</strong></td>
						<td>
							<?php
								if(isset($session_result['semester'])){
									echo $session_result['semester'];
								}else{
									echo "";
								} 
							?>	
						</td>						
					</tr>
				</tbody>
			</table>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		</div>
		</div>
	</div>
</div>