<script setup>
import CommonLayout from "@/Layouts/Common.vue";
import EditForm from '@/Components/Room/Form.vue'
import { Head, useForm, defineProps } from "@inertiajs/inertia-vue3";
import { ref, onMounted } from "vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps(["room"]);

const thumbnail = ref("");
const form = useForm({
  title: props.room.title,
  description: props.room.description,
  room_size: props.room.room_size,
  min_capacity: props.room.min_capacity,
  max_capacity: props.room.max_capacity,
  bed_type: props.room.bed_type,
  facilities: props.room.facilities,
  thumbnail: null,
  sub_images: [],
  uploaded_thumbnail: null,
  uploaded_sub_images: props.room.images,
  delete_images: [],
});

const getThumbnail = () => {
  props.room.images.some((image, index) => {
    if (image.is_thumbnail == 1) {
      form.uploaded_sub_images.splice(index, 1);
      thumbnail.value = image;
      return;
    }
  });
}


onMounted(() => {
  getThumbnail();
  if (thumbnail.value) form.uploaded_thumbnail = thumbnail.value;
});

const buttonText = "更新する"
const update = () => {
    Inertia.post(route('rooms.update', props.room.id), {
        _method: 'patch',
        ...form
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

