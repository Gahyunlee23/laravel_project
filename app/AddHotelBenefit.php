<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\AddHotelBenefit
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property int|null $benefit_id 베네핏 id
 * @property string|null $name
 * @property string|null $explanation
 * @property string|null $period null = 공통, only, 1주, 2주 등
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelBenefit onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereBenefitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereOnly($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelBenefit withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelBenefit withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $only 0=false, 1=true
 * @property string|null $order
 */
class AddHotelBenefit extends Model
{
    use SoftDeletes;

    protected $table = 'add_hotel_benefits';
    protected $guarded = [];
}
