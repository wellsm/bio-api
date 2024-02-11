@extends('layouts.auth')

@section('title', 'Profile')

@push('styles')
    <link href="/plugins/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="/plugins/fontawesome/css/brands.css" rel="stylesheet">
    <link href="/plugins/fontawesome/css/solid.css" rel="stylesheet">

    <link rel="stylesheet" href="/plugins/icon-picker/themes/default.min.css" />
    <style>
        .icon-picker-modal__content .icon-element i,
        .icon-picker-modal__content .icon-element svg {
            color: #333;
        }
    </style>
@endpush

@section('content')
    <div class="grid grid-cols-4 gap-4 w-full mx-4">
        <div class="col-span-4 w-full lg:col-span-2">
            <div
                class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white rounded-lg shadow border-0 border-transparent border-solid">
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Icon</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        URL</th>
                                    <th
                                        class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($medias as $item)
                                    <tr id="social-media-{{ $item['id'] }}"
                                        class="transition-opacity ease-out duration-1000">
                                        <td
                                            class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <div class="flex px-6 py-1">
                                                <i class="{{ $item['icon'] }}"></i>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <div class="flex px-2 py-1">
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 leading-normal text-sm"><a
                                                            href="{{ $item['url'] }}">{{ $item['url'] }}</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 align-middle text-right bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <a href="?media={{ $item['id'] }}"
                                                class="font-semibold uppercase leading-tight text-xs text-white bg-yellow-600 py-1 px-3 rounded">
                                                Edit </a>

                                            <button type="button" data-url="/social-medias/{{ $item['id'] }}"
                                                data-target="#social-media-{{ $item['id'] }}"
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
        <div class="col-span-4 w-full lg:col-span-1">
            <div
                class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white  rounded-lg shadow border-0 border-transparent border-solid ">
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <form class="space-y-4 md:space-y-6" action="{{ isset($media) ? "/social-medias/{$media['id']}" : '/social-medias' }}" method="POST">
                                <div>
                                    <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="url">
                                        URL
                                    </label>
                                    <input type="text" name="url" id="url"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                        value="{{ $media['url'] ?? '' }}" required />
                                </div>
                                <div>
                                    <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="icon">
                                        Icon
                                    </label>
                                    <input type="text" name="icon" id="icon"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                        value="{{ $media['icon'] ?? '' }}" required readonly />
                                    @isset($media)
                                        <div class="flex justify-center w-full mt-7 mb-2">
                                            <i class="{{ $media['icon'] }} fa-2xl"></i>
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
        <div class="col-span-4 w-full lg:col-span-1">
            <div
                class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white rounded-lg shadow border-0 border-transparent border-solid">
                <div class="flex justify-center w-full">
                    <div class="py-3 center mx-auto">
                        <form action="/profile" method="POST" enctype="multipart/form-data">
                            <div class="px-4 py-5 text-center mb-4">
                                <div class="mb-4">
                                    <img class="w-36 mx-auto rounded-full object-cover object-center"
                                        src="{{ $profile['avatar'] ?? '/img/dummy.jpg' }}" alt="Avatar Upload" />
                                </div>
                                <label class="cursor-pointer mt-6">
                                    <span
                                        class="mt-2 text-base leading-normal px-4 py-2 bg-blue-500 text-white text-sm rounded-full">Select
                                        Avatar</span>
                                    <input type='file' class="hidden" name="avatar" />
                                </label>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                    Name
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="name" name="name" type="text" value="{{ $profile['name'] ?? '' }}"
                                    required>
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

@push('scripts')
    <script src="/plugins/icon-picker/js/icon-picker.min.js"></script>
    <script>
        (() => {
            const iconPicker = new IconPicker('#icon', {
                theme: 'default',
                iconSource: [
                    'FontAwesome Brands 6',
                    'FontAwesome Solid 6',
                    'FontAwesome Regular 6',
                ],
                closeOnSelect: true
            });
        })();
    </script>
@endpush
