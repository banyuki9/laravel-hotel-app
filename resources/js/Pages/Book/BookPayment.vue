<script setup>
import CommonLayout from "@/Layouts/Common.vue";
import BookFormLayout from "@/Layouts/Book/BookForm.vue";
import BookingInformation from "@/Components/Book/BookingInformation.vue"
import PaymentFormButton from "@/Components/Button.vue";
import { Inertia } from '@inertiajs/inertia';
import { onMounted, ref } from "vue";
import { Head, useForm, usePage, defineProps } from "@inertiajs/inertia-vue3";

const props = defineProps(["plan", "room"]);
const book = usePage().props.value.book

const form = useForm({
  stripeData: {},
});

const stripe = Stripe(usePage().props.value.stripeKey);
let card;
const stripeError = ref("")

onMounted(() => {
  const elements = stripe.elements();

  const style = {
    base: {
      fontSize: "16px",
      color: "#32325d",
    },
  };

  card = elements.create("card", { style: style });
  card.mount("#card-element");
});

const submit = () => {
  stripe.createToken(card).then(function (result) {
    if (result.error) {
      stripeError.value = result.error.message;
    } else {
      form.stripeData = result.token;
      form.post(route("book.store-payment"));
    }
  })
};

const backPage = () => {
  Inertia.get(route('book.create'))
}
</script>

<template>
  <Head title="お支払い"/>
  <CommonLayout title="ご予約">

    <BookFormLayout>
      <template #form>

        <form  @submit.prevent="submit" id="payment-form" class="max-w-md">
          <div class="form-row mb-10">
            <label for="card-element" class="mb-4 block"> Credit or debit card </label>
            <div id="card-element" class="mb-4">
              <!-- A Stripe Element will be inserted here. -->
            </div>
      
            <!-- Used to display Element errors. -->
            <div v-if="stripeError" v-text="stripeError" id="card-errors" class="text-rose-600 text-sm" role="alert"></div>
          </div>
      
          <div class="flex">
            <PaymentFormButton class="mr-2 basis-1/2" :type="'button'" @click="backPage">
              <span class="self-center block text-center w-full">戻る</span>
            </PaymentFormButton>
            <PaymentFormButton class="text-md basis-1/2 block text-center items-center flex">
              <span class="self-center block text-center w-full">予約を確定する</span>
            </PaymentFormButton>
          </div>
        </form>
      </template>

      <template #information>
        <BookingInformation :plan="plan" :room="room" :book="book"/>
      </template>
    </BookFormLayout>


</CommonLayout>

</template>

<style scoped>

</style>