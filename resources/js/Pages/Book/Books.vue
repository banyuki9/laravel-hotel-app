<script setup>
import CommonLayout from "@/Layouts/Common.vue";
import Pagination from "@/Components/Pagination.vue";
import BookCard from "@/Components/Book/BookCard.vue";
import BookForm from "@/Components/Book/Form.vue";
import { Head, useForm, defineProps } from "@inertiajs/inertia-vue3";
import { watch, reactive, ref } from "vue";

const props = defineProps(["rooms"]);

const date = new Date();
const bookInformation = reactive({
  dateOfNights: 1,
  termDays: [],
  holidayCount: 0,
})

const form = reactive({
  start: new Date(),
  end: date.setDate(date.getDate() + 1),
  adult: 2,
  child: 0,
  hasError: false,
})


watch(form, async(newValue, oldValue) => {
  if (!form.hasError) {
    bookInformation.dateOfNights = (new Date(newValue.end) - new Date(newValue.start)) / 86400000;
    bookInformation.termDays = [];
    bookInformation.holidayCount = 0;
    const result = await getTermDays(newValue);
    
    bookInformation.termDays.forEach((value) => {
      let weekDay = value.getDay();
      if (weekDay === 0 || weekDay === 1) bookInformation.holidayCount=bookInformation.holidayCount+1;
    })
  }

})

const getTermDays = (newValue) => {
  return new Promise(resolve => {
    let startDate = new Date(newValue.start);
    let day;
    for (let i = 0; i < bookInformation.dateOfNights; i++) {
      day = startDate.setDate(startDate.getDate() + 1);
      bookInformation.termDays.push(new Date(day))

      if (i === bookInformation.dateOfNights - 1) {
        resolve(bookInformation.termDays)
      }
    } 
  })
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
    <BookForm :form="form"/>

    <div v-if="!form.hasError">
      <BookCard
        class="book"
        v-for="room in rooms.data"
        :key="room.id"
        :room="room"
        :book-information="bookInformation"
        :customer-information="form"
      >
      </BookCard>

    </div>
  </CommonLayout>

</template>