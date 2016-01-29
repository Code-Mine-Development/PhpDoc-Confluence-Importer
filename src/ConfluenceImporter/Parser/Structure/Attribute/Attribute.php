<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 29.01.16
 * Time: 15:37
 */

namespace CodeMine\ConfluenceImporter\Parser\Structure\Attribute;


class Attribute
{
    private $name;
    private $fullName;

    private $valueType;

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @param mixed $valueType
     */
    public function setValueType($valueType)
    {
        $this->valueType = $valueType;
    }



}