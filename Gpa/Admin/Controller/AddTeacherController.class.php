<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Think\Controller;
class AddTeacherController extends Controller {
    public function __construct() {
        parent::__construct();
        if(is_admin() == 1 || is_teacher() == 1) {
            $user = D('Teacher/Teacher') -> getUserById(session('uid'));
            $this -> assign('name', $user['tc_name']);
            $this -> assign('identify', 't');
        } elseif(is_student() == 1) {
            $user = D('Teacher/Student') -> getUserById(session('uid'));
            $this -> assign('name', $user['s_name']);
            $this -> assign('identify', 's');
        }
    }
    public function index(){
        $judge = is_admin();
        if($judge == 0) {
            $this -> redirect(C('HOME_PAGE'));
        } elseif($judge == -1) {
            $this -> display(T("Teacher@Public/403"));
        }
        $a_list = D("Teacher/Academy") -> getAllAcademy();
        $this -> assign("a_list", $a_list);
        $this -> display();
    }
    public function addTeacher() {
        $tc_user = $_POST['tc_user'];
        $tc_name = $_POST['tc_name'];
        $administrator = $_POST['administrator'];
        $a_id = $_POST['a_id'];
        if(($tc_name == "") || ($tc_user == "")) {
            $this -> error("插入信息不完整");
        }
        $res = D("Teacher/Teacher") -> addTeacher($tc_user, $tc_name, $a_id, $administrator);
        if($res) {
            $this -> success("插入成功");
        } else {
            $this -> error("插入失败");
        }
    }
}