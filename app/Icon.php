<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Icon
 *
 * @property int $id
 * @property string|null $name 해당 SVG name : 침대, 식수, 수건 등
 * @property string|null $explanation 해당 SVG 설명
 * @property string|null $type 사용 범위 예: benefit, amenities, facilities, all-전체, logo, form 등
 * @property string|null $content 실제 SVG 데이터
 * @property string|null $url S3 SVG 링크
 * @property int|null $order 정렬 순서
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Icon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Icon newQuery()
 * @method static \Illuminate\Database\Query\Builder|Icon onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Icon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Icon whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Icon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Icon whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Icon whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Icon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Icon whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Icon whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Icon whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Icon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Icon whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|Icon withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Icon withoutTrashed()
 * @mixin \Eloquent
 */
class Icon extends Model
{
    use SoftDeletes;
    
    protected $table = 'icons';

    protected $guarded = [];

}
