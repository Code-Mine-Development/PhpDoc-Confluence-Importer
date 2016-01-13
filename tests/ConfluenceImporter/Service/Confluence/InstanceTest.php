<?php
/**
 * Creator: adamgrabek
 * Date: 13.01.2016
 * Time: 15:08
 */

namespace CodeMine\ConfluenceImporter\Service\Confluence;

/**
 * Class InstanceTest
 *
 * @package CodeMine\ConfluenceImporter\Service\Confluence
 * @covers CodeMine\ConfluenceImporter\Service\Confluence\Instance
 */
class InstanceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     * @covers ::username
     * @covers ::password
     * @covers ::url
     * @covers ::useContext
     */
    public function testConstructorSetsAllTheFieldsAccessibleBySetters()
    {
        $instance = new Instance('http://confluence.com:8090','admin','admin',false);

        $this->assertSame('http://confluence.com:8090', $instance->url());
        $this->assertSame('admin', $instance->username());
        $this->assertSame('admin', $instance->password());
        $this->assertSame(false, $instance->useContext());
    }

}
