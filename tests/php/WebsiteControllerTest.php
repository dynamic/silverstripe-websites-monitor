<?php

/**
 * Class WebsiteController
 */
class WebsiteControllerTest extends FunctionalTest
{

    /**
     * @var string
     */
    protected static $fixture_file = 'websites-monitor/tests/php/Website.yml';

    /**
     *
     */
    public function testSetWebsites()
    {
        //$this->objFromFixture('Website', 'dynamic');
        //$this->objFromFixture('Website', 'blarg');

        //$controller = WebsiteController::create();
        //$controller->setWebsites(Website::get());
        //$websites = $controller->getWebsites();

        //$this->assertEquals($websites->count(), 1);
        $this->skipTest = true;
    }

    public function testGetWebsites()
    {
        $this->skipTest = true;
    }

}