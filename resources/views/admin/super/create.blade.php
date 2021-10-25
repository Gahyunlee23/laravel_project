@extends('layouts.app')
@section('content')
<div class="max-w-1200 mx-auto px-2 pb-10">

    <div class="">
        <div class="min-w-screen flex items-center justify-center">
            <div class="bg-white shadow-md rounded my-6 overflow-x-auto">

                <form class="w-full" method="post" action="{{route('admins.store')}}">
                    @csrf
                    @method('post')
                    <table class="min-w-max w-full table table-bordered table-striped table-hover" id="data-table">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">성명</th>
                                <th class="py-3 px-6 text-left">password</th>
                                <th class="py-3 px-6 text-left">이메일</th>
                                <th class="py-3 px-6 text-center">역할</th>
                                <th class="py-3 px-6 text-center">권한</th>
                            </tr>
                        </thead>

                        <tbody class="text-gray-600 text-sm font-light">
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="">
                                        <input name="name" id="name" type="text" autocomplete="off" class="appearance-none form-input">
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <input name="password" id="password" type="password" autocomplete="off" class="appearance-none form-input">
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <input name="email" id="email" type="email" autocomplete="off" class="appearance-none form-input">
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <select name="role" id="role" class="appearance-none form-input">
                                        <option value="">없음</option>
                                        @foreach (\Spatie\Permission\Models\Role::whereNotIn('name', ['super-admin'])->get() as $role)
                                            <option @if($role->name === 'hotel-admin') selected @endif value="{{$role->name}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <select name="permission" id="permission" class="appearance-none form-input">
                                        <option value="">없음</option>
                                        @foreach (\Spatie\Permission\Models\Permission::whereNotIn('name', ['permission application','admin permission'])->get() as $permission)
                                            <option value="{{$permission->name}}">{{$permission->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="py-2 px-2 flex">
                        <div>
                            <a class="py-2 px-4 bg-green-500 hover:bg-green-600 text-white rounded-md leading-6"
                               href="{{route('admin.permission')}}">
                                돌아가기
                            </a>
                        </div>
                        <div class="ml-auto">
                            <button class="py-2 px-4 bg-blue-500 text-white rounded-md">추가</button>
                        </div>
                    </div>
                </form>
                @if($errors->count()>=1)
                    <div class="px-2 py-4 bg-red-500 text-white space-y-px">
                        @foreach ($errors->all() as $message)
                        <div>
                            {{ $message }}
                        </div>
                        @endforeach
                    </div>
                @endif

                @if(session('success'))
                    <div class="px-2 py-4 bg-green-500 text-white space-y-px">
                        <div>
                            {{session('success')}}
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

</div>
@endsection
