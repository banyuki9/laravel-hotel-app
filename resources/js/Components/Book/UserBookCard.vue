<script setup>
import { useForm, usePage, defineProps } from "@inertiajs/inertia-vue3"
const user = usePage().props.value.auth.user
const props = defineProps(['book'])
</script>


<template>
  <li class="py-3 sm:py-4">
      <div class="flex items-center space-x-4">
          <div class="flex-1 min-w-0">
              <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                  <a :href="route('book.user-book-show', [user.id, book.id])" class="mb-2 inline-block hover:text-gray-600">
                    <span class="font-semibold ">{{book.plan.title}}</span><br>
                    ご予約番号: {{book.book_code}}
                  </a> 
              </p>
              <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                {{book.checkin_at}}〜{{book.checkout_at}}
              </p>
          </div>
          <div class=" items-center text-base font-semibold text-gray-900 dark:text-white">
              ¥ {{book.total_amount.toLocaleString()}}
              <p class="text-sm text-gray-500 truncate dark:text-gray-400 font-normal">
                大人{{book.adult_number}}人, 子供{{book.child_number}}人
              </p>
          </div>
      </div>
  </li>
</template>