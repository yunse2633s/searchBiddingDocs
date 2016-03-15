<?php
namespace Admin\Controller;
use Think\Controller;

class SubjectController extends Controller{
    public function add(){
        if(IS_POST){
            $model = D('Subject');
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
        $this->display();
    }
     public function save($id){
        $model = D('Subject');
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
        $this->display();
    }
    public function lst(){
        $model = D('Subject');
        $data = $model->search();
        $this->assign(array(
                'data' => $data['data'],
                'page' => $data['page'],
                ));
        $this->display();
    }
    
    public function del($id){
        $model = D('Subject');
        $model->delete($id);
        $this->success('true');
    }
    public function bdel(){
        $dels = I('post.delid');
        if($dels){
            $dels = implode(',', $dels);
            $model = D('Subject');
            $model->delete($dels);
            }
        $this->success('操作成功！');
    }
    public function ajax(){
        $model = D('Infos');
        $data = $model->field('infoid,title,ownerunit,ownercontacts,is_on_sale,is_hot')->search();
        $this->assign(array(
                'data' => $data['data'],
                'page' => $data['page'],
                ));
        $this->display();
    }
    public function ajaxadd(){
        $model=D('subject');
        $model->infoTosubject();
    }
    public function ajaxlist($id){
        $ajax = D('infos');
        $data = $ajax->field('infoid,title')->where("infoid in ($id)")->select();
        echo json_encode($data);
    }
    public function menu(){
        $ajax = D('subject');
        $data = $ajax->field('id,subject')->select();
        echo json_encode($data);
    }
}