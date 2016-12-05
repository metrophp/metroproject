<?php
//default to develop environment
//this connects with $request->isDevelopment() $request->isDemo() $request->isEnv('prod')
_set('env', 'dev');
//override with Apache SetEnv
// or fastcgi_param   APPLICATION_ENV  production
if (array_key_exists('APPLICATION_ENV', $_SERVER)) {
	_set('env', $_SERVER['APPLICATION_ENV']);
}
if (array_key_exists('APP_ENV', $_SERVER)) {
	_set('env', $_SERVER['APP_ENV']);
}

//setup metrofw
_connect('analyze',   'metrofw/analyzer.php');
_connect('analyze',   'metrofw/router.php', 3);
_connect('resources', 'metrofw/output.php');
_connect('output',    'metrofw/output.php');
//will be removed if output.php doesn't think we need HTML output
_connect('output',    'metrofw/template.php', 3);

#raintpl
_connect('template.main', 'template/rain.php::template', 3);

_connect('exception',     'metrofw/exdump.php::onException');
_connect('hangup',        'metrofw/output.php');

_didef('request',            'metrofw/request.php');
_didef('response',           'metrofw/response.php');
_didef('router',             'metrofw/router.php');
_didef('foobar',             (object)array());

_didef('loggerService',      (object)array());

//Database
_didef('dataitem',                   'metrodb/dataitem.php');
#Metrodb_Connector::setDsn('default', 'mysql://root:mysql@127.0.0.1:3306/metrodb_test');
//end Database

//Users
#_connect('authenticate',         'metrou/authenticator.php');
#_connect('authorize',            'metrou/authorizer.php::requireLogin');

//events
#_connect('access.denied',        'metrou/login.php::accessDenied');
#_connect('authenticate.success', 'metrou/login.php::authSuccess');
#_connect('authenticate.failure', 'metrou/login.php::authFailure');

//things
#_didef('user',                   'metrou/user.php');
#_didef('session',                'metrou/sessiondb.php');
//end Users

_set('template_basedir', 'templates/');
_set('template_baseuri', 'templates/');
_set('template_name',    'webapp01');
_set('site_title',       'Hello Metro');

_set('route_rules',  array() );

_set('route_rules',
	array_merge(array('/:appName'=>array( 'modName'=>'main', 'actName'=>'main' )),
	_get('route_rules')));

_set('route_rules',
	array_merge(array('/:appName/:modName'=>array( 'actName'=>'main' )),
	_get('route_rules')));

_set('route_rules',
	array_merge(array('/:appName/:modName/:actName'=>array(  )),
	_get('route_rules')));

_set('route_rules',
	array_merge(array('/:appName/:modName/:actName/:arg'=>array(  )),
	_get('route_rules')));

// paste at bottom etc/bootsrap.php
_iCanHandle('hangup',  'example/helloworld.php');
