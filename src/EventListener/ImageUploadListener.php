<?php
namespace App\EventListener;


use App\Entity\Advert;
use App\Service\ImageUploader;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploadListener
{
    private $uploader;

    public function __construct(ImageUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
        
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
        
    }

    private function uploadFile($entity)
    {
        // upload only works for Advert entities
        if (!$entity instanceof Advert) {
            return;
        }

        $file = $entity->getPicturesAdverts();

        // only upload new files
        if ($file instanceof UploadedFile) {
            $fileName = $this->uploader->uploadAdvert($file);
            $entity->setPicturesAdverts($fileName);
        }
        
    }
    
}
