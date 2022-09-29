<script setup>
import { onMounted } from "vue";
import { Head, useForm, usePage, defineProps } from "@inertiajs/inertia-vue3";
const customerData = usePage().props.value.customerData

const form = useForm();

const submit = () => {
  form.post(route('book.store-payment'))
}



</script>

<template>
  <Head>
    <title>Payment</title>
  </Head>


  <form @submit.prevent="submit">

    <button>
      pay
    </button>
  </form>
</template>