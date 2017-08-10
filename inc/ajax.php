<?php
/**
* ajax异步提交登录验证模块
*/
require_once '../../../../init.php';
$data3 = $_POST;
if (!empty($_POST)) {
	$username  = isset($_POST['user']) ? addslashes(trim($_POST['user'])) : '';
	$password  = isset($_POST['pw']) ? addslashes(trim($_POST['pw'])) : '';
	$ispersis  = isset($_POST['ispersis']) ? intval($_POST['ispersis']) : false;
	$img_code  = Option::get('login_code') == 'y' && isset($_POST['imgcode']) ? addslashes(trim(strtoupper($_POST['imgcode']))) : '';
	$errorCode = LoginAuth::checkUser($username, $password, $img_code);
	if ($errorCode === true) {
		LoginAuth::setAuthCookie($username, $ispersis);
		$userinfo = LoginAuth::getUserDataByLogin($username);
		$json     = array(
			'code' => '200',
			'username' => $userinfo['nickname']
		);
	} else {
		switch ($errorCode) {
			case '-3':
				$json = array(
					'code' => '201',
					'info' => '验证码输入有误'
				);
				break;
			case '-1':
				$json = array(
					'code' => '202',
					'info' => '账号或密码错误'
				);
				break;
			case '-2':
				$json = array(
					'code' => '203',
					'info' => '账号或密码错误'
				);
				break;
		}
	}
	print json_encode($json);
}
if ($_GET['a'] == 'ajax_logout') {
	setcookie(AUTH_COOKIE_NAME, ' ', time() - 31536000, '/');
}
if ($_GET['a'] == 'ajax') {
	if (ROLE == ROLE_ADMIN) {
		$DB = Database::getInstance();
		$userData = $DB->once_fetch_array("SELECT * FROM ".DB_PREFIX."user WHERE uid = '".UID."'");
        $userData['nickname'] = htmlspecialchars($userData['nickname']);
        $userData['username'] = htmlspecialchars($userData['username']);
		$json     = array(
			'code' => '200',
			'username' => $userData['nickname']
		);
	}else{
			$json = array(
				'code' => '208',
			);
	}
	print json_encode($json);
}
?>