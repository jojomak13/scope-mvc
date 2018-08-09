<?php

namespace SCOPE\Helpers;

trait TemplateHelper
{
    public function getValue($inputName)
    {
        return isset($_POST[$inputName]) ? $_POST[$inputName] : false;
    }

    public function selected($value, $againstValue)
    {
        return $value == $againstValue ? 'selected' : '';
    }
}