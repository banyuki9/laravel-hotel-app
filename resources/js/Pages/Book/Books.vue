<script setup>
import CommonLayout from "@/Layouts/Common.vue";
import Pagination from "@/Components/Pagination.vue";
import BookCard from "@/Components/Book/BookCard.vue";
import BookSearchResult from "@/Components/Book/SearchResult.vue"
import BookForm from "@/Components/Book/SearchForm.vue";
import { Head, useForm, defineProps } from "@inertiajs/inertia-vue3";
import { onMounted } from "vue";

const props = defineProps(["rooms", "guests", "start", "end", "termDays", "holidaysCount"]);
const date = new Date();

const form = useForm({
  start: props.start,
  end: props.end,
  adult: props.guests.adult,
  child: props.guests.child,
  hasError: false,
  dateOfNights: props.termDays.length - 1,
  termDays: props.termDays.length,
  holidayCount: props.holidaysCount,
  roomTotalAmount: 0,
  planId: "",
})


const submit = (roomTotalAmount, planId) => {
  form.roomTotalAmount = roomTotalAmount
  form.planId = planId;
  form.post(route('book.store-book-data'))
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
    <BookForm :form="form"/>

    <BookSearchResult v-if="!form.hasError" :form="form"/>

    <div v-if="!form.hasError">
      <BookCard
        class="book"
        v-for="room in rooms.data"
        :key="room.id"
        :room="room"
        :form="form"
        :guests="guests"
        @register-book-data="submit"
      >
      </BookCard>

    </div>
  </CommonLayout>

</template>