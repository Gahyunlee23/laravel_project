<?php

namespace App\Http\Livewire\Admin;

use App\HotelReservation;
use App\CustomerExperiences as CE;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;

class CustomerExperiences extends Component
{
    public $reservation;
    public $customerExperience;

    protected $listeners = [
        'customerExperiencesRenderEvent' => 'renderChange',
        'customerExperienceReservationIdSet'
    ];

    public $gender, $order_name, $age_group, $residence, $work_place;
    public $manager, $calculate_manager, $refund_manager;
    public $inquiry_channel, $inquiry_type, $inflow_path;
    public $payment_method, $refund_method, $refund_reason, $refund_progress;
    public $progress_status, $contact_us, $move_in_progress, $not_purchased_reason, $memo;
    public $supply_price, $profit, $refund_price, $calculate_price, $calculate_refund_price;
    public $inquiry_at, $refund_at, $calculate_at, $first_at;

    public function customerExperienceReservationIdSet(HotelReservation $reservation)
    {
        $this->reservation = $reservation;
        if ($this->reservation->customerExperience) {
            //$this->reservation->customerExperience
            $this->customerExperience = $this->reservation->customerExperience;
            $this->gender = $this->reservation->customerExperience->gender;
            $this->order_name = $this->reservation->customerExperience->order_name;
            $this->age_group = $this->reservation->customerExperience->age_group;
            $this->residence = $this->reservation->customerExperience->residence;
            $this->work_place = $this->reservation->customerExperience->work_place;

            $this->manager = $this->reservation->customerExperience->manager;
            $this->calculate_manager = $this->reservation->customerExperience->calculate_manager;
            $this->refund_manager = $this->reservation->customerExperience->refund_manager;
            $this->inquiry_channel = $this->reservation->customerExperience->inquiry_channel;
            $this->inquiry_type = $this->reservation->customerExperience->inquiry_type;
            $this->inflow_path = $this->reservation->customerExperience->inflow_path ?? null;
            $this->payment_method = $this->reservation->customerExperience->payment_method;
            $this->refund_method = $this->reservation->customerExperience->refund_method;
            $this->progress_status = $this->reservation->customerExperience->progress_status;
            $this->contact_us = $this->reservation->customerExperience->contact_us;
            $this->move_in_progress = $this->reservation->customerExperience->move_in_progress;
            $this->not_purchased_reason = $this->reservation->customerExperience->not_purchased_reason;
            $this->refund_reason = $this->reservation->customerExperience->refund_reason;
            $this->refund_progress = $this->reservation->customerExperience->refund_progress;
            $this->memo = $this->reservation->customerExperience->memo;
            $this->supply_price = $this->reservation->customerExperience->supply_price;
            $this->profit = $this->reservation->customerExperience->profit;
            $this->refund_price = $this->reservation->customerExperience->refund_price;
            $this->calculate_price = $this->reservation->customerExperience->calculate_price;
            $this->calculate_refund_price = $this->reservation->customerExperience->calculate_refund_price;
            $this->inquiry_at = $this->reservation->customerExperience->inquiry_at;
            $this->refund_at = $this->reservation->customerExperience->refund_at;
            $this->calculate_at = $this->reservation->customerExperience->calculate_at;
            $this->first_at = $this->reservation->customerExperience->first_at;
        } else {
            $this->customerExperience = new CE(['order_name' => $this->reservation->order_name, 'reservation_id' => $this->reservation->id, 'user_id' => $this->reservation->user_id ?? null]);
            $this->customerExperience->save();
            $this->order_name = $this->reservation->order_name;
            $this->inflow_path = $this->reservation->visit_route;
        }

        if($this->reservation->user_id){
            if(CE::whereUserId($this->reservation->user_id)->count()>=1){
                $mArray = collect();
                if(CE::whereUserId($this->reservation->user_id)->where('gender','!=',null)->count()>=1){
                    $this->gender=CE::whereUserId($this->reservation->user_id)->where('gender','!=',null)->first()->gender;
                    $mArray->put('gender',$this->gender);
                }
                if(CE::whereUserId($this->reservation->user_id)->where('age_group','!=',null)->count()>=1){
                    $this->age_group=CE::whereUserId($this->reservation->user_id)->where('age_group','!=',null)->first()->age_group;
                    $mArray->put('age_group',$this->age_group);
                }
                if(CE::whereUserId($this->reservation->user_id)->where('residence','!=',null)->count()>=1){
                    $this->residence=CE::whereUserId($this->reservation->user_id)->where('residence','!=',null)->first()->residence;
                    $mArray->put('residence',$this->residence);
                }
                if(CE::whereUserId($this->reservation->user_id)->where('work_place','!=',null)->count()>=1){
                    $this->work_place=CE::whereUserId($this->reservation->user_id)->where('work_place','!=',null)->first()->work_place;
                    $mArray->put('work_place',$this->work_place);
                }
                if($mArray->count() >= 1){
                    CE::whereUserId($this->reservation->user_id)->update($mArray->filter(function ($item){ return $item ?? null; })->toArray());
                }
            }
        }
    }

    public function updating($name, $value)
    {
        if($value === ''){
            $value=null;
        }
        switch ($name) {
            case 'payment_method' :
            case 'refund_method' :
                ($value === "" || $value === null) ?
                    $this->customerExperience->$name = null :
                    $this->customerExperience->$name = $value;
                break;
            case 'inquiry_at' :
            case 'refund_at' :
            case 'calculate_at' :
                $this->customerExperience->$name = Carbon::parse($value)->format('y-m-d H:i:s');
                break;
            default :
                $this->customerExperience->$name = $value;
                break;
        }
        $this->customerExperience->save();
    }

    public function updated($name, $value)
    {
        session([$name => 'updated']);
    }

    /*public function customerExperiencesSaveEvent(): void
    {
        $request = request();
        $data = collect($request->all()['serverMemo']['data'])->filter(function ($item){
            return $item ?? null;
        });
        $customerExperience = CE::firstOrCreate(['reservation_id'=>$this->reservation->id]);
        $customerExperience->order_name = $data->get('order_name') ?? '';
        $customerExperience->gender = $data->get('gender') ?? '';
        $data->get('order_name') !== null ? $customerExperience->order_name = $data->get('order_name') : $customerExperience->order_name = null ;
        $data->get('gender') !== null ? $customerExperience->gender = $data->get('gender') : null ;

        $data->get('manager') !== null ? $customerExperience->manager = $data->get('manager') : $customerExperience->manager = null ;
        $data->get('calculate_manager') !== null ? $customerExperience->calculate_manager = $data->get('calculate_manager') : $customerExperience->calculate_manager = null ;
        $data->get('refund_manager') !== null ? $customerExperience->refund_manager = $data->get('refund_manager') : $customerExperience->refund_manager = null ;

        $data->get('inquiry_channel') !== null ? $customerExperience->inquiry_channel = $data->get('inquiry_channel') : $customerExperience->inquiry_channel = null ;
        $data->get('inflow_path') !== null ? $customerExperience->inflow_path = $data->get('inflow_path') : $customerExperience->inflow_path = null ;

        $data->get('payment_method') !== null ? $customerExperience->payment_method = $data->get('payment_method') : $customerExperience->payment_method = null ;
        $data->get('refund_method') !== null ? $customerExperience->refund_method = $data->get('refund_method') : $customerExperience->refund_method = null ;

        $data->get('progress_status') !== null ? $customerExperience->progress_status = $data->get('progress_status') : $customerExperience->progress_status = null ;
        $data->get('move_in_progress') !== null ? $customerExperience->move_in_progress = $data->get('move_in_progress') : $customerExperience->move_in_progress = null ;
        $data->get('not_purchased_reason') !== null ? $customerExperience->not_purchased_reason = $data->get('not_purchased_reason') : $customerExperience->not_purchased_reason = null ;
        $data->get('refund_reason') !== null ? $customerExperience->refund_reason = $data->get('refund_reason') : $customerExperience->refund_reason = null ;
        $data->get('memo') !== null ? $customerExperience->memo = $data->get('memo') : $customerExperience->memo = null ;

        $data->get('supply_price') !== null ? $customerExperience->supply_price = $data->get('supply_price') : $customerExperience->supply_price = null ;
        $data->get('profit') !== null ? $customerExperience->profit = $data->get('profit') : $customerExperience->profit = null ;
        $data->get('refund_price') !== null ? $customerExperience->refund_price = $data->get('refund_price') : $customerExperience->refund_price = null ;
        $data->get('calculate_price') !== null ? $customerExperience->calculate_price = $data->get('calculate_price') : $customerExperience->calculate_price = null ;
        $data->get('calculate_refund_price') !== null ? $customerExperience->calculate_refund_price = $data->get('calculate_refund_price') : $customerExperience->calculate_refund_price = null ;

        $data->get('inquiry_at') !== null ? $customerExperience->inquiry_at = $data->get('inquiry_at') : $customerExperience->inquiry_at = null ;
        $data->get('refund_at') !== null ? $customerExperience->refund_at = $data->get('refund_at') : $customerExperience->refund_at = null ;
        $data->get('calculate_at') !== null ? $customerExperience->calculate_at = $data->get('calculate_at') : $customerExperience->calculate_at = null ;
        $customerExperience->save();
    }*/

    public function renderChange()
    {
        $this->render();
    }

    public function render()
    {
        return view('livewire.admin.customer-experiences');
    }
}
