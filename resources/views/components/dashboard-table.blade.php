@props(['title'])

<div class="card w-100 mb-4">
    <div class="card-header">
        <h5 class="mb-0">{{ $title }}</h5>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped table-bordered table-hover mb-0">
            <thead>
                {{ $header ?? '' }}
            </thead>
            <tbody>
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
