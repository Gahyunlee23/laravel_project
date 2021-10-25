<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AddHotelLog
 *
 * @property int $id
 * @property int $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 처리 호텔 매니저 ID
 * @property int|null $admin_id 처리 관리자 ID
 * @property string|null $old_status 이전 상태
 * @property string|null $status 현 상태
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelLog newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelLog onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelLog whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelLog whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelLog whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelLog whereOldStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelLog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelLog withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelLog withoutTrashed()
 * @mixin \Eloquent
 */
class AddHotelLog extends Model
{
    use SoftDeletes;

    protected $table = 'add_hotel_logs';
    protected $guarded = [];

    public function amuseLog($prop){

        AddHotelLog::create([
            'add_hotel_id'=>$prop['add_hotel_id'],
            'hotel_manager_id'=>$prop['hotel_manager_id'],
            'admin_id'=>$prop['admin_id'],
            'old_status'=>$prop['old_status'],
            'status' => $prop['status']
        ]);


    }
}
