<?php
namespace Teacher\Model;
use Think\Model;
class TeacherModel extends Model{
//登陆
public function login($tc_user, $tc_pwd, $is_del = 0) {
    $condition = array();
    $condition['tc_user'] = $tc_user;
    $condition['tc_pwd'] = $tc_pwd;
    $condition['is_del'] = $is_del;
    $data = $this -> where($condition) -> find();
    return $data;
}
//登陆（记住密码）返回值
public function rememberMe($uid, $date, $is_del = 0) {
    $condition = array();
    $condition['tc_id'] = $uid;
    $this -> where($condition) -> setField('remember_date', $date);
}
//得到用户信息
public function getUserById($uid, $is_del = 0) {
    $condition = array('tc_id' => $uid, 'is_del' => $is_del);
    return $this -> where($condition) -> find();
}
public function addTeacher($tc_user, $tc_name, $a_id, $administrator) {
    $data = array(
            "tc_user" => $tc_user,
            "tc_name" => $tc_name,
            "a_id" => $a_id,
            "administrator" => $administrator,
        );
    return $this -> add($data);
}
public function getAllTeachersByAid($aid = 0) {
    $field = array("tc_id", "tc_name");
    $condition = array("is_del" => 0);
    if($aid != 0) {
        $condition["a_id"] = $aid;
    }
    return $this -> field($field) -> where($condition) -> select();
}

};
?>