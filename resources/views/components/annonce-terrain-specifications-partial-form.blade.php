<div class="mt-3">
    <label class="form-label" for="surface">Surface</label>
    <input
        name="specifications[surface]"
        id="surface"
        type="number"
        class="form-control"
        min="1"
        max="10"
        value="{{ old('specifications[roomsNumber]', $annonce->specifications->surface ?? 1) }}"
        required
    >
</div>
