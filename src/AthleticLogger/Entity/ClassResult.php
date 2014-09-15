<?php

namespace AthleticLogger\Entity;

use Athletic\Results\ClassResults as AthleticClassResult;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("class_results")
 */
class ClassResult
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", nullable=false)
     * @var string
     */
    private $className;

    /**
     * @ORM\OneToMany(targetEntity="MethodResult", mappedBy="classResult")
     * @var Collection|MethodResult[]
     */
    private $methodResults;

    /**
     * @param AthleticClassResult $athleticClass
     */
    public function __construct(AthleticClassResult $athleticClass)
    {
        $this->className     = $athleticClass->getClassName();
        $athleticMethods     = $this->hydrateMethodResults($athleticClass);
        $this->methodResults = new ArrayCollection($athleticMethods);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @return Collection|MethodResult[]
     */
    public function getMethodResults()
    {
        return new ArrayCollection($this->methodResults->toArray());
    }

    /**
     * Iterate over the athletic class results adding the methods
     * to our Collection of results.
     *
     * @param AthleticClassResult $athleticClass
     */
    private function hydrateMethodResults(AthleticClassResult $athleticClass)
    {
        $methodResults = [];
        foreach ($athleticClass->getIterator() as $athleticMethod) {
            $methodResults[] = new MethodResult($this, $athleticMethod);
        }

        return $methodResults;
    }
}
