<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller{
    public function index(){
        $model = D('subject');
        $sub_img = $model->subimg();

        $total = D('infos')->count();
        $info_data = D('infos')->ishot();
        if(isset($_COOKIE['infoid'])){
            $cookie_id = cookie('infoid');
            $browse_info = D('infos')->browsinfo($cookie_id);
            $browse_total = count($browse_info);
        }else{
            $browse_inf='';
        }
        $this->assign('data',array(
            'total'         =>  $total,
            'loop_data'     =>  $sub_img,
            'info_data'     =>  $info_data,
            'browse_info'   =>  $browse_info,
            'browse_total'  =>  $browse_total,
            ));
        $this->display();
    }
    public function imgloop(){
        $model = D('subject');
        $sub_img = $model->subject_img();
        echo json_encode($sub_img);
    }
}