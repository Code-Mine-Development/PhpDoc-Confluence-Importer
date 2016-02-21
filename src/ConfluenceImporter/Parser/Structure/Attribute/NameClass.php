<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 11.02.16
 * Time: 15:31
 */

namespace CodeMine\ConfluenceImporter\Parser\Structure\Attribute;


class NameClass
{
    private $name;
    private $fullName;

    public function __construct($name, $fullName)
    {
        $this->name = $name;
        $this->fullName = $fullName;
    }
    /**
     * @return mixed
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function fullName()
    {
        return $this->fullName;
    }


}