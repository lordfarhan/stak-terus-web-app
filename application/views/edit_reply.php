<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Edit Reply</h1>
	</div>

	<!-- Content Row -->
	<div class="row">
		<div class="col-md-12">
			<form action="<?php echo base_url('post/updateReply') ?>" method="post">
        <input type="hidden" value="<?php echo $reply['id']; ?>" name="id">
        <input type="hidden" value="<?php echo $reply['post_id']; ?>" name="post_id">
				<div class="form-group">
					<textarea type="text" id="reply" name="reply" placeholder="Reply" class="form-control form-control-user"><?php echo $reply['reply']; ?></textarea>
					<?php echo form_error('reply', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>
				<button class="btn btn-primary btn-user btn-block" type="submit">Update</button>
			</form>
		</div>
	</div>

</div>
<!-- /.container-fluid -->
