<?php

namespace App\Http\Livewire\Admin\Calculation;

use App\HotelReservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Price extends Component
{
    public $reservations;

    public $curatorSearch,$curatorVisible,$searchData;

    public $sum=0,$addSum=0,$cancelSum=0;

    public function render()
    {
        return view('livewire.admin.calculation.price');
    }

    public function calculation(){
        $this->sum=0;
        $this->addSum=0;
        $this->cancelSum=0;

        if(session::has('currentPage')){
            $this->currentPage = session('currentPage');
        }
        if(session::has('searchData')){
            $this->searchData=session('searchData');
        }
        $reservations=HotelReservation::with(
            [
                'hotel'=>function($query){
                    $query->where('status','=','2')->orderBy('id');
                },
                'room'=>function($query){
                    $query->whereDisable('N');
                    $query->orderBy('id');
                },
                'curator'=>function($query){
                    $query->whereVisible('1');
                    $query->orderBy('id');
                },
                'confirmation',
                'payment',
            ])->where(function ($query) {
            if ($this->curatorSearch !== '' && $this->curatorSearch !== null) {
                $query->whereHas('curator', function ($query) {
                    $query->where('user_id', 'like', '%' . $this->curatorSearch . '%');
                    $query->orwhere('user_page', 'like', '%' . $this->curatorSearch . '%');
                    $query->orwhere('name', 'like', '%' . $this->curatorSearch . '%');
                    $query->orwhere('email', 'like', '%' . $this->curatorSearch . '%');
                });
            }
            if ($this->curatorVisible === '1') {
                $query->whereNull('curator_id');
            } else if ($this->curatorVisible === '0') {
                $query->whereNotNull('curator_id');
            }
            if (isset($this->searchData['detailStatus']) && $this->searchData['detailStatus'] !== '' && $this->searchData['detailStatus'] !== null) {

                switch ($this->searchData['detailStatus']){
                    case 'all' :
                        break;
                    /*투어*/
                    case '투어' :
                        $query->whereType('tour');
                        break;
                    case '신청완료' :
                        $query->whereType('tour');
                        $query->whereOrderStatus(2);
                        break;
                    case '미확정' :
                        $query->whereType('tour');
                        $query->whereOrderStatus(2)->doesntHave('confirmation');
                        break;
                    case '확정' :
                        $query->whereType('tour');
                        $query->where('order_status','=','5')->whereHas('confirmation', function ($query) {
                            $query->where('start_dt', '>', Carbon::now()->format('y-m-d H:i:s'));
                        });
                        break;
                    case '투어종료' :
                        $query->whereType('tour');
                        $query->where('order_status','=','5')->whereHas('confirmation', function ($query) {
                            $query->where('start_dt', '<=', Carbon::now()->format('y-m-d H:i:s'));
                        });
                        break;
                    case '투어취소' :
                        $query->whereType('tour');
                        $query->whereOrderStatus(0);
                        break;

                    /* 입주 */
                    case '입주' :
                        $query->whereType('month');
                        break;
                    case '주문완료' :
                        $query->whereType('month');
                        $query->whereOrderStatus(2);
                        break;
                    case '결제완료' :
                        $query->whereType('month');
                        $query->where(function ($query){
                            $query->where('order_status','=',3)
                                ->orWhere('order_status','=',4)
                                ->orWhere('order_status','=',5)
                                ->orWhere('order_status','=',6);
                        });
                        break;
                    case '미확정,결제완료' :
                        $query->whereType('month');
                        $query->whereOrderStatus(3)->doesntHave('confirmation');
                        break;
                    case '확정,결제완료' :
                        $query->whereType('month');
                        $query->where(function ($query){
                            $query->where('order_status','=',3)
                                ->orWhere('order_status','=',4)
                                ->orWhere('order_status','=',5);
                        })->whereHas('confirmation',function ($query) {
                            $query->where('start_dt', '>=', Carbon::now()->format('Y-m-d H:i:s'));
                        });
                        break;
                    case '입주중' :
                        $query->whereType('month');
                        $query->whereOrderStatus(5)->whereHas('confirmation', function ($query) {
                            $query->where('start_dt', '<=', Carbon::now()->format('Y-m-d H:i:s'));
                            $query->where('end_dt', '>=', Carbon::now()->format('Y-m-d H:i:s'));
                        });
                        break;
                    case '퇴실완료' :
                        $query->whereType('month');
                        $query->whereOrderStatus(5)->whereHas('confirmation', function ($query) {
                            $query->where('end_dt', '<=', Carbon::now()->format('Y-m-d H:i:s'));
                        });
                        break;
                    case '중도퇴실' :
                        $query->whereType('month');
                        $query->whereOrderStatus(11);
                        break;
                    case '입주취소' :
                        $query->whereType('month');
                        $query->whereOrderStatus(0);
                        break;
                }
            }

            if ( (isset($this->searchData['orderDt1']) && $this->searchData['orderDt1']!=='') || (isset($this->searchData['orderDt2']) && $this->searchData['orderDt2']!=='') ) {
                if((isset($this->searchData['orderDt1']) && $this->searchData['orderDt1']!=='') && !isset($this->searchData['orderDt2'])){
                    $query->whereDate('updated_at', '>=', Carbon::parse($this->searchData['orderDt1'])->format('y-m-d'));
                }else if(!isset($this->searchData['orderDt1']) && (isset($this->searchData['orderDt2']) && $this->searchData['orderDt2']!=='')){
                    $query->whereDate('updated_at', '<=', Carbon::parse($this->searchData['orderDt2'])->format('y-m-d'));
                }else if(isset($this->searchData['orderDt1'], $this->searchData['orderDt2']) && $this->searchData['orderDt1']!=='' && $this->searchData['orderDt2'] !==''){
                    $query->whereDate('updated_at', '>=', Carbon::parse($this->searchData['orderDt1'])->format('y-m-d'));
                    $query->whereDate('updated_at', '<=', Carbon::parse($this->searchData['orderDt2'])->format('y-m-d'));
                }
            }
            if ( (isset($this->searchData['paymentDt1']) && $this->searchData['paymentDt1']!=='') || (isset($this->searchData['paymentDt2']) && $this->searchData['paymentDt2']!=='') ) {
                $query->whereHas('payment', function ($query) {
                    if ((isset($this->searchData['paymentDt1']) && $this->searchData['paymentDt1'] !== '') && !isset($this->searchData['paymentDt2'])) {
                        $query->whereDate('updated_at', '>=', Carbon::parse($this->searchData['paymentDt1'])->format('y-m-d'));
                    } else if (!isset($this->searchData['paymentDt1']) && (isset($this->searchData['paymentDt2']) && $this->searchData['paymentDt2'] !== '')) {
                        $query->whereDate('updated_at', '<=', Carbon::parse($this->searchData['paymentDt2'])->format('y-m-d'));
                    } else if (isset($this->searchData['paymentDt1'], $this->searchData['paymentDt2']) && $this->searchData['paymentDt1'] !== '' && $this->searchData['paymentDt2'] !== '') {
                        $query->whereDate('updated_at', '>=', Carbon::parse($this->searchData['paymentDt1'])->format('y-m-d'));
                        $query->whereDate('updated_at', '<=', Carbon::parse($this->searchData['paymentDt2'])->format('y-m-d'));
                    }
                });
            }
            if ( (isset($this->searchData['startDt1']) && $this->searchData['startDt1']!=='') || (isset($this->searchData['startDt2']) && $this->searchData['startDt2']!=='') ) {
                $query->whereHas('confirmation', function ($query) {
                    if((isset($this->searchData['startDt1']) && $this->searchData['startDt1']!=='') && !isset($this->searchData['startDt2'])){
                        $query->whereDate('start_dt', '>=', Carbon::parse($this->searchData['startDt1'])->format('y-m-d'));
                    }else if(!isset($this->searchData['startDt1']) && (isset($this->searchData['startDt2']) && $this->searchData['startDt2']!=='')){
                        $query->whereDate('start_dt', '<=', Carbon::parse($this->searchData['startDt2'])->format('y-m-d'));
                    }else if(isset($this->searchData['startDt1'], $this->searchData['startDt2']) && $this->searchData['startDt1']!=='' && $this->searchData['startDt2'] !==''){
                        $query->whereDate('start_dt', '>=', Carbon::parse($this->searchData['startDt1'])->format('y-m-d'));
                        $query->whereDate('start_dt', '<=', Carbon::parse($this->searchData['startDt2'])->format('y-m-d'));
                    }
                });
            }
            if ((isset($this->searchData['endDt1']) && $this->searchData['endDt1']!=='') || (isset($this->searchData['endDt2']) && $this->searchData['endDt2']!=='') ) {
                $query->whereHas('confirmation', function ($query) {
                    if((isset($this->searchData['endDt1']) && $this->searchData['endDt1']!=='') && !isset($this->searchData['endDt2'])){
                        $query->whereDate('end_dt', '>=', Carbon::parse($this->searchData['endDt1'])->format('y-m-d'));
                    }else if(!isset($this->searchData['endDt1']) && (isset($this->searchData['endDt2']) && $this->searchData['endDt2']!=='')){
                        $query->whereDate('end_dt', '<=', Carbon::parse($this->searchData['endDt2'])->format('y-m-d'));
                    }else if(isset($this->searchData['endDt1'], $this->searchData['endDt2']) && $this->searchData['endDt1']!=='' && $this->searchData['endDt2'] !==''){
                        $query->whereDate('end_dt', '>=', Carbon::parse($this->searchData['endDt1'])->format('y-m-d'));
                        $query->whereDate('end_dt', '<=', Carbon::parse($this->searchData['endDt2'])->format('y-m-d'));
                    }
                });
            }
            if (isset($this->searchData['hotelId']) && $this->searchData['hotelId'] !== '' && $this->searchData['hotelId'] !== null) {
                $query->whereHas('hotel', function ($query) {
                    $query->where('id', '=', $this->searchData['hotelId']);
                });
            }
            if(isset($this->searchData['paymentStatus']) && $this->searchData['paymentStatus'] !== '' && $this->searchData['paymentStatus'] !== null) {
                $query->whereHas('payment', function ($query)  {
                    $query->where('status', '=', $this->searchData['paymentStatus']);
                });
            }
            if (isset($this->searchData['reservationOrder']) && $this->searchData['reservationOrder'] !== '' && $this->searchData['reservationOrder'] !== null) {
                $query->where('order_name', 'like', '%' . $this->searchData['reservationOrder'] . '%');
                $query->orwhere('order_email', 'like', '%' . $this->searchData['reservationOrder'] . '%');
                $query->orwhere('order_hp', 'like', '%' . $this->searchData['reservationOrder'] . '%');
            }

            if (isset($this->searchData['reservationStatus']) && $this->searchData['reservationStatus'] !== '' && $this->searchData['reservationStatus'] !== null) {
                $query->whereOrderStatus($this->searchData['reservationStatus']);
            }else{
                $query->where('order_status','!=','1');
            }
        });

        foreach ($reservations->get() as $item) {
            if($item->payment!==null){
                if($item->payment->total_price !== null && $item->payment->total_price !== '') {
                    $this->sum += $item->payment->total_price ?? 0;
                }
                if($item->payment->cancel_price !== null && $item->payment->cancel_price !== ''){
                    $this->cancelSum += $item->payment->cancel_price ?? 0;
                }
            }
        }
    }
}
