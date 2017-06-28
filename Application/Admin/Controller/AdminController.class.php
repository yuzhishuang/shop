<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller
{
	public function login()
	{
		if(IS_POST)
		{
			$model = D('Admin');
			if($model->volidate($model->_login_validata)->create())
			{
				if(true === $model->login())
					redirect(U('Admin/Index/index')); //直接跳转
			}
			$this->error($model->getError());
		}
		$this->display();
	}
	//生成验证码图片
	public function chkcode()
	{
		$config =    array(    'fontSize'    =>    30,    // 验证码字体大小    
							   'length'      =>    3,     // 验证码位数    
							   'useNoise'    =>    false, // 关闭验证码杂点
							   );
		$Verify = new \Think\Verify($config);
		$Verify->entry();
	}
}