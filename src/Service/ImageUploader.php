<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploader
{
    private $getTargetDirectoryProfil;

    private $getTargetDirectoryAdvert;

    public function __construct($getTargetDirectoryProfil, $getTargetDirectoryAdvert)
    {
        $this->getTargetDirectoryProfil = $getTargetDirectoryProfil;
        $this->getTargetDirectoryAdvert = $getTargetDirectoryAdvert;
    }

    public function uploadProfil(UploadedFile $file = null)
    {
        if ($file != null) {

            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move($this->getTargetDirectoryProfil(), $fileName);

            return $fileName;
        }
    }

    public function getTargetDirectoryProfil()
    {
        return $this->getTargetDirectoryProfil;
    }

    public function uploadAdvert(UploadedFile $file = null)
    {
        if ($file != null) {

            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            
            $file->move($this->getTargetDirectoryAdvert(), $fileName);
            
            return $fileName;

        } 
    }

    public function getTargetDirectoryAdvert()
    {
        return $this->getTargetDirectoryAdvert;
    }
    
}