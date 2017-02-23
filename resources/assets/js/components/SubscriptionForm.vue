<template>
    <form action="/subscribe" method="POST">

        <input type="hidden" name="stripeToken" v-model="stripeToken">
        <input type="hidden" name="stripeEmail" v-model="stripeEmail">

        <select name="plan" v-model="plan">
            <option v-for="plan in plans" :value="plan.id">
                {{ plan.name }} &mdash; {{ plan.price / 100 }} 
            </option>
        </select>

          <button type="submit" @click.prevent="subscribe">Subscribe</button>
    </form>
</template>

<script>
    export default {
        props: ['plans'],
        data() {
            return {
                stripeEmail: '',
                stripeToken: '',
                plan: 1
            };
        },
        created() {
            this.stripe = StripeCheckout.configure({
                key: window.Laravel.stripeKey,
                image: "https://stripe.com/img/documentation/checkout/marketplace.png",
                locale: "en",
                currency: "gbp",
                panelLabel: "Subscribe for",
                token: (token) => {
                    this.stripeToken = token.id;
                    this.stripeEmail = token.email;
                    
                    axios.post('/subscribe', this.$data)
                        .then(response => alert('Complete'));
                }

            });
        },
        methods: {
            subscribe() {
                let plan = this.findPlanById(this.plan)
                this.stripe.open({
                    name: plan.name,
                    description: plan.name,
                    amount: plan.price
                });
            },

            findPlanById(id) {
                return this.plans.find(plan => plan.id == id);
            }

        }
    }
</script>
