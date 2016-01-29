<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 27.01.16
 * Time: 14:00
 */

namespace CodeMine\TestClass\TestParentClass;

use CodeMine\TestClass\TestException\TestException;
use CodeMine\TestClass\TestParentClass\TestAbstractClass\TestAbstractClass;

/**
 * Class TestParentClass
 * @package CodeMine\TestClass\TestParentClass
 */
class TestParentClass extends TestAbstractClass
{
    /**
     * @param $name
     * @return string
     * @throws TestException
     */
    protected final function HelloName($name)
    {
        if (FALSE === $this->validate($name)){
            throw new TestException('Value is not a string');
        }

        return $this->HelloWorld() . $name;
    }

    /**
     * @param $name
     * @return bool
     */
    final private function validate($name)
    {
        return is_string($name);
    }
}