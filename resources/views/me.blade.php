<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <h2 class="text-2xl font-bold mb-6">My Profile</h2>

                @if (session('status'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Avatar & Basic Info -->
                    <div class="text-center">
                        <div
                            class="mx-auto w-32 h-32 bg-gray-200 dark:bg-gray-700 border-2 border-dashed rounded-full flex items-center justify-center">
                            <span class="text-5xl font-bold text-gray-500">
                                {{ strtoupper(substr(auth()->user()->name ?? 'User', 0, 2)) }}
                            </span>
                        </div>

                        <h3 class="mt-4 text-xl font-semibold">{{ auth()->user()->name }}</h3>
                        <p class="text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>

                        <span
                            class="inline-block mt-3 px-4 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">
                            {{ auth()->user()->is_admin ? 'Administrator' : 'User' }}
                        </span>
                    </div>

                    <!-- Profile Details & Actions -->
                    <div class="md:col-span-2 space-y-6">
                        {{-- <div>
                            <h4 class="text-lg font-medium mb-4">Account Actions</h4>

                            <div class="space-y-3">
                                <a href="{{ route('profile.edit') }}"
                                    class="block w-full text-left px-4 py-3 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                                    Edit Profile
                                </a>

                                <a href="{{ route('password.edit') }}"
                                    class="block w-full text-left px-4 py-3 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                                    Change Password
                                </a>

                                @if (config('tyro-login.otp.enabled'))
                                    <a href="{{ route('otp.settings') }}"
                                        class="block w-full text-left px-4 py-3 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                                        Two-Factor Authentication (OTP)
                                    </a>
                                @endif
                            </div>
                        </div> --}}
                        <br>
                        <!-- Logout Button -->
                        <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                            <form method="POST" action="{{ url('/logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full md:w-auto px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition duration-200">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
