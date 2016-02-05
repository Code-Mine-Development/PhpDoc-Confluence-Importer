<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 03.02.16
 * Time: 11:48
 */

namespace CodeMine\ConfluenceImporter\Documentation;


use CodeMine\ConfluenceImporter\Parser\Structure\Structure;
use Zend\Stdlib\ArrayUtils;

class PageTreeFactory
{
    private $data;
    private $namespaceArray;


    public function __construct(\SplObjectStorage $data = NULL)
    {
        $this->data = $data;
        $this->namespaceArray = $this->generateNamespaceArray($data);
        $PageFactory = new PageFactory($this->namespaceArray, $this->data);
    }

    public function namespaceArray()
    {
        return $this->namespaceArray;
    }

    private function generateNamespaceArray()
    {
        $newArray = [];


        /** @var Structure $item */
        foreach ($this->data as $item) {

            $newArray[] = $this->buildTree($item->getNamespace()->value(), $item->getNamespace()->getType(), $item->getName());
        }

        $combined = [];

        foreach ($newArray as $tree) {
            $combined = ArrayUtils::merge($combined, $tree);
        }

        return $combined;

    }

    /**
     * @param $item
     * @param $type
     * @param null $class
     * @param null $parent
     * @return array
     */
    private function buildTree($item, $type, $class = NULL, $parent = NULL)
    {
        $namespaces = [];

        $hasChildren = strpos($item, '\\');

        if (FALSE !== $hasChildren) {
            $child            = substr($item, strpos($item, '\\') + 1);
            $currentNamespace = substr($item, 0, strpos($item, '\\'));
            $current          = (NULL !== $parent) ? $parent . '\\' . $currentNamespace : $currentNamespace;

            $namespaces[$current] = $this->buildTree($child, $type, $class, $current);
        } else {
            $namespaces[$parent . '\\' . $item] = [$type . ' ' . $parent . '\\' . $item .'\\'. $class];
        }

        return $namespaces;
    }
}