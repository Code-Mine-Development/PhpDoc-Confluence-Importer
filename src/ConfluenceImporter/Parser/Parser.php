<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 26.01.16
 * Time: 12:42
 */

namespace CodeMine\ConfluenceImporter\Parser;

use CodeMine\ConfluenceImporter\Parser\Structure\DocClass;
use CodeMine\ConfluenceImporter\Parser\Structure\DocInterface;
use CodeMine\ConfluenceImporter\Parser\Structure\DocTrait;

/**
 * Class Parser
 * @package CodeMine\ConfluenceImporter\Parser
 */
class Parser
{
    private $xmlString;

    private $classArray;


    /**
     * Parser constructor.
     * @param string $path
     */
    public function __construct($path)
    {
        if (FALSE === file_exists($path)){
            throw new \InvalidArgumentException('Xml file not exist: ' . $path);

        }
        $this->xmlString = file_get_contents($path);

        $array = $this->xmlToArray($this->xmlString);

        $this->classArray = $array['file'];
    }


    /**
     * @return \SplObjectStorage<Structure>
     */
    public function prepareFiles()
    {
        $fileCollection = new \SplObjectStorage();

        foreach ($this->classArray as $class) {

            $file = NULL;

            foreach ($class as $key => $value) {
                switch ($key) {
                    case 'class':
                        $file = new DocClass($class);
                        break;
                    case 'interface':
                        $file = new DocInterface($class);
                        break;
                    case 'trait':
                        $file = new DocTrait($class);
                        break;
                }
            }

            $fileCollection->attach($file);
        }
        $fileCollection->rewind();

        return $fileCollection;
    }

    /**
     * @param string $xmlString
     * @return array
     */
    private function xmlToArray($xmlString)
    {
        $json  = $this->generateJson($xmlString);
        $array = json_decode($json, TRUE);

        return $array;

    }

    /**
     * @param $xmlString
     * @return string
     */
    private function generateJson($xmlString)
    {
        $xml  = simplexml_load_string($xmlString);
        $json = json_encode($xml);

        return $json;
    }
}