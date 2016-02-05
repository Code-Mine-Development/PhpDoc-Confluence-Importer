<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 04.02.16
 * Time: 16:34
 */

namespace CodeMine\ConfluenceImporter\Documentation;


class PageFactory
{
    private $array;
    private $data;
    private $resultArray;
    private $testArray = [
            'layer1' => [
                'layer2a' => 'value2A',
                'layer2b' => 'value2B',
                'layer2c' => [
                    'layer3' => 'value3'
                ],
            ],
            'floor1' => [
                'floor2' => 'value_floor'
            ]
        ];

    public function testArray(array $array, $parent = NULL)
    {
        $iterator =  new \RecursiveArrayIterator($array);

        for($i=1; $i<=$iterator->count(); $i++){
            if(is_array($array[$iterator->key()])){
                $title = $iterator->key();
                $content = NULL;
                $page = new Page($title, $content);
                $this->resultArray[$iterator->key()] = $page;

                $parent = $iterator->key();
                $childArray = $iterator->getChildren()->getArrayCopy();

                $this->testArray($childArray, $parent);
            }else {
                $title = $iterator->key();
                $content = NULL;
                $page = new Page($title, $content);
                $this->resultArray[$parent]->addChildren($page);

            }

            $iterator->next();
        }
        return;

//        $recursive = new \RecursiveIteratorIterator($iterator);
////        while($recursive->valid()){
//            echo PHP_EOL . $recursive->key() . PHP_EOL;
//        $array = [];
//            foreach ($recursive as $item) {
//                echo PHP_EOL .$recursive->key(). '=>' . $item . PHP_EOL;
//                $array[] = [$recursive->key() => $item];
//
//            }
//        return;
////        }

    }


    public function __construct(array $nameSpaceArray, \SplObjectStorage $data)
    {
        $this->array = $nameSpaceArray;
        $this->data = $data;
        $this->resultArray = [];
//        $this->createPage();
//        $this->tomek($data);
//        $this->testArray($this->testArray);
        $this->testArray($this->array);
        die;
    }

    public function createPage()
    {
        $iterator =  new \RecursiveArrayIterator($this->data);
        $rit = new \RecursiveIteratorIterator($iterator);

        foreach ($rit as $key => $value) {
            echo PHP_EOL. $key. '=>' . $value;
        }
    }


    private function tomek($arr)
    {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($arr));
        $keys = array();
        foreach ($iterator as $key => $value) {
            // Build long key name based on parent keys
            for ($i = $iterator->getDepth() - 1; $i >= 0; $i--) {
                $key = $iterator->getSubIterator($i)->key() . '_' . $key;
            }
            $keys[] = $key;
        }
        var_export($keys);
    }

}

