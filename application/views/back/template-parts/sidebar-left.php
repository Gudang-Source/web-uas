<section>
	
	<!-- Left Sidebar -->
	<aside id="leftsidebar" class="sidebar">
		<!-- User Info -->
		<div class="user-info">
			<div class="image">
				<?php
				$photo = base_url('assets/back/images/user-placeholder.png');
				$user_photo = $this->session->profile['foto'];
				if($user_photo) {
					$photo = base_url('uploads/'.$user_photo);
				}				
				?>
				<img src="<?php echo $photo; ?>" width="48" height="48" alt="User" />
			</div>
			<div class="info-container">
				<div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo  $this->session->profile['nama']; ?></div>
				<div class="email"><?php echo $this->session->profile['email']; ?></div>
				<div class="btn-group user-helper-dropdown">
					<i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
					<ul class="dropdown-menu pull-right">
						<li><a href="<?php echo site_url('admin/user/detail/'.$this->session->user_id); ?>"><i class="material-icons">person</i>Profile</a></li>                            
						<li><a href="<?php echo site_url('login/logout'); ?>"><i class="material-icons">input</i>Log Out</a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- #User Info -->
		<!-- Menu -->
		<div class="menu">
			<?php
			$active_nav = isset($active_nav) ? $active_nav : '';
			$active_sub_nav = isset($active_sub_nav) ? $active_sub_nav : '';
			?>
			<ul class="list">
			
				<li class="<?php the_nav_class($active_nav, 'user'); ?>">
					<a href="javascript:void(0);" class="menu-toggle">
						<i class="material-icons">people</i>
						<span>User</span>
					</a>
					<ul class="ml-menu">
						<li class="<?php the_nav_class($active_sub_nav, 'list_user'); ?>"><a href="<?php echo site_url('admin/user'); ?>">List User</a></li>
						<li class="<?php the_nav_class($active_sub_nav, 'add_user'); ?>"><a href="<?php echo site_url('admin/user/add'); ?>">Tambah User</a></li>
					</ul>
				</li>
				
				<li class="<?php the_nav_class($active_nav, 'pelanggan'); ?>">
					<a href="javascript:void(0);" class="menu-toggle">
						<i class="material-icons">mood</i>
						<span>Pelanggan</span>
					</a>
					<ul class="ml-menu">
						<li class="<?php the_nav_class($active_sub_nav, 'list_pelanggan'); ?>"><a href="<?php echo site_url('admin/pelanggan'); ?>">List Pelanggan</a></li>
						<li class="<?php the_nav_class($active_sub_nav, 'add_pelanggan'); ?>"><a href="<?php echo site_url('admin/pelanggan/add'); ?>">Tambah Pelanggan</a></li>
					</ul>
				</li>
				
				<li class="<?php the_nav_class($active_nav, 'produk'); ?>">
					<a href="javascript:void(0);" class="menu-toggle">
						<i class="material-icons">landscape</i>
						<span>Produk</span>
					</a>
					<ul class="ml-menu">
						<li class="<?php the_nav_class($active_sub_nav, 'list_produk'); ?>"><a href="<?php echo site_url('admin/produk'); ?>">List Produk</a></li>
						<li class="<?php the_nav_class($active_sub_nav, 'add_produk'); ?>"><a href="<?php echo site_url('admin/produk/add'); ?>">Tambah Produk</a></li>
					</ul>
				</li>

				
				
				<li class="<?php the_nav_class($active_nav, 'data_master'); ?>">
					<a href="javascript:void(0);" class="menu-toggle">
						<i class="material-icons">list_alt</i>
						<span>Data Master</span>
					</a>
					<ul class="ml-menu">
						<li class="<?php the_nav_class($active_sub_nav, 'identitas'); ?>"><a href="<?php echo site_url('admin/identitas'); ?>">Kartu Identitas</a></li>
						<li class="<?php the_nav_class($active_sub_nav, 'kategori'); ?>"><a href="<?php echo site_url('admin/kategori'); ?>">Kategori Produk</a></li>
					</ul>
				</li>	
				
			</ul>
		</div>
		<!-- #Menu -->            
	</aside>
	<!-- #END# Left Sidebar -->
	
</section>