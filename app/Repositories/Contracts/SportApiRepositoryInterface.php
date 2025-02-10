<?php

namespace App\Repositories\Contracts;

interface SportApiRepositoryInterface
{
    public function sportList();
    public function leagueList();
    public function eventListByDate(array $date);
}
