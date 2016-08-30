<?php
namespace Home\Controller;
use Think\Controller;
/**
* 
*/
class TestController extends Controller
{
	
	public function test(){
			
		$sql = M()->table('Dept')->select();
		// dump($data);
		dump($sql);



	}
}

?>