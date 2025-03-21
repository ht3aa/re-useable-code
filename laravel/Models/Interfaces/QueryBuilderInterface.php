<?php

namespace App\Models\Interfaces;

interface QueryBuilderInterface
{
    public function getAllowedFilters(): array;

    public function getAllowedSorts(): array;
}
