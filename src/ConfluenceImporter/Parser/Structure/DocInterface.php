<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 02.02.16
 * Time: 14:24
 */

namespace CodeMine\ConfluenceImporter\Parser\Structure;


use CodeMine\ConfluenceImporter\Parser\Structure\Attribute\NamespaceClass;

class DocInterface extends Structure
{
    const TYPE = 'Interface';

    public function __construct(array $data)
    {
        $this->generateInterface($data);
    }

    private function generateInterface(array $data)
    {
        $namespace = new NamespaceClass($data['interface']['@attributes']['namespace'], DocInterface::TYPE);
        $this->setName($data['interface']['name']);

        $this->setNamespace($namespace);
        if (isset($class['namespace-alias'])) {
            $this->setNamespaceAlias($class['namespace-alias']);
        }
    }
}