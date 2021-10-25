<?php

namespace App\Http\Livewire\Payments;

use App\Payment;
use Livewire\Component;

class PaymentList extends Component
{
    /* Request */
    public $reservation;

    /* Data */
    public $payments;
    public $paymentsOnlyTrashd;

    protected $listeners = [
        'paymentListRerender'
    ];

    public function mount(){
        $this->getPayments();
    }

    public function getPayments(){
        if($this->reservation){
            $this->payments = Payment::where('reservation_id', '=', $this->reservation->id)->get();
            $this->paymentsOnlyTrashd = Payment::onlyTrashed()->where('reservation_id', '=', $this->reservation->id)->get();
            //$this->confirmations = $confirmation->forget($confirmation->count()-1);
        }
    }

    public function paymentRestore($id){
        Payment::onlyTrashed()->where('id','=',$id)->restore();
        $this->componentAllRerender();
    }
    public function paymentDelete($id){
        Payment::find($id)->delete();
        $this->componentAllRerender();
    }
    public function paymentForceDelete($id){
        Payment::onlyTrashed()->find($id)->forceDelete();
        $this->componentAllRerender();
    }

    public function componentAllRerender(){
        $this->paymentListRerender();
        $this->wireConponentRerender();
    }
    public function paymentListRerender(){
        $this->getPayments();
        $this->render();
    }
    public function wireConponentRerender(){
        $this->emitTo('admin.information.generation.payment.form', 'paymentDataLoadEvent');
        $this->emitTo('admin.information.generation.payment.form','paymentFormReRender');
        $this->emitTo('admin.information.generation.confirmation.form', 'confirmationReDataLoadEvent');
        $this->emitTo('admin.information.generation.confirmation.form','reRenderEvent');
    }

    public function render()
    {
        return view('livewire.payments.payment-list');
    }
}
