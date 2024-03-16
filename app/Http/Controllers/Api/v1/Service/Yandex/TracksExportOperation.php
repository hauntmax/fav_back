<?php

namespace App\Http\Controllers\Api\v1\Service\Yandex;

use App\Http\Controllers\Controller;
use App\Services\Yandex\Music\Export\YandexTracksExportService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class TracksExportOperation extends Controller
{
    private YandexTracksExportService $yandexTracksExportService;

    public function __construct(YandexTracksExportService $yandexTracksExportService)
    {
        $this->yandexTracksExportService = $yandexTracksExportService;
    }

    /**
     * @throws GuzzleException
     */
    public function __invoke(Request $request, string $service)
    {
        $playListLink = $request->get('playlistLink');
        $user_id = $request->user()?->getKey();
        $export_tracks_file = $this->yandexTracksExportService->writeToFile($playListLink, $user_id);
        if ($export_tracks_file === null) {
            return response()->json([
                'error' => 'Something wrong while export playlist',
            ]);
        }

        return response()->download($export_tracks_file);
    }
}
