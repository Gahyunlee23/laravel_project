<?php

namespace App\Exports;

use App\HotelReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class HotelReservationsExport implements WithProperties,FromCollection, ShouldAutoSize, WithHeadings
{

    protected $reservations;

    public function properties(): array
    {
        return [
            'title' => '주문 정보 엑셀',
            'description' => '주문 정보 리스트',
            'subject' => '주문 정보',
            'keywords' => '주문 정보,관리자',
            'category' => '주문 정보',
            /*'manager'        => '',*/
        ];
    }


    /* 컬럼 명 적용 WithHeadings */
    public function headings(): array
    {
        return [
            '확정 시작', '확정 종료', '확정 상태 1=정상, 2=취소',
            'ID', '호텔 ID', '회원 ID', '룸 ID', '구매 ID', '판매 큐레이터 ID', '신청 기간 id',
            '고객 선택 룸 타입', '룸 업그레이드 id',
            '호텔투어=tour, 한달살기=month, 구독=subscribe',
            '구매자 명', '구매자 연락처', '국가코드', '구매자 이메일',
            'Y,N 구매자 이용약관 동의 (필수)', 'Y,N 구매자 개인정보 활용 동의 (필수)', 'Y,N 마케팅 동의',
            '3=결제완료, 4=사용완료, 5=입주중, 6=퇴실완료, 8=결제시도, 9=보류, 0=취소상태 ',
            '원가', '판매금액', '할인률', '취소시 환불',
            '구매 링크',
            '희망 날자',
            '입주 목적', '방문 경로',
            '사용자 브라우저', '사용자 디바이스', '사용자 os', '마이페이지 읽음',
            '주문 시작 시간', '주문 완료 등 취소 시간',
            '호텔 명', '구매 상품', '구매시간',
            '진행시간','선택 룸 명칭', '업그레이드 룸 명칭',
        ];
    }

    /* 컬럼 맵핑 WithMapping 추가해줘야됨*/
    /*public function map($invoice): array
    {
        return [
            $invoice->invoice_number,
            $invoice->user->name,
            Date::dateTimeToExcel($invoice->created_at),
        ];
    }*/

    /* 컬럼 별 width 조절*/
    /*public function columnWidths(): array
    {
        return [
            'A' => 55,
            'B' => 45,
        ];
    }*/

    /* 출력 방식 설정 WithColumnFormatting */
    /*public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'C' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
        ];
    }*/

    /* 폰트 사이즈 등 설정*/
    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
            /* 'B2' => ['font' => ['italic' => true]],*/
            /* 'C'  => ['font' => ['size' => 16]],*/
        ];
    }

    public function __construct($reservations)
    {
        $this->reservations = $reservations;
    }

    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return $this->reservations->get();
    }
}
