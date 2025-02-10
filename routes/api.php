<?php

use App\Services\SportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/sports', function (SportService $sportService) {
    return response()->json($sportService->getSports());
});

Route::get('/leagues', function (Request $request, SportService $sportService) {
    $page = $request->query('current_page', 1);
    return response()->json($sportService->getLeagues($request, $page));
});

Route::get('/events', function (Request $request, SportService $sportService) {
    $date = $request->query('date', now()->toDateString());
    $page = $request->query('current_page', 1);
    return response()->json($sportService->eventListByDate($request, $date, $page));
});
