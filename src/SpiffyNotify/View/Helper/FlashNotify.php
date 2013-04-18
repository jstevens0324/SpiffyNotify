<?php

namespace SpiffyNotify\View\Helper;
use Zend\Json\Encoder,
    Zend\Mvc\Controller\Plugin\FlashMessenger,
	Zend\View\Helper\AbstractHelper;

class FlashNotify extends AbstractHelper
{
	public function __invoke(array $attrs = array())
	{
		$flash = new FlashMessenger;
		$flash->setNamespace('spiffy_notify');
		
		foreach($flash->getMessages() as $message) {
			$this->view->notify($message, $attrs);
		}
		$flash->clearMessages();
	}
}