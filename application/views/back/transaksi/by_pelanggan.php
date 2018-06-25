<section class="content">
<div class="container-fluid">
	
	<div class="row clearfix">		
		
		<div class="col-xs-12">
		
			<?php echo $this->session->flashdata('alert'); ?>
			
			<div class="card">
				<div class="header bg-light-blue">
					<h2><?php echo $page_title; ?></h2>
				</div>
				<div class="body">					
					
					<div class="card">
					<div class="header bg-light-green">
						<h2>Detail Pelanggan</h2>
					</div>					
					<div class="body table-responsive">
						<table class="table">
							<tbody>
								<tr>
									<th>Nama</th>
									<td><?php echo $pelanggan->nama; ?></td>
								</tr>
								<tr>
									<th>Alamat</th>
									<td><?php echo $pelanggan->alamat; ?></td>
								</tr>
								<tr>
									<th>No Identitas</th>
									<td><?php echo $pelanggan->no_identitas; ?></td>
								</tr>
								<tr>
									<th>Jenis Identitas</th>
									<td><?php echo $pelanggan->jenis_identitas; ?></td>
								</tr>
								<tr>
									<th>No. HP</th>
									<td><?php echo $pelanggan->no_hp; ?></td>
								</tr>
								<tr>
									<th>Email</th>
									<td><?php echo $pelanggan->email; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
					</div>
					
					<div class="card">
					<div class="header bg-light-green">
						<h2>Semua Transaksi Oleh Pelanggan</h2>
					</div>				
					<div class="body table-responsive">					
						
						<table class="table">
							
							<thead>
								<tr>
									<th>ID Transaksi</th>
									<th>Tanggal Sewa</th>
									<th>Tanggal Kembali</th>
									<th>Biaya Total</th>
									<th>Status</th>
									<th>Detail</th>
								</tr>				
							</thead>
							
							<tbody>
								<?php if(!empty($transaksis)): foreach($transaksis as $sewa): ?>
								<tr>
									<td><?php echo $sewa['id']; ?></td>
									<td><?php echo $sewa['tgl_sewa']; ?></td>
									<td><?php echo $sewa['tgl_kembali']; ?></td>
									<td><?php echo $sewa['biaya_total']; ?></td>
									<td><?php echo $sewa['dikembalikan'] ? 'Sudah Dikembalikan' : 'Belum Dikembalikan'; ?></td>
									<td>
										<a href="<?php echo site_url('admin/transaksi/detail/'.$sewa['id']); ?>" class="btn bg-light-green waves-effect">Detail</a>
											
									</td>
								</tr>
								<?php endforeach; endif; ?>
							</tbody>							
							
						</table>

						<p>
							<a href="<?php echo site_url('admin/transaksi/add/'.$pelanggan->id); ?>" class="btn bg-light-green waves-effect">
								<i class="material-icons">add</i>
								<span>Tambah Transaksi</span>
							</a>
						</p>
				
					</div>
					</div>		
						
					
				</div>
			</div>
		</div>
		
	
	</div>
	
	
	
</div>
</section>
