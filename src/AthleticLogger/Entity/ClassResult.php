<?php

namespace AthleticLogger\Entity;

use Athletic\Results\ClassResults as AthleticClassResult;
use Athletic\Results\MethodResults as AthleticMethodResult;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table("class_results")
 */
class ClassResult
{
    /**
     * @var integer
     *
     * @Id
     * @Column(name="id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Column(name="name", type="string", nullable=false)
     */
    private $className;

    /**
     * @var MethodResult[]
     *
     * @OneToMany(targetEntity="MethodResult", mappedBy="classResult")
     */
    private $methodResults;

    /**
     * @param AthleticClassResult $athleticClass
     */
    public function __construct(AthleticClassResult $athleticClass)
    {
        $this->className     = $athleticClass->getClassName();
        $this->methodResults = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $className
     */
    public function setClassName($className)
    {
        $this->className = $className;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @return ArrayCollection
     */
    public function getMethodResults()
    {
        return new ArrayCollection($this->methodResults->toArray());
    }

    /**
     * @param AthleticMethodResult[] $methodResults
     */
    public function setMethodResults($athleticMethodResults)
    {
        foreach ($athleticMethodResults as $athleticMethodResult) {
            $this->methodResults->add(new MethodResult($this, $athleticMethodResult));
        }
    }

    /**
     * @param MethodResult $method
     * @return void
     */
    public function addMethodResult(MethodResult $method)
    {
        $method->setClassResult($this);
        $this->methodResults->add($method);
    }

    /**
     * @param MethodResult $methodResult
     * @return void
     */
    public function removeMethodResult(MethodResult $methodResult)
    {
        $methodResult->setClassResult(null);
        $this->methodResults->removeElement($methodResult);
    }
}
