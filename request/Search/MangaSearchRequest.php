<?php

namespace JikanPHP\Request\Search;

use JikanPHP\Helper\Constants;
use JikanPHP\Request\RequestInterface;

/**
 * Class MangaSearchRequest
 *
 *
 * @package JikanPHP\Request\Search
 */
class MangaSearchRequest implements RequestInterface
{

    /**
     * @var string
     */
    private $query;

    /**
     * @var int
     */
    private $page;

    /**
     * Advanced Search
     */

    /**
     * @var string
     */
    private $char;

    /**
     * @var string
     */
    private $type = 0;

    /**
     * @var float
     */
    private $score = 0;

    /**
     * @var int
     */
    private $status = 0;

    /**
     * @var int
     */
    private $magazine = 0;

    /**
     * @var \DateTime
     */
    private $startDate;

    /**
     * @var \DateTime
     */
    private $endDate;

    /**
     * @var int[]
     */
    private $genre = [];

    /**
     * @var bool
     */
    private $genreExclude = false;

    /**
     * MangaSearchRequest constructor.
     *
     * @param string|null $query
     * @param int    $page
     */
    public function __construct(?string $query = null, int $page = 1)
    {
        $this->query = $query;
        $this->page = $page;

        $this->query = $this->query ?? "";
    }

    /**
     * Get the path to request
     *
     * @return string
     */
    public function getPath($baseUrl): string
    {

        $query = http_build_query(
            [
                'q'      => $this->query,
                'page'   => $this->page,
            //                'letter' => $this->char, // not implemented :thinking: todo
                'type'   => $this->type,
                'score'  => $this->score,
                'status' => $this->status,
            //                'mid'      => $this->magazine, // not implemented todo
            //                'rated'      => $this->rated, // not in manga
                //'start_date'     => $this->startDate->format(DATE_ATOM) ?? null,
                //'end_date'     => $this->endDate->format(DATE_ATOM) ?? null,
                'genre_exclude'     => (int) $this->genreExclude,
            ]
        );

        // Add genre[]=
        if (!empty($this->genre)) {
            foreach ($this->genre as $genre) {
                $query .= '&genre[]='.$genre;
            }
        }

        return sprintf('%s/search/manga?%s', $baseUrl, $query);
    }

    /**
     * @param null|string $query
     *
     * @return $this
     */
    public function setQuery(?string $query = null): self
    {
        $this->query = $query;
        $this->query = $this->query ?? "";

        return $this;
    }

    /**
     * @param int $page
     *
     * @return $this
     */
    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @param string $char
     *
     * @return $this
     */
    public function setStartsWithChar(string $char): self
    {
        $this->char = $char;

        return $this;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param float $score
     *
     * @return $this
     */
    public function setScore(float $score): self
    {
        $this->score = $score;

        return $this;
    }

    /**
     * @param int $status
     *
     * @return $this
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param int $magazine
     *
     * @return $this
     */
    public function setMagazine(int $magazine): self
    {
        $this->magazine = $magazine;

        return $this;
    }

    /**
     * @param \DateTime $date
     * @return AnimeSearchRequest
     */
    public function setStartDate(\DateTime $date): self
    {
        $this->startDate = $date;

        return $this;
    }

    /**
     * @param \DateTime $date
     * @return AnimeSearchRequest
     */
    public function setEndDate(\DateTime $date): self
    {
        $this->endDate = $date;

        return $this;
    }

    /**
     * @param array|int ...$genre
     *
     * @return MangaSearchRequest
     */
    public function setGenre(...$genre): self
    {
        $this->genre = array_unique(
            array_merge($genre, $this->genre)
        );


        return $this;
    }

    /**
     * @param bool $genreExclude
     *
     * @return $this
     */
    public function setGenreExclude(bool $genreExclude): self
    {
        $this->genreExclude = $genreExclude;

        return $this;
    }
}
