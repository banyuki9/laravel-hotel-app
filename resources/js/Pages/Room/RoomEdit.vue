<script setup>
import CommonLayout from "@/Layouts/Common.vue";
import EditForm from '@/Components/Room/Form.vue'
import { Head, useForm, defineProps } from "@inertiajs/inertia-vue3";
const props = defineProps(["room"]);

const form = useForm({
  title: props.room.title,
  description: props.room.description,
  room_size: props.room.room_size,
  min_capacity: props.room.min_capacity,
  max_capacity: props.room.max_capacity,
  bed_type: props.room.bed_type,
  facilities: props.room.bed_type,
  main_image: '',
  sub_images: [],
});
const buttonText = "更新する"
const update = () => {
    form.patch(route('rooms.update', props.room.id), {
        onFinish: () => form.reset(),
    })
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

    <EditForm :form="form" @submit="update" :button-text="buttonText"/>
  </CommonLayout>
</template>

