<?php
/**
 * Trotri
 *
 * @author    Huan Song <trotri@yeah.net>
 * @link      http://github.com/trotri/trotri for the canonical source repository
 * @copyright Copyright &copy; 2011-2013 http://www.trotri.com/ All rights reserved.
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */

namespace modules\generator\controller;

use library\BaseController;
use tfc\ap\Ap;
use tfc\mvc\Mvc;
use library\ErrorNo;
use library\Url;
use library\GeneratorFactory;

/**
 * IndexController class file
 * 生成代码控制器
 * @author 宋欢 <trotri@yeah.net>
 * @version $Id: IndexController.php 1 2013-02-08 00:48:06Z huan.song $
 * @package modules.generator.controller
 * @since 1.0
 */
class IndexController extends BaseController
{
	/**
	 * 数据列表
	 * @return void
	 */
	public function indexAction()
	{
		$ret = array();

		$req = Ap::getRequest();
		$mod = GeneratorFactory::getModel('Generators');
		$pageNo = $this->getCurrPage();

		$params = $req->getQuery();
		$params['trash'] = 'n';

		Mvc::getView()->assign('elementCollections', GeneratorFactory::getElements('Generators'));
		$ret = $mod->search($pageNo, $params);
		$this->render($ret);
	}

	/**
	 * 回收站数据列表
	 * @return void
	 */
	public function trashindexAction()
	{
		$ret = array();

		$req = Ap::getRequest();
		$mod = GeneratorFactory::getModel('Generators');
		$pageNo = $this->getCurrPage();

		$params = $req->getQuery();
		$params['trash'] = 'y';

		Mvc::getView()->assign('elementCollections', GeneratorFactory::getElements('Generators'));
		$ret = $mod->search($pageNo, $params);
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
		$mod = GeneratorFactory::getModel('Generators');

		if ($this->isPost()) {
			$ret = $mod->create($req->getPost());
			if ($ret['err_no'] === ErrorNo::SUCCESS_NUM) {
				if ($this->isSubmitTypeSave()) {
					Url::forward('modify', 'index', 'generator', $ret);
				}
				elseif ($this->isSubmitTypeSaveNew()) {
					Url::forward('create', 'index', 'generator', $ret);
				}
				elseif ($this->isSubmitTypeSaveClose()) {
					Url::forward('index', 'index', 'generator', $ret);
				}
			}
		}

		Mvc::getView()->assign('elementCollections', GeneratorFactory::getElements('Generators'));
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
		$mod = GeneratorFactory::getModel('Generators');
		$httpReferer = Url::getReferer();

		$id = $req->getInteger('id');
		if ($this->isPost()) {
			$ret = $mod->modifyByPk($id, $req->getPost());
			if ($ret['err_no'] === ErrorNo::SUCCESS_NUM) {
				if ($this->isSubmitTypeSave()) {
					Url::forward('modify', 'index', 'generator', $ret);
				}
				elseif ($this->isSubmitTypeSaveNew()) {
					Url::forward('create', 'index', 'generator', $ret);
				}
				elseif ($this->isSubmitTypeSaveClose()) {
					if ($httpReferer) {
						Url::referer($ret);
					}
					else {
						Url::forward('index', 'index', 'generator', $ret);
					}
				}
			}

			$ret['data'] = $req->getPost();
		}
		else {
			$ret = $mod->findByPk($id);
		}

		$ret['id'] = $id;
		if ($httpReferer) {
			$ret['http_referer'] = $httpReferer;
		}

		Mvc::getView()->assign('elementCollections', GeneratorFactory::getElements('Generators'));
		$this->render($ret);
	}

	/**
	 * 编辑单个字段
	 * @return void
	 */
	public function singlemodifyAction()
	{
		$ret = array();

		$req = Ap::getRequest();
		$mod = GeneratorFactory::getModel('Generators');

		$id = $req->getInteger('id');
		$columnName = $req->getTrim('column_name', '');
		$value = $req->getParam('value', '');
		$ret = $mod->updateByPk($id, array($columnName => $value));
		Url::referer($ret);
	}

	/**
	 * 批量编辑单个字段
	 * @return void
	 */
	public function batchsinglemodifyAction()
	{
		$ret = array();

		$req = Ap::getRequest();
		$mod = GeneratorFactory::getModel('Generators');

		$ids = explode(',', $req->getParam('ids'));
		$columnName = $req->getTrim('column_name', '');
		$value = $req->getParam('value', '');

		$ret = $mod->batchupdateByPk($ids, array($columnName => $value));
		Url::referer($ret);
	}

	/**
	 * 移至回收站
	 * @return void
	 */
	public function trashAction()
	{
		$ret = array();

		$req = Ap::getRequest();
		$mod = GeneratorFactory::getModel('Generators');

		$id = $req->getInteger('id');
		$ret = $mod->trashByPk($id);
		Url::referer($ret);
	}

	/**
	 * 批量移至回收站
	 * @return void
	 */
	public function batchtrashAction()
	{
		$ret = array();

		$req = Ap::getRequest();
		$mod = GeneratorFactory::getModel('Generators');

		$ids = explode(',', $req->getParam('ids'));
		$ret = $mod->batchTrashByPk($ids);
		Url::referer($ret);
	}

	/**
	 * 删除数据
	 * @return void
	 */
	public function removeAction()
	{
		$ret = array();

		$req = Ap::getRequest();
		$mod = GeneratorFactory::getModel('Generators');

		$id = $req->getInteger('id');
		$ret = $mod->deleteByPk($id);
		Url::referer($ret);
	}

	/**
	 * 批量删除数据
	 * @return void
	 */
	public function batchremoveAction()
	{
		$ret = array();

		$req = Ap::getRequest();
		$mod = GeneratorFactory::getModel('Generators');

		$ids = explode(',', $req->getParam('ids'));
		$ret = $mod->batchdeleteByPk($ids);
		Url::referer($ret);
	}

	/**
	 * 数据详情
	 * @return void
	 */
	public function viewAction()
	{
	}
}
