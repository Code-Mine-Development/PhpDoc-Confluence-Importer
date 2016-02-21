<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 02.02.16
 * Time: 10:33
 */

namespace CodeMine\ConfluenceImporter\Parser\Structure;


use CodeMine\ConfluenceImporter\Parser\Structure\Attribute\Collection\Properties;
use CodeMine\ConfluenceImporter\Parser\Structure\Attribute\Constant;
use CodeMine\ConfluenceImporter\Parser\Structure\Attribute\NameClass;
use CodeMine\ConfluenceImporter\Parser\Structure\Attribute\NamespaceClass;
use CodeMine\ConfluenceImporter\Parser\Structure\Attribute\Property;
use CodeMine\ConfluenceImporter\Parser\Structure\Method\Collection\Methods;
use CodeMine\ConfluenceImporter\Parser\Structure\Method\Method;

class DocClass extends Structure
{
    const TYPE = 'Class';

    private $abstract;
    private $final;
    private $extend;
    private $implement;
    private $constant;
    private $properties;
    private $methods;


    public function __construct(array $data)
    {
        $this->properties = new Properties();
        $this->methods    = new Methods();
        $this->generateStructure($data);
    }

    /**
     * @return Methods
     */
    public function getMethods()
    {
        return $this->methods;
    }

    private function generateStructure($data)
    {
        $this->setPath($data['@attributes']['path']);
        $this->setPackage($data['class']['@attributes']['package']);

        $namespace = new NamespaceClass($data['class']['@attributes']['namespace'], DocClass::TYPE);

        $this->setNamespace($namespace);
        $this->setName(new NameClass($data['class']['full_name'], $data['class']['full_name']));
        $this->setAbstract(strtolower($data['class']['@attributes']['abstract']) === 'true');
        $this->setFinal(strtolower($data['class']['@attributes']['final']) === 'true');
        $this->setExtend(is_array($data['class']['extends']) ? NULL : $data['class']['extends']);

        if (isset($data['namespace-alias'])) {
            $this->setNamespaceAlias($data['namespace-alias']);
        }

        if (isset($data['class']['implements'])) {
            $this->setImplement($data['class']['implements']);
        }

        if (isset($data['class']['constant'])) {
            $constant = new Constant($data['class']['constant']);

            $this->setConstant($constant);
        }

        if (isset($data['class']['property'])) {
            $this->setProperty($data['class']['property']);
        }


        if (isset($data['class']['method'])) {
            $this->setMethod($data['class']['method']);

        }

        $this->setDescription(is_array($data['class']['docblock']['description']) ? NULL : $data['class']['docblock']['description']);
        $this->setLongDescription(is_array($data['class']['docblock']['long-description']) ? NULL : $data['class']['docblock']['long-description']);

    }


    private function setMethod(array $method)
    {
        if (FALSE === array_key_exists('name', $method)) {
            foreach ($method as $rowMethod) {
                $this->setMethod($rowMethod);
            }

            return;
        }
        $methodToAdd = new Method($method);
        $this->addMethod($methodToAdd);
    }

    private function addMethod($method)
    {
        $this->methods->attach($method);
    }

    private function setProperty(array $property)
    {
        if (FALSE === array_key_exists('name', $property)) {
            foreach ($property as $prop) {
                $this->setProperty($prop);
            }

            return;
        }
        $propertyToAdd = new Property($property);
        $this->addProperty($propertyToAdd);
    }

    private function addProperty($property)
    {
        $this->properties->attach($property);
    }

    /**
     * @return mixed
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * @param mixed $abstract
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;
    }

    /**
     * @return mixed
     */
    public function getFinal()
    {
        return $this->final;
    }

    /**
     * @param mixed $final
     */
    public function setFinal($final)
    {
        $this->final = $final;
    }

    /**
     * @return mixed
     */
    public function getExtend()
    {
        return $this->extend;
    }

    /**
     * @param mixed $extend
     */
    public function setExtend($extend)
    {
        $this->extend = $extend;
    }

    /**
     * @return mixed
     */
    public function getImplement()
    {
        return $this->implement;
    }

    /**
     * @param mixed $implement
     */
    public function setImplement($implement)
    {
        $this->implement = $implement;
    }

    /**
     * @return mixed
     */
    public function getConstant()
    {
        return $this->constant;
    }

    /**
     * @param mixed $constant
     */
    public function setConstant($constant)
    {
        $this->constant = $constant;
    }


}