<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Vue Stripe Cashier</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body class="antialiased">
        <div class="container mx-auto">
            <div id="app">
                <header class="text-gray-700 body-font">
                    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row">
                        <a href="#">
                            Laravel Vue Cart
{{--                            <span class="ml-3 text-xl">Shopping Cart</span>--}}
                        </a>
                        <nav class="md:mr-auto md:ml-4 md:py-1 md:pl-4 md:border-l focus:outline-none hover:bg-gray-300 rounded">
                            <router-link class="mr-5 hover:text-gray-900" :to="{name: 'products.index'}">Products</router-link>
                        </nav>
                        <router-link
                            class="inline-flex items-center bg-gray-200 border-0 py-1 px-3 focus:outline-none hover:bg-gray-300 rounded"
                            :to="{ name: 'order.checkout' }"
                        >
                           Checkout<span class="inline-block ml-1" v-text="'(' + $store.state.cart.length + ' items)'"></span>
                        </router-link>
                    </div>
                </header>
                <router-view></router-view>
            </div>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
