<?php

class Session
{
	// メンバ変数
	protected static $sessionStarted = false;
	protected static $sessionIdRegenerated = false;

	// コンストラクタ
	public function __construct()
	{
		if (!self::$sessionStarted) {
			session_start();

			self::$sessionStarted = true;
		}
	}

	// $_SESSIONへの設定を行うメソッド
	public function set($name, $value)
	{
		$_SESSION[$name] = $value;
	}

	// $_SESSIONから取得するメソッド
	public function get($name, $default = null)
	{
		if (isset($_SESSION[$name])) {
			return $_SESSION[$name];
		}

		return $default;
	}

	// $_SESSIONから指定した値を削除するメソッド
	public function remove($name)
	{
		unset($_SESSION[$name]);
	}

	// $_SESSIONを空にするメソッド
	public function clear()
	{
		$_SESSION = array();
	}

	// セッションIDを新しく発行するためのメソッド
	public function regenerate($destroy = true)
	{
		if (!self::$sessionIdRegenerated) {
			session_regenerate_id($destroy);

			self::$sessionStarted = true;
		}
	}

	// ログイン状態を制御するメソッド
	public function setAuthenticated($bool)
	{
		$this->set('_authenticated', (bool)$bool);

		$this->regenerate();
	}

	// ログイン状態を制御するメソッド
	public function isAuthenticated()
	{
		return $this->get('_authenticated', false);
	}
}
