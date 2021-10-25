@extends('layouts.app')

@section('top-style')
    <style type="text/css">

    </style>
@endsection


@section('content')
    <div class="max-w-1200 mx-auto">
        <div class="flex justify-center">
            <div class="w-full">
                <div class="pt-2 px-2 space-y-6">
                    <div>
                        <a href="{{route('curator.index')}}"  class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded text-center cursor-pointer">
                            목록
                        </a>
                    </div>

                    <div class="flex flex-col justify-between p-4 bg-gray-200 rounded-sm">
                        <div class="py-2 flex bg-gray-400 text-center font-bold text-xl rounded-md">
                            <div class="flex-1">
                                ID
                            </div>
                            <div class="flex-1">
                                PAGE
                            </div>
                            <div class="flex-1">
                                Pass
                            </div>
                            <div class="flex-1">
                                이름
                            </div>
                            <div class="flex-1">
                                연락처
                            </div>
                            <div class="flex-1">
                                이메일
                            </div>
                            <div class="flex-1">
                                메모
                            </div>
                            <div class="flex-1">
                                기능
                            </div>
                        </div>
                        <form id="form" action="{{route('curator.store')}}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="text-center">
                                <div class="flex py-4 bg-gray-300 rounded-md space-x-2">
                                    <div class="flex-1">
                                        <input type="text" name="user_id" value="{{old('user_id')}}" required class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                    </div>
                                    <div class="flex-1">
                                        <input type="text" name="user_page" value="{{old('user_page')}}" required class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                    </div>
                                    <div class="flex-1">
                                        <input type="text" name="user_pass" value="{{old('user_pass')}}" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                    </div>
                                    <div class="flex-1">
                                        <input type="text" name="name" value="{{old('name')}}" required class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                    </div>
                                    <div class="flex-1">
                                        <input type="text" name="tel" value="{{old('tel')}}" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                    </div>
                                    <div class="flex-1">
                                        <input type="text" name="email" value="{{old('email')}}" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                    </div>
                                    <div class="flex-1">
                                        <input type="text" name="explanation" value="{{old('explanation')}}" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex space-x-2 justify-center">
                                            <button
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center cursor-pointer">
                                                등록
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div>Page 명칭은 'admin','hotel','travelmaker','travelmakers','developer','dev' 을 포함하지 못합니다</div>
                    </div>

                </div>

            </div>

        </div>
    </div>

@endsection

@section('bottom-script')

@endsection
