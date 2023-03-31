<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Shoes;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');


        $users = [];
        for ($i = 0; $i < 10; $i++) {
            $user = new User;
            $user
                ->setEmail($faker->safeEmail())
                ->setUsername($faker->firstName() . '_' . $faker->lastName())
                ->setRoles(['ROLE_USER'])
                ->setPassword($faker->sha256())
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setAdress($faker->word())
                ->setAdditionalAdress($faker->word())
                ->setPostCode($faker->randomNumber(5, true))
                ->setCity($faker->city())
                ->setDayOfBird($faker->dateTime())
                ->setSex($faker->randomElement(['homme', 'femme', 'unisex']))
                ;

            $users[] = $user;
            $manager->persist($user);
            $users[] = $user;
        }
        
        $shoess = [];
        for ($i = 0; $i < 10; $i++) {
            $shoes = new Shoes;
            $shoes
                ->setPrice($faker->randomFloat(2))
                ->setSize($faker->numberBetween(1, 55))
                ->setSex($faker->randomElement(['homme', 'femme', 'unisex']))
                ->setCategory($faker->randomElement(['sneacker', 'running']))
                ->setDateadd($faker->dateTime())
                ->setImage($faker->imageUrl(640, 480, 'shoes', true))
                ->setDescription($faker->text())
                ->setQuantity( $faker->randomDigit())
                ->setName($faker->text())
                ;

            $shoess[] = $shoes;
            $manager->persist($shoes);
            $shoess[] = $shoes;
        }
        $manager->flush();
        
    }
}
