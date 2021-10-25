<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Term
 *
 * @property int $id
 * @property int|null $hotel_id 주문 id
 * @property int|null $sale_room_id 룸 할인 id
 * @property int|null $user_id user(관리자) id
 * @property string|null $block 잠금=1, 미잠금=0
 * @property string|null $type type 0=tour,1=hotel
 * @property int|null $reservation_count 주문 가능 개수
 * @property int|null $sale_count 판매 가능 개수
 * @property string $memo 메모
 * @property \Illuminate\Support\Carbon|null $start_dt 입주 dt
 * @property \Illuminate\Support\Carbon|null $end_dt 퇴실 dt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Hotel|null $hotel
 * @method static \Illuminate\Database\Eloquent\Builder|Term newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Term newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Term query()
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereBlock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereEndDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereReservationCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereSaleCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereSaleRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereStartDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereUserId($value)
 * @mixin \Eloquent
 * @property-read array $between_date
 */
class Term extends Model
{
    protected $table = 'terms';

    public $fillable = [
        'id', 'hotel_id', 'sale_room_id', 'user_id',
        'block', 'type',
        'reservation_count', 'sale_count',
        'memo',
        'start_dt', 'end_dt','between_date'
    ];

    /* @array $dates timestamp appends */
    protected $dates = ['start_dt','end_dt'];

    /* @array $appends */
    public $appends = ['between_date'];

    public function getBetweenDateAttribute(): array
    {
        return $this->generateDateRange($this->start_dt, $this->end_dt);
    }
    private function generateDateRange(Carbon $start_date, Carbon $end_date): array
    {
        $dates = [];
        for($date = $start_date; $date->lte($end_date); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }
        return $dates;
    }
    public function hotel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Hotel::class,'hotel_id','id');
    }
}
