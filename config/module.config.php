<?php
return array(
    'di' => array(
        'instance' => array(
            'Zend\View\HelperLoader' => array(
                'parameters' => array(
                    'map' => array(
                        'notify'      => 'SpiffyNotify\View\Helper\Notify',
                        'flashNotify' => 'SpiffyNotify\View\Helper\FlashNotify',
                    ),
                ),
            ),
        )
    )
);