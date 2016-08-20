<?php

/**
 * Class Website
 *
 * @property string $Title
 * @property string $URL
 * @property bool $Active
 * @property HTMLText $Description
 * @method SS_List $NotificationRecords
 */
class Website extends DataObject
{

    /**
     * @var string
     */
    private static $singular_name = 'Website';
    /**
     * @var string
     */
    private static $plural_name = 'Websites';
    /**
     * @var string
     */
    private static $description = 'A website to monitor';

    /**
     * @var array
     */
    private static $db = [
        'Title' => 'Varchar(255)',
        'URL' => 'Varchar(255)',
        'Active' => 'Boolean',
        'Description' => 'HTMLText',
    ];

    /**
     * @var array
     */
    private static $has_many = [
        'NotificationRecords' => 'NotificationRecord',
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab(
            'Root.Main',
            TextField::create('Title')
                ->setTitle('Title')
        );

        $fields->addFieldToTab(
            'Root.Main',
            TextField::create('URL')
                ->setTitle('URL')
        );

        return $fields;
    }

    /**
     * Check for status of website, if no $response send a notification with the HTTP code.
     *
     * @return bool
     */
    protected function currentStatus()
    {
        $curlInit = curl_init($this->URL);
        curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curlInit, CURLOPT_HEADER, true);
        curl_setopt($curlInit, CURLOPT_NOBODY, true);
        curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curlInit);

        if (!$response) {
            $httpCode = curl_getinfo($curlInit, CURLINFO_HTTP_CODE);
            $didRecord = $this->recordError($httpCode);
            return false;
        }

        curl_close($curlInit);
        return true;
    }

    /**
     * Check the status of this site.
     *
     * @return bool
     */
    public function getIsLive()
    {
        return $this->currentStatus();
    }

    /**
     * Create a {@link NotificationRecord} relating to this website with the HTTP code.
     *
     * @param null $code
     * @return bool
     */
    private function recordError($code = null)
    {
        if ($code === null) {
            $code = 'Unresolved Error Code';
        }

        $notification = NotificationRecord::create();
        $notification->Code = $code;
        if ($notification->write()) {
            $this->NotificationRecords()->add($notification);
            if ($this->NotificationRecords()->filter('ID', $notification->ID)->first()) {
                return true;
            }
        }
        return false;
    }

}