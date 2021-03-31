<?php

namespace App\Listener;

use App\Entity\Rent;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageCacheSubscriberRent implements EventSubscriber
{
    /**
    * @var CacheManager
    */
    private $cacheManager;

    /**
    * @var UploaderHelper
    */
    private $uploaderHelper;

    public function __construct(CacheManager $cacheManager, UploaderHelper $uploaderHelper)
    {
        $this->cacheManager = $cacheManager;
        $this->uploaderHelper = $uploaderHelper;
    }
    
    public function getSubscribedEvents()
    {
        return [
            'preRemove',
            'preUpdate'
        ];
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if(!$entity instanceof Rent)
        {
            return;
        }
        $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'pictureFile'));
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        if(!$entity instanceof Rent)
        {
            return;
        }

        if($entity->getPictureFiles() instanceof UploadedFile)
        {
            $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'pictureFile'));
        }
    }

}

?>