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

class RecommendationExport implements WithProperties,FromCollection, ShouldAutoSize, WithHeadings
{
    public function properties(): array
    {
        return [
            'title' => '호텔 추천 리스트',
            'description' => '',
            'subject' => '',
            'keywords' => '',
            'category' => '',
            /*'manager'        => '',*/
        ];
    }

    /* 컬럼 명 적용*/
    public function headings(): array
    {
        return [
            'IDX',
            '연락처',
            '추천',
            '필수동의',
            '마케팅',
            '생성일',
            '수정일',
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
        return Recommendation::where('marketing', '=', '1')->get();
    }
}
