<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 29.01.16
 * Time: 14:59
 */

namespace CodeMine\ConfluenceImporter\Parser\Structure;


use CodeMine\ConfluenceImporter\Parser\Structure\Attribute\NameClass;
use CodeMine\ConfluenceImporter\Parser\Structure\Attribute\NamespaceClass;

class Structure
{
    /**
     * @var NameClass
     */
    private $name;
    private $fileName;

    private $path;
    private $package;

    private $namespace;
    private $namespaceAlias;

    private $description;
    private $longDescription;



    /**
     * @return NameClass
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName(NameClass $name)
    {
        $this->name = $name;
    }



    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param mixed $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * @param mixed $package
     */
    public function setPackage($package)
    {
        $this->package = $package;
    }

    /**
     * @return NamespaceClass
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param mixed $namespace
     */
    public function setNamespace(NamespaceClass $namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * @return mixed
     */
    public function getNamespaceAlias()
    {
        return $this->namespaceAlias;
    }

    /**
     * @param mixed $namespaceAlias
     */
    public function setNamespaceAlias($namespaceAlias)
    {
        $this->namespaceAlias = $namespaceAlias;
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

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getLongDescription()
    {
        return $this->longDescription;
    }




}