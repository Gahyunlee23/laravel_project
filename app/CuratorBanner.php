<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\CuratorBanner
 *
 * @property int $id
 * @property int|null $curator_id
 * @property int|null $hotel_id
 * @property string|null $tab 모아보기 시 탭
 * @property string|null $depth 모아보기 시 뎁스
 * @property string|null $type main curator banner
 * @property string|null $route hotels.collect OR hotel.view
 * @property string|null $title
 * @property string|null $explanation 하단 설명
 * @property string|null $event Event Coupon 워딩
 * @property string|null $images 이미지 / 다수도 가능 하게 세팅
 * @property int $order 정렬 순서
 * @property string|null $memo 메모
 * @property string|null $start_dt 출력 시작 dt
 * @property string|null $end_dt 종료 dt
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Curator|null $curator
 * @property-read \Illuminate\Support\Collection $image_explode
 * @property-read \App\Hotel|null $hotel
 * @method static Builder|CuratorBanner newModelQuery()
 * @method static Builder|CuratorBanner newQuery()
 * @method static \Illuminate\Database\Query\Builder|CuratorBanner onlyTrashed()
 * @method static Builder|CuratorBanner query()
 * @method static Builder|CuratorBanner whereCreatedAt($value)
 * @method static Builder|CuratorBanner whereCuratorId($value)
 * @method static Builder|CuratorBanner whereDeletedAt($value)
 * @method static Builder|CuratorBanner whereDepth($value)
 * @method static Builder|CuratorBanner whereEndDt($value)
 * @method static Builder|CuratorBanner whereEvent($value)
 * @method static Builder|CuratorBanner whereExplanation($value)
 * @method static Builder|CuratorBanner whereHotelId($value)
 * @method static Builder|CuratorBanner whereId($value)
 * @method static Builder|CuratorBanner whereImages($value)
 * @method static Builder|CuratorBanner whereMemo($value)
 * @method static Builder|CuratorBanner whereOrder($value)
 * @method static Builder|CuratorBanner whereRoute($value)
 * @method static Builder|CuratorBanner whereStartDt($value)
 * @method static Builder|CuratorBanner whereTab($value)
 * @method static Builder|CuratorBanner whereTitle($value)
 * @method static Builder|CuratorBanner whereType($value)
 * @method static Builder|CuratorBanner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|CuratorBanner withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CuratorBanner withoutTrashed()
 * @mixin \Eloquent
 */
class CuratorBanner extends Model
{
    use SoftDeletes;

    protected $table = 'curator_banner';

    protected $fillable = [
        'id', 'curator_id', 'hotel_id',
        'tab', 'depth',
        'type', 'route',
        'title', 'explanation',  'event',  'images',
        'order', 'memo',
        'start_dt', 'end_dt',
        'deleted_at',
        'created_at', 'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderAsc', function (Builder $builder) {
            $builder->orderByRaw('curator_banner.order is null asc')->orderBy('order', 'ASC');
        });
    }

    public function getImageExplodeAttribute(): \Illuminate\Support\Collection
    {
        return \Str::of($this->images)->explode('||');
    }

    public function curator(): BelongsTo
    {
        return $this->belongsTo(Curator::class,'curator_id','id');
    }
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class,'hotel_id','id');
    }
}
