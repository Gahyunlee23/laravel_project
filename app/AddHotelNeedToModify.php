<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AddHotelNeedToModify
 *
 * @property int $id
 * @property int|null $admin_id TM 관리자 ID
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $status 상태
 * @property string|null $severity 심각성
 * @property string|null $model
 * @property string|null $target input, page 수정 필요 타겟
 * @property string|null $content 수정 필요 사항
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelNeedToModify onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereSeverity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelNeedToModify withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelNeedToModify withoutTrashed()
 * @mixin \Eloquent
 */
class AddHotelNeedToModify extends Model
{
    use SoftDeletes;
    protected $table = 'add_hotel_need_to_modifies';
    protected $guarded = [];

}
