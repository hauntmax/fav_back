<?php

namespace App\Http\Controllers\Api\v1\Service\Yandex;

use App\Services\Yandex\Music\Export\YandexTracksExportService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TracksListOperation
{
    private YandexTracksExportService $yandexTracksExportService;

    public function __construct(YandexTracksExportService $yandexTracksExportService)
    {
        $this->yandexTracksExportService = $yandexTracksExportService;
    }

    /**
     * @throws GuzzleException
     */
    public function __invoke(Request $request, string $service): JsonResponse
    {
        $playListLink = $request->get('playlistLink');
        $tracks = $this->yandexTracksExportService->list($playListLink);

        return response()->json($tracks);
    }
}
