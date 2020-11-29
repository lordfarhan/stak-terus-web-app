<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Edit Post</h1>
	</div>

	<!-- Content Row -->
	<div class="row">
		<div class="col-md-12">
			<form action="<?php echo base_url('post/update') ?>" method="post">
        <input type="hidden" value="<?php echo $post['id']; ?>" name="id">
				<div class="form-group">
					<input type="text" value="<?php echo $post['title']; ?>" name="title" placeholder="Title" class="form-control form-control-user">
					<?php echo form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>
				<div class="form-group">
					<textarea type="text" id="body" name="body" placeholder="Post Content" class="form-control form-control-user"><?php echo $post['body']; ?></textarea>
					<?php echo form_error('body', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>
				<button class="btn btn-primary btn-user btn-block" type="submit">Post</button>
			</form>
		</div>
	</div>

</div>
<!-- /.container-fluid -->