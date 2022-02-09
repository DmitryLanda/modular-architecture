<?php

namespace App\News\Application;

use App\News\Domain\News;
use App\News\Domain\NewsRepositoryInterface;
use App\User\Domain\User;
use App\User\Domain\UserRepositoryInterface;

class NewsCollector
{
    private NewsRepositoryInterface $newsRepository;
    private UserRepositoryInterface $userRepository;

    /**
     * @todo it should not depend on the user domain level - may be user application or even entrypoint?
     */
    public function __construct(NewsRepositoryInterface $newsRepository, UserRepositoryInterface $userRepository)
    {
        $this->newsRepository = $newsRepository;
        $this->userRepository = $userRepository;
    }

    public function searchNews(): \Traversable
    {
        $news = $this->newsRepository->searchNews();

        foreach ($news as $item) {
            yield $this->transformNews($item);
        }
    }

    private function transformNews(News $news): array
    {
        return [
            'id' => $news->getId(),
            'title' => $news->getTitle(),
            'body' => $news->getBody(),
            'author' => $this->transformAuthor(
                $this->userRepository->getUserById($news->getAuthorId())
            )
        ];
    }

    /**
     * @todo dont like using User from user domain layer here. May be we need to have dto on user application level?
     */
    private function transformAuthor(User $author)
    {
        return [
            'id' => $author->getId(),
            'first_name' => $author->getFirstName(),
            'last_name' => $author->getLastName(),
            'avatar' => $author->getAvatar()
        ];
    }
}
