@if (isset($player))
    <div class="sm:max-w-full max-w-xs mx-auto my-5 px-10">
        <div class="flex items-center text-white justify-end w-full">
            <span class="mr-2">{{ $player->username }}</span>
            {{-- <span>
                {!! file_get_content(public_path('/images/user-circle.svg')) !!}
            </span> --}}
            <img class="w-5 h-5" src="/images/user-circle.svg" alt="">
        </div>
    </div>
@endif