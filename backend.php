<?php defined('SYSPATH') OR die('No direct access allowed.');


Observer::observe('view_user_edit_plugins', function($user) {
	echo View::factory('accounts/userblock/edit', array(
		'user' => $user,
		'settings_link' => Route::get('backend')->uri(array(
			'controller' => 'system', 'action' => 'settings')
		) . '#social-accounts-settings',
		'params' => Config::get('social'),
		'socials' => $user->socials->find_all(),
		'providers' => SSO::connected_accounts(),
		'linked' => array()
	));
});

Observer::observe('admin_login_form_after_button', function() {
	echo View::factory('accounts/userblock/login', array(
		'providers' => SSO::connected_accounts(),
		'params' => Config::get('social')
	));
});

if(ACL::check('system.social.settings'))
{
	Observer::observe('view_setting_plugins', function() {
		echo View::factory('accounts/settings', array(
			'oauth' => Config::get('oauth.accounts'),
			'params' => Config::get('social')
		));
	});
	
	Observer::observe('validation_settings', function( $validation, $filter ) {
		$filter
			->rule('oauth.register', 'intval', 0);
	});
}