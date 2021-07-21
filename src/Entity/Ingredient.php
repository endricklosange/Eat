<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $name;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="ingredient")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Recipe $recipe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fruit;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vegetable;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $meat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $starchy;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dairyProduct;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $alcohols;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getFruit(): ?string
    {
        return $this->fruit;
    }

    public function setFruit(?string $fruit): self
    {
        $this->fruit = $fruit;

        return $this;
    }

    public function getVegetable(): ?string
    {
        return $this->vegetable;
    }

    public function setVegetable(?string $vegetable): self
    {
        $this->vegetable = $vegetable;

        return $this;
    }

    public function getMeat(): ?string
    {
        return $this->meat;
    }

    public function setMeat(?string $meat): self
    {
        $this->meat = $meat;

        return $this;
    }

    public function getStarchy(): ?string
    {
        return $this->starchy;
    }

    public function setStarchy(?string $starchy): self
    {
        $this->starchy = $starchy;

        return $this;
    }

    public function getDairyProduct(): ?string
    {
        return $this->dairyProduct;
    }

    public function setDairyProduct(?string $dairyProduct): self
    {
        $this->dairyProduct = $dairyProduct;

        return $this;
    }

    public function getAlcohols(): ?string
    {
        return $this->alcohols;
    }

    public function setAlcohols(?string $alcohols): self
    {
        $this->alcohols = $alcohols;

        return $this;
    }
}
