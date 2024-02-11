@extends('layouts.auth')

@section('title', 'Categories')

@section('content')
    <div class="grid grid-cols-3 gap-4 w-full mx-4">
        <div class="col-span-2 w-full">
            <div
                class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white rounded-lg shadow border-0 border-transparent border-solid">
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Name</th>
                                    <th
                                        class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr id="category-{{ $category['id'] }}" class="transition-opacity ease-out duration-1000">
                                        <td
                                            class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <div class="flex px-2 py-1">
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 leading-normal text-sm">{{ $category['name'] }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 align-middle text-right bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <a href="/categories/{{ $category['id'] }}"
                                                class="font-semibold uppercase leading-tight text-xs text-white bg-yellow-600 py-1 px-3 rounded">
                                                Edit </a>

                                            <button type="button" data-url="/categories/{{ $category['id'] }}"
                                                data-target="#category-{{ $category['id'] }}"
                                                class="btn-remove font-semibold uppercase leading-tight text-xs text-white bg-red-600 ml-2 py-1 px-3 rounded">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1 w-full">
            <div class="flex justify-center px-6 py-8 mx-auto rounded-lg shadow lg:py-0">
                <div class="w-full md:mt-0 sm:max-w-md xl:p-0">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <form class="space-y-4 md:space-y-6" action="/categories" method="POST">
                            <div>
                                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                    Name
                                </label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" />
                            </div>
                            <button type="submit"
                                class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
