@extends('layouts.app')
@section('title', 'Tableau de bord')
@section('content')
<div class="flex ">
    <x-sidebar />
<div class="py-6">
    <div class="w-f mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Tableau de bord statistique</h1>
        
        <!-- Cartes de statistiques principales -->
        <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Total Utilisateurs -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Utilisateurs</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">{{ $totalUsers }}</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Utilisateurs Actifs -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Utilisateurs Actifs</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">{{ $activeUsers }}</div>
                                    <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                        {{ number_format(($activeUsers / $totalUsers) * 100, 1) }}%
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Demandes en attente -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Demandes en attente</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">{{ $pendingUsers }}</div>
                                    <div class="ml-2 flex items-baseline text-sm font-semibold text-yellow-600">
                                        {{ number_format(($pendingUsers / $totalUsers) * 100, 1) }}%
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:px-6">
                    <div class="text-sm">
                        <a href="{{ route('admin.demandes') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Voir toutes les demandes <span class="sr-only">demandes en attente</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Utilisateurs Suspendus -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Utilisateurs Suspendus</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">{{ $suspendedUsers }}</div>
                                    <div class="ml-2 flex items-baseline text-sm font-semibold text-red-600">
                                        {{ number_format(($suspendedUsers / $totalUsers) * 100, 1) }}%
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graphiques -->
        <div class="mt-8 grid grid-cols-1 gap-8 lg:grid-cols-2">
            <!-- Diagramme circulaire pour les rôles -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Répartition par rôle</h3>
                    <div class="mt-6" style="height: 350px;">
                        <canvas id="roleChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Graphique pour les nouvelles inscriptions -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Nouvelles inscriptions (30 derniers jours)</h3>
                    <div class="mt-6" style="height: 350px;">
                        <canvas id="registrationChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des statuts -->
        <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Statuts des utilisateurs</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Vue d'ensemble des statuts des utilisateurs</p>
            </div>
            <div class="border-t border-gray-200">
                <div class="px-4 py-5 sm:p-6">
                    <div class="w-full">
                        <!-- Barre active -->
                        <div class="flex items-center mt-4">
                            <div class="w-1/4 text-sm font-medium text-gray-900">Actifs</div>
                            <div class="w-3/4">
                                <div class="relative flex items-center">
                                    <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-200 w-full">
                                        <div style="width:{{ ($activeUsers / $totalUsers) * 100 }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500"></div>
                                    </div>
                                    <div class="ml-2 text-sm font-medium text-gray-700">{{ $activeUsers }} ({{ number_format(($activeUsers / $totalUsers) * 100, 1) }}%)</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Barre en attente -->
                        <div class="flex items-center mt-4">
                            <div class="w-1/4 text-sm font-medium text-gray-900">En attente</div>
                            <div class="w-3/4">
                                <div class="relative flex items-center">
                                    <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-200 w-full">
                                        <div style="width:{{ ($pendingUsers / $totalUsers) * 100 }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-yellow-500"></div>
                                    </div>
                                    <div class="ml-2 text-sm font-medium text-gray-700">{{ $pendingUsers }} ({{ number_format(($pendingUsers / $totalUsers) * 100, 1) }}%)</div>
                                </div>
                            </div>
                        </div>

                        <!-- Barre suspendu -->
                        <div class="flex items-center mt-4">
                            <div class="w-1/4 text-sm font-medium text-gray-900">Suspendu</div>
                            <div class="w-3/4">
                                <div class="relative flex items-center">
                                    <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-200 w-full">
                                        <div style="width:{{ ($suspendedUsers / $totalUsers) * 100 }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-red-500"></div>
                                    </div>
                                    <div class="ml-2 text-sm font-medium text-gray-700">{{ $suspendedUsers }} ({{ number_format(($suspendedUsers / $totalUsers) * 100, 1) }}%)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Configuration du graphique circulaire des rôles
    const roleCtx = document.getElementById('roleChart').getContext('2d');
    const roleChart = new Chart(roleCtx, {
        type: 'doughnut',
        data: {
            labels: [
                @foreach($usersByRole as $role)
                    '{{ $role->name }}',
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach($usersByRole as $role)
                        {{ $role->users_count }},
                    @endforeach
                ],
                backgroundColor: [
                    '#4F46E5', // indigo-600
                    '#10B981', // emerald-500
                    '#F59E0B', // amber-500
                    '#EF4444', // red-500
                    '#8B5CF6', // violet-500
                    '#EC4899', // pink-500
                ],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    // Configuration du graphique des inscriptions
    const regCtx = document.getElementById('registrationChart').getContext('2d');
    const regChart = new Chart(regCtx, {
        type: 'line',
        data: {
            labels: [
                @foreach($last30Days as $day)
                    '{{ \Carbon\Carbon::parse($day['date'])->format('d/m') }}',
                @endforeach
            ],
            datasets: [{
                label: 'Nouvelles inscriptions',
                data: [
                    @foreach($last30Days as $day)
                        {{ $day['count'] }},
                    @endforeach
                ],
                borderColor: '#4F46E5',
                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection