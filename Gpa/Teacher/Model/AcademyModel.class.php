<?php
namespace Teacher\Model;
use Think\Model;
class AcademyModel extends Model{
	public function getAllAcademy() {
		$field = array("a_id", "a_name");
		$condition = array("is_del" => 0);
		$res = $this ->field($field) -> where($condition) -> select();
		return $res;
	}
};
?>