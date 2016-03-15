namespace <?php echo $moduleName;?>\Controller;
use Think\Controller;

class <?php echo $mvcName;?>Controller extends Controller{
    public function add(){
        if(IS_POST){
            $model = D('<?php echo $mvcName;?>');
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
        $model = D('<?php echo $mvcName;?>');
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
        $model = D('<?php echo $mvcName;?>');
        $data = $model->search();
        $this->assign(array(
                'data' => $data['data'],
                'page' => $data['page'],
                ));
        $this->display();
    }
    
    public function del($id){
        $model = D('<?php echo $mvcName;?>');
        $model->delete($id);
        $this->success('true');
    }
    public function bdel(){
        $dels = I('post.delid');
        if($dels){
            $dels = implode(',', $dels);
            $model = D('<?php echo $mvcName;?>');
            $model->delete($dels);
            }
        $this->success('操作成功！');
        }
    public function vmform(){
        $this->display();
    }
}