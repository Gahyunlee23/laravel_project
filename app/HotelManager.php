<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\HotelManager
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $hotel_id
 * @property string|null $memo 메모
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Hotel|null $hotel
 * @property-read \App\Hotel|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|HotelManager newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelManager newQuery()
 * @method static \Illuminate\Database\Query\Builder|HotelManager onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelManager query()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelManager whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelManager whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelManager whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelManager whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelManager whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelManager whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelManager whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|HotelManager withTrashed()
 * @method static \Illuminate\Database\Query\Builder|HotelManager withoutTrashed()
 * @mixin \Eloquent
 */
class HotelManager extends Model
{
    use SoftDeletes;
    
    protected $table = 'hotel_managers';

    protected $guarded = [];/*모두 할당*/


    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class,'hotel_id','id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(Hotel::class,'user_id','id');
    }
}
