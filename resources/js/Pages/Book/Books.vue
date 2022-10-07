<script setup>
import CommonLayout from "@/Layouts/Common.vue";
import Pagination from "@/Components/Pagination.vue";
import BookCard from "@/Components/Book/BookCard.vue";
import BookSearchResult from "@/Components/Book/SearchResult.vue"
import SearchForm from "@/Components/Book/SearchForm.vue";
import { Head, useForm, defineProps } from "@inertiajs/inertia-vue3";
import { onMounted } from "vue";

const props = defineProps(["rooms", "guests", "start", "end", "termDays", "holidaysCount"]);
const date = new Date();

const form = useForm({
  startDate: new Date(props.start).toLocaleString({ timeZone: 'Asia/Tokyo' }),
  endDate: new Date(props.end).toLocaleString({ timeZone: 'Asia/Tokyo' }),
  adult: props.guests.adult,
  child: props.guests.child,
})

const storeBookDataForm = useForm({
  startDate: new Date(props.start).toLocaleString({ timeZone: 'Asia/Tokyo' }),
  endDate: new Date(props.end).toLocaleString({ timeZone: 'Asia/Tokyo' }),
  adult: props.guests.adult,
  child: props.guests.child, 
  dateOfNights: props.termDays.length - 1,
  roomTotalAmount: 0,
  planId: "",
})

const submit = (roomTotalAmount, planId) => {
  storeBookDataForm.roomTotalAmount = roomTotalAmount
  storeBookDataForm.planId = planId;
  storeBookDataForm.post(route('book.store-book-data'))
};

const isEmptyFormErrors = (obj) => {
  for(let i in obj){
    return false;
  }
  return true;
}


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
    <SearchForm :form="form"/>

    <BookSearchResult v-if="isEmptyFormErrors(form.errors)" :form="form"/>

    <div v-if="isEmptyFormErrors(form.errors)">
      <BookCard
        class="book"
        v-for="room in rooms.data"
        :key="room.id"
        :room="room"
        :form="form"
        :date-of-nights="termDays.length - 1"
        :holiday-count="holidaysCount"
        :guests="guests"
        @register-book-data="submit"
      >
      </BookCard>

    </div>
  </CommonLayout>

</template>