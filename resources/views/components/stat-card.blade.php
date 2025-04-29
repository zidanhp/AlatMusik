<div class="{{ $color }} rounded-lg shadow-lg p-4 sm:p-6 text-white min-h-[160px]">
    <div class="flex flex-col gap-1 sm:gap-2">
        <div class="bg-black w-10 h-10 flex items-center justify-center rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="white">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}" />
            </svg>
        </div>
        <h2 class="text-base sm:text-lg font-medium mt-2">Total</h2>
        <h2 class="text-base sm:text-lg font-medium -mt-2">{{ $title }}</h2>
        <p class="text-3xl sm:text-4xl font-bold">{{ $value }}</p>
    </div>
</div>