<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Settlement
 *
 * @property int $id
 * @property int|null $payment_id
 * @property int|null $confirmation_id
 * @property int|null $admin_id 관리자 id
 * @property int|null $price 이전 판매금
 * @property int|null $add_price 추가금
 * @property int|null $calculate 정산금
 * @property string|null $memo 메모
 * @property string|null $calculate_memo
 * @property string|null $calculate_yn 정산 체크
 * @property string|null $save_dt 저장 시간 dt
 * @property string|null $mail_send_dt 메일 전송 체크 시간
 * @property string|null $calculate_dt 정산완료 체크 시간
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $admin
 * @property-read mixed $calculate_time
 * @property-read mixed $mail_send_time
 * @property-read string $uploaded_time
 * @property-read \App\Payment|null $payment
 * @property-read \App\HotelReservation|null $reservation
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement newQuery()
 * @method static \Illuminate\Database\Query\Builder|Settlement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereAddPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereCalculate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereCalculateDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereCalculateMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereCalculateYn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereConfirmationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereMailSendDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereSaveDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Settlement withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Settlement withoutTrashed()
 * @mixin \Eloquent
 */
class Settlement extends Model
{
    use SoftDeletes;

    protected $table = 'settlements';
    protected $guarded =[];

    /* @array $appends */
    public $appends = ['uploaded_time'];

    public function getUploadedTimeAttribute(): string
    {
        Carbon::setLocale('ko');
        return $this->updated_at->diffForHumans();
    }
    public function getMailSendTimeAttribute()
    {
        Carbon::setLocale('ko');
        if($this->mail_send_dt!==null){
            return Carbon::parse($this->mail_send_dt)->diffForHumans();
        }
    }
    public function getCalculateTimeAttribute()
    {
        Carbon::setLocale('ko');
        if($this->calculate_dt!==null){
            return Carbon::parse($this->calculate_dt)->diffForHumans();
        }
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class,'payment_id','id');
    }
    public function reservation(): \Illuminate\Database\Eloquent\Relations\HasOneThrough
    {
        /* Settlements 의 HasOneThrough
        1 : 최종 연결 HotelReservations
        2 : 중간 연결 Payments
        3 : 중간 연결 Payments key id = payments.id
        4 : 최종 연결 HotelReservations Key id = reservations.id
        5 : 중간 연결 Payments 와 relationship 을 위한 Settlements.payment_id
        6 : 최종 연결 HotelReservations 를 위한 secondLocalKey = payments.reservation_id
        */
        return $this->hasOneThrough(HotelReservation::class, Payment::class,
            'id', 'id', 'payment_id', 'reservation_id');
    }
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class,'admin_id','id');
    }
}
