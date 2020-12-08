<div class="container">

	<div class="card o-hidden border-0 shadow-lg my-5">
		<div class="card-body p-0">
			<!-- Nested Row within Card Body -->
			<div class="row">
				<div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
				<div class="col-lg-7">
					<div class="p-5">
						<div class="text-center">
							<h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
						</div>
						<form class="user" method="POST" action="<?php echo base_url('auth/register') ?>">
							<div class="form-group">
								<input type="text" class="form-control form-control-user" id="name"
									   name="name"
									   placeholder="Full Name" value="<?php echo set_value('name')?>">
								<?php echo form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
							<div class="form-group">
								<input type="email" class="form-control form-control-user" id="email"
									   name="email"
									   placeholder="Email Address" value="<?php echo set_value('email')?>">
								<?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
							<div class="form-group row">
								<div class="col-sm-6 mb-3 mb-sm-0">
									<input type="password" class="form-control form-control-user" name="password"
										   id="password" placeholder="Password">
									<?php echo form_error('password', '<small class="text-danger pl-3>', '</small>'); ?>
								</div>
								<div class="col-sm-6">
									<input type="password" class="form-control form-control-user" name="password_confirm"
										   id="password_confirm" placeholder="Repeat Password">
									<?php echo form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
								</div>
							</div>
							<label class="ml-3" for="">Describe who you are?</label>
							<div class="ml-3 form-group row">
								<div class="custom-control custom-radio">
										<input class="custom-control-input" checked id="role_user" value="0" type="radio" name="role">
										<label class="custom-control-label" for="role_user">User</label>
								</div>
								<div class="ml-3 custom-control custom-radio">
										<input class="custom-control-input" id="role_programmer" value="1" type="radio" name="role">
										<label class="custom-control-label" for="role_programmer">Programmer</label>
								</div>
							</div>
							<button type="submit" class="btn btn-primary btn-user btn-block">
								Register Account
							</button>
						</form>
						<hr>
						<!-- <div class="text-center">
							<a class="small" href="forgot-password.html">Forgot Password?</a>
						</div> -->
						<div class="text-center">
							<a class="small" href="<?php echo base_url('auth'); ?>">Already have an account? Login!</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
