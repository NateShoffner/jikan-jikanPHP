<?php

namespace JikanPHP\Request\Manga;

use JikanPHP\Helper\Constants;
use JikanPHP\Request\RequestInterface;

/**
 * Class MangaNewsRequest
 *
 * @package JikanPHP\Request
 */
class MangaNewsRequest implements RequestInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * MangaNewsRequest constructor.
     *
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPath($baseUrl): string
    {
        return sprintf('%s/manga/%d/news', $baseUrl, $this->id);
    }
}
