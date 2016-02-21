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
        $this->setName(isset($data['name']) ? $data['name'] : NULL );
        $this->setFullName(isset($data['full_name']) ? $data['full_name'] : NULL);
        $this->setDefault(isset($data['default']) ? $data['default'] : NULL);
        $this->setValueType(isset($data['docblock']['tag']['type']) ? $data['docblock']['tag']['type'] : NULL);
    }

    /**
     * @param mixed $default
     */
    private function setDefault($default)
    {
        $this->default = $default;
    }


}