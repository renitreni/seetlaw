@if (session("success"))
<div id="notif" class="text-sm shadow absolute right-2 flex gap-2 py-2 px-4 font-bold text-green-700 rounded bg-green-200 border border-green-600 top-[150px]">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
      </svg>

      <span>{{ session("success") }}</span>
</div>
@endif

@if (session("failed"))
<div id="notif" class="text-sm shadow absolute right-2 flex gap-2 py-2 px-4 font-bold text-rose-700 rounded border border-rose-700 bg-rose-300 top-[150px]">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
    </svg>
    <span>{{ session("failed") }}</span>
</div>
@endif
