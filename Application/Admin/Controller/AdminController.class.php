<?php
namespace Admin\Controller;
class AdminController extends IndexController{
	public function add(){
            if(IS_POST){
                $model = D('Admin');
                if($model->create()){
                    if($model->add()){
                        $this->success('添加成功！', U('lst'));
                        exit;
                    }
                    else 
                        $this->error('添加失败，请重试！');
                }
                else
                    $this->error($model->getError());
            }
            $roleModel = D('role');
            $result = $roleModel->field('id,role_name')->select();
            $this->assign('roledata',$result);
            $this->display();
	}
	public function save($id){
            $model = D('Admin');
            if(IS_POST){
                    if($model->create()){
                        if($model->save() !== FALSE){
                            $this->success('修改成功！', U('lst'));
                            exit;
                        }
                        else
                            $this->error('修改失败，请重试！');
                    }
                    else
                        $this->error($model->getError());
            }
            $data = $model->find($id);
            $this->assign('data', $data);
            $roleModel = D('role');
            $result = $roleModel->field('id,role_name')->select();
            $this->assign('roledata',$result);
            $this->display();
	}
	public function lst(){
            $model = D('Admin');
            $data = $model->search();
            $this->assign(array(
                    'data' => $data['data'],
                    'page' => $data['page'],
            ));
            $this->display();
	}
	public function del($id){
            if($id > 1){
                $model = M('Admin');
                $model->delete($id);
            }
            $this->success('操作成功！');
	}
	public function bdel(){
            $delid = I('post.delid');
            if($delid){
                $key = array_search(1, $delid);
                if($key !== FALSE)
                    unset($delid[$key]);
                if($delid){
                    $delid = implode(',', $delid); 
                    $model = M('Admin');
                    $model->delete($delid);
                    }
            }
            $this->success('操作成功！');
	}
}