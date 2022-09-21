<script setup>
import CommonLayout from "@/Layouts/Common.vue";
import Pagination from "@/Components/Pagination.vue";
import BookCard from "@/Components/Book/BookCard.vue";
import BookForm from "@/Components/Book/Form.vue";
import { Head, useForm, defineProps } from "@inertiajs/inertia-vue3";
const props = defineProps(["rooms"]);

const date = new Date();
const form = useForm({
  startDate: new Date(),
  endDate: date.setDate(date.getDate() + 1),
  adult: 1,
  child: 0,
});
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
    <BookForm :form="form"/>
    
    <BookCard class="book" v-for="room in rooms.data" :key="room.id" :room="room" >
      
    </BookCard>
    <Pagination :links="rooms.links" class="flex justify-center my-12"/>

  </CommonLayout>

</template>