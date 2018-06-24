<section class="content">
<div class="container-fluid">
	
	<div class="row clearfix">		
		
		<div class="col-xs-12">			
			
			<?php echo $this->session->flashdata('alert'); ?>
			
			<div class="card">
				<div class="header bg-light-blue">
					<h2>List Semua Kategori</h2>
				</div>
				<div class="body table-responsive">
					<p>
						<a href="<?php echo site_url('admin/kategori/add'); ?>" class="btn bg-light-green waves-effect">
							<i class="material-icons">add</i>
							<span>Tambah Kategori</span>
						</a>
					</p>
					<table class="table">
						<thead>
							<tr>
								<th>NAMA KATEGORI</th>																											
								<th width="90px">AKSI</th>					
							</tr>
						</thead>
						<tbody>
							<?php the_cat_td($cats); ?>
						</tbody>
					</table>
					<p>
						<a href="<?php echo site_url('admin/kategori/add'); ?>" class="btn bg-light-green waves-effect">
							<i class="material-icons">add</i>
							<span>Tambah Kategori</span>
						</a>
					</p>
				</div>
			</div>
		</div>		
	
	</div>	
	
</div>
</section>