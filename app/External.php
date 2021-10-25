<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\External
 *
 * @property-read string $uploaded_time
 * @method static \Illuminate\Database\Eloquent\Builder|External newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|External newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|External query()
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $hotel_id 호텔 id
 * @property int|null $reservation_id 주문 id
 * @property string|null $access_key 랜덤영어 자 = 해당 컬럼 접근 키 일치해야 접근가능
 * @property string|null $type 무슨 허용 사항인지 저장 ex] 입실확정 처리, 투어 확정처리 등
 * @property string|null $memo 설명 = 처리 내용 저장용
 * @property string|null $status 처리에 대한 status
 * @property \Illuminate\Support\Carbon|null $access_at 접근 가능 ~ dt
 * @property \Illuminate\Support\Carbon|null $access_end_at 이후 접근 불가 dt
 * @property \Illuminate\Support\Carbon|null $enter_at 외부 접근 > 처리 dt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|External whereAccessAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereAccessEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereEnterAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereAccessKey($value)
 * @property-read \App\Hotel|null $hotel
 * @property-read \App\HotelReservation|null $reservation
 * @property \Illuminate\Support\Carbon|null $click_at
 * @method static \Illuminate\Database\Eloquent\Builder|External whereClickAt($value)
 */
class External extends Model
{
    protected $table = 'externals';

    protected $fillable = [
        'hotel_id', 'reservation_id',
        'access_key', 'type',
        'memo', 'status',
        'access_at', 'access_end_at', 'enter_at', 'click_at',
        'created_at', 'updated_at'
    ];
    /* @array $appends */
    public $appends = ['uploaded_time'];

    /* @array $dates timestamp appends */
    protected $dates = ['access_at','access_end_at','enter_at','click_at'];

    public function getUploadedTimeAttribute(): string
    {
        return $this->updated_at->diffForHumans();
    }


    public function reservation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(HotelReservation::class,'reservation_id','id');
    }
    public function hotel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Hotel::class,'hotel_id','id');
    }
}
