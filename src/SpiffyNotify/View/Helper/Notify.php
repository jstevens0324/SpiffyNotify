<?php

namespace SpiffyNotify\View\Helper;
use Zend\Json\Encoder,
	Zend\View\Helper\AbstractHelper;

class Notify extends AbstractHelper
{
    protected static $loaded = false;
    
    protected $allowedTypes = array(
        'error',
        'notice',
        'success',
        'warning'
    );
    
	protected $defaultAttrs = array(
		'inEffectDuration' => 600,
		'stayTime'         => 3000,
		'text'             => '',
		'sticky'           => false,
		'type'             => 'notice',
		'position'         => 'top-right',
		'closeText'        => '',
		'close'            => null,
	);
	
	public function __invoke($msg, array $attrs = array())
	{
	    $this->load();
        
		$attrs = array_merge($this->defaultAttrs, $attrs);
        
        // determine type from message syntax
        if (preg_match('/^:(?P<type>\w+\s*):/', $msg, $matches)) {
            $attrs['type'] = $matches['type'];
            $msg = str_replace(":{$matches['type']}:", '', $msg);
        }
        
        $attrs['text'] = $msg;
		
		if (!in_array($attrs['type'], $this->allowedTypes)) {
			return 'invalid type: ' . $attrs['type'];	
		}
        
		$js = '$(document).ready(function(){$().toastmessage("showToast", ' . Encoder::encode($attrs) . ');})';
		$this->view->inlineScript()->appendScript($js);
	}
    
    protected function load()
    {
        if (self::$loaded) {
            return;
        }
        $this->view->headLink()->appendStylesheet('/css/SpiffyNotify/jquery.toastmessage.min.css');
        $this->view->inlineScript()->appendFile('/js/SpiffyNotify/jquery.toastmessage.min.js');
        
        self::$loaded = true;
    }
}