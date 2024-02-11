<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, viewport-fit=cover" name="viewport">

    <title>{{ $profile['name'] }}</title>

    <link href="/plugins/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="/plugins/fontawesome/css/brands.css" rel="stylesheet">
    <link href="/plugins/fontawesome/css/solid.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
</head>
<body class="container">
    <div class="bio">
        <header class="header">
            <div class="avatar">
                <img src="{{ $profile['avatar'] }}" alt="" role="presentation" data-testid="ProfileImage" crossorigin="anonymous" class="sc-iBPRYJ flTywP sc-hBEYos czEoCL" filter="none">
            </div>
            <div class="title">
                <h1>{{ $profile['name'] }}</h1>
            </div>
            <div class="social-media">
                @foreach($medias as $media)
                <a href="{{ $media['url'] }}">
                    <i class="{{ $media['icon'] }} fa-xl"></i>
                </a>
                @endforeach
            </div>
        </header>
        <main>
            <div class="filters">
                <div class="search-bar">
                    <input type="text" class="search">
                </div>
                @if(count($categories) > 0)
                <div class="categories">
                    <select id="category">
                        @foreach($categories as $category)
                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div>
            <div class="links">
                @foreach($links as $link)
                <div class="link" data-category="{{ $link['category'] }}">
                    <a href="{{ $link['url'] }}">
                        <div class="image">
                            <img src="{{ $link['thumbnail'] }}" alt="">
                        </div>
                        <div class="title product">
                            {{ $link['title'] }}
                        </div>
                        <button type="button" class="share-button">
                            <svg width="16" height="16" viewBox="0 0 16 16" class=""><path fill="currentColor" stroke="currentColor" d="M12.6661 7.33348C12.2979 7.33348 11.9994 7.63195 11.9994 8.00014C11.9994 8.36833 12.2979 8.66681 12.6661 8.66681C13.0343 8.66681 13.3328 8.36833 13.3328 8.00014C13.3328 7.63195 13.0343 7.33348 12.6661 7.33348Z"></path><path fill="currentColor" stroke="currentColor" d="M8.00057 7.33348C7.63238 7.33348 7.3339 7.63195 7.3339 8.00014C7.3339 8.36833 7.63238 8.66681 8.00057 8.66681C8.36876 8.66681 8.66724 8.36833 8.66724 8.00014C8.66724 7.63195 8.36876 7.33348 8.00057 7.33348Z"></path><path fill="currentColor" stroke="currentColor" d="M3.33333 7.33348C2.96514 7.33348 2.66667 7.63195 2.66667 8.00014C2.66667 8.36833 2.96514 8.66681 3.33333 8.66681C3.70152 8.66681 4 8.36833 4 8.00014C4 7.63195 3.70152 7.33348 3.33333 7.33348Z"></path></svg>
                        </button>
                    </a>
                </div>
                @endforeach
            </div>
        </main>
    </div>

    <script>
        (() => {
            document.querySelector('.search').addEventListener('keyup', ({ currentTarget }) => {
                const { value } = currentTarget;

                [...document.querySelectorAll('.product')].map(el => {
                    const link = el.closest('.link');
                    const includes = el.textContent.toLowerCase().includes(value.toLowerCase());

                    console.log(value.toLowerCase(), el.textContent.toLowerCase());

                    link.classList.add('hidden');

                    if (!includes) {
                        return;
                    }

                    link.classList.remove('hidden');
                });
            });
        })();
    </script>
</body>
</html>