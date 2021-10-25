<?php

namespace App;

use App\Http\Livewire\Customer\AlertLists;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $password_tmp
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePasswordTmp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $tel 작성형태 유지
 * @property string|null $phone +82 01 #### #### 형태 변경
 * @property-read mixed $payments_count
 * @property-read mixed $payments_total_price
 * @property-read Collection|\App\HotelReservation[] $reservations
 * @property-read int|null $reservations_count
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTel($value)
 * @property string $nick_name
 * @property string $profile_image
 * @property string|null $kakao_social_id
 * @method static \Illuminate\Database\Eloquent\Builder|User whereKakaoSocialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNickName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfileImage($value)
 * @property string|null $phone_check 입력한 연락처와 다를경우 표기
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneCheck($value)
 * @property string|null $name_check
 * @property string|null $email_check
 * @property-read mixed $tour_lists
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailCheck($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNameCheck($value)
 * @property-read Collection $month_lists
 * @property-read mixed $alert_lists
 * @property string|null $country_code 국가번호
 * @property-read mixed $is_social
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCountryCode($value)
 * @property-read bool $password_update_check
 * @property-read Collection|\App\HotelManager[] $hotelManagers
 * @property-read int|null $hotel_managers_count
 * @property string|null $age_range 연령대
 * @property string|null $birthyear 생년
 * @property string|null $birthday 생일
 * @property string|null $gender 성별
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAgeRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBirthyear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @property string|null $marketing
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMarketing($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
class User extends Authenticatable
{
    use HasRoles, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded =[];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password): void
    {
        $this->attributes['password'] = Hash::needsRehash($password) ? Hash::make($password) : $password;
    }

    public function getPaymentsTotalPriceAttribute()
    {
        $total_price = 0;
        foreach ($this->reservations as $reservation) {
            foreach (Payment::whereReservationId($reservation->id)->get() as $payment) {
                if ($payment->status === '3') {
                    $total_price += $payment->total_price;
                }
            }
        }
        return $total_price;
    }

    public function getPaymentsCountAttribute(): int
    {
        $count = 0;
        foreach ($this->reservations as $reservation) {
            foreach (Payment::whereReservationId($reservation->id)->get() as $payment) {
                if ($payment->status === '3') {
                    $count++;
                }
            }
        }
        return $count;
    }

    public function getAlertListsAttribute()
    {
        return AlertTalkList::with(['reservation'])->where('catalog', '!=', '주문 이탈')->orderBy('send_at', 'DESC')->get()->filter(function($item){
            if(isset($item->reservation->user_id) && $item->reservation->user_id === auth()->user()->id){
                return $item->reservation->user_id === auth()->user()->id ? $item : null;
            }
        });
    }
    public function getTourListsAttribute(): Collection
    {
        return $this->reservations()->with(['hotel'])->where(function ($query) {
            $query->where('order_status', '!=', '1')
                ->where('type', '=', 'tour');
        })->get();
    }
    public function getMonthListsAttribute(): Collection
    {
        return $this->reservations()->with(['hotel'])->where(function ($query) {
            $query->where('order_status', '!=', '1')->where('order_status', '!=', '2')->where('order_status', '!=', '8')
                ->where('type', '=', 'month');
        })->get();
    }

    public function getIsSocialAttribute()
    {
        if($this->kakao_social_id){
            return 'kakao';
        }
        return false;
    }
    public function getPasswordUpdateCheckAttribute(): bool
    {
        if(!$this->IsSocial /*&& Carbon::parse($this->created_at)->format('Y-m-d H:i:s') <= Carbon::parse('2021-05-17 21:01:00')*/){
            return $this->tel === $this->password_tmp;
        }
        return false;
    }

//    public function hotel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
//    {
//        return $this->belongsTo(Hotel::class, 'user_id','id');
//    }
    public function reservations(): HasMany
    {
        return $this->hasMany(HotelReservation::class, 'user_id', 'id')->orderBy('id', 'DESC');
    }
    public function hotelManagers(): HasMany
    {
        return $this->hasMany(HotelManager::class, 'user_id', 'id');
    }

}
