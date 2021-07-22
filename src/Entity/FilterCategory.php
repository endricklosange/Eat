<?php

namespace App\Entity;

use App\Entity\Category;

class FilterCategory
{
    private ?Category $category = null;

    /**
     * @return null|Category   
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @return FilterCategory
     */
    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
