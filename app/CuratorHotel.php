<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\CuratorHotel
 *
 * @property int $id
 * @property int $hotel_id 호텔 id
 * @property int $curator_id 큐레이터 id
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Curator $curator
 * @property-read \App\Hotel $hotel
 * @method static \Illuminate\Database\Eloquent\Builder|CuratorHotel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuratorHotel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuratorHotel query()
 * @method static \Illuminate\Database\Eloquent\Builder|CuratorHotel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuratorHotel whereCuratorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuratorHotel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuratorHotel whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuratorHotel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuratorHotel whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|CuratorHotel onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|CuratorHotel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CuratorHotel withoutTrashed()
 */
class CuratorHotel extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'hotel_id', 'curator_id'
    ];
    /* @array $appends */
    public $appends = [];

    public static function boot()
    {
        parent::boot();
    }

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class,'hotel_id','id');
    }
    public function curator(): BelongsTo
    {
        return $this->belongsTo(Curator::class,'curator_id','id');
    }
}
