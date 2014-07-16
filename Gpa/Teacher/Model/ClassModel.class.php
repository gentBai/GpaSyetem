<?php
namespace Teacher\Model;
use Think\Model;
class ClassModel extends Model{

public function addClass($cr_id, $tc_id, $st_count, $start_time, $finish_time) {
	$data = array(
			"cr_id" => $cr_id,
			"tc_id" => $tc_id,
			"c_num" => $st_count,
			"start_time" => $start_time,
			"finish_time" => $finish_time,
		);
	return $this -> add($data);
}
public function getClassListByTcid($tc_id) {
	$db_prefix = C('DB_PREFIX');
	$condition = array(
			"c.tc_id" => $tc_id,
			"c.is_del" => 0,
		);
	$field = array("c.c_id", "cr.cr_name", "c.c_num", "c.start_time", "c.finish_time");
	$data = $this -> field($field) -> join("c inner join " . $db_prefix . "course cr on c.cr_id = cr.cr_id")
				-> where($condition) -> select();
	return $data;
}


};
?>