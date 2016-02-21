<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 02.02.16
 * Time: 14:51
 */

namespace CodeMine\ConfluenceImporter\Parser\Structure;


use CodeMine\ConfluenceImporter\Parser\Structure\Attribute\NameClass;
use CodeMine\ConfluenceImporter\Parser\Structure\Attribute\NamespaceClass;

class DocTrait extends Structure
{
    const TYPE = 'Trait';

    public function __construct(array $data)
    {
//        var_dump($data['trait']['@attributes']['namespace']);die;
        $this->generateTrait($data);
    }

    private function generateTrait(array $data)
    {
        $this->setName(new NameClass($data['trait']['name'], $data['trait']['full_name']));

        if (isset($data['trait']['@attributes']['namespace'])) {
            $namespace = new NamespaceClass($data['trait']['@attributes']['namespace'], DocTrait::TYPE);

            $this->setNamespace($namespace);
        }
    }
}