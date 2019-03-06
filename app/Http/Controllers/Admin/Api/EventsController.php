<?php
/**
 * Created by PhpStorm.
 * User: edo
 */

namespace App\Http\Controllers\Admin\Api;


use App\Http\Controllers\Controller;
use App\Repository\MatchesRepository;
use App\Repository\SportsRepository;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    private $sportsRepository;
    private $matchesRepository;

    public function __construct(
        SportsRepository $sportsRepository,
        MatchesRepository $matchesRepository
    ){
        $this->sportsRepository = $sportsRepository;
        $this->matchesRepository = $matchesRepository;
    }

    public function getSports()
    {
        $sports = $this->sportsRepository->getAll();

        return response()->json([
            'data' => $sports,
            'error' => false
        ],200);
    }

    public function getFeaturedGames()
    {
        $matches = $this->matchesRepository->getFeaturedGames();

        return response()->json([
            'data' => $matches,
            'error' => false
        ],200);
    }

    public function getUpcomingGames(Request $request)
    {
        $matches = $this->matchesRepository->getUpcomingGamesBySport($request->sport_id);

        return response()->json([
            'data' => $matches,
            'error' => false
        ],200);
    }
}