<?php

/**
 * Class NotificationRecord
 *
 * @property int $Code
 * @property int $WebsiteID
 * @method Website $Website
 */
class NotificationRecord extends DataObject
{

    /**
     * @var string
     */
    private static $singular_name = 'Notification Record';
    /**
     * @var string
     */
    private static $plural_name = 'Notification Records';
    /**
     * @var string
     */
    private static $description = 'A notification record tracking issues for various websites.';
    /**
     * notification interval in minutes for emailing status data about a website
     *
     * @var int
     */
    private static $notification_interval = 30;

    /**
     * @var array
     */
    private static $db = [
        'Code' => 'Varchar',
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'Website' => 'Website',
    ];

    /**
     *
     */
    protected function sendErrorNotification()
    {
        if (!$this->relatedNotificationRecords()->last() || strtotime('now') - strtotime($this->relatedNotificationRecords()->last()->Created) > Config::inst()->get('NotificationRecord', 'notification_interval')) {

            $email = Email::create();
            $email->setFrom('dev@dy.ag');
            $email->setTo('dev@dy.ag');
            $email->setSubject("Website {$this->Website()->Title} issue report");
            $email->setTemplate('WebsiteErrorEmail');
            $email->populateTemplate([
                'Website' => $this->Website(),
                'ErrorCode' => $this->Code,
            ]);
        }
    }

    /**
     * @return DataList
     */
    private function relatedNotificationRecords()
    {
        return NotificationRecord::get()->filter('WebsiteID', $this->WebsiteID);
    }

    /**
     *
     */
    public function onAfterWrite()
    {
        parent::onAfterWrite();

        $this->sendErrorNotification();
    }

}