   <!-- Sidebar -->
   <div class="w-full md:w-1/4">
       <div class="bg-white rounded-lg shadow">
           <div class="p-6">
               <h5 class="text-lg font-medium mb-4">My Profile</h5>
               <ul class="space-y-2">
                   <li><a href="{{ route('profile.index') }}"
                           class="block py-2 text-gray-600 hover:text-blue-500">Profile</a></li>
                   <li><a href="{{ route('profile.compte')}}" class="block py-2 text-gray-600 hover:text-blue-500">gestion de compte</a></li>
                   <li><a href="{{ route('profile.favoris')}}" class="block py-2 text-gray-600 hover:text-blue-500">Favoris</a></li>
                   <li><a href="{{ route('profile.achats')}}" class="block py-2 text-gray-600 hover:text-blue-500">Achats</a></li>
               </ul>
           </div>
       </div>
   </div>
    <!-- End Sidebar -->