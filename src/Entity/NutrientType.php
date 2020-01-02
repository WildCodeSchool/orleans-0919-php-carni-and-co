<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NutrientTypeRepository")
 * @UniqueEntity("nutrient")
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
     * @Assert\Length(
     *     max = 80,
     *     maxMessage = "Le type de nutriment de l'ingrédient ne doit pas excéder {{ limit }} caractères.")
     * @Assert\NotBlank
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
