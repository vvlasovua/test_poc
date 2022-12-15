@extends('web.layouts.app')

@section('content')
    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-10">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="p-6">
                <div class="flex items-center">
                    <a href="{{ route('socialite.redirect', 'google') }}">
                        <div class="ml-4 text-lg leading-7 font-semibold soc">
                            <div class="soc-sim">
                                <span class="fab fa-google mr-1"></span>
                                G
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div>
            <span class="text-gray-600">Don't Have An Account?</span> <a href="{{ route('socialite.redirect', 'google') }}" class="text-1">Sign Up Now</a>
        </div>
    </div>
@endsection
