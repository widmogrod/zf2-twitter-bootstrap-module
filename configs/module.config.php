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

                        'controllers' => array(
                            'twittertest' => array(
                                '@twitter_bootstrap_css'
                            )
                        ),

                        'modules' => array(
                            'twitterbootstrap' => array(
                                'root_path' => __DIR__ . '/../assets',
                                'collections' => array(
                                    'twitter_bootstrap_css' => array(
                                        'assets' => array(
                                            'bootstrap.min.css'
                                        )
                                    ),

                                    'twitter_bootstrap_jquery' => array(
                                        'assets' => array(
                                            'http://code.jquery.com/jquery-1.5.2.min.js',
                                        )
                                    ),
                                    'twitter_bootstrap_modal_js' => array(
                                        'assets' => array(
                                            'js/bootstrap-modal.js'
                                        )
                                    ),
                                    'twitter_bootstrap_alerts_js' => array(
                                        'assets' => array(
                                            'js/bootstrap-alerts.js'
                                        )
                                    ),
                                    'twitter_bootstrap_dropdown_js' => array(
                                        'assets' => array(
                                            'js/bootstrap-dropdown.js'
                                        )
                                    ),
                                    'twitter_bootstrap_popover_js' => array(
                                        'assets' => array(
                                            'js/bootstrap-popover.js'
                                        )
                                    ),
                                    'twitter_bootstrap_scrollspy_js' => array(
                                        'assets' => array(
                                            'js/bootstrap-scrollspy.js'
                                        )
                                    ),
                                    'twitter_bootstrap_tabs_js' => array(
                                        'assets' => array(
                                            'js/bootstrap-tabs.js'
                                        )
                                    ),
                                    'twitter_bootstrap_twipsy_js' => array(
                                        'assets' => array(
                                            'js/bootstrap-twipsy.js'
                                        )
                                    ),
                                    'twitter_bootstrap_js' => array(
                                        'assets' => array(
                                            '@twitter_bootstrap_modal_js',
                                            '@twitter_bootstrap_alerts_js',
                                            '@twitter_bootstrap_dropdown_js',
                                            '@twitter_bootstrap_popover_js',
                                            '@twitter_bootstrap_scrollspy_js',
                                            '@twitter_bootstrap_tabs_js',
                                            '@twitter_bootstrap_twipsy_js'
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
