<?php
namespace Teacher\Controller;
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
        $is_login = $this -> judge_login();
        if(!$is_login){
            $this -> display('login');
        } else {
            $u_type = session('u_type');
            if($u_type == 's') {
                $this -> redirect(C('HOME_PAGE') . "student/");
            } elseif($u_type == 'a') {
                $this -> redirect(C('HOME_PAGE') . "admin/");
            } else {
                $c_list = D('Class') -> getClassListByTcid(session('uid'));
                foreach ($c_list as $c_k => $c_v) {
                    $start = date("Y-m", $c_v['start_time']);
                    $finish = date("Y-m", $c_v['finish_time']);
                    $c_list[$c_k]['time'] = $start . "~" . $finish;
                }
                $this -> assign("c_list", $c_list);
                $msg_list = D('Teacher/Message') -> getQuesByTcid(session('uid'));
                // dump(M()->getLastSql());
                // dump($msg_list);exit;
                $this -> assign("msg_list", $msg_list);
                $this -> display();
            }
        }
    }
    public function login(){
        $login_flag = true;
        $u_type = $_POST['u_type'];
        $u_name = $_POST['username'];
        $u_pwd = $_POST['password'];
        $u_pwd = md5($u_pwd);
        $remember = $_POST['remember-me'];
        $user = array();
        $date = date('Ymd',time() + 3600 * 24 * 15);
        if($u_type == 't'){  //老师
            $user = D('Teacher') -> login($u_name, $u_pwd);
            if(!$user) {
                $login_flag = false;
            } else {
                $uid = $user['tc_id'];
                if($user['administrator']) {    //管理员
                    $u_type = 'a';
                }
            }
        } elseif($u_type == 's') {   //学生
            $user = D('Student') -> login($u_name, $u_pwd);
            if(!$user) {
                $login_flag = false;
            } else {
                $uid = $user['s_id'];
            }
        }
        if($login_flag == false) {
            $this -> login_failed();
        } else {
            $login_info = md5($uid . $u_pwd);
            session('gpa_identify', $login_info);
            session('uid', $uid);
            session('u_type', $u_type);
            if($remember) {
                setcookie('gpa_identify', md5($uid . $u_pwd . $date) , time() + 3600 * 24 * 15, '/');
                setcookie('uid', $uid , time() + 3600 * 24 * 15, '/');
                setcookie('u_type', $u_type , time() + 3600 * 24 * 15, '/');
                if($u_type == 'a' || $u_type == 't') {
                    D('Teacher/Teacher') -> rememberMe($uid, $date);
                } else {
                    D('Teacher/Student') -> rememberMe($uid, $date);
                }
            }
            if($u_type == 's') {
                $this -> redirect(C('HOME_PAGE') . "student/");
            } elseif($u_type == 'a') {
                $this -> redirect(C('HOME_PAGE') . "admin/");
            } else {
                $this -> redirect(C('HOME_PAGE'));
            }
        }
    }

    public function logout(){
        session('uid', null);
        session('gpa_identify', null);
        session('u_type', null);
        cookie('gpa_identify', null);
        cookie('uid', null);
        cookie('u_type', null);
        $this -> redirect(C('HOME_PAGE'));
    }

    public function judge_login(){
        if((!isset($_COOKIE['gpa_identify'])) && (!session('?gpa_identify'))) {
            return 0;
        } elseif(session('gpa_identify')) {
            $identify = session('gpa_identify');
            $uid = session('uid');
            $u_type = session('u_type');
            $tmp_identify = null;
            //判断信息是否正确
            if($u_type == 's') {
                $user_info = D('Teacher/Student') -> getUserById($uid);
                $tmp_identify = md5($uid . $user_info['s_pwd']);
            } elseif($u_type == 't' || $u_type == 'a') {
                $user_info = D('Teacher/Teacher') -> getUserById($uid);
                $tmp_identify = md5($uid . $user_info['tc_pwd']);
            } else {
                return 0;
            }
            if($tmp_identify == $identify) {
                return $u_type;
            } else {
                return 0;
            }
        } elseif(isset($_COOKIE['gpa_identify'])) {
            $identify = $_COOKIE['gpa_identify'];
            $uid = $_COOKIE['uid'];
            $u_type = $_COOKIE['u_type'];
            $tmp_identify = null;
            $session_identify = null;
            //判断信息是否正确
            if($u_type == 's') {
                $user_info = D('Teacher/Student') -> getUserById($uid);
                $tmp_identify = md5($uid . $user_info['s_pwd'] . $user_info['remember_date']);
                $session_identify = md5($uid . $user_info['s_pwd']);
            } elseif($u_type == 't' || $u_type == 'a') {
                $user_info = D('Teacher/Teacher') -> getUserById($uid);
                $tmp_identify = md5($uid . $user_info['tc_pwd']. $user_info['remember_date']);
                $session_identify = md5($uid . $user_info['tc_pwd']);
            } else {
                return 0;
            }
            if($tmp_identify == $identify) {
                session('uid', $uid);
                session('gpa_identify', $session_identify);
                session('u_type', $u_type);
                return $u_type;
            } else {
                return 0;
            }
        }
    }

    public function login_failed(){
        $this -> error('登陆失败');
    }

    public function msg_read() {
        $msg_id = $_POST['msg_id'];
        D('Teacher/Message') -> readTeacherMsg($msg_id);
    }

}