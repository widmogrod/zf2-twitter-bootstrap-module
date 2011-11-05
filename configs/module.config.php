<?php
return array(
    'di' => array(
        'instance' => array(
            'alias' => array(
                'twittertest' => 'TwitterBootstrap\Controller\TestController',
            ),
            'Zend\View\PhpRenderer' => array(
                'parameters' => array(
                    'options'  => array(
                        'script_paths' => array(
                            'twittertest' => __DIR__ . '/../views',
                        ),
                    ),
                ),
            ),
            'assetic-configuration' => array(
                'parameters' => array(
                    'config' => array(
                        'modules' => array(
                            'twitterbootstrap' => array(
                                'root_path' => __DIR__ . '/../assets',
                                'collections' => array(
                                    'twitter_bootstrap' => array(
                                        'assets' => array(
                                            'bootstrap.css'
                                        )
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
