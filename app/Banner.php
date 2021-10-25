<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * App\Banner
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
 * @property-read Collection $image_explode
 * @property-read \App\Hotel|null $hotel
 * @method static Builder|Banner newModelQuery()
 * @method static Builder|Banner newQuery()
 * @method static \Illuminate\Database\Query\Builder|Banner onlyTrashed()
 * @method static Builder|Banner query()
 * @method static Builder|Banner whereCreatedAt($value)
 * @method static Builder|Banner whereCuratorId($value)
 * @method static Builder|Banner whereDeletedAt($value)
 * @method static Builder|Banner whereDepth($value)
 * @method static Builder|Banner whereEndDt($value)
 * @method static Builder|Banner whereEvent($value)
 * @method static Builder|Banner whereExplanation($value)
 * @method static Builder|Banner whereHotelId($value)
 * @method static Builder|Banner whereId($value)
 * @method static Builder|Banner whereImages($value)
 * @method static Builder|Banner whereMemo($value)
 * @method static Builder|Banner whereOrder($value)
 * @method static Builder|Banner whereRoute($value)
 * @method static Builder|Banner whereStartDt($value)
 * @method static Builder|Banner whereTab($value)
 * @method static Builder|Banner whereTitle($value)
 * @method static Builder|Banner whereType($value)
 * @method static Builder|Banner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Banner withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Banner withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $view 보여지는 페이지 체크
 * @property string|null $url 외부 전환 링크
 * @method static Builder|Banner whereUrl($value)
 * @method static Builder|Banner whereView($value)
 * @property string|null $render
 * @method static Builder|Banner whereRender($value)
 * @property string|null $bg_color 프로모션 배너 배경 색
 * @method static Builder|Banner whereBgColor($value)
 */
class Banner extends Model
{
    use SoftDeletes;

    protected $table = 'banners';

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderAsc', function (Builder $builder) {
            $builder->orderByRaw('banners.order is null asc')->orderBy('order', 'ASC');
        });
    }

    public function getImageExplodeAttribute(): Collection
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
