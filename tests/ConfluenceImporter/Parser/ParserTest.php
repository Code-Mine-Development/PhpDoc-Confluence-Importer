<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 26.01.16
 * Time: 13:07
 */

namespace CodeMine\ConfluenceImporter\Parser;


class ParserTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $parser = new Parser('/home/yoshi/projekty/PhpDoc-Confluence-Importer/docs/structure.xml');
    }




//    public function testParser()
//    {
//        $parser = new Parser();
//        $xmlString = file_get_contents('/home/yoshi/projekty/PhpDoc-Confluence-Importer/docs/structure.xml');
//        $json = $parser->xmlToJson($xmlString);
//
////        print_r($json);die;
//
//        $array = $parser->xmlToArray($xmlString);
//
////        /* File name */
////        echo PHP_EOL . '=== File name' . PHP_EOL;
////        var_dump($array['file'][0]['@attributes']['path']);
////        var_dump($array['file'][0]['class']['full_name']);
////        /* Namespace in class */
////        echo PHP_EOL . '=== Namespace in class' . PHP_EOL;
////        var_dump($array['file'][0]['class']['@attributes']['namespace']);
////        /* Use in class */
////        echo PHP_EOL . '=== Use in class' . PHP_EOL;
////        var_dump($array['file'][0]['namespace-alias']);
////        /* Class const property */
////        echo PHP_EOL . '=== Class const property' . PHP_EOL;
////        var_dump($array['file'][0]['class']['constant'][0]['name']);
////        var_dump($array['file'][0]['class']['constant'][0]['full_name']);
////        var_dump($array['file'][0]['class']['constant'][0]['value']);
////        /* Class property */
////        echo PHP_EOL . '=== Class property' . PHP_EOL;
////        var_dump($array['file'][0]['class']['property'][0]['name']);
////        var_dump($array['file'][0]['class']['property'][0]['full_name']);
////        var_dump($array['file'][0]['class']['property'][0]['docblock']['tag']['type'])
////        /* Class method */
////        echo PHP_EOL . '=== Class method' . PHP_EOL;
////        var_dump($array['file'][0]['class']['method'][0]['name']);
////        var_dump($array['file'][0]['class']['method'][0]['full_name']);
////        var_dump($array['file'][0]['class']['method'][0]['docblock']['tag'][0]['type']);
////        var_dump($array['file'][0]['class']['method'][0]['docblock']['tag'][0]['@attributes']['name']);
////        var_dump($array['file'][0]['class']['method'][0]['docblock']['tag'][0]['@attributes']['variable']);
//
//        foreach ($array['file'] as $file){
//            echo PHP_EOL . 'XxXxX File XxXxX' . PHP_EOL;
//
//            /* File name */
//            echo PHP_EOL . '=== File name' . PHP_EOL;
//            $pathToFile = $file['@attributes']['path'];
//            var_dump($pathToFile);
//            if(isset($file['class']['full_name'])) {
//                $fullName = $file['class']['full_name'];
////                var_dump($fullName);
//            }
//
//            /* Namespace in class */
//            if (isset($file['class']['@attributes']['namespace'])){
//                echo PHP_EOL . '=== Namespace in class' . PHP_EOL;
//                $namespaceInClass = $file['class']['@attributes']['namespace'];
////                var_dump($namespaceInClass);
//            }
//
//            /* Use in class */
//            if (isset($file['namespace-alias'])){
//                echo PHP_EOL . '=== Use in class' . PHP_EOL;
//                $useInClass = $file['namespace-alias'];
////                var_dump($useInClass);
//            }
//
//            /* Class const property */
//            if (isset($file['class']['constant']['name'])){
//                echo PHP_EOL . '=== Class const property' . PHP_EOL;
//                $constName = $file['class']['constant']['name'];
//                $constFullName = $file['class']['constant']['full_name'];
//                $constValue = $file['class']['constant']['value'];
////                var_dump($constName);
////                var_dump($constFullName);
////                var_dump($constValue);
//            }
//
//            /* Class method */
//            if (isset($file['class']['method'][0]['name'])){
//                echo PHP_EOL . '=== Class method' . PHP_EOL;
//                foreach ($file['class']['method'] as $method){
//                    $methodName = $method['name'];
//                    $methodFullName = $method['full_name'];
////                    var_dump($methodName);
//                    var_dump($methodFullName);
//
//                    if (isset($method['docblock']['tag'])){
////                        var_dump($method['docblock']['tag']);
//                        if (is_array($method['docblock']['tag']['@attributes'])){
//                            foreach ($method['docblock']['tag']['@attributes'] as $key => $attribute){
//                                var_dump($key);
////                                $methodAttributeName = $tag['@attributes']['name'];
////                                $methodAttributeType = $tag['@attributes']['type'];
////                                $methodAttributeVariable = $tag['@attributes']['variable'];
//                            }
//                        }
////                        $methodType = $method['docblock']['tag'][0]['type'];
////                        $methodAttributeName = $method['docblock']['tag'][0]['@attributes']['name'];
////                        $methodAttributeVariable = $method['docblock']['tag'][0]['@attributes']['variable'];
//                        echo PHP_EOL . '----------' . PHP_EOL;
////                        var_dump($methodAttributeName);
////                        var_dump($methodAttributeType);
////                        var_dump($methodAttributeVariable);
//                    }
//                }
//            }
//
//        }
//
//
//
//
//
//
//
//        echo PHP_EOL . '=== Array' . PHP_EOL;
//        print_r($array);
//
//
//
//        die;
//    }
}

