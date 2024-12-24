<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use Faker\Factory;
use DateTimeImmutable;


class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 3; $i++) {
            $category = new Category();
            $category->setTitle($faker->sentence());
            $category->setDescription($faker->paragraph());
            $manager->persist($category);

            for ($j = 0; $j < mt_rand(4, 6); $j++) {
                $article = new Article();

                $content = '<p>' . join('</p><p>', $faker->paragraphs(5)) . '</p>';

                $article
                    ->setTitle($faker->sentence())
                    ->setContent($content)
                    ->setImage($faker->imageUrl())
                    ->setCreateAt(DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-6 months')))
                    ->setCategory($category);

                $manager->persist($article);

                for ($k = 0; $k < mt_rand(4, 10); $k++) {
                    $content = '<p>' . join('</p><p>', $faker->paragraphs(2)) . '</p>';

                    $now = new \DateTime();
                    $interval = $now->diff($article->getCreateAt());
                    $days = $interval->days;
                    $minimum = '-' . $days . ' days';

                    $comment = new Comment();
                    $comment->setAuthor($faker->name);
                    $comment->setContent($content);
                    $comment->setCreatedAt(DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-6 months')));
                    $comment->setArticle($article);

                    $manager->persist($comment);
                }
            }
        }

        // Enregistrement des données en base de données
        $manager->flush();
    }
}
