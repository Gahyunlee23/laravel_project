<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\customerExperiences
 *
 * @property int $id
 * @property int $reservation_id 주문정보
 * @property string|null $gender 성별 0=남,1=여
 * @property int $manager 담당자
 * @property int $calculate_manager 정산 담당자
 * @property int $refund_manager 취소 담당자
 * @property string $inquiry_channel 문의 채널
 * @property string $inflow_path 유입 경로
 * @property string $payment_method 결제 수단
 * @property string $refund_method 환불 수단
 * @property string|null $progress_status 진행현황
 * @property string|null $move_in_progress 입주 처리 메모
 * @property string|null $not_purchased_reason 미구매 사유
 * @property string|null $refund_reason 환불 사유
 * @property string|null $memo 이외 내용 작성용
 * @property int $supply_price 공급가
 * @property int $profit 순이익 = 매출 총이익
 * @property int $refund_price 순이익 = 매출 총이익
 * @property int $calculate_price 호텔 정산 금액
 * @property int $calculate_refund_price 호텔 정산 환불 금액
 * @property string|null $inquiry_at 문의 시간
 * @property string|null $refund_at 환불 처리 시간
 * @property string|null $calculate_at 정산 시간
 * @property string|null $first_at 최초 작성 시간
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\HotelReservation $reservation
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences query()
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereCalculateAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereCalculateManager($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereCalculatePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereCalculateRefundPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereFirstAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereInflowPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereInquiryAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereInquiryChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereManager($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereMoveInProgress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereNotPurchasedReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereProgressStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereRefundAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereRefundManager($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereRefundMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereRefundPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereRefundReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereSupplyPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|customerExperiences whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $order_name 주문자 성명
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerExperiences whereOrderName($value)
 * @property int|null $user_id 고객 id
 * @property string|null $contact_us 문의 내용
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerExperiences whereContactUs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerExperiences whereUserId($value)
 * @property string|null $age_group 연령대
 * @property string|null $residence 거주지
 * @property string|null $work_place 근무지
 * @property string|null $inquiry_type 문의 CX 방식
 * @property string|null $refund_progress 환불 진행 현황
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerExperiences whereAgeGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerExperiences whereInquiryType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerExperiences whereRefundProgress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerExperiences whereResidence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerExperiences whereWorkPlace($value)
 */
class CustomerExperiences extends Model
{
    protected $table = 'customer_experiences';

   // protected $fillable = [];
    protected $guarded = ['id'];
    
    public function reservation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(HotelReservation::class,'reservation_id','id');
    }
}
