<?php
/**
 * Created by IntelliJ IDEA.
 * User: yoshi
 * Date: 27.01.16
 * Time: 14:00
 */

namespace CodeMine\TestClass;


use CodeMine\TestClass\TestException\TestException;
use CodeMine\TestClass\TestInterface\TestInterface;
use CodeMine\TestClass\TestParentClass\TestParentClass;
use CodeMine\TestClass\TestTrait\TestClassForTrait;

/**
 * Class TestClass
 * @package CodeMine\TestClass
 */
class TestClass extends TestParentClass implements TestInterface
{
    use TestClassForTrait;

    /**
     * @var string
     */
    const TEST_CONST = 'test const value';

    /**
     * @var string
     */
    static public $staticValue = 'test static value';

    static protected $staticEmptyValue;

    /**
     * @var string
     */
    private $privateValue = 'test private value';

    /**
     * @var string
     */
    protected $protectedValue = 'test protected value';

    /**
     * @var string
     */
    public $publicValue = 'test public value';

    public $publicEmptyValue;

    /**
     * @param string $value
     * @return string
     * @throws TestException
     */
    static function staticMethod($value)
    {
        if (FALSE === is_string($value)){
            throw new TestException('test exception message');
        }

        return self::$staticValue;
    }

    /**
     * @param $value
     * @return string
     * @throws TestException
     */
    private function privateMethod($value)
    {
        if (FALSE === is_string($value)){
            throw new TestException('test exception message');
        }

        return $this->privateValue;
    }

    /**
     * @param $value
     * @return string
     * @throws TestException
     */
    protected function protectedFunction($value)
    {
        if (FALSE === is_string($value)){
            throw new TestException('test exception message');
        }

        return self::TEST_CONST;
    }

    /**
     * @param $value
     * @return string
     * @throws TestException
     */
    public function publicFunction($value)
    {
        if (FALSE === is_string($value)){
            throw new TestException('test exception message');
        }

        return self::TEST_CONST;
    }


}