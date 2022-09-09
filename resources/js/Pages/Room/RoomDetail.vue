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
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{room.title}}
        </h2>
        <a class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow text-sm">
          編集
        </a>
      </div>

    </template>

  <div>
    {{room}}
  </div>
  </CommonLayout>
</template>

