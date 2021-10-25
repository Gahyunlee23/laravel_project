<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\CertifiedKey
 *
 * @property int $id
 * @property int|null $user_id 인증 User
 * @property string|null $key 인증 키
 * @property string|null $purpose 인증 목적
 * @property string|null $type 인증 방법 - email, tel 등
 * @property string|null $target 인증 하는 email, tel 등 User 의 정보
 * @property string|null $send_dt 전송 dt
 * @property string|null $authentication_dt 인증 완료 dt
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|CertifiedKey newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CertifiedKey newQuery()
 * @method static \Illuminate\Database\Query\Builder|CertifiedKey onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CertifiedKey query()
 * @method static \Illuminate\Database\Eloquent\Builder|CertifiedKey whereAuthenticationDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertifiedKey whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertifiedKey whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertifiedKey whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertifiedKey whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertifiedKey wherePurpose($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertifiedKey whereSendDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertifiedKey whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertifiedKey whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertifiedKey whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertifiedKey whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|CertifiedKey withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CertifiedKey withoutTrashed()
 * @mixin \Eloquent
 */
class CertifiedKey extends Model
{
    use SoftDeletes;

    protected $table = 'certified_keys';

    protected $guarded = [];

    protected $hidden = ['key'];



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
