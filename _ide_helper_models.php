<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\AddHotel
 *
 * @property int $id
 * @property int|null $hotel_manager_id 호텔 매니저 User id
 * @property string|null $enter_status 삭제, 진행 중, 중간 저장, 저장 완료, 심사 대기, 심사 중, 협의 중, 미 승인, 승인 완료, 오픈 준비, 오픈완료
 * @property string|null $name 호텔 명칭
 * @property string|null $name_en 호텔 영명칭
 * @property string|null $subway_station 근처 지하철 역
 * @property string|null $area 호텔 주소
 * @property string|null $lat 위도
 * @property string|null $lng 경도
 * @property string|null $star 호텔 성급
 * @property string|null $email 입주 담당자 이메일
 * @property string|null $tour_email 투어 담당자 이메일
 * @property string|null $admin_email TM 관리자 메일
 * @property string|null $tour_start 투어 시작 시간
 * @property string|null $tour_end 투어 종료 시간
 * @property string|null $checkin_time 입주 시간
 * @property string|null $checkout_time 퇴실 시간
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereAdminEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereCheckinTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereCheckoutTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereEnterStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereStar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereSubwayStation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereTourEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereTourEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereTourStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|AddHotel onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotel withoutTrashed()
 * @property string|null $method 입점 방식 = 수수료, 입금가
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelBenefit[] $benefits
 * @property-read int|null $benefits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelCheckPoint[] $checkPoints
 * @property-read int|null $check_points_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelOption[] $options
 * @property-read int|null $options_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelRoomType[] $roomTypes
 * @property-read int|null $room_types_count
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotel whereMethod($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelItem[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelAmenity[] $amenities
 * @property-read int|null $amenities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelCheck[] $checks
 * @property-read int|null $checks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelFacility[] $facilities
 * @property-read int|null $facilities_count
 * @property-read \App\User|null $manager
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelOther[] $others
 * @property-read int|null $others_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelPeriod[] $periods
 * @property-read int|null $periods_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelTour[] $tours
 * @property-read int|null $tours_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelNeedToModify[] $needToModifies
 * @property-read int|null $need_to_modifies_count
 * @property-read \App\AddHotelOther|null $other
 * @property-read \App\Reason|null $reason
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reason[] $reasons
 * @property-read int|null $reasons_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelCheckList[] $checkLists
 * @property-read int|null $check_lists_count
 */
	class AddHotel extends \Eloquent {}
}

namespace App{
/**
 * App\AddHotelAmenity
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $name 어메니티 명칭
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelAmenity onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelAmenity withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelAmenity withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $without 1=불포함
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelAmenity whereWithout($value)
 */
	class AddHotelAmenity extends \Eloquent {}
}

namespace App{
/**
 * App\AddHotelBenefit
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property int|null $benefit_id 베네핏 id
 * @property string|null $name
 * @property string|null $explanation
 * @property string|null $period null = 공통, only, 1주, 2주 등
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelBenefit onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereBenefitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereOnly($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelBenefit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelBenefit withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelBenefit withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $only 0=false, 1=true
 * @property string|null $order
 */
	class AddHotelBenefit extends \Eloquent {}
}

namespace App{
/**
 * App\AddHotelCheck
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $date 입력시 해당 일 제한
 * @property string|null $start 시작 시간
 * @property string|null $end 끝 시간
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheck onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheck withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheck withoutTrashed()
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheck whereDeletedAt($value)
 */
	class AddHotelCheck extends \Eloquent {}
}

namespace App{
/**
 * App\AddHotelCheckList
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property int|null $check_group_id 체크 그룹 ID
 * @property int|null $check_list_id 체크 list ID
 * @property string|null $answer 답변 : Y, N / String / Number / Date 등
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheckList onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList whereCheckGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList whereCheckListId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheckList withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheckList withoutTrashed()
 * @mixin \Eloquent
 * @property int|null $input
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckList whereInput($value)
 */
	class AddHotelCheckList extends \Eloquent {}
}

namespace App{
/**
 * App\AddHotelCheckListImage
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $image 이미지 path
 * @property string|null $order 출력 순
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckListImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckListImage newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheckListImage onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckListImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckListImage whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckListImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckListImage whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckListImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckListImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckListImage whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckListImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheckListImage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheckListImage withoutTrashed()
 */
	class AddHotelCheckListImage extends \Eloquent {}
}

namespace App{
/**
 * App\AddHotelCheckPoint
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $title 타이틀 20자 이하
 * @property string|null $explanation 설명 180자 이하
 * @property string|null $image 이미지
 * @property string|null $order 출력 순서
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelCheckPoint whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheckPoint onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheckPoint withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelCheckPoint withoutTrashed()
 */
	class AddHotelCheckPoint extends \Eloquent {}
}

namespace App{
/**
 * App\AddHotelFacility
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $name 명칭
 * @property string|null $explanation 설명
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelFacility onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelFacility whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelFacility withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelFacility withoutTrashed()
 * @mixin \Eloquent
 */
	class AddHotelFacility extends \Eloquent {}
}

namespace App{
/**
 * App\AddHotelImage
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $type 종류
 * @property string|null $title 사진 [제목, 타이틀]
 * @property string|null $image 이미지
 * @property string|null $explanation 설명 180자 이하
 * @property string|null $sub_explanation 서브 설명 180자 이하
 * @property string|null $order 출력 순서
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereSubExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelImage whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|AddHotelImage onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelImage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelImage withoutTrashed()
 */
	class AddHotelImage extends \Eloquent {}
}

namespace App{
/**
 * App\AddHotelItem
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property int|null $room_type_id 룸 타입 id
 * @property string|null $period 기간
 * @property int|null $sale_price 호텔 판매 가격
 * @property int|null $fee 수수료
 * @property int|null $price 최종 가격?
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelItem onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem whereFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem whereRoomTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem whereSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelItem withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelItem withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $order 순서
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem whereOrder($value)
 * @property int|null $period_id
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelItem wherePeriodId($value)
 * @property-read \App\AddHotelRoomType|null $roomType
 */
	class AddHotelItem extends \Eloquent {}
}

namespace App{
/**
 * App\AddHotelNeedToModify
 *
 * @property int $id
 * @property int|null $admin_id TM 관리자 ID
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $status 상태
 * @property string|null $target input, page 수정 필요 타겟
 * @property string|null $content 수정 필요 사항
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelNeedToModify onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelNeedToModify withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelNeedToModify withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $severity 심각성
 * @property string|null $model
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelNeedToModify whereSeverity($value)
 */
	class AddHotelNeedToModify extends \Eloquent {}
}

namespace App{
/**
 * App\AddHotelOption
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $facilities 시설
 * @property string|null $amenities 도구
 * @property string|null $benefit 혜택
 * @property string|null $benefit_only 혜택 Only 표기
 * @property string|null $benefit_type 혜택 Type
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelOption onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereAmenities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereBenefit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereBenefitOnly($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereBenefitType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereFacilities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOption whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelOption withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelOption withoutTrashed()
 * @mixin \Eloquent
 */
	class AddHotelOption extends \Eloquent {}
}

namespace App{
/**
 * App\AddHotelOther
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $name 호텔 매니저 성명
 * @property string|null $phone_number 연락처 hot line
 * @property string|null $department_name 부서명
 * @property string|null $department_position 부서 직급
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelOther onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther whereDepartmentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther whereDepartmentPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelOther whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelOther withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelOther withoutTrashed()
 * @mixin \Eloquent
 */
	class AddHotelOther extends \Eloquent {}
}

namespace App{
/**
 * App\AddHotelPeriod
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $name 기간 명칭
 * @property string|null $order
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelPeriod onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelPeriod whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelPeriod withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelPeriod withoutTrashed()
 * @mixin \Eloquent
 */
	class AddHotelPeriod extends \Eloquent {}
}

namespace App{
/**
 * App\AddHotelRoomType
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $name 룸 배드 명칭
 * @property string|null $main_explanation 룸 배드 개수
 * @property string|null $sub_explanation 룸 타입 하단 추가 설명
 * @property string|null $upgrade 업그레이드 용 0 1
 * @property string|null $sold_out 판매 완료=1, 판매중=0
 * @property int|null $sale_possibility_count 판매 가능 총 개수
 * @property string|null $order 출력 순서
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereMainExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereSalePossibilityCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereSoldOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereSubExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomType whereUpgrade($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|AddHotelRoomType onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelRoomType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelRoomType withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelRoomTypeImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AddHotelItem[] $items
 * @property-read int|null $items_count
 */
	class AddHotelRoomType extends \Eloquent {}
}

namespace App{
/**
 * App\AddHotelRoomTypeImage
 *
 * @property int $id
 * @property int|null $add_hotel_room_type_id Room Type ID
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $name 명칭
 * @property string|null $main_explanation 이미지 상세 설명
 * @property string|null $sub_explanation 이미지 서브 설명
 * @property string|null $image 이미지 링크
 * @property string|null $order 출력 순서
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereAddHotelRoomTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereMainExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereSubExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelRoomTypeImage whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|AddHotelRoomTypeImage onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelRoomTypeImage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelRoomTypeImage withoutTrashed()
 */
	class AddHotelRoomTypeImage extends \Eloquent {}
}

namespace App{
/**
 * App\AddHotelTour
 *
 * @property int $id
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $day 요일
 * @property string|null $start 시작 시간
 * @property string|null $end 끝 시간
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour newQuery()
 * @method static \Illuminate\Database\Query\Builder|AddHotelTour onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddHotelTour whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AddHotelTour withTrashed()
 * @method static \Illuminate\Database\Query\Builder|AddHotelTour withoutTrashed()
 * @mixin \Eloquent
 */
	class AddHotelTour extends \Eloquent {}
}

namespace App{
/**
 * App\AlertTalkList
 *
 * @property int $id
 * @property int|null $template_id 템플릿 id
 * @property int|null $reservation_id 주문 id
 * @property int|null $payment_id 결제 id
 * @property int|null $confirmation_id 확정 id
 * @property int|null $hotel_id 호텔 id
 * @property int|null $room_id 호텔 룸 id
 * @property string|null $situation 전송 상황
 * @property string|null $result 전송 처리
 * @property \Illuminate\Support\Carbon|null $send_at 전송 시간
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList query()
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereConfirmationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereSendAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereSituation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $template 템플릿 전송 내용
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereTemplate($value)
 * @property string|null $catalog 템플릿 카탈로그
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereCatalog($value)
 * @property string|null $hp 연락처
 * @property string|null $button_type 타입 WL
 * @property string|null $button_name 버튼 명들
 * @property string|null $button_url 버튼 모바일 URL
 * @property string|null $button_url2 버튼 웹 URL
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereButtonName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereButtonType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereButtonUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereButtonUrl2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereHp($value)
 * @property string|null $read_at
 * @property-read \App\HotelReservation|null $reservation
 * @method static \Illuminate\Database\Eloquent\Builder|AlertTalkList whereReadAt($value)
 */
	class AlertTalkList extends \Eloquent {}
}

namespace App{
/**
 * App\Banner
 *
 * @property int $id
 * @property int|null $curator_id
 * @property int|null $hotel_id
 * @property string|null $tab 모아보기 시 탭
 * @property string|null $depth 모아보기 시 뎁스
 * @property string|null $type main curator banner
 * @property string|null $route hotels.collect OR hotel.view
 * @property string|null $title
 * @property string|null $explanation 하단 설명
 * @property string|null $event Event Coupon 워딩
 * @property string|null $images 이미지 / 다수도 가능 하게 세팅
 * @property int $order 정렬 순서
 * @property string|null $memo 메모
 * @property string|null $start_dt 출력 시작 dt
 * @property string|null $end_dt 종료 dt
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Curator|null $curator
 * @property-read Collection $image_explode
 * @property-read \App\Hotel|null $hotel
 * @method static Builder|Banner newModelQuery()
 * @method static Builder|Banner newQuery()
 * @method static \Illuminate\Database\Query\Builder|Banner onlyTrashed()
 * @method static Builder|Banner query()
 * @method static Builder|Banner whereCreatedAt($value)
 * @method static Builder|Banner whereCuratorId($value)
 * @method static Builder|Banner whereDeletedAt($value)
 * @method static Builder|Banner whereDepth($value)
 * @method static Builder|Banner whereEndDt($value)
 * @method static Builder|Banner whereEvent($value)
 * @method static Builder|Banner whereExplanation($value)
 * @method static Builder|Banner whereHotelId($value)
 * @method static Builder|Banner whereId($value)
 * @method static Builder|Banner whereImages($value)
 * @method static Builder|Banner whereMemo($value)
 * @method static Builder|Banner whereOrder($value)
 * @method static Builder|Banner whereRoute($value)
 * @method static Builder|Banner whereStartDt($value)
 * @method static Builder|Banner whereTab($value)
 * @method static Builder|Banner whereTitle($value)
 * @method static Builder|Banner whereType($value)
 * @method static Builder|Banner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Banner withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Banner withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $view 보여지는 페이지 체크
 * @method static Builder|Banner whereView($value)
 * @property string|null $url 외부 전환 링크
 * @method static Builder|Banner whereUrl($value)
 */
	class Banner extends \Eloquent {}
}

namespace App{
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
	class CertifiedKey extends \Eloquent {}
}

namespace App{
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
	class CheckGroup extends \Eloquent {}
}

namespace App{
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
 * @property-read mixed $json_request
 * @property string|null $order
 * @method static \Illuminate\Database\Eloquent\Builder|CheckList whereOrder($value)
 */
	class CheckList extends \Eloquent {}
}

namespace App{
/**
 * App\Confirmation
 *
 * @property int $id
 * @property int|null $reservation_id 주문 id
 * @property int|null $payment_id 결제 id
 * @property int|null $user_id user(관리자) id
 * @property \Illuminate\Support\Carbon|null $start_dt 입주 dt
 * @property \Illuminate\Support\Carbon|null $end_dt 퇴실 dt
 * @property string|null $add_days 추가 일수
 * @property string $memo 메모
 * @property string|null $status 0=취소, 1=기본
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereAddDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereEndDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereStartDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $before_3day 입실 3일전 알림톡 전송 처리 0=미전송, 1=전송완료 / 1로 설정시 발신안됨
 * @property string|null $before_1day 입실 1일전 알림톡 전송 처리 0=미전송, 1=전송완료 / 1로 설정시 발신안됨
 * @property string|null $last_3day 퇴실 3일전 알림톡 전송 처리 0=미전송, 1=전송완료 / 1로 설정시 발신안됨
 * @property string|null $last_1day 퇴실 1일전 알림톡 전송 처리 0=미전송, 1=전송완료 / 1로 설정시 발신안됨
 * @property string|null $after_1day 퇴실 1일 후 알림톡 전송 처리 0=미전송, 1=전송완료 / 1로 설정시 발신안됨
 * @property string|null $after_3day 퇴실 3일 후 알림톡 전송 처리 0=미전송, 1=전송완료 / 1로 설정시 발신안됨
 * @property-read string $start_end_diff_date
 * @property-read string $uploaded_time
 * @property-read \App\Payment|null $payment
 * @property-read \App\HotelReservation|null $reservation
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereAfter1day($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereAfter3day($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereBefore1day($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereBefore3day($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereLast1day($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereLast3day($value)
 * @property string|null $type 투어,입주 타입 구분 체크
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereType($value)
 * @property string|null $end_1day 퇴실 1일 후 알림톡 전송 처리 0=미전송, 1=전송완료 / 1로 설정시 발신안됨
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereEnd1day($value)
 * @property string|null $room_type
 * @property string|null $tour_after 투어 후 알림톡
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereRoomType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereTourAfter($value)
 * @property string|null $add_memo 추가 일수 저장
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereAddMemo($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AlertTalkList[] $alertTalkLists
 * @property-read int|null $alert_talk_lists_count
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|Confirmation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereAddDaysSchedule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereEndScheduleDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Confirmation whereStartScheduleDt($value)
 * @method static \Illuminate\Database\Query\Builder|Confirmation withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Confirmation withoutTrashed()
 * @property string|null $start_schedule_dt 변경 예정, 또는 신청중인
 * @property string|null $end_schedule_dt 변경 예정, 또는 신청중인
 * @property string|null $add_days_schedule 변경 예정 또는 신청중인 추가일수
 */
	class Confirmation extends \Eloquent {}
}

namespace App{
/**
 * App\Curator
 *
 * @property int $id
 * @property string|null $user_id 큐레이터 id
 * @property string|null $user_page 큐레이터 전용 page 명
 * @property string $user_pass 큐레이터 password
 * @property string|null $name 큐레이터 이름
 * @property string $tel 큐레이터 연락처
 * @property string $email 큐레이터 이메일
 * @property string $explanation 큐레이터 설명
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $uploaded_time
 * @method static \Illuminate\Database\Eloquent\Builder|Curator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Curator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Curator query()
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereUserPage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereUserPass($value)
 * @mixin \Eloquent
 * @property string $visible 활성화
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereVisible($value)
 * @property string|null $logo_image 큐레이터 로고 이미지
 * @method static \Illuminate\Database\Eloquent\Builder|Curator whereLogoImage($value)
 * @property string|null $percent 총 할인%
 * @method static \Illuminate\Database\Eloquent\Builder|Curator wherePercent($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CuratorBanner[] $curatorBanners
 * @property-read int|null $curator_banners_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CuratorHotel[] $curatorHotels
 * @property-read int|null $curator_hotels_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Banner[] $banners
 * @property-read int|null $banners_count
 */
	class Curator extends \Eloquent {}
}

namespace App{
/**
 * App\CuratorBanner
 *
 * @property int $id
 * @property int|null $curator_id
 * @property int|null $hotel_id
 * @property string|null $tab 모아보기 시 탭
 * @property string|null $depth 모아보기 시 뎁스
 * @property string|null $type main curator banner
 * @property string|null $route hotels.collect OR hotel.view
 * @property string|null $title
 * @property string|null $explanation 하단 설명
 * @property string|null $event Event Coupon 워딩
 * @property string|null $images 이미지 / 다수도 가능 하게 세팅
 * @property int $order 정렬 순서
 * @property string|null $memo 메모
 * @property string|null $start_dt 출력 시작 dt
 * @property string|null $end_dt 종료 dt
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Curator|null $curator
 * @property-read Collection $image_explode
 * @property-read \App\Hotel|null $hotel
 * @method static Builder|CuratorBanner newModelQuery()
 * @method static Builder|CuratorBanner newQuery()
 * @method static \Illuminate\Database\Query\Builder|CuratorBanner onlyTrashed()
 * @method static Builder|CuratorBanner query()
 * @method static Builder|CuratorBanner whereCreatedAt($value)
 * @method static Builder|CuratorBanner whereCuratorId($value)
 * @method static Builder|CuratorBanner whereDeletedAt($value)
 * @method static Builder|CuratorBanner whereDepth($value)
 * @method static Builder|CuratorBanner whereEndDt($value)
 * @method static Builder|CuratorBanner whereEvent($value)
 * @method static Builder|CuratorBanner whereExplanation($value)
 * @method static Builder|CuratorBanner whereHotelId($value)
 * @method static Builder|CuratorBanner whereId($value)
 * @method static Builder|CuratorBanner whereImages($value)
 * @method static Builder|CuratorBanner whereMemo($value)
 * @method static Builder|CuratorBanner whereOrder($value)
 * @method static Builder|CuratorBanner whereRoute($value)
 * @method static Builder|CuratorBanner whereStartDt($value)
 * @method static Builder|CuratorBanner whereTab($value)
 * @method static Builder|CuratorBanner whereTitle($value)
 * @method static Builder|CuratorBanner whereType($value)
 * @method static Builder|CuratorBanner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|CuratorBanner withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CuratorBanner withoutTrashed()
 * @mixin \Eloquent
 */
	class CuratorBanner extends \Eloquent {}
}

namespace App{
/**
 * App\CuratorHotel
 *
 * @property int $id
 * @property int $hotel_id 호텔 id
 * @property int $curator_id 큐레이터 id
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Curator $curator
 * @property-read \App\Hotel $hotel
 * @method static \Illuminate\Database\Eloquent\Builder|CuratorHotel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuratorHotel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CuratorHotel query()
 * @method static \Illuminate\Database\Eloquent\Builder|CuratorHotel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuratorHotel whereCuratorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuratorHotel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuratorHotel whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuratorHotel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CuratorHotel whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|CuratorHotel onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|CuratorHotel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CuratorHotel withoutTrashed()
 */
	class CuratorHotel extends \Eloquent {}
}

namespace App{
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
	class CustomerExperiences extends \Eloquent {}
}

namespace App{
/**
 * App\Enter
 *
 * @property int $id
 * @property string $hotel_name 호텔 명
 * @property string $hotel_address 호텔 주소
 * @property string $hotel_web_address 호텔 웹 사이트
 * @property string $manager_name 담당자 명
 * @property string $manager_rank 담당자 직급
 * @property string $manager_email 담당자 이메일
 * @property string $manager_hp 담당자 연락처
 * @property string $status 처리 상태
 * @property string $progress 진행 상태
 * @property string $memo 메모
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Enter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Enter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Enter query()
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereHotelAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereHotelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereHotelWebAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereManagerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereManagerHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereManagerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereManagerRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereProgress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enter whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read string $created_time
 * @property-read string $uploaded_time
 * @property-read \App\EnterOption|null $option
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\EnterRoom[] $rooms
 * @property-read int|null $rooms_count
 */
	class Enter extends \Eloquent {}
}

namespace App{
/**
 * App\EnterOption
 *
 * @property int $id
 * @property int $enter_id
 * @property string $amenities 도구
 * @property string $facilities 시설
 * @property string $benefit 혜택
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|EnterOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnterOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnterOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|EnterOption whereAmenities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterOption whereBenefit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterOption whereEnterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterOption whereFacilities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterOption whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class EnterOption extends \Eloquent {}
}

namespace App{
/**
 * App\EnterRoom
 *
 * @property int $id
 * @property int $enter_id
 * @property string $type 룸 타입
 * @property int $supply_price_month 한달살기 가격
 * @property int $supply_price_3_weeks 3주 살기 가격
 * @property int $supply_price_2_weeks 2주 살기 가격
 * @property int $supply_price_1_weeks 1주 살기 가격
 * @property int $supply_price_short_day 단기 살기 가격
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom query()
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom whereEnterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom whereSupplyPrice1Weeks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom whereSupplyPrice2Weeks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom whereSupplyPrice3Weeks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom whereSupplyPriceMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom whereSupplyPriceShortDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EnterRoom whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class EnterRoom extends \Eloquent {}
}

namespace App{
/**
 * App\External
 *
 * @property-read string $uploaded_time
 * @method static \Illuminate\Database\Eloquent\Builder|External newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|External newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|External query()
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $hotel_id 호텔 id
 * @property int|null $reservation_id 주문 id
 * @property string|null $access_key 랜덤영어 자 = 해당 컬럼 접근 키 일치해야 접근가능
 * @property string|null $type 무슨 허용 사항인지 저장 ex] 입실확정 처리, 투어 확정처리 등
 * @property string|null $memo 설명 = 처리 내용 저장용
 * @property string|null $status 처리에 대한 status
 * @property \Illuminate\Support\Carbon|null $access_at 접근 가능 ~ dt
 * @property \Illuminate\Support\Carbon|null $access_end_at 이후 접근 불가 dt
 * @property \Illuminate\Support\Carbon|null $enter_at 외부 접근 > 처리 dt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|External whereAccessAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereAccessEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereEnterAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|External whereAccessKey($value)
 * @property-read \App\Hotel|null $hotel
 * @property-read \App\HotelReservation|null $reservation
 * @property \Illuminate\Support\Carbon|null $click_at
 * @method static \Illuminate\Database\Eloquent\Builder|External whereClickAt($value)
 */
	class External extends \Eloquent {}
}

namespace App{
/**
 * App\Formatter
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Formatter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Formatter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Formatter query()
 * @mixin \Eloquent
 */
	class Formatter extends \Eloquent {}
}

namespace App{
/**
 * App\Hotel
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $status 0-삭제, 1-미오픈, 2-오픈
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelFaq[] $faqs
 * @property-read int|null $faqs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelOption[] $options
 * @property-read int|null $options_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelRoom[] $rooms
 * @property-read int|null $rooms_count
 * @method static Builder|Hotel newModelQuery()
 * @method static Builder|Hotel newQuery()
 * @method static Builder|Hotel query()
 * @method static Builder|Hotel whereCreatedAt($value)
 * @method static Builder|Hotel whereId($value)
 * @method static Builder|Hotel whereStatus($value)
 * @method static Builder|Hotel whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|HotelReservation[] $reservations
 * @property-read int|null $reservations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelCheckPoint[] $checkPoints
 * @property-read int|null $check_points_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelRoom[] $room_types
 * @property-read int|null $room_types_count
 * @property string|null $order 정렬
 * @method static Builder|Hotel whereOrder($value)
 * @property string|null $info_notion 알림톡]입주 설명서
 * @property string|null $email 호텔 관리자 이메일
 * @method static Builder|Hotel whereEmail($value)
 * @method static Builder|Hotel whereInfoNotion($value)
 * @property string|null $tour_start 투어 가능 시작 시간
 * @property string|null $tour_end 투어 가능 끝 시간
 * @property-read int $completed_reservation_count
 * @property-read int $reservation_count
 * @method static Builder|Hotel whereTourEnd($value)
 * @method static Builder|Hotel whereTourStart($value)
 * @property string|null $tour_email 호텔 투어 관리자 이메일
 * @method static Builder|Hotel whereTourEmail($value)
 * @property string|null $admin_email 테스트용 관리자 메일 (,)배열
 * @method static Builder|Hotel whereAdminEmail($value)
 * @property-read Collection $admin_emails
 * @property-read Collection $living_emails
 * @property-read Collection $tour_emails
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Term[] $terms
 * @property-read int|null $terms_count
 * @property string|null $other_hotel 호텔 상세 > 이외 호텔
 * @property-read Collection $other_hotels
 * @method static Builder|Hotel whereOtherHotel($value)
 * @property-read \App\HotelCancellation|null $cancellationPolicy
 * @property-read \App\HotelOption|null $option
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelReview[] $reviews
 * @property-read int|null $reviews_count
 * @property-read int $completed_reservation_month_count
 * @property-read int $completed_reservation_tour_count
 * @property-read int $confirmation_month_count
 * @property-read int $confirmation_tour_count
 * @property-read int $hotel_total_price
 * @property-read int $live_end_count
 * @property-read int $living_count
 * @property-read int $reservation_month_count
 * @property-read int $reservation_tour_count
 * @property-read Collection $image_first_explode
 * @property-read \App\HotelImage|null $image_first
 * @property string|null $advantage 장점 리스트
 * @property-read Collection $advantages
 * @method static Builder|Hotel whereAdvantage($value)
 * @property-read int $sale_possibility_sum
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelSorts[] $sorts
 * @property-read int|null $sorts_count
 * @property string|null $curator 큐레이터 체크
 * @property string|null $star 성급
 * @property string|null $grade 등급
 * @property-read string $image_first_one
 * @property-read string $image_first_one_position_y
 * @property-read string $low_price
 * @property-read string $maximum_price
 * @method static Builder|Hotel curator($curator)
 * @method static Builder|Hotel whereCurator($value)
 * @method static Builder|Hotel whereGrade($value)
 * @method static Builder|Hotel whereStar($value)
 * @property string|null $hashtag
 * @property-read int $curator_check
 * @property-read Collection $hashtags
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PeriodPrice[] $period_prices
 * @property-read int|null $period_prices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Scheduler[] $schedulers
 * @property-read int|null $schedulers_count
 * @method static Builder|Hotel whereHashtag($value)
 * @property-read \App\HotelRoom|null $room
 */
	class Hotel extends \Eloquent {}
}

namespace App{
/**
 * App\HotelCancellation
 *
 * @property int $id
 * @property int $hotel_id
 * @property string $in_use_hotel_fault 호텔 귀책 이용 중 취소
 * @property string $in_use_customer_fault 고객 귀책 이용 중 취소
 * @property string $day 당일 (24시 내) 취소
 * @property string $days_1_6 1~6일 취소 취소
 * @property string $days_7_10 7~10일 취소 취소
 * @property string $days_11_20 11~20일 취소 취소
 * @property string $days_21_30 21~30일 취소 취소
 * @property string $weekday_cost 평일 원가
 * @property string $weekend_cost 주말 원가
 * @property string $visible 1=활성화
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|HotelCancellation newModelQuery()
 * @method static Builder|HotelCancellation newQuery()
 * @method static Builder|HotelCancellation query()
 * @method static Builder|HotelCancellation whereCreatedAt($value)
 * @method static Builder|HotelCancellation whereDay($value)
 * @method static Builder|HotelCancellation whereDays1120($value)
 * @method static Builder|HotelCancellation whereDays16($value)
 * @method static Builder|HotelCancellation whereDays2130($value)
 * @method static Builder|HotelCancellation whereDays710($value)
 * @method static Builder|HotelCancellation whereHotelId($value)
 * @method static Builder|HotelCancellation whereId($value)
 * @method static Builder|HotelCancellation whereInUseCustomerFault($value)
 * @method static Builder|HotelCancellation whereInUseHotelFault($value)
 * @method static Builder|HotelCancellation whereUpdatedAt($value)
 * @method static Builder|HotelCancellation whereVisible($value)
 * @method static Builder|HotelCancellation whereWeekdayCost($value)
 * @method static Builder|HotelCancellation whereWeekendCost($value)
 * @mixin \Eloquent
 * @property-read mixed $reverse_day
 * @property-read mixed $reverse_days1120
 * @property-read mixed $reverse_days16
 * @property-read mixed $reverse_days710
 * @property-read \Illuminate\Support\Collection $weekday_costs
 * @property-read \Illuminate\Support\Collection $weekend_costs
 * @property string $room_type 각 룸 타입
 * @property-read \Illuminate\Support\Collection $room_types
 * @method static Builder|HotelCancellation whereRoomType($value)
 * @property string $special_agreement
 * @method static Builder|HotelCancellation whereSpecialAgreement($value)
 */
	class HotelCancellation extends \Eloquent {}
}

namespace App{
/**
 * App\HotelCheckPoint
 *
 * @property int $id
 * @property int $hotel_id
 * @property string $title1 체크포인트 1 title
 * @property string $explanation1 체크포인트 1 설명
 * @property string $title2 체크포인트 2 title
 * @property string $explanation2 체크포인트 2 설명
 * @property string $title3 체크포인트 3 title
 * @property string $explanation3 체크포인트 3 설명
 * @property string $disable 비활성화
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint query()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereDisable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereExplanation1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereExplanation2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereExplanation3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereTitle1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereTitle2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereTitle3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $image1 체크포인트 1 이미지
 * @property string|null $image2 체크포인트 2 이미지
 * @property string|null $image3 체크포인트 3 이미지
 * @property-read string $uploaded_time
 * @property-read \App\Hotel $hotel
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereImage1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereImage2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelCheckPoint whereImage3($value)
 */
	class HotelCheckPoint extends \Eloquent {}
}

namespace App{
/**
 * App\HotelFaq
 *
 * @property int $id
 * @property int $hotel_id
 * @property int $user_id 작성자 user id
 * @property string $faq
 * @property string $faq_answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $uploaded_time
 * @property-read \App\Hotel $hotel
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq query()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereFaq($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereFaqAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereUserId($value)
 * @mixin \Eloquent
 * @property string $question
 * @property string $answer
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereQuestion($value)
 * @property string|null $answer_name 작성자 user_name
 * @property string|null $answer_job
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereAnswerJob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelFaq whereAnswerName($value)
 */
	class HotelFaq extends \Eloquent {}
}

namespace App{
/**
 * App\HotelImage
 *
 * @property int $id
 * @property int $hotel_id
 * @property int $user_id 작성자 user id
 * @property string|null $type 옵션 타입 / main=0, review=1, sub[2~], 등
 * @property string|null $images 이미지[]
 * @property string|null $position_y 이미지 포지션 Y축 예 100%,100%|20%,100%  , 는 메인과 서브 분류 | 는 다음 이미지 순
 * @property string|null $title 사진 [제목, 타이틀]
 * @property string|null $explanation 설명
 * @property string|null $sub_explanation 서브 설명
 * @property string|null $disable 비활성화
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $uploaded_time
 * @property-read \App\Hotel $hotel
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereDisable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage wherePositionY($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereSubExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelImage whereUserId($value)
 * @mixin \Eloquent
 */
	class HotelImage extends \Eloquent {}
}

namespace App{
/**
 * App\HotelManager
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $hotel_id
 * @property string|null $memo 메모
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Hotel|null $hotel
 * @property-read \App\Hotel|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|HotelManager newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelManager newQuery()
 * @method static \Illuminate\Database\Query\Builder|HotelManager onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelManager query()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelManager whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelManager whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelManager whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelManager whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelManager whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelManager whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelManager whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|HotelManager withTrashed()
 * @method static \Illuminate\Database\Query\Builder|HotelManager withoutTrashed()
 * @mixin \Eloquent
 */
	class HotelManager extends \Eloquent {}
}

namespace App{
/**
 * App\HotelOption
 *
 * @property int $id
 * @property int $hotel_id
 * @property int $user_id 작성자 user id
 * @property string $title 상품 명
 * @property string $price 원가격
 * @property string $sale_price 판매가
 * @property string $discount_rate 할인률
 * @property string $refund_amount 취소환불금액
 * @property string $explanation 설명
 * @property string $sub_explanation 서브 설명
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $uploaded_time
 * @property-read \App\Hotel $hotel
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereDiscountRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereRefundAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereSubExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereUserId($value)
 * @mixin \Eloquent
 * @property string $title_en 상품 영어명
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereTitleEn($value)
 * @property string|null $sale_url 판매 링크
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereSaleUrl($value)
 * @property string|null $facilities 시설
 * @property string|null $amenities 도구
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereAmenities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereFacilities($value)
 * @property string|null $area 지역주소
 * @property string|null $lat 위도
 * @property string|null $lng 경도
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereLng($value)
 * @property string|null $disable 비활성화
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereDisable($value)
 * @property string|null $benefit 혜택 리스트 |
 * @property string|null $benefit_only 혜택 only 표시
 * @property string|null $benefit_type 혜택 type 표시
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereBenefit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereBenefitOnly($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereBenefitType($value)
 * @property string|null $subway_station 근처 지하철 역
 * @method static \Illuminate\Database\Eloquent\Builder|HotelOption whereSubwayStation($value)
 * @property-read \Illuminate\Support\Collection $title_explode
 * @property-read \Illuminate\Support\Collection $amenities_explode
 * @property-read \Illuminate\Support\Collection $benefits_explode
 * @property-read \Illuminate\Support\Collection $facilities_explode
 */
	class HotelOption extends \Eloquent {}
}

namespace App{
/**
 * App\HotelReservation
 *
 * @property int $id
 * @property int $hotel_id
 * @property string|null $room_id 한달살기 일 경우 룸 id
 * @property string $order_id 구매 ID 랜덤
 * @property string|null $curator_id 판매 큐레이터 ID
 * @property string|null $type 호텔투어=tour, 한달살기=month, 구독=subscribe
 * @property string|null $order_name 구매자 명
 * @property string|null $order_hp 구매자 연락처
 * @property string|null $order_email 구매자 이메일
 * @property string|null $use_terms Y,N 구매자 이용약관 동의 (필수)
 * @property string|null $order_privacy Y,N 구매자 개인정보 활용 동의 (필수)
 * @property string|null $order_marketing Y,N 마케팅 동의
 * @property string|null $order_status 1=진행중, 2=주문완료, 3=결제완료, 4=사용완료, 5=입주중, 8=결제시도, 9=보류, 0=취소상태
 * @property string|null $order_price 원가
 * @property string|null $order_sale_price 판매금액
 * @property string|null $order_discount_rate 할인률
 * @property string|null $order_refund_amount 취소시 환불
 * @property string|null $order_sale_url 구매 링크
 * @property string|null $order_desired_dt 희망 날자
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Confirmation|null $confirmation
 * @property-read \App\Curator|null $curator
 * @property-read string $uploaded_time
 * @property-read \App\Hotel $hotel
 * @property-read \App\Payment|null $payment
 * @property-read \App\HotelRoom|null $room
 * @method static Builder|HotelReservation newModelQuery()
 * @method static Builder|HotelReservation newQuery()
 * @method static Builder|HotelReservation query()
 * @method static Builder|HotelReservation whereCreatedAt($value)
 * @method static Builder|HotelReservation whereCuratorId($value)
 * @method static Builder|HotelReservation whereHotelId($value)
 * @method static Builder|HotelReservation whereId($value)
 * @method static Builder|HotelReservation whereOrderDesiredDt($value)
 * @method static Builder|HotelReservation whereOrderDiscountRate($value)
 * @method static Builder|HotelReservation whereOrderEmail($value)
 * @method static Builder|HotelReservation whereOrderHp($value)
 * @method static Builder|HotelReservation whereOrderId($value)
 * @method static Builder|HotelReservation whereOrderMarketing($value)
 * @method static Builder|HotelReservation whereOrderName($value)
 * @method static Builder|HotelReservation whereOrderPrice($value)
 * @method static Builder|HotelReservation whereOrderPrivacy($value)
 * @method static Builder|HotelReservation whereOrderRefundAmount($value)
 * @method static Builder|HotelReservation whereOrderSalePrice($value)
 * @method static Builder|HotelReservation whereOrderSaleUrl($value)
 * @method static Builder|HotelReservation whereOrderStatus($value)
 * @method static Builder|HotelReservation whereRoomId($value)
 * @method static Builder|HotelReservation whereType($value)
 * @method static Builder|HotelReservation whereUpdatedAt($value)
 * @method static Builder|HotelReservation whereUseTerms($value)
 * @mixin \Eloquent
 * @method static Builder|HotelReservation orWhereLike($column, $value)
 * @method static Builder|HotelReservation whereLike($column, $value)
 * @property string|null $browser 사용자 브라우저
 * @property string|null $device 사용자 디바이스
 * @property string|null $os 사용자 os
 * @method static Builder|HotelReservation whereBrowser($value)
 * @method static Builder|HotelReservation whereDevice($value)
 * @method static Builder|HotelReservation whereOs($value)
 * @property int|null $term_id 신청 기간 id
 * @method static Builder|HotelReservation whereTermId($value)
 * @property int $room_type_id 고객 선택 입주 룸 타입
 * @method static Builder|HotelReservation whereRoomTypeId($value)
 * @property int|null $room_type_upgrade_id 고객 선택 입주 룸 업그레이드 id
 * @method static Builder|HotelReservation whereRoomTypeUpgradeId($value)
 * @property string|null $purpose 입주 목적
 * @property string|null $visit_route 방문 경로
 * @property-read string|null $room_type_name
 * @property-read string|null $room_type_upgrade_name
 * @method static Builder|HotelReservation wherePurpose($value)
 * @method static Builder|HotelReservation whereVisitRoute($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AlertTalkList[] $alertTalkLists
 * @property-read int|null $alert_talk_lists_count
 * @property-read \App\customerExperiences|null $customerExperience
 * @property int $user_id 회원 ID
 * @property-read int $payment_count
 * @property-read \App\HotelRoomType|null $roomType
 * @method static Builder|HotelReservation whereUserId($value)
 * @property-read \App\User|null $user
 * @property-read \App\External|null $external
 * @property-read \App\HotelRoomType|null $roomTypeUpgrade
 * @property string|null $read_at 읽은 시간
 * @method static Builder|HotelReservation whereReadAt($value)
 * @property string|null $country_code 국가 코드
 * @property-read \App\ReservationCancel|null $reservationCancel
 * @property-read \App\ReservationModify|null $reservationModify
 * @method static Builder|HotelReservation whereCountryCode($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Confirmation[] $confirmations
 * @property-read int|null $confirmations_count
 * @property-read mixed $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Payment[] $payments
 * @property-read int|null $payments_count
 * @method static Builder|HotelReservation statusFlitter($flitter)
 * @property-read \App\NoShow|null $noShow
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\NoShow[] $noShows
 * @property-read int|null $no_shows_count
 */
	class HotelReservation extends \Eloquent {}
}

namespace App{
/**
 * App\HotelReview
 *
 * @property int $id
 * @property int $hotel_id
 * @property int $hotel_room_type_id
 * @property string $name 리뷰어 성명
 * @property string $job 리뷰어 직업
 * @property string $star 리뷰어 별점
 * @property string $content 내용
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $created_time
 * @property-read string $uploaded_time
 * @property-read \App\Hotel $hotel
 * @property-read \App\HotelRoomType $hotel_room_type
 * @method static Builder|HotelReview newModelQuery()
 * @method static Builder|HotelReview newQuery()
 * @method static Builder|HotelReview query()
 * @method static Builder|HotelReview whereContent($value)
 * @method static Builder|HotelReview whereCreatedAt($value)
 * @method static Builder|HotelReview whereHotelId($value)
 * @method static Builder|HotelReview whereHotelRoomTypeId($value)
 * @method static Builder|HotelReview whereId($value)
 * @method static Builder|HotelReview whereJob($value)
 * @method static Builder|HotelReview whereName($value)
 * @method static Builder|HotelReview whereStar($value)
 * @method static Builder|HotelReview whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $option
 * @property string|null $visible 활성화
 * @property string|null $input_completed_at 작성일
 * @method static Builder|HotelReview whereInputCompletedAt($value)
 * @method static Builder|HotelReview whereOption($value)
 * @method static Builder|HotelReview whereVisible($value)
 * @property string|null $images 리뷰 이미지
 * @property string|null $link 링크
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Support\Collection $image_explode
 * @method static \Illuminate\Database\Query\Builder|HotelReview onlyTrashed()
 * @method static Builder|HotelReview whereDeletedAt($value)
 * @method static Builder|HotelReview whereImages($value)
 * @method static Builder|HotelReview whereLink($value)
 * @method static \Illuminate\Database\Query\Builder|HotelReview withTrashed()
 * @method static \Illuminate\Database\Query\Builder|HotelReview withoutTrashed()
 * @property string|null $order 순서
 * @method static Builder|HotelReview whereOrder($value)
 */
	class HotelReview extends \Eloquent {}
}

namespace App{
/**
 * App\HotelRoom
 *
 * @property int $id
 * @property int $hotel_id
 * @property int $user_id 작성자 user id
 * @property string|null $title 룸 명칭
 * @property string|null $name 룸 타입명
 * @property string|null $sale_url 판매링크
 * @property string|null $price 원가격
 * @property string|null $sale_price 판매가
 * @property string|null $discount_rate 할인률
 * @property string|null $refund_amount 취소환불금액
 * @property string|null $main_explanation 룸 하단 설명 ex] 0박 0일 / 룸 택 1
 * @property string|null $explanation 설명
 * @property string|null $sub_explanation 서브 설명
 * @property string|null $disable 비활성화
 * @property string|null $visible 상품 리스트 내 출력
 * @property string|null $order 룸 순서
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $uploaded_time
 * @property-read \App\Hotel $hotel
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom query()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereDisable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereDiscountRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereMainExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereRefundAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereSaleUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereSubExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereVisible($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelReservation[] $reservations
 * @property-read int|null $reservations_count
 * @property string|null $upgrade 룸 업그레이드 여부
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereUpgrade($value)
 * @property string|null $nights 몇박
 * @property string|null $days 몇일
 * @property string|null $coupon 쿠폰명
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereCoupon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereNights($value)
 * @property string|null $room_option 룸 옵션
 * @property string|null $room_sold_out 룸 옵션 판매처리
 * @property string|null $room_upgrade 룸 옵션 업그레이드
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereRoomOption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereRoomSoldOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereRoomUpgrade($value)
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|HotelRoom onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|HotelRoom withTrashed()
 * @method static \Illuminate\Database\Query\Builder|HotelRoom withoutTrashed()
 * @property string|null $memo
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoom whereMemo($value)
 */
	class HotelRoom extends \Eloquent {}
}

namespace App{
/**
 * App\HotelRoomType
 *
 * @property int $id
 * @property int|null $hotel_id 호텔 id
 * @property int|null $user_id user(관리자) id
 * @property string|null $name 룸 배드 명칭
 * @property string|null $main_explanation 룸 배드 개수
 * @property string|null $sub_explanation 룸 타입 하단 추가 설명
 * @property string|null $order 룸 타입 정렬순
 * @property string|null $visible 룸 타입 보일지
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType query()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereMainExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereSubExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereVisible($value)
 * @mixin \Eloquent
 * @property string|null $image 룸 이미지
 * @property string|null $sold_out 판매 완료=1, 판매중=0
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereSoldOut($value)
 * @property string|null $upgrade 업그레이드 용 N Y
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereUpgrade($value)
 * @property int $sale_possibility_count 판매 가능 총 개수
 * @method static \Illuminate\Database\Eloquent\Builder|HotelRoomType whereSalePossibilityCount($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\HotelReservation[] $reservations
 * @property-read int|null $reservations_count
 */
	class HotelRoomType extends \Eloquent {}
}

namespace App{
/**
 * App\HotelSorts
 *
 * @property int $id
 * @property int|null $hotel_id
 * @property string|null $main 정렬 종료
 * @property string|null $order 정렬 순서
 * @property string|null $start_dt 시작 dt
 * @property string|null $end_dt 종료 dt
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts newQuery()
 * @method static \Illuminate\Database\Query\Builder|HotelSorts onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts query()
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereEndDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereStartDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|HotelSorts withTrashed()
 * @method static \Illuminate\Database\Query\Builder|HotelSorts withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $sub 정렬 서브
 * @property string|null $type 타입 구분
 * @property string|null $memo 메모 설명
 * @property-read \App\Hotel|null $hotel
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereMain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HotelSorts whereSub($value)
 */
	class HotelSorts extends \Eloquent {}
}

namespace App{
/**
 * App\Icon
 *
 * @property int $id
 * @property string|null $name 해당 SVG name : 침대, 식수, 수건 등
 * @property string|null $explanation 해당 SVG 설명
 * @property string|null $type 사용 범위 예: benefit, amenities, facilities, all-전체, logo, form 등
 * @property string|null $content 실제 SVG 데이터
 * @property string|null $url S3 SVG 링크
 * @property int|null $order 정렬 순서
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Icon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Icon newQuery()
 * @method static \Illuminate\Database\Query\Builder|Icon onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Icon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Icon whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Icon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Icon whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Icon whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Icon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Icon whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Icon whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Icon whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Icon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Icon whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|Icon withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Icon withoutTrashed()
 * @mixin \Eloquent
 */
	class Icon extends \Eloquent {}
}

namespace App{
/**
 * App\InformationGeneration
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InformationGeneration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InformationGeneration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InformationGeneration query()
 * @mixin \Eloquent
 */
	class InformationGeneration extends \Eloquent {}
}

namespace App{
/**
 * App\NoShow
 *
 * @property int $id
 * @property int|null $reservation_id
 * @property int|null $confirmation_id
 * @property int|null $hotel_id
 * @property int|null $user_id
 * @property int|null $hotel_manager_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\HotelReservation|null $reservation
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow newQuery()
 * @method static \Illuminate\Database\Query\Builder|NoShow onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow query()
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow whereConfirmationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoShow whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|NoShow withTrashed()
 * @method static \Illuminate\Database\Query\Builder|NoShow withoutTrashed()
 * @mixin \Eloquent
 */
	class NoShow extends \Eloquent {}
}

namespace App{
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
	class Notice extends \Eloquent {}
}

namespace App{
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
	class Notification extends \Eloquent {}
}

namespace App{
/**
 * App\Payment
 *
 * @property int $id
 * @property int $reservation_id 주문 ID
 * @property string $order_id 결제 주문 리턴: OID [년월일시분초-랜덤숫자1000~9999]
 * @property string|null $card_type 카드 결제 방식 02=앱카드, 01=간편결제
 * @property string|null $pay_type 결제 방식
 * @property string|null $pay_url 결제 처리 url
 * @property string|null $name 구매자 명
 * @property string|null $email 구매자 이메일
 * @property string|null $hp 구매자 연락처
 * @property string|null $goods_tax 택스 방식
 * @property string|null $goods_name 상품명
 * @property string|null $goods_option 상품 옵션
 * @property string|null $total_price 총 결제 가격
 * @property string|null $status 결제 상태 1=진행중, 2=주문완료, 3=결제완료, 4=사용완료, 9=보류, 0=취소상태
 * @property string|null $message 상태 메세지
 * @property string|null $result_message 결과 메세지
 * @property string|null $referer_url 결제 접근 URL
 * @property \Illuminate\Support\Carbon|null $order_completed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $order_completed_time
 * @property-read string $uploaded_time
 * @property-read \App\HotelReservation $reservation
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCardType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereGoodsName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereGoodsOption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereGoodsTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereOrderCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePayUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereRefererUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereResultMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $memo 메모용
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereMemo($value)
 * @property string|null $cancel_price 취소금액=고객 전달 환불금
 * @property string|null $hotel_refund 호텔 전달 환불금
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCancelPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereHotelRefund($value)
 * @property-read \App\Hotel|null $hotel
 * @property string|null $ga_check 구글 GA 적용체크
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereGaCheck($value)
 * @property string|null $add_price 추가(연장) 금액
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAddPrice($value)
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Settlement[] $settlement
 * @property-read int|null $settlement_count
 * @method static \Illuminate\Database\Query\Builder|Payment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Payment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Payment withoutTrashed()
 */
	class Payment extends \Eloquent {}
}

namespace App{
/**
 * App\PeriodPrice
 *
 * @property int $id
 * @property int|null $hotel_id
 * @property int|null $scheduler_id
 * @property int|null $room_type_id 룸 Type ID
 * @property int|null $admin_id 관리자 ID
 * @property int|null $date 일 수 ~
 * @property int|null $price 해당 일수의 가격
 * @property string|null $memo 메모
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodPrice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodPrice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodPrice query()
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodPrice whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodPrice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodPrice whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodPrice whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodPrice whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodPrice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodPrice whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodPrice wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodPrice whereRoomTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodPrice whereSchedulerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeriodPrice whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class PeriodPrice extends \Eloquent {}
}

namespace App{
/**
 * App\Reason
 *
 * @property int $id
 * @property int|null $admin_id Tm 관리자 ID
 * @property int|null $add_hotel_id 입점 신청 호텔 ID
 * @property int|null $hotel_manager_id 호텔 매니저 User ID
 * @property string|null $type 종류 : 입점신청, 이외 계약, 이벤트 등
 * @property string|null $explanation 사유 180자 이하
 * @property string|null $sub_explanation 사유 설명 180자 이하
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $admin
 * @property-read \App\AddHotel|null $hotel
 * @property-read \App\User|null $manager
 * @method static \Illuminate\Database\Eloquent\Builder|Reason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reason newQuery()
 * @method static \Illuminate\Database\Query\Builder|Reason onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Reason query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereAddHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereHotelManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereSubExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Reason withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Reason withoutTrashed()
 * @mixin \Eloquent
 */
	class Reason extends \Eloquent {}
}

namespace App{
/**
 * App\Recommendation
 *
 * @property int $id
 * @property string $tel 연락처
 * @property string $recommendation
 * @property string $privacy 개인정보동의
 * @property string|null $marketing 마케팅
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Support\Collection $recommendations
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereMarketing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation wherePrivacy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereRecommendation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Recommendation extends \Eloquent {}
}

namespace App{
/**
 * App\ReservationCancel
 *
 * @property int $id
 * @property int|null $reservation_id
 * @property int|null $user_id
 * @property int|null $admin_id
 * @property string|null $process 진행 상태
 * @property string|null $memo 전송내용
 * @property string|null $send_dt 신청 dt
 * @property string|null $process_dt 처리 시간 dt
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $admin
 * @property-read \App\HotelReservation|null $reservation
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel newQuery()
 * @method static \Illuminate\Database\Query\Builder|ReservationCancel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereProcess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereProcessDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereSendDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationCancel whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|ReservationCancel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ReservationCancel withoutTrashed()
 * @mixin \Eloquent
 */
	class ReservationCancel extends \Eloquent {}
}

namespace App{
/**
 * App\ReservationModify
 *
 * @property int $id
 * @property int|null $reservation_id
 * @property int|null $user_id
 * @property int|null $admin_id
 * @property string|null $process 진행 상태 1=신청 2=문의중 3=확정 4=미확정(재문의)
 * @property string|null $diff_day
 * @property string|null $memo 전송내용
 * @property string|null $before_start_dt
 * @property string|null $before_end_dt
 * @property string|null $start_dt 신청 기간 dt
 * @property string|null $end_dt 신청 기간 dt
 * @property string|null $send_dt 신청 dt
 * @property string|null $process_dt 처리 시간 dt
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $admin
 * @property-read \App\HotelReservation|null $reservation
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify newQuery()
 * @method static \Illuminate\Database\Query\Builder|ReservationModify onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereBeforeEndDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereBeforeStartDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereDiffDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereEndDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereProcess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereProcessDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereSendDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereStartDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReservationModify whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|ReservationModify withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ReservationModify withoutTrashed()
 * @mixin \Eloquent
 */
	class ReservationModify extends \Eloquent {}
}

namespace App{
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
	class Schedule extends \Eloquent {}
}

namespace App{
/**
 * App\Scheduler
 *
 * @property int $id
 * @property int|null $hotel_id
 * @property int|null $period_price_id
 * @property int|null $admin_id
 * @property string|null $start_dt 출력 시작 dt
 * @property string|null $end_dt 종료 dt
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Scheduler newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Scheduler newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Scheduler query()
 * @method static \Illuminate\Database\Eloquent\Builder|Scheduler whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Scheduler whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Scheduler whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Scheduler whereEndDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Scheduler whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Scheduler whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Scheduler wherePeriodPriceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Scheduler whereStartDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Scheduler whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Scheduler extends \Eloquent {}
}

namespace App{
/**
 * App\Settlement
 *
 * @property int $id
 * @property int|null $payment_id
 * @property int|null $admin_id 관리자 id
 * @property int|null $price 이전 판매금
 * @property int|null $add_price 추가금
 * @property int|null $calculate 정산금
 * @property string|null $memo 메모
 * @property string|null $calculate_memo
 * @property string|null $calculate_yn 정산 체크
 * @property string|null $save_dt 저장 시간 dt
 * @property string|null $mail_send_dt 메일 전송 체크 시간
 * @property string|null $calculate_dt 정산완료 체크 시간
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $admin
 * @property-read mixed $calculate_time
 * @property-read mixed $mail_send_time
 * @property-read string $uploaded_time
 * @property-read \App\Payment|null $payment
 * @property-read \App\HotelReservation|null $reservation
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement newQuery()
 * @method static \Illuminate\Database\Query\Builder|Settlement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereAddPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereCalculate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereCalculateDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereCalculateMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereCalculateYn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereMailSendDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereSaveDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Settlement withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Settlement withoutTrashed()
 * @mixin \Eloquent
 * @property int|null $confirmation_id
 * @method static \Illuminate\Database\Eloquent\Builder|Settlement whereConfirmationId($value)
 */
	class Settlement extends \Eloquent {}
}

namespace App{
/**
 * App\Template
 *
 * @property int $id
 * @property string $company 발신프로필
 * @property string|null $code 템플릿 코드
 * @property string|null $catalog 종류
 * @property string|null $name 템플릿 명
 * @property string $template 템플릿
 * @property string|null $button 템플릿 버튼
 * @property string|null $web_url 템플릿 웹 링크
 * @property string|null $mobile_url 템플릿 모바일 링크
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Template newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Template newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Template query()
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereButton($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereCatalog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereMobileUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereWebUrl($value)
 * @mixin \Eloquent
 * @property string|null $use 0 = 미사용, 1 = 사용
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereUse($value)
 * @property string|null $variable 변수 설정
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereVariable($value)
 */
	class Template extends \Eloquent {}
}

namespace App{
/**
 * App\Term
 *
 * @property int $id
 * @property int|null $hotel_id 주문 id
 * @property int|null $sale_room_id 룸 할인 id
 * @property int|null $user_id user(관리자) id
 * @property string|null $block 잠금=1, 미잠금=0
 * @property string|null $type type 0=tour,1=hotel
 * @property int|null $reservation_count 주문 가능 개수
 * @property int|null $sale_count 판매 가능 개수
 * @property string $memo 메모
 * @property \Illuminate\Support\Carbon|null $start_dt 입주 dt
 * @property \Illuminate\Support\Carbon|null $end_dt 퇴실 dt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Hotel|null $hotel
 * @method static \Illuminate\Database\Eloquent\Builder|Term newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Term newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Term query()
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereBlock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereEndDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereHotelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereReservationCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereSaleCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereSaleRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereStartDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Term whereUserId($value)
 * @mixin \Eloquent
 * @property-read array $between_date
 */
	class Term extends \Eloquent {}
}

namespace App{
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
 */
	class User extends \Eloquent {}
}

