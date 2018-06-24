<section class="content">
<div class="container-fluid">
	
	<div class="row clearfix">		
		
		<div class="col-xs-12">			
			
			<?php echo $this->session->flashdata('alert'); ?>
			
			<div class="card">
				<div class="header bg-light-blue">
					<h2><?php echo $page_title; ?></h2>
				</div>
				<div class="body table-responsive">
					<p>
						<a href="<?php echo site_url('admin/pelanggan/add'); ?>" class="btn bg-light-green waves-effect">
							<i class="material-icons">add</i>
							<span>Tambah Pelanggan</span>
						</a>
					</p>
					<table class="table">
						<thead>
							<tr>
								<th>NAMA</th>
								<th>NO.ID</th>
								<th>JENIS ID</th>
								<th>ALAMAT</th>
								<th>NO. HP</th>
								<th>EMAIL</th>
								<th width="90px">AKSI</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($pelanggans as $pelanggan): ?>
								<tr>
									<td><?php echo $pelanggan['nama']; ?></td>
									<td><?php echo $pelanggan['no_identitas']; ?></td>
									<td><?php echo $pelanggan['jenis_identitas']; ?></td>									
									<td><?php echo $pelanggan['alamat']; ?></td>
									<td><?php echo $pelanggan['no_hp']; ?></td>
									<td><?php echo $pelanggan['email']; ?></td>
									<td>
										<a href="<?php echo site_url('admin/pelanggan/edit/'.$pelanggan['id']); ?>" title="Edit"><i class="material-icons font-20">edit</i></a>
										&nbsp;
										<a href="<?php echo site_url('admin/pelanggan/del/'.$pelanggan['id']); ?>" title="Hapus" class="col-red confirm-hapus"><i class="material-icons font-20">cancel</i></a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<p>
						<a href="<?php echo site_url('admin/pelanggan/add'); ?>" class="btn bg-light-green waves-effect">
							<i class="material-icons">add</i>
							<span>Tambah Pelanggan</span>
						</a>
					</p>
				</div>
			</div>
		</div>		
	
	</div>	
	
</div>
</section>