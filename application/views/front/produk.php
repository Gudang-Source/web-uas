<div class="general-wrap">

<h1 class="title"><?php echo $page_title; ?></h1>
<div class="columns">
	
	<div class="column is-one-third">
	<?php if($produk->foto): ?>
		<figure class="image">
		<img src="<?php echo base_url('uploads/'.$produk->foto); ?>" class="img-responsive thumbnail" alt="Produk Foto">
		</figure>
	<?php endif; ?>
	</div>
	
	<div class="column is-two-third">
		<div class="content">
		<h3>Deskripsi</h3>
		<?php echo $produk->description; ?>
		
		<h3>Harga Sewa Per Hari</h3>
		<p><?php echo $produk->harga_sewa; ?></p>
		
		<h3>Total Stock</h3>
		<p><?php echo $produk->total_stock; ?></p>
		
		<h3>Ready Stock</h3>
		<p><?php echo $produk->ready_stock; ?></p>
		
		<h3>Kategori</h3>
		<p><?php echo $produk->categories; ?></p>
		</div>
	</div>
	
</div>
</div>