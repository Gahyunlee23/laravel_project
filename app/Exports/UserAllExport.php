<?php

namespace App\Exports;

use App\HotelReservation;
use App\Recommendation;
use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UserAllExport implements WithProperties,FromCollection, ShouldAutoSize, WithHeadings
{
    public function properties(): array
    {
        return [
            'title' => '회원_전체_리스트',
            'description' => '회원_전체_리스트',
            'subject' => '',
            'keywords' => '회원 전체 리스트',
            'category' => '',
        ];
    }

    /* 컬럼 명 적용*/
    public function headings(): array
    {
        return [
            'ID',
            '회원명',
            '회원명_Check',
            '닉네임',
            '이메일',
            '이메일_Check',
            '프로필IMG',
            'Kakao ID',
            '연락처',
            '휴대전화',
            '국가 코드',
            '휴대전화_Check',
            '연령대',
            '생년',
            '생월',
            '성별',
            '마케팅 동의',
            '이메일 인증',
            '패스',
            '패스_Check',
            'remember_token',
            '삭제시간',
            '생성시간',
            '수정시간'
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
        return User::whereDoesntHave('roles')->get();
    }
}
