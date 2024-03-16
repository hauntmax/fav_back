<?php

namespace App\Services\Yandex\Music\Export;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class YandexTracksCsvWriter
{
    private string $filepath;

    public function __construct(string $filepath)
    {
        $this->filepath = $filepath;
    }

    public function fill(array $data): ?string
    {
        try {
            $resource = fopen($this->filepath, 'w');
            $rows = Arr::get($data, 'data');
            foreach ($rows as $row) {
                fputcsv($resource, [$row]);
            }

            return $this->filepath;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return null;
        }
    }
}
