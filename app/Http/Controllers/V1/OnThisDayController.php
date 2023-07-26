<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Repositories\WikiRepository;

class OnThisDayController extends Controller
{
    public function index(WikiRepository $wikiRepository): JsonResponse
    {
        $data = $wikiRepository->getToday();
        $titleUrl = $wikiRepository->genTitleUrl();
        return response()->json(compact('data', 'titleUrl'));
    }
}
