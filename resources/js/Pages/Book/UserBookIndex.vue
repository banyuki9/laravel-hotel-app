<script setup>
import { Head, defineProps } from "@inertiajs/inertia-vue3";
import CommonLayout from "@/Layouts/Common.vue";
const props = defineProps(["books"]);
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

    <div class="flex">
      <div class="p-4 w-full basic-1/2 bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700 mr-4">
          <div class="flex justify-between items-center mb-4">
              <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">未宿泊ご予約一覧</h5>
          </div>
          <div class="flow-root">
              <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                  <li class="py-3 sm:py-4" v-for="book in books.not_stayed_book" :key="book.id">
                      <div class="flex items-center space-x-4">
                          <div class="flex-1 min-w-0">
                              <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                  <a :href="route('book.user-book-show', [$page.props.auth.user.id, book.id])">ご予約番号: {{book.book_code}}</a> 
                              </p>
                              <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                {{book.checkin_at}}〜{{book.checkout_at}}
                              </p>
                          </div>
                          <div class=" items-center text-base font-semibold text-gray-900 dark:text-white">
                              ¥ {{book.total_amount.toLocaleString()}}
                              <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                大人{{book.adult_number}}人, 子供{{book.child_number}}人
                              </p>
                          </div>
                      </div>
                  </li>
              </ul>
          </div>
      </div>
  
      <div class="p-4 w-full  basic-1/2 bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
          <div class="flex justify-between items-center mb-4">
              <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">宿泊済みご予約一覧</h5>
          </div>
          <div class="flow-root">
              <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                  <li class="py-3 sm:py-4" v-for="book in books.stayed_book" :key="book.id">
                      <div class="flex items-center space-x-4">
                          <div class="flex-1 min-w-0">
                              <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                  <a :href="route('book.user-book-show', [$page.props.auth.user.id, book.id])">ご予約番号: {{book.book_code}}</a> 
                              </p>
                              <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                {{book.checkin_at}}〜{{book.checkout_at}}
                              </p>
                          </div>
                          <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                              ¥ {{book.total_amount.toLocaleString()}}
                          </div>
                      </div>
                  </li>
              </ul>
          </div>
      </div>

    </div>


  </CommonLayout>
</template>