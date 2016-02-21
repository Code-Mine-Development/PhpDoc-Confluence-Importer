<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 02.02.16
 * Time: 09:42
 */

namespace CodeMine\ConfluenceImporter\Parser\Structure\Method;


use CodeMine\ConfluenceImporter\Parser\Structure\Method\Param\Collection\Params;
use CodeMine\ConfluenceImporter\Parser\Structure\Method\Param\Param;

class Method
{
    private $name;
    private $fullName;

    private $final;
    private $abstract;
    private $static;

    private $description;
    private $longDescription;

    /**
     * @var Params
     */
    private $params;

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

        $this->setDescription(is_array($method['docblock']['description']) ? NULL : $method['docblock']['description']);
        $this->setLongDescription(is_array($method['docblock']['long-description']) ? NULL : $method['docblock']['long-description']);

        $this->params = new Params();

        if(isset($method['argument'])) {
            $this->generateParams($method['argument']);
        }

    }


    private function generateParams(array $data)
    {

            $param = new Param($data);

            $this->addParam($param);

    }


    private function addParam(Param $param)
    {
        $this->params->attach($param);
    }

    /**
     * @return Params
     */
    public function params()
    {
        $this->params->rewind();

        return $this->params;
    }

    public function name()
    {
        return $this->name;
    }

    public function description()
    {
        return $this->description;
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

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param mixed $longDescription
     */
    public function setLongDescription($longDescription)
    {
        $this->longDescription = $longDescription;
    }






}