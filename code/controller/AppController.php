<?php

/**
 * Class AppController
 */
class AppController extends Controller
{

    /**
     * @var array
     */
    private $url_handlers = [
        '' => 'index',
    ];

    /**
     * @param SS_HTTPRequest $request
     * @return mixed
     */
    public function index(SS_HTTPRequest $request)
    {
        return WebsiteController::create()->handleRequest($request, $this->model);
    }

}