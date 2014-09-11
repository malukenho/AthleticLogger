<?php

namespace AthleticLoggerTest\Entity;

use Athletic\Results\ClassResults as AthleticClassResult;
use Athletic\Results\MethodResults as AthleticMethodResult;
use AthleticLogger\Entity\ClassResult;
use AthleticLogger\Entity\MethodResult;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit_Framework_TestCase;

class ClassResultTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var AthleticClassResult
     */
    private $athleticClassResult;

    /**
     * @var ClassResult
     */
    private $classResult;

    /**
     * @var MethodResult
     */
    private $methodResult;

    /**
     * @var AthleticMethodResult
     */
    private $athleticMethodResult;

    public function setUp()
    {
        $this->athleticClassResult  = $this->getMock('Athletic\Results\ClassResults', [], ['foo', []]);
        $this->classResult          = new ClassResult($this->athleticClassResult);
        $this->athleticMethodResult = new AthleticMethodResult('FooName', [0.1, 0.2, 0.3], 100);
        $this->methodResult         = new MethodResult($this->classResult, $this->athleticMethodResult);
    }

    public function testGetId()
    {
        $this->assertNull($this->classResult->getId());
    }

    public function testGetAndSetClassName()
    {
        $this->classResult->setClassName($className = ClassResult::class);

        $this->assertEquals($className, $this->classResult->getClassName());
    }

    public function testGetMethodResults()
    {
        $emptyCollection = new ArrayCollection([]);

        $this->assertEquals($emptyCollection, $this->classResult->getMethodResults());
    }

    public function testAddMethodResult()
    {
        $this->classResult->addMethodResult($this->methodResult);

        $this->assertEquals(1, $this->classResult->getMethodResults()->count());
    }

    public function testRemoveMethodResult()
    {
        $this->classResult->removeMethodResult($this->methodResult);

        $this->assertTrue($this->classResult->getMethodResults()->isEmpty());
    }

    public function testSetMethodResults()
    {
        $methodResults = [$this->athleticMethodResult, $this->athleticMethodResult, $this->athleticMethodResult];
        $this->classResult->setMethodResults($methodResults);

        $this->assertEquals(3, $this->classResult->getMethodResults()->count());
    }
}
