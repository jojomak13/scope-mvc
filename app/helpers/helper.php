<?php

namespace SCOPE\helpers;

trait Helper
{
	public function redirect($path)
	{
		session_write_close();
		header('location: ' . $path);
		exit();
	}

	public function filterString($value)
	{
		return filter_var($value, FILTER_SANITIZE_STRING);
	}

	public function filterInt($value)
	{
		return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
	}

	public function filterFloat($value)
	{
		return filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	}

	public function filterEmail($value)
	{
		return filter_var($value, FILTER_SANITIZE_EMAIL);
	}
}