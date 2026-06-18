<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn-secondary focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
