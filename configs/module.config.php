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

                        /**
                         * Example, defaining that 'default' route will use twitter bootstrap css
                         * Setup your application or module, to use this section, if required.
                         */
                        /** /
                        'routers' => array(
                            'default' => array(
                                '@twitter_bootstrap_css'
                            )
                        ),
                        /**/

                        'modules' => array(
                            'twitterbootstrap' => array(
                                'root_path' => __DIR__ . '/../assets',
                                'collections' => array(
                                    'twitter_bootstrap_css' => array(
                                        'assets' => array(
                                            'bootstrap.css'
                                        )
                                    ),

                                    # todo
//                                    'twitter_bootstrap_js' => array(
//                                        'assets' => array(
//                                            'http://code.jquery.com/jquery-1.5.2.min.js',
//                                            'js/bootstrap-dropdown.js'
//                                        )
//                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
