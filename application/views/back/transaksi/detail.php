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
						<h2>Detail Peminjaman</h2>
					</div>				
					<div class="body table-responsive">					
						
						<table class="table">
							<tbody>
								<tr>
									<th>ID Transaksi Sewa</th>
									<td><?php echo $transaksi['id']; ?></td>
								</tr>
								<tr>
									<th>Tanggal Sewa</th>
									<td><?php echo $transaksi['tgl_sewa']; ?></td>
								</tr>
								<tr>
									<th>Tanggal Kembali</th>
									<td><?php echo $transaksi['tgl_kembali']; ?></td>
								</tr>
								<tr>
									<th>Biaya Total</th>
									<td><?php echo $transaksi['biaya_total']; ?></td>
								</tr>
								<tr>
									<th>Status Sewa</th>
									<td><?php echo $transaksi['dikembalikan'] ? 'Sudah Dikembalikan' : 'Belum Dikembalikan'; ?></td>
								</tr>								
							</tbody>
						</table>						
				
					</div>
					</div>
					
					<div class="card">
					<div class="header bg-light-green">
						<h2>Item Yang Dipinjam</h2>
					</div>				
					<div class="body table-responsive">					
						
						<table class="table">
							<thead>
								<tr>
									<th>Nama Produk</th>
									<th>QTY</th>									
									<th>Biaya</th>									
									<th width="90px">Aksi</th>							
								</tr>
							</thead>
							<tbody>
								<?php $super_total = 0; ?>
								<?php if(!empty($transaksi['items'])): foreach($transaksi['items'] as $item): ?>
									<tr>
										<td><?php echo $item['nama_produk']; ?></td>
										<td><?php echo $item['qty']; ?></td>
										<td>
										<?php
										$sub_total = $item['biaya_per_hari'] * $lama_sewa;
										echo $sub_total;
										$super_total += $sub_total;
										?>
										</td>
										<td>
											<a href="<?php echo site_url('admin/transaksi/edit_item/'.$item['id'].'/'.$transaksi['id']); ?>" title="Edit"><i class="material-icons font-20">edit</i></a>
											&nbsp;
											<a href="<?php echo site_url('admin/transaksi/del_item/'.$item['id'].'/'.$transaksi['id']); ?>" title="Hapus" class="col-red confirm-hapus"><i class="material-icons font-20">cancel</i></a>
										</td>
									</tr>									
								<?php endforeach; endif; ?>
								<tr class="bg-purple">
									<th></th>
									<th>Total</th>
									<th><?php echo $super_total; ?></th>
									<th></th>
								</tr>
							</tbody>
						</table>
							
						<p>
							<a href="<?php echo site_url('admin/transaksi/add_item/'.$transaksi['id']); ?>" class="btn bg-light-green waves-effect">
								<i class="material-icons">add</i>
								<span>Tambah Item</span>
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
