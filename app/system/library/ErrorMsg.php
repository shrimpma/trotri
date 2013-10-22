<?php
namespace library;

/**
 * ErrorMsg class file
 * 常用错误信息类
 * @author 宋欢 <iphper@yeah.net>
 * @version $Id: ErrorMsg.php 1 2013-04-05 19:41:06Z huan.song $
 * @package library
 * @since 1.0
 */
class ErrorMsg
{
	/**
	 * @var string OK
	 */
	const SUCCESS_NUM                  = 'OK';

	/**
	 * @var string 参数错误
	 */
	const ERROR_REQUEST                = 'Request Error!';

	/**
	 * @var string 用户没有访问权限
	 */
	const ERROR_NO_POWER               = 'Power Error!';

	/**
	 * @var string 用户未登录，禁止访问
	 */
	const ERROR_NO_LOGIN               = 'No Login!';

	/**
	 * @var string 系统运行异常
	 */
	const ERROR_SYSTEM_RUN_ERR         = 'System Run Error!';

	/**
	 * @var string 脚本运行失败
	 */
	const ERROR_SCRIPT_RUN_ERR         = 'Script Run Error!';

	/**
	 * @var string 未知错误
	 */
	const ERROR_UNKNOWN                = 'Unknown Error!';

	/**
	 * @var string 查询成功
	 */
	const SUCCESS_SELECT               = 'Select Successfully!';

	/**
	 * @var string 添加成功
	 */
	const SUCCESS_INSERT               = 'Insert Successfully!';

	/**
	 * @var string 更新成功
	 */
	const SUCCESS_UPDATE               = 'Update Successfully!';

	/**
	 * @var string 删除成功
	 */
	const SUCCESS_DELETE               = 'Delete Successfully!';

	/**
	 * @var string 保存成功
	 */
	const SUCCESS_REPLACE              = 'Replace Successfully!';

	/**
	 * @var string 查询失败，提交内容有误
	 */
	const ERROR_ARGS_SELECT            = 'Select Failed, Args Error!';

	/**
	 * @var string 添加失败，提交内容有误
	 */
	const ERROR_ARGS_INSERT            = 'Insert Failed, Args Error!';

	/**
	 * @var string 更新失败，提交内容有误
	 */
	const ERROR_ARGS_UPDATE            = 'Update Failed, Args Error!';

	/**
	 * @var string 删除失败，提交内容有误
	 */
	const ERROR_ARGS_DELETE            = 'Delete Failed, Args Error!';

	/**
	 * @var string 保存失败，提交内容有误
	 */
	const ERROR_ARGS_REPLACE           = 'Replace Failed, Args Error!';

	/**
	 * @var string 查询失败，数据库操作失败
	 */
	const ERROR_DB_SELECT              = 'Select Failed, DB Error!';

	/**
	 * @var string 添加失败，数据库操作失败
	 */
	const ERROR_DB_INSERT              = 'Insert Failed, DB Error!';

	/**
	 * @var string 更新失败，数据库操作失败
	 */
	const ERROR_DB_UPDATE              = 'Update Failed, DB Error!';

	/**
	 * @var string 删除失败，数据库操作失败
	 */
	const ERROR_DB_DELETE              = 'Delete Failed, DB Error!';

	/**
	 * @var string 保存失败，数据库操作失败
	 */
	const ERROR_DB_REPLACE             = 'Replace Failed, DB Error!';

	/**
	 * @var string 查询数据库成功，但是查询结果为空
	 */
	const ERROR_DB_SELECT_EMPTY        = 'Select DB Successfully, But Result Empty!';

	/**
	 * @var string 操作数据库成功，但是影响行数为零
	 */
	const ERROR_DB_AFFECTS_ZERO        = 'Operate DB Successfully, But Affects Zero!';

	/**
	 * @var string 查询失败，文件操作失败
	 */
	const ERROR_FILE_SELECT            = 'Select Failed, File Error!';

	/**
	 * @var string 添加失败，文件操作失败
	 */
	const ERROR_FILE_INSERT            = 'Insert Failed, File Error!';

	/**
	 * @var string 更新失败，文件操作失败
	 */
	const ERROR_FILE_UPDATE            = 'Update Failed, File Error!';

	/**
	 * @var string 删除失败，文件操作失败
	 */
	const ERROR_FILE_DELETE            = 'Delete Failed, File Error!';

	/**
	 * @var string 保存失败，文件操作失败
	 */
	const ERROR_FILE_REPLACE           = 'Replace Failed, File Error!';

	/**
	 * @var string 查询文件成功，但是查询结果为空
	 */
	const ERROR_FILE_SELECT_EMPTY      = 'Select File Successfully, But Result Empty!';

	/**
	 * @var string 查询失败，缓存操作失败
	 */
	const ERROR_CACHE_SELECT           = 'Select Failed, Cache Error!';

	/**
	 * @var string 添加失败，缓存操作失败
	 */
	const ERROR_CACHE_INSERT           = 'Insert Failed, Cache Error!';

	/**
	 * @var string 更新失败，缓存操作失败
	 */
	const ERROR_CACHE_UPDATE           = 'Update Failed, Cache Error!';

	/**
	 * @var string 删除失败，缓存操作失败
	 */
	const ERROR_CACHE_DELETE           = 'Delete Failed, Cache Error!';

	/**
	 * @var string 保存失败，缓存操作失败
	 */
	const ERROR_CACHE_REPLACE          = 'Replace Failed, Cache Error!';

	/**
	 * @var string 查询缓存成功，但是查询结果为空
	 */
	const ERROR_CACHE_SELECT_EMPTY     = 'Select Cache Successfully, But Result Empty!';

	/**
	 * @var string 登录成功
	 */
	const SUCCESS_LOGIN           	          = 'Login OK';

	/**
	 * @var string 管理员没有访问本Action的权限
	 */
	const ERROR_NO_AUTH     	   		      = 'No Auth!';

	/**
	 * @var string 登录失败，用户名不存在
	 */
	const ERROR_LOGIN_FAILED_NAME_NOT_EXISTS  = 'Login Failed, Name Not Exists!';

	/**
	 * @var string 登录失败，密码错误
	 */
	const ERROR_LOGIN_FAILED_PWD_ERR          = 'Login Failed, Password Error!';

	/**
	 * @var string 登录失败，验证码错误
	 */
	const ERROR_LOGIN_FAILED_VERIFY_ERR       = 'Login Failed, Verify Error!';

	/**
	 * @var string 登录失败，用户名为空
	 */
	const ERROR_LOGIN_FAILED_NAME_EMPTY       = 'Login Failed, Name Empty!';

	/**
	 * @var string 登录失败，密码为空
	 */
	const ERROR_LOGIN_FAILED_PWD_EMPTY        = 'Login Failed, Password Empty!';

	/**
	 * @var string 登录失败，验证码为空
	 */
	const ERROR_LOGIN_FAILED_VERIFY_EMPTY     = 'Login Failed, Verify Empty!';

}