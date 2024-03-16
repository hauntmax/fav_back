<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\Yandex\Music\Export\YandexTracksExportService;
use Illuminate\Http\Request;

class YandexServiceController extends Controller
{
    private YandexTracksExportService $yandexTracksExportService;

    public function __construct(YandexTracksExportService $yandexTracksExportService)
    {
        $this->yandexTracksExportService = $yandexTracksExportService;
    }

    public function show()
    {
        return view('user.services.yandex');
    }

    public function list()
    {

    }

    public function export(Request $request)
    {
        $playListLink = $request->get('playlistLink');
        $user_id = $request->user()?->getKey();
        $export_tracks_file = $this->yandexTracksExportService->writeToFile($playListLink, $user_id);
        if ($export_tracks_file === null) {
            return redirect()->back()->withErrors([
                'Something wrong while export playlist',
            ]);
        }

        return response()->download($export_tracks_file);
    }
}
