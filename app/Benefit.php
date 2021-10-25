<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Benefit
 *
 * @property int $id
 * @property int|null $option_id 연관 options ID
 * @property int|null $hotel_id 연관 호텔 ID
 * @property int|null $admin_id 작성 관리자 ID
 * @property string|null $name 혜택 이름
 * @property string|null $explanation 혜택 설명
 * @property string|null $order 정렬
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit newQuery()
 * @method static \Illuminate\Database\Query\Builder|Benefit onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Benefit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Benefit withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Benefit withoutTrashed()
 * @mixin \Eloquent
 */
class Benefit extends Model
{
    use SoftDeletes;
    protected $table = 'benefits';
    protected $guarded = [];
}
