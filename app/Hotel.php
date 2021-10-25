<?php

namespace App;

use App\Models\HotelUsePrecaution;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * App\Hotel
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $status 0-삭제, 1-미오픈, 2-오픈
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelFaq[] $faqs
 * @property-read int|null $faqs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelOption[] $options
 * @property-read int|null $options_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelRoom[] $rooms
 * @property-read int|null $rooms_count
 * @method static Builder|Hotel newModelQuery()
 * @method static Builder|Hotel newQuery()
 * @method static Builder|Hotel query()
 * @method static Builder|Hotel whereCreatedAt($value)
 * @method static Builder|Hotel whereId($value)
 * @method static Builder|Hotel whereStatus($value)
 * @method static Builder|Hotel whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|HotelReservation[] $reservations
 * @property-read int|null $reservations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelCheckPoint[] $checkPoints
 * @property-read int|null $check_points_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelRoom[] $roomTypes
 * @property-read int|null $roomTypes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelRoom[] $visibleRoomTypes
 * @property-read int|null $visibleRoomTypes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelRoom[] $room_types
 * @property-read int|null $room_types_count
 * @property string|null $order 정렬
 * @method static Builder|Hotel whereOrder($value)
 * @property string|null $info_notion 알림톡]입주 설명서
 * @property string|null $email 호텔 관리자 이메일
 * @method static Builder|Hotel whereEmail($value)
 * @method static Builder|Hotel whereInfoNotion($value)
 * @property string|null $tour_start 투어 가능 시작 시간
 * @property string|null $tour_end 투어 가능 끝 시간
 * @property-read int $completed_reservation_count
 * @property-read int $reservation_count
 * @method static Builder|Hotel whereTourEnd($value)
 * @method static Builder|Hotel whereTourStart($value)
 * @property string|null $tour_email 호텔 투어 관리자 이메일
 * @method static Builder|Hotel whereTourEmail($value)
 * @property string|null $admin_email 테스트용 관리자 메일 (,)배열
 * @method static Builder|Hotel whereAdminEmail($value)
 * @property-read Collection $admin_emails
 * @property-read Collection $living_emails
 * @property-read Collection $tour_emails
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Term[] $terms
 * @property-read int|null $terms_count
 * @property string|null $other_hotel 호텔 상세 > 이외 호텔
 * @property-read Collection $other_hotels
 * @method static Builder|Hotel whereOtherHotel($value)
 * @property-read \App\HotelCancellation|null $cancellationPolicy
 * @property-read \App\HotelOption|null $option
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelReview[] $reviews
 * @property-read int|null $reviews_count
 * @property-read int $completed_reservation_month_count
 * @property-read int $completed_reservation_tour_count
 * @property-read int $confirmation_month_count
 * @property-read int $confirmation_tour_count
 * @property-read int $hotel_total_price
 * @property-read int $live_end_count
 * @property-read int $living_count
 * @property-read int $reservation_month_count
 * @property-read int $reservation_tour_count
 * @property-read Collection $image_first_explode
 * @property-read \App\HotelImage|null $image_first
 * @property string|null $advantage 장점 리스트
 * @property-read Collection $advantages
 * @method static Builder|Hotel whereAdvantage($value)
 * @property-read int $sale_possibility_sum
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelSorts[] $sorts
 * @property-read int|null $sorts_count
 * @property string|null $curator 큐레이터 체크
 * @property string|null $star 성급
 * @property string|null $grade 등급
 * @property-read string $image_first_one
 * @property-read string $image_first_one_position_y
 * @property-read string $low_price
 * @property-read string $maximum_price
 * @method static Builder|Hotel curator($curator)
 * @method static Builder|Hotel whereCurator($value)
 * @method static Builder|Hotel whereGrade($value)
 * @method static Builder|Hotel whereStar($value)
 * @property string|null $hashtag
 * @property-read int $curator_check
 * @property-read Collection $hashtags
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PeriodPrice[] $period_prices
 * @property-read int|null $period_prices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Scheduler[] $schedulers
 * @property-read int|null $schedulers_count
 * @method static Builder|Hotel whereHashtag($value)
 * @property-read \App\HotelRoom|null $room
 * @property-read int|null $visible_room_types_count
 * @property-read \Illuminate\Database\Eloquent\Collection|HotelUsePrecaution[] $UsePrecautions
 * @property-read int|null $use_precautions_count
 */
class Hotel extends Model
{
    protected $fillable = [
        'id',
        'star', 'grade', 'curator',
        'order','status','info_notion', 'other_hotel',
        'email','tour_email','admin_email','advantage', 'hashtag'
    ];
    /* @array $appends */
    public $appends = ['tour_emails','living_emails','admin_emails','advantages'];

    public static function boot()
    {
        parent::boot();
    }

    public function scopeCurator($query, $curator){
        if($curator && $curator->curatorHotels->count() >= 1) {
            return $query->where(function($query) use ($curator){
                $query->where('curator','=','Y')
                ->whereIn('id', $curator->curatorHotels->pluck('hotel_id'));
            });
        }
        return $query->where('curator','=','N');
    }

    /* 호텔별 주문 신청 개수 */
    public function getReservationCountAttribute(): int
    {
        return HotelReservation::whereHotelId($this->id)->count();
    }
    /* 투어 신청자 */
    public function getReservationTourCountAttribute(): int
    {
        return HotelReservation::whereHotelId($this->id)->whereType('tour')->count();
    }
    /* 입주 신청자 */
    public function getReservationMonthCountAttribute(): int
    {
        return HotelReservation::whereHotelId($this->id)->whereType('month')->count();
    }
    /* 주문 신청리스트 */
    public function getCompletedReservationCountAttribute(): int
    {
        return HotelReservation::whereHotelId($this->id)->where(function($query){
            $query->where('order_status','=','2')->orwhere('order_status','=','3')->orwhere('order_status','=','4')->orwhere('order_status','=','5');
        })->count();
    }
    /* 투어 신청 */
    public function getCompletedReservationTourCountAttribute(): int
    {
        return HotelReservation::whereHotelId($this->id)->whereType('tour')->where(function($query){
            $query->where('order_status','=','2')->orwhere('order_status','=','3')->orwhere('order_status','=','4')->orwhere('order_status','=','5');
        })->count();
    }
    /* 투어 확정 */
    public function getConfirmationTourCountAttribute(): int
    {
        return HotelReservation::whereHotelId($this->id)->whereType('tour')->whereHas('Confirmation', function ($q) {
            $q->where('status', '=', '1');
        })->count();
    }
    /* 입주 신청*/
    public function getCompletedReservationMonthCountAttribute(): int
    {
        return HotelReservation::whereHotelId($this->id)->whereType('month')->where(function($query){
            $query->where('order_status','=','2')->orwhere('order_status','=','3')->orwhere('order_status','=','4')->orwhere('order_status','=','5');
        })->count();
    }
    /* 입주 확정 */
    public function getConfirmationMonthCountAttribute(): int
    {
        return HotelReservation::whereHotelId($this->id)->whereType('month')->whereHas('Confirmation', function ($q) {
            $q->where('status', '=', '1');
        })->count();
    }
    /* 입주중 인원*/
    public function getLivingCountAttribute(): int
    {
        return HotelReservation::whereHotelId($this->id)->whereType('month')->where(function($query){
            $query->where('order_status','!=','0')->where('order_status','!=','1')->where('order_status','!=','2');
        })->whereHas('confirmation', function ($query) {
            $query->where('start_dt', '<=', Carbon::now()->format('Y-m-d H:i:s'));
            $query->where('end_dt', '>=', Carbon::now()->format('Y-m-d H:i:s'));
        })->count();
    }
    /* 퇴실한 인원 */
    public function getLiveEndCountAttribute(): int
    {
        return HotelReservation::whereHotelId($this->id)->whereType('month')->where(function($query){
            $query->where('order_status','!=','0')->where('order_status','!=','1')->where('order_status','!=','2');
        })->whereHas('confirmation', function ($query) {
            $query->where('end_dt', '<=', Carbon::now()->format('Y-m-d H:i:s'));
        })->count();
    }
    /* 호텔별 총 결제 금액 */
    public function getHotelTotalPriceAttribute(): int
    {
        return HotelReservation::whereHotelId($this->id)->where(function($query){
            /* 예약 정보의 상태가 2,3,4,5 인 경우 */
            $query->where('order_status','=','2')->orwhere('order_status','=','3')->orwhere('order_status','=','4')->orwhere('order_status','=','5');
        })->with(['payment' => function ($query) {
            /*payment 의 상태가 3,4 일 경우 payment_count*/
            $query->where('status','=','3')->orwhere('status','=','4')->where('name','!=','노한결');
        }])->get()->sum('payment.total_price');
    }
    public function getSalePossibilitySumAttribute(): int
    {
        return HotelRoomType::where('hotel_id','=',$this->id)->where('visible','=', '1')->sum('sale_possibility_count');
    }
    public function getCuratorCheckAttribute(): int
    {
        return $this->curator === 'Y';
    }

    public function lockHotelTour() : int {
        if(Str::of($this->option->title)->contains('시그니엘')) {
            return true;
        } else {
            return false;
        }
    }

    public function getAdvantagesAttribute(): Collection
    {
        return Str::of($this->advantage)->explode('||');
    }
    public function getHashtagsAttribute(): Collection
    {
        return Str::of($this->hashtag)->explode('||');
    }

    /* 배열 메일 전송 테스트 */
    public function getAdminEmailsAttribute(): Collection
    {
        return Str::of($this->admin_email)->explode(',');
    }
    public function getLivingEmailsAttribute(): Collection
    {
        return Str::of($this->email)->explode(',');
    }
    public function getTourEmailsAttribute(): Collection
    {
        return Str::of($this->tour_email)->explode(',');
    }
    public function getOtherHotelsAttribute(): Collection
    {
        return Str::of($this->other_hotel)->explode(',');
    }
    public function getImageFirstExplodeAttribute(): Collection
    {
        return Str::of($this->image_first->images)->explode('|');
    }
    public function getImageFirstOnePositionYAttribute(): string
    {
        return $this->image_first->position_y ?? '';
    }
    public function getImageFirstOneAttribute(): string
    {
        return $this->ImageFirstExplode->first();
    }
    public function getLowPriceAttribute(): string
    {
        return HotelRoom::where('hotel_id','=',$this->id)
                ->where('disable','=','N')
            ->where('visible','=','1')
            ->where('sale_price','!=','0')
            ->get()
            ->min('sale_price') ?? 0;
    }
    public function getMaximumPriceAttribute(): string
    {
        return HotelRoom::where('hotel_id','=',$this->id)
                ->where('disable','=','N')
            ->where('visible','=','1')
            ->where('sale_price','!=','0')
            ->get()
            ->max('sale_price') ?? 0;
    }



    public function option(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(HotelOption::class,'hotel_id','id')->where('disable','=','N');
    }
    public function options(): HasMany
    {
        return $this->hasMany(HotelOption::class,'hotel_id','id')->where('disable','=','N');
    }
    public function cancellationPolicy(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(HotelCancellation::class,'hotel_id','id')->where('visible','=','1');
    }
    public function faqs(): HasMany
    {
        return $this->hasMany(HotelFaq::class,'hotel_id','id');
    }
    public function reviews(): HasMany
    {
        return $this->hasMany(HotelReview::class,'hotel_id','id')->where('visible','=','1')->orderBy('order');
    }
    public function images(): HasMany
    {
        return $this->hasMany(HotelImage::class,'hotel_id','id');
    }
    public function image_first(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(HotelImage::class,'hotel_id','id')->orderBy('id', 'DESC');
    }
    public function room(): HasOne
    {
        return $this->hasOne(HotelRoom::class,'hotel_id','id');
    }
    public function rooms(): HasMany
    {
        return $this->hasMany(HotelRoom::class,'hotel_id','id');
    }
    public function room_types(): HasMany
    {
        return $this->hasMany(HotelRoomType::class,'hotel_id','id');
    }
    public function roomTypes(): HasMany
    {
        return $this->hasMany(HotelRoomType::class,'hotel_id','id');
    }
    public function visibleRoomTypes(): HasMany
    {
        return $this->hasMany(HotelRoomType::class,'hotel_id','id')->where('visible', '=', '1');
    }
    public function reservations(): HasMany
    {
        return $this->hasMany(HotelReservation::class,'hotel_id','id');
    }
    public function checkPoints(): HasMany
    {
        return $this->hasMany(HotelCheckPoint::class,'hotel_id','id');
    }
    public function terms(): HasMany
    {
        return $this->hasMany(Term::class,'hotel_id','id');
    }
    public function schedulers(): HasMany
    {
        return $this->hasMany(Scheduler::class,'hotel_id','id');
    }
    public function period_prices(): HasMany
    {
        return $this->hasMany(PeriodPrice::class,'hotel_id','id');
    }

    public function UsePrecautions(): HasMany
    {
        return $this->hasMany(HotelUsePrecaution::class,'hotel_id','id');
    }

}
