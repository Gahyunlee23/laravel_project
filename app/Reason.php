<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Reason
 *
 * @property int $id
 * @property int|null $admin_id Tm 관리자 ID
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $type 종류 : 입점신청, 이외 계약, 이벤트 등
 * @property string|null $explanation 사유 180자 이하
 * @property string|null $sub_explanation 사유 설명 180자 이하
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $admin
 * @property-read \App\AddHotel|null $hotel
 * @property-read \App\User|null $manager
 * @method static \Illuminate\Database\Eloquent\Builder|Reason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reason newQuery()
 * @method static \Illuminate\Database\Query\Builder|Reason onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Reason query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereSubExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Reason withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Reason withoutTrashed()
 * @mixin \Eloquent
 */
class Reason extends Model
{
    use SoftDeletes;
    protected $table = 'reasons';
    protected $guarded = [];
    
    public function admin(): HasOne
    {
        return $this->hasOne(User::class,'id','admin_id');
    }
    public function manager(): HasOne
    {
        return $this->hasOne(User::class,'id','hotel_manager_id');
    }
    public function hotel(): HasOne
    {
        return $this->hasOne(AddHotel::class,'id','add_hotel_id');
    }
}
