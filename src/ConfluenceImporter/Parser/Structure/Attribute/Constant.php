<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 29.01.16
 * Time: 15:48
 */

namespace CodeMine\ConfluenceImporter\Parser\Structure\Attribute;


class Constant extends Attribute
{
    private $value;

    public function __construct(array $data)
    {
        $this->generateConstant($data);
    }

    private function generateConstant(array $data)
    {
        $this->setName($data['name']);
        $this->setFullName($data['full_name']);
        $this->setValueType($data['docblock']['tag']['@attributes']['type']); //TODO:: isset?
        $this->setValue($data['value']);
    }

    /**
     * @param mixed $value
     */
    private function setValue($value)
    {
        $this->value = $value;
    }


}