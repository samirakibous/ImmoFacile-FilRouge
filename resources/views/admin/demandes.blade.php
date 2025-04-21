@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Navbar -->
    <x-navbar />
    <div class="flex min-h-screen">
        <x-sidebar />
        <!-- Main Content -->
        <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Demandes d'accès</h2>
                <div class="flex items-center space-x-2">
                    <span class="bg-yellow-100 text-yellow-800 py-1 px-3 rounded-full text-sm font-medium">
                        {{ $totalDemandes }} demandes en attente
                    </span>
                    <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-sm font-medium">
                        {{ $totalUsers }} utilisateurs au total
                    </span>
                </div>
            </div>

            @if ($demandes->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nom
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date de demande
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($demandes as $demande)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $demande->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">

                                            <div class="text-sm font-medium text-gray-900">{{ $demande->name }}</div>

                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $demande->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $demande->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form method="POST" action="{{ route('admin.demandes.update', $demande->id) }}"
                                            class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded-md mr-2 transition duration-300">
                                                Accepter
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.demandes.destroy', $demande->id) }}"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded-md transition duration-300">
                                                Refuser
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-6 text-center">
                    <p class="text-gray-500">Aucune demande en attente.</p>
                </div>
            @endif

            <!-- Pagination si nécessaire -->
            @if ($demandes->count() > 0 && method_exists($demandes, 'links'))
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $demandes->links() }}
                </div>
            @endif
        </div>
    </div>


@endsection
