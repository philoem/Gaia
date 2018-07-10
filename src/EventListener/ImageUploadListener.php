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
    private $uploaderAdvert;

    public function __construct(ImageUploader $uploaderAdvert)
    {
        $this->uploaderAdvert = $uploaderAdvert;
    }

    public function prePersistAdvert(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFileAdvert($entity);
        
    }

    public function preUpdateAdvert(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFileAdvert($entity);
        
    }

    private function uploadFileAdvert($entity)
    {
        // upload only works for Advert entities
        if (!$entity instanceof Advert) {
            return;
        }

        $file = $entity->getPicturesAdverts();

        // only upload new files
        if (!$file instanceof UploadedFile) {
            return;
        }
        

        $fileName = $this->uploaderAdvert->uploadAdvert($file);
        $entity->setPicturesAdverts($fileName);
    }
    public function postLoadAdvert(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Advert) {
            return;
        }

        if ($fileName = $entity->getPicturesAdverts()) {
            $entity->setPicturesAdverts(new File($this->uploader->getTargetDirectoryAdvert().'/'.$fileName));
        }
    }
    
}
