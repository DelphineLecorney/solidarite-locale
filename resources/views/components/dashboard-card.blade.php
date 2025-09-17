<div class="col-md-3 mb-4">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden h-100">
        <div class="card-body d-flex align-items-center">
            <div class="{{ $iconBgClass }} p-3 rounded-3 me-3">
                <i class="bi {{ $icon }} fs-2"></i>
            </div>
            <div>
                <h6 class="text-muted mb-1">{{ $title }}</h6>

                @isset($count)
                    <h3 class="fw-bold mb-2">{{ $count }}</h3>
                @endisset

                @if (isset($buttonText) && isset($buttonUrl))
                    <a href="{{ $buttonUrl }}"
                       class="btn btn-sm btn-{{ $buttonClass ?? 'secondary' }} text-white rounded-pill">
                        @isset($buttonIcon)
                            <i class="bi {{ $buttonIcon }} me-1"></i>
                        @endisset
                        {{ $buttonText }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
