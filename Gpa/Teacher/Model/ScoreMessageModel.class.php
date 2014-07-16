<?php
namespace Teacher\Model;
use Think\Model;
class ScoreMessageModel extends Model{

public function addScoreMessage($c_id, $t_id, $percent) {
	$data = array(
			"c_id" => $c_id,
			"t_id" => $t_id,
			"percent" => $percent,
			"sm_time" => time(),
		);
	return $this -> add($data);
}

public function getScoreMessagesByCid($c_id) {
	$db_prefix = C('DB_PREFIX');
	$condition = array(
			"sm.c_id" => $c_id,
			"sm.is_del" => 0,
		);
	$field = array("sm.sm_id", "t.t_name", "t.t_id", "sm.percent");
	$data = $this -> field($field) -> join("sm right join " . $db_prefix . "type t on sm.t_id = t.t_id") -> where($condition) -> select();
	return $data;
}

public function updateScoreMessage($c_id, $t_id, $percent) {
	//先查找 如果不存在就插入 否则就修改
	$field = array("sm_id", "percent");
	$condition = array(
			"c_id" => $c_id,
			"t_id" => $t_id,
			"is_del" => 0,
		);
	$data = $this -> field($field) -> where($condition) -> find();
	if(!$data) {
		$data = array(
				"c_id" => $c_id,
				"t_id" => $t_id,
				"percent" => $percent,
				"sm_time" => time(),
			);
		return $this -> add($data);
	}
	$sm_id = $data['sm_id'];
	$condition = array("sm_id" => $sm_id);
	$data = array(
			"percent" => $percent,
			"sm_time" => time(),
		);
	return $this -> where($condition) -> setField($data);

}

};
?>