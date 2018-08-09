<?php

namespace SCOPE\Core;

class FileUploader
{

    private $_name;
    private $_type;
    private $_tmpName;
    private $_error;
    private $_size;

    private $_fileExtension;
    private $_allawedExtensions = ['jpg', 'jpeg', 'png', 'jef', 'pdf', 'xls', 'docx', 'doc'];

    public function __construct($uploadedFile)
    {
        $this->_name = $this->makeName($uploadedFile['name']);
        $this->_type = $uploadedFile['type'];
        $this->_tmpName = $uploadedFile['tmp_name'];
        $this->_error = $uploadedFile['error'];
        $this->_size = $uploadedFile['size'];
    }

    private function makeName($name)
    {
        preg_match_all('/([a-z]{1,4})$/i', $name, $m);
        $this->_fileExtension = $m[0][0];
        return substr(strtolower(md5($name)), 0, 25);
    }

    private function isAllowedType()
    {
        return in_array($this->_fileExtension, $this->_allawedExtensions);
    }

    private function isAllowedSize()
    {
        preg_match_all('/([0-9]+)([MG])$/i', MAX_UPLOAD_SIZE, $m);

        $maxSize = $m[1][0];
        $fileSize =  ($m[2][0] == 'M')? ($this->_size / 1024 / 1024) : ($this->_size / 1024 / 1024 / 1024);
        $fileSize = ceil($fileSize);

        return $maxSize > $fileSize;
    }

    public function getFullName()
    {
        return $this->_name . '.' . $this->_fileExtension;
    }

    private function isImage()
    {
        return preg_match('/image/i', $this->_type);
    }

    public function upload()
    {
        if($this->_error != 0){
            throw new \Exception('Some thins went wrong while uploading please try again');

        } elseif(!$this->isAllowedSize()){
            throw new \Exception('The maximum file size is [' . MAX_UPLOAD_SIZE . '] you can\'t exceeds it');

        } elseif(!$this->isAllowedType()){
            throw new \Exception('The files of type [' . $this->_fileExtension . '] not allowed');

        } else {
            $uploadPath = $this->isImage() ? IMAGE_UPLOAD_PATH : DOCS_UPLOAD_PATH;
            if(is_writable($uploadPath)){
                move_uploaded_file($this->_tmpName, $uploadPath . DS . $this->getFullName());
                return true;
            }
            throw new \Exception('Access denied to this directory');
        }
    }
}
