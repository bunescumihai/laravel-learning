@php
    use App\Enums\ContactTypeEnum;
@endphp
<form action="{{ $action }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mt-2">
        <label for="title" class="form-label">Title</label>
        <input
            name="title"
            id="title"
            type="text"
            class="form-control"
            placeholder="enter your title"
            value="{{ old('title') }}"
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
            required>{{ old('description') }}</textarea>
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
            value="{{ old('address') }}"
            required
        >
        @error('address')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="mt-2">
        <label for="email" class="form-label">Email</label>
        <input type="hidden" name="contacts[0][type]" class="form-control"
               value="{{ ContactTypeEnum::EMAIL }}" required>
        <input name="contacts[0][value]" id="email" type="email" class="form-control">

        <label for="phone" class="form-label">Phone number</label>
        <input type="hidden" name="contacts[1][type]" class="form-control"
               value="{{ ContactTypeEnum::PHONE }}" required>
        <input name="contacts[1][value]" id="phone" type="text" class="form-control">
    </div>

    <div class="form-check form-switch mt-2">
        <input
            name="use_client_contacts"
            class="form-check-input"
            type="checkbox"
            id="use_client_contacts"
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
                value="{{ old('start_publication_date', now()->format('Y-m-d')) }}"
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
                value="{{ old('end_publication_date') }}"
            >
            @error('end_publication_date')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{ $slot }}

    <div class="mt-3">
        <label for="image" class="form-label">Chose images</label>
        <input name="images[]" multiple id="images" type="file" accept="images/jpg" class="form-control">
        @error('images')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

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
