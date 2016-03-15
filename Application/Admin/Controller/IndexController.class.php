<?php
namespace Admin\Controller;
use Think\Controller;

class IndexController extends Controller{
    public function __construct(){
        parent::__construct();        
    }
    public function index(){
		$this->display();
	}
    public function top(){
        $user = $_SESSION['userS']['username'];
        $this->assign('user',$user);
		$this->display();
	}
    public function menu(){
		$this->display();
	}
    public function main(){
		$this->display();
	}
       
    
}