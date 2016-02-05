<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 29.01.16
 * Time: 14:59
 */

namespace CodeMine\ConfluenceImporter\Parser\Structure;


use CodeMine\ConfluenceImporter\Parser\Structure\Attribute\NamespaceClass;

class Structure
{
    private $name;
    private $fileName;

    private $path;
    private $package;

    private $namespace;
    private $namespaceAlias;


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
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


}