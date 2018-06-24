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
					
					<?php echo form_open('admin/identitas/edit/'.$result->id); ?>
					
						<div class="form-group form-float">
							<?php $field_error = form_error('jenis_identitas'); ?>
							<div class="form-line <?php echo ($field_error) ? 'error' : ''; ?>">
								<input class="form-control" name="jenis_identitas" type="text" value="<?php echo $result->jenis_identitas; ?>">
								<label class="form-label">Jenis Identitas</label>
							</div>
							<?php if($field_error): ?>
								<label class="error" for="jenis_identitas"><?php echo $field_error; ?></label>
							<?php endif; ?>
						</div>
						
						<button type="submit" class="btn bg-light-green waves-effect"><i class="material-icons">check</i><span>SIMPAN</span></button>
						
						
					<?php echo form_close(); ?>
					
				</div>
			</div>
		</div>
		
	
	</div>
	
	
	
</div>
</section>