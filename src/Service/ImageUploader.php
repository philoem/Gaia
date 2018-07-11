<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploader
{
    private $targetDirectoryProfil;

    private $targetDirectoryAdvert;

    public function __construct($targetDirectoryProfil, $targetDirectoryAdvert)
    {
        $this->targetDirectoryProfil = $targetDirectoryProfil;
        $this->targetDirectoryAdvert = $targetDirectoryAdvert;
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
        return $this->targetDirectoryProfil;
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
        return $this->targetDirectoryAdvert;
    }
    
}