<script setup>
import Pagination from "@/Components/Pagination.vue";
import RoomCard from "@/Components/Room/RoomCard.vue";
import CommonLayout from "@/Layouts/Common.vue";
import { Head } from "@inertiajs/inertia-vue3";
const props = defineProps(["rooms"]);
</script>

<template>
  <Head title="Rooms" />

  <CommonLayout :title="客室一覧">
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          客室一覧
        </h2>
        <a :href="route('rooms.create')" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow text-sm">
          追加
        </a>
      </div>
    </template>

    <div class="flex flex-row flex-wrap">
      <RoomCard  v-for="room in rooms.data" :key="room.id" :room="room"/>

    </div>
    <Pagination :links="rooms.links" class="flex justify-center my-8"/>
  </CommonLayout>
</template>

