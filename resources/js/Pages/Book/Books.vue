<script setup>
import CommonLayout from "@/Layouts/Common.vue";
import Pagination from "@/Components/Pagination.vue";
import BookCard from "@/Components/Book/BookCard.vue";
import { Head } from "@inertiajs/inertia-vue3";
const props = defineProps(["rooms", "plans"]);

const getRoomPlans = (room_id) => {
  const plans = [];
  props.plans.forEach((plan) => {
    if (plan.room_id === room_id) {
      plans.push(plan);
    }
  })
  return plans;
}

</script>

<template>
  <Head title="Books" />

    <CommonLayout :title="ご予約">
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          ご予約
        </h2>
      </div>
    </template>

    <BookCard class="book" v-for="room in rooms.data" :key="room.id" :room="room" :plans="getRoomPlans(room.id)">
      
    </BookCard>
    <Pagination :links="rooms.links" class="flex justify-center my-12"/>

  </CommonLayout>

</template>