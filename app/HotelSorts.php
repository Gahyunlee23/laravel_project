<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\HotelSorts
 *
 * @property int $id
 * @property int|null $hotel_id
 * @property string|null $main 정렬 종료
 * @property string|null $order 정렬 순서
 * @property string|null $start_dt 시작 dt
 * @property string|null $end_dt 종료 dt
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts newQuery()
 * @method static \Illuminate\Database\Query\Builder|HotelSorts onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts query()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereEndDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereStartDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|HotelSorts withTrashed()
 * @method static \Illuminate\Database\Query\Builder|HotelSorts withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $sub 정렬 서브
 * @property string|null $type 타입 구분
 * @property string|null $memo 메모 설명
 * @property-read \App\Hotel|null $hotel
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereMain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereSub($value)
 */
class HotelSorts extends Model
{
    use SoftDeletes;

    protected $table = 'hotel_sorts';

    public $fillable = [
        'id',
        'main', 'sub', 'order',
        'start_dt', 'end_dt',
        'memo',
        'deleted_at',
        'created_at', 'updated_at'
    ];
}
