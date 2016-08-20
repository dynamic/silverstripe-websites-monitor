<?php

/**
 * @mixin PHPUnit_Framework_TestCase
 */
class WebsiteTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = 'websites-monitor/tests/php/Website.yml';

    /**
     *
     */
    public function testGetCMSFields()
    {
        $fields = Website::create()->getCMSFields();
        $this->assertInstanceOf(FieldList, $fields);
    }

    /**
     * test that a site is returning proper value if it is or isn't live
     */
    public function testGetIsLive()
    {
        $site = $this->objFromFixture('Website', 'dynamic');
        $this->assertTrue($site->getIsLive());

        $dummySite = $this->objFromFixture('Website', 'blarg');
        $this->assertFalse($dummySite->getIsLive());
    }

    /**
     * test {@link recordError()} is creating related error records
     */
    public function testRecordError()
    {

        $site = $this->objFromFixture('Website', 'dynamic');
        $this->assertTrue($this->invokeMethod($site, 'recordError'));//record error even when no code is passed
        $this->assertTrue($this->invokeMethod($site, 'recordError', [404]));//record error when code is passed

        $records = $site->NotificationRecords();
        $this->assertEquals($records->count(), 2);

    }

    /**
     * Allow testing of protected/private methods on in the {@link Website} class
     *
     * @param $object
     * @param $method
     * @param array $parameters
     * @return mixed
     */
    public function invokeMethod(&$object, $method, $parameters = [])
    {
        $reflection = new ReflectionClass(get_class($object));
        $method = $reflection->getMethod($method);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

}
