<?php
namespace Teacher\Model;
use Think\Model;
class StudentModel extends Model{

public function login($s_user, $s_pwd, $is_del = 0){
    $condition = array();
    $condition['s_user'] = $s_user;
    $condition['s_pwd'] = $s_pwd;
    $condition['is_del'] = $is_del;
    $data = $this -> where($condition) -> find();
    return $data;
}
//登陆（记住密码）返回值
public function rememberMe($s_user, $date, $is_del = 0) {
    $condition = array();
    $condition['s_user'] = $s_user;
    $this -> where($condition) -> setField('remember_date', $date);
}
//得到用户信息
public function getUserById($s_user, $is_del = 0) {
    $condition = array('s_id' => $s_user, 'is_del' => $is_del);
    return $this -> where($condition) -> find();
}
public function getUserIdByUser($s_user) {
    $condition = array("s_user" => $s_user);
    $field = array("s_id");
    return $this -> field($field) -> where($condition) -> find();
}
public function addStudent($s_user, $s_name, $s_sex, $s_birthday, $s_aid) {
    $data = array(
            "s_user" => $s_user,
            "s_name" => $s_name,
            "sex" => $s_sex,
            "a_id" => $s_aid,
            "birthday" => $s_birthday,
        );
    $res = $this -> add($data);
    return $res;
}
public function getAllStudents() {
    $db_preffix = C('DB_PREFIX');
    $field = array("s.s_id, s.s_user", "s.s_name", "a.a_name");
    $res = $this -> field($field) -> join("s inner join " . $db_preffix ."academy a on s.a_id = a.a_id")
            -> select();
    return $res;
}
};
?>