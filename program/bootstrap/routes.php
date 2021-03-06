<?php

// The function to call if NearlyFreeMail is not installed yet.

$install = function()
{
    $controller = new \Controllers\Install();
    $controller->install_form();
};

// The function to call if index.php is called without any arguments.

$default = function()
{
    $user = \Models\Account::get(\Common\Session::get_login_id());
    $user and \Common\AJAX::redirect(\Common\Router::get_url('/mail'));
    $controller = new \Controllers\Account();
    $controller->login_form();
};

// Other routes.

$routes = array(
    
    'GET  /' => $default,
    
    'POST /([0-9a-f]{12,})' => '\\Controllers\\Incoming->receive',
    
    'GET  /account/welcome' => '\\Controllers\\Install->install_welcome',
    'GET  /account/login'   => '\\Controllers\\Account->login_form',
    'POST /account/login'   => '\\Controllers\\Account->login_post',
    'GET  /account/logout'  => '\\Controllers\\Account->logout',
    
    'GET  /mail'             => '\\Controllers\\Mailbox->inbox',
    'GET  /mail/list/(.*)'   => '\\Controllers\\Mailbox->show',
    'POST /mail/list/action' => '\\Controllers\\Mailbox->do_action',
    'GET  /mail/search'      => '\\Controllers\\Mailbox->search',
    
    'GET  /mail/read/(int)'                     => '\\Controllers\\Message->read',
    'POST /mail/read/(int)/encoding'            => '\\Controllers\\Message->change_encoding',
    'POST /mail/read/action/(int)'              => '\\Controllers\\Message->do_action',
    'GET  /mail/attachment/(int)/(int)/([^/]+)' => '\\Controllers\\Message->download_attachment',
    'GET  /mail/source/(int)\\.eml'             => '\\Controllers\\Message->download_source',
    
    'GET  /mail/compose'    => '\\Controllers\\Compose->create',
    'POST /mail/compose'    => '\\Controllers\\Compose->save',
    'GET  /mail/edit/(int)' => '\\Controllers\\Compose->edit',
    
    'GET  /settings'             => '\\Controllers\\Preference->show',
    'POST /settings/preferences' => '\\Controllers\\Preference->save',
    
    'GET  /settings/accounts'                    => '\\Controllers\\Account->show',
    'POST /settings/accounts/add'                => '\\Controllers\\Account->add',
    'GET  /settings/accounts/admin-grant/(int)'  => '\\Controllers\\Account->admin_grant_form',
    'POST /settings/accounts/admin-grant'        => '\\Controllers\\Account->admin_grant_post',
    'GET  /settings/accounts/admin-revoke/(int)' => '\\Controllers\\Account->admin_revoke_form',
    'POST /settings/accounts/admin-revoke'       => '\\Controllers\\Account->admin_revoke_post',
    'GET  /settings/accounts/reset/(int)'        => '\\Controllers\\Account->reset_form',
    'POST /settings/accounts/reset'              => '\\Controllers\\Account->reset_post',
    'GET  /settings/accounts/reset-ok/(int)'     => '\\Controllers\\Account->reset_ok',
    'GET  /settings/accounts/delete/(int)'       => '\\Controllers\\Account->delete_form',
    'POST /settings/accounts/delete'             => '\\Controllers\\Account->delete_post',
    'GET  /settings/accounts/delete-ok/(int)'    => '\\Controllers\\Account->delete_ok',
    
    'GET  /settings/aliases'             => '\\Controllers\\Alias->show',
    'POST /settings/aliases/add'         => '\\Controllers\\Alias->add',
    'GET  /settings/aliases/edit/(int)'  => '\\Controllers\\Alias->edit_form',
    'POST /settings/aliases/edit'        => '\\Controllers\\Alias->edit_post',
    'GET  /settings/aliases/howto/(int)' => '\\Controllers\\Alias->instructions',
    'POST /settings/aliases/action'      => '\\Controllers\\Alias->do_action',
    
    'GET  /settings/contacts'            => '\\Controllers\\Contact->show',
    'POST /settings/contacts/add'        => '\\Controllers\\Contact->add',
    'GET  /settings/contacts/edit/(int)' => '\\Controllers\\Contact->edit_form',
    'POST /settings/contacts/edit'       => '\\Controllers\\Contact->edit_post',
    'POST /settings/contacts/action'     => '\\Controllers\\Contact->do_action',
    
    'GET  /settings/folders'              => '\\Controllers\\Folder->show',
    'POST /settings/folders/add'          => '\\Controllers\\Folder->add',
    'GET  /settings/folders/edit/(int)'   => '\\Controllers\\Folder->edit_form',
    'POST /settings/folders/edit'         => '\\Controllers\\Folder->edit_post',
    'GET  /settings/folders/export/(int)' => '\\Controllers\\Folder->export_form',
    'POST /settings/folders/export'       => '\\Controllers\\Folder->export_post',
    'POST /settings/folders/action'       => '\\Controllers\\Folder->do_action',
    
    'GET  /settings/rules'               => '\\Controllers\\Rule->show',
    
);
