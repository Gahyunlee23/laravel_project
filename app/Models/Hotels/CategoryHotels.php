<?php

namespace App\Models\Hotels;

use App\Hotel;
use App\HotelOption;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Hotels\CategoryHotels
 *
 * @property int $id
 * @property int $upper_id 상위 모델 id
 * @property int|null $hotel_id 호텔 명 OR 호텔id
 * @property string|null $hotel_name 호텔 명 OR 호텔id
 * @property int|null $order 호텔 정렬 순
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $hotels
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryHotels newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryHotels newQuery()
 * @method static \Illuminate\Database\Query\Builder|CategoryHotels onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryHotels query()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryHotels whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryHotels whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryHotels whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryHotels whereHotelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryHotels whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryHotels whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryHotels whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryHotels whereUpperId($value)
 * @method static \Illuminate\Database\Query\Builder|CategoryHotels withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CategoryHotels withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $type
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryHotels whereType($value)
 */
class CategoryHotels extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $table = 'category_hotels';
    protected $guarded = [];


    public $appends = ['hotels'];

    public function getHotelsAttribute()
    {
        return HotelOption::where('title', 'like', '%'.$this->hotel_name.'%')
            ->whereDisable( 'N')->get();
    }
}
