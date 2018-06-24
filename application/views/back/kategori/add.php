<section class="content">
<div class="container-fluid">
	
	<div class="row clearfix">		
		
		<div class="col-xs-12">
		
			<?php echo $this->session->flashdata('alert'); ?>
			
			<div class="card">
				<div class="header bg-light-blue">
					<h2>Tambah Kategori</h2>
				</div>
				<div class="body">
					
					<?php echo form_open('admin/kategori/add'); ?>
					
						<div class="form-group form-float">
							<?php $field_name = 'nama_kategori'; ?>
							<?php $field_label = 'Nama Kategori'; ?>
							<?php $field_error = form_error($field_name); ?>
							<div class="form-line <?php echo ($field_error) ? 'error' : ''; ?>">
								<input class="form-control" name="<?php echo $field_name; ?>" type="text" value="<?php echo set_value($field_name); ?>">
								<label class="form-label"><?php echo $field_label; ?></label>
							</div>
							<?php if($field_error): ?>
								<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
							<?php endif; ?>
						</div>

						<div class="form-group form-float">
							<?php $field_name = 'parent'; ?>
							<?php $field_label = 'Parent Kategori'; ?>
							<?php $field_error = form_error($field_name); ?>
							<div class="form-line <?php echo ($field_error) ? 'error' : ''; ?>">
								<label><?php echo $field_label; ?></label>
								<select name="<?php echo $field_name; ?>" class="form-control show-tick">
									<option value="0">---</option>
									<?php if(!empty($all_cats)): foreach($all_cats as $cat): ?>
										<option value="<?php echo $cat['id']; ?>" <?php selected($cat['id'], set_value($field_name)); ?>><?php echo $cat['nama_kategori']; ?></option>
									<?php endforeach; endif; ?>											
								</select>										
							</div>
							<?php if($field_error): ?>
								<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
							<?php endif; ?>				
						</div>
						
						<button type="submit" class="btn btn-primary waves-effect"><i class="material-icons">check</i><span>SUBMIT</span></button>
						
					<?php echo form_close(); ?>
					
				</div>
			</div>
		</div>
		
	
	</div>
	
	
	
</div>
</section>
