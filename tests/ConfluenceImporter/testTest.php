<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 02.02.16
 * Time: 18:43
 */

namespace CodeMine\ConfluenceImporter;


use CodeMine\ConfluenceImporter\Documentation\PageFactory;
use CodeMine\ConfluenceImporter\Documentation\PageTreeFactory;
use CodeMine\ConfluenceImporter\Parser\Parser;
//use CodeMine\ConfluenceImporter\Parser\Structure\Structure;

class testTest extends \PHPUnit_Framework_TestCase
{
    private $testArray = [
        'layer1' => [
            'layer2a' => 'value2A',
            'layer2b' => 'value2B',
            0 => 'value_0',
            'layer2c' => [
                0 => 'value3'
            ],
        ],
        'floor1' => [
            0 => 'value_floor'
        ]
    ];

    public function test()
    {

        $parser = new Parser('/home/yoshi/projekty/PhpDoc-Confluence-Importer/docs/structure.xml');


        $data = $parser->prepareFiles();


        $pageFactory = new PageTreeFactory($data);
        $namespaceTree = $pageFactory->namespaceArray();

        $pageFactory = new PageFactory($data, $namespaceTree);
        $page = $pageFactory->getPage();


    }
}

