<?php

class Response
{
	protected $content;
	protected $status_code = 200;
	protected $status_text = 'OK';
	protected $http_headers = array();

	// レスポンスの送信を行うメソッド
	public function send()
	{
		header('HTTP/1.1 ' . $this->status_code . ' ' . $this->status_text);

		foreach ($this->http_headers as $name => $value) {
			header($name . ': ' . $value);
		}

		echo $this->content;
	}

	// クライアントに返す内容を格納するメソッド
	public function setContent($content)
	{
		$this->content = $content;
	}

	// HTTPのステータスコードを格納するメソッド
	public function setStatusCode($status_code, $status_text = '')
	{
		$this->status_code = $status_code;
		$this->status_text = $status_text;
	}

	// HTTPヘッダを格納するメソッド
	public function setHttpHeader($name, $value)
	{
		$this->http_headers[$name] = $value;
	}
}
