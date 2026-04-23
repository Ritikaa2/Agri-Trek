<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-blue-500/20 text-blue-500 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V4a2 2 0 00-2-2H4a2 2 0 00-2 2v16h5z"></path></svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-white leading-tight tracking-tight">
                {{ __('User Management Hub') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#161d19] shadow-xl border border-gray-100 dark:border-gray-800 sm:rounded-3xl p-8 overflow-hidden relative">
                
                <div class="mb-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Registered Farmers & Officers</h3>
                        <p class="text-gray-500 text-sm mt-1">Review system users and their KYC validation status.</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-800 text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                <th class="pb-4 pl-4">Name</th>
                                <th class="pb-4">Role</th>
                                <th class="pb-4">Phone / Aadhaar</th>
                                <th class="pb-4">Location</th>
                                <th class="pb-4 text-right pr-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @foreach($users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-colors group">
                                <td class="py-4 pl-4">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=10b981&color=fff&bold=true" class="w-10 h-10 rounded-full" alt="">
                                        <div>
                                            <p class="font-semibold text-gray-900 dark:text-white">{{ $user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium uppercase
                                        @if($user->role === 'admin') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300
                                        @elseif($user->role === 'farmer') bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-300
                                        @else bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300 @endif
                                    ">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="py-4 text-sm text-gray-600 dark:text-gray-400">
                                    @if($user->farmer)
                                        <p>{{ $user->farmer->phone }}</p>
                                        <p class="text-xs font-mono text-gray-400 mt-1">{{ substr($user->farmer->aadhaar_no, 0, 4) }}-XXXX-XXXX</p>
                                    @else
                                        <span class="text-gray-300 dark:text-gray-600 italic">N/A</span>
                                    @endif
                                </td>
                                <td class="py-4 text-sm text-gray-600 dark:text-gray-400">
                                    @if($user->farmer)
                                        <p>{{ $user->farmer->village }}</p>
                                        <p class="text-xs">{{ $user->farmer->district }}</p>
                                    @else
                                        <span class="text-gray-300 dark:text-gray-600 italic">N/A</span>
                                    @endif
                                </td>
                                <td class="py-4 text-right pr-4">
                                    @if($user->role === 'farmer')
                                        @if($user->farmer)
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800">
                                                <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div> KYC Verified
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800">
                                                <div class="w-1.5 h-1.5 rounded-full bg-yellow-500"></div> Pending KYC
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-gray-400 dark:text-gray-600 text-sm">System</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
