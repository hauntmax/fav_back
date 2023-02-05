<?php

namespace App\Models;

use App\Abstract\Authorable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * @property int product_id
 * @property int user_id
 * @property string name
 * @property string description
 * @property float price
 * @property Collection categories
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class Product extends Model implements Authorable
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'categories_products',
            'product_id',
            'category_id'
        );
    }

    public function getAuthorIdentifier(): int
    {
        return $this->user_id;
    }
}
