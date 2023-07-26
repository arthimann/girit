<?php

namespace App\Repositories;

interface WikiRepositoryInterface
{
    /**
     * API Error response key
     */
    public const ERR_RESPONSE_KEY = 'title';
    /**
     * API OK response key
     */
    public const RESPONSE_KEY = 'selected';

    /**
     * Get on this day, today data from WIKI
     * @return array
     */
    public function getToday(): array;

    /**
     * Generate title url
     * @return string
     */
    public function genTitleUrl(): string;
}
