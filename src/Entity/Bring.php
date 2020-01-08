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
    private $calorie;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type = "float")
     */
    private $protein;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type = "float")
     */
    private $lipid;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type = "float")
     */
    private $ash;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type = "float")
     */
    private $fiber;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type = "float")
     */
    private $humidity;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type = "float")
     */
    private $carbohydrate;

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

    public function getCalorie(): ?float
    {
        return $this->calorie;
    }

    public function setCalorie(?float $calorie): self
    {
        $this->calorie = $calorie;

        return $this;
    }

    public function getProtein(): ?float
    {
        return $this->protein;
    }

    public function setProtein(?float $protein): self
    {
        $this->protein = $protein;

        return $this;
    }

    public function getLipid(): ?float
    {
        return $this->lipid;
    }

    public function setLipid(?float $lipid): self
    {
        $this->lipid = $lipid;

        return $this;
    }

    public function getAsh(): ?float
    {
        return $this->ash;
    }

    public function setAsh(?float $ash): self
    {
        $this->ash = $ash;

        return $this;
    }

    public function getFiber(): ?float
    {
        return $this->fiber;
    }

    public function setFiber(?float $fiber): self
    {
        $this->fiber = $fiber;

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

    public function getCarbohydrate(): ?float
    {
        return $this->carbohydrate;
    }

    public function setCarbohydrate(?float $carbohydrate): self
    {
        $this->carbohydrate = $carbohydrate;

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
