<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\ReservationModify
 *
 * @property int $id
 * @property int|null $reservation_id
 * @property int|null $user_id
 * @property int|null $admin_id
 * @property string|null $process 진행 상태 1=신청 2=문의중 3=확정 4=미확정(재문의)
 * @property string|null $diff_day
 * @property string|null $memo 전송내용
 * @property string|null $before_start_dt
 * @property string|null $before_end_dt
 * @property string|null $start_dt 신청 기간 dt
 * @property string|null $end_dt 신청 기간 dt
 * @property string|null $send_dt 신청 dt
 * @property string|null $process_dt 처리 시간 dt
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $admin
 * @property-read \App\HotelReservation|null $reservation
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify newQuery()
 * @method static \Illuminate\Database\Query\Builder|ReservationModify onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereBeforeEndDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereBeforeStartDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereDiffDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereEndDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereProcess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereProcessDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereSendDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereStartDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|ReservationModify withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ReservationModify withoutTrashed()
 * @mixin \Eloquent
 */
class ReservationModify extends Model
{
    use SoftDeletes;

    protected $table = 'reservation_modify';

    public $fillable = [
        'id', 'reservation_id', 'user_id', 'admin_id',
        'process', 'memo',
        'diff_day',
        'before_start_dt', 'before_end_dt',
        'start_dt', 'end_dt',
        'send_dt', 'process_dt', 'deleted_at',
        'created_at', 'updated_at'
    ];

    public function reservation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(HotelReservation::class);
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function admin(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
