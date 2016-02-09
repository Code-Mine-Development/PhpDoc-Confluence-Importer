<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 04.02.16
 * Time: 16:34
 */

namespace CodeMine\ConfluenceImporter\Documentation;


use CodeMine\ConfluenceImporter\Parser\Structure\Structure;

class PageFactory
{
    /**
     * @var \SplObjectStorage
     */
    private $data;
    /**
     * @var array
     */
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

    /**
     * @return array $filedPages
     */
    public function generatePages()
    {
        $emptyPages = $this->generateEmptyPages($this->namespaceTree);
        $filedPages = $this->addContentToPages($emptyPages, $this->data);

        return $filedPages;
    }

    /**
     * @param array $namespaceArray
     * @return array
     */
    public function generateEmptyPages(array $namespaceArray)
    {

        $resultPages = [];
        foreach ($namespaceArray as $key => $value) {

            if (is_array($value)) {

                $childrenNames = $this->getChildrenNames($value);

                $page = new Page($key);
                $page->addContent($childrenNames);
                foreach ($this->generateEmptyPages($namespaceArray[$key]) as $child) {
                    $page->addChildren($child);
                }
                $resultPages[$key] = $page;
            } else {
                $page = new Page($value);
                $doc = $this->getDocForNamespace($value);
                $page->addContent($doc->getName());
                $resultPages[$value] = $page;
            }
        }

        return $resultPages;

    }

    private function addContentToPages(array $pages, \SplObjectStorage $dataPages)
    {

//        $dataPages->
        /** @var Structure $page */
        foreach ($dataPages as $key => $page) {
            echo '==' . PHP_EOL;
            var_dump($page->getNamespace()->value());
            var_dump($page->getNamespace()->valueWithType());
            $this->searchData('test');
        }
    }


    private function searchData($string)
    {

        /** @var Structure $page */
        foreach ($this->data as $key => $page) {
            var_dump($page->getNamespace()->value());
            var_dump($key);
        }
    }


    private function getChildrenNames(array $children)
    {
        $string = NULL;
        foreach ($children as $key => $value) {
            $string = $string . $key . PHP_EOL;
        }
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
            $probablyName = sprintf('%s\%s', $doc->getNamespace()->value(), $doc->getName());
            if ($probablyName === $name) {
                return $doc;
            }
        }

        throw new \InvalidArgumentException('Could not find doc for namespace');
    }


}

