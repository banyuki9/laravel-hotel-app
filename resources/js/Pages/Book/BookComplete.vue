<script setup>
import { defineProps } from "@inertiajs/inertia-vue3";
import CommonLayout from "@/Layouts/Common.vue";
const props = defineProps(["book"]);
</script>

<template>
  <Head title="ご予約完了" />
  <CommonLayout title="ご予約">
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          ご予約
        </h2>
      </div>
    </template>
    
    <h2 class="text-center mb-12 text-3xl font-bold text-gray-800">
      予約確定
    </h2>

    <div class=" max-w-md m-auto text-xl text-gray-800 font-semibold mb-12 pt-10">
      ご予約を承りました。<br>
      予約番号: {{ book.book_code }}
      <div class="mt-12">
        <a :href="route('top')" class="nline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
          トップへ戻る
        </a>
      </div>
    </div>

  </CommonLayout>
</template>