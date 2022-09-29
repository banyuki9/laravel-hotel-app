<script setup>
import { defineProps } from "@inertiajs/inertia-vue3";
const props = defineProps(["plan", "room", "book"]);
console.log(new Date(props.book.start));

const getDate = (datetime) => {
  let date = new Date(datetime);
  return (
    date.getFullYear() + "年" + date.getMonth() + "月" + date.getDate() + "日"
  );
};
</script>

<template>
  <div>
    <h2 class="text-xl mb-6 font-semibold text-gray-800 pb-4 border-b border-slate-300 border-solid">ご予約情報</h2>
    <div class="room_information">
      <dl class="mb-4">
        <dt class="font-semibold text-gray-600 text-xs">客室名</dt>
        <dd>
          {{ room.title }}
        </dd>
      </dl>
      <dl class="mb-4">
        <dt class="font-semibold text-gray-600 text-xs">プラン</dt>
        <dd>
          {{ plan.title }}
        </dd>
      </dl>
    </div>

    <div class="book_information mb-6 pb-2 border-b border-slate-300 border-solid">
      <dl class="mb-4">
        <dt class="font-semibold text-gray-600 text-xs">チェックイン日</dt>
        <dd>
          {{ getDate(book.start) }}
        </dd>
      </dl>
      <dl class="mb-4">
        <dt class="font-semibold text-gray-600 text-xs">チェックアウト日</dt>
        <dd>
          {{ getDate(book.end) }}
        </dd>
      </dl>
      <dl class="mb-4">
        <dt class="font-semibold text-gray-600 text-xs">宿泊日数</dt>
        <dd>{{ book.dateOfNights }} 泊</dd>
      </dl>
      <dl class="mb-4">
        <dt class="font-semibold text-gray-600 text-xs">ご利用人数</dt>
        <dd>2名様 (大人{{ book.adult }}人, 子供{{ book.child }}人)</dd>
      </dl>
    </div>

    <div class="total_amount text-lg font-semibold mb-4 text-gray-800">
      合計金額（税込）: {{ book.roomTotalAmount.toLocaleString() }} 円
    </div>

    <div class="total_amount text-lg font-semibold text-gray-800">
      お支払い金額: {{ book.roomTotalAmount.toLocaleString() }} 円
    </div>
  </div>
</template>

