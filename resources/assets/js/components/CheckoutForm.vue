<template>
    <form action="/purchases" method="POST">

        <input type="hidden" name="stripeToken" v-model="stripeToken">
        <input type="hidden" name="stripeEmail" v-model="stripeEmail">

        <select name="product" v-model="product">
            <option v-for="product in products" :value="product.id">
                {{ product.name }} &mdash; {{ product.price / 100 }} 
            </option>
        </select>

          <button type="submit" @click.prevent="buy">Buy my book</button>
    </form>
</template>

<script>
    export default {
        props: ['products'],
        data() {
            return {
                stripeEmail: '',
                stripeToken: '',
                product: 1
            };
        },
        created() {
            this.stripe = StripeCheckout.configure({
                key: window.Laravel.stripeKey,
                image: "https://stripe.com/img/documentation/checkout/marketplace.png",
                locale: "en",
                currency: "gbp",
                token: (token) => {
                    this.stripeToken = token.id;
                    this.stripeEmail = token.email;
                    
                    axios.post('/purchases', this.$data)
                        .then(response => alert('Complete'));
                }

            });
        },
        methods: {
            buy() {
                this.stripe.open({
                    name: 'My Book',
                    description: 'Some details about the book',
                    amout: 2500
                });
            }
        }
    }
</script>
