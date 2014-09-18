<?php

namespace AthleticLogger\Entity;

use Athletic\Results\MethodResults as AthleticMethodResult;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("method_results")
 */
class MethodResult
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="ClassResult", inversedBy="methodResults")
     * @ORM\JoinColumn(name="class_result_id", referencedColumnName="id")
     * @var ClassResult
     */
    private $classResult;

    /**
     * @ORM\Column(name="name", type="string")
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(name="iterations", type="integer")
     * @var int
     */
    private $iterations;

    /**
     * @ORM\Column(name="sum", type="float")
     * @var float
     */
    private $sum;

    /**
     * @ORM\Column(name="average", type="float")
     * @var float
     */
    private $average;

    /**
     * @ORM\Column(name="max", type="float")
     * @var float
     */
    private $max;

    /**
     * @ORM\Column(name="min", type="float")
     * @var float
     */
    private $min;

    /**
     * Operations per second.
     *
     * @ORM\Column(name="ops", type="float")
     * @var float
     */
    private $ops;

    /**
     * @param ClassResult          $classResult
     * @param AthleticMethodResult $ahleticMethod
     */
    public function __construct(ClassResult $classResult, AthleticMethodResult $ahleticMethod)
    {
        $this->classResult = $classResult;
        $this->name        = (string) $ahleticMethod->methodName;
        $this->iterations  = (int) $ahleticMethod->iterations;
        $this->average     = (float) $ahleticMethod->avg;
        $this->max         = (float) $ahleticMethod->max;
        $this->sum         = (float) $ahleticMethod->sum;
        $this->min         = (float) $ahleticMethod->min;
        $this->ops         = (float) $ahleticMethod->ops;
    }

    /**
     * @return int
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
