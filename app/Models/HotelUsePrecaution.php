<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\HotelUsePrecaution
 *
 * @property int $id
 * @property int|null $hotel_id 연결 호텔 정보
 * @property string|null $type 주의 사항 Type
 * @property string|null $content 사항 내용
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|HotelUsePrecaution newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelUsePrecaution newQuery()
 * @method static \Illuminate\Database\Query\Builder|HotelUsePrecaution onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelUsePrecaution query()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelUsePrecaution whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelUsePrecaution whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelUsePrecaution whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelUsePrecaution whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelUsePrecaution whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelUsePrecaution whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelUsePrecaution whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|HotelUsePrecaution withTrashed()
 * @method static \Illuminate\Database\Query\Builder|HotelUsePrecaution withoutTrashed()
 * @mixin Eloquent
 */
class HotelUsePrecaution extends Model
{
    use SoftDeletes;

    protected $table = 'hotel_use_precautions';

    protected $guarded = [];
}
