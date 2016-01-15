<?php
/**
 * Creator: adamgrabek
 * Date: 13.01.2016
 * Time: 14:55
 */

namespace CodeMine\ConfluenceImporter\Service;
use CodeMine\ConfluenceImporter\Documentation\PageInterface;
use CodeMine\ConfluenceImporter\Service\Confluence\Instance;
use CodeMine\ConfluenceImporter\Service\Confluence\InstanceInterface;
use GuzzleHttp\Client;
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
    public function testClassNeedsToBeConstructedWithGuzzleClientInterfaceAndInstanceObject()
    {
        $confluence = new Confluence(
            $this->getMockForAbstractClass(ClientInterface::class),
            $this->getMockForAbstractClass(InstanceInterface::class)
        );

        $this->assertInstanceOf(Confluence::class, $confluence);
    }

    public function testTest()
    {
        $client = new Client(
            [
                'base_uri' => 'http://kb.code-mine.com/'
            ]
        );
        $instance = new Instance('http://kb.code-mine.com/', 'padamiec', 'Jiralog@1', FALSE);

        $confluence = new Confluence($client, $instance);


        $pages = $this->getPageMocks();


        $confluence->createNewPage('test', $pages);
//        $confluence->getPageId('test', $pageMock);
    }

    private function getPageMocks()
    {

        $pageMock2 = $this->getMockBuilder(PageInterface::class)->setMethods(['title', 'content', 'children'])->getMock();
        $pageMock2->method('title')->willReturn('Test from php '. time() . ' ' . random_int(0,9999999));
        $pageMock2->method('content')->willReturn('=== Test content from mock 2 ===');

        $pageMock3 = $this->getMockBuilder(PageInterface::class)->setMethods(['title', 'content', 'children'])->getMock();
        $pageMock3->method('title')->willReturn('Test from php '. time() . ' ' . random_int(0,9999999));
        $pageMock3->method('content')->willReturn('=== Test content from mock 3 ===');

        $mainPageMock = $this->getMockBuilder(PageInterface::class)->setMethods(['title', 'content', 'children'])->getMock();
        $mainPageMock->method('title')->willReturn('Test from php '. time() . ' ' . random_int(0,9999999));
        $mainPageMock->method('content')->willReturn('=== Test content from main mock ===');
        $mainPageMock->method('children')->willReturn([$pageMock2, $pageMock3]);



        return $mainPageMock;
    }
}
