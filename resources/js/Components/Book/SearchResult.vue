<script setup>
import { defineProps } from 'vue'
const props = defineProps(["form"]);

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
  <div class="book-data w-full lg:w-4/5 mx-auto mt-12">
    <div class="text-lg mb-2">検索結果</div>

    <ul>
      <li>
        チェックイン日: {{ getStringFromDate(form.startDate) }}, チェックアウト日:
        {{ getStringFromDate(form.endDate) }}
      </li>
      <li>
        大人 {{ route().params.adult ? route().params.adult : 2 }}人, 子供
        {{ route().params.child ? route().params.child : 0 }}人
      </li>
    </ul>
  </div>
</template>