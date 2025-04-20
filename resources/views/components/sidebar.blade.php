  <!-- Sidebar -->
  <div class="w-56 bg-white shadow-sm p-5">
      <div class="space-y-1">
          <a href="{{ route('admin.index') }}"
              class="flex items-center px-4 py-3 text-sm rounded-lg font-medium
               {{ request()->routeIs('admin.index') ? 'bg-orange-100 text-orange-800' : 'text-gray-600 hover:bg-gray-100' }}">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <rect x="3" y="3" width="7" height="9" />
                  <rect x="14" y="3" width="7" height="5" />
                  <rect x="14" y="12" width="7" height="9" />
                  <rect x="3" y="16" width="7" height="5" />
              </svg>
              Dashboard
          </a>
          <a href="#" class="flex items-center px-4 py-3 text-sm rounded-lg text-gray-600 hover:bg-gray-100">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              Articles
          </a>
          <a href="{{ route('admin.demandes') }}"
              class="flex items-center px-4 py-3 text-sm rounded-lg font-medium
               {{ request()->routeIs('admin.demandes') ? 'bg-orange-100 text-orange-800' : 'text-gray-600 hover:bg-gray-100' }}">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Demandes connexion
          </a>
          <a href="{{ route('admin.users') }}"
          class="flex items-center px-4 py-3 text-sm rounded-lg font-medium
          {{ request()->routeIs('admin.users') ? 'bg-orange-100 text-orange-800' : 'text-gray-600 hover:bg-gray-100' }}">
       
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
              </svg>
              Users
          </a>
          <a href="#" class="flex items-center px-4 py-3 text-sm rounded-lg text-gray-600 hover:bg-gray-100">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
              </svg>
              Analytics
          </a>
          <a href="#" class="flex items-center px-4 py-3 text-sm rounded-lg text-gray-600 hover:bg-gray-100">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
              Reviews
          </a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center px-4 py-3 text-sm rounded-lg text-gray-600 hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </button>
        </form>
        </form>
      </div>
  </div>
