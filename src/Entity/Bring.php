<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BringRepository")
 */
class Bring
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type = "float")
     *
     */
    private $calories;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type = "float")
     */
    private $ratioProteinCalorie;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type = "float")
     */
    private $proteins;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type = "float")
     */
    private $lipids;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type = "float")
     */
    private $ashes;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type = "float")
     */
    private $fibers;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type = "float")
     */
    private $humidity;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type = "float")
     */
    private $carbohydrates;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type = "float")
     */
    private $calcium;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type = "float")
     */
    private $phosphorus;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type = "float")
     */
    private $reportPhosphoCal;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type = "float")
     */
    private $omega6;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type = "float")
     */
    private $omega3;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCalories(): ?float
    {
        return $this->calories;
    }

    public function setCalories(?float $calories): self
    {
        $this->calories = $calories;

        return $this;
    }

    public function getRatioProteinCalorie(): ?float
    {
        return $this->ratioProteinCalorie;
    }

    public function setRatioProteinCalorie(?float $ratioProteinCalorie): self
    {
        $this->ratioProteinCalorie = $ratioProteinCalorie;

        return $this;
    }

    public function getProteins(): ?float
    {
        return $this->proteins;
    }

    public function setProteins(?float $proteins): self
    {
        $this->proteins = $proteins;

        return $this;
    }

    public function getLipids(): ?float
    {
        return $this->lipids;
    }

    public function setLipids(?float $lipids): self
    {
        $this->lipids = $lipids;

        return $this;
    }

    public function getAshes(): ?float
    {
        return $this->ashes;
    }

    public function setAshes(?float $ashes): self
    {
        $this->ashes = $ashes;

        return $this;
    }

    public function getFibers(): ?float
    {
        return $this->fibers;
    }

    public function setFibers(?float $fibers): self
    {
        $this->fibers = $fibers;

        return $this;
    }

    public function getHumidity(): ?float
    {
        return $this->humidity;
    }

    public function setHumidity(?float $humidity): self
    {
        $this->humidity = $humidity;

        return $this;
    }

    public function getCarbohydrates(): ?float
    {
        return $this->carbohydrates;
    }

    public function setCarbohydrates(?float $carbohydrates): self
    {
        $this->carbohydrates = $carbohydrates;

        return $this;
    }

    public function getCalcium(): ?float
    {
        return $this->calcium;
    }

    public function setCalcium(?float $calcium): self
    {
        $this->calcium = $calcium;

        return $this;
    }

    public function getPhosphorus(): ?float
    {
        return $this->phosphorus;
    }

    public function setPhosphorus(?float $phosphorus): self
    {
        $this->phosphorus = $phosphorus;

        return $this;
    }

    public function getReportPhosphoCal(): ?float
    {
        return $this->reportPhosphoCal;
    }

    public function setReportPhosphoCal(?float $reportPhosphoCal): self
    {
        $this->reportPhosphoCal = $reportPhosphoCal;

        return $this;
    }

    public function getOmega6(): ?float
    {
        return $this->omega6;
    }

    public function setOmega6(?float $omega6): self
    {
        $this->omega6 = $omega6;

        return $this;
    }

    public function getOmega3(): ?float
    {
        return $this->omega3;
    }

    public function setOmega3(?float $omega3): self
    {
        $this->omega3 = $omega3;

        return $this;
    }
}
