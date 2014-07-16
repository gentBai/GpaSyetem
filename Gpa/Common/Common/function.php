<?php

function is_teacher() {
	if(!session('?gpa_identify')) {
		return 0;
	}
	if(session('u_type') == 't') {
		return 1;
	}
	return -1;
}
function is_student() {
	if(!session('?gpa_identify')) {
		return 0;
	}
	if(session('u_type') == 's') {
		return 1;
	}
	return -1;
}
function is_admin() {
	if(!session('?gpa_identify')) {
		return 0;
	}
	if(session('u_type') == 'a') {
		return 1;
	}
	return -1;
}
function is_score_type($t_id) {
	if($t_id > 4 && $t_id < 10) {
		return 1;
	} else {
		return 0;
	}
}
?>