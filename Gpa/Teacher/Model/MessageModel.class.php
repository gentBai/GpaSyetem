<?php
namespace Teacher\Model;
use Think\Model;
class MessageModel extends Model{

public function isAvailable($c_id) {
	$condition = array(
			"c_id" => $c_id,
			"is_del" => 0,
		);
	return $this -> where($condition) -> select();
}

public function askForUpdateScoreMessage($c_id, $t_id, $old_percent, $new_percent) {
	$data = array(
			"type" => 2,
			"c_id" => $c_id,
			"t_id" => $t_id,
			"old_per" => $old_percent,
			"new_per" => $new_percent,
			"time" => time(),
		);
	return $this -> add($data);
}

public function getMsgCidList() {
	$db_prefix = C('DB_PREFIX');
	$condition = array(
				"msg.type" => 2,
				"msg.is_del" => 0,
			);
	$field = array("msg.c_id", "tc.tc_name", "cr.cr_name");
	$data = $this -> field($field) -> join("msg inner join " . $db_prefix . "class c on msg.c_id = c.c_id inner join ". $db_prefix . "course cr on c.cr_id = cr.cr_id inner join "
				. $db_prefix . "teacher tc on c.tc_id = tc.tc_id")
				-> where($condition) -> group("msg.c_id") -> select();
	return $data;
}

public function getMsgForAdminByCid($c_id) {
	$db_prefix = C("DB_PREFIX");
	$condition = array(
				"msg.type" => 2,
				"msg.is_del" => 0,
				"msg.c_id" => $c_id,
			);
	$field = array("msg.c_id", "msg.t_id", "msg.old_per", "msg.new_per", "msg.time", "t.t_name");
	$data = $this -> field($field) -> join("msg inner join " . $db_prefix . "type t on msg.t_id = t.t_id") -> where($condition) -> select();
	return $data;
}

public function editJudgeFinish($c_id, $t_id) {
	$condition = array(
			"c_id" => $c_id,
			"t_id" => $t_id,
			"type" => 2,
		);
	$update = array("is_del" => 1);
	return $this -> where($condition) -> setField($update);
}

public function quesScoreToTeacher($c_id, $s_id) {
	$data = array(
			"c_id" => $c_id,
			"s_id" => $s_id,
			"type" => 1,
			"is_del" => 0,
		);
	$res = $this -> where($data) -> find();
	if($res) {
		return 0;
	} else {
		return $this -> add($data);
	}
}

public function getQuesByTcid($tc_id) {
	$db_prefix = C('DB_PREFIX');
	$condition = array(
			"tc.tc_id" => $tc_id,
		);
	$field = array("msg.msg_id", "cr.cr_name", "s.s_name");
	$data = $this -> field($field) -> join("msg inner join ".$db_prefix."class c on msg.c_id = c.c_id") -> join("inner join ".$db_prefix."course cr on c.cr_id = cr.cr_id")
				-> join("inner join ".$db_prefix."student s on s.s_id = msg.s_id") -> join("inner join ".$db_prefix."teacher tc on tc.tc_id = c.tc_id")
				-> where($condition) -> select();
	return $data;
}
public function readTeacherMsg($msg_id) {
	$condition = array(
			"msg_id" => $msg_id,
		);
	$update = array("is_del" => 1);
	return $this -> where($condition) -> setField($update);
}
};
?>