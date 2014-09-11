<?php

namespace AthleticLogger\Entity;

use Athletic\Results\MethodResults as AthleticMethodResult;

/**
 * @Entity
 * @Table("method_results")
 */
class MethodResult implements Entity
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
     * @var ClassResult
     *
     * @ManyToOne(targetEntity="ClassResult", inversedBy="methodResults")
     * @JoinColumn(name="class_result_id", referencedColumnName="id")
     */
    private $classResult;

    /**
     * @var float
     *
     * @Column(name="iterations", type="integer")
     */
    private $iterations;

    /**
     * @var float
     *
     * @Column(name="sum", type="decimal")
     */
    private $sum;

    /**
     * @var float
     *
     * @Column(name="average", type="decimal")
     */
    private $average;

    /**
     * @var float
     *
     * @Column(name="max", type="decimal")
     */
    private $max;

    /**
     * @var float
     *
     * @Column(name="min", type="decimal")
     */
    private $min;

    /**
     * @var float
     *
     * @Column(name="ops", type="decimal")
     */
    private $ops;

    /**
     * @param ClassResult          $classResult
     * @param AthleticMethodResult $atlheticMethod
     */
    public function __construct(ClassResult $classResult, AthleticMethodResult $atlheticMethod)
    {
        $this->classResult = $classResult;
        $this->iterations  = $atlheticMethod->iterations;
        $this->average     = $atlheticMethod->avg;
        $this->max         = $atlheticMethod->max;
        $this->min         = $atlheticMethod->min;
        $this->ops         = $atlheticMethod->ops;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ClassResult
     */
    public function getClassResult()
    {
        return $this->classResult;
    }

    /**
     * @param ClassResult $classResult
     */
    public function setClassResult(ClassResult $classResult = null)
    {
        $this->classResult = $classResult;
    }

    /**
     * @return float
     */
    public function getSum()
    {
        return $this->sum;
    }

    /**
     * @return float
     */
    public function getOps()
    {
        return $this->ops;
    }

    /**
     * @return float
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @return float
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @return float
     */
    public function getIterations()
    {
        return $this->iterations;
    }

    /**
     * @return float
     */
    public function getAverage()
    {
        return $this->average;
    }
}
