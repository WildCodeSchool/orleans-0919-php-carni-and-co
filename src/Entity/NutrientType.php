<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NutrientTypeRepository")
 */
class NutrientType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $nutrient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNutrient(): ?string
    {
        return $this->nutrient;
    }

    public function setNutrient(string $nutrient): self
    {
        $this->nutrient = $nutrient;

        return $this;
    }
}
