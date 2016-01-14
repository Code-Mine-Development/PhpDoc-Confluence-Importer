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

        $pageMock = $this->getMockBuilder(PageInterface::class)->setMethods(['title', 'content', 'children'])->getMock();
        $pageMock->method('title')->willReturn('Test from php'. random_int(0,9999999));
//        $pageMock->method('title')->willReturn('new page');
        $pageMock->method('content')->willReturn('
<ac:layout><ac:layout-section ac:type="single"><ac:layout-cell><ac:structured-macro ac:macro-id="3e74101c-857f-4c47-8618-a27c627eea2c" ac:name="info" ac:schema-version="1"><ac:parameter ac:name="title">Fully qualified class name</ac:parameter><ac:rich-text-body>\Zend\Authentication\Adapter\Digest</ac:rich-text-body></ac:structured-macro>
<p><a href="https://github.com/zendframework/zend-authentication/blob/master/src/Adapter/Digest.php">Browse source code</a></p></ac:layout-cell></ac:layout-section><ac:layout-section ac:type="two_left_sidebar"><ac:layout-cell>
<h2>Class contents</h2>
<p><ac:structured-macro ac:macro-id="726aa6fa-6e48-4005-95ad-0fb28aae8162" ac:name="toc" ac:schema-version="1"><ac:parameter ac:name="maxLevel">4</ac:parameter><ac:parameter ac:name="minLevel">3</ac:parameter></ac:structured-macro></p>
<p>&nbsp;</p></ac:layout-cell><ac:layout-cell>
<h2>Description</h2>
<p><ac:structured-macro ac:macro-id="c7feab99-a70b-4ab8-bbac-846ed981bed0" ac:name="excerpt" ac:schema-version="1"><ac:parameter ac:name="atlassian-macro-output-type">INLINE</ac:parameter><ac:rich-text-body>
<p>Digest adapter for Zend Authentication mechanism</p></ac:rich-text-body></ac:structured-macro>&nbsp;</p>
<h2>Class details</h2>
<table style="letter-spacing: 0.1px;">
<tbody>
<tr>&& count($stdBody) == 0
<th>Package</th>
<td>\Zend\Authentication\Adapter</td></tr>
<tr>
<th>Inherited from</th>
<td><span style="color: rgb(68,68,68);">\Zend\Authentication\Adapter\AbstractAdapter</span></td></tr></tbody></table>
<h3>Methods</h3>
<hr /><ac:structured-macro ac:macro-id="43484e81-d0fd-4d40-b990-a7d90cd2b565" ac:name="panel" ac:schema-version="1"><ac:parameter ac:name="borderStyle">solid</ac:parameter><ac:rich-text-body>
<h4>&nbsp;<span style="color: rgb(51,51,51);">::__construct()</span></h4>
<hr />
<p><span style="color: rgb(51,51,51);">&nbsp;</span></p>
<p>Sets adapter options</p><ac:structured-macro ac:macro-id="9de243a9-ca88-45e1-a6d4-7ff9b542babd" ac:name="code" ac:schema-version="1"><ac:parameter ac:name="language">php</ac:parameter><ac:parameter ac:name="theme">Confluence</ac:parameter><ac:plain-text-body><![CDATA[__construct(mixed $filename = null, mixed $realm = null, mixed $identity = null, mixed $credential = null)]]></ac:plain-text-body></ac:structured-macro>
<h5>Parameters</h5><ac:structured-macro ac:macro-id="a2230db4-ea43-4e99-89d9-2661a57fd5c3" ac:name="expand" ac:schema-version="1"><ac:rich-text-body>
<table>
<tbody>
<tr>
<th>Parameter</th>
<th>Data type</th>
<th>Description</th></tr>
<tr>
<td>$filename</td>
<td>mixed</td>
<td>&nbsp;</td></tr>
<tr>
<td>$realm</td>
<td>mixed</td>
<td>&nbsp;</td></tr></tbody></table></ac:rich-text-body></ac:structured-macro></ac:rich-text-body></ac:structured-macro></ac:layout-cell></ac:layout-section></ac:layout>
');

        $confluence->createNewPage('test', $pageMock);
//        $confluence->getPageId('test', $pageMock);
    }
}
