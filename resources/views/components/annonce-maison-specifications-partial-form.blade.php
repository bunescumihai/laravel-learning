@props([
    'annonce' => null
])

<div class="mt-3">
    <label class="form-label" for="roomsNumber">Rooms number</label>
    <input
        name="specifications[roomsNumber]"
        id="roomsNumber"
        type="number"
        class="form-control"
        min="1"
        max="10"
        value="{{ old('specifications[roomsNumber]', $annonce->specifications['roomsNumber'] ?? 1) }}"
        required
    >
</div>
