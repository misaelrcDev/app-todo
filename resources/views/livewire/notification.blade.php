<div x-data="{ show: @entangle('show') }"
     x-show="show"
     x-transition
     x-init="$watch('show', value => { if (value) { setTimeout(() => show = false, 3000); } })"
     class="fixed px-4 py-2 rounded shadow-lg top-4 right-4"
     :class="{
        'bg-green-500 text-white': @js($type) === 'success',
        'bg-red-500 text-white': @js($type) === 'error',
     }">
    <p>{{ $message }}</p>
</div>
