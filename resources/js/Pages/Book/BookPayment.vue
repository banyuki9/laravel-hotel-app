<script setup>
import { useForm, usePage, defineProps } from "@inertiajs/inertia-vue3";
const customerData = usePage().props.value.customerData
</script>

<template>
  payment
  {{customerData}}
</template>