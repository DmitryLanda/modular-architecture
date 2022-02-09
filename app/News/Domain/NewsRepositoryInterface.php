<?php

namespace App\News\Domain;

interface NewsRepositoryInterface
{
    public function searchNews(): \Traversable;
}
