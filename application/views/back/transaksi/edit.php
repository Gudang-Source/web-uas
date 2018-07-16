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
					
					<?php echo form_open('admin/transaksi/edit/'.$transaksi['id']); ?>	
					
					<div class="card">
					<div class="header bg-light-green">
						<h2>Peminjaman</h2>
					</div>				
					<div class="body">
					
						<?php $field_name = 'tgl_sewa'; ?>
						<?php $field_label = 'Tanggal Pinjam'; ?>
						<?php $field_error = form_error($field_name); ?>
						<p><label><?php echo $field_label; ?></label></p>
						<div class="input-group form-float" style="max-width: 400px;">
							<div class="form-line <?php echo ($field_error) ? 'error' : ''; ?>">
								<input type="text" class="datepicker form-control" name="<?php echo $field_name; ?>" placeholder="Silahkan pilih tanggal" value="<?php echo set_value($field_name, $transaksi[$field_name]); ?>" required>
							</div>
							<?php if($field_error): ?>
								<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
							<?php endif; ?>
						</div>						
					
						<?php $field_name = 'lama_sewa'; ?>
						<?php $field_label = 'Lama Sewa'; ?>
						<?php $field_error = form_error($field_name); ?>
						<p><label><?php echo $field_label; ?></label></p>
						<div class="input-group form-float" style="max-width: 400px;">							
							<div class="form-line <?php echo ($field_error) ? 'error' : ''; ?>">
								<input class="form-control" name="<?php echo $field_name; ?>" type="number" value="<?php echo set_value($field_name, $transaksi[$field_name]); ?>" placeholder="<?php echo $field_label; ?>">
							</div>
							<span class="input-group-addon">Hari</span>
							<?php if($field_error): ?>
								<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
							<?php endif; ?>
						</div>						
				
					</div>
					</div>						
						
					<button type="submit" class="btn btn-primary waves-effect"><i class="material-icons">check</i><span>SUBMIT</span></button>
						
					<?php echo form_close(); ?>
					
				</div>
			</div>
		</div>
		
	
	</div>
	
	
	
</div>
</section>