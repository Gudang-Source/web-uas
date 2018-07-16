<?php
function selected($param1, $param2) {
	if($param1 == $param2) {
		echo ' selected="selected" ';
	}
}

function the_nav_class($param1, $param2) {
	if($param1 == $param2) {
		echo ' active';
	}
}

function the_cat_td($cats, $level = 0) {
	
	if(!empty($cats)):
		foreach($cats as $cat):
	?>
		<tr>
			<td style="<?php echo ($level > 0) ? 'padding-left: '.($level * 20).'px;' : ''; ?>">
				<?php
				if($level > 0):
					echo '<i class="material-icons   font-20">subdirectory_arrow_right</i> ';
				endif;
				echo $cat['nama_kategori'];
				?>				
			</td>			
			<td>
				<a href="<?php echo site_url('admin/kategori/edit/'.$cat['id']); ?>" title="Edit"><i class="material-icons font-20">edit</i></a>
				&nbsp;
				<a href="<?php echo site_url('admin/kategori/del/'.$cat['id']); ?>" title="Hapus" class="col-red confirm-hapus"><i class="material-icons font-20">cancel</i></a>
			</td>
		</tr>
	<?php
			if(isset($cat['sub'])):
				 the_cat_td($cat['sub'], $level+1);
			endif;
		endforeach;	
	endif;	
	
}

function the_cat_cb($cats, $checked_data = array(), $field_name = 'default', $level = 0) {
	
	if(!empty($cats)):
		foreach($cats as $cat):
	?>
		<div style="<?php echo ($level > 0) ? 'padding-left: '.($level * 20).'px;' : ''; ?>">
			<input type="checkbox" id="cat_checkbox_<?php echo $cat['id']; ?>" 
			<?php if(in_array($cat['id'], $checked_data)): ?>
				checked="checked" 
			<?php endif; ?>
			name="<?php echo $field_name; ?>" value="<?php echo $cat['id']; ?>" />
			<label for="cat_checkbox_<?php echo $cat['id']; ?>"><?php echo $cat['nama_kategori']; ?></label>
		</div>		
	<?php
			if(isset($cat['sub'])):
				 the_cat_cb($cat['sub'], $checked_data, $field_name, $level+1);
			endif;
		endforeach;	
	endif;	
	
}

function bulma_navbar_menus($cats) {
	foreach($cats as $cat):
		
		if(isset($cat['sub']) && !empty($cat['sub'])):
		?>
		<div class="navbar-item has-dropdown is-hoverable">
			<a class="navbar-link" href="<?php echo site_url('cat/'.$cat['id']); ?>"><?php echo $cat['nama_kategori']; ?></a>
			<div class="navbar-dropdown is-boxed">
				<?php foreach($cat['sub'] as $sub): ?>
					<a class="navbar-item" href="<?php echo site_url('cat/'.$sub['id']); ?>"><?php echo $sub['nama_kategori']; ?></a>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
		else:
		?>
			<a class="navbar-item" href="<?php echo site_url('cat/'.$cat['id']); ?>"><?php echo $cat['nama_kategori']; ?></a>
		<?php
		endif;
	
	
	endforeach;
}

function format_angka($angka) {
	return number_format($angka,0,",",".");
}
function format_rupiah($angka) {
	return 'Rp. '.format_angka($angka);
}