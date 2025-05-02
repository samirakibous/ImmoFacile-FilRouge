@extends('layouts.app')

@section('content')
<x-navbar />
<div class="container py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">

        <!-- Image principale -->
        <img src="{{ asset($property->getFirstImageUrl()) }}" 
             alt="{{ $property->title }}"
             class="w-full h-96 object-cover">

        <div class="p-6">
            <h1 class="text-3xl font-bold">{{ $property->title }}</h1>

            <!-- Prix -->
            <div class="text-2xl my-4 text-indigo-600">
                {{ number_format($property->price, 0, ',', ' ') }} €
            </div>

            <!-- Infos générales -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 my-6">
                <div>📍 Adresse : {{ $property->adresse }}</div>
                <div>🏙️ Ville : {{ $property->ville }}</div>
                <div>📮 Code Postal : {{ $property->code_postal }}</div>
                <div>🌍 Pays : {{ $property->pays }}</div>
                <div>📏 Surface : {{ $property->surface }} m²</div>
                <div>🛏️ Chambres : {{ $property->chambres }}</div>
                <div>🛁 Salles de bain : {{ $property->salle_de_bain }}</div>
                <div>🏗️ Année de construction : {{ $property->age }}</div>
                <div>🏢 Étages : {{ $property->etages }}</div>
                <div>🛠️ Condition : {{ ucfirst(str_replace('_', ' ', $property->condition)) }}</div>
                <div>📂 Type de transaction : {{ ucfirst($property->type_transaction) }}</div>
                <div>🏷️ Catégorie : {{ $property->category->name ?? 'Non définie' }}</div>
            </div>

            <!-- Équipements -->
            @php
                $features = json_decode($property->equipement, true);
            @endphp

            @if(!empty($features))
                <div class="mt-4">
                    <h3 class="font-semibold">Équipements :</h3>
                    <ul class="list-disc ml-6">
                        @foreach($features as $feature)
                            <li>{{ ucfirst(str_replace('_', ' ', $feature)) }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Description -->
            <div class="prose max-w-none mt-6">
                {!! nl2br(e($property->description)) !!}
            </div>

            <!-- Images supplémentaires -->
            @if ($property->images && $property->images->count() > 1)
                <h3 class="mt-6 font-semibold text-lg">Galerie de photos :</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-2">
                    @foreach ($property->images as $image)
                        <img src="{{ asset('storage/' . $image->image_url) }}" 
                             alt="Image" 
                             class="w-full h-48 object-cover rounded-lg shadow-sm">
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
<div class="mt-8">
    <form action="{{ route('checkout.session', $property->id) }}" method="POST">
        @csrf
        <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded">
            🔐 Payer avec Stripe
        </button>
    </form>
</div>
@endsection
