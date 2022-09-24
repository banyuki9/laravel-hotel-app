<script setup>
import CommonLayout from "@/Layouts/Common.vue";
import Pagination from "@/Components/Pagination.vue";
import BookCard from "@/Components/Book/BookCard.vue";
import BookForm from "@/Components/Book/Form.vue";
import { Head, useForm, defineProps } from "@inertiajs/inertia-vue3";
import { watch, reactive, ref, onMounted } from "vue";

const props = defineProps(["rooms", "members"]);
const date = new Date();

const form = useForm({
  start: new Date(),
  end: date.setDate(date.getDate() + 1),
  adult: 2,
  child: 0,
  hasError: false,
  dateOfNights: 1,
  termDays: [],
  holidayCount: 0,
})

onMounted( async () => {
  setMember();
  setNumberOfNights();
})

const setMember = () => {
  if (route().params.adult) form.adult = Number(route().params.adult);
  if (route().params.child) form.child = Number(route().params.child);
}

const setNumberOfNights = async() => {
  let startDate = form.start;
  let endDate = form.end;

  if (route().params.startDate) startDate = new Date(Number(route().params.startDate));
  if (route().params.endDate) endDate = new Date(Number(route().params.endDate));

    if (!form.hasError) {
      form.dateOfNights = (new Date(endDate) - new Date(startDate)) / 86400000;
      form.termDays = [];
      form.holidayCount = 0;
      const result = await getTermDays(startDate);
      
      form.termDays.forEach((value) => {
        let weekDay = value.getDay();
        if (weekDay === 0 || weekDay === 1) form.holidayCount=form.holidayCount+1;
      })
    }
}

const getTermDays = (start) => {
  return new Promise(resolve => {
    let startDate = new Date(start);
    let day;
    for (let i = 0; i < form.dateOfNights; i++) {
      day = startDate.setDate(startDate.getDate() + 1);
      form.termDays.push(new Date(day))

      if (i === form.dateOfNights - 1) {
        resolve(form.termDays)
      }
    } 
  })
}

const submit = () => {
    form.post(route('rooms.store'))
};

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
        :form="form"
        :members="members"
      >
      </BookCard>

    </div>
  </CommonLayout>

</template>