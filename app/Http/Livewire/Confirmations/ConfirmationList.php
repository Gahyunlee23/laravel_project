<?php

namespace App\Http\Livewire\Confirmations;

use App\Confirmation;
use Livewire\Component;

class ConfirmationList extends Component
{
    /* request */
    public $reservation;

    /* Data */
    public $confirmations;
    public $confirmationsOnlyTrashd;

    protected $listeners = [
        'confirmationListEventScheduler'=> 'scheduler',
        'confirmationListRerender'
    ];

    public function mount(){
        $this->getConfirmations();
    }

    public function getConfirmations(){
        if($this->reservation){
            $this->confirmations = Confirmation::where('reservation_id', '=', $this->reservation->id)->get();
            $this->confirmationsOnlyTrashd = Confirmation::onlyTrashed()->where('reservation_id', '=', $this->reservation->id)->get();
            //$this->confirmations = $confirmation->forget($confirmation->count()-1);
        }
    }

    public function scheduler($type,$id){
        if($type){
            $confirmation = Confirmation::find($id);
            $confirmation->status = 1;
            $confirmation->save();
            session()->flash('result', '알림톡 스케쥴 ON 완료');
        }else{
            $confirmation = Confirmation::find($id);
            $confirmation->status = 0;
            $confirmation->save();
            session()->flash('result', '알림톡 스케쥴 OFF 완료');
        }
        $this->componentAllRerender();
    }

    public function confirmationRestore($id){
        Confirmation::onlyTrashed()->where('id','=',$id)->restore();
        $this->componentAllRerender();
    }
    public function confirmationDelete($id){
        Confirmation::find($id)->delete();
        $this->componentAllRerender();
    }

    public function confirmationForceDelete($id){
        Confirmation::onlyTrashed()->find($id)->forceDelete();
        $this->componentAllRerender();
    }

    public function componentAllRerender(){
        $this->confirmationListRerender();
        $this->wireConponentRerender();
    }
    public function confirmationListRerender(){
        $this->getConfirmations();
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
        return view('livewire.confirmations.confirmation-list');
    }
}
