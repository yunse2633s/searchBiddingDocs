<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model{
    protected $tableName = 'Admin';
    protected $_validate = array(
            array('username', 'require', '用户名不能为空！', 1),
            array('password', 'require', '密码不能为空！', 1, 'regex', 1),
            array('password', 'require', '密码不能为空！', 1, 'regex', 4),
            array('username', '', '用户名已经存在！', 1, 'unique', 1),
            array('username', '', '用户名已经存在！', 1, 'unique', 2),
            array('chk_code', '_chkCode', '验证码不正确！', 1, 'callback', 4),
    );
    protected function _chkCode($code){
        $verify = new \Think\Verify();
        return $verify->check($code, '');
    }
    public function logout(){
        session('userS',NULL);
    }
    private function _putPriToSession($role_id,&$userS){
        $roleModel = M('Role');
        $pList = $roleModel->field('pri_id_list')->find($role_id);
        $priModel = M('Privilege');
        if( $pList === NULL || $pList['pri_id_list'] == '*'){
                $userS['privilege']='*';
                $menu = $priModel->where('parent_id=0')->select();
                foreach ($menu as $k=>$v){
                    $menu[$k]['sub']=$priModel->where('parent_id='.$v['id'])->select();
                } 
            }else{
                $fields = 'id,pri_name,parent_id,module_name,controller_name,action_name,CONCAT(module_name,"/",controller_name,"/",action_name) as url';
                $_priData = $priModel->field($fields)->where("id IN ({$pList['pri_id_list']})")->select();
                $menu = array();
                $priData = array();
                foreach ($_priData as $k => $v){
                    if($v['parent_id'] == 0){
                        $menu[] = $v;
                       
                    }
                    $priData[] = $v['url'];  
                }
                foreach($menu as $k=>$v){
                    foreach ($_priData as $k1 => $v1){
                        if($v1['parent_id'] == $v['id']){
                            $menu[$k]['sub'][]=$v1;
                        }
                    }
                }
               $userS['privilege']=$priData;
            }
       session('menu',$menu);
    }
    public function login(){
        $password = $this->password;
        $info = $this->where("username='$this->username'")->find();
        if($info){
                if($info['password'] == md5($password)){
                    $userS = array(
                        'id' => $info['id'],
                        'username' => $info['username'],
                    );
                    $this->_putPriToSession($info['role_id'],$userS);
                    session('userS', $userS);
                    return TRUE;
                }else{
                    $this->error("2");
                }
        }else{
            $this->error("1");
        }
    }
    protected function _before_insert(&$data, $option){
            $data['password'] = md5($data['password']);
    }
    protected function _before_update(&$data, $option){
        if($data['password']){
            $data['password'] = md5($data['password']);
        }else{
            unset($data['password']);
        }      
    }
    public function search(){
        $where = 1;
        if($un = I('get.un')){
                $where .= ' AND username LIKE "%'.$un.'%"';
        }
        if($id = I('get.id')){
                $where .= ' AND id='.$id;
        }
        $perpage = 15;
        $totalRecord = $this->where($where)->count();
        $page = new \Think\Page($totalRecord, $perpage);
        return array(
                'data' => $this->where($where)->limit($page->firstRow, $page->listRows)->order('id ASC')->select(),
                'page' => $page->show(),
        );
    }
}