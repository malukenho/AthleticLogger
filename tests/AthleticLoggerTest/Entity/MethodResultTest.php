<?php

namespace AthleticLoggerTest\Entity;

use Athletic\Results\MethodResults as AthleticMethodResult;
use AthleticLogger\Entity\ClassResult;
use AthleticLogger\Entity\MethodResult;
use PHPUnit_Framework_TestCase;

class MethodResultTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ClassResult
     */
    private $classResult;

    /**
     * @var AthleticMethodResult
     */
    private $athleticMethodResult;

    /**
     * @var MethodResult
     */
    private $methodResult;

    public function setUp()
    {
        $this->classResult          = $this->getMock('AthleticLogger\Entity\ClassResult', [], [], '', false);
        $this->athleticMethodResult = new AthleticMethodResult('foo', [1, 2, 3], 1000);
        $this->methodResult         = new MethodResult($this->classResult, $this->athleticMethodResult);
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(MethodResult::class, $this->methodResult);
    }

    public function testGetMethodName()
    {
        $this->assertEquals($this->athleticMethodResult->methodName, $this->methodResult->getName());
    }

    public function testGetOperationsPerSecond()
    {
        $this->assertEquals($this->athleticMethodResult->ops, $this->methodResult->getOps());
    }

    public function testGetSum()
    {
        $this->assertEquals($this->athleticMethodResult->sum, $this->methodResult->getSum());
    }

    public function testGetMax()
    {
        $this->assertEquals($this->athleticMethodResult->max, $this->methodResult->getMax());
    }

    public function testGetMin()
    {
        $this->assertEquals($this->athleticMethodResult->min, $this->methodResult->getMin());
    }

    public function testGetClassResult()
    {
        $this->assertSame($this->classResult, $this->methodResult->getClassResult());
    }

    public function testGetIterations()
    {
        $this->assertSame($this->athleticMethodResult->iterations, $this->methodResult->getIterations());
    }

    public function testGetId()
    {
        $this->assertNull($this->methodResult->getId());
    }

    public function testGetAverage()
    {
        $this->assertEquals($this->athleticMethodResult->avg, $this->methodResult->getAverage());
    }
}
