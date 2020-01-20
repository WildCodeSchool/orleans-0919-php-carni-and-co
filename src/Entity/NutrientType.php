<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ingredient", mappedBy="nutrientType")
     */
    private $ingredients;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNutrient(): string
    {
        return $this->nutrient;
    }

    public function setNutrient(string $nutrient): self
    {
        $this->nutrient = $nutrient;

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
            $ingredient->setNutrientType($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        if ($this->ingredients->contains($ingredient)) {
            $this->ingredients->removeElement($ingredient);
            // set the owning side to null (unless already changed)
            if ($ingredient->getNutrientType() === $this) {
                $ingredient->setNutrientType(null);
            }
        }

        return $this;
    }
}
