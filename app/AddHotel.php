<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AddHotel
 *
 * @property int $id
 * @property int|null $hotel_manager_id 호텔 매니저 User id
 * @property string|null $enter_status 삭제, 진행 중, 중간 저장, 저장 완료, 심사 대기, 심사 중, 협의 중, 미 승인, 승인 완료, 오픈 준비, 오픈완료
 * @property string|null $name 호텔 명칭
 * @property string|null $name_en 호텔 영명칭
 * @property string|null $subway_station 근처 지하철 역
 * @property string|null $area 호텔 주소
 * @property string|null $lat 위도
 * @property string|null $lng 경도
 * @property string|null $star 호텔 성급
 * @property string|null $email 입주 담당자 이메일
 * @property string|null $tour_email 투어 담당자 이메일
 * @property string|null $admin_email TM 관리자 메일
 * @property string|null $tour_start 투어 시작 시간
 * @property string|null $tour_end 투어 종료 시간
 * @property string|null $checkin_time 입주 시간
 * @property string|null $checkout_time 퇴실 시간
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereAdminEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereCheckinTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereCheckoutTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereEnterStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereStar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereSubwayStation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereTourEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereTourEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereTourStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|AddHotel onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotel withoutTrashed()
 * @property string|null $method 입점 방식 = 수수료, 입금가
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelBenefit[] $benefits
 * @property-read int|null $benefits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelLog[] $logs
 * @property-read int|null $logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelCheckPoint[] $checkPoints
 * @property-read int|null $check_points_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelOption[] $options
 * @property-read int|null $options_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelRoomType[] $roomTypes
 * @property-read int|null $room_types_count
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereMethod($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelItem[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelAmenity[] $amenities
 * @property-read int|null $amenities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelCheck[] $checks
 * @property-read int|null $checks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelFacility[] $facilities
 * @property-read int|null $facilities_count
 * @property-read \App\User|null $manager
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelOther[] $others
 * @property-read int|null $others_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelPeriod[] $periods
 * @property-read int|null $periods_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelTour[] $tours
 * @property-read int|null $tours_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelNeedToModify[] $needToModifies
 * @property-read int|null $need_to_modifies_count
 * @property-read \App\AddHotelOther|null $other
 * @property-read \App\Reason|null $reason
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reason[] $reasons
 * @property-read int|null $reasons_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelCheckList[] $checkLists
 * @property-read int|null $check_lists_count
 */
class AddHotel extends Model
{
    use SoftDeletes;

    protected $table = 'add_hotels';

    protected $guarded = [];

    public function manager(): HasOne
    {
        return $this->hasOne(User::class,'id','hotel_manager_id');
    }

    public function logs(): HasMany {
        return $this->hasMany(AddHotelLog::class, 'add_hotel_id', 'id');
    }

    public function benefits(): HasMany
    {
        return $this->hasMany(AddHotelBenefit::class,'add_hotel_id','id');
    }
    public function checkPoints(): HasMany
    {
        return $this->hasMany(AddHotelCheckPoint::class,'add_hotel_id','id');
    }
    public function images(): HasMany
    {
        return $this->hasMany(AddHotelImage::class,'add_hotel_id','id');
    }
    public function options(): HasMany
    {
        return $this->hasMany(AddHotelOption::class,'add_hotel_id','id');
    }
    public function roomTypes(): HasMany
    {
        return $this->hasMany(AddHotelRoomType::class,'add_hotel_id','id');
    }
    public function items(): HasMany
    {
        return $this->hasMany(AddHotelItem::class,'add_hotel_id','id');
    }
    public function amenities(): HasMany
    {
        return $this->hasMany(AddHotelAmenity::class,'add_hotel_id','id');
    }
    public function periods(): HasMany
    {
        return $this->hasMany(AddHotelPeriod::class,'add_hotel_id','id');
    }
    public function facilities(): HasMany
    {
        return $this->hasMany(AddHotelFacility::class,'add_hotel_id','id');
    }
    public function others(): HasMany
    {
        return $this->hasMany(AddHotelOther::class,'add_hotel_id','id');
    }
    public function other(): HasOne
    {
        return $this->hasOne(AddHotelOther::class,'add_hotel_id','id');
    }
    public function tours(): HasMany
    {
        return $this->hasMany(AddHotelTour::class,'add_hotel_id','id');
    }
    public function checks(): HasMany
    {
        return $this->hasMany(AddHotelCheck::class,'add_hotel_id','id');
    }
    public function reason(): HasOne
    {
        return $this->hasOne(Reason::class,'add_hotel_id','id')->where('type', '=', '입점 미승인')->latest();
    }
    public function reasons(): HasMany
    {
        return $this->hasMany(Reason::class,'add_hotel_id','id')->where('type', '=', '입점 미승인');
    }
    public function checkLists(): HasMany
    {
        return $this->hasMany(AddHotelCheckList::class,'add_hotel_id','id');
    }
    public function needToModifies(): HasMany
    {
        return $this->hasMany(AddHotelNeedToModify::class,'add_hotel_id','id');
    }
}
