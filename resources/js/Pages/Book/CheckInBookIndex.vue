<script setup>
import { Head, useForm, defineProps, usePage } from "@inertiajs/inertia-vue3";
import { ref } from "vue";
import CommonLayout from "@/Layouts/Common.vue";
import UserBookCard from "@/Components/Book/UserBookCard.vue";
import Pagination from "@/Components/Pagination.vue";
const props = defineProps(["books", "today"]);



</script>

<template>
  <Head title="Books" />
  <CommonLayout title="本日チェックインのご予約">
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          本日チェックインのご予約
        </h2>
      </div>
    </template>
    <div>
      {{today}}
    </div>
    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
      <UserBookCard
        class="py-3 sm:py-4"
        v-for="book in books.data"
        :key="book.id"
        :book="book"
      ></UserBookCard>
    </ul>
    <Pagination :links="books.links" class="flex justify-center my-8"/>
  </CommonLayout>
</template>