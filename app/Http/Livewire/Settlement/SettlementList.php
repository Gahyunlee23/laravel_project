<?php

namespace App\Http\Livewire\Settlement;

use App\Payment;
use App\Settlement;
use Livewire\Component;

class SettlementList extends Component
{
    /* Request */
    public $paymentId;
    public $payment;
    public $reservation;

    /* Data */
    public $settlement;

    public function mount()
    {
        if($this->paymentId!==null){
            $this->payment = Payment::find($this->paymentId);
        }
    }

    public function render()
    {
        return view('livewire.settlement.settlement-list');
    }
    public function settlementReset(): void
    {
        $this->settlement=null;
    }


    public function reservationFormSettlementCalculateChangeEvent($type,$settlement): void
    {
        $settlement = Settlement::find($settlement);
        if($settlement){
            $settlement->calculate_yn = $type;
            if($type==='N'){
                $settlement->calculate_dt=null;
            }else{
                $settlement->calculate_dt=now();
            }
            $settlement->save();
        }
    }
    public function reservationFormSettlementDeleteEvent($settlement){
        $settlement = Settlement::find($settlement);
        if($settlement){
            $settlement->delete();
        }
    }

    public function settlementSubmit(){
        $confirmation_id = null;
        if(isset($this->reservation->confirmation) && $this->reservation->confirmation->id !=='' && $this->reservation->confirmation !==null){
            $confirmation_id=$this->reservation->confirmation->id;
        }
        if($this->payment && $this->settlement['calculate']!=='' && $this->settlement['calculate']!== null){
            $settlement = Settlement::create([
                'payment_id'=>$this->payment->id,
                'confirmation_id'=>$confirmation_id,
                'admin_id'=>auth()->user()->id,
                'price'=>$this->payment->total_price ?? null,
                'add_price'=>$this->payment->add_price ?? null,
                'calculate'=>$this->settlement['calculate'] ?? null,
                'memo'=>$this->settlement['memo'] ?? null
            ]);
            $this->settlementReset();
        }
    }
}
