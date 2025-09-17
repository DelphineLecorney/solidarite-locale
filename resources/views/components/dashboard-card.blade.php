@php
    $presets = [
        'dashboard' => [
            'icon' => 'bi-speedometer2',
            'iconBgClass' => 'bg-primary bg-opacity-10 text-primary',
            'buttonClass' => 'primary',
            'buttonIcon' => 'bi-speedometer2',
        ],
        'requests' => [
            'icon' => 'bi-gear-fill',
            'iconBgClass' => 'bg-success bg-opacity-10 text-success',
            'buttonClass' => 'success',
            'buttonIcon' => 'bi-gear-fill',
        ],
        'missions' => [
            'icon' => 'bi-briefcase-fill',
            'iconBgClass' => 'bg-info bg-opacity-10 text-info',
            'buttonClass' => 'info',
            'buttonIcon' => 'bi-briefcase-fill',
        ],
        'participations' => [
            'icon' => 'bi-check2-circle',
            'iconBgClass' => 'bg-warning bg-opacity-10 text-warning',
            'buttonClass' => 'warning',
            'buttonIcon' => 'bi-check2-circle',
        ],

    ];

    if (!empty($type) && isset($presets[$type])) {
        $icon = $icon ?? $presets[$type]['icon'];
        $iconBgClass = $iconBgClass ?? $presets[$type]['iconBgClass'];
        $buttonClass = $buttonClass ?? $presets[$type]['buttonClass'];
        $buttonIcon = $buttonIcon ?? $presets[$type]['buttonIcon'];
    }
@endphp

<div class="col-md-3 mb-4">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden h-100">
        <div class="card-body d-flex align-items-center">
            <div class="{{ $iconBgClass }} p-3 rounded-3 me-3">
                <i class="bi {{ $icon }} fs-2"></i>
            </div>
            <div>
                <h6 class="text-muted mb-1">{{ $title }}</h6>

                @if (!empty($count))
                    <h3 class="fw-bold mb-2">{{ $count }}</h3>
                @endif

                @if (isset($buttonText) && isset($buttonUrl))
                    <a href="{{ $buttonUrl }}"
                       class="btn btn-sm btn-{{ $buttonClass ?? 'secondary' }} text-white rounded-pill">
                        <i class="bi {{ $buttonIcon ?? $icon }} me-1"></i>
                        {{ $buttonText }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
