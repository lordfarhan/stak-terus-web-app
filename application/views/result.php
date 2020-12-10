<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Search for <?php echo $query; ?></h1>
	</div>

  <!-- Content Row -->
  <?php if($posts == null) echo '<p>Empty</p>'; ?>
	<div class="row">
		<?php foreach ($posts as $post) { ?>
			<div class="col-lg-12">
				<div class="card shadow mb-4">
					<!-- Card Header - Dropdown -->
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <div class="row">
              <div class="col-md-12">
                <a href="<?php echo base_url('post/detail/'); ?><?php echo $post->id?>">
                  <h1 class="m-0 font-weight-bold text-primary"><?php echo $post->title; ?></h1>
                </a>
              </div>
              <p class="col-md-12 mb-2" style="font-size: 12px">Asked by <?php echo $post->name; ?> at <?php echo $post->updated_at; ?></p>
            </div>
						<div class="dropdown no-arrow">
							<input type="hidden" value="<?php echo $post->id; ?>">
							<i class="fas fa-sm fa-comments text-gray-400"></i> <?php echo $post->replies; ?>
							<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
							   data-toggle="dropdown"
							   aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
								 aria-labelledby="dropdownMenuLink">
								<div class="dropdown-header">Actions</div>
								<a class="dropdown-item"
								   href="<?php echo base_url('post/detail/'); ?><?php echo $post->id?>">
									See replies
								</a>

							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
<!-- /.container-fluid -->
