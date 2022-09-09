<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import CommonLayout from "@/Layouts/Common.vue";
import { Head } from "@inertiajs/inertia-vue3";
const props = defineProps(["room"]);
</script>

<template>
  <Head title="Rooms" />

  <CommonLayout :title="room.title">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{room.title}}
      </h2>
    </template>

  <div>
    {{room}}
  </div>
  </CommonLayout>
</template>

