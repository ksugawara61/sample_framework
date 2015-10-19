<?php

abstract class DbRepository
{
	protected $con;

	// コンストラクタ
	public function __construct($con)
	{
		$this->setConnection($con);
	}

	public function setConnection($con)
	{
		$this->con = $con;
	}

	// プリペアドステートメントを実行するメソッド
	public function execute($sql, $params = array())
	{
		$stmt = $this->con->prepare($sql);
		$stmt->execute($params);

		return $stmt;
	}

	// SQLの実行結果のレコードを取得するメソッド
	public function fetch($sql, $params = array())
	{
		return $this->execute($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
	}
}
