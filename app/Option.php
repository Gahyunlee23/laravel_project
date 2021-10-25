<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Option
 *
 * @property int $id
 * @property int|null $hotel_id 연관 호텔 ID
 * @property int|null $period_price_id 연관 기간 가격 ID
 * @property int|null $admin_id 작성 관리자 ID
 * @property string|null $memo 메모
 * @property string|null $disabled 비활성화
 * @property string|null $start_dt 시작 시간
 * @property string|null $end_dt 종료 시간
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Option newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Option newQuery()
 * @method static \Illuminate\Database\Query\Builder|Option onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Option query()
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereDisabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereEndDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option wherePeriodPriceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereStartDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Option withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Option withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Benefit[] $benefits
 * @property-read int|null $benefits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Condition[] $conditions
 * @property-read int|null $conditions_count
 */
class Option extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;

    protected $table = 'options';
    protected $guarded = [];

    protected $softCascade = ['benefits', 'conditions'];

    public function benefits(): HasMany
    {
        return $this->hasMany(Benefit::class,'option_id','id');
    }
    public function conditions(): HasMany
    {
        return $this->hasMany(Condition::class,'option_id','id');
    }
}
