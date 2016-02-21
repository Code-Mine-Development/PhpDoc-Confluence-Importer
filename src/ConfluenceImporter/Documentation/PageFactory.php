<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 04.02.16
 * Time: 16:34
 */

namespace CodeMine\ConfluenceImporter\Documentation;


use CodeMine\ConfluenceImporter\Documentation\Content\PageContent;
use CodeMine\ConfluenceImporter\Parser\Structure\Structure;

class PageFactory
{
    private $data;
    private $namespaceTree;


    /**
     * PageFactory constructor.
     *
     * @param \SplObjectStorage $data
     * @param array $namespaceTree
     */
    public function __construct(\SplObjectStorage $data, array $namespaceTree)
    {
        $this->data = $data;
        $this->namespaceTree = $namespaceTree;
    }

    public function getPage($version)
    {
        $page = $this->generatePages($this->namespaceTree, $version);

        return $page;
    }

    /**
     * @param array $namespaceArray
     * @return array
     */
    private function generatePages(array $namespaceArray, $version)
    {
        {
            $resultPages = [];
            foreach ($namespaceArray as $key => $value) {

                if (is_array($value)) {

                    $childrenNames = $this->getChildrenNames($value);

                    $page = new Page($key . " ({$version})");
                    $page->addContent($childrenNames);
//                    $page->addContent(file_get_contents('/home/yoshi/projekty/PhpDoc-Confluence-Importer/tests/ConfluenceImporter/Service/test'));
                    foreach($this->generatePages($namespaceArray[$key], $version) as $child) {
                        $page->addChildren($child);
                    }
                    $resultPages[$key] = $page;
                } else {
                    $page = new Page($value . " ({$version})");

                    $doc = $this->getDocForNamespace($value);

                    $pageContent = new PageContent($doc);

                    $page->addContent($pageContent->getXhtmlForPageContent());
//                    $page->addContent(file_get_contents('/home/yoshi/projekty/PhpDoc-Confluence-Importer/tests/ConfluenceImporter/Service/test'));
                    $resultPages[$value] = $page;
                }
            }

            return $resultPages;
        }
    }


    private function getChildrenNames(array $children)
    {
        $string = NULL;
//        foreach ($children as $key => $value){
//            $string = $string . $key . PHP_EOL;
//        }
        return $string;
    }

     /**
     * @param $value
     * @return Structure
     */
    private function getDocForNamespace($value)
    {
        $nameArray = explode(' ', $value);
        $name = end($nameArray);
        $cloneData = clone $this->data;
        $cloneData->rewind();
        /** @var Structure $doc */
        foreach ($cloneData as $doc) {
            $probablyName = sprintf('%s\%s', $doc->getNamespace()->value(), $doc->getName()->name());
            if ($probablyName === $name) {
                return $doc;
            }
        }

        throw new \InvalidArgumentException('Could not find doc for namespace');
    }

}

