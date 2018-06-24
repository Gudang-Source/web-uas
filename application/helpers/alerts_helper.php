<?php
function alert_error($message) {
	return '<div class="alert bg-pink animated shake">'.$message.'</div>';
}

function alert_success($message) {
	return '<div class="alert bg-light-green">'.$message.'</div>';
}