<?php
namespace Admin\Controller;
use Think\Controller;

class LimitsController extends Controller{
    public function add(){
        if(I('get.id')){
            $id = I('get.id');
            $usemodel = D('Users');
            $usedata = $usemodel->field('userid,username')->find($id);
            $this->assign('usedata',$usedata);
        }
        if(IS_POST){
            $model = D('Limits');
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
            $this->assign('prodata',$result);
        
        $this->display();
    }
     public function save($id){
        $model = D('Limits');
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
            $usemodel = D('Users');
            $usedata = $usemodel->field('userid,username')->find($id);
            $this->assign('usedata',$usedata);
            $model = D('province');
            $result = $model->field('provinceid,provincename')->where('level=1')->select();
            $this->assign('prodata',$result);
                
        $this->display();
    }
    public function lst(){
        $model = D('Limits');
        $data = $model->search();
        $this->assign(array(
                'data' => $data['data'],
                'page' => $data['page'],
                ));
        $this->display();
    }
    
    public function del($id){
        $model = D('Limits');
        $model->delete($id);
        $this->success('true');
    }
    public function bdel(){
        $dels = I('post.delid');
        if($dels){
            $dels = implode(',', $dels);
            $model = D('Limits');
            $model->delete($dels);
            }
        $this->success('操作成功！');
        }
    public function vmform(){
        $this->display();
    }
}