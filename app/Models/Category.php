<?php

namespace App\Models;

use App\Abstract\Authorable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int category_id
 * @property int user_id
 * @property string name
 * @property string description
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class Category extends Model implements Authorable
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'categories_products',
            'category_id',
            'product_id'
        );
    }

    public function getAuthorIdentifier(): int
    {
        return $this->user_id;
    }
}
