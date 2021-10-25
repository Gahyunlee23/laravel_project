<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Notice
 *
 * @property int $id
 * @property int|null $admin_id
 * @property int|null $user_id
 * @property int|null $hotel_id
 * @property int|null $reservation_id
 * @property string|null $reservation_type 투어, 입주
 * @property string|null $reservation_status 투어, 입주 상태
 * @property string|null $type 전송 이유
 * @property string|null $content 전송내용
 * @property string|null $link 링크 - 내 외
 * @property string|null $link_name 링크 명칭
 * @property string|null $send_dt 전송 dt
 * @property string|null $read_dt 읽은 dt
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Notice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereLinkName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereReadDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereReservationStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereReservationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereSendDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notice whereUserId($value)
 * @mixin \Eloquent
 */
class Notice extends Model
{

    protected $table = 'notices';

    public $fillable = [
        'id', 'admin_id', 'hotel_id', 'user_id', 'reservation_id',
        'type',
        'reservation_type', 'reservation_status', 'link', 'link_name',
        'content',
        'send_dt', 'read_dt',
        'created_at', 'updated_at', 'deleted_at'
    ];
}
