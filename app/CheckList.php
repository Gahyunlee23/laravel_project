<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

/**
 * App\CheckList
 *
 * @property int $id
 * @property int|null $admin_id 작성 관리자
 * @property int|null $group_id 그룹 셋
 * @property string|null $question 실제 질문 내용
 * @property mixed|null $request Json input form
 * @property mixed|null $response Json Y/N 의 반응 질문 또는 입력값? 개수 >= 등 처리
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CheckList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CheckList newQuery()
 * @method static \Illuminate\Database\Query\Builder|CheckList onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CheckList query()
 * @method static \Illuminate\Database\Eloquent\Builder|CheckList whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CheckList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CheckList whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CheckList whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CheckList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CheckList whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CheckList whereRequest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CheckList whereResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CheckList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|CheckList withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CheckList withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $order
 * @property-read mixed $json_request
 * @method static \Illuminate\Database\Eloquent\Builder|CheckList whereOrder($value)
 */
class CheckList extends Model
{
    use SoftDeletes;
    protected $table = 'check_lists';
    protected $guarded =[];

    public function getJsonRequestAttribute()
    {
        try {
            return json_decode($this->request ?? null, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            Log::channel('slack-debug')->debug($e);
        }
    }

}
