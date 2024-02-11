<html>

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @include('partials.tailwind')
    @stack('styles')
</head>

<body>
    <nav class="flex items-center justify-between flex-wrap bg-primary-700 p-6">
        <div class="block lg:hidden">
            <button
                class="flex items-center px-3 py-2 border rounded text-primary-200 border-primary-400 hover:text-white hover:border-white">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <title>Menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                </svg>
            </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
            <div class="text-sm lg:flex-grow">
                <a href="/profile" class="block mt-4 lg:inline-block lg:mt-0 text-primary-200 hover:text-white mr-4 uppercase">
                    Profile
                </a>
                <a href="/categories" class="block mt-4 lg:inline-block lg:mt-0 text-primary-200 hover:text-white mr-4 uppercase">
                    Categories
                </a>
                <a href="/links" class="block mt-4 lg:inline-block lg:mt-0 text-primary-200 hover:text-white uppercase">
                    Links
                </a>
            </div>
            <div>
                <form class="m-0" action="/logout" method="POST">
                    <button href="#" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-primary-500 hover:bg-white mt-4 lg:mt-0">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="w-full flex justify-between items-center mt-5">@yield('content')</div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        (() => {
            const BAD_REQUEST = 400;

            [...document.querySelectorAll('.btn-remove')]
                .map(el => el.addEventListener('click', async ({ currentTarget }) => {
                    const target = currentTarget.dataset.target;
                    const url = currentTarget.dataset.url;
                    const el = document.querySelector(target);

                    const { isConfirmed } = await Swal.fire({
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        cancelButtonText: "No",
                        confirmButtonText: "Yes"
                    });

                    if (!isConfirmed) {
                        return;
                    }

                    try {
                        const response = await axios.delete(url);
                    } catch (e) {
                        return Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: e.response.data,
                        });
                    }

                    el.style.opacity = '0';

                    setTimeout(() => el.remove(), 1000);                    
                }));

            [...document.querySelectorAll('.checkbox-toggle')]
                .map(el => el.addEventListener('change', async ({ currentTarget }) => {
                    const url = currentTarget.dataset.url;

                    try {
                        const response = await axios.put(url);
                    } catch (e) {
                        return Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: e.response.data,
                        });
                    }               
                }));            
        })();
    </script>

    @stack('scripts')
</body>

</html>
