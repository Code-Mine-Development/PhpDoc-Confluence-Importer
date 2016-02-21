<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 02.02.16
 * Time: 14:24
 */

namespace CodeMine\ConfluenceImporter\Parser\Structure;


use CodeMine\ConfluenceImporter\Parser\Structure\Attribute\NameClass;
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
        $this->setName(new NameClass($data['interface']['name'], $data['interface']['full_name']));

        $this->setNamespace($namespace);
        if (isset($data['namespace-alias'])) {
            $this->setNamespaceAlias($data['namespace-alias']);
        }

        if(isset($data['interface']['@attributes']['package'])){
            $this->setPackage($data['interface']['@attributes']['package']);
        }
    }
}