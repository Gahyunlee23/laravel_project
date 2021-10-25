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
        {{$user->email}}
    </td>
    <td class="py-3 px-6 text-center">
        {{$user->created_at}}
    </td>
    <td class="py-3 px-6 text-center">
        <div class="space-y-px divide-y divide-tm-c-30373F">
            @if($user->roles->count() >= 1)
                @foreach ($user->roles as $role)
                    <div>
                        {{$role->name}}
                    </div>
                @endforeach
            @else
                역할 없음
            @endif
        </div>
    </td>
    <td class="py-3 px-6 text-center">
        <div class="space-y-px divide-y divide-tm-c-30373F">
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

    @if($type==='hotel' && $user->hasRole('hotel'))
        <td class="py-3 px-6 text-center space-y-1">
            @foreach ($user->hotelManagers as $adminHotel)
                <div>
                    {{$adminHotel->hotel->option->title}}
                </div>
            @endforeach
            @if($user->hotelManagers->count() === 0)
                <div>
                    관리 호텔 없음
                </div>
            @endif
        </td>
    @endif
    <td class="py-3 px-6 text-center">
        @if(auth()->user()->hasPermissionTo('admin permission'))
            <x-form.buttons.button-01
                name="수정" width_class="w-full p-2" height_class="" text_color="text-white" bg_class="bg-blue-500 hover:bg-blue-600"
                onclick="location.href='{{route('admin.permission.edit', ['user'=>$user->id])}}';"
            ></x-form.buttons.button-01>
        @else
            권한없음
        @endif
    </td>
</tr>
