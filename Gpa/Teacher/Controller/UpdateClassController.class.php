<?php
namespace Teacher\Controller;
use Think\Controller;
class UpdateClassController extends Controller {
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
    public function record() {
        $judge = is_teacher();
        if($judge == 0) {
            $this -> redirect("/");
        } elseif($judge == -1) {
            $this -> error("你没有权限");
        }
        $c_id = $_GET['c_id'];
        $tc_id = session('uid');
        $c_list = D('Class') -> getClassListByTcid(session('uid'));
        $this -> assign("c_list", $c_list);
        $st_list = D('ClassMessage') -> getStudentsByCid($c_id);
        foreach ($st_list as $st_k => $st_v) {
            $tmp = D('ClassMessage') -> getStudentScores($c_id, $st_v['s_id']);
            foreach ($tmp as $tmp_k => $tmp_v) {
                $st_list[$st_k][$tmp_v['t_id']] = $tmp_v['score'];
            }
        }
        $this -> assign("c_id", $c_id);
        $this -> assign("st_list", $st_list);
        $this -> display();
    }
    public function signup() {
        $judge = is_teacher();
        if($judge == 0) {
            $this -> redirect("/");
        } elseif($judge == -1) {
            $this -> error("你没有权限");
        }
        $c_id = $_GET['c_id'];
        $tc_id = session('uid');
        $this -> assign("c_id", $c_id);
        $c_list = D('Class') -> getClassListByTcid(session('uid'));
        $this -> assign("c_list", $c_list);
        $st_list = D('ClassMessage') -> getStudentsByCid($c_id);
        $this -> assign("st_list", $st_list);
        $this -> display();
    }
    public function edit() {
        $judge = is_teacher();
        if($judge == 0) {
            $this -> redirect("/");
        } elseif($judge == -1) {
            $this -> error("你没有权限");
        }
        $c_id = $_GET['c_id'];
        $this -> assign("c_id", $c_id);
        $tc_id = session('uid');
        $judge = D('Message') -> isAvailable($c_id);
        if($judge) {
            $this -> error("上次申请还未审核~不要急~");
        }
        $c_list = D('Class') -> getClassListByTcid(session('uid'));
        $this -> assign("c_list", $c_list);
        $tmp_list = D('ScoreMessage') -> getScoreMessagesByCid($c_id);
        $sm_list = array();
        foreach ($tmp_list as $sm_l => $sm_v) {
            if(is_score_type($sm_v['t_id'])) {
                $sm_v['key'] = "sm[" . $sm_v['t_id'] . "]";
                $sm_v['old'] = "old[" . $sm_v['t_id'] . "]";
                $sm_list[] = $sm_v;
            }
        }
        $this -> assign("sm_list", $sm_list);
        $this -> display();
    }
    public function updateScoreMessage() {
        $c_id = $_POST['c_id'];
        $tmp_list = D('ScoreMessage') -> getScoreMessagesByCid($c_id);
        $sm_list = array();
        foreach ($tmp_list as $sm_l => $sm_v) {
            if(is_score_type($sm_v['t_id'])) {
                $sm_v['key'] = "sm[" . $sm_v['t_id'] . "]";
                $sm_v['old'] = "old[" . $sm_v['t_id'] . "]";
                $sm_list[] = $sm_v;
            }
        }
        die(json_encode($sm_list));
    }
    public function updateStudentList() {
        $c_id = $_POST['c_id'];
        $tc_id = session('uid');
        $st_list = D('ClassMessage') -> getStudentsByCid($c_id);
        die(json_encode($st_list));
    }
    public function doSignup() {
        $c_id = $_POST['c_id'];
        $st_list = $_POST['st_list'];
        $res = D('Signup') -> doSignup($c_id, $st_list);
        D('Signup') -> updateSignupScore($c_id);
        if($res) {
            $this -> success("签到成功", C('HOME_PAGE'));
        } else{
            $this -> error("签到出错");
        }
    }
    public function doEdit() {
        $c_id = $_POST['c_id'];
        $sm_list = $_POST['sm'];
        $old_list = $_POST['old'];
        $sum = 0;
        foreach ($sm_list as $sm_k => $sm_v) {
            if($sm_v < 0 || $sm_v > 100) {
                $this -> error("比重不合理");
            }
            $sum += intval($sm_v);
        }
        if($sum != 100) {
            $this -> error("比重不合理");
        }
        foreach ($sm_list as $sm_k => $sm_v) {
            D('Message') -> askForUpdateScoreMessage($c_id, $sm_k, $old_list[$sm_k], $sm_v);
        }
        $this -> success("申请成功", C('HOME_PAGE'));
    }
    public function updateScore() {
        $c_id = $_POST['c_id'];
        $s_id = $_POST['s_id'];
        $t_id = $_POST['t_id'];
        $old_score = $_POST['old_score'];
        $old_score = isset($old_score) ? intval($old_score) : 0;
        $new_score = $_POST['new_score'];
        if($old_score == $new_score) {
            die( json_encode(array('status' => 0, "msg" => "没有修改", "t_score" => 0)));
        }
        D('ClassMessage') -> updateStudentScore($c_id, $s_id, $t_id, $new_score);
        $t_score = D('ClassMessage') -> getStudentTotalScore($c_id, $s_id);
        return die( json_encode(array('status' => 1, "msg" => "修改成功", "t_score" => $t_score)));
    }
}