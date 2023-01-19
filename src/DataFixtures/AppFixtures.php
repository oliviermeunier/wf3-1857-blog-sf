<?php

namespace App\DataFixtures;

use App\Entity\Post;
use DateTimeImmutable;
use App\Factory\PostFactory;
use App\Factory\UserFactory;
use App\Factory\CommentFactory;
use App\Factory\CategoryFactory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        /**
         * Exemple de création d'un objet Post 
         * On pourrait faire une boucle pour en créer plusieurs
         * Mais on va plutôt utiliser une librairie comme Zendstruck Foundry pour 
         * générer nos fixtures plus facilement
         */
        // $faker = \Faker\Factory::create('fr_FR');

        // $datetime = $faker->dateTimeBetween('-3 years', 'now', 'Europe/Paris');
        // $dateTimeImmutable = DateTimeImmutable::createFromMutable($datetime);

        // $post = new Post();
        // $post->setTitle($faker->sentence());
        // $post->setContent($faker->text(2000));
        // $post->setAuthor($faker->name());
        // $post->setImage('https://picsum.photos/seed/post-48678/750/300');
        // $post->setCreatedAt($dateTimeImmutable);

        // $manager->persist($post);
        UserFactory::new()->createMany(10);
        UserFactory::new()->createOne(['email' => 'user@gmail.com']);
        UserFactory::new()->create([
            'roles' => ['ROLE_ADMIN'],
            'email' => 'admin@gmail.com'
        ]);

        CategoryFactory::new()->createMany(5);

        // Instanciation de PostFactory en appelant la méthode statique new()
        PostFactory::new()

            // Création de 10 articles
            ->createMany(10);

        CommentFactory::new()->createMany(50);

        $manager->flush();
    }
}
