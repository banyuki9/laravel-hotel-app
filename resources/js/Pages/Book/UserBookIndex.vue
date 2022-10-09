<script setup>
import { Head, useForm, defineProps, usePage } from "@inertiajs/inertia-vue3";
import CommonLayout from "@/Layouts/Common.vue";
import UserBookCard from "@/Components/Book/UserBookCard.vue"
import BookCodeInput from '@/Components/Input.vue';
import BookCodeFormButton from '@/Components/Button.vue';
const props = defineProps(["books"]);
const user = usePage().props.value.auth.user;
const form = useForm({
  bookCode: '',
})

const searchBook = () => {
  if (form.bookCode) {
    form.get(route('book.user-book-show', [user.id, form.bookCode.trim()]))
  }
}
</script>

<template>
  <Head title="Books" />
  <CommonLayout title="ご予約一覧">
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          ご予約一覧
        </h2>
      </div>
    </template>

    <div class="form mb-8">
      <form class="flex " @click.prevent="searchBook">
        <BookCodeInput type="text" class="mr-2 max-w-xs w-full" placeholder="ご予約番号を入力してください" v-model="form.bookCode"/>
        <BookCodeFormButton>
          検索
        </BookCodeFormButton>
      </form>
    </div>

    <div class="flex">
      <div class="p-4 w-full basic-1/2 bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700 mr-4">
          <div class="flex justify-between items-center mb-4">
              <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">未宿泊ご予約一覧</h5>
          </div>
          <div class="flow-root">
              <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                  <UserBookCard class="py-3 sm:py-4" v-for="book in books.not_stayed_book" :key="book.id" :book="book">
                  </UserBookCard>
              </ul>
          </div>
      </div>
  
      <div class="p-4 w-full  basic-1/2 bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
          <div class="flex justify-between items-center mb-4">
              <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">宿泊済みご予約一覧</h5>
          </div>
          <div class="flow-root">
              <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                <UserBookCard class="py-3 sm:py-4" v-for="book in books.stayed_book" :key="book.id" :book="book"></UserBookCard>
              </ul>
          </div>
      </div>

    </div>


  </CommonLayout>
</template>