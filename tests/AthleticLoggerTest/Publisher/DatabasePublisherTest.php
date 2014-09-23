<?php

namespace AthleticLoggerTest\Publisher;

use Athletic\Results\ClassResults as AthleticClassResult;
use Athletic\Results\MethodResults;
use AthleticLogger\Publisher\DatabasePublisher;
use PHPUnit_Framework_TestCase;

class DatabasePublisherTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $objectManger = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $this->assertInstanceOf(DatabasePublisher::class, new DatabasePublisher($objectManger));
    }

    public function testPublish()
    {
        $results             = array_fill(0, 5, new MethodResults('foo', [0.1, 0.2, 0.3], 1000));
        $athleticClassResult = new AthleticClassResult('foo', $results);
        $objectManger        = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $publisher           = new DatabasePublisher($objectManger);
        $publisher->publish([$athleticClassResult, $athleticClassResult, $athleticClassResult]);
    }
}
