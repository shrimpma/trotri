<?php
/**
 * Trotri
 *
 * @author    Huan Song <trotri@yeah.net>
 * @link      http://github.com/trotri/trotri for the canonical source repository
 * @copyright Copyright &copy; 2011-2013 http://www.trotri.com/ All rights reserved.
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */

namespace modules\ucenter\controller;

use library\BaseController;
use tfc\ap\Ap;
use tfc\mvc\Mvc;
use library\ErrorNo;
use library\Url;
use library\UcenterFactory;

/**
 * AmcasController class file
 * 控制器类
 * @author 宋欢 <trotri@yeah.net>
 * @version $Id: AmcasController.php 1 2014-01-06 16:47:52Z huan.song $
 * @package modules.ucenter.controller
 * @since 1.0
 */
class AmcasController extends BaseController
{
	/**
	 * 查询数据列表
	 * @return void
	 */
	public function indexAction()
	{
		$ret = array();

		$req = Ap::getRequest();
		$viw = Mvc::getView();
		$mod = UcenterFactory::getModel('Amcas');
		$ele = UcenterFactory::getElements('Amcas');

		$pageNo = Url::getCurrPage();
		$order = '';
		$params = array();
		$ret = $mod->search($params, $order, $pageNo);
		Url::setHttpReturn($ret['params']['attributes'], $ret['params']['curr_page']);

		$viw->assign('element_collections', $ele);
		$viw->assign('http_return', Url::getHttpReturn());
		$this->render($ret);
	}

	/**
	 * 新增数据
	 * @return void
	 */
	public function createAction()
	{
		$ret = array();

		$req = Ap::getRequest();
		$viw = Mvc::getView();
		$mod = UcenterFactory::getModel('Amcas');
		$ele = UcenterFactory::getElements('Amcas');

		if ($this->isPost()) {
			$ret = $mod->create($req->getPost());
			if ($ret['err_no'] === ErrorNo::SUCCESS_NUM) {
				if ($this->isSubmitTypeSave()) {
					Url::forward('modify', Mvc::$controller, Mvc::$module, $ret);
				}
				elseif ($this->isSubmitTypeSaveNew()) {
					Url::forward('create', Mvc::$controller, Mvc::$module, $ret);
				}
				elseif ($this->isSubmitTypeSaveClose()) {
					Url::forward('index', Mvc::$controller, Mvc::$module, $ret);
				}
			}
		}

		$viw->assign('element_collections', $ele);
		$this->render($ret);
	}

	/**
	 * 编辑数据
	 * @return void
	 */
	public function modifyAction()
	{
		$ret = array();

		$req = Ap::getRequest();
		$viw = Mvc::getView();
		$mod = UcenterFactory::getModel('Amcas');
		$ele = UcenterFactory::getElements('Amcas');

		$httpReturn = Url::getHttpReturn();
		if ($httpReturn === '') {
			$httpReturn = Url::getUrl('index', Mvc::$controller, Mvc::$module, array());
		}

		$id = $req->getInteger('id');
		if ($this->isPost()) {
			$ret = $mod->modifyByPk($id, $req->getPost());
			if ($ret['err_no'] === ErrorNo::SUCCESS_NUM) {
				if ($this->isSubmitTypeSave()) {
					$ret['http_return'] = $httpReturn;
					Url::forward('modify', Mvc::$controller, Mvc::$module, $ret);
				}
				elseif ($this->isSubmitTypeSaveNew()) {
					Url::forward('create', Mvc::$controller, Mvc::$module, $ret);
				}
				elseif ($this->isSubmitTypeSaveClose()) {
					$url = Url::applyParams($httpReturn, $ret);
					Url::redirect($url);
				}
			}

			$ret['data'] = $req->getPost();
		}
		else {
			$ret = $mod->findByPk($id);
		}

		$viw->assign('element_collections', $ele);
		$this->render($ret);
	}

	/**
	 * 删除数据
	 * @return void
	 */
	public function removeAction()
	{
		$ret = array();

		$req = Ap::getRequest();
		$mod = UcenterFactory::getModel('Amcas');

		$id = $req->getInteger('id');
		$ret = $mod->deleteByPk($id);
		Url::httpReturn($ret);
	}

	/**
	 * 编辑单个字段
	 * @return void
	 */
	public function singlemodifyAction()
	{
		$ret = array();

		$req = Ap::getRequest();
		$mod = UcenterFactory::getModel('Amcas');

		$id = $req->getInteger('id');
		$columnName = $req->getTrim('column_name', '');
		$value = $req->getParam('value', '');
		$ret = $mod->updateByPk($id, array($columnName => $value));
		Url::httpReturn($ret);
	}

	/**
	 * 查询数据详情
	 * @return void
	 */
	public function viewAction()
	{
	}

}
