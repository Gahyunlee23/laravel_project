<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Formatter
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Formatter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Formatter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Formatter query()
 * @mixin \Eloquent
 */
class Formatter extends Model
{

    /* 연락처 공백 - . 삭제 처리 function */
    public function templateFormat($template, $data): string
    {
        $temp = $template;
        foreach ($data as $key => $value) {
            $temp = Str::of($temp)->replace($key, $value);
        }
        return Str::of($temp)->trim()->__toString();
    }

    /* 연락처 공백 - . 삭제 처리 function */
    public function hpFormat($hp): \Illuminate\Support\Stringable
    {
        return Str::of($hp)->replace('-', '')->replace('.', '')->trim();
    }

    /* Carbon 처리 function */
    public function carbonFormat($date, $format): string
    {
        $data = null;
        $temp = Carbon::parse($date);

        $tempWeekNumber='';
        switch ($temp->dayOfWeek){
            case 0 :
                $tempWeekNumber='(일)';
            break;
            case 1 :
                $tempWeekNumber='(월)';
            break;
            case 2 :
                $tempWeekNumber='(화)';
            break;
            case 3 :
                $tempWeekNumber='(수)';
            break;
            case 4 :
                $tempWeekNumber='(목)';
            break;
            case 5 :
                $tempWeekNumber='(금)';
            break;
            case 6 :
                $tempWeekNumber='(토)';
            break;
        }

        switch ($format) {
            case 'Y년m월d일 H:i' :
                $data = $temp->format('Y') . '년' . $temp->format('m') . '월' . $temp->format('d') . '일 ' . $temp->format('H:i');
            break;

            case 'Y년m월d일 H시i분' :
                if ($temp->format('i') === '00') {
                    $data = $temp->format('Y') . '년' . $temp->format('m') . '월' . $temp->format('d') . '일 ' . $temp->format('H') . '시';
                } else {
                    $data = $temp->format('Y') . '년' . $temp->format('m') . '월' . $temp->format('d') . '일 ' . $temp->format('H') . '시' . $temp->format('i') . '분';
                }
            break;

            case 'Y년 m월 d일 H시i분' :
                if ($temp->format('i') === '00') {
                    $data = $temp->format('Y') . '년 ' . $temp->format('m') . '월 ' . $temp->format('d') . '일 ' . $temp->format('H') . '시';
                } else {
                    $data = $temp->format('Y') . '년 ' . $temp->format('m') . '월 ' . $temp->format('d') . '일 ' . $temp->format('H') . '시' . $temp->format('i') . '분';
                }
            break;

            case 'Y년 m월 d일' :
                if ($temp->format('i') === '00') {
                    $data = $temp->format('Y') . '년 ' . $temp->format('m') . '월 ' . $temp->format('d') . '일';
                } else {
                    $data = $temp->format('Y') . '년 ' . $temp->format('m') . '월 ' . $temp->format('d') . '일';
                }
            break;

            case 'Y년 m월 d일(요일)' :
                if ($temp->format('i') === '00') {
                    $data = $temp->format('Y') . '년 ' . $temp->format('m') . '월 ' . $temp->format('d') . '일'.$tempWeekNumber;
                } else {
                    $data = $temp->format('Y') . '년 ' . $temp->format('m') . '월 ' . $temp->format('d') . '일'.$tempWeekNumber;
                }
            break;
            case 'Y년 m월 d일(요일) H시 i분' :
                if ($temp->format('i') === '00') {
                    if ($temp->format('H') === '00') {
                        $data = $temp->format('Y') . '년 ' . $temp->format('m') . '월 ' . $temp->format('d') . '일'.$tempWeekNumber;
                    }else{
                        $data = $temp->format('Y') . '년 ' . $temp->format('m') . '월 ' . $temp->format('d') . '일'.$tempWeekNumber.' '.$temp->format('H').'시';
                    }
                } else {
                    $data = $temp->format('Y') . '년 ' . $temp->format('m') . '월 ' . $temp->format('d') . '일'.$tempWeekNumber.' '.$temp->format('H').'시 '.$temp->format('i').'분';
                }
            break;

            case 'Y년 m월 d일(요일) H:i' :
                if ($temp->format('i') === '00') {
                    if ($temp->format('H') === '00') {
                        $data = $temp->format('Y') . '년 ' . $temp->format('m') . '월 ' . $temp->format('d') . '일'.$tempWeekNumber;
                    }else{
                        $data = $temp->format('Y') . '년 ' . $temp->format('m') . '월 ' . $temp->format('d') . '일'.$tempWeekNumber.' '.$temp->format('H');
                    }
                } else {
                    $data = $temp->format('Y') . '년 ' . $temp->format('m') . '월 ' . $temp->format('d') . '일'.$tempWeekNumber.' '.$temp->format('H').':'.$temp->format('i');
                }
                break;

            case 'H시i분' :
                if ($temp->format('i') === '00') {
                    $data = $temp->format('H') . '시';
                } else {
                    $data = $temp->format('H') . '시' . $temp->format('i') . '분';
                }
            break;

            default :
                $data = $temp->format($format);
        }
        return $data;
    }

}
