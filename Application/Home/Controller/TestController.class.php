<?php
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller{
	public function _initialize(){
		header("Content-Type:text/html;charset=utf-8");//编码处理
	}
	public function hello($id){
		echo "这是第一个 ThinkPHP<br/>";
		echo $id;
	}
	public function _before_hello(){
		echo "before hello<br />";
	}
	public function _after_hello(){
		echo "after hello<br/>";
	}
	public function show_url(){
		echo U('Admin/Test/hello?id=1','id1=2&id2=3');
		echo "<BR/>";
		echo U('Test/hello',array('id1'=>1,'id2'=>2),'xml');
	}
	public function tiaozhuan($id){
		if($id){
			$this->success('success and jump');
		}
		else{
			$this->error('fail and jump');
		}
	}
	public function usermodel(){
		$User=M('Name');
		for($i=0;$i<10;$i++){
			$data['name']='zjy'.$i;
			$data['email']='525315462@qq.com'.$i;
			$data['tel']='18819490079';
			$User->add($data);
		}
	}
	public function showName(){
		$Model=M('Name');
		$data=$Model->table('think_user user,think_name name')->field('user.name,name.email')->where('name.id = 6')->select();
		var_dump($data);
	}
	public function test(){
		$this->display("index");
	}
}
?>