<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\hasOne;
use Illuminate\Support\Arr;

/**
 * App\HotelReservation
 *
 * @property int $id
 * @property int $hotel_id
 * @property string|null $room_id 한달살기 일 경우 룸 id
 * @property string $order_id 구매 ID 랜덤
 * @property string|null $curator_id 판매 큐레이터 ID
 * @property string|null $type 호텔투어=tour, 한달살기=month, 구독=subscribe
 * @property string|null $order_name 구매자 명
 * @property string|null $order_hp 구매자 연락처
 * @property string|null $order_email 구매자 이메일
 * @property string|null $use_terms Y,N 구매자 이용약관 동의 (필수)
 * @property string|null $order_privacy Y,N 구매자 개인정보 활용 동의 (필수)
 * @property string|null $order_marketing Y,N 마케팅 동의
 * @property string|null $order_status 1=진행중, 2=주문완료, 3=결제완료, 4=사용완료, 5=입주중, 8=결제시도, 9=보류, 0=취소상태
 * @property string|null $order_price 원가
 * @property string|null $order_sale_price 판매금액
 * @property string|null $order_discount_rate 할인률
 * @property string|null $order_refund_amount 취소시 환불
 * @property string|null $order_sale_url 구매 링크
 * @property string|null $order_desired_dt 희망 날자
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Confirmation|null $confirmation
 * @property-read \App\Curator|null $curator
 * @property-read string $uploaded_time
 * @property-read \App\Hotel $hotel
 * @property-read \App\Payment|null $payment
 * @property-read \App\HotelRoom|null $room
 * @method static Builder|HotelReservation newModelQuery()
 * @method static Builder|HotelReservation newQuery()
 * @method static Builder|HotelReservation query()
 * @method static Builder|HotelReservation whereCreatedAt($value)
 * @method static Builder|HotelReservation whereCuratorId($value)
 * @method static Builder|HotelReservation whereHotelId($value)
 * @method static Builder|HotelReservation whereId($value)
 * @method static Builder|HotelReservation whereOrderDesiredDt($value)
 * @method static Builder|HotelReservation whereOrderDiscountRate($value)
 * @method static Builder|HotelReservation whereOrderEmail($value)
 * @method static Builder|HotelReservation whereOrderHp($value)
 * @method static Builder|HotelReservation whereOrderId($value)
 * @method static Builder|HotelReservation whereOrderMarketing($value)
 * @method static Builder|HotelReservation whereOrderName($value)
 * @method static Builder|HotelReservation whereOrderPrice($value)
 * @method static Builder|HotelReservation whereOrderPrivacy($value)
 * @method static Builder|HotelReservation whereOrderRefundAmount($value)
 * @method static Builder|HotelReservation whereOrderSalePrice($value)
 * @method static Builder|HotelReservation whereOrderSaleUrl($value)
 * @method static Builder|HotelReservation whereOrderStatus($value)
 * @method static Builder|HotelReservation whereRoomId($value)
 * @method static Builder|HotelReservation whereType($value)
 * @method static Builder|HotelReservation whereUpdatedAt($value)
 * @method static Builder|HotelReservation whereUseTerms($value)
 * @mixin \Eloquent
 * @method static Builder|HotelReservation orWhereLike($column, $value)
 * @method static Builder|HotelReservation whereLike($column, $value)
 * @property string|null $browser 사용자 브라우저
 * @property string|null $device 사용자 디바이스
 * @property string|null $os 사용자 os
 * @method static Builder|HotelReservation whereBrowser($value)
 * @method static Builder|HotelReservation whereDevice($value)
 * @method static Builder|HotelReservation whereOs($value)
 * @property int|null $term_id 신청 기간 id
 * @method static Builder|HotelReservation whereTermId($value)
 * @property int $room_type_id 고객 선택 입주 룸 타입
 * @method static Builder|HotelReservation whereRoomTypeId($value)
 * @property int|null $room_type_upgrade_id 고객 선택 입주 룸 업그레이드 id
 * @method static Builder|HotelReservation whereRoomTypeUpgradeId($value)
 * @property string|null $purpose 입주 목적
 * @property string|null $visit_route 방문 경로
 * @property-read string|null $room_type_name
 * @property-read string|null $room_type_upgrade_name
 * @method static Builder|HotelReservation wherePurpose($value)
 * @method static Builder|HotelReservation whereVisitRoute($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AlertTalkList[] $alertTalkLists
 * @property-read int|null $alert_talk_lists_count
 * @property-read \App\customerExperiences|null $customerExperience
 * @property int $user_id 회원 ID
 * @property-read int $payment_count
 * @property-read \App\HotelRoomType|null $roomType
 * @method static Builder|HotelReservation whereUserId($value)
 * @property-read \App\User|null $user
 * @property-read \App\External|null $external
 * @property-read \App\HotelRoomType|null $roomTypeUpgrade
 * @property string|null $read_at 읽은 시간
 * @method static Builder|HotelReservation whereReadAt($value)
 * @property string|null $country_code 국가 코드
 * @property-read \App\ReservationCancel|null $reservationCancel
 * @property-read \App\ReservationModify|null $reservationModify
 * @method static Builder|HotelReservation whereCountryCode($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Confirmation[] $confirmations
 * @property-read int|null $confirmations_count
 * @property-read mixed $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Payment[] $payments
 * @property-read int|null $payments_count
 * @method static Builder|HotelReservation statusFlitter($flitter)
 * @property-read \App\NoShow|null $noShow
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\NoShow[] $noShows
 * @property-read int|null $no_shows_count
 */
class HotelReservation extends Model
{
    protected $table = 'reservations';

    public $fillable = [
        'id', 'user_id', 'hotel_id', 'order_id', 'room_id', 'curator_id', 'room_type_id', 'room_type_upgrade_id',
        'type', 'purpose', 'visit_route',
        'order_name', 'order_hp', 'country_code', 'order_email',
        'use_terms', 'order_privacy', 'order_marketing', 'order_status',
        'order_price', 'order_sale_price', 'order_discount_rate', 'order_refund_amount', 'order_sale_url',
        'order_desired_dt', 'created_at', 'updated_at', 'read_at',
        'browser', 'device', 'os'
    ];

    /* @array $appends */
    public $appends = ['uploaded_time', 'room_type_name', 'room_type_upgrade_name'];

    public function getPaymentCountAttribute(): int
    {
        return Payment::whereReservationId($this->id)->count();
    }

    public function getUploadedTimeAttribute(): string
    {
        Carbon::setLocale('ko');
        return $this->updated_at->diffForHumans();
    }

    public function getRoomTypeNameAttribute(): ?string
    {
        if (isset($this->room_type_id)) {
            return HotelRoomType::find($this->room_type_id)->name;
        }
        return null;
    }

    public function getRoomTypeUpgradeNameAttribute(): ?string
    {
        if (isset($this->room_type_upgrade_id)) {
            return HotelRoomType::find($this->room_type_upgrade_id)->name;
        }
        return null;
    }

    public function getStatusAttribute()
    {
        if($this->type === 'month'){
            if($this->order_status === '3' || $this->order_status === '5'){
                if(!isset($this->confirmation) && isset($this->payment) && $this->payment->status === '3'){
                    return '입주 확정 필요';
                }
                if(isset($this->confirmation, $this->payment) && $this->confirmation->status === '1' && $this->payment->status === '3'){
                    if(Carbon::parse($this->confirmation->start_dt) < now() && Carbon::parse($this->confirmation->end_dt) > now()){
                        return '입주 중';
                    }
//                    if(Carbon::parse($this->confirmation->start_dt)->between(now(), now()->addDays(3))){
//                        return '입주 예정';
//                    }
                    if(Carbon::parse($this->confirmation->start_dt) > now()){
                        return '입주 확정';
                    }
                    if(Carbon::parse($this->confirmation->end_dt) <= now()){
                        return '퇴실 완료';
                    }
                }

                return '결제 완료';
            }
            if($this->order_status === '0' || $this->order_status === '10' || $this->order_status === '11') {
                if( ((!isset($this->payment)) || (isset($this->payment) && ($this->payment->status==='0' || $this->payment->status==='10')))
                    || ((!isset($this->confirmation)) || (isset($this->confirmation) && $this->confirmation->status==='0')) ){
                    return '입주 취소';
                }
            }
        }else if($this->type === 'tour'){
            if(isset($this->noShow)){
                return '투어 노쇼';
            }
            if ($this->order_status === '2' || $this->order_status === '3' || $this->order_status === '5') {
                if(!isset($this->confirmation)){
                    return '투어 확정 필요';
                }
                if(isset($this->confirmation) && $this->confirmation->status === '1'){
//                    if(Carbon::parse($this->confirmation->start_dt)->between(now(), now()->addDays(3))){
//                        return '투어 예정';
//                    }
                    if(Carbon::parse($this->confirmation->start_dt) > now()){
                        return '투어 확정';
                    }
                    if(Carbon::parse($this->confirmation->start_dt) <= now()){
                        return '투어 완료';
                    }
                }
                return '투어 신청';
            }
            if($this->order_status === '0' || $this->order_status === '10' || $this->order_status === '11') {
                if(((!isset($this->confirmation)) || (isset($this->confirmation) && $this->confirmation->status==='0')) ){
                    return '투어 취소';
                }
            }
        }
        return '진행중';
    }

    public function scopeStatusFlitter($query, $flitter)
    {
        if ($flitter !== '' && $flitter !== null) {
            switch ($flitter) {
                case '주문' :
                    $query->where(function ($query) {
                        $query->where('type', '=', 'month')
                            ->whereIn('order_status', ['3', '5']);
                    })->orWhere(function ($query) {
                        $query->where('type', '=', 'tour')
                            ->whereIn('order_status', ['2', '3', '5']);
                    });
                    break;
                case '확정 필요' :
                    $query
                        ->where(function ($query) {
                            $query->where('type', '=', 'month')
                                ->has('external')
                                ->doesntHave('confirmation')
                                ->whereIn('order_status', ['3', '5'])
                                ->whereHas('payment', function ($q) {
                                    $q->where('status', '=', '3');
                                });
                        })->orWhere(function ($query) {
                            $query->where('type', '=', 'tour')
                                ->whereHas('external', function ($q){
                                    $q->where('status', '=', 0);
                                })
                                ->doesntHave('confirmation')
                                ->whereIn('order_status', ['2', '3', '5']);
                        });
                    break;
                case '확정' :
                    $query
                        ->where(function ($query) {
                            $query->where('type', '=', 'month')
                                ->whereIn('order_status', ['3', '5'])
                                ->whereHas('confirmation', function ($q) {
                                    $q->where('status', '=', '1')
                                        ->where('start_dt', '>', now());
                                })
                                ->whereHas('payment', function ($q) {
                                    $q->where('status', '=', '3');
                                });
                        })->orWhere(function ($query) {
                            $query->where('type', '=', 'tour')
                                ->whereIn('order_status', ['2', '3', '5'])
                                ->whereHas('confirmation', function ($q) {
                                    $q->where('status', '=', '1')
                                        ->where('start_dt', '>', now());
                                });
                        });
                    break;
                case '예정' :
                    $query
                        ->where(function ($query) {
                            $query->where('type', '=', 'month')
                                ->whereIn('order_status', ['3', '5'])
                                ->whereHas('payment', function ($q) {
                                    $q->where('status', '=', '3');
                                })->whereHas('confirmation', function ($q) {
                                    $q->where('status', '=', '1')
                                        ->whereBetween('start_dt', [now(), now()->addDays(3)]);
                                });
                        })->orWhere(function ($query) {
                            $query->where('type', '=', 'tour')
                                ->whereIn('order_status', ['2', '3', '5'])
                                ->whereHas('confirmation', function ($q) {
                                    $q->where('status', '=', '1')
                                        ->whereBetween('start_dt', [now(), now()->addDays(3)]);
                                });
                        });
                    break;
                case '취소' :
                    $query
                        ->where(function ($query) {
                            $query->where('type', '=', 'month')
                                ->whereNotIn('order_status', ['1','2'])
                                ->where(function ($q){
                                    $q->orWhere('order_status', '=', '0')
                                        ->orWhere('order_status', '=', '10')
                                        ->orWhere('order_status', '=', '11');
                                })
                                ->whereHas('payment', function ($q) {
                                    $q->orWhere('status', '=', '0')
                                        ->orWhere('status', '=', '10');
                                })->whereHas('confirmation', function ($q) {
                                    $q->orWhere('status', '=', '0');
                                });
                        })->orWhere(function ($query) {
                            $query->where('type', '=', 'tour')
                                ->whereNotIn('order_status', ['1','2'])
                                ->where(function ($q){
                                    $q->orWhere('order_status', '=', '0')
                                        ->orWhere('order_status', '=', '10')
                                        ->orWhere('order_status', '=', '11');
                                })
                                ->whereHas('confirmation', function ($q) {
                                    $q->orWhere('status', '=', '0');
                                });
                        });
                    break;
                case '완료' :
                    $query

                        ->where(function ($query) {
                            $query->where('type', '=', 'month')->doesntHave('noShow')
                                ->whereIn('order_status', ['3', '5'])
                                ->whereHas('payment', function ($q) {
                                    $q->where('status', '=', '3');
                                })->whereHas('confirmation', function ($q) {
                                    $q->where('status', '=', '1')
                                        ->where('end_dt', '<=', now());
                                });
                        })->orWhere(function ($query) {
                            $query->where('type', '=', 'tour')->doesntHave('noShow')
                                ->whereIn('order_status', ['2', '3', '5'])
                                ->whereHas('confirmation', function ($q) {
                                    $q->where('status', '=', '1')
                                        ->where('start_dt', '<=', now());
                                });
                        });
                    break;
                case '입주 중' :
                    $query
                        ->where(function ($query) {
                            $query->where('type', '=', 'month')
                                ->whereIn('order_status', ['3', '5'])
                                ->whereHas('payment', function ($q) {
                                    $q->where('status', '=', '3');
                                })->whereHas('confirmation', function ($q) {
                                    $q->where('status', '=', '1')
                                        ->where('start_dt', '<', now())
                                        ->where('end_dt', '>', now());
                                });
                        });
                    break;
                case '투어 노쇼' :
                    $query->has('noShow');
                    break;
            }
        }
        return $query;
    }

    public function scopeWhereLike($query, $column, $value)
    {
        return $query->where($column, 'like', '%' . $value . '%');
    }

    public function scopeOrWhereLike($query, $column, $value)
    {
        return $query->orWhere($column, 'like', '%' . $value . '%');
    }

    public function isMonth(): bool
    {
        return $this->type === 'month';
    }

    public function isTour(): bool
    {
        return $this->type === 'tour';
    }


    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(HotelRoom::class, 'room_id', 'id');
    }

    public function roomType(): BelongsTo
    {
        return $this->belongsTo(HotelRoomType::class, 'room_type_id', 'id');
    }

    public function roomTypeUpgrade(): BelongsTo
    {
        return $this->belongsTo(HotelRoomType::class, 'room_type_upgrade_id', 'id');
    }

    public function curator(): BelongsTo
    {
        return $this->belongsTo(Curator::class, 'curator_id', 'id');
    }

    public function payment(): hasOne
    {
        return $this->hasOne(Payment::class, 'reservation_id', 'id')->latest();
    }
    public function payments(): hasMany
    {
        return $this->hasMany(Payment::class, 'reservation_id', 'id');
    }

    public function confirmation(): hasOne
    {
        /* Confirmation=입주자 정보 디비의 reservation_id 컬럼값을 = hotel_reservation.id 와 비교하여 Join */
        return $this->hasOne(Confirmation::class, 'reservation_id', 'id')->latest();
    }

    public function confirmations(): HasMany
    {
        return $this->hasMany(Confirmation::class, 'reservation_id', 'id');
    }

    public function customerExperience(): hasOne
    {
        return $this->hasOne(CustomerExperiences::class, 'reservation_id', 'id');
    }

    public function user(): hasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function external(): hasOne
    {
        return $this->hasOne(External::class, 'reservation_id', 'id')->latest();
    }

    public function reservationCancel(): hasOne
    {
        return $this->hasOne(ReservationCancel::class, 'reservation_id', 'id');
    }

    public function reservationModify(): hasOne
    {
        return $this->hasOne(ReservationModify::class, 'reservation_id', 'id');
    }

    public function alertTalkLists(): HasMany
    {
        return $this->hasMany(AlertTalkList::class, 'reservation_id', 'id');
    }
    public function noShow(): HasOne
    {
        return $this->hasOne(NoShow::class, 'reservation_id', 'id')->latest();
    }
    public function noShows(): HasMany
    {
        return $this->HasMany(NoShow::class, 'reservation_id', 'id');
    }
}
