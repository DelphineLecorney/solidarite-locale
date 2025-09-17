@php

    $presets = [
        'dashboard' => [
            'icon' => 'bi-speedometer2',
            'color' => 'primary',
            'iconBgClass' => 'bg-primary bg-opacity-10 text-primary',
            'buttonClass' => 'primary',
            'buttonIcon' => 'bi-speedometer2',
        ],
        'requests' => [
            'icon' => 'bi-gear-fill',
            'color' => 'success',
            'iconBgClass' => 'bg-success bg-opacity-10 text-success',
            'buttonClass' => 'success',
            'buttonIcon' => 'bi-gear-fill',
        ],
        'missions' => [
            'icon' => 'bi-briefcase-fill',
            'color' => 'info',
            'iconBgClass' => 'bg-info bg-opacity-10 text-info',
            'buttonClass' => 'info',
            'buttonIcon' => 'bi-briefcase-fill',
        ],
        'participations' => [
            'icon' => 'bi-check2-circle',
            'color' => 'warning',
            'iconBgClass' => 'bg-warning bg-opacity-10 text-warning',
            'buttonClass' => 'warning',
            'buttonIcon' => 'bi-check2-circle',
        ],
        'users' => [
            'icon' => 'bi-people-fill',
            'color' => 'secondary',
            'iconBgClass' => 'bg-secondary bg-opacity-10 text-secondary',
            'buttonClass' => 'secondary',
            'buttonIcon' => 'bi-people-fill',
        ],
        'roles' => [
            'icon' => 'bi-shield-lock-fill',
            'color' => 'dark',
            'iconBgClass' => 'bg-dark bg-opacity-10 text-dark',
            'buttonClass' => 'dark',
            'buttonIcon' => 'bi-shield-lock-fill',
        ],
        'events' => [
            'icon' => 'bi-calendar-event-fill',
            'color' => 'info',
            'iconBgClass' => 'bg-info bg-opacity-10 text-info',
            'buttonClass' => 'info',
            'buttonIcon' => 'bi-calendar-event-fill',
        ],
        'alerts' => [
            'icon' => 'bi-exclamation-triangle-fill',
            'color' => 'danger',
            'iconBgClass' => 'bg-danger bg-opacity-10 text-danger',
            'buttonClass' => 'danger',
            'buttonIcon' => 'bi-exclamation-triangle-fill',
        ],
    ];

    if (!empty($type) && isset($presets[$type])) {
        $icon = $icon ?? $presets[$type]['icon'];
        $color = $color ?? $presets[$type]['color'];
    }

    $level = $level ?? 'h2';
@endphp


<div class="d-flex flex-column justify-content-center align-items-center mb-4 pb-2 border-bottom">
    @if (!empty($icon))
        <i class="bi {{ $icon }} fs-3 text-{{ $color ?? 'primary' }} mb-2"></i>
    @endif

    <<?php echo $level; ?> class="fw-bold mb-0 text-{{ $color ?? 'primary' }} text-center">
        {{ $slot }}
    </<?php echo $level; ?>>
</div>

