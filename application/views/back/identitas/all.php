<section class="content">
<div class="container-fluid">
	
	<div class="row clearfix">		
		
		<div class="col-xs-12">			
			
			<?php echo $this->session->flashdata('alert'); ?>
		
			<div class="card">
				<div class="header bg-light-blue">
					<h2>Semua Identitas</h2>
				</div>
				<div class="body table-responsive">
					<p>
						<a href="<?php echo site_url('admin/identitas/add'); ?>" class="btn bg-light-green waves-effect">
							<i class="material-icons">add</i>
							<span>Tambah Jenis Identitas</span>
						</a>
					</p>
					<table class="table">
						<thead>
							<tr>
								<th>JENIS IDENTITAS</th>
								<th width="90px">AKSI</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($identitases as $identitas): ?>
								<tr>
									<td><?php echo $identitas['jenis_identitas']; ?></td>
									<td>
										<a href="<?php echo site_url('admin/identitas/edit/'.$identitas['id']); ?>" title="Edit"><i class="material-icons font-20">edit</i></a>
										&nbsp;
										<a href="<?php echo site_url('admin/identitas/del/'.$identitas['id']); ?>" title="Hapus" class="col-red confirm-hapus"><i class="material-icons font-20">cancel</i></a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<p>
						<a href="<?php echo site_url('admin/identitas/add'); ?>" class="btn bg-light-green waves-effect">
							<i class="material-icons">add</i>
							<span>Tambah Jenis Identitas</span>
						</a>
					</p>
				</div>
			</div>
		</div>		
	
	</div>	
	
</div>
</section>
