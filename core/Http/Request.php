<?php

namespace Core\Http;

class Request
{
	public static function server(string $key): string
	{
		return $_SERVER[$key] ?? '';
	}

	public static function isGet(): string
	{
		return self::server('REQUEST_METHOD') === 'GET';
	}

	public static function isPost(): string
	{
		return self::server('REQUEST_METHOD') === 'POST';
	}

	public static function getBody(): array|null
	{
		$data = [];
		if (self::isGet())
		{
			$data = $_GET;
		}
		if (self::isPost())
		{
			$data = $_POST;
		}
		return $data;
	}
	public static function getSession(string $key = null): mixed
	{
		if ($key)
		{
			return $_SESSION[$key] ?? null;
		}
		return $_SESSION;
	}

	public static function unsetSessionValue(string $key): void
	{
		unset($_SESSION[$key]);
	}
	public static function setSession(string $key, mixed $value):void
	{
		$_SESSION[$key] = $value;
	}
	public static function &getLinkSession(string $key): array
	{
		return $_SESSION[$key];
	}
	public static function getFiles(): array|null
	{
		$files = [];
		foreach ($_FILES as $key => $file)
		{
			$files[$key] = [
				'name' => $file['name'],
				'type' => $file['type'],
				'tmp_name' => $file['tmp_name'],
				'error' => $file['error'],
				'size' => $file['size'],
			];
		}
		return $files;
	}
}
