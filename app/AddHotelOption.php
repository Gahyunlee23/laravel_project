<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AddHotelOption
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $facilities 시설
 * @property string|null $amenities 도구
 * @property string|null $benefit 혜택
 * @property string|null $benefit_only 혜택 Only 표기
 * @property string|null $benefit_type 혜택 Type
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelOption onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereAmenities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereBenefit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereBenefitOnly($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereBenefitType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereFacilities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelOption withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelOption withoutTrashed()
 * @mixin \Eloquent
 */
class AddHotelOption extends Model
{
    use SoftDeletes;

    protected $table = 'add_hotel_options';

    protected $guarded = [];
}
