@extends('layouts.app')

@section('top-style')

@endsection

@section('content')
<div class="max-w-1200 mx-auto px-2">
    <div class="flex justify-center">
        <div class="block w-full">
            <div class="flex justify-center items-center">
                <div class="w-full max-w-1200 bg-white rounded-sm">
{{--                    <div>--}}
{{--                        {{\App\HotelReservation::groupBy(['order_name'])->get()->count()}}--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        {{\App\HotelReservation::groupBy(['order_name','order_hp'])->get()->count()}}--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        {{\App\HotelReservation::groupBy(['order_name','order_email'])->get()->count()}}--}}
{{--                    </div>--}}

{{--                    @foreach (\App\User::whereNotNull('tel')->get() as $user)--}}
{{--                        <div>--}}
{{--                            {{$user->name}}/{{$user->email}}--}}
{{--                            @php--}}
{{--                                \App\HotelReservation::whereOrderEmail($user->email)->update([--}}
{{--                                    'user_id'=>$user->id--}}
{{--                                ]);--}}
{{--                            @endphp--}}
{{--                        </div>--}}
{{--                    @endforeach--}}

{{--                    @foreach(\App\HotelReservation::groupBy(['order_email'])->whereNotNull('order_name')->where('order_name','!=','')->get() as $reservation)--}}
{{--                        <div class="flex space-x-2">--}}
{{--                            <div class="">{{$reservation->order_name}}</div>--}}
{{--                            <div class="">{{$reservation->order_email}}</div>--}}
{{--                            <div class="">{{ phone($reservation->order_hp,'KR')}}</div>--}}
{{--                            <div class="">{{ \Illuminate\Support\Str::of(phone($reservation->order_hp,'KR'))->replace('+82','0')->replace('-','') }}</div>--}}
{{--                            @php--}}
{{--                            if(\App\User::whereEmail($reservation->order_email)->count() === 0){--}}
{{--                                $user=\App\User::create([--}}
{{--                                    'name'=>$reservation->order_name,--}}
{{--                                    'email'=>$reservation->order_email,--}}
{{--                                    'tel'=>\Illuminate\Support\Str::of(phone($reservation->order_hp,'KR'))->replace('+82','0')->replace('-',''),--}}
{{--                                    'phone'=>phone($reservation->order_hp,'KR'),--}}
{{--                                    'password'=>\Illuminate\Support\Facades\Hash::make(\Illuminate\Support\Str::of(phone($reservation->order_hp,'KR'))->replace('+82','0')->replace('-','')),--}}
{{--                                    'password_tmp'=>\Illuminate\Support\Str::of(phone($reservation->order_hp,'KR'))->replace('+82','0')->replace('-','')--}}
{{--                                ]);--}}
{{--                                $reservation->user_id = $user->id;--}}
{{--                                $reservation->save();--}}
{{--                            }--}}
{{--                            @endphp--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('bottom-script')
    <script type="text/javascript">

    </script>
@endsection
