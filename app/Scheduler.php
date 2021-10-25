<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Scheduler
 *
 * @property int $id
 * @property int|null $hotel_id
 * @property int|null $period_price_id
 * @property int|null $admin_id
 * @property string|null $bg_color
 * @property string|null $text_color
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Scheduler newModelQuery()
 * @method static Builder|Scheduler newQuery()
 * @method static Builder|Scheduler query()
 * @method static Builder|Scheduler whereAdminId($value)
 * @method static Builder|Scheduler whereCreatedAt($value)
 * @method static Builder|Scheduler whereDeletedAt($value)
 * @method static Builder|Scheduler whereEndDt($value)
 * @method static Builder|Scheduler whereHotelId($value)
 * @method static Builder|Scheduler whereId($value)
 * @method static Builder|Scheduler wherePeriodPriceId($value)
 * @method static Builder|Scheduler whereStartDt($value)
 * @method static Builder|Scheduler whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PeriodPrice[] $periodPrices
 * @property-read int|null $period_prices_count
 * @method static \Illuminate\Database\Query\Builder|Scheduler onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Scheduler withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Scheduler withoutTrashed()
 * @method static Builder|Scheduler whereBgColor($value)
 * @method static Builder|Scheduler whereTextColor($value)
 */
class Scheduler extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;

    protected $table = 'schedulers';

    protected $guarded = [];
    protected $softCascade = ['periodPrices'];


    public function periodPrices(): HasMany
    {
        return $this->hasMany(PeriodPrice::class,'scheduler_id','id');
    }

}
