<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\CheckGroup
 *
 * @property int $id
 * @property int|null $admin_id 작성 관리자
 * @property string|null $order 출력 순
 * @property string|null $title 질문 타이틀
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CheckGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CheckGroup newQuery()
 * @method static \Illuminate\Database\Query\Builder|CheckGroup onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CheckGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|CheckGroup whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CheckGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CheckGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CheckGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CheckGroup whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CheckGroup whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CheckGroup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|CheckGroup withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CheckGroup withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $explanation 하단 설명 문
 * @method static \Illuminate\Database\Eloquent\Builder|CheckGroup whereExplanation($value)
 */
class CheckGroup extends Model
{
    use SoftDeletes;
    protected $table = 'check_groups';
    protected $guarded =[];
}
