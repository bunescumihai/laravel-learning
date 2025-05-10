@props(['annonces' => null])

<div class="row row-cols-4 g-3">
    @foreach($annonces as $annonce)
        <div>
            <x-annonce-card :annonce="$annonce"></x-annonce-card>
        </div>
    @endforeach
</div>
