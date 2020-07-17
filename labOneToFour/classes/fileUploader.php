<?php 
  include_once "DBConnector.php";
  define ('SITE_ROOT', realpath(dirname(__FILE__)));
  
  class FileUploader{
   //Member Variables

   private static $target_directory = 'C:\xampp\htdocs\Labs\labOneToFour\uploads\\';
   private static $size_limit = 50000; //Size in bytes (50kb)
   private $uploadOk = false;
   private $file_original_name;
   private $file_type;
   private $file_size;
   private $final_file_name;
   private $file_path;
   private $username;

   /* Getter and Setter Methods */
   public function setOriginalName($name){
    $this->file_original_name = $name;
   }

   public function getOriginalName(){
    return $this->file_original_name;
   }

   public function setFileType($type){
     $this->file_type = $type;
   }

   public function getFileType(){
     return $this->file_type;
   }

   public function setFileSize($size){
    $this->file_size = $size;
   }

   public function getFileSize(){
    return $this->file_size;
   }

   public function setFinalFileName($final_name){
    $this->final_file_name = $final_name;
   }

   public function getFinalName(){
    return $this->final_file_name;
   }



   /* Class Methods */

   public function uploadFile()
   {
     //
     if($this->fileTypeIsCorrect()){

       if($this->fileSizeIsCorrect()){

        if(!$this->fileAlreadyExists()){

          if($this->moveFile()){
            return true;
          }
          
        }

       }

     }

     return false;
   }

   public function fileAlreadyExists()
   {

      $target_file = self::$target_directory . $this->final_file_name;
      if(file_exists($target_file)){

        return true;

      } else {

        return false;

      }

   }


   public function saveFilePathTo()
   {
      return self::$target_directory;
   }


   public function moveFile(){
    //

    //$this->file_path = saveFilePathTo() .$this->file_original_name;
    $target_file = self::$target_directory . $this->final_file_name;

    if ( move_uploaded_file($this->file_original_name, $target_file) ){

      return true;

    } else {

      return false;

    }

   }

   public function fileTypeIsCorrect()
   {
      //Check if the file type is correct
      $extensions = array("image/jpeg", "image/jpg", "image/png", "image/gif");

      if ( in_array($this->file_type, $extensions) ){

        return true;

      } else {

        return false;

      }

   }


   public function fileSizeIsCorrect()
   {
      //check if the file size is acceptable
      if ( $this->file_size < self::$size_limit ){

        return true;

      } else {

        return false;

      }

   }

   public function fileWasSelected()
   {
      //check if a file was selected
      if ( $this->file_original_name ){

        return true;

      } else {

        return false;

      }

   }
   
  }




?>