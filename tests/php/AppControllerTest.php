<?php

/**
 * Class AppControllerTest
 */
class AppControllerTest extends FunctionalTest
{

    /**
     *
     */
    public function testIndex()
    {
        $response = $this->get('/AppController');
        $this->assertEquals(200, $response->getStatusCode());
    }

}