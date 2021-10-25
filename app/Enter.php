<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Enter
 *
 * @property int $id
 * @property string $hotel_name 호텔 명
 * @property string $hotel_address 호텔 주소
 * @property string $hotel_web_address 호텔 웹 사이트
 * @property string $manager_name 담당자 명
 * @property string $manager_rank 담당자 직급
 * @property string $manager_email 담당자 이메일
 * @property string $manager_hp 담당자 연락처
 * @property string $status 처리 상태
 * @property string $progress 진행 상태
 * @property string $memo 메모
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Enter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Enter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Enter query()
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereHotelAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereHotelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereHotelWebAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereManagerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereManagerHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereManagerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereManagerRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereProgress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read string $created_time
 * @property-read string $uploaded_time
 * @property-read \App\EnterOption|null $option
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\EnterRoom[] $rooms
 * @property-read int|null $rooms_count
 */
class Enter extends Model
{
    protected $table = 'enters';

    protected $fillable = [
        'id',
        'hotel_name', 'hotel_address', 'hotel_web_address',
        'manager_name', 'manager_rank', 'manager_email', 'manager_hp',
        'status', 'progress', 'memo'
    ];

    public function getUploadedTimeAttribute(): string
    {
        Carbon::setLocale('ko');
        return $this->updated_at->diffForHumans();
    }
    public function getCreatedTimeAttribute(): string
    {
        Carbon::setLocale('ko');
        return $this->created_at->diffForHumans();
    }

    public function option(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(EnterOption::class,'enter_id','id');
    }
    public function rooms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EnterRoom::class,'enter_id','id');
    }
}
