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
					
					<?php echo form_open('admin/transaksi/edit_item/'.$item->id.'/'.$id_transaksi); ?>					
					

						<?php $field_name = 'id_produk'; ?>
						<?php $field_label = 'Item yang akan disewa'; ?>
						<?php $field_error = form_error($field_name); ?>
						<p><label><?php echo $field_label; ?></label></p>
						<div class="form-group form-float">							
							<div class="form-line <?php echo ($field_error) ? 'error' : ''; ?>">				
								<select name="<?php echo $field_name; ?>" class="form-control show-tick" data-live-search="true">
									<option value="">-- Pilih Item --</option>
									<?php if(!empty($produks)): foreach($produks as $produk): ?>
										<option value="<?php echo $produk['id']; ?>" <?php selected($produk['id'], set_value($field_name, $item->id)); ?>><?php echo $produk['nama_produk']; ?></option>
									<?php endforeach; endif; ?>											
								</select>										
							</div>
							<?php if($field_error): ?>
								<label class="error" for="<?php echo $field_name; ?>"><?php echo $field_error; ?></label>
							<?php endif; ?>		
						</div>

						<div class="form-group form-float"  style="max-width: 200px;">
							<?php $field_name = 'qty'; ?>
							<?php $field_label = 'Kuantitas'; ?>
							<?php $field_error = form_error($field_name); ?>
							<div class="form-line <?php echo ($field_error) ? 'error' : ''; ?>">
								<input class="form-control" name="<?php echo $field_name; ?>" type="number" value="<?php echo set_value($field_name, $item->qty); ?>">
								<label class="form-label"><?php echo $field_label; ?></label>
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
