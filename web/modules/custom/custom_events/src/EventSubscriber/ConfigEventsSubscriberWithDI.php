<?php 
namespace Drupal\custom_events\EventSubscriber;
use symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;


class ConfigEventsSubscriberWithDI implements EventSubscriberInterface {

public $messenger;



public function __construct(MessengerInterface $messenger){

    $this->messenger = $messenger;
}


public static function getSubscribedEvents (){
     
    return [
        ConfigEvents::SAVE => 'ConfigSave',
        ConfigEvents::DELETE => 'ConfigDelete',
    ];



}

public function ConfigSave(ConfigCrudEvent $event){

    $config = $event->getconfig();
    $this->messenger->addStatus('Save Config'.$config->getName());

}



public function ConfigDelete(ConfigCrudEvent $event){
   
    $config = $event->getconfig();
    $this->messenger->addStatus('delete Config'.$config->getName());
}




}