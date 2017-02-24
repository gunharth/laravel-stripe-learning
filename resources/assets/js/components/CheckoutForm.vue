<template>
    <form action="/purchases" method="POST">

        <input type="hidden" name="stripeToken" v-model="stripeToken">
        <input type="hidden" name="stripeEmail" v-model="stripeEmail">

        <select class="form-control" name="product" v-model="product">
            <option v-for="product in products" :value="product.id">
                {{ product.name }} &mdash; {{ product.price / 100 }} 
            </option>
        </select>

          <button type="submit" class="btn btn-default" @click.prevent="buy">Buy</button>
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
                let product = this.findProductById(this.product)
                this.stripe.open({
                    name: product.name,
                    description: product.description,
                    amount: product.price
                });
            },

            findProductById(id) {
                return this.products.find(product => product.id == id);
            }

        }
    }
</script>
