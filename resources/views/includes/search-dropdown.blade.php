<div id="search-dropdown">
    <div class="search-dropdown-close full-size"></div>
    <form action="/" class="header-search search-dropdown-form">
        <input type="text" name="search" placeholder="Знайти тур..." class="input-search">
        <div class="search-toggle">
            <ul>
                <li>
                    <div class="img">
                        <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/preview_1.jpg')}}" alt="img">
                    </div>
                    <span class="text">Сиро-Винний тур Закарпаттям</span>
                </li>

                <li>
                    <div class="img">
                        <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/preview_2.jpg')}}" alt="img">
                    </div>
                    <span class="text">10 родзинок Закарпаття</span>
                </li>

                <li>
                    <div class="img">
                        <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/preview_3.jpg')}}" alt="img">
                    </div>
                    <span class="text">Різдво у Карпатах</span>
                </li>

                <li>
                    <div class="img">
                        <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/preview_4.jpg')}}" alt="img">
                    </div>
                    <span class="text">Озера Карпат</span>
                </li>

                <li>
                    <div class="img">
                        <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('img/preview_5.jpg')}}" alt="img">
                    </div>
                    <span class="text">Несамовите озеро в Карпатах</span>
                </li>
            </ul>
            <div class="search-toggle-footer">
                <span class="text">Всі результати пошуку</span>
            </div>
        </div>
        <button>
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="18px" height="17.999px" viewBox="0 0 18 17.999"><path d="M8 2c3.308 0 6 2.692 6 6s-2.692 6-6 6-6-2.692-6-6 2.692-6 6-6m0-2C3.582 0 0 3.582 0 8s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8z"/><path d="M14 12.999l-1 1 4 4 1-1-4-4z"/></svg>
        </button>
        <div id="voice-search-btn" class="voice-search-btn">
            <svg width="12" height="18" viewBox="0 0 12 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 1c-.569 0-1.114.23-1.515.64-.402.41-.628.966-.628 1.546v5.828c0 .58.226 1.136.628 1.546.401.41.946.64 1.515.64.568 0 1.113-.23 1.515-.64.402-.41.628-.966.628-1.546V3.186c0-.58-.226-1.136-.628-1.546A2.122 2.122 0 006 1v0z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11 7.522v1.47a5.228 5.228 0 01-1.464 3.642A4.928 4.928 0 016 14.142a4.928 4.928 0 01-3.536-1.508A5.228 5.228 0 011 8.993V7.522M6 14.571v2.01M3.143 17h5.714" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>

        <div class="btn-close">
            <span></span>
        </div>
    </form>

    <div class="voice-search-dropdown">
        <div class="img mic-icon">
            <img src="{{asset('img/preloader.png')}}" data-img-src="{{asset('icon/big-mic.svg')}}" alt="big mic">
        </div>
        <div class="text-center">
            <span class="h2 title text-medium">Проговоріть фразу для пошуку</span>
        </div>
        <div class="voice-search-dots">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div>
