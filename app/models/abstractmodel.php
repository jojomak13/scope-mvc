<?php

namespace SCOPE\Models;

use SCOPE\Core\DataBase\DataBaseHandler;

class AbstractModel
{
   const DATA_TYPE_INT = \PDO::PARAM_INT;
   const DATA_TYPE_STR = \PDO::PARAM_STR;
   const DATA_TYPE_BOOL = \PDO::PARAM_BOOL;
   const DATA_TYPE_DECIMAL = 4;
   
   private function makeStatment()
   {
       $stmt = '';
       foreach(static::$tableSchema as $colName => $dataType)
       {
        $stmt .= "{$colName} = :{$colName}, ";   
       }

       return rtrim($stmt, ', ');
   }

   private function prepareValues(\PDOStatement $stmt)
   {
      foreach(static::$tableSchema as $colName => $dataType)
      {
        if($dataType == 4){
           $filteredValue = filter_var($this->$colName, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); 
           $stmt->bindValue(":{$colName}", $filteredValue);
        } else {
            $stmt->bindValue(":{$colName}", $this->$colName, $dataType);
        }
      } 
   }
 
   private function create()
   {
      $query = 'INSERT INTO ' . static::$tableName . ' SET ' . $this->makeStatment();
      $stmt = DataBaseHandler::factory()->prepare($query);
      $this->prepareValues($stmt);

      if($stmt->execute()){
        $this->{static::$primaryKey} = DatabaseHandler::factory()->lastInsertId();
        return true;
      } 
      return false;
   }

   private function update()
   {
       $query = 'UPDATE ' . static::$tableName . ' SET ' . $this->makeStatment() . ' WHERE ' . static::$primaryKey . ' = ' . $this->{static::$primaryKey};
       $stmt = DataBaseHandler::factory()->prepare($query);
       $this->prepareValues($stmt);
       
       if($stmt->execute())
       {
           return true;
       }
       return false;
   }

   public function save($PKCheck = true)
   {
       if($PKCheck === false){
           return $this->create();
       }
       return ($this->{static::$primaryKey} === null) ? $this->create() : $this->update();
   }

   public static function getAll()
   {
       $query = 'SELECT * FROM ' . static::$tableName;
       $stmt = DataBaseHandler::factory()->prepare($query);
       $stmt->execute();
       $result = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());

       if(is_array($result) && !empty($result)){
           //return new \ArrayIterator($result);
          return new \arrayIterator($result);
       }
       return false;
   }

   public function delete()
   {
       $query = 'DELETE FROM ' . static::$tableName . ' WHERE ' . static::$primaryKey . ' = ' . $this->{static::$primaryKey};
       $stmt = DataBaseHandler::factory()->prepare($query);
       return $stmt->execute();
   }

   public function getByPk($PK)
   {
        $query = 'SELECT * FROM ' . static::$tableName . ' WHERE ' . static::$primaryKey . ' = ' . $PK;
        $stmt = DataBaseHandler::factory()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());

        if(is_array($result) && !empty($result)){
            return array_shift($result);
        }
        return false;
   }


   /**
    * @param : [mixed] array 
    *   $options = [
    *    'UserName' => ['jojo', \self::DATA_TYPE_STR],
    *    'Pass' => ['4545', \self::DATA_TYPE_INT]
    *   ]
    */
   public static function get($query, $options = [])
   {
        $stmt = DataBaseHandler::factory()->prepare($query);
        
        foreach($options as $colName => $data){
            if($data[1] == 4){
                $filteredValue = filter_var($data[0], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); 
                $stmt->bindValue(":{$colName}", $filteredValue);
            } else {
                $stmt->bindValue(":{$colName}", $data[0], $data[1]);
            }
        }

        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());

        if(is_array($result) && !empty($result)){
            return new \arrayIterator($result);
        }
        return false;
   }

   public static function getOne($sql, $options = array())
   {
       $result = static::get($sql, $options);
       return $result === false ? false : $result->current();
   }


   /**
    * @param : [mixed] array 
    *   $data = [
    *    'UserName' => ['jojo', \self::DATA_TYPE_STR],
    *    'Pass' => ['4545', \self::DATA_TYPE_INT]
    *   ]
    */
   public static function getBy($data)
   {
       $query = 'SELECT * FROM ' . static::$tableName . ' WHERE '; 
       foreach($data as $colName => $value){
            $query .= "{$colName} = :{$colName} AND "; 
       }
       $query = rtrim($query, 'AND ');

       return static::get($query, $data);
   }

}