<?php

abstract class Controller
{
	// メンバ変数
	protected $controller_name;
	protected $action_name;
	protected $application;
	protected $request;
	protected $response;
	protected $session;
	protected $db_manager;

	// コンストラクタ
	public function __construct($application)
	{
		$this->controller_name = strtolower(substr(get_class($this), 0, -10));

		$this->application = $application;
		$this->request = $application->getRequest();
		$this->response = $application->getResponse();
		$this->session = $application->getSession();
		$this->db_manager = $application->getDbManager();
	}

	// Applicationクラスから呼び出され、実際にアクションを実行するメソッド
	public function run($action, $params = array())
	{
		$this->action_name = $action;

		// アクションとなるメソッドの名前を格納
		$action_method = $action . 'Action';
		if (!method_exists($this, $action_method)) {
			$this->forward404();
		}

		// アクションの実行
		$content = $this->action_method($params);

		return $content;
	}
}
