<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 28.01.16
 * Time: 12:14
 */

namespace CodeMine\TestClass;

/**
 * Class TestFinalClass
 * @package CodeMine\TestClass
 */
final class TestFinalClass extends TestClass
{
    /**
     * TestFinalClass constructor.
     * @param $name
     */
    public function __construct($name)
    {
        return $this->HelloName($name);
    }
}