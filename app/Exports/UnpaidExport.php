<?php

namespace App\Exports;

use App\HotelReservation;
use App\Recommendation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UnpaidExport implements WithProperties,FromCollection, ShouldAutoSize, WithHeadings
{
    public function properties(): array
    {
        return [
            'title' => '입주_주문_미결제_리스트',
            'description' => '주문 리스트 중 입주 주문의 미결제 리스트',
            'subject' => '',
            'keywords' => '미결제 인원 리스트',
            'category' => '',
            /*'manager'        => '',*/
        ];
    }

    /* 컬럼 명 적용*/
    public function headings(): array
    {
        return [
            'IDX',
            '호텔 ID',
            '유저 ID',
            'Room ID',
            '주문 ID',
            '큐레이터 ID',
            '기간 ID',
            '룸타입 ID',
            '업그레이드 룸타입 ID',
            '주문 Type',
            '주문자명',
            '주문자 연락처',
            '연락처 코드',
            '이메일',
            '이용약관',
            '개인 정보 활용',
            '마케팅',
            '주문 상태 1=진행중, 2=주문완료, 3=결제완료, 4=사용완료, 5=입주중, 6=퇴실완료, 8=결제시도, 9=보류, 0=(환불)취소상태, 10-부분취소, 11=중도퇴실',
            '원가',
            '판매금액',
            '할인률',
            '취소시 환불',
            '구매 링크',
            '희망 날자',
            '입주 목적',
            '방문 경로',
            '사용자 브라우저',
            '사용자 디바이스',
            '사용자 os',
            '읽은 시간',
            '생성 시간',
            '수정 시간',
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

    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return HotelReservation::whereType('month')->whereIn('order_status', [2,8])->get();
    }
}
