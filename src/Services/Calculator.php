<?php


namespace App\Services;

use App\Entity\Ingredient;
use App\Entity\Product;

class Calculator
{
    const ANIMALE = 'animale';
    const PROTEINS = 'protéines';
    const CEREALS = 'céréales';
    const GOOD_PROTEIN = 36;
    const INTERMEDIATE_PROTEIN = 28;
    const GOOD_PERCENTAGE_PROTEIN = 75;
    const INTERMEDIATE_PERCENTAGE_PROTEIN = 50;
    const MIN_NOTE_INGREDIENT = 10;
    const MAX_NOTE_INGREDIENT = 15;
    const MIN_CEREAL_PERCENTAGE = 5;
    const MAX_CEREAL_PERCENTAGE = 20;
    const GOOD_LIPID = 16;
    const INTERMEDIATE_LIPID = 12;
    const GOOD_CARBOHYDRATE = 15;
    const INTERMEDIATE_CARBOHYDRATE = 25;
    const GOOD_ASH = 8;
    const INTERMEDIATE_ASH = 10;
    const GOOD_FIBER = 3;
    const INTERMEDIATE_FIBER = 6;
    const MAX_MEDIUM_INGREDIENT = 2;

    public $note = 0;

    /**
     * @return float
     */
    public function getNote(): float
    {
        return $this->note;
    }

    /**
     * @param float $note
     */
    public function setNote(float $note): void
    {
        $this->note = $note;
    }

    //calcul 1
    private function calculFirstGoodIngredient(Product $product) :float
    {
        $compositions = $product->getCompositions();
        if ($compositions[0]->getIngredient()->getOrigin()->getName() == self::ANIMALE &&
            $compositions[0]->getIngredient()->getNutrientType()->getNutrient() == self::PROTEINS) {
            if ($compositions[0]->getIngredient()->getPrecisedType()) {
                $this->setNote($this->getNote() + 1);
            } else {
                $this->setNote($this->getNote() + 0.5);
            }
        }
        return $this->getNote();
    }

    //calcul 2

    //calcul 3
    private function calculPercentageProtein(Product $product) :float
    {
        if ($product->getBring()->getProtein() > self::GOOD_PROTEIN) {
            $this->setNote($this->getNote() + 1);
        } elseif ($product->getBring()->getProtein() >= self::INTERMEDIATE_PROTEIN &&
            $product->getBring()->getProtein() <= self::GOOD_PROTEIN) {
            $this->setNote($this->getNote() + 0.5);
        }
        return $this->getNote();
    }

    //calcul 4
    private function calculQualityIngredient(Product $product) :float
    {
        $compositions = $product->getCompositions();

        $percentage = 0;
        foreach ($compositions as $composition) {
            if ($composition->getIngredient() instanceof Ingredient &&
                $composition->getIngredient()->getOrigin()->getName() == self::ANIMALE &&
                $composition->getIngredient()->getNutrientType()->getNutrient() == self::PROTEINS) {
                $percentage += $composition->getPercentage();
            }
        }
        if ($percentage > self::GOOD_PERCENTAGE_PROTEIN) {
            $this->setNote($this->getNote() + 1);
        } elseif ($percentage <= self::GOOD_PERCENTAGE_PROTEIN &&
            $percentage >= self::INTERMEDIATE_PERCENTAGE_PROTEIN) {
            $this->setNote($this->getNote() + 0.5);
        }
        return $this->getNote();
    }

    //calcul 5
    private function calculNumberGoodIngredient(Product $product) :float
    {
        $compositions = $product->getCompositions();
        $countBad = 0;
        $countMedium = 0;
        foreach ($compositions as $composition) {
            if ($composition->getIngredient() instanceof Ingredient &&
                $composition->getIngredient()->getNote() <= self::MIN_NOTE_INGREDIENT) {
                $countBad += 1;
            }
            if ($composition->getIngredient() instanceof Ingredient &&
                $composition->getIngredient()->getNote() > self::MIN_NOTE_INGREDIENT &&
                $composition->getIngredient()->getNote() <= self::MAX_NOTE_INGREDIENT) {
                $countMedium += 1;
            }
        }
        if ($countBad == 0) {
            if ($countMedium <= self::MAX_MEDIUM_INGREDIENT) {
                $this->setNote($this->getNote() + 1);
            } else {
                $this->setNote($this->getNote() + 0.5);
            }
        }
        return $this->getNote();
    }

    //calcul 6
    private function calculPercentageCereal(Product $product) :float
    {
        $compositions = $product->getCompositions();
        $percentage = 0;
        foreach ($compositions as $composition) {
            if ($composition->getIngredient() instanceof Ingredient &&
                $composition->getIngredient()->getShape() == self::CEREALS) {
                $percentage += $composition->getPercentage();
            }
        }
        if ($percentage < self::MIN_CEREAL_PERCENTAGE) {
            $this->setNote($this->getNote() + 1);
        } elseif ($percentage < self::MAX_CEREAL_PERCENTAGE) {
            $this->setNote($this->getNote() + 0.5);
        }
        return $this->getNote();
    }

    //calcul 8
    private function calculPercentageLipid(Product $product) :float
    {
        if ($product->getBring()->getLipid() > self::GOOD_LIPID) {
            $this->setNote($this->getNote() + 1);
        } elseif ($product->getBring()->getLipid() >= self::INTERMEDIATE_LIPID) {
            $this->setNote($this->getNote() + 0.5);
        }
        return $this->getNote();
    }

    //calcul 9
    private function calculPercentageCarbohydrate(Product $product) :float
    {
        if ($product->getBring()->getCarbohydrate() < self::GOOD_CARBOHYDRATE) {
            $this->setNote($this->getNote() + 1);
        } elseif ($product->getBring()->getCarbohydrate() <= self::INTERMEDIATE_CARBOHYDRATE) {
            $this->setNote($this->getNote() + 0.5);
        }
        return $this->getNote();
    }

    //calcul 10
    private function calculAshAndFiber(Product $product) :float
    {
        if ($product->getBring()->getAsh() <= self::GOOD_ASH && $product->getBring()->getFiber() <= self::GOOD_FIBER) {
            $this->setNote($this->getNote() + 1);
        } elseif ($product->getBring()->getAsh() <= self::INTERMEDIATE_ASH &&
            $product->getBring()->getFiber() <= self::INTERMEDIATE_FIBER) {
            $this->setNote($this->getNote() + 0.5);
        }
        return $this->getNote();
    }


    public function calculNoteProduct(Product $product) :?float
    {
        if ($product->getCompositions()->isEmpty()) {
            return null;
        }
        $this->calculFirstGoodIngredient($product);
        $this->calculPercentageProtein($product);
        $this->calculQualityIngredient($product);
        $this->calculNumberGoodIngredient($product);
        $this->calculPercentageCereal($product);
        $this->calculPercentageLipid($product);
        $this->calculPercentageCarbohydrate($product);
        $this->calculAshAndFiber($product);

        return round($this->note / 8 * 20);
    }
}
