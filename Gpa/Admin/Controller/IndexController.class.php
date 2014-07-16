<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
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
    	    if($u_type == 's') {
                $this -> redirect(C('HOME_PAGE') . "student/");
            } elseif($u_type == 't') {
                $this -> redirect(C('HOME_PAGE'));
            } else {
                $msg_list = D('Teacher/Message') -> getMsgCidList();
                $this -> assign("msg_list", $msg_list);
                $this -> display();
            }
        }
    }

    public function judgeEdit() {
        $c_id = $_GET['c_id'];
        $msg_list = D('Teacher/Message') -> getMsgForAdminByCid($c_id);
        foreach ($msg_list as $msg_k => $msg_v) {
            $msg_list[$msg_k]['key'] = 'msg[' . $msg_v['t_id'] . ']';
        }
        $this -> assign("msg_list", $msg_list);
        $this -> assign("c_id", $c_id);
        $this -> display();
    }

    public function editResult() {
        $c_id = $_POST['c_id'];
        $msg_list = $_POST['msg'];
        $submit = $_POST['submit'];
        if($submit == '不通过') {
            foreach ($msg_list as $sm_k => $sm_v) {
                D('Teacher/Message') -> editJudgeFinish($c_id, $sm_k);
            }
            $this -> success("审核结果不通过~", C('HOME_PAGE'));
        } else{
            foreach ($msg_list as $sm_k => $sm_v) {
                D('Teacher/ScoreMessage') -> updateScoreMessage($c_id, $sm_k, $sm_v);
                D('Teacher/Message') -> editJudgeFinish($c_id, $sm_k);
            }
            $this -> success("审核通过~", C('HOME_PAGE'));
        }
    }
}