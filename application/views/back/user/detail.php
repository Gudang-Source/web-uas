<section class="content">
<div class="container-fluid">

	<div class="row clearfix">		
		
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
			<div class="card">
				<div class="header bg-light-blue">
					<h2>User Profile</h2>
				</div>
				<div class="body">
					<h5>Username:</h5>
					<p class="m-b-20"><?php echo $user->username; ?></p>
					<h5>Nama:</h5>
					<p class="m-b-20"><?php echo $user->nama; ?></p>
					<h5>Email:</h5>
					<p class="m-b-20"><?php echo $user->email; ?></p>
					<h5>Role:</h5>
					<p class="m-b-20"><?php echo $user->nama_role; ?></p>
					<p>
						<a href="<?php echo site_url('admin/user/edit/'.$user->id); ?>" class="btn bg-light-green waves-effect">
							<i class="material-icons">edit</i>
							<span>Edit User</span>
						</a>
					</p>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="card">
				<div class="header bg-light-blue">
					<h2>User Photo</h2>
				</div>
				<div class="body">
					<?php
					$photo = base_url('assets/back/images/user-placeholder.png');
					$user_photo = $user->foto;
					if($user_photo) {
						$photo = base_url('uploads/'.$user_photo);
					}
					?>
					<img src="<?php echo $photo; ?>" alt="Foto Kamu" class="img-responsive thumbnail">
				</div>
			</div>
		</div>
	
	</div>
	
	
	
</div>
</section>