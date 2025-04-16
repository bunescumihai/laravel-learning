<form action="{{ $action }}" method="post" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="title" class="form-label">Title</label>
        <input name="title" id="title" type="text" class="form-control"
               placeholder="enter your title"
               value="{{ old('title') }}"
               required
        >
        @error('title')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" type="text" class="form-control"
                  placeholder="enter your description"
                  required
        >{{ old('description') }}</textarea>
        @error('description')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="address" class="form-label">Address</label>
        <input name="address" id="address" type="text" class="form-control"
               placeholder="enter your address"
               value="{{ old('address') }}"
               required
        >
        @error('address')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email" class="form-label">Email</label>
        <input type="hidden" name="contacts[0][type]" class="form-control"
               value="{{ \App\Enums\ContactTypeEnum::EMAIL }}" required>
        <input name="contacts[0][value]" id="email" type="email" class="form-control">

        <label for="phone" class="form-label">Phone number</label>
        <input type="hidden" name="contacts[1][type]" class="form-control"
               value="{{ \App\Enums\ContactTypeEnum::PHONE }}" required>
        <input name="contacts[1][value]" id="phone" type="text" class="form-control">
    </div>

    <div class="form-check form-switch mt-3">
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" >
        <label class="form-check-label" for="flexSwitchCheckChecked">Use client contacts</label>
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
