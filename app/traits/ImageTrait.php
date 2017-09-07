<?php namespace App\traits;



trait ImageTrait
{
    private $maxHeight = 240;
    private $maxWidth = 320;
    protected function getUploadedImage(){
    if(isset($_FILES['Task']) && $_FILES['Task']['error']['image'] == 0) {
       
        $images = $this->diverse_array($_FILES['Task']);
        $uploaddir = realpath(dirname(__FILE__).'/../../public/images/');
        $pathInfo = pathinfo($images['image']['name']);
        $ext = mb_strtolower($pathInfo['extension']);
        $filename = $pathInfo['filename'];
        $img = md5($filename).'.'.$ext;
        $uploadfile = $uploaddir .'/'.  $img;
       if(move_uploaded_file($images['image']['tmp_name'], $uploadfile)){
           try {
               // Create a new SimpleImage object
               $image = new \claviska\SimpleImage();

               // Magic! ✨
               $image->fromFile($uploadfile);
               $imgHeight = $image->getHeight();
               $imgWidth = $image->getWidth();
               $ratio = $image->getAspectRatio();

               if($imgHeight > $this->maxHeight || $imgWidth > $this->maxWidth){
                   if($imgHeight > $imgWidth){
                       $image->resize($this->maxHeight*$ratio,$this->maxHeight);
                   } else{
                       $image->resize($this->maxWidth,$this->maxWidth / $ratio);
                   }
               }
               $image->toFile($uploadfile);


           } catch(Exception $err) {

               echo $err->getMessage();
           }

           return $img;
       };

    }
    }/**/

    /*
     * rearrange the array of images
     * for simplicity
     */
    protected function diverse_array($vector) {
        $result = array();
        foreach($vector as $key1 => $value1)
            foreach($value1 as $key2 => $value2)
                $result[$key2][$key1] = $value2;
        return $result;
    }


}/* end of Trait */