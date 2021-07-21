<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORIES = ['Entrées', 'Plats', 'Déserts'];
    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $keys => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->addReference('categories_' . $keys, $category);
        }
        $manager->flush();
    }
}
