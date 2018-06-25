<div class="general-wrap">

<h1 class="title"><?php echo $page_title; ?></h1>
<div class="columns">
	
	
	<?php if(!empty($produks)): foreach($produks as $produk): ?>
		<div class="column is-one-quarter-tablet">
			
			<div class="card">
			
				<?php if($produk['foto']): ?>
					<div class="card-image">
					<figure class="image is-4by3">
						<a href="<?php echo site_url('prod/'.$produk['id']); ?>">
						<img src="<?php echo base_url('uploads/'.$produk['foto']); ?>" class="img-responsive thumbnail" alt="Produk Foto">
						</a>
					</figure>
					</div>
				<?php endif; ?>
				
			  <div class="card-content">
				<h4 class="title is-6"><a href="<?php echo site_url('prod/'.$produk['id']); ?>"><?php echo $produk['nama_produk']; ?></a></h4>
			  </div>
			  <footer class="card-footer">
				<p class="card-footer-item">Total: <?php echo $produk['total_stock']; ?></p>
				<p class="card-footer-item">Ready: <?php echo $produk['ready_stock']; ?></p>				
			  </footer>
			</div>
		
		</div>
	<?php endforeach; endif; ?>

	
</div>
</div>