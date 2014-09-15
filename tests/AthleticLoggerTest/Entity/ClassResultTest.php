<?php

namespace AthleticLoggerTest\Entity;

use ArrayIterator;
use Athletic\Results\ClassResults as AthleticClassResult;
use Athletic\Results\MethodResults as AthleticMethodResult;
use AthleticLogger\Entity\ClassResult;
use PHPUnit_Framework_TestCase;

class ClassResultTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ClassResult
     */
    private $classResult;

    /**
     * @var AthleticClassResult
     */
    private $athleticClassResult;

    /**
     * @var string
     */
    private $className = 'foo';

    public function setUp()
    {
        $this->athleticClassResult = $this->getMock('Athletic\Results\ClassResults', [], [], '', false);
        $athleticMethodResult      = new AthleticMethodResult($this->athleticClassResult, [0.1, 0.2, 0.3], 1000);
        $this->athleticClassResult->expects($this->once())
                                  ->method('getIterator')
                                  ->will($this->returnValue(new ArrayIterator([$athleticMethodResult])));
        $this->athleticClassResult->expects($this->once())->method('getClassName')->will($this->returnValue($this->className));
        $this->classResult = new ClassResult($this->athleticClassResult);
    }

    public function testGetId()
    {
        $this->assertNull($this->classResult->getId());
    }

    public function testGetClassName()
    {
        $this->assertEquals($this->className, $this->classResult->getClassName());
    }

    public function testGetMethodResults()
    {
        $this->assertCount(1, $this->classResult->getMethodResults());
    }
}
