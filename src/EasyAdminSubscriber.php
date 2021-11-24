<?php # src/EventSubscriber/EasyAdminSubscriber.php
namespace App\EasyAdminSubscriber;

use App\Entity\Article;


use Symfony\Component\Security\Core\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $slugger;

    public function __construct($slugger,Security $security)
    {
        $this->slugger = $slugger;
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setBlogPostSlug'],
            
        ];
    }

    public function setBlogPostSlug(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity InstanceOf Article)) {
            return;
        }

        // $slug = $this->slugger->slugify($entity->getUser());
        // $entity->setUser($slug);
        $user=$this->security->getUser();
        $entity->setUser($user);
        
    }
}