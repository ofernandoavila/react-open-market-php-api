<?php

class Uploader {
    public function __construct() {
        $this->uploadPath = 'images/';
    }

    private function hashFile($fileName) {
        $ext = explode(".", strtolower($fileName));
        $uploadfile = hash('haval256,5', $ext[0] . date("h:i:sa")) . '.' . $ext[1];

        return $uploadfile;
    }

    public function uploadFile($file) {        
        if(move_uploaded_file($file['tmp_name'], $this->uploadPath . $this->hashFile($file['name']))) {
            return $this->hashFile($file['name']);
        } else {
            return false;
        }
    }

    public function changeFile($old, $new) {
        if($this->deleteFile($old)) {
            return $this->uploadFile($new);
        } else {
            return 'error deleting file';
        }
    }

    private function deleteFile($file) {
        $ext = explode('/', $file);
        $index = sizeof($ext);
        if(unlink($this->uploadPath . $ext[$index - 1])) {
            return true;
        } else {
            return false;
        }
    }
}