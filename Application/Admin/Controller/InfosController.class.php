<?php
namespace Admin\Controller;
use Think\Controller;

class InfosController extends Controller{
    public function add(){
        if(IS_POST){
            $model = D('Infos');
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
        $result = $model->where('level=1')->select();
        $this->assign('pdata',$result);
        $bmodel = D('biddingstatus');
        $bresult = $bmodel->select();
        $this->assign('bdata',$bresult);
        $this->display();
    }
     public function save($id){
        $model = D('Infos');
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
        $bmodel = D('biddingstatus');
        $bresult = $bmodel->select();
        $this->assign('bdata',$bresult);
        $this->display();
    }
    public function lst(){
        $model = D('Infos');
        $data = $model->search();
        $this->assign(array(
                'data' => $data['data'],
                'page' => $data['page'],
                ));
        $this->display();
    }
    
    public function del($id){
        $model = D('Infos');
        $model->delete($id);
        $this->success('true');
    }
    public function bexec(){
        $dels = I('post.delid');

        if(I('post.bdel')){
            $this->bdel($dels);
        }
        if(I('post.bhot')){
            $this->bhot($dels);
        }

    }
    public function bdel($dels){
        
        if($dels){
            $dels = implode(',', $dels);
            $model = D('Infos');
            $model->delete($dels);
            }
        $this->success('操作成功！');
        }

    public function bhot($dels){

        $dels = implode(',', $dels);
        $model = D('Infos');
        $data['is_hot'] = '是';
        $hotexe = $model->where("infoid in ($dels)")->save($data);
        $this->success('操作成功！');
    }
}