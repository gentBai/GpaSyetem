<?php
namespace Teacher\Model;
use Think\Model;
class CourseModel extends Model{

public function getAllCourseByAid($aid = 0) {
	$field = array("cr_id", "cr_name");
	$condition = array("is_del" => 0);
	if($aid != 0) {
		$condition['a_id'] = $aid;
	}
	$res = $this -> field($field) -> where($condition) -> select();
	return $res;
}

};
?>