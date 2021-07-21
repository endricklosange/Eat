<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Recipe;
use App\DataFixtures\RecipeFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture 
{
    private $passwordEncoder;
    public const LOOPNUMBER = 20;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);


        $user = new User();
        $user->setName('Etudiant');
        $user->setEmail('user@monsite.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'userpassword'
        ));
        $this->addReference('user_' . 0, $user);
        $manager->persist($user);

        for ($i = 1; $i < self::LOOPNUMBER; $i++) {
            $faker = Factory::create('FR,fr');
            $user = new User();
            $user->setName($faker->firstName() .' '. $faker->lastName());
            $user->setEmail($faker->email());
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $faker->password()
            ));
            $this->addReference('user_' . $i, $user);

            $manager->persist($user);
        }

        $admin = new User();
        $admin->setName('Admin');
        $admin->setEmail('admin@monsite.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminpassword'
        ));
        
        $manager->persist($admin);

        $manager->flush();
        
    }
    
}
