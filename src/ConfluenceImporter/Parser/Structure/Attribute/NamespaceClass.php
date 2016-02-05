<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 04.02.16
 * Time: 08:54
 */

namespace CodeMine\ConfluenceImporter\Parser\Structure\Attribute;


class NamespaceClass
{
    private $type;
    private $namespace;

    public function __construct($value, $type)
    {
        $this->namespace = $value;
        $this->type = $type;
    }

    public function value()
    {
        return $this->namespace;
    }

    public function getType()
    {
        return $this->type;
    }

    public function valueWithType()
    {
        $namespaceArray = explode('\\', $this->value());
        $last = array_pop($namespaceArray);
        $namespace = implode('\\', $namespaceArray);


        return $namespace . '\\' . $this->type . ' ' . $last;
    }
}