<?php
namespace Admin\Controller;
use Think\Controller;

class UsersController extends Controller{
    public function add(){
        if(IS_POST){
            $model = D('Users');
            if($model->create()){
                if($model->add()){
                    $this->success("true",U('lst'),1);
                    exit;
                }else{
                    $this->error("flase");
                }
            }else{
                $this->error($model->getError());
            }
        }
        $model = D('province');
        $result = $model->field('provinceid,provincename')->where('level=1')->select();
        $this->assign('data',$result);
        $this->display();
    }
     public function save($id){
        $model = D('Users');
        if(IS_POST){
              if($model->create()){
                if($a = $model->save() !== FALSE){
                    $this->error("true",U('lst'));
                    exit;
                }else{
                    $this->error("flase");
                }
            }else{
                $this->error($model->getError());
            }
        }
        $data = $model->find($id);
        $this->assign('data',$data);
        $model = D('province');
        $result = $model->where('level=1')->select();
        $this->assign('pdata',$result);
        $this->display();
    }
    public function lst(){
        $model = D('Users');
        $data = $model->search();
        $this->assign(array(
                'data' => $data['data'],
                'page' => $data['page'],
                ));
        $this->display();
    }
    
    public function del($id){
        $model = D('Users');
        $model->delete($id);
        $this->success('true');
    }
    public function bdel(){
        $dels = I('post.delid');
        if($dels){
            $dels = implode(',', $dels);
            $model = D('Users');
            $model->delete($dels);
            }
        $this->success('操作成功！');
        }
    public function vmform(){
        $this->display();
    }
    public function city($id){
        $modle = D('province');
        $city = $modle->field('provinceid,provincename')->where("pid=$id")->select();

        echo json_encode($city); 
    }
}