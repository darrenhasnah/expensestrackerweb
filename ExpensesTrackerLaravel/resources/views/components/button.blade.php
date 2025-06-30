@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'submit' => false
])

@php
    $baseClasses = '';
    
    $variantClasses = [
        'primary' => 'background: #007bff; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 3px;',
        'success' => 'background: #28a745; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 3px;',
        'danger' => 'background: #dc3545; color: white; padding: 8px 16px; border: none; cursor: pointer; border-radius: 3px;',
        'secondary' => 'background: #6c757d; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 3px;',
    ];
    
    $styles = $variantClasses[$variant] ?? $variantClasses['primary'];
@endphp

@if($href)
    <a href="{{ $href }}" style="{{ $styles }}" {{ $attributes }}>
        {{ $slot }}
    </a>
@else
    <button 
        type="{{ $submit ? 'submit' : $type }}" 
        style="{{ $styles }}"
        {{ $attributes }}
    >
        {{ $slot }}
    </button>
@endif