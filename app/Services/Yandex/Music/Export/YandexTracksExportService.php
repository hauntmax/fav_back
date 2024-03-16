<?php

namespace App\Services\Yandex\Music\Export;

use App\Models\Service;
use App\Services\HttpClient\HttpClient;
use App\Services\Storage\FileService;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class YandexTracksExportService
{
    private FileService $fileService;

    public function __construct(
        FileService $fileService
    ) {
        $this->fileService = $fileService;
    }

    /**
     * @throws GuzzleException
     */
    public function list(string $playlistLink): array
    {
        $client = new HttpClient();
        $explodePlaylistLink = explode('/', $playlistLink);
        $owner = $explodePlaylistLink[4];
        $playlistId = $explodePlaylistLink[6];
        $linkToGetPlaylistTracks = "https://music.yandex.ru/handlers/playlist.jsx?owner={$owner}&kinds={$playlistId}";
        $playlistEndpointResult = $client->get($linkToGetPlaylistTracks, [
            'headers' => [
                'Cookie' => 'L=aRJWYgcBcWgGcHJZAmEAWGJfWXh9U1gGNBQiOAQVOSYPNw==.1702448802.15555.342651.3f55963f71ed8678bad7aed7f0d3482b;',
            ],
        ]);

        $playlistIds = Arr::get($playlistEndpointResult, 'playlist.trackIds');
        $playlistIds = implode(',', $playlistIds);

        $linkToGetTracksInfoByIds = "https://music.yandex.ru/handlers/track-entries.jsx";
        $tracks = $client->post($linkToGetTracksInfoByIds, [
            'form_params' => [
                'entries' => $playlistIds,
                'strict' => true,
                'removeDuplicates' => true,
                'lang' => 'ru',
            ],
            'headers' => [
                'Cookie' => 'L=aRJWYgcBcWgGcHJZAmEAWGJfWXh9U1gGNBQiOAQVOSYPNw==.1702448802.15555.342651.3f55963f71ed8678bad7aed7f0d3482b;',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ]
        ]);

        $result = [];
        foreach ($tracks as $track) {
            $artists = Arr::get($track, 'artists');
            $title = Arr::get($track, 'title');

            $artist_combined = null;
            foreach ($artists ?? [] as $artist) {
                $artist_combined .= Arr::get($artist, 'name', '') . ', ';
            }
            $artist_combined = $artist_combined ? trim($artist_combined, " \n\r\t\v\0,") : 'Unknown';
            $track_name = $artist_combined . ' - ' . $title;
            $result[] = $track_name;
//            $result[] = [
//                'artist' => $artist_combined,
//                'title' => $title,
//            ];
        }

        return $result;
    }

    /**
     * @throws GuzzleException
     */
    public function writeToFile(string $playlistLink, ?int $user_id = null): ?string
    {
        try {
            $tracks = $this->list($playlistLink);
            $exportFilePath = $this->fileService->mkdir(Service::YANDEX_SERVICE_NAME, $user_id);
            $exportPathWithName = $exportFilePath . '/' . $this->fileService->generateName(md5(time())) . '.csv';
            $writer = new YandexTracksCsvWriter($exportPathWithName);
            $data = [
                'data' => $tracks,
            ];
            return $writer->fill($data);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return null;
        }
    }
}
