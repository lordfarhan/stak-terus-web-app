<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $post['title']; ?> <p style="font-size: 12px">Asked by <?php echo $post['name']; ?> at <?php echo $post['updated_at']; ?></p></h1>
    <?php if ($post['name'] == $user['name']) { ?>
    <div class="row mb-4">
      <a href="<?php echo base_url('post/edit/') . $post['id']?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-2"><i class="fas fa-pen fa-sm text-white-50"></i> Edit</a>
      <a href="<?php echo base_url('post/delete/') . $post['id']?>" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-trash fa-sm text-white-50"></i> Delete</a>
    </div>
    <?php } ?>
  </div>
  <div class="col s12 m12">
    <?php echo $post['body']; ?>
  </div>

	<h1 class="h3 mt-3 text-gray-800">Replies</h1>

  <?php if($replies == null) echo '<p>Empty</p>'; ?>
	<div class="row">
		<?php foreach($replies as $reply) { ?>
			<div class="col-md-12">
				<div class="card shadow mb-4">
					<!-- Card Header - Dropdown -->
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h5 class="m-0 font-weight-bold text-primary"><?php echo $reply->name; ?></h5>
            <?php if ($reply->name == $user['name']) { ?>
            <div class="row">
              <a href="<?php echo base_url('post/editReply/') . $reply->id?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-2"><i class="fas fa-pen fa-sm text-white-50"></i> Edit</a>
              <a href="<?php echo base_url('post/deleteReply/') . $reply->id?>" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-trash fa-sm text-white-50"></i> Delete</a>
            </div>
            <?php } ?>
					</div>
					<!-- Card Body -->
					<div class="card-body">
						<?php echo $reply->reply; ?>
					</div>
				</div>
			</div>
		<?php 
		}
		?>
		<div class="col-md-12">
      <h1 class="h3 mt-3 text-gray-800">Your Reply</h1>
			<form action="<?php echo base_url('post/storeReply') ?>" method="post">
				<input type="hidden" name="user_id" value="<?php echo $user['id'] ?>">
				<input type="hidden" name="post_id" value="<?php echo $post['id'] ?>">
				<div class="form-group">
          <textarea type="text" id="body" name="reply" placeholder="Reply here" class="form-control form-control-user"></textarea>
				</div>
				<button class="btn btn-primary btn-user btn-block" type="submit">Reply</button>
			</form>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
