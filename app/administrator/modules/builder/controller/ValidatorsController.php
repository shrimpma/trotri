<?php
/**
 * Trotri
 *
 * @author    Huan Song <trotri@yeah.net>
 * @link      http://github.com/trotri/trotri for the canonical source repository
 * @copyright Copyright &copy; 2011-2013 http://www.trotri.com/ All rights reserved.
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */

namespace modules\builder\controller;

use library\BaseController;
use tfc\ap\Ap;
use tfc\mvc\Mvc;
use library\ErrorNo;
use library\Url;
use library\BuilderFactory;

/**
 * ValidatorsController class file
 * 控制器类
 * @author 宋欢 <trotri@yeah.net>
 * @version $Id: ValidatorsController.php 1 2014-01-20 15:58:15Z huan.song $
 * @package modules.builder.controller
 * @since 1.0
 */
class ValidatorsController extends BaseController
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
		$mod = BuilderFactory::getModel('Validators');
		$ele = BuilderFactory::getElements('Validators');

		$fieldId = $req->getInteger('field_id');
		$pageNo = Url::getCurrPage();
		$order = 'sort';
		$params = array('field_id' => $fieldId);
		$ret = $mod->search($params, $order, $pageNo);
		Url::setHttpReturn($ret['params']['attributes'], $ret['params']['curr_page']);

		$viw->assign('element_collections', $ele);
		$viw->assign('field_id', $fieldId);
		$viw->assign('builder_id', BuilderFactory::getModel('Fields')->getBuilderIdByFieldId($fieldId));
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
		$mod = BuilderFactory::getModel('Validators');
		$ele = BuilderFactory::getElements('Validators');

		$fieldId = $req->getInteger('field_id');
		if ($this->isPost()) {
			$ret = $mod->create($req->getPost());
			if ($ret['err_no'] === ErrorNo::SUCCESS_NUM) {
				$ret['field_id'] = $fieldId;
				if ($this->isSubmitTypeSave()) {
					$ret['http_referer'] = Url::getUrl('index', 'fields', Mvc::$module);
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

		$htmlLabel = BuilderFactory::getModel('Fields')->getHtmlLabelByFieldId($fieldId);
		$validatorMessages = $mod->getValidatorMessages($htmlLabel);
		$validatorMessages = json_encode($validatorMessages);

		$viw->assign('element_collections', $ele);
		$viw->assign('field_id', $fieldId);
		$viw->assign('validator_messages', $validatorMessages);
		$viw->assign('builder_id', BuilderFactory::getModel('Fields')->getBuilderIdByFieldId($fieldId));
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
		$mod = BuilderFactory::getModel('Validators');
		$ele = BuilderFactory::getElements('Validators');

		$fieldId = $mod->getFieldId();
		$httpReturn = Url::getHttpReturn();
		if ($httpReturn === '') {
			$httpReturn = Url::getUrl('index', Mvc::$controller, Mvc::$module, array('field_id' => $fieldId));
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

		$htmlLabel = BuilderFactory::getModel('Fields')->getHtmlLabelByFieldId($fieldId);
		$validatorMessages = $mod->getValidatorMessages($htmlLabel);
		$validatorMessages = json_encode($validatorMessages);

		$viw->assign('element_collections', $ele);
		$viw->assign('field_id', $fieldId);
		$viw->assign('validator_messages', $validatorMessages);
		$viw->assign('builder_id', BuilderFactory::getModel('Fields')->getBuilderIdByFieldId($fieldId));
		$viw->assign('id', $id);
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
		$mod = BuilderFactory::getModel('Validators');

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
		$mod = BuilderFactory::getModel('Validators');

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
