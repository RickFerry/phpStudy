<?php

namespace App\DTO;

class SerieCreateFormInput
{
    public function __construct(
        public string $serieName = '',
        public int    $seasonsQuantity = 0,
        public int    $episodesPerSeason = 0,
    )
    {
    }
}