<?php

class WebsiteController extends Controller
{

    private static $url_handlers = [
        '' => 'index',
        '$WebsiteID!' => 'website',
    ];

    private static $allowed_actions = [
        'website',
    ];

    /**
     * @var SS_List
     */
    private $websites;

    public function init()
    {
        parent::init();

        Requirements::css('websites-monitor/javascript/thirdparty/FlexSlider-2.6.2/flexslider.css');
        Requirements::css('websites-monitor/css/main.css');
        Requirements::javascript('websites-monitor/javascript/dist/site.min.js');
        Requirements::javascript('websites-monitor/javascript/thirdparty/FlexSlider-2.6.2/jquery.flexslider-min.js');

        Requirements::customScript("
                (function($) {
                    $(document).ready(function(){
                        $('.flexslider').flexslider({
                            slideshow: true,
                            animation: 'fade',
                            animationLoop: true,
                            slideshowSpeed: 10000,
                            animationSpeed: 2000,
                            touch: false,
                            controlNav: false,
                            directionNav: false
                        });
                    });
                }(jQuery));");
    }

    /**
     * @return SS_List
     */
    public function getWebsites()
    {
        if (!$this->websites) {
            $this->setWebsites(Website::get());
        }
        return $this->websites;
    }

    public function setWebsites($websites)
    {
        $this->websites = $websites
            ->filter('Active', true)
            ->filterByCallback(function (Website $website) {
                return $website->getIsLive();
            });
        return $this;
    }

    public function index(SS_HTTPRequest $request)
    {
        return $this->renderWith(['Page']);
    }

}