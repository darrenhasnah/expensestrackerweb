@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'submit' => false
])

@php
    $baseClasses = 'font-medium rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 relative overflow-hidden';
    
    $variantClasses = [
        'primary' => 'bg-blue-600 hover:bg-blue-700 text-white focus:ring-blue-300',
        'success' => 'bg-green-500 hover:bg-green-600 text-white focus:ring-green-300',
        'danger' => 'bg-red-500 hover:bg-red-600 text-white focus:ring-red-300',
        'secondary' => 'bg-gray-500 hover:bg-gray-600 text-white focus:ring-gray-300',
    ];
    
    $sizeClasses = [
        'sm' => 'px-4 py-2 text-sm',
        'md' => 'px-6 py-3 text-base',
        'lg' => 'px-8 py-4 text-lg',
    ];
    
    $classes = $baseClasses . ' ' . ($variantClasses[$variant] ?? $variantClasses['primary']) . ' ' . ($sizeClasses[$size] ?? $sizeClasses['md']);
@endphp

@if($href)
    <a href="{{ $href }}" class="{{ $classes }}" {{ $attributes }}>
        <span class="relative z-10">{{ $slot }}</span>
        <div class="absolute inset-0 bg-white opacity-0 hover:opacity-20 transition-opacity duration-300"></div>
    </a>
@else
    <button 
        type="{{ $submit ? 'submit' : $type }}" 
        class="{{ $classes }}"
        {{ $attributes }}
    >
        <span class="relative z-10">{{ $slot }}</span>
        <div class="absolute inset-0 bg-white opacity-0 hover:opacity-20 transition-opacity duration-300"></div>
    </button>
@endif