<?php
/**
 * Creator: adamgrabek
 * Date: 13.01.2016
 * Time: 14:55
 */

namespace CodeMine\ConfluenceImporter\Service;
use GuzzleHttp\ClientInterface;

/**
 * Class ConfluenceTest
 *
 * @package CodeMine\ConfluenceImporter\Service
 * @coversDefaultClass \CodeMine\ConfluenceImporter\Service\Confluence
 */
class ConfluenceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct()
     */
    public function testClassNeedsToBeConstructedWithGuzzleClientInterface()
    {
        $confluence = new Confluence($this->getMockForAbstractClass(ClientInterface::class));

        $this->assertInstanceOf(Confluence::class, $confluence);
    }
}
