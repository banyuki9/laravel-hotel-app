<script setup>
import { defineProps } from "@inertiajs/inertia-vue3";
const props = defineProps(["plan", "room", "book"]);

const getStringFromDate = (date) => {
  date = new Date(date);
  var year_str = date.getFullYear();
  var month_str = 1 + date.getMonth();
  var day_str = date.getDate();
  
  let format_str = 'YYYY年MM月DD日';
  format_str = format_str.replace(/YYYY/g, year_str);
  format_str = format_str.replace(/MM/g, month_str);
  format_str = format_str.replace(/DD/g, day_str);
  
  return format_str;
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
        <dt class="font-semibold text-gray-600 text-xs">ベッドタイプ</dt>
        <dd>
          {{ room.bed_type }}
        </dd>
      </dl>
      <dl class="mb-4">
        <dt class="font-semibold text-gray-600 text-xs">その他設備</dt>
        <dd>
          {{ room.facilities }}
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
          {{ getStringFromDate(book.start) }}
        </dd>
      </dl>
      <dl class="mb-4">
        <dt class="font-semibold text-gray-600 text-xs">チェックアウト日</dt>
        <dd>
          {{ getStringFromDate(book.end) }}
        </dd>
      </dl>
      <dl class="mb-4">
        <dt class="font-semibold text-gray-600 text-xs">宿泊日数</dt>
        <dd>{{ book.dateOfNights }} 泊</dd>
      </dl>
      <dl class="mb-4">
        <dt class="font-semibold text-gray-600 text-xs">ご利用人数</dt>
        <dd>{{Number(book.adult) + Number(book.child)}}名様 (大人{{ book.adult }}人, 子供{{ book.child }}人)</dd>
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

