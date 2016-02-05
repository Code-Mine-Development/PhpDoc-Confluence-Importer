<?php
/**
 * Created by IntelliJ IDEA.
 * User: YoSHi
 * Date: 2016-02-01
 * Time: 14:08
 */

namespace CodeMine\ConfluenceImporter\Parser\Structure\Attribute;


class Property extends Attribute
{
    private $default;

    public function __construct(array $data)
    {
        $this->generateProperty($data);
    }

    private function generateProperty(array $data)
    {
        $this->setName($data['name']);
        $this->setFullName($data['full_name']);
        $this->setDefault($data['default']);
        $this->setValueType($data['docblock']['tag']['type']);
    }

    /**
     * @param mixed $default
     */
    private function setDefault($default)
    {
        $this->default = $default;
    }

}