<?php
namespace Teacher\Model;
use Think\Model;
class ClassMessageModel extends Model{

public function addStudents2Class($c_id, $st_list) {
	$data = array();
	if(is_array($st_list)) {
		foreach ($st_list as $st_k => $st_v) {
			$data[] = array("s_id" => $st_v, "c_id" => $c_id);
		}
		return $this -> addAll($data);
	} else {
		return 0;
	}

}

public function getStudentsByCid($c_id) {
	$db_prefix = C('DB_PREFIX');
	$field = array("s.s_id, s_user, s.s_name");
	$condition = array(
			"cm.t_id" => 0,
			"cm.c_id" => $c_id,
			"cm.is_del" => 0,
		);
	$data = $this -> field($field) -> join("cm inner join " . $db_prefix . "student s on cm.s_id = s.s_id") -> where($condition) -> select();
	return $data;
}
public function getStudentScores($c_id, $s_id) {
	$field = array("t_id", "score");
	$condition = array(
			"c_id" => $c_id,
			"s_id" => $s_id,
			"is_del" => 0,
		);
	$data = $this -> field($field) -> where($condition) -> select();
	return $data;
}

public function updateStudentScore($c_id, $s_id, $t_id, $score) {
	$condition = array(
			"c_id" => $c_id,
			"s_id" => $s_id,
			"t_id" => $t_id,
			"is_del" => 0,
		);
	$data = $this -> field("cm_id") -> where($condition) -> find();
	if(!$data) {
		$data = array(
				"c_id" => $c_id,
				"s_id" => $s_id,
				"t_id" => $t_id,
				"score" => $score,
			);
		$this -> add($data);
	} else {
		$cm_id = $data['cm_id'];
		$condition = array("cm_id" => $cm_id);
		$data = array(
			"score" => $score,
		);
		$this -> where($condition) -> setField($data);
	}
	if($t_id != 4) {
		$this -> updateTotalScore($c_id, $s_id);
	}
}

private function updateTotalScore($c_id, $s_id) {
	$condition = array(
			"c_id" => $c_id,
			"s_id" => $s_id,
			"is_del" => 0,
		);
	$field = array("t_id", "score");
	$sm_list = D('ScoreMessage') -> getScoreMessagesByCid($c_id);
	$cm_list = $this -> field($field) -> where($condition) -> select();
	$percent = array();
	foreach ($sm_list as $sm_k => $sm_v) {
		$percent[$sm_v['t_id']] = $sm_v['percent'];
	}
	$sum = 0;
	foreach ($cm_list as $cm_k => $cm_v) {
		$sum += $percent[$cm_v['t_id']] * $cm_v['score'] / 100.0;
	}
	$this -> updateStudentScore($c_id, $s_id, 4, $sum);
}

public function getStudentTotalScore($c_id, $s_id) {
	$condition = array(
			"c_id" => $c_id,
			"s_id" => $s_id,
			"t_id" => 4,
			"is_del" => 0,
		);
	$score = $this -> where($condition) -> getField('score');
	return $score;
}
public function getStudentTotalScoreBySid($s_id) {
	$db_prefix = C('DB_PREFIX');
	$condition = array(
			"cm.s_id" => $s_id,
			"cm.t_id" => 4,
			"cm.is_del" => 0,
		);
	$field = array("c.c_id", "cr.cr_name", "cm.score");
	$data = $this -> field($field) -> join("cm inner join " . $db_prefix . "class c on cm.c_id = c.c_id")
				-> join("inner join " . $db_prefix . "course cr on c.cr_id = cr.cr_id") -> where($condition) -> select();
	return $data;
}
};
?>