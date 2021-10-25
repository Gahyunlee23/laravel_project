<?php

namespace App\Models\Hotels;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Hotels\Products
 *
 * @property int $id
 * @property int $category_id
 * @property string|null $title Product 메인 상세
 * @property string|null $sub_title Product 서브 상세
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Hotels\CategoryHotels[] $CategoryHotels
 * @property-read int|null $category_hotels_count
 * @method static \Illuminate\Database\Eloquent\Builder|Products newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products newQuery()
 * @method static \Illuminate\Database\Query\Builder|Products onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Products query()
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereSubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Products withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Products withoutTrashed()
 * @mixin \Eloquent
 */
class Products extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $table = 'products';
    protected $guarded = [];

    public function CategoryHotels(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CategoryHotels::class,'upper_id','id')->whereType('products')->orderBy('order');
    }
}
