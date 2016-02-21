<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 21.02.16
 * Time: 15:16
 */

namespace CodeMine\ConfluenceImporter\Parser\Structure\Method\Param;


class Param
{
    private $type;
    private $name;

    public function __construct($data)
    {
        if (array_key_exists('name', $data)) {
            $this->type = (is_array($data['type'])) ? 'mixed' : $data['type'];
            $this->name = $data['name'];
        }
    }

    /**
     * @return string
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }


}