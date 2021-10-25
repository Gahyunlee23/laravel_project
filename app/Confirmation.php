<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Confirmation
 *
 * @property int $id
 * @property int|null $reservation_id 주문 id
 * @property int|null $payment_id 결제 id
 * @property int|null $user_id user(관리자) id
 * @property \Illuminate\Support\Carbon|null $start_dt 입주 dt
 * @property \Illuminate\Support\Carbon|null $end_dt 퇴실 dt
 * @property string|null $add_days 추가 일수
 * @property string $memo 메모
 * @property string|null $status 0=취소, 1=기본
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereAddDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereEndDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereStartDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $before_3day 입실 3일전 알림톡 전송 처리 0=미전송, 1=전송완료 / 1로 설정시 발신안됨
 * @property string|null $before_1day 입실 1일전 알림톡 전송 처리 0=미전송, 1=전송완료 / 1로 설정시 발신안됨
 * @property string|null $last_3day 퇴실 3일전 알림톡 전송 처리 0=미전송, 1=전송완료 / 1로 설정시 발신안됨
 * @property string|null $last_1day 퇴실 1일전 알림톡 전송 처리 0=미전송, 1=전송완료 / 1로 설정시 발신안됨
 * @property string|null $after_1day 퇴실 1일 후 알림톡 전송 처리 0=미전송, 1=전송완료 / 1로 설정시 발신안됨
 * @property string|null $after_3day 퇴실 3일 후 알림톡 전송 처리 0=미전송, 1=전송완료 / 1로 설정시 발신안됨
 * @property-read string $start_end_diff_date
 * @property-read string $uploaded_time
 * @property-read \App\Payment|null $payment
 * @property-read \App\HotelReservation|null $reservation
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereAfter1day($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereAfter3day($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereBefore1day($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereBefore3day($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereLast1day($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereLast3day($value)
 * @property string|null $type 투어,입주 타입 구분 체크
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereType($value)
 * @property string|null $end_1day 퇴실 1일 후 알림톡 전송 처리 0=미전송, 1=전송완료 / 1로 설정시 발신안됨
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereEnd1day($value)
 * @property string|null $room_type
 * @property string|null $tour_after 투어 후 알림톡
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereRoomType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereTourAfter($value)
 * @property string|null $add_memo 추가 일수 저장
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereAddMemo($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AlertTalkList[] $alertTalkLists
 * @property-read int|null $alert_talk_lists_count
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|Confirmation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereAddDaysSchedule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereEndScheduleDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereStartScheduleDt($value)
 * @method static \Illuminate\Database\Query\Builder|Confirmation withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Confirmation withoutTrashed()
 * @property string|null $start_schedule_dt 변경 예정, 또는 신청중인
 * @property string|null $end_schedule_dt 변경 예정, 또는 신청중인
 * @property string|null $add_days_schedule 변경 예정 또는 신청중인 추가일수
 */
class Confirmation extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'confirmations';

    public $fillable = [
        'id','reservation_id','payment_id','user_id',
        'start_dt', 'end_dt', 'add_days',
        'memo', 'add_memo', 'status', 'type','room_type',
        'tour_after','before_1day', 'before_3day', 'last_3day', 'last_1day', 'after_1day', 'after_3day',
        'created_at', 'updated_at'
    ];

    /* @array $appends */
    public $appends = ['uploaded_time','start_end_diff_date'];

    public function getUploadedTimeAttribute(): string
    {
        return $this->updated_at->diffForHumans();
    }
    public function getStartEndDiffDateAttribute(): string
    {
        $formatted_dt1=Carbon::parse($this->start_dt);

        $formatted_dt2=Carbon::parse($this->end_dt);
        return $formatted_dt1->diffInDays($formatted_dt2);
    }

    public function reservation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(HotelReservation::class, 'reservation_id','id');
    }
    public function payment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Payment::class, 'payment_id','id');
    }
    public function alertTalkLists(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AlertTalkList::class, 'confirmation_id','id');
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
