@csrf

<div class="mb-3">
    <label class="form-label">Titre</label>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
           value="{{ old('title', $helpRequest->title ?? '') }}" required>
    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description', $helpRequest->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Catégorie</label>
        <select name="help_category_id" class="form-select">
            <option value="">—</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ (old('help_category_id', $helpRequest->help_category_id ?? '') == $cat->id) ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Adresse</label>
        <select name="address_id" class="form-select">
            <option value="">—</option>
            @foreach($addresses as $addr)
                <option value="{{ $addr->id }}" {{ (old('address_id', $helpRequest->address_id ?? '') == $addr->id) ? 'selected' : '' }}>
                    {{ $addr->street }}, {{ $addr->city }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Date / Heure (optionnel)</label>
    <input type="datetime-local" name="scheduled_at" class="form-control"
           value="{{ old('scheduled_at', isset($helpRequest->scheduled_at) ? \Carbon\Carbon::parse($helpRequest->scheduled_at)->format('Y-m-d\TH:i') : '') }}">
</div>

<button class="btn btn-primary">{{ $buttonText ?? 'Enregistrer' }}</button>
