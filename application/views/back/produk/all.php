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
						<a href="<?php echo site_url('admin/produk/add'); ?>" class="btn bg-light-green waves-effect">
							<i class="material-icons">add</i>
							<span>Tambah Produk</span>
						</a>
					</p>
					<table class="table">
						<thead>
							<tr>
								<th>NAMA PRODUK</th>													
								<th>KATEGORI</th>
								<th>STOCK</th>
								<th>READY</th>
								<th>HARGA SEWA</th>
								<th width="90px">AKSI</th>					
							</tr>
						</thead>
						<tbody>
							<?php foreach($produks as $produk): ?>
								<tr>
									<td><?php echo $produk['nama_produk']; ?></td>									
									<td><?php echo $produk['nama_cats']; ?></td>									
									<td><?php echo $produk['total_stock']; ?></td>									
									<td><?php echo $produk['ready_stock']; ?></td>									
									<td><?php echo $produk['harga_sewa']; ?></td>									
									
									<td>
										<a href="<?php echo site_url('admin/produk/edit/'.$produk['id']); ?>" title="Edit"><i class="material-icons font-20">edit</i></a>
										&nbsp;
										<a href="<?php echo site_url('admin/produk/del/'.$produk['id']); ?>" title="Hapus" class="col-red confirm-hapus"><i class="material-icons font-20">cancel</i></a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<p>
						<a href="<?php echo site_url('admin/produk/add'); ?>" class="btn bg-light-green waves-effect">
							<i class="material-icons">add</i>
							<span>Tambah Produk</span>
						</a>
					</p>
				</div>
			</div>
		</div>		
	
	</div>	
	
</div>
</section>