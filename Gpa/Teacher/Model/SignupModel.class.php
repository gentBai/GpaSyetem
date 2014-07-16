<?php
namespace Teacher\Model;
use Think\Model;
class SignupModel extends Model{

public function doSignup($c_id, $st_list) {
	$data = array();
	$time = time();
	if(is_array($st_list)) {
		foreach ($st_list as $st_k => $st_v) {
			$data[] = array("s_id" => $st_k, "c_id" => $c_id, "value" => $st_v, "time" => $time);
		}
		return $this -> addAll($data);
	} else {
		return 0;
	}
}

public function updateSignupScore($c_id) {
	$condition = array(
			"c_id" => $c_id,
			"is_del" => 0,
		);
	$field = array("s_id", "value");
	$data = $this -> field($field) -> where($condition) -> select();
	$score = array();
	foreach ($data as $data_k => $data_v) {
		$score[$data_v['s_id']]['sum'] += 1;
		if($data_v['value'] == 1) {
			$score[$data_v['s_id']]['score'] += 1;
		} elseif($data_v['value'] == 0) {
			$score[$data_v['s_id']]['score'] += 0.7;
		} elseif($data_v['value'] == -1) {
			$score[$data_v['s_id']]['score'] += 0;
		}
	}
	foreach ($score as $s_k => $s_v) {
		$s_v['score'] = $s_v['score'] * 100.0 / $s_v['sum'];
		D('ClassMessage') -> updateStudentScore($c_id, $s_k, 5, $s_v['score']);
	}
}

};
?>