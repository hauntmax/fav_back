<?php

namespace App\Common;

use App\DTO\IndexRequestDto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

trait CrudTrait
{
    abstract public function getBuilder(): Builder;

    public function getPaginated(IndexRequestDto $indexRequestDto, ?int $authorId = null): LengthAwarePaginator
    {
        $builder = $this->getBuilder();

        if (!is_null($authorId)) {
            $builder->where('user_id', $authorId);
        }

        $page = $indexRequestDto->page ?? null;
        $perPage = $indexRequestDto->perPage ?? null;

        return $builder->paginate(perPage: $perPage, page: $page);
    }
}
