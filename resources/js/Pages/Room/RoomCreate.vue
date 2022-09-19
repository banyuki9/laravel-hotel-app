<script setup>
import CommonLayout from "@/Layouts/Common.vue";
import RegisterForm from '@/Components/Room/Form.vue'
import { Head, useForm, defineProps } from "@inertiajs/inertia-vue3";
const props = defineProps(["room"]);

const form = useForm({
  title: '',
  description: '',
  room_size: '',
  min_capacity: '',
  max_capacity: '',
  bed_type: '',
  facilities: '',
  main_image: '',
  sub_images: [],
});
const buttonText = "登録する"

const submit = () => {
    form.post(route('rooms.store'))
};
</script>

<template>
  <Head title="Rooms" />

  <CommonLayout :title="room.title">
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          客室登録
        </h2>
    </template>
    <RegisterForm :form="form" @submit="submit" :button-text="buttonText"/>
  </CommonLayout>
</template>

