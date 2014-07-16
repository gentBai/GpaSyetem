<?php
// 本类由系统自动生成，仅供测试用途
namespace Student\Controller;
use Think\Controller;
class IndexController extends Controller {
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
        $is_login = false;
        $is_login = A('Teacher/Index') -> judge_login();
        if(!$is_login){
            $this -> display('Teacher@Index/login');
        } else {
            $u_type = session('u_type');
    	    if($u_type == 't') {
                $this -> redirect(C('HOME_PAGE'));
            } elseif($u_type == 'a') {
                $this -> redirect(C('HOME_PAGE') . "admin/");
            } else {
                $data = D('Teacher/ClassMessage') -> getStudentTotalScoreBySid(session('uid'));
                $this -> assign("c_list", $data);
                $this -> display();
            }
        }
    }
    public function ques() {
        $c_id = $_POST['c_id'];
        $s_id = session("uid");
        $data = D('Teacher/Message') -> quesScoreToTeacher($c_id, $s_id);
        if($data) {
            $this -> ajaxReturn(array('status' => 1));
        } else {
            $this -> ajaxReturn(array('status' => 0));
        }
        exit;
    }
}