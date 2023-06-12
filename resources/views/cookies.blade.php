<aside id="cookies-policy" class="cookies cookies--no-js">
    <div class="cookies__alert">
        <div class="cookies__container">
            <div class="cookies__wrapper">
                <p class="cookies__title">@lang('cookieConsent::cookies.title')</p>
                <div class="cookies__intro">
                    <p>@lang('cookieConsent::cookies.intro')</p>
                    @if(config('cookieconsent.legal'))
                        <p>@lang('cookieConsent::cookies.link', ['url' => route(config('cookieconsent.legal'))])</p>
                    @endif
                </div>
                <div class="cookies__actions">
                    @cookieconsentbutton(action: 'accept.essentials', label: __('cookieConsent::cookies.essentials'), attributes: ['class' => 'cookiesBtn cookiesBtn--essentials'])
                    @cookieconsentbutton(action: 'accept.all', label: __('cookieConsent::cookies.all'), attributes: ['class' => 'cookiesBtn cookiesBtn--accept'])
                </div>
            </div>
        </div>
            <a href="#cookies-policy-customize" class="cookies__btn cookies__btn--customize">
                <span>@lang('cookieConsent::cookies.customize')</span>
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M14.7559 11.9782C15.0814 11.6527 15.0814 11.1251 14.7559 10.7996L10.5893 6.63297C10.433 6.47669 10.221 6.3889 10 6.38889C9.77899 6.38889 9.56703 6.47669 9.41075 6.63297L5.24408 10.7996C4.91864 11.1251 4.91864 11.6527 5.24408 11.9782C5.56951 12.3036 6.09715 12.3036 6.42259 11.9782L10 8.40074L13.5774 11.9782C13.9028 12.3036 14.4305 12.3036 14.7559 11.9782Z" fill="#2C2E30"/>
                </svg>
            </a>
        <div class="cookies__expandable cookies__expandable--custom" id="cookies-policy-customize">
            <form action="{{ route('cookieconsent.accept.configuration')}}" method="post" class="cookies__customize">
                @csrf
                <div class="cookies__sections">
                @foreach($cookies->getCategories() as $category)
                    <div class="cookies__section">
                        <label for="cookies-policy-check-{{ $category->key() }}" class="cookies__category">
                            <input type="checkbox" name="categories[]" value="{{ $category->key() }}" id="cookies-policy-check-{{ $category->key() }}" />
                            <span class="cookies__box">
                                <strong class="cookies__label">{{ $category->key() }}</strong>
                            </span>
                            <p class="cookies__info">Lorem, ipsum, dolor sit amet consectetur adipisicing elit.</p>
                        </label>

                        <div class="cookies__expandable" id="cookies-policy-{{ $category->key() }}">
                            <ul class="cookies__definitions">
                                @foreach($category->getCookies() as $cookie)
                                <li class="cookies__cookie">
                                    <p class="cookies__name">{{ $cookie->name }}</p>
                                    <p class="cookies__duration">{{ \Carbon\CarbonInterval::minutes($cookie->duration)->cascade() }}</p>
                                    <p class="cookies__description">Lorem, ipsum, dolor sit amet consectetur adipisicing elit. Id placeat corporis repellat excepturi maiores quisquam.</p>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="#cookies-policy-{{ $category->key() }}" class="cookies__details" data-text="{{ json_encode(__('cookieConsent::cookies.details')) }}">@lang('cookieConsent::cookies.details.more')</a>

                    </div>
                    @endforeach
                </div>
                <div class="cookies__save">
                    <button type="submit" class="cookiesBtn__link">@lang('cookieConsent::cookies.save')</button>
                </div>
            </form>
        </div>
    </div>
</aside>

{{-- STYLES : feel free to remove them and add your own --}}
@php
    $style = file_get_contents(asset(mix('app.css', 'vendor/laravel-cookie-consent')))
@endphp

<style>
    {!! $style !!}
</style>