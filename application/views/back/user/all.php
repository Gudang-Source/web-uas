<section class="content">
<div class="container-fluid">
	
	<div class="row clearfix">		
		
		<div class="col-xs-12">			
			
			<?php echo $this->session->flashdata('alert'); ?>
			
			<div class="card">
				<div class="header bg-light-blue">
					<h2>List Semua User</h2>
				</div>
				<div class="body table-responsive">
					<p>
						<a href="<?php echo site_url('admin/user/add'); ?>" class="btn bg-light-green waves-effect">
							<i class="material-icons">add</i>
							<span>Tambah User</span>
						</a>
					</p>
					<table class="table">
						<thead>
							<tr>
								<th>USERNAME</th>
								<th>NAMA</th>
								<th>EMAIL</th>
								<th>ROLE</th>								
								<th width="120px">AKSI</th>					
							</tr>
						</thead>
						<tbody>
							<?php foreach($users as $user): ?>
								<tr>
									<td><?php echo $user['username']; ?></td>
									<td><?php echo $user['nama']; ?></td>
									<td><?php echo $user['email']; ?></td>
									<td><?php echo $user['nama_role']; ?></td>	
									
									<td>
										<a href="<?php echo site_url('admin/user/detail/'.$user['id']); ?>" title="Detail" class="col-green"><i class="material-icons font-20">remove_red_eye</i></a>
										&nbsp;
										<a href="<?php echo site_url('admin/user/edit/'.$user['id']); ?>" title="Edit"><i class="material-icons font-20">edit</i></a>
										&nbsp;
										<a href="<?php echo site_url('admin/user/del/'.$user['id']); ?>" title="Hapus" class="col-red confirm-hapus"><i class="material-icons font-20">cancel</i></a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<p>
						<a href="<?php echo site_url('admin/user/add'); ?>" class="btn bg-light-green waves-effect">
							<i class="material-icons">add</i>
							<span>Tambah User</span>
						</a>
					</p>
				</div>
			</div>
		</div>		
	
	</div>	
	
</div>
</section>