<!-- Modal for Add department -->
<div class="modal fade" id="addBatch" tabindex="-1" aria-labelledby="addBatchModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
	<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Add a batch</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<form action="addBatch.php" method="POST" enctype="multipart/form-data">									
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Batch</label>
                    <input type="text" class="form-control" name = "chooseBatch">
                </div>
                <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" name="addBatch" class="btn btn-primary">Add</button>
				</div>
			</form>		
		</div>		
	</div>
	</div>
</div> 