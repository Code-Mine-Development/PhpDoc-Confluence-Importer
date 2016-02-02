<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 26.01.16
 * Time: 12:42
 */

namespace CodeMine\ConfluenceImporter\Parser;
use CodeMine\ConfluenceImporter\Parser\File\File;
use CodeMine\ConfluenceImporter\Parser\Structure\Attribute\Constant;
use CodeMine\ConfluenceImporter\Parser\Structure\Attribute\Property;

/**
 * Class Parser
 * @package CodeMine\ConfluenceImporter\Parser
 */
class Parser
{
    private $xmlString;

    private $classArray;
    private $package;
    private $namespace;
    private $deprecated;

    /**
     * Parser constructor.
     * @param string $path
     */
    public function __construct($path = 'C:\Users\YoSHi\IdeaProjects\PhpDoc-Confluence-Importer\doc\structure.xml')
    {
        $this->xmlString = file_get_contents($path);

        $array = $this->xmlToArray($this->xmlString);

        $this->classArray = $array['file'];
        $this->package    = $array['package'];
        $this->namespace  = $array['namespace'];
        $this->deprecated = $array['deprecated'];

        $this->prepareFiles();
//        print_r($this->fileArray);die;
    }


    private function prepareFiles()
    {
        $fileCollection = new \SplObjectStorage();

        foreach ($this->classArray as $class){

            $file = new File();

            if (isset($class['@attributes'])){
                $path = $class['@attributes']['path'];
                $package = $class['@attributes']['package'];
                $file->setPath($path);
                $file->setPackage($package);
            }

            foreach ($class as $key => $value){
                switch($key){
                    case 'class':
                        $file->setType($key);
                        $file->setAbstract(strtolower($class['class']['@attributes']['abstract']) === 'true');
                        $file->setFinal(strtolower($class['class']['@attributes']['final']) === 'true');
                        $file->setNamespace($class['class']['@attributes']['namespace']);
                        $file->setExtends(is_array($class['class']['extends']) ? NULL : $class['class']['extends']);

                        if (isset($class['class']['implements'])) {
                            $file->setImplements($class['class']['implements']);

                            ////        var_dump($array['file'][0]['class']['constant'][0]['name']);
////        var_dump($array['file'][0]['class']['constant'][0]['full_name']);
////        var_dump($array['file'][0]['class']['constant'][0]['value']);


                        }

                        if (isset($class['namespace-alias'])){
                            $file->setNamespaceAlias($class['namespace-alias']);
                        }

//                        var_dump($class);die;
//                        var_dump((isset($class['constant'])));
                        if (isset($class['class']['constant'])){
                            $constant = new Constant();
                            $name = $class['class']['constant']['name'];
                            $fullName = $class['class']['constant']['full_name'];
                            $valueType = $class['class']['constant']['docblock']['tag']['@attributes']['type'];
                            $value = $class['class']['constant']['value'];
                            $constant->setName($name);
                            $constant->setFullName($fullName);
                            $constant->setValueType($valueType);
                            $constant->setValue($value);
                            $file->setConstant($constant);
                        }

                        if (isset($class['class']['property'])){
                            $test = $class['class']['property'];
                            $this->setProperty($class['class']['property'], $file);
                        }


                        echo $key . PHP_EOL;
                        break;
                    case 'interface':
                        $file->setType($key);
                        $file->setNamespace($class['interface']['@attributes']['namespace']);
                        if (isset($class['namespace-alias'])){
                            $file->setNamespaceAlias($class['namespace-alias']);
                        }

                        echo $key . PHP_EOL;
                        break;
                    case 'trait':
                        $file->setType($key);
                        if (isset($class['namespace-alias'])){
                            $file->setNamespaceAlias($class['namespace-alias']);
                        }
                        echo $key . PHP_EOL;
                        break;
                }

            }

            $fileCollection->attach($file);


        }

        return $fileCollection;

    }




    /**
     * @param $xmlString
     * @return string
     */
    public function xmlToJson($xmlString)
    {
        $json = $this->generateJson($xmlString);

        return $json;
    }

    /**
     * @param string $xmlString
     * @return array
     */
    public function xmlToArray($xmlString)
    {
        $json = $this->generateJson($xmlString);
        $array = json_decode($json, true);

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

    private function setProperty(array $property, File $file)
    {
//        print_r($property);
        $zal = array_key_exists('name', $property);
        $zalozenie = (FALSE === array_key_exists('name', $property));
        if(FALSE === array_key_exists('name', $property)){
            foreach ($property as $prop){
                $this->setProperty($prop, $file);
            }
            return;
        }
        $propertyToAdd = new Property();
        $propertyToAdd->setName($property['name']);

        $file->addProperty($propertyToAdd);
    }
}