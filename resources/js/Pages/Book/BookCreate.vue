<script setup>
import CommonLayout from "@/Layouts/Common.vue";
import BookFormLayout from "@/Layouts/Book/BookForm.vue";
import CustomerInformationForm from "@/Components/Book/CustomerInformationForm.vue"
import BookingInformation from "@/Components/Book/BookingInformation.vue"
import { useForm, usePage, defineProps } from "@inertiajs/inertia-vue3";
const props = defineProps(["plan", "room"]);

const book = usePage().props.value.book
const user = usePage().props.value.auth.user

const form = useForm({
  email: user.email,
  name_kanji: user.name_kanji ? user.name_kanji : "",
  name_kana: user.name_kana ? user.name_kana : "",
  number: user.number ? user.number : "",
  note: ""
})


const submit = () => {
  form.post(route('book.store-customer-data'))
};

</script>

<template>
  <Head title="Books" />
  <CommonLayout title="ご予約">
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          ご予約
        </h2>
      </div>
    </template>

    <h2 class="text-center mb-12 text-2xl font-bold text-gray-800">
      お客様情報入力
    </h2>

    <BookFormLayout>
      <template #form>
        <CustomerInformationForm :form="form" @submit="submit"/>
      </template>

      <template #information>
        <BookingInformation :plan="plan" :room="room" :book="book"/>
      </template>
    </BookFormLayout>

  </CommonLayout>
</template>