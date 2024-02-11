@extends('layouts.auth')

@section('title', 'Links')

@section('content')
    <div class="grid grid-cols-3 gap-4 w-full mx-4">
        <div class="col-span-2 w-full">
            <div
                class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white  rounded-lg shadow border-0 border-transparent border-solid ">
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Link</th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Category</th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($links as $item)
                                    <tr id="link-{{ $item['id'] }}" class="transition-opacity ease-out duration-1000">
                                        <td
                                            class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <div class="flex px-2 py-1">
                                                <div>
                                                    <img src="{{ $item['thumbnail'] }}"
                                                        class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-in-out text-sm h-9 w-9 rounded-xl"
                                                        alt="user1" />
                                                </div>
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 leading-normal text-sm">{{ $item['title'] }}</h6>
                                                    <a href="{{ $item['url'] }}"
                                                        class="mb-0 leading-tight text-xs text-slate-400">{{ $item['url'] }}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <span
                                                class="font-semibold leading-tight text-xs text-slate-400">{{ $item['category'] ?? '-' }}</span>
                                        </td>
                                        <td
                                            class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent">
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" {{ $item['active'] ? 'checked' : '' }} value=""
                                                    class="sr-only peer checkbox-toggle" data-url="/links/{{ $item['id'] }}/toggle">
                                                <div
                                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                                </div>
                                            </label>
                                        </td>
                                        <td
                                            class="p-2 align-middle text-right bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <a href="/links/{{ $item['id'] }}"
                                                class="font-semibold uppercase leading-tight text-xs text-white bg-yellow-600 py-1 px-3 rounded">
                                                Edit </a>

                                            <button type="button" data-url="/links/{{ $item['id'] }}"
                                                data-target="#link-{{ $item['id'] }}"
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
                        <form class="space-y-4 md:space-y-6" action="{{ isset($link) ? "/links/{$link['id']}" : '/links' }}" method="POST" enctype="multipart/form-data">
                            <div>
                                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">
                                    Title
                                </label>
                                <input type="text" name="title" id="title" value="{{ $link['title'] ?? '' }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    required/>
                            </div>
                            <div>
                                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="url">
                                    URL
                                </label>
                                <input type="url" name="url" id="url" value="{{ $link['url'] ?? '' }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    required/>
                            </div>
                            @if (count($categories) > 0)
                            <div>
                                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="category">
                                    Category
                                </label>
                                <div class="inline-block relative w-full">
                                    <select
                                        name="category"
                                        class="bg-gray-50 appearance-none border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                            <option value=""></option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category['id'] }}" @isset($link) {{ $link['category_id'] == $category['id'] ? 'selected' : '' }} @endisset>
                                                {{ $category['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            @endisset
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900"
                                    for="thumbnail">Thumbnail</label>
                                <input type="file" name="thumbnail"
                                    class="w-full text-black text-sm bg-gray-100 file:cursor-pointer cursor-pointer file:border-0 file:py-2 file:px-4 file:mr-4 file:bg-slate-500 file:hover:bg-slate-700 file:text-white rounded" />
                                @isset($link)
                                <div class="mt-4 flex w-40 mx-auto">
                                    <img src="{{ $link['thumbnail'] }}" alt="">
                                </div>
                                @endisset
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
