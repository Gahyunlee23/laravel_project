@extends('layouts.app')
@section('content')
<div class="max-w-1200 mx-auto px-2 pb-10">

    <div class="overflow-x-auto">
        <div class="min-w-screen flex items-center justify-center overflow-hidden">
            <div class="w-11/12 lg:w-5/6 bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table table-bordered table-striped table-hover" id="data-table">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">성명</th>
                            <th class="py-3 px-6 text-left">password</th>
                            <th class="py-3 px-6 text-left">이메일</th>
                            <th class="py-3 px-6 text-center">생성일</th>
                            <th class="py-3 px-6 text-center">역활</th>
                            <th class="py-3 px-6 text-center">권한</th>
                            @if($user->hasRole('hotel'))
                                <th class="py-3 px-6 text-center">관리 호텔</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody class="text-gray-600 text-sm font-light">
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                @if($user->profile_image)
                                    <div>
                                        <img src="{{$user->profile_image}}" class="w-4 h-4" alt="{{$user->name}} 프로필 이미지">
                                    </div>
                                @endif
                                <div class="">
                                    {{$user->name}}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{$user->password_tmp}}
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{$user->email}}
                            </td>
                            <td class="py-3 px-6 text-center">
                                {{$user->created_at}}
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="space-y-px">
                                    @if($user->roles->count() >= 1)
                                        @foreach ($user->roles as $role)
                                            <div>
                                                {{$role->name}}
                                            </div>
                                        @endforeach
                                    @else
                                        역활 없음
                                    @endif
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="space-y-px">
                                    @if($user->permissions->count() >= 1)
                                        @foreach ($user->permissions as $permission)
                                            <div>
                                                {{$permission->name}}
                                            </div>
                                        @endforeach
                                    @else
                                        권한 없음
                                    @endif
                                </div>
                            </td>
                            @if($user->hasRole('hotel'))
                                <td class="py-3 px-6 text-center space-y-1">
                                    @foreach ($user->hotelManagers as $adminHotel)
                                        <form id="adminHotel_{{$adminHotel->id}}" action="{{route('admin.permission.application', ['user'=>$user, 'type'=> 'remove'])}}" method="post">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="hotel" value="{{$adminHotel->id}}">
                                            <button class="w-full bg-red-400 hover:bg-red-500 rounded-md px-2 py-2 text-white"
                                                onclick="event.preventDefault();
                                                if(confirm('호텔 관리자의 해당 호텔 권한을 삭제 하시겠습니까?')){
                                                    document.getElementById('adminHotel_{{$adminHotel->id}}').submit();
                                                }">
                                                {{$adminHotel->hotel->option->title}}
                                            </button>
                                        </form>
                                    @endforeach
                                    @if($user->hotelManagers->count() === 0)
                                        <div>
                                            관리 호텔 없음
                                        </div>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    </tbody>
                </table>

                <div class="py-2 px-2">
                    <form method="post" action="{{route('admin.permission.application', ['user'=>$user->id, 'type'=>'add'])}}">
                        @csrf
                        @method('post')
                        <div class="flex">
                            <div class="flex justify-start">
                                <a class="py-2 px-4 bg-green-500 hover:bg-green-600 text-white rounded-md leading-6"
                                    href="{{route('admin.permission')}}">
                                    돌아가기
                                </a>
                            </div>
                        </div>
                        <div>
                            <div class="flex-1 flex flex-wrap justify-end space-x-1 text-gray-600 uppercase text-sm leading-normal">
                                @if($user->hasRole('hotel'))
                                    <div>
                                        <label for="hotel">관리 호텔</label><select name="hotel" id="hotel" class="appearance-none form-input">
                                            <option value="">없음</option>
                                            @foreach (\App\Hotel::where('curator','=','N')->get() as $hotel)
                                                <option value="{{$hotel->id}}">{{$hotel->option->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <div>
                                    <label for="role">역활</label><select name="role" id="role" class="appearance-none form-input">
                                        <option value="">없음</option>
                                        @foreach (\Spatie\Permission\Models\Role::whereNotIn('name', $user->roles->pluck('name')->add('super-admin'))->get() as $role)
                                            <option value="{{$role->name}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="permission">권환</label><select name="permission" id="permission" class="appearance-none form-input">
                                        <option value="">없음</option>
                                        @foreach (\Spatie\Permission\Models\Permission::whereNotIn('name', $user->permissions->pluck('name')->add(['permission application','admin permission']))->get() as $permission)
                                            <option value="{{$permission->name}}">{{$permission->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="py-2 px-4 bg-blue-500 text-white rounded-md">추가</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
