@extends('layouts.app')

@section('content')
 <div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="mb-4">
                <label  for="name" 
                        class="sr-only">Name</label>
                <input  type="text" 
                        id="name" 
                        name="name"
                        placeholder="Your name"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg">
            </div>
            <div class="mb-4">
                <label  for="username" 
                        class="sr-only">Username</label>
                <input  type="text" 
                        id="username" 
                        name="username"
                        placeholder="Username"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg">
            </div>
            <div class="mb-4">
                <label  for="email" 
                        class="sr-only">Email</label>
                <input  type="email" 
                        id="email" 
                        name="email"
                        placeholder="Email"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg">
            </div>
            <div class="mb-4">
                <label  for="password" 
                        class="sr-only">Password</label>
                <input  type="password" 
                        id="password" 
                        name="password"
                        placeholder="Choose a password"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg">
            </div>
            <div class="mb-4">
                <label  for="password_confirmation" 
                        class="sr-only">Confirm Password</label>
                <input  type="password" 
                        id="password_confirmation" 
                        name="password_confirmation"
                        placeholder="Confirm password"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg">
            </div>

            <div>
                <button class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">
                    Register
                </button>
            </div>
        </form>
    </div>
 </div>
@endsection