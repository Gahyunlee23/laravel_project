<?php

namespace App\Models;

use App\User;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\CollectSearch
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $search 검색 워딩
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CollectSearch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CollectSearch newQuery()
 * @method static \Illuminate\Database\Query\Builder|CollectSearch onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CollectSearch query()
 * @method static \Illuminate\Database\Eloquent\Builder|CollectSearch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CollectSearch whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CollectSearch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CollectSearch whereSearch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CollectSearch whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CollectSearch whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|CollectSearch withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CollectSearch withoutTrashed()
 * @mixin \Eloquent
 * @property-read User|null $User
 */
class CollectSearch extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $table = 'collect_searches';

    protected $guarded = [];


    public function User(): HasOne
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
