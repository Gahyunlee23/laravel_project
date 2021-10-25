<?php

namespace App\Http\Controllers\Admins;

use App\Banner;
use App\Enter;
use App\Exports\HotelReservationsExport;
use App\Exports\RecommendationExport;
use App\Exports\UnpaidExport;
use App\Exports\UserAllExport;
use App\Hotel;
use App\HotelFaq;
use App\HotelImage;
use App\HotelManager;
use App\HotelReservation;
use App\Http\Controllers\Controller;
use App\Recommendation;
use App\ReservationCancel;
use App\ReservationModify;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdminController extends Controller
{

    public function adminMain()
    {
        session(['searchData' => null]);

        return view('home',[
            'faqs'=>HotelFaq::all(),
        ]);
    }

    /*배너 매니저*/
    public function adminBanner($type = 'list') {
        if($type==='form'){
            return view('admin.banner.core', ['type'=>'form']);
        }
        return view('admin.banner.core', ['type'=>'list']);
    }

    public function adminBannerEdit(Banner $banner) {
        return view('admin.banner.core',[
            'banner'=>$banner,
            'type'=>'form'
        ]);
    }

    public function userMasterTable()
    {
        return view('admin.table.user');
    }

    public function adminPasswordUpdate(Request $request,User $user): RedirectResponse
    {
        $user->password = Hash::make($request->password);
        $user->password_tmp = $request->password;
        $user->save();

        return back();
    }

    public function enterHotelsList (){
        return view('admin.enter-hotels-list',[
            'enter_hotels'=>Enter::orderBy('id', 'desc')->get()
        ]);
    }

    public function recommendationHotelsList (){
        return view('admin.recommendation-hotels-list',[
            'recommendations'=>Recommendation::orderBy('id', 'desc')->get()
        ]);
    }

    public function import()
    {
        return view('admin.import');
    }

    public function exportHotelReservation(): BinaryFileResponse
    {
        try {
            $reservations = HotelReservation::where('order_status', '!=', '1');
            return Excel::download(new HotelReservationsExport($reservations), '호텔_주문자_리스트('.now()->format('Y-m-d H:i:s').').xlsx');
        } catch (Exception | \PhpOffice\PhpSpreadsheet\Exception $e) {
            ddd($e);
        }
    }

    public function exportHotelReservationOptions(Request $request): BinaryFileResponse
    {
        try {
            $query = HotelReservation::where('order_status', '!=', '1');
            if($request->order_statue){
                switch ($request->order_statue){
                    case '전체' :
                        $query = $query->select('confirmations.start_dt','confirmations.end_dt','confirmations.status','reservations.*')
                            ->where('reservations.order_status', '!=', '1')
                            ->Join('confirmations', 'confirmations.reservation_id', '=', 'reservations.id');
                        break;
                    case '투어예정' :
                        $query = $query->select('confirmations.start_dt','confirmations.end_dt','confirmations.status','reservations.*')
                            ->where('reservations.order_status', '!=', '1')
                            ->Join('confirmations', 'confirmations.reservation_id', '=', 'reservations.id')
                            ->where('reservations.type','=','tour')
                            ->whereDate('confirmations.start_dt', '>=', Carbon::now()->format('Y-m-d h:i:s'));
                        break;
                    case '투어완료' :
                        $query = $query->select('confirmations.start_dt','confirmations.end_dt','confirmations.status','reservations.*')
                            ->where('reservations.order_status', '!=', '1')
                            ->Join('confirmations', 'confirmations.reservation_id', '=', 'reservations.id')
                            ->where('reservations.type','=','tour')
                            ->whereDate('confirmations.start_dt', '<=', Carbon::now()->format('Y-m-d h:i:s'));
                        break;
                    case '입주예정' :
                        $query = $query->select('confirmations.start_dt','confirmations.end_dt','confirmations.status','reservations.*')
                            ->where('reservations.order_status', '!=', '1')
                            ->Join('confirmations', 'confirmations.reservation_id', '=', 'reservations.id')
                            ->where('reservations.type','=','month')
                            ->whereDate('confirmations.start_dt', '>=', Carbon::now()->format('Y-m-d h:i:s'));
                    break;
                    case '입주중' :
                        $query = $query->select('confirmations.start_dt','confirmations.end_dt','confirmations.status','reservations.*')
                            ->where('reservations.order_status', '!=', '1')
                            ->Join('confirmations', 'confirmations.reservation_id', '=', 'reservations.id')
                            ->where('reservations.type','=','month')
                            ->whereDate('confirmations.start_dt', '<=', Carbon::now()->format('Y-m-d h:i:s'))
                            ->whereDate('confirmations.end_dt', '>=', Carbon::now()->format('Y-m-d h:i:s'));
                    break;
                    case '퇴실완료' :
                        $query = $query->select('confirmations.start_dt','confirmations.end_dt','confirmations.status','reservations.*')
                            ->where('reservations.order_status', '!=', '1')
                            ->Join('confirmations', 'confirmations.reservation_id', '=', 'reservations.id')
                            ->where('reservations.type','=','month')
                            ->whereDate('confirmations.start_dt', '<=', Carbon::now()->format('Y-m-d h:i:s'))
                            ->whereDate('confirmations.end_dt', '<=', Carbon::now()->format('Y-m-d h:i:s'));
                    break;
                    case '취소완료' :
                        $query = $query->select('confirmations.start_dt','confirmations.end_dt','confirmations.status','reservations.*')
                            ->where('reservations.order_status', '=', '0')
                            ->Join('confirmations', 'confirmations.reservation_id', '=', 'reservations.id');
                    break;
                    case '결제완료' :
                        $query = $query->select('confirmations.start_dt','confirmations.end_dt','confirmations.status','reservations.*','payments.goods_name','payments.goods_option')
                            ->where('reservations.order_status', '!=', '0')
                            ->Join('confirmations', 'confirmations.reservation_id', '=', 'reservations.id')
                            ->Join('payments', 'payments.reservation_id', '=', 'reservations.id')
                        ->where('payments.status', '=', '3');
                    break;
                }
            }
            $reservations = $query;
            return Excel::download(new HotelReservationsExport($reservations), '호텔_주문자_리스트('.now()->format('Y-m-d H:i:s').').xlsx');
        } catch (Exception | \PhpOffice\PhpSpreadsheet\Exception $e) {
            ddd($e);
        }
    }

    public function exportUnpaid(): BinaryFileResponse
    {
        try {
            return Excel::download(new UnpaidExport(), '입주_주문_미결제_리스트('.now()->format('Y-m-d H:i:s').').xlsx');
        } catch (Exception | \PhpOffice\PhpSpreadsheet\Exception $e) {
            ddd($e);
        }
    }
    public function exportUserAll(): BinaryFileResponse
    {
        try {
            return Excel::download(new UserAllExport(), '회원_전체_리스트('.now()->format('Y-m-d H:i:s').').xlsx');
        } catch (Exception | \PhpOffice\PhpSpreadsheet\Exception $e) {
            ddd($e);
        }
    }
    public function exportRecommendation(): BinaryFileResponse
    {
        try {
            return Excel::download(new RecommendationExport(), '호텔_추천_고객리스트('.now()->format('Y-m-d H:i:s').').xlsx');
        } catch (Exception | \PhpOffice\PhpSpreadsheet\Exception $e) {
            ddd($e);
        }
    }

    public function reservationApplicationIndex()
    {
        return view('admin.reservation.application.index');
    }

    public function reservationApplicationShow(HotelReservation $reservation)
    {
        return view('admin.reservation.application.show',[
            'reservation'=>$reservation
        ]);
    }
    public function reservationModifyProcess(Request $request)
    {
        $model = ReservationModify::find($request->reservationModifyId);
        $model->process=$request->modifyProcess;
        $model->save();
        return back();
    }
    public function reservationCancelProcess(Request $request)
    {
        $model = ReservationCancel::find($request->reservationCancelId);
        $model->process=$request->cancelProcess;
        $model->save();
        return back();
    }
    /* 최고 관리자 접근 > 관리자 권한 */
    public function adminPermission($tab='admin')
    {
        return view('admin.super.index',[
            'tab'=>$tab
        ]);
    }
    public function adminPermissionEdit(User $user)
    {
        return view('admin.super.show',[
            'user'=>$user
        ]);
    }
    public function adminCreate()
    {
        return view('admin.super.create');
    }


    public function adminStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:20',
            'password' => 'required',
            'email' => 'required|unique:users',
        ], [
            'name.required' => '이름 필수 입력입니다.',
            'name.min' => '이름 2자 이상 입력입니다.',
            'name.max' => '이름 20자 이하 입력입니다.',
            'password.required' => '비밀번호 필수 입력입니다.',
            'email.required' => '이메일 필수 입력입니다.',
            'email.unique' => '해당 이메일은 이미 가입된 이메일입니다.',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if($validator->passes()){
            $user = User::create([
                'name'=>$validator->valid()['name'],
                'email'=>$validator->valid()['email'],
                'tel'=>$validator->valid()['email'],
                'password'=>Hash::make($validator->valid()['password']),
                'password_tmp'=>$validator->valid()['password'],
            ]);
            if($validator->valid()['role']){
                $user->assignRole($validator->valid()['role']);
            }
            if($validator->valid()['permission']){
                $user->givePermissionTo($validator->valid()['permission']);
            }
            return back()->with(['success'=>'정보 저장 완료']);
        }
        return back()->withErrors(['error'=>'입력 정보 fails 통과, unPass 처리 => 오류'])->withInput();
    }

    /* 역할 관리 */
    public function roleOffer(Request $request, $type): RedirectResponse
    {
        if($type === 'add'){
            if($request->name) {
                Role::create($request->all());
                return back();
            }
        }
        if($type === 'remove'){
            if($request->role) {
                Role::findById($request->role)->delete();
                return back();
            }
        }
        return back()->withInput();
    }
    /* 권한 관리 */
    public function permissionOffer(Request $request, $type): RedirectResponse
    {
        if($type === 'add'){
            if($request->name) {
                Permission::create($request->all());
                return back();
            }
        }
        if($type === 'remove'){
            if($request->permission) {
                Permission::findById($request->permission)->delete();
                return back();
            }
        }
        return back()->withInput();
    }

    public function permissionApplication(Request $request, User $user, $type): RedirectResponse
    {
        if($type === 'add'){
            if($request->role !== null && $request->role !== ''){
                $user->assignRole($request->role);
            }
            if($request->permission !== null && $request->permission !== ''){
                $user->givePermissionTo($request->permission);
            }
            if($request->hotel !== null && $request->hotel !== ''){
                HotelManager::create([
                   'user_id'=>$user->id,
                   'hotel_id'=>$request->hotel
                ]);
            }
        }
        if($type === 'remove'){
            if($request->role !== null && $request->role !== ''){
                $user->removeRole($request->role);
            }
            if($request->permission !== null && $request->permission !== ''){
                $user->revokePermissionTo($request->permission);
            }
            if($request->hotel !== null && $request->hotel !== ''){
                HotelManager::find($request->hotel)->delete();
            }
        }
        return redirect()->route('admin.permission.edit',['user'=>$user->id]);
    }


}
