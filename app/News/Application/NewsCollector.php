<?php

namespace App\News\Application;

use App\News\Domain\News;
use App\News\Domain\NewsRepositoryInterface;
use App\User\Application\Response\UserDto;
use App\User\Entrypoint\Internal\UserModule;

class NewsCollector
{
    private NewsRepositoryInterface $newsRepository;
    private UserModule $userModule;

    /**
     * @todo - Do we need UserModuleInterface instead?
     */
    public function __construct(NewsRepositoryInterface $newsRepository, UserModule $userModule)
    {
        $this->newsRepository = $newsRepository;
        $this->userModule = $userModule;
    }

    public function searchNews(): \Traversable
    {
        $news = $this->newsRepository->searchNews();

        foreach ($news as $item) {
            yield $this->transformNews($item);
        }
    }

    /**
     * @todo - where to normalize and serialize?
     */
    private function transformNews(News $news): array
    {
        return [
            'id' => $news->getId(),
            'title' => $news->getTitle(),
            'body' => $news->getBody(),
            'author' => $this->transformAuthor(
                $this->userModule->getUserById($news->getAuthorId())
            )
        ];
    }

    /**
     * @todo - where to normalize and serialize?
     */
    private function transformAuthor(UserDto $author)
    {
        return [
            'id' => $author->getId(),
            'full_name' => $author->getFullName(),
            'avatar' => $author->getAvatar()
        ];
    }
}
