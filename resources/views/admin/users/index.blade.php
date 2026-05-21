<x-app-layout>
    <x-slot name="header">
        <div class="space-y-4">
            <span class="section-badge">Admin directory</span>
            <div>
                <h1 class="page-title">User management</h1>
                <p class="page-subtitle">Review platform members, inspect KYC completion, and keep identities organized.</p>
            </div>
        </div>
    </x-slot>

    <div class="shell-container space-y-6">
        <div class="panel">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <h2 class="text-3xl font-semibold">Registered users</h2>
                    <p class="mt-3 text-sm leading-7 text-muted">
                        Farmers and officers currently visible in the system, including verification status where available.
                    </p>
                </div>
                <div class="status-pill status-info">
                    {{ $users->total() }} records in directory
                </div>
            </div>
        </div>

        <div class="table-shell">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="table-head">
                        <tr>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4">Phone / Aadhaar</th>
                            <th class="px-6 py-4">Location</th>
                            <th class="px-6 py-4 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-[rgba(255,252,246,0.78)]">
                        @foreach($users as $user)
                            <tr class="table-row">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2d7c4b&color=fff&bold=true" class="h-11 w-11 rounded-full" alt="">
                                        <div>
                                            <p class="font-semibold text-[color:var(--ink)]">{{ $user->name }}</p>
                                            <p class="text-sm text-muted">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="status-pill {{ $user->role === 'admin' ? 'status-warning' : ($user->role === 'farmer' ? 'status-success' : 'status-info') }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-sm text-muted">
                                    @if($user->farmer)
                                        <p>{{ $user->farmer->phone }}</p>
                                        <p class="mt-1 font-mono text-xs">{{ substr($user->farmer->aadhaar_no, 0, 4) }}-XXXX-XXXX</p>
                                    @else
                                        <span class="italic">N/A</span>
                                    @endif
                                </td>
                                <td class="px-6 py-5 text-sm text-muted">
                                    @if($user->farmer)
                                        <p>{{ $user->farmer->village }}</p>
                                        <p class="mt-1 text-xs">{{ $user->farmer->district }}</p>
                                    @else
                                        <span class="italic">N/A</span>
                                    @endif
                                </td>
                                <td class="px-6 py-5 text-right">
                                    @if($user->role === 'farmer')
                                        @if($user->farmer)
                                            <span class="status-pill status-success">KYC Verified</span>
                                        @else
                                            <span class="status-pill status-warning">Pending KYC</span>
                                        @endif
                                    @else
                                        <span class="status-pill status-info">System User</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel-soft">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
