<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 27.01.16
 * Time: 19:52
 */

namespace CodeMine\ConfluenceImporter\Parser\File;
use CodeMine\ConfluenceImporter\Parser\Structure\Attribute\Collection\Properties;
use CodeMine\ConfluenceImporter\Parser\Structure\Attribute\Constant;
use CodeMine\ConfluenceImporter\Parser\Structure\Attribute\Property;
use CodeMine\ConfluenceImporter\Parser\Structure\Method\Collection\Methods;
use CodeMine\ConfluenceImporter\Parser\Structure\Method\Method;

/**
 * Class File
 * @package CodeMine\ConfluenceImporter\Parser\File
 */
class File
{
    /* class, interface, trait */
    private $type;

    /*
     * @attributes
     */
    private $path;
    private $package;

    /* Class */
    /**
     * @var bool
     */
    private $final;
    /**
     * @var bool
     */
    private $abstract;
    private $namespace;
    private $namespaceAlias;
    private $extends;
    private $implements;

    /**
     * @var Constant
     */
    private $constant;

    /**
     * @var Properties
     */
    private $properties;
    /**
     * @var Method
     */
    private $methods;

    public function __construct()
    {
        $this->properties = new Properties();
        $this->methods = new Methods();
    }

    /**
     * @param Property $property
     */
    public function addProperty(Property $property)
    {
        $this->properties->attach($property);
    }

    /**
     * @param Method $method
     */
    public function addMethod(Method $method)
    {
        $this->methods->attach($method);
    }



    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @param mixed $package
     */
    public function setPackage($package)
    {
        $this->package = $package;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param boolean $final
     */
    public function setFinal($final)
    {
        $this->final = $final;
    }

    /**
     * @param boolean $abstract
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;
    }

    /**
     * @param mixed $namespace
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * @param mixed $extends
     */
    public function setExtends($extends)
    {
        $this->extends = $extends;
    }

    /**
     * @param mixed $implements
     */
    public function setImplements($implements)
    {
        $this->implements = $implements;
    }

    /**
     * @param mixed $namespaceAlias
     */
    public function setNamespaceAlias($namespaceAlias)
    {
        $this->namespaceAlias = $namespaceAlias;
    }

    /**
     * @param Constant $constant
     */
    public function setConstant(Constant $constant)
    {
        $this->constant = $constant;
    }






}