<?php
namespace library;

use tfc\ap\Ap;
use tfc\ap\Singleton;
use tfc\mvc\Mvc;
use tfc\saf\DbProxy;

/**
 * Util class file
 * 常用工具类
 * @author 宋欢 <iphper@yeah.net>
 * @version $Id: Util.php 1 2013-04-05 19:41:06Z huan.song $
 * @package library
 * @since 1.0
 */
class Util
{
	/**
	 * 页面重定向到当前的Action
	 * @param array $params
	 * @param string $message
	 * @param integer $delay
	 * @return void
	 */
	public function refresh($params = array(), $message = '', $delay = 0)
	{
		self::forward('', '', '', $params, $message, $delay);
	}

	/**
	 * 页面重定向到指定的Action
	 * @param string $action
	 * @param string $controller
	 * @param string $module
	 * @param array $params
	 * @param string $message
	 * @param integer $delay
	 * @return void
	 */
	public function forward($action = '', $controller = '', $module = '', array $params = array(), $message = '', $delay = 0)
	{
		$url = self::getUrl($action, $controller, $module, $params);
		Ap::getResponse()->redirect($url, $message, $delay);
		exit;
	}

	/**
	 * 通过Params获取当前Url
	 * @param array $params
	 * @return string
	 */
	public function getUrlByAct(array $params = array())
	{
		return self::getUrlByCtrl('', $params);
	}

	/**
	 * 通过Action、Params获取当前控制器Url
	 * @param string $action
	 * @param array $params
	 * @return string
	 */
	public function getUrlByCtrl($action = '', array $params = array())
	{
		return self::getUrlByMod($action, '', $params);
	}

	/**
	 * 通过Action、Controller、Params获取当前模型的Url
	 * @param string $action
	 * @param string $controller
	 * @param array $params
	 * @return string
	 */
	public function getUrlByMod($action = '', $controller = '', array $params = array())
	{
		return self::getUrl($action, $controller, '', $params);
	}

	/**
	 * 通过Action、Controller、Module、Params获取Url
	 * @param string $action
	 * @param string $controller
	 * @param string $module
	 * @param array $params
	 * @return string
	 */
	public function getUrl($action = '', $controller = '', $module = '', array $params = array())
	{
		$url = Ap::getRequest()->getScriptUrl();

		if (($module = trim((string) $module)) === '') {
			$module = Mvc::$module;
		}

		if (($controller = trim((string) $controller)) === '') {
			$controller = Mvc::$controller;
		}

		if (($action = trim((string) $action)) === '') {
			$action = Mvc::$action;
		}

		$url .= '?r=' . $module . '/' . $controller . '/' . $action;
		foreach ($params as $key => $value) {
			$url .= '&' . $key . '=' . urlencode($value);
		}

		return $url;
	}

	/**
	 * 通过DB配置名获取DB操作类
	 * @param string $clusterName
	 * @return instance of tfc\saf\DbProxy
	 */
	public function getDbProxy($clusterName)
	{
		$className = 'tfc\saf\DbProxy::' . $clusterName;
		if (($instance = Singleton::get($className)) === null) {
			$instance = new DbProxy($clusterName);
			Singleton::set($className, $instance);
		}

		return $instance;
	}

	/**
	 * 获取表单管理类
	 * @param string $className
	 * @param string $moduleName
	 * @return instance of form
	 */
	public function getForm($className, $moduleName)
	{
		$className = 'modules\\' . strtolower($moduleName) . '\\form\\' . $className;
		return Singleton::getInstance($className);
	}

	/**
	 * 获取业务层类
	 * @param string $className
	 * @param string $moduleName
	 * @return instance of model
	 */
	public function getModel($className, $moduleName)
	{
		$className = 'modules\\' . strtolower($moduleName) . '\\model\\' . $className;
		return Singleton::getInstance($className);
	}

	/**
	 * 获取数据库层类
	 * @param string $className
	 * @param string $moduleName
	 * @return instance of db
	 */
	public function getDb($className, $moduleName)
	{
		$className = 'modules\\' . strtolower($moduleName) . '\\db\\' . $className;
		return Singleton::getInstance($className);
	}
}