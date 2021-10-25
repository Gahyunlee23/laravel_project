@extends('layouts.app')
@section('content')
<div class="max-w-1200 mx-auto px-2 pb-10" x-data="{ tab : '{{$tab}}' }">
    <div class="flex px-4 space-x-2">
        <div class="AppSdGothicNeoR py-2 px-2 flex-1 cursor-pointer text-lg rounded-md border border-solid border-white"
             :class="{
              'font-bold bg-white text-black' : tab === 'admin',
              'text-white' : tab !== 'admin'
             }"
             onclick="tabHistoryPush('admin');"
             @click="tab = 'admin'">TM 관리자
        </div>

        @if(auth()->check() && auth()->user()->hasPermissionTo('admin permission'))
        <div class="AppSdGothicNeoR py-2 px-2 flex-1 cursor-pointer text-lg rounded-md border border-solid border-white"
             :class="{
              'font-bold bg-white text-black' : tab === 'hotel',
              'text-white' : tab !== 'hotel'
             }"
             onclick="tabHistoryPush('hotel');"
             @click="tab = 'hotel'">호텔 관리자
        </div>
        @endif

        @hasrole('super-admin')
            @if(auth()->check() && auth()->user()->hasPermissionTo('permission application'))
                <div class="AppSdGothicNeoR py-2 px-2 flex-1 cursor-pointer text-white text-lg rounded-md border border-solid border-white"
                     :class="{
                      'font-bold bg-white text-black' : tab === 'role',
                      'text-white' : tab !== 'role'
                     }"
                     onclick="tabHistoryPush('role');"
                     @click="tab = 'role'">역할 추가
                </div>

                <div class="AppSdGothicNeoR py-2 px-2 flex-1 cursor-pointer text-white text-lg rounded-md border border-solid border-white"
                     :class="{
                      'font-bold bg-white text-black' : tab === 'permission',
                      'text-white' : tab !== 'permission'
                     }"
                     onclick="tabHistoryPush('permission');"
                     @click="tab = 'permission'">권한 추가
                </div>
            @endif
        @endhasrole
    </div>
    <div x-show="tab === 'admin'" x-cloak>
        <div class="overflow-x-auto">
            <div class="min-w-screen flex items-center justify-center overflow-hidden">
                <div class="w-11/12 lg:w-5/6 bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table table-bordered table-striped table-hover" id="data-table">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">성명</th>
                                <th class="py-3 px-6 text-left">이메일</th>
                                <th class="py-3 px-6 text-center">생성일</th>
                                <th class="py-3 px-6 text-center">역할</th>
                                <th class="py-3 px-6 text-center">권한</th>
                                <th class="py-3 px-6 text-center">기능</th>
                            </tr>
                        </thead>

                        <tbody class="text-gray-600 text-sm font-light">
                        @foreach (\App\User::whereHas('roles', function($query){
                            $query->where('name','=','admin')->orWhere('name','=','super-admin');
                        })->get() as $admin)
                                <x-user.frame :user="$admin" type="admin"></x-user.frame>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        @can('admin permission')
                            <x-form.buttons.button-01
                                name="추가" width_class="w-full" height_class="h-8" text_color="text-white" bg_class="bg-green-500 hover:bg-green-600"
                                onclick="location.href='{{route('admins.create')}}';"
                            ></x-form.buttons.button-01>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(auth()->check() && auth()->user()->hasPermissionTo('admin permission'))
    <div x-show="tab === 'hotel'" x-cloak>
        <div class="overflow-x-auto">
            <div class="min-w-screen flex items-center justify-center overflow-hidden">
                <div class="w-11/12 lg:w-5/6 bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table table-bordered table-striped table-hover" id="data-table">
                        <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">성명</th>
                            <th class="py-3 px-6 text-left">이메일</th>
                            <th class="py-3 px-6 text-center">생성일</th>
                            <th class="py-3 px-6 text-center">역활</th>
                            <th class="py-3 px-6 text-center">권한</th>
                            <th class="py-3 px-6 text-center">관리 호텔</th>
                            <th class="py-3 px-6 text-center">기능</th>
                        </tr>
                        </thead>

                        <tbody class="text-gray-600 text-sm font-light">
                        @foreach (\App\User::whereHas('roles', function($query){
                            $query->where('name','=','hotel');
                        })->get() as $admin)
                            <x-user.frame :user="$admin" type="hotel"></x-user.frame>
                        @endforeach
                        </tbody>
                    </table>
                    <div>
                        @can('admin permission')
                            <x-form.buttons.button-01
                                name="추가" width_class="w-full" height_class="h-8" text_color="text-white" bg_class="bg-green-500 hover:bg-green-600"
                                onclick="location.href='{{route('admins.create')}}';"
                            ></x-form.buttons.button-01>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @hasrole('super-admin')
        @if(auth()->check() && auth()->user()->hasPermissionTo('permission application'))
            <div x-show="tab === 'role'" x-cloak>
                <div class="overflow-x-auto">
                    <div class="min-w-screen flex items-center justify-center overflow-hidden">
                        <div class="w-11/12 lg:w-5/6 bg-white shadow-md rounded my-6">
                            <table class="min-w-max w-full table table-bordered table-striped table-hover">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-center">역활 명칭</th>
                                        <th class="py-3 px-6 text-center">가드</th>
                                        <th class="py-3 px-6 text-center">생성일</th>
                                        <th class="py-3 px-6 text-center">리스트</th>
                                        <th class="py-3 px-6 text-center">기능</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    @foreach (\Spatie\Permission\Models\Role::get() as $role)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                                {{$role->name}}
                                            </td>
                                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                                {{$role->guard_name}}
                                            </td>
                                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                                {{$role->created_at}}
                                            </td>
                                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                                <div x-data="{ show : false }">
                                                    <div @if(\App\User::role($role->name)->get()->count()>=1) class="font-bold cursor-pointer" @click="show=true"@endif>
                                                        적용 리스트 ({{\App\User::role($role->name)->get()->count() ?? '0'}})
                                                    </div>
                                                    <div x-show="show" @click="show=false" x-cloak
                                                        class="p-2 bg-gray-300 hover:bg-gray-400 cursor-pointer">
                                                        @foreach (\App\User::role($role->name)->get() as $user)
                                                            <div>
                                                                {{$user->name}}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                                @if(\App\User::role($role->name)->get()->count() === 0)
                                                    <form class="m-0" method="post" action="{{route('admin.role.offer', ['type'=>'remove'])}}">
                                                        @csrf
                                                        @method('post')
                                                        <input type="hidden" name="role" id="role" value="{{$role->id}}">
                                                        <button class="py-2 px-4 bg-red-500 text-white rounded-md">삭제</button>
                                                    </form>
                                                @else
                                                    삭제 불가
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pt-2 px-2">
                                <form method="post" action="{{route('admin.role.offer', ['type'=>'add'])}}">
                                    @csrf
                                    @method('post')
                                    <div class="flex justify-end space-x-1 text-gray-600 uppercase text-sm leading-normal">
                                        <div>
                                            <select name="guard_name" id="guard_name" class="appearance-none form-input">
                                                <option value="web">web</option>
                                            </select>
                                        </div>
                                        <div>
                                            <input type="text" name="name" value="{{old('name')}}" class="appearance-none form-input" autocomplete="off">
                                        </div>
                                        <button class="py-2 px-4 bg-blue-500 text-white rounded-md">추가</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="tab === 'permission'" x-cloak>
                <div class="overflow-x-auto">
                    <div class="min-w-screen flex items-center justify-center overflow-hidden">
                        <div class="w-11/12 lg:w-5/6 bg-white shadow-md rounded my-6">
                            <table class="min-w-max w-full table table-bordered table-striped table-hover">
                                <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-center">권한 명칭</th>
                                    <th class="py-3 px-6 text-center">가드</th>
                                    <th class="py-3 px-6 text-center">생성일</th>
                                    <th class="py-3 px-6 text-center">리스트</th>
                                    <th class="py-3 px-6 text-center">기능</th>
                                </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                @foreach (\Spatie\Permission\Models\Permission::get() as $permission)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-center whitespace-nowrap">
                                            {{$permission->name}}
                                        </td>
                                        <td class="py-3 px-6 text-center whitespace-nowrap">
                                            {{$permission->guard_name}}
                                        </td>
                                        <td class="py-3 px-6 text-center whitespace-nowrap">
                                            {{$permission->created_at}}
                                        </td>
                                        <td class="py-3 px-6 text-center whitespace-nowrap">
                                            <div x-data="{ show : false }">
                                                <div @if(\App\User::permission($permission->name)->get()->count()>=1) class="font-bold cursor-pointer" @click="show=true"@endif>
                                                    적용 리스트 ({{\App\User::permission($permission->name)->get()->count() ?? '0'}})
                                                </div>
                                                <div x-show="show" @click="show=false" x-cloak
                                                     class="p-2 bg-gray-300 hover:bg-gray-400 cursor-pointer">
                                                    @foreach (\App\User::permission($permission->name)->get() as $user)
                                                        <div>
                                                            {{$user->name}}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-center whitespace-nowrap">
                                            @if(\App\User::permission($permission->name)->get()->count() === 0)
                                                <form class="m-0" method="post" action="{{route('admin.permission.offer', ['type'=>'remove'])}}">
                                                    @csrf
                                                    @method('post')
                                                    <input type="hidden" name="permission" id="permission" value="{{$permission->id}}">
                                                    <button class="py-2 px-4 bg-red-500 text-white rounded-md">삭제</button>
                                                </form>
                                            @else
                                                삭제 불가
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="pt-2 px-2">
                                <form method="post" action="{{route('admin.permission.offer', ['type'=>'add'])}}">
                                    @csrf
                                    @method('post')
                                    <div class="flex justify-end space-x-1 text-gray-600 uppercase text-sm leading-normal">
                                        <div>
                                            <select name="guard_name" id="guard_name" class="appearance-none form-input">
                                                <option value="web">web</option>
                                            </select>
                                        </div>
                                        <div>
                                            <input type="text" name="name" value="{{old('name')}}" class="appearance-none form-input" autocomplete="off">
                                        </div>
                                        <button class="py-2 px-4 bg-blue-500 text-white rounded-md">추가</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endhasrole
</div>
@endsection
<script>
    var tabHistoryPush = function ($tab){
        var history = '{{route('admin.permission')}}/'+$tab;
        window.history.pushState (null, "호텔에삶 State change", history);
    }
</script>
