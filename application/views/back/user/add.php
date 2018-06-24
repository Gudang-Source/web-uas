<section class="content">
<div class="container-fluid">
	
	<div class="row clearfix">		
		
		<div class="col-xs-12">
		
			<?php echo $this->session->flashdata('alert'); ?>
			
			<div class="card">
				<div class="header bg-light-blue">
					<h2>Tambah User</h2>
				</div>
				<div class="body">
					
					<?php echo form_open_multipart('admin/user/add'); ?>
					
						<div class="form-group form-float">
							<?php $field_name = 'username'; ?>
							<?php $field_label = 'Username'; ?>
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
							<?php $field_name = 'password'; ?>
							<?php $field_label = 'Password'; ?>
							<?php $field_error = form_error($field_name); ?>
							<div class="form-line <?php echo ($field_error) ? 'error' : ''; ?>">
								<input class="form-control" name="<?php echo $field_name; ?>" type="password" value="<?php echo set_value($field_name); ?>">
								<label class="form-label"><?php echo $field_label; ?></label>
							</div>
							<?php if($field_error): ?>
								<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
							<?php endif; ?>
						</div>
						
						<div class="form-group form-float">
							<?php $field_name = 'retype_password'; ?>
							<?php $field_label = 'Ulangi Password'; ?>
							<?php $field_error = form_error($field_name); ?>
							<div class="form-line <?php echo ($field_error) ? 'error' : ''; ?>">
								<input class="form-control" name="<?php echo $field_name; ?>" type="password" value="<?php echo set_value($field_name); ?>">
								<label class="form-label"><?php echo $field_label; ?></label>
							</div>
							<?php if($field_error): ?>
								<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
							<?php endif; ?>
						</div>
					
						<div class="form-group form-float">
							<?php $field_name = 'nama'; ?>
							<?php $field_label = 'Nama'; ?>
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
							<?php $field_name = 'email'; ?>
							<?php $field_label = 'Email'; ?>
							<?php $field_error = form_error($field_name); ?>
							<div class="form-line <?php echo ($field_error) ? 'error' : ''; ?>">
								<input class="form-control" name="<?php echo $field_name; ?>" type="email" value="<?php echo set_value($field_name); ?>">
								<label class="form-label"><?php echo $field_label; ?></label>
							</div>
							<?php if($field_error): ?>
								<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
							<?php endif; ?>
						</div>
						
						<div class="form-group form-float">
							<?php $field_name = 'role'; ?>
							<?php $field_label = 'Role'; ?>
							<?php $field_error = form_error($field_name); ?>
							<div class="form-line <?php echo ($field_error) ? 'error' : ''; ?>">
								<select name="<?php echo $field_name; ?>" class="form-control show-tick">
									<option value="">-- Jenis Role --</option>
									<?php if(!empty($roles)): foreach($roles as $role): ?>
										<option value="<?php echo $role['id_role']; ?>" <?php selected($role['id_role'], set_value($field_name)); ?>><?php echo $role['nama_role']; ?></option>
									<?php endforeach; endif; ?>											
								</select>										
							</div>
							<?php if($field_error): ?>
								<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
							<?php endif; ?>				
						</div>
						
						<div class="form-group form-float">
							<?php $field_name = 'foto'; ?>
							<?php $field_label = 'Foto'; ?>
							<?php $field_error = form_error($field_name); ?>
							<div class="<?php echo ($field_error) ? 'error' : ''; ?>">
								<label class="form-label"><?php echo $field_label; ?></label>
								<input type="file" name="<?php echo $field_name; ?>">								
							</div>
							<?php if($field_error): ?>
								<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
							<?php endif; ?>				
						</div>
						
						
						<button type="submit" class="btn btn-primary waves-effect"><i class="material-icons">add</i><span>SUBMIT</span></button>
						
					<?php echo form_close(); ?>
					
				</div>
			</div>
		</div>
		
	
	</div>
	
	
	
</div>
</section>
