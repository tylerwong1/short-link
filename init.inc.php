<?php

require_once('predis/autoload.php');
require_once('util4p/MysqlPDO.class.php');
require_once('util4p/RedisDAO.class.php');
require_once('util4p/CRLogger.class.php');
require_once('util4p/ReSession.class.php');
require_once('util4p/CRObject.class.php');
require_once('util4p/AccessController.class.php');

require_once('Cache.class.php');
require_once('Counter.class.php');
require_once('config.inc.php');

init_mysql();
init_redis();
init_logger();
init_Session();
init_Cache();
init_Counter();
init_accessMap();

function init_mysql()
{
	$config = new CRObject();
	$config->set('host', DB_HOST);
	$config->set('port', DB_PORT);
	$config->set('db', DB_NAME);
	$config->set('user', DB_USER);
	$config->set('password', DB_PASSWORD);
	$config->set('show_error', DB_SHOW_ERROR);
	MysqlPDO::configure($config);
}

function init_redis()
{
	$config = new CRObject();
	$config->set('scheme', REDIS_SCHEME);
	$config->set('host', REDIS_HOST);
	$config->set('port', REDIS_PORT);
	$config->set('show_error', REDIS_SHOW_ERROR);
	RedisDAO::configure($config);
}

function init_logger()
{
	$config = new CRObject();
	$config->set('db_table', 'ls_log');
	CRLogger::configure($config);
}

function init_Session()
{
	$config = new CRObject();
	$config->set('time_out', SESSION_TIME_OUT);
	$config->set('bind_ip', BIND_SESSION_WITH_IP);
	$config->set('PK', 'username');
	Session::configure($config);
}

function init_Cache()
{
	$config = new CRObject();
	$config->set('time_out', 300);
	$config->set('prefix', 'cache');
	Cache::configure($config);
}

function init_Counter()
{
	$config = new CRObject();
	$config->set('db_table', 'ls_query_log');
	Counter::configure($config);
}

function init_accessMap()
{
	// $operation => array of roles
	$map = array(
		/* user */
		'user.get' => array('root', 'admin', 'developer', 'normal'),
		'user.get_others' => array('root', 'admin'),

		/* logs */
		'logs.get' => array('root', 'admin', 'developer', 'normal'),
		'logs.get_others' => array('root', 'admin'),

		/* link */
		'link.set' => array('root', 'admin', 'developer', 'normal', 'visitor'),
		'link.multiset' => array('root', 'admin', 'developer', 'normal'),
		'link.get' => array('root', 'admin', 'developer', 'normal', 'visitor'),
		'link.update' => array('root', 'admin', 'developer', 'normal'),
		'link.remove' => array('root', 'admin', 'developer', 'normal'),
		'link.remove_others' => array('root', 'admin'),
		'link.gets' => array('root', 'admin', 'developer', 'normal'),
		'link.get_others' => array('root', 'admin'),
		'link.analyze' => array('root', 'admin', 'developer', 'normal'),
		'link.analyze_others' => array('root', 'admin'),
		'link.block' => array('root', 'admin'),
		'link.unblock' => array('root', 'admin'),

		/* ucenter entry show control */
		'ucenter.home' => array('root', 'admin', 'developer', 'normal'),
		'ucenter.links' => array('root', 'admin', 'developer', 'normal'),
		'ucenter.links_all' => array('root', 'admin'),
		'ucenter.logs' => array('root', 'admin', 'developer', 'normal'),
		'ucenter.logs_all' => array('root', 'admin'),
		'ucenter.visitors' => array('root', 'admin')
	);
	AccessController::setMap($map);
}