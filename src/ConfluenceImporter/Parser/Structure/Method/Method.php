<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 02.02.16
 * Time: 09:42
 */

namespace CodeMine\ConfluenceImporter\Parser\Structure\Method;


class Method
{
    private $name;
    private $fullName;

    private $final;
    private $abstract;
    private $static;

    public function __construct(array $data)
    {
        $this->generateMethod($data);
    }

    private function generateMethod(array $method)
    {
        $this->setName($method['name']);
        $this->setFullName($method['full_name']);
        $this->setAbstract(strtolower($method['@attributes']['abstract']) === 'true');
        $this->setFinal(strtolower($method['@attributes']['final']) === 'true');
        $this->setStatic(strtolower($method['@attributes']['static']) === 'true');
    }


    /**
     * @param mixed $name
     */
    private function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $fullName
     */
    private function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @param mixed $final
     */
    private function setFinal($final)
    {
        $this->final = $final;
    }

    /**
     * @param mixed $abstract
     */
    private function setAbstract($abstract)
    {
        $this->abstract = $abstract;
    }

    /**
     * @param mixed $static
     */
    private function setStatic($static)
    {
        $this->static = $static;
    }



}