<header class="header">
    <div class="content header__container">
        <a class="header__logo" href="{{route('home')}}">
            <div class="header__logo__img-container">
                @if(setting('site.logo'))
                    <img src="/storage/{{setting('site.logo')}}" alt="{{ setting('site.title') }}" class="header__logo__img" />
                @else
                    <img src="/public/img/logo.png" alt="{{ setting('site.title') }}" class="header__logo__img" />
                @endif
            </div>
            <span class="header__logo__title">
                <span class="header__logo__title-one">{{ setting('site.logo_text_1') }}</span>
                <span class="header__logo__title-two">{{ setting('site.logo_text_2') }}</span>
            </span>
        </a>
        <main-menu
            id="main-menu"
            current-route="{{ (\Request::route() && \Request::route()->getName()) ? \Request::route()->getName() : null }}"
            instagram-link="{{ setting('site.instagram_link') }}"
            watsapp-link="{{ 'https://api.whatsapp.com/send?phone=' . setting('site.whatsapp') }}"
            appdv-link="{{ setting('site.appdv_link') }}"
        ></main-menu>
    </div>
</header>