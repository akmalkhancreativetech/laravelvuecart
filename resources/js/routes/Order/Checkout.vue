<template>
    <div class="w-full">
        <div class="lg:w-2/3 w-full mx-auto mt-8 overflow-auto">
            <table class="table-auto w-full text-left whitespace-no-wrap">
                <thead>
                <tr>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 rounded-tl rounded-bl">Item</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Quantity</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">SinglePrice</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Total Price</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in cart" :key="item.id">
                    <td class="p-4" v-text="item.name"></td>
                    <td class="p-4" v-text="item.quantity"></td>
                    <td class="p-4" v-text="productPrice(item.price)"></td>
                    <td class="p-4" v-text="cartLineTotal(item)"></td>
                    <td class="w-10 text-right">
                        <button
                            class="flex ml-auto text-sm text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none"
                            @click="$store.commit('removeFromCart', index)"
                        >Remove</button>
                    </td>
                </tr>
                <tr>
                    <td class="p-4 font-bold">Total Amount</td>
                    <td class="p-4 font-bold" v-text="cartQuantity"></td>
                    <td class="w-10 text-right"></td>
                    <td class="p-4 font-bold" v-text="cartTotal"></td>
                    <td class="w-10 text-right"></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="lg:w-2/3 w-full mx-auto mt-8">
            <div class="flex flex-wrap -mx-2 mt-8">
                <div class="p-2 w-1/3">
                    <div class="relative">
                        <label for="first_name" class="leading-7 text-sm text-gray-600">First Name</label>
                        <input
                            type="text"
                            id="first_name"
                            name="first_name"
                            class="w-full bg-gray-100 rounded border-gray-300 py-2"
                            v-model="customer.first_name"
                            :disabled="paymentProccessing"
                        />
                    </div>
                </div>
                <div class="p-2 w-1/3">
                    <div class="relative">
                        <label for="last_name" class="leading-7 text-sm text-gray-600">Last Name</label>
                        <input
                            type="text"
                            id="last_name"
                            name="last_name"
                            class="w-full bg-gray-100 rounded border-gray-300 py-2"
                            v-model="customer.last_name"
                            :disabled="paymentProccessing"
                        />
                    </div>
                </div>
                <div class="p-2 w-1/3">
                    <div class="relative">
                        <label for="email" class="leading-7 text-sm text-gray-600">Email Address</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="w-full bg-gray-100 rounded border-gray-300 py-2"
                            v-model="customer.email"
                            :disabled="paymentProccessing"
                        />
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-2 mt-8">
                <div class="p-2 w-1/3">
                    <div class="relative">
                        <label for="address" class="leading-7 text-sm text-gray-600">Street Address</label>
                        <input
                            type="text"
                            id="address"
                            name="address"
                            class="w-full bg-gray-100 rounded border-gray-300 py-2"
                            v-model="customer.address"
                            :disabled="paymentProccessing"
                        />
                    </div>
                </div>
                <div class="p-2 w-1/3">
                    <div class="relative">
                        <label for="city" class="leading-7 text-sm text-gray-600">City</label>
                        <input
                            type="text"
                            id="city"
                            name="city"
                            class="w-full bg-gray-100 rounded border-gray-300 py-2"
                            v-model="customer.city"
                            :disabled="paymentProccessing"
                        />
                    </div>
                </div>
                <div class="p-2 w-1/6">
                    <div class="relative">
                        <label for="state" class="leading-7 text-sm text-gray-600">State</label>
                        <input
                            type="text"
                            id="state"
                            name="state"
                            class="w-full bg-gray-100 rounded border-gray-300 py-2"
                            v-model="customer.state"
                            :disabled="paymentProccessing"
                        />
                    </div>
                </div>
                <div class="p-2 w-1/6">
                    <div class="relative">
                        <label for="zip_code" class="leading-7 text-sm text-gray-600">Zip Code</label>
                        <input
                            type="text"
                            id="zip_code"
                            name="zip_code"
                            class="w-full bg-gray-100 rounded border-gray-300 py-2"
                            v-model="customer.zip_code"
                            :disabled="paymentProccessing"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                customer : {
                    first_name: '',
                    last_name: '',
                    email: '',
                    address: '',
                    city: '',
                    state: '',
                    zip_code: ''
                },
                paymentProccessing: false
            }
        },
        computed: {
            cart() {
                return this.$store.state.cart;
            },
            cartQuantity() {
                return this.cart.reduce((acc, item) => acc + item.quantity, 0);
            },
            cartTotal(){
                let price = this.cart.reduce((acc, item) => acc + (item.price * item.quantity), 0);
                price = (price/100);
                return price.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
            }
        },
        methods: {
            cartLineTotal(item){
                let price = (item.price * item.quantity);
                price = (price/100);
                return price.toLocaleString('en-US', {style: 'currency', currency: 'USD'});
            },
            productPrice(price){
                price = (price/100);
                return price.toLocaleString('en-US', {style: 'currency', currency: 'USD'});
            }
        }
    }
</script>
