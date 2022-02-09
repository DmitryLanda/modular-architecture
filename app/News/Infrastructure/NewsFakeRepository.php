<?php

namespace App\News\Infrastructure;

use App\News\Domain\News;
use App\News\Domain\NewsRepositoryInterface;
use Faker\Factory;
use Faker\Generator;

class NewsFakeRepository implements NewsRepositoryInterface
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function searchNews(): \Generator
    {
        $number = rand(0, 20);

        for ($i = 0; $i < $number; $i++) {
            yield new News(
                $this->faker->title,
                $this->faker->text,
                $this->faker->uuid,
                $this->faker->uuid
            );
        }
    }
}
