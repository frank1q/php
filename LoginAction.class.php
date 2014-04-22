<?php
	class LoginAction extends Action{
		public function login(){
			$this->display();
		}
		public function dologin(){
			if($_SESSION['verify'] != md5($_POST['verify'])) {
			   $this->error('驗證碼錯誤！');
			}
			$where['pwd'] = md5($_POST['password']);
			$where['user'] = $_POST['username'];
			$user = M('Adminuser');
			$userarr = $user->where($where)->find();
			if($userarr){
				$_SESSION['uid'] = $userarr['uid'];
				$_SESSION['user'] = $userarr['user'];
				$_SESSION['role'] = $userarr['role'];
				$_SESSION['SELL_IS_LOGINED'] = 1;
				$this->redirect('Index/index');
				exit;
			}
			else{
				$this->error('Username or Password ERROR!');
			}
		}
		// 用户退出
		public function quit(){
			session('[destroy]'); // 销毁session
			$this->redirect('Index/index');
		}
		// 验证码
		Public function verify(){
		    import('ORG.Util.Image');
		    Image::buildImageVerify();
		}
	}
?>