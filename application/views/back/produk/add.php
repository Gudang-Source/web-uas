<section class="content">
<div class="container-fluid">
	
	<div class="row clearfix">	
		
		<div class="col-xs-12">
		
			<?php echo $this->session->flashdata('alert'); ?>
			
			<?php echo form_open_multipart('admin/produk/add'); ?>
			<div class="row clearfix">
				
				<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">	
				
					<div class="card">
						<div class="header bg-light-blue">
							<h2><?php echo $page_title; ?></h2>
						</div>
						<div class="body">	
							
							<div class="form-group form-float">
								<?php $field_name = 'nama_produk'; ?>
								<?php $field_label = 'Nama Produk'; ?>
								<?php $field_error = form_error($field_name); ?>
								<div class="form-line <?php echo ($field_error) ? 'error' : ''; ?>">
									<input class="form-control" name="<?php echo $field_name; ?>" type="text" value="<?php echo set_value($field_name); ?>">
									<label class="form-label"><?php echo $field_label; ?></label>
								</div>
								<?php if($field_error): ?>
									<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
								<?php endif; ?>
							</div>

							<div class="form-group">
								<?php $field_name = 'description'; ?>
								<?php $field_label = 'Deskripsi Produk'; ?>
								<?php $field_error = form_error($field_name); ?>
								<div class="<?php echo ($field_error) ? 'error' : ''; ?>">
									<label class="form-label"><?php echo $field_label; ?></label>
									<textarea id="tinymce" name="<?php echo $field_name; ?>"><?php echo set_value($field_name); ?></textarea>
								</div>
								<?php if($field_error): ?>
									<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
								<?php endif; ?>
							</div>

							<div class="form-group form-float">
								<?php $field_name = 'total_stock'; ?>
								<?php $field_label = 'Total Stock'; ?>
								<?php $field_error = form_error($field_name); ?>
								<div class="form-line <?php echo ($field_error) ? 'error' : ''; ?>">
									<input class="form-control" name="<?php echo $field_name; ?>" type="number" value="<?php echo set_value($field_name); ?>">
									<label class="form-label"><?php echo $field_label; ?></label>
								</div>
								<?php if($field_error): ?>
									<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
								<?php endif; ?>
							</div>
							
							<div class="form-group form-float">
								<?php $field_name = 'harga_sewa'; ?>
								<?php $field_label = 'Harga Sewa'; ?>
								<?php $field_error = form_error($field_name); ?>
								<div class="form-line <?php echo ($field_error) ? 'error' : ''; ?>">
									<input class="form-control" name="<?php echo $field_name; ?>" type="number" value="<?php echo set_value($field_name); ?>">
									<label class="form-label"><?php echo $field_label; ?></label>
								</div>
								<?php if($field_error): ?>
									<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
								<?php endif; ?>
							</div>
							
							<button type="submit" class="btn btn-primary waves-effect"><i class="material-icons">check</i><span>SUBMIT</span></button>
															
							
						</div>
					</div>
				
				</div>
				
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				
					<div class="card">
						<div class="header bg-light-blue">
							<h2>Foto Produk</h2>
						</div>
						<div class="body">								
							
							<div class="form-group form-float">
								<?php $field_name = 'foto'; ?>
								<?php $field_label = 'Foto'; ?>
								<?php $field_error = form_error($field_name); ?>
								<div class="<?php echo ($field_error) ? 'error' : ''; ?>">								
									<input type="file" name="<?php echo $field_name; ?>">								
								</div>
								<?php if($field_error): ?>
									<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
								<?php endif; ?>				
							</div>
							
						</div>
					</div>
					
					<?php if(!empty($cats)): ?>
					<div class="card">
						<div class="header bg-light-blue">
							<h2>Kategori Produk</h2>
						</div>
						<div class="body">							
							
							<div class="form-group">
								<?php $field_name = 'kategori[]'; ?>
								<?php $field_label = 'Kategori'; ?>
								<?php $field_error = form_error($field_name); ?>
								<?php $reserved_values = set_value($field_name, array()); ?>
								<div class="<?php echo ($field_error) ? 'error' : ''; ?>">
									<label class="form-label"><?php echo $field_label; ?></label>
									<div class="form-group-cats">
										<div class="demo-checkbox">
											<?php the_cat_cb($cats, $reserved_values, $field_name); ?>									
										</div>
									</div>
								</div>
								<?php if($field_error): ?>
									<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
								<?php endif; ?>
							</div>								
							
						</div>
					</div>
					<?php endif; ?>
				
				</div>
			
			</div>
			
			<?php echo form_close(); ?>
		</div>
		
	
	</div>
	
	
	
</div>
</section>
