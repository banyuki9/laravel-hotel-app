<script setup>
import { defineProps } from "@inertiajs/inertia-vue3";
import CommonLayout from "@/Layouts/Common.vue";
const props = defineProps(["book_code"]);
</script>

<template>
  <Head title="ご予約完了" />
  <CommonLayout title="ご予約">

    <h2 class="text-center mb-12 text-3xl font-bold text-gray-800">
      予約確定
    </h2>

    <div class=" max-w-md m-auto text-xl text-gray-800 font-semibold mb-12 pt-10">
      ご予約を承りました。<br>
      予約番号: {{ book_code }}
    </div>
  </CommonLayout>
</template>