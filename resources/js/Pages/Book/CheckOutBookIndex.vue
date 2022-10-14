<script setup>
import { Head, useForm, defineProps, usePage } from "@inertiajs/inertia-vue3";
import { ref } from "vue";
import CommonLayout from "@/Layouts/Common.vue";
import UserBookCard from "@/Components/Book/UserBookCard.vue";
import Pagination from "@/Components/Pagination.vue";
const props = defineProps(["books", "today", "bookCode", "checkoutStatus"]);

import BookCodeInput from '@/Components/Input.vue';
import CheckinStatusRadio from '@/Components/InputRadio.vue';
import BookCodeFormButton from '@/Components/Button.vue';

const searchForm = useForm({
  bookCode: props.bookCode,
  checkoutStatus: props.checkoutStatus,
})

const searchBook = () => {
  searchForm.get(route('book.checkout-index'))
}
</script>

<template>
  <Head title="Books" />
  <CommonLayout title="本日チェックアウトのご予約">
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          本日チェックアウトのご予約
        </h2>
      </div>
    </template>
    <div class="form mb-8">
      <form class=" " @submit.prevent="searchBook">
        <div class="flex">
          <div class="flex items-center mb-4 mr-4">
            <CheckinStatusRadio @change="searchForm.checkoutStatus = 0" name="checkoutStatus" id="not_checkin" :checked="!searchForm.checkoutStatus" />
            <label for="not_checkin" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">未チェックアウトの予約</label>
          </div>
          <div class="flex items-center mb-4">
            <CheckinStatusRadio  @change="searchForm.checkoutStatus = 1" name="checkoutStatus" id="checkin" :checked="searchForm.checkoutStatus" />
            <label for="checkin" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">チェックアウト済みの予約</label>
          </div>
        </div>

        <BookCodeInput type="text" class="mr-2 max-w-xs w-full" placeholder="ご予約番号を入力してください" v-model="searchForm.bookCode" />
        <BookCodeFormButton>
          検索
        </BookCodeFormButton>
      </form>
    </div>

    <div>
      日付: {{today}}
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