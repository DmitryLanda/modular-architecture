<?php

namespace App\News\Entrypoint\Controller;

use App\News\Application\NewsCollector;

class SearchNews
{
    private NewsCollector $collector;

    public function __construct(NewsCollector $collector)
    {
        $this->collector = $collector;
    }

    public function __invoke(): string
    {
        return $this->print($this->collector->searchNews());
    }

    private function print(\Traversable $news): string
    {
        $result = json_encode(
            iterator_to_array($news),
            JSON_PRETTY_PRINT
        );

        return "<pre>$result</pre>";
    }
}
