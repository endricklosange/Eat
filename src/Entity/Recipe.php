<?php

namespace App\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 * @Vich\Uploadable
 */
class Recipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;
    
    /**
     * @ORM\Column(type="string", length=255 ,nullable=true)
     */
    private ?string $image = "";

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image",nullable=true)
     * @var File
     */
    private ?File $imageFile;
    
    /**
     * @ORM\Column(type="text")
     */
    private string $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $cookingTime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $preparation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $level;

    /**
     * @ORM\OneToMany(targetEntity=Ingredient::class, mappedBy="recipe")
     */
    private ?Collection $ingredient;

    /**
     * @ORM\Column(type="integer")
     */
    private int $peuple;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="recipes")
     */
    private ?User $user;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="recipes")
     */
    private $categories;

     /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $updatedAt;
    
    public function __serialize(): array
    {
        return [];
    }
    public function __construct()
    {
        $this->ingredient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCookingTime(): ?string
    {
        return $this->cookingTime;
    }

    public function setCookingTime(string $cookingTime): self
    {
        $this->cookingTime = $cookingTime;

        return $this;
    }

    public function getPreparation(): ?string
    {
        return $this->preparation;
    }

    public function setPreparation(string $preparation): self
    {
        $this->preparation = $preparation;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredient(): Collection
    {
        return $this->ingredient;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredient->contains($ingredient)) {
            $this->ingredient[] = $ingredient;
            $ingredient->setRecipe($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        if ($this->ingredient->removeElement($ingredient)) {
            // set the owning side to null (unless already changed)
            if ($ingredient->getRecipe() === $this) {
                $ingredient->setRecipe(null);
            }
        }

        return $this;
    }

    public function getPeuple(): ?int
    {
        return $this->peuple;
    }

    public function setPeuple(int $peuple): self
    {
        $this->peuple = $peuple;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCategories(): ?Category
    {
        return $this->categories;
    }

    public function setCategories(?Category $categories): self
    {
        $this->categories = $categories;

        return $this;
    }
    
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
    
    public function setImageFile(File $image = null): void
    {
        $this->imageFile = $image;
        if ($image) {
            $this->updatedAt = new DateTimeImmutable();
        }
    }
    /**
     * @return null|string
     */
     public function getImage(): ?string
    {
        return $this->image;
    }
    
    public function setImage(?string $image): self
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Get the value of updatedAt
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     */
    public function setUpdatedAt(?DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
