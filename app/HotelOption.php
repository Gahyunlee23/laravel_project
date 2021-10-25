<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use PHPUnit\Util\Json;

/**
 * App\HotelOption
 *
 * @property int $id
 * @property int $hotel_id
 * @property int $user_id 작성자 user id
 * @property string $title 상품 명
 * @property string $price 원가격
 * @property string $sale_price 판매가
 * @property string $discount_rate 할인률
 * @property string $refund_amount 취소환불금액
 * @property string $explanation 설명
 * @property string $sub_explanation 서브 설명
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $uploaded_time
 * @property-read \App\Hotel $hotel
 * @method static Builder|HotelOption newModelQuery()
 * @method static Builder|HotelOption newQuery()
 * @method static Builder|HotelOption query()
 * @method static Builder|HotelOption whereCreatedAt($value)
 * @method static Builder|HotelOption whereDiscountRate($value)
 * @method static Builder|HotelOption whereExplanation($value)
 * @method static Builder|HotelOption whereHotelId($value)
 * @method static Builder|HotelOption whereId($value)
 * @method static Builder|HotelOption wherePrice($value)
 * @method static Builder|HotelOption whereRefundAmount($value)
 * @method static Builder|HotelOption whereSalePrice($value)
 * @method static Builder|HotelOption whereSubExplanation($value)
 * @method static Builder|HotelOption whereTitle($value)
 * @method static Builder|HotelOption whereUpdatedAt($value)
 * @method static Builder|HotelOption whereUserId($value)
 * @mixin \Eloquent
 * @property string $title_en 상품 영어명
 * @method static Builder|HotelOption whereTitleEn($value)
 * @property string|null $sale_url 판매 링크
 * @method static Builder|HotelOption whereSaleUrl($value)
 * @property string|null $facilities 시설
 * @property string|null $amenities 도구
 * @method static Builder|HotelOption whereAmenities($value)
 * @method static Builder|HotelOption whereFacilities($value)
 * @property string|null $area 지역주소
 * @property string|null $lat 위도
 * @property string|null $lng 경도
 * @method static Builder|HotelOption whereArea($value)
 * @method static Builder|HotelOption whereLat($value)
 * @method static Builder|HotelOption whereLng($value)
 * @property string|null $disable 비활성화
 * @method static Builder|HotelOption whereDisable($value)
 * @property string|null $benefit 혜택 리스트 |
 * @property string|null $benefit_only 혜택 only 표시
 * @property string|null $benefit_type 혜택 type 표시
 * @method static Builder|HotelOption whereBenefit($value)
 * @method static Builder|HotelOption whereBenefitOnly($value)
 * @method static Builder|HotelOption whereBenefitType($value)
 * @property string|null $subway_station 근처 지하철 역
 * @method static Builder|HotelOption whereSubwayStation($value)
 * @property-read Collection $title_explode
 * @property-read Collection $amenities_explode
 * @property-read Collection $benefits_explode
 * @property-read Collection $facilities_explode
 * @property Json $detail_description 호텔별 상세 설명 세팅
 * @method static Builder|HotelOption whereDetailDescription($value)
 * @property-read string $target_detail_description
 * @property-read mixed $t_detail_description
 */
class HotelOption extends Model
{
    protected $table = 'hotel_options';

    public $fillable = [
        'hotel_id','user_id',
        'title', 'title_en', 'subway_station', 'area', 'lat', 'lng',
        'price', 'sale_price', 'discount_rate', 'refund_amount',
        'explanation', 'sub_explanation','sale_url',
        'facilities', 'amenities',
        'benefit','benefit_only','benefit_type','detail_description'
    ];

   /* protected $casts = [
        'detail_description' => 'object'
    ];*/

    /* @array $appends */
    public $appends = ['uploaded_time'];

    public function getUploadedTimeAttribute(): string
    {
        return $this->updated_at->diffForHumans();
    }
    public function getTitleExplodeAttribute(): Collection
    {
        return Str::of($this->title)->explode(' ');
    }
    public function getTargetDetailDescriptionAttribute($target): ?string
    {
        return json_decode($this->detail_description)->$target ?? null;
    }
    public function getTDetailDescriptionAttribute()
    {
        return json_encode($this->detail_description);
    }

    public function getAmenitiesExplodeAttribute(): Collection
    {
        return Str::of($this->amenities)->explode('|');
    }
    public function getFacilitiesExplodeAttribute(): Collection
    {
        return Str::of($this->facilities)->explode('|');
    }
    public function getBenefitsExplodeAttribute(): Collection
    {
        return Str::of($this->benefit)->explode('|');
    }

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class,'hotel_id','id');
    }
}
