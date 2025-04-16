@php
    use App\Enums\AnnonceTypeEnum;
@endphp

<div class="border border-1 border-opacity-25">
    <div
        class="rounded-top"
        style="background-image: url('{{asset('storage/'. $annonce->firstImage())}}'); background-size: cover; background-position: center; height: 200px; width: 100%">
    </div>
    <div class="p-2">
        <a href="#" class="mt-2">{{ $annonce->title }}</a>

        <p class="mt-2">Type:
            @switch($annonce->annonce_type)
                @case(AnnonceTypeEnum::MAISON->value)
                    Maison
                    @break

                @case(AnnonceTypeEnum::TERRAIN->value)
                    Terrain
                    @break
            @endswitch
        </p>

        <div class="d-flex justify-content-end ">
            <a href="{{ route('clients.show', $annonce->client->id) }}" class="align-items-center d-flex link-primary">

                <div class="rounded-circle me-2"
                     style="background-image: url('{{asset('storage/' . $annonce->client->image)}}'); width: 40px; height: 40px; background-size: cover; background-position: center"></div>
                {{ $annonce->client->name }}
            </a>
        </div>

    </div>
</div>
