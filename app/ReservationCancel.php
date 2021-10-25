<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\ReservationCancel
 *
 * @property int $id
 * @property int|null $reservation_id
 * @property int|null $user_id
 * @property int|null $admin_id
 * @property string|null $process 진행 상태 1=신청 2=확인중 3=승인 4=미승인 0=취소
 * @property string|null $memo 전송내용
 * @property string|null $send_dt 신청 dt
 * @property string|null $process_dt 처리 시간 dt
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $admin
 * @property-read \App\HotelReservation|null $reservation
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel newQuery()
 * @method static \Illuminate\Database\Query\Builder|ReservationCancel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereProcess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereProcessDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereSendDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|ReservationCancel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ReservationCancel withoutTrashed()
 * @mixin \Eloquent
 */
class ReservationCancel extends Model
{
    use SoftDeletes;

    protected $table = 'reservation_cancels';

    public $fillable = [
        'id', 'reservation_id', 'user_id', 'admin_id',
        'process', 'memo',
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
