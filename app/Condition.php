<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Condition
 *
 * @property int $id
 * @property int|null $option_id 연관 options ID
 * @property int|null $hotel_id 연관 호텔 ID
 * @property int|null $admin_id 작성 관리자 ID
 * @property int|null $limits 선착 인원 수
 * @property string|null $memo 메모
 * @property string|null $disabled 비활성화
 * @property string|null $start_dt 시작 시간
 * @property string|null $end_dt 종료 시간
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Condition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Condition newQuery()
 * @method static \Illuminate\Database\Query\Builder|Condition onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Condition query()
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereDisabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereEndDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereLimits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereStartDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Condition withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Condition withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $type 체크 방식 type : 결제기준, 입주기준
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereType($value)
 * @property string|null $period_price_range_date
 * @property int|null $parent_id 파생 condition 부모 ID
 * @property string|null $name 옵션 명칭
 * @property string|null $method 체크 방식 type : 결제기준, 입주기준
 * @property string|null $variable_amount 변동 금액
 * @property string|null $crease in, de = 증가, 감소 Type
 * @property int|null $visible 0=비활성화, 1=활성화
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereCrease($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition wherePeriodPriceRangeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereVariableAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Condition whereVisible($value)
 */
class Condition extends Model
{
    use SoftDeletes;
    protected $table = 'conditions';
    protected $guarded = [];
}
