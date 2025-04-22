@php
    use App\Models\ContactType;

    $contactTypes = ContactType::get();
@endphp

@props([
    'action' => '',
    'annonce' => null,
    'method' => 'POST',
])

<form action="{{ $action }}" method="post" enctype="multipart/form-data">
    @csrf
    @method($method)

    <div class="mt-2">
        <label for="title" class="form-label">Title</label>
        <input
            name="title"
            id="title"
            type="text"
            class="form-control"
            placeholder="enter your title"
            value="{{ old('title', $annonce->title ?? '') }}"
            required
        >
        @error('title')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mt-2">
        <label for="description" class="form-label">Description</label>
        <textarea
            name="description"
            id="description"
            type="text"
            class="form-control"
            placeholder="enter your description"
            required>{{ old('description', $annonce->description ?? '') }}</textarea>
        @error('description')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="mt-2">
        <label for="address" class="form-label">Address</label>
        <input
            name="address"
            id="address"
            type="text"
            class="form-control"
            placeholder="enter your address"
            value="{{ old('address', $annonce->address ?? '') }}"
            required
        >
        @error('address')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    @foreach($contactTypes as $index => $contactType)
        <div class="mt-2">
            <label for="{{$contactType->name}}" class="form-label">{{ $contactType->name }}</label>
            <input type="hidden" name="contacts[{{ $index }}][contactTypeId]" class="form-control"
                   value="{{ $contactType->id }}" required>
            <input name="contacts[{{ $index }}][value]" id="{{$contactType->name}}"
                   value="{{ old('contacts[' . $index . '][value]', optional($annonce?->contacts?->firstWhere('contact_type_id', $contactType->id))->value) }}"
                   class="form-control">
        </div>
    @endforeach

    <div class="form-check form-switch mt-2">
        <input type="hidden" name="use_client_contacts" value="0">
        <input
            name="use_client_contacts"
            class="form-check-input"
            type="checkbox"
            id="use_client_contacts"
            value="1"
        @checked(($annonce?->use_client_contacts ?? false) || old('use_client_contacts'))
        >
        <label class="form-check-label" for="use_client_contacts">Use client contacts</label>
    </div>

    <div class="row mt-2">
        <div class="col-6">
            <label class="form-label" for="start_publication_date">Start publication date</label>
            <input
                name="start_publication_date"
                class="form-control"
                type="date"
                id="start_publication_date"
                required
                value="{{ isset($annonce->start_publication_date) ? $annonce->start_publication_date : old('start_publication_date', now()->format('Y-m-d')) }}"
            >
            @error('start_publication_date')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-6">
            <label class="form-label" for="end_publication_date">End publication date</label>
            <input
                name="end_publication_date"
                class="form-control"
                type="date"
                id="end_publication_date"
                required
                value="{{ old('end_publication_date', $annonce->end_publication_date ?? null) }}"
            >
            @error('end_publication_date')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{ $slot }}

    <div class="mt-3">
        <label for="image" class="form-label">Choose images</label>
        <input
            name="images[]"
            multiple
            id="images"
            type="file"
            accept="images/jpg"
            class="form-control"
        >
        @error('images')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="images-preview mt-2"></div>

    <button class="btn btn-primary mt-4">Submit</button>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


</form>

<script>
    let $imagesPreview = $('.images-preview');

    $('#images').on('change', function (e){
        let images = Array.from(e.currentTarget.files);

        $imagesPreview.empty();
        images.forEach((image) => {
            let reader = new FileReader();
            let imageDiv = document.createElement('div');

            imageDiv.classList.add('image');
            imageDiv.classList.add('image-sm');

            reader.onload = function (e) {
                imageDiv.style.backgroundImage = 'url(' + e.target.result + ')';
                $imagesPreview.append(imageDiv);
            }
            reader.readAsDataURL(image);
        });
    });
</script>
