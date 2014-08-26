<?php defined('SYSPATH') OR die('No direct access allowed.');

$route = (IS_BACKEND ? '('.ADMIN_DIR_NAME.'/)' : '') . '<directory>/<controller>/<action>';
$actions = array(
	'identify',
	'login', 'complete_login',
	'register', 'complete_register',
	'connect', 'complete_connect',
	'disconnect', 'complete_disconnect'
);

Route::set('accounts-auth', $route, array(
	'directory' => '(openid|oauth)', 
	'action' => '('.implode('|', $actions).')'
));

Plugin::factory('sso', array(
	'title' => 'SSO',
	'version' => '1.0.0',
	'description' => 'Social account services',
))->register();
