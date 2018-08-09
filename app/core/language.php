<?php

namespace SCOPE\Core;

class Language 
{
	public $dictionary = [];
	
	
    public function load($path)
	{
		$defaultLanguage = DEFAULT_LANGUAGE;
        $defaultPath = $_SESSION['defaultPath'];

		if(isset($_SESSION['lang'])){
			$defaultLanguage = $_SESSION['lang'];
		}

		$pathArray = explode('.', $path);
		$languageFileLoad = LANGUAGE_PATH . DS . $defaultPath . DS .  $defaultLanguage . DS . $pathArray[0] . DS . $pathArray[1] . '.lang.php';
		
		if(file_exists($languageFileLoad))
		{
			require $languageFileLoad;
			if(is_array($_) && !empty($_)){
				foreach($_ as $key => $value){
					$this->dictionary[$key] = $value;
				}
			}
		} else {
			trigger_error("Sorry this file [$pathArray[1].lang.php] does not exists", E_USER_WARNING);
			
		}
	}

    public function getDictionary()
    {
        return $this->dictionary;
	}
	
	public function get($key)
	{
		if(array_key_exists($key, $this->dictionary))
		{
			return $this->dictionary[$key];
		}
	}

	public function feedKey($key, $data = [])
	{
		if(array_key_exists($key, $this->dictionary))
		{
			array_unshift($data, $this->dictionary[$key]);
			
			
			return call_user_func_array('sprintf', $data);
		}
	}
}