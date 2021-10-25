<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Schedule
 *
 * @property int $id
 * @property int|null $user_id user(관리자) id
 * @property string $memo 스케쥴 메모
 * @property string $change_memo 변경 점 자동 저장 / 스케쥴
 * @property string|null $send_start_dt 년월일 시:분:초 / 전송 일정
 * @property string|null $send_between_dt ~ 년월일 시:분:초 / 전송 일정 끝
 * @property string $activation 0=비활성, 1=활성 / 비활성화 시 미전송 / 활성화
 * @property string|null $send 0=미전송, 1=전송 / 사용체크
 * @property string|null $cancel 0=진행, 1=취소 / 전송 후 취소 불가 / 취소 처리
 * @property string|null $activation_dt 활성화 변경 처리 dt
 * @property string|null $send_dt 전송 처리 dt
 * @property string|null $cancel_dt 취소 처리 dt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereActivation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereActivationDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereCancel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereCancelDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereChangeMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereSend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereSendBetweenDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereSendDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereSendStartDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereUserId($value)
 * @mixin \Eloquent
 * @property-read string $uploaded_time
 * @property-read \App\Hotel $hotel
 * @property int|null $reservation_id 주문 id
 * @property string|null $template
 * @property string|null $template_type living_after, tour_after 등
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereTemplateType($value)
 */
class Schedule extends Model
{

    protected $table = 'schedules';

    public $fillable = [
        'id', 'user_id', 'reservation_id', 'memo', 'change_memo',
        'send_start_dt', 'send_between_dt',
        'template', 'template_type',
        'activation', 'send', 'cancel',
        'activation_dt', 'send_dt', 'cancel_dt',
        'created_at', 'updated_at'
    ];

    /* @array $dates timestamp appends */
    protected $dates = ['send_start_dt','send_between_dt','activation_dt','send_dt','cancel_dt'];

    /* @array $appends */
    public $appends = ['uploaded_time'];

    public function getUploadedTimeAttribute(): string
    {
        return $this->updated_at->diffForHumans();
    }


    public function hotel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Hotel::class,'hotel_id','id');
    }
}
