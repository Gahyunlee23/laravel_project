<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Notification
 *
 * @property int $id
 * @property int|null $admin_id 전송 TM 관리자 ID
 * @property int|null $user_id 전송 받는 User id
 * @property string|null $remember_token 전송 받는 리멤버 토큰 키 - 휴대전화
 * @property string|null $type 전송 디자인 타입
 * @property string|null $timer 전송 후 표기 시간 기본 2초
 * @property string|null $content 알림 전송 내용
 * @property string|null $resend 재전송 횟수(자동)
 * @property string|null $start_dt 전송 시작 시간
 * @property string|null $end_dt 전송 종료 시간
 * @property string|null $send_dt 전송 처리 시간
 * @property string|null $read_dt 읽은 처리 시간 - 개별적 읽음 처리
 * @property string|null $forwarded_dt 전송 받은 시간 - 유저 에게 알림 출력 처리
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Query\Builder|Notification onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereEndDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereForwardedDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereReadDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereResend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereSendDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereStartDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereTimer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Notification withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Notification withoutTrashed()
 * @mixin \Eloquent
 */
class Notification extends Model
{
    use SoftDeletes;
    protected $guarded = [];
}
