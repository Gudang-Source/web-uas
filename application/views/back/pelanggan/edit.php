<section class="content">
<div class="container-fluid">
	
	<div class="row clearfix">		
		
		<div class="col-xs-12">
		
			<?php echo $this->session->flashdata('alert'); ?>
			
			<div class="card">
				<div class="header bg-light-blue">
					<h2>Edit Pelanggan</h2>
				</div>
				<div class="body">
					
					<?php echo form_open('admin/pelanggan/edit/'.$pelanggan->id); ?>					
						
						<div class="form-group form-float">
							<?php $field_name = 'nama'; ?>
							<?php $field_error = form_error($field_name); ?>
							<div class="form-line <?php echo ($field_error) ? 'error' : ''; ?>">
								<input class="form-control" name="<?php echo $field_name; ?>" type="text" value="<?php echo set_value($field_name, $pelanggan->$field_name); ?>">
								<label class="form-label">Nama Pelanggan</label>
							</div>
							<?php if($field_error): ?>
								<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
							<?php endif; ?>
						</div>
						
						<div class="row clearfix">
							<div class="col-sm-12 col-md-6" style="margin-bottom: 0;">
								
								<div class="form-group form-float">
									<?php $field_name = 'no_identitas'; ?>
									<?php $field_error = form_error($field_name); ?>
									<div class="form-line <?php echo ($field_error) ? 'error' : ''; ?>">
										<input class="form-control" name="<?php echo $field_name; ?>" type="text" value="<?php echo set_value($field_name, $pelanggan->$field_name); ?>">
										<label class="form-label">No. Identitas</label>
									</div>
									<?php if($field_error): ?>
										<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
									<?php endif; ?>
								</div>
								
							</div>							
						
							<div class="col-sm-12 col-md-6" style="margin-bottom: 0;">							
								<div class="form-group form-float">
									<?php $field_name = 'id_identitas'; ?>
									<?php $field_error = form_error($field_name); ?>
									<div class="form-line <?php echo ($field_error) ? 'error' : ''; ?>">
										<select name="<?php echo $field_name; ?>" class="form-control show-tick">
											<option value="">-- Jenis Identitas --</option>
											<?php if(!empty($identitas)): foreach($identitas as $ident): ?>
												<option value="<?php echo $ident['id']; ?>" <?php selected($ident['id'], set_value($field_name, $pelanggan->$field_name)); ?>><?php echo $ident['jenis_identitas']; ?></option>
											<?php endforeach; endif; ?>											
										</select>										
									</div>
									<?php if($field_error): ?>
										<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
									<?php endif; ?>				
								</div>
							</div>
						</div>
						
						<div class="form-group form-float">
							<?php $field_name = 'alamat'; ?>
							<?php $field_error = form_error($field_name); ?>
							<div class="form-line <?php echo ($field_error) ? 'error' : ''; ?>">
								<input class="form-control" name="<?php echo $field_name; ?>" type="text" value="<?php echo set_value($field_name, $pelanggan->$field_name); ?>">
								<label class="form-label">Alamat</label>
							</div>
							<?php if($field_error): ?>
								<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
							<?php endif; ?>
						</div>
						
						<div class="form-group form-float">
							<?php $field_name = 'no_hp'; ?>
							<?php $field_error = form_error($field_name); ?>
							<div class="form-line <?php echo ($field_error) ? 'error' : ''; ?>">
								<input class="form-control" name="<?php echo $field_name; ?>" type="text" value="<?php echo set_value($field_name, $pelanggan->$field_name); ?>">
								<label class="form-label">No. HP</label>
							</div>
							<?php if($field_error): ?>
								<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
							<?php endif; ?>
						</div>
						
						<div class="form-group form-float">
							<?php $field_name = 'email'; ?>
							<?php $field_error = form_error($field_name); ?>
							<div class="form-line <?php echo ($field_error) ? 'error' : ''; ?>">
								<input class="form-control" name="<?php echo $field_name; ?>" type="email" value="<?php echo set_value($field_name, $pelanggan->$field_name); ?>">
								<label class="form-label">Email</label>
							</div>
							<?php if($field_error): ?>
								<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
							<?php endif; ?>
						</div>
						
						
						
						<button type="submit" class="btn bg-light-green waves-effect"><i class="material-icons">check</i><span>SIMPAN</span></button>
						<a href="<?php echo site_url('admin/pelanggan'); ?>" class="btn bg-blue-grey waves-effect"><i class="material-icons">cancel</i><span>BATAL</span></a>
						
					<?php echo form_close(); ?>
					
				</div>
			</div>
		</div>
		
	
	</div>
	
	
	
</div>
</section>