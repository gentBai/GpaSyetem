<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Think\Controller;
class AddController extends Controller {
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
        $cr_list = D('Teacher/Course') -> getAllCourseByAid();
        $a_list = D('Teacher/Academy') -> getAllAcademy();
        $st_list = D('Teacher/Student') -> getAllStudents();
        $tc_list = D('Teacher/Teacher') -> getAllTeachersByAid();
        $this -> assign("st_list", $st_list);
        $this -> assign("a_list", $a_list);
        $this -> assign("cr_list", $cr_list);
        $this -> assign("tc_list", $tc_list);
        $this -> display();
    }
    public function updateAid() {
        $aid = $_POST['aid'];
        $aid = isset($aid) ? intval($aid) : 0;
        $tc_list = D('Teacher/Teacher') -> getAllTeachersByAid($aid);
        $cr_list = D('Teacher/Course') -> getAllCourseByAid($aid);
        $res = array("tc_list" => $tc_list, "cr_list" => $cr_list);
        die(json_encode($res));
    }
    public function addClass() {
        $cr_id = $_POST['cr_id'];
    	$tc_id = $_POST['tc_id'];
        $qzcj = $_POST['qzcj'];
        $qmcj = $_POST['qmcj'];
        $sycj = $_POST['sycj'];
        $kqcj = $_POST['kqcj'];
        $zycj = $_POST['zycj'];
        $start_y = $_POST['start_y'];
        $start_m = $_POST['start_m'];
        $start_d = $_POST['start_d'];
        $finish_y = $_POST['finish_y'];
        $finish_m = $_POST['finish_m'];
        $finish_d = $_POST['finish_d'];
        $st_list = $_POST['st_list'];
        $start_time = mktime(0, 0, 0, $start_m, $start_d, $start_y);
        $finish_time = mktime(23, 59, 59, $finish_m, $finish_d, $finish_y);
        $cr_id = intval($cr_id);
        $tc_id = intval($tc_id);
        $qzcj = intval($qzcj);
        $qmcj = intval($qmcj);
        $sycj = intval($sycj);
        $kqcj = intval($kqcj);
        $zycj = intval($zycj);
        if($qzcj < 0 || $qmcj < 0 || $sycj < 0 || $kqcj < 0 || $zycj < 0 || ($qzcj + $qmcj + $sycj + $kqcj + $zycj) != 100) {
            $res = array("status" => -1);
            die(json_encode($res));
        } else {
            $st_count = count(array_keys($st_list));
            $c_id = D('Teacher/Class') -> addClass($cr_id, $tc_id, $st_count, $start_time, $finish_time);
            if(!$c_id) {
                $res = array("status" => 0);
                die(json_encode($res));
            }
            if($qzcj) {
                //期中成绩
                $status = D('Teacher/ScoreMessage') -> addScoreMessage($c_id, 7, $qzcj);
                if(!$status) {
                    $res = array("status" => 0);
                    die(json_encode($res));
                }
            }
            if($qmcj) {
                //期末成绩
                $status = D('Teacher/ScoreMessage') -> addScoreMessage($c_id, 8, $qmcj);
                if(!$status) {
                    $res = array("status" => 0);
                    die(json_encode($res));
                }
            }
            if($sycj) {
                //实验成绩
                $status = D('Teacher/ScoreMessage') -> addScoreMessage($c_id, 6, $sycj);
                if(!$status) {
                    $res = array("status" => 0);
                    die(json_encode($res));
                }
            }
            if($kqcj) {
                //考勤成绩
                $status = D('Teacher/ScoreMessage') -> addScoreMessage($c_id, 5, $kqcj);
                if(!$status) {
                    $res = array("status" => 0);
                    die(json_encode($res));
                }
            }
            if($zycj) {
                //作业成绩
                $status = D('Teacher/ScoreMessage') -> addScoreMessage($c_id, 9, $zycj);
                if(!$status) {
                    $res = array("status" => 0);
                    die(json_encode($res));
                }
            }
            $status = D('Teacher/ClassMessage') -> addStudents2Class($c_id, $st_list);
            if(!$status) {
                $res = array("status" => 0);
                die(json_encode($res));
            }
            $res = array("status" => 1);
            die(json_encode($res));
        }
    }
}