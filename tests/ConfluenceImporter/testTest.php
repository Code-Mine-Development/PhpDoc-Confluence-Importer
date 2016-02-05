<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 02.02.16
 * Time: 18:43
 */

namespace CodeMine\ConfluenceImporter;


use CodeMine\ConfluenceImporter\Documentation\PageTreeFactory;
use CodeMine\ConfluenceImporter\Parser\Parser;
//use CodeMine\ConfluenceImporter\Parser\Structure\Structure;

class testTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $parser = new Parser('/home/yoshi/projekty/PhpDoc-Confluence-Importer/docs/structure.xml');


        $data = $parser->prepareFiles();


        $pageFactory = new PageTreeFactory($data);
//        $pageFactory->generateNamespaceTree();
//        $data = [
//            'CodeMine\TestClass\TestException' => 'TestException',
//            'CodeMine\TestClass\Test' => 'Test',
//        ];
//        $pageFactory = new PageTreeFactory();


//        var_dump($pageFactory->generateNamespaceTree());
//        var_dump($pageFactory->explodeTree($data, '\\'));


    }
}

