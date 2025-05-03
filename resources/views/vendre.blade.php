@extends('layouts.app')

@section('title', 'vendre')

@section('content')
    <x-navbar />
    <section id="featured-properties" class="py-16 bg-gray-50">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($properties as $property)
                <x-property-card :property="$property" />
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500">Aucun bien immobilier disponible pour le moment.</p>
                </div>
            @endforelse
        </div>
    </section>
    <x-footer />
@endsection
