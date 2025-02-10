<?php

namespace App\Services;

use App\Repositories\Contracts\SportApiRepositoryInterface;
use Illuminate\Http\Request;

class SportService
{
    protected $sportApiRepository;

    public function __construct(SportApiRepositoryInterface $sportApiRepository)
    {
        $this->sportApiRepository = $sportApiRepository;
    }

    public function getSports()
    {
        return $this->sportApiRepository->sportList();
    }

    public function getleagues(Request $request)
    {
        $page = $request->query('current_page');
        return $this->sportApiRepository->leagueList($page);
    }

    public function eventListByDate(Request $request)
    {
        $date = $request->query('date');
        $page = $request->query('current_page');
        return $this->sportApiRepository->eventListByDate($date, $page);
    }
}
