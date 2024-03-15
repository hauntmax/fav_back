<?php

namespace App\Http\Controllers\Api\v1\TracksExport;

use App\Services\Music\Export\YandexTracksExportService;
use Illuminate\Http\Request;

class TracksExportOperation
{
    private YandexTracksExportService $yandexTracksExportService;

    public function __construct(YandexTracksExportService $yandexTracksExportService)
    {
        $this->yandexTracksExportService = $yandexTracksExportService;
    }

    public function __invoke(Request $request, string $service)
    {
        $playListLink = $request->get('playlistLink');
        $tracks = $this->yandexTracksExportService->export($playListLink);

        return response()->json($tracks);
    }
}
