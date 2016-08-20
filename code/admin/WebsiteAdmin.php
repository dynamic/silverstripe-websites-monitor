<?php

/**
 * Class WebsiteAdmin
 */
class WebsiteAdmin extends ModelAdmin
{

    /**
     * @var array
     */
    private static $managed_models = [
        'Website' => [
            'title' => 'Websites',
        ],
    ];

    /**
     * @var string
     */
    private static $menu_title = 'Websites';

    /**
     * @var string
     */
    private static $url_segment = 'websites';

    /**
     * @var int
     */
    private static $menu_priority = 1;

}