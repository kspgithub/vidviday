<div class="tab-nav">
    <ul class="tab-toggle">
        <li class="tab-caption {{routeActiveClass('profile.index')}}">
            <a href="{{route('profile.index')}}">
                <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M23 12c0-6.065-4.935-11-11-11S1 5.935 1 12c0 3.204 1.378 6.091 3.57 8.103l-.01.01.357.3c.023.02.048.036.071.055.19.157.386.306.586.45a11.202 11.202 0 00.852.558l.148.086c.245.14.496.271.752.392l.057.026a10.901 10.901 0 003.613.972l.108.008c.295.024.594.04.896.04.3 0 .595-.016.889-.04.037-.002.074-.004.111-.008.294-.026.585-.065.872-.114l.074-.014a10.9 10.9 0 002.623-.822l.092-.042a11.056 11.056 0 001.532-.875c.074-.05.147-.104.22-.157.175-.126.348-.256.515-.393.038-.03.078-.056.114-.087l.366-.305-.01-.01A10.972 10.972 0 0023 12zM1.8 12C1.8 6.376 6.376 1.8 12 1.8S22.2 6.376 22.2 12c0 3.03-1.33 5.756-3.436 7.625a2.998 2.998 0 00-.357-.215l-3.387-1.693a.887.887 0 01-.492-.797v-1.183c.078-.097.16-.206.246-.327.439-.619.79-1.308 1.047-2.049.507-.24.834-.745.834-1.315v-1.418c0-.347-.127-.684-.355-.948V7.813c.02-.207.094-1.379-.753-2.345C14.81 4.626 13.617 4.2 12 4.2c-1.616 0-2.81.426-3.547 1.267-.847.967-.774 2.138-.753 2.346V9.68c-.227.264-.355.6-.355.947v1.418c0 .44.198.851.536 1.129.324 1.269.991 2.23 1.237 2.555v1.158a.892.892 0 01-.464.783L5.49 19.395c-.101.055-.201.119-.301.19A10.176 10.176 0 011.8 12zm16.184 8.253c-.14.101-.283.2-.427.294l-.2.128c-.189.117-.381.228-.577.332l-.13.067c-.45.23-.917.43-1.396.59l-.05.018c-.251.083-.505.157-.762.22h-.002c-.26.065-.522.118-.786.162-.007 0-.014.002-.022.004-.248.04-.498.07-.75.091l-.133.01c-.249.019-.498.031-.749.031-.254 0-.506-.012-.758-.031l-.13-.01a10.345 10.345 0 01-.756-.093l-.034-.006a10.162 10.162 0 01-1.556-.389l-.047-.016c-.252-.085-.5-.18-.745-.285l-.005-.002c-.231-.1-.458-.21-.682-.327l-.088-.045a10.28 10.28 0 01-.775-.462c-.182-.119-.361-.242-.536-.373l-.053-.042.039-.021 3.162-1.726c.544-.296.882-.866.882-1.485v-1.441l-.092-.111c-.009-.01-.874-1.062-1.2-2.487l-.037-.158-.136-.088a.663.663 0 01-.308-.557v-1.418c0-.186.079-.36.223-.49l.132-.119V7.79l-.004-.052c0-.01-.119-.972.559-1.744C9.633 5.334 10.625 5 12 5c1.37 0 2.358.332 2.938.986.677.765.566 1.745.566 1.753l-.004 2.28.132.12c.144.129.223.303.223.489v1.418a.668.668 0 01-.473.63l-.198.06-.064.199a7.4 7.4 0 01-.999 2.013c-.105.148-.207.279-.294.38l-.1.112v1.48c0 .645.359 1.225.936 1.513l3.387 1.693.064.033c-.043.033-.087.063-.13.094z"
                        stroke-width=".5"/>
                </svg>
                Особисті дані</a>
        </li>

        <li class="tab-caption {{routeActiveClass('profile.orders')}}">
            <a href="{{route('profile.orders')}}">
                <svg width="16" height="20" viewBox="0 0 16 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M14.303 0H1.697C.761 0 0 .785 0 1.75v16.5C0 19.215.761 20 1.697 20h12.606c.936 0 1.697-.785 1.697-1.75V1.75C16 .785 15.239 0 14.303 0zm.242 18.25a.25.25 0 01-.242.25H1.697a.25.25 0 01-.242-.25V1.75a.25.25 0 01.242-.25h12.606a.25.25 0 01.242.25v16.5z"/>
                    <path
                        d="M10.182 8.5H5.576a.739.739 0 00-.728.75c0 .414.326.75.728.75h4.606a.739.739 0 00.727-.75.739.739 0 00-.727-.75zM11.879 11.5H4.12a.739.739 0 00-.727.75c0 .414.326.75.727.75h7.758a.739.739 0 00.727-.75.739.739 0 00-.727-.75zM11.879 14.5H4.12a.739.739 0 00-.727.75c0 .414.326.75.727.75h7.758a.739.739 0 00.727-.75.739.739 0 00-.727-.75zM10.182.75v2.5H5.818V.75H4.364V4c0 .414.325.75.727.75h5.818a.739.739 0 00.727-.75V.75h-1.454z"/>
                </svg>
                Історія замовлень</a>
        </li>

        <li class="tab-caption {{routeActiveClass('profile.history')}}">
            <a href="{{route('profile.history')}}">
                <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M19.873 6.573C19.694 6.304 15.437 0 10 0 4.563 0 .305 6.304.127 6.573c-.17.254-.17.6 0 .854C.305 7.696 4.563 14 10 14c5.437 0 9.694-6.304 9.873-6.573.17-.254.17-.6 0-.854zM10 12.552c-4.005 0-7.474-4.185-8.5-5.552C2.524 5.63 5.985 1.448 10 1.448c4.005 0 7.473 4.184 8.5 5.552-1.025 1.37-4.486 5.552-8.5 5.552z"
                        fill="#626262"/>
                    <path
                        d="M10 2.655c-2.181 0-3.956 1.95-3.956 4.345 0 2.396 1.775 4.345 3.956 4.345S13.956 9.395 13.956 7c0-2.396-1.775-4.345-3.956-4.345zm0 7.242c-1.454 0-2.637-1.3-2.637-2.897 0-1.597 1.183-2.897 2.637-2.897s2.637 1.3 2.637 2.897c0 1.597-1.183 2.897-2.637 2.897z"
                        fill="#626262"/>
                </svg>
                Історія переглядів</a>
        </li>

        <li class="tab-caption {{routeActiveClass('profile.favourites')}}">
            <a href="{{route('profile.favourites')}}">
                <svg width="26" height="25" viewBox="0 0 26 25" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M18.625.75C16.45.75 14.363 1.762 13 3.362 11.637 1.762 9.55.75 7.375.75 3.525.75.5 3.775.5 7.625.5 12.35 4.75 16.2 11.188 22.05L13 23.687l1.813-1.65C21.25 16.2 25.5 12.35 25.5 7.626c0-3.85-3.025-6.875-6.875-6.875zm-5.5 19.438l-.125.125-.125-.125C6.925 14.8 3 11.238 3 7.624c0-2.5 1.875-4.375 4.375-4.375 1.925 0 3.8 1.237 4.463 2.95h2.337c.65-1.713 2.525-2.95 4.45-2.95 2.5 0 4.375 1.875 4.375 4.375 0 3.613-3.925 7.175-9.875 12.563z"
                        fill="#626262" stroke="#fff" stroke-linecap="round"/>
                </svg>
                Улюблені</a>
        </li>
    </ul>
    <div class="only-desktop-pad">
        <div class="spacer-xs"></div>
        <hr>
    </div>
    <a href="{{route('profile.delete.ask')}}" class="text delete-account  {{routeActiveClass('profile.delete.ask')}}">
        Видалити аккаунт
    </a>
</div>
