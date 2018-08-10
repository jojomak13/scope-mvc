<?php

namespace SCOPE\Core;

class AutoLoad
{
	public static function autoload($className)
	{
		$className = strtolower($className);
		$className = str_replace('scope', '', $className);
		// Check the type of Server
		if(SERVER_TYPE == 2){
			$className = str_replace('\\', '/', $className);
		}
		$className .= '.php';

		if(file_exists(APP_PATH . $className)){
			require_once APP_PATH . $className;
		}
	}
}

spl_autoload_register(__NAMESPACE__ . '\AutoLoad::autoload');
