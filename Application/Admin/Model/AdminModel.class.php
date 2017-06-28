<?php
namespace Admin\Model;
use Think\Model;
/**
* 创建管理员模型
*/
class AdminModel extends Model
{
	//登录时表单验证的规则
	public $_login_validata = array(
		array('username','require','用户名不能为空！',1),
		array('password','require','密码不能为空！',1),
		array('chkcode','require','验证码不能为空！',1),
		array('chkcode','chk_chkcode','验证码不正确！',1,'callback'), 
		);
	public function chk_chkcode($code){
		$verity = new \Think\Verify();
		return $verity->check($code);
	}


	public function login()
	{
		//获取表单中的用户名密码
		$username = $this->username;
		$password = $this->password;
		//先查询数据库有没有这个账号
		$user = $this->where(array('username'=>array('eq',$username),
			))->find();
		//判断有没有账号
		if($user)
		{
			//判断是否启用（超级管理员不能禁用）
			if($user['id'] == 1 || $user['is_use'] == 1)
			{
				//判断密码
				if($user['password'] == md5($password.C('MD5_KEY')))
				{
					//把ID和用户名存到session中
					session('id',$user['id']);
					session('username',$user['username']);
					return false;
				}
				else
				{
					$this->error = '密码不正确！';
					return false;
				}
			}
			else
			{
				$this->error = '账号被禁用！';
				return false;
			}
		}
		else
		{
			$this->error = '用户名不存在！';
			return false;
		}
	}
}