<?php
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller{
   public function login(){
        if(IS_POST){
           $model = D('adminers');
            if($model->create($_POST,4)){
                $result = $model->login(); 
                if($result === TRUE){
                    $this->success("true",U('Index/index'),1);
                    exit;
                }else{
                    $result == 1 ? $this->error('user not exists') : $this->error('pwd error');
                }
            }else{
                $this->error($model->getError(),1);
            }
        }
        $this->display();
    }
    public function chk_code(){
        $config =array(
            'length'    =>  3,
            'useCurve'  =>  false,
            'useNoise'  =>  false,
            'fontSize'  =>  14,
            );
        $verity = new \Think\Verify($config);
        $verity->entry();
    }
    public function logout(){
        $model = D('admin');
        $model->logout();
        $this->success('sucess',U('Admin/Login/login'));
    }
}
