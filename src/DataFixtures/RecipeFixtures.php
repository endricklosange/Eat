<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Recipe;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\CategoryFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class RecipeFixtures extends Fixture implements DependentFixtureInterface
{
    public const LOOPNUMBER = 20;
    public const LEVELS = ['Facile', 'Moyen', 'Difficile'];
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::LOOPNUMBER; $i++) {
            $faker = Factory::create('FR,fr');
            $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));
            $recipe = new Recipe();
            $recipe->setDescription($faker->paragraph(10, true));
            $recipe->setName($faker->foodName());
            foreach (self::LEVELS as $keys =>$level) {
                $recipe->setLevel(rand(1,$keys));
            }
            $recipe->setCookingTime($faker->numberBetween(5, 60));
            $recipe->setPreparation($faker->numberBetween(5, 60));
            $recipe->setPeuple($faker->numberBetween(1, 10));
            $recipe->setCategories($this->getReference('categories_' . rand(0, count(CategoryFixtures::CATEGORIES)-1)));
            $recipe->setUser($this->getReference('user_' . rand(1, self::LOOPNUMBER -1)));
            $manager->persist($recipe);
        }


        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            UserFixtures::class,
            CategoryFixtures::class,
        ];
    }
}
