<?php

namespace AthleticLogger\Publisher;

use Athletic\Results\ClassResults as AthleticClassResult;
use AthleticLogger\Entity\ClassResult;
use Doctrine\Common\Persistence\ObjectManager;

class DatabasePublisher #implements PublisherInterface
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * {@inheritdoc}
     */
    public function publish($results)
    {
        /** @var AthleticClassResult $result */
        foreach ($results as $result) {
            $this->objectManager->persist(new ClassResult($result));
        }

        $this->objectManager->flush();
    }
}
