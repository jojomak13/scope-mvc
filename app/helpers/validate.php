<?php

namespace SCOPE\Helpers;

use SCOPE\Core\Messenger;

trait Validate
{
  
   private $_regexPatterns = [
       'num'      => '/^[0-9]+(?:\.[0-9]+)?$/',
       'int'      => '/^[0-9]+$/',
       'float'    => '/^[0-9]+\.[0-9]+$/',
       'alpha'    => '/^[a-zA-Z\p{Arabic}]+$/u',
       'alphanum' => '/^[a-zA-Z0-9\p{Arabic}]+$/u',
       'date'     => '/^[1-2][0-9][0-9][0-9]-(?:(?:0[1-9])|(?:1[0-2]))-(?:(?:0[1-9])|(?:(?:1|2)[0-9])|(?:3[0-1]))$/',
       'email'    => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
       'url'      => '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
   ];


   public function num($value) 
   {
       return (bool) preg_match($this->_regexPatterns['num'], $value);
   }

   public function int($value) 
   {
       return (bool) preg_match($this->_regexPatterns['int'], $value);
   }

   public function float($value)
   {
       return (bool) preg_match($this->_regexPatterns['float'], $value);
   }

   public function alpha($value) 
   {
       return (bool) preg_match($this->_regexPatterns['alpha'], $value);
   }

   public function alphanum($value)
   {
       return (bool) preg_match($this->_regexPatterns['alphanum'], $value);
   }

   /** 
    * required method v2.0
    * @param $value mixed
    * @return bool if value empty it return true otherwise false  
   */
   public function req($value)
   {
        return !empty(trim($value, ' '));
   }

   public function date($value) 
   {
       return (bool) preg_match($this->_regexPatterns['date'], $value);
   }

   public function email($value)
   {
       return (bool) preg_match($this->_regexPatterns['email'], $value);
   }

   public function url($value) 
   {
       return (bool) preg_match($this->_regexPatterns['url'], $value); 
   }

   public function eq($value, $matchAgainst)
   {
        return $value == $matchAgainst;
   }

   public function eqfield($value, $matchAgainst)
   {
        return $value == $matchAgainst;
   }

   public function lt($value, $matchAgainst) 
   {
       if(is_string($value)){
            return mb_strlen($value) < $matchAgainst;
       } elseif(is_numeric($value)) {
           return $value < $matchAgainst;
       }
   }

   public function gt($value, $matchAgainst)
   {
       if(is_string($value)){
            return mb_strlen($value) > $matchAgainst;
       } elseif(is_numeric($value)) {
           return $value > $matchAgainst;
       }
   }

   public function min($value, $matchAgainst)
   {
       if(is_string($value)){
            return mb_strlen($value) >= $matchAgainst;
       } elseif(is_numeric($value)) {
           return $value >= $matchAgainst;
       }
   }

   public function max($value, $matchAgainst)
   {
       if(is_string($value)){
            return mb_strlen($value) <= $matchAgainst;
       } elseif(is_numeric($value)) {
           return $value <= $matchAgainst;
       }
   }

   public function between($value, $min, $max)
   {
       if(is_numeric($value)){
            return $value >= $min && $value <= $max;
       } elseif(is_string($value)){
           return mb_strlen($value) >= $min && mb_strlen($value) <= $max;
       }
   }  

   public function floatlike($value, $int, $fraction) 
   {
        if(!$this->float($value)){
            return false;
        }
        $pattern = '/^[0-9]{' . $int . '}\.[0-9]{' . $fraction . '}$/';
        return (bool) preg_match($pattern, $value);
   }

   public function isValid($data, $inputType)
   {
       $errors = [];
       /*============ Start [empty check] ============*/
       if(!empty($data)){ // check if not empty
            
            // Get fieldName and roles
            foreach($data as $fieldName => $roles)
            {

               $value = $inputType[$fieldName]; 

               // Convert roles into array then make loop on it
               $roles = explode('|', $roles);
               
               foreach($roles as $role)
               {   // End looping in this field if there is more than one error
                   if(array_key_exists($fieldName, $errors)){continue;}
                   
                   /*============ Start [Validate] ============*/
                   switch(true)
                   {
                      /*============ Start [min method] ============*/
                      case preg_match_all('/(min)\((\d+)\)/', $role, $m):
                        if($this->min($value, $m[2][0]) === false){
                           $this->messenger->add(
                               $this->language->feedkey('text_error_' . $m[1][0], [$m[2][0]]),
                               Messenger::APP_MESSAGE_ERROR,
                               $this->language->get('text_' . $fieldName)
                           );
                           $errors[$fieldName] = true; 
                        }
                      break; 
                      /*============ End [min method] ============*/

                      /*============ Start [max method] ============*/
                      case preg_match_all('/(max)\((\d+)\)/', $role, $m):
                        if($this->max($value, $m[2][0]) === false){
                           $this->messenger->add(
                               $this->language->feedkey('text_error_' . $m[1][0], [$m[2][0]]),
                               Messenger::APP_MESSAGE_ERROR,
                               $this->language->get('text_' . $fieldName)
                           );
                           $errors[$fieldName] = true; 
                        }
                      break; 
                      /*============ End [max method] ============*/

                      /*============ Start [between method] ============*/
                      case preg_match_all('/(between)\((\d+,\d+)\)/', $role, $m):
                        $values = explode(',', $m[2][0]);
                        if($this->between($value, $values[0], $values[1]) === false){
                            $this->messenger->add(
                                $this->language->feedKey('text_error_' . $m[1][0], [$values[0], $values[1]]),
                                Messenger::APP_MESSAGE_ERROR,
                                $this->language->get('text_' . $fieldName)
                            );
                            $errors[$fieldName] = true;
                        }  
                      break;
                      /*============ End [between method] ============*/

                      /*============ Start [floatlike method] ============*/
                      case preg_match_all('/(floatlike)\((\d+,\d+)\)/', $role, $m):
                        $values = explode(',', $m[2][0]);
                        if($this->floatlike($value, $values[0], $values[1]) === false){
                            $this->messenger->add(
                                $this->language->feedKey('text_error_' . $m[1][0], [$values[0], $values[1]]),
                                Messenger::APP_MESSAGE_ERROR,
                                $this->language->get('text_' . $fieldName)
                            );
                            $errors[$fieldName] = true;
                        }  
                      break;
                      /*============ End [floatlike method] ============*/

                      /*============ Start [lt method] ============*/
                      case preg_match_all('/(lt)\((\d+)\)/', $role, $m):
                        if($this->lt($value, $m[2][0]) === false){
                            $this->messenger->add(
                                $this->language->feedKey('text_error_' . $m[1][0], [$m[2][0]]),
                                Messenger::APP_MESSAGE_ERROR,
                                $this->language->get('text_' . $fieldName)
                            );
                            $errors[$fieldName] = true;
                        }
                      break;
                      /*============ End [lt method] ============*/

                      /*============ Start [gt method] ============*/
                      case preg_match_all('/(gt)\((\d+)\)/', $role, $m):
                        if($this->gt($value, $m[2][0]) === false){
                            $this->messenger->add(
                                $this->language->feedKey('text_error_' . $m[1][0], [$m[2][0]]),
                                Messenger::APP_MESSAGE_ERROR,
                                $this->language->get('text_' . $fieldName)
                            );
                            $errors[$fieldName] = true;
                        }
                      break;
                      /*============ End [gt method] ============*/


                      /*============ Start [eq method] ============*/
                      case preg_match_all('/(eq)\((\d+)\)/', $role, $m):
                        if($this->eq($value, $m[2][0]) === false){
                            $this->messenger->add(
                                $this->language->feedKey('text_error_' . $m[1][0], [$m[2][0]]),
                                Messenger::APP_MESSAGE_ERROR,
                                $this->language->get('text_' . $fieldName)
                            );
                            $errors[$fieldName] = true;
                        }
                      break;
                      /*============ End [eq method] ============*/

                      /*============ Start [eqfield method] ============*/
                      case preg_match_all('/(eqfield)\((\w+)\)/', $role, $m):
                        if($this->eqfield($value, $_POST[$m[2][0]]) === false){
                            $this->messenger->add(
                                $this->language->feedKey('text_error_' . $m[1][0], [$this->language->get('text_' . $m[2][0])]),
                                Messenger::APP_MESSAGE_ERROR,
                                $this->language->get('text_' . $fieldName)
                            );
                            $errors[$fieldName] = true;
                        }
                      break;
                      /*============ End [eqfield method] ============*/

                      default:
                        if($this->$role($value) === false){
                            $this->messenger->add(
                                $this->language->feedKey('text_error_' . $role, []),
                                Messenger::APP_MESSAGE_ERROR,
                                $this->language->get('text_' . $fieldName)
                            );
                            $errors[$fieldName] = true;
                        }
                      break;
                   }
                   /*============ End [Validate] ============*/
               }
            }
       } 
       /*============ End [empty check] ============*/
       
       return empty($errors) ? true : false;
   }


}