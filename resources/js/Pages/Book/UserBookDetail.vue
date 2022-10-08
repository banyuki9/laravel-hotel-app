<script setup>
import { Head, defineProps } from "@inertiajs/inertia-vue3"
import CommonLayout from "@/Layouts/Common.vue";
const props = defineProps(['book', 'room'])
</script>

<template>
<Head title="ご予約詳細" />
  <CommonLayout title="ご予約詳細">
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          ご予約詳細
        </h2>
      </div>
    </template>

    <div class="">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight pb-4">
        {{book.user.name_kanji}} ({{book.user.name_kana}})様
        ご予約情報
        <p class="text-sm mt-2">
          ご予約日 : {{book.booked_at}}
        </p>
      </h2>
      <div class="bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700 mb-4">
        <h3 class="font-semibold text-l text-gray-800 leading-tight pb-4">
          旅行情報
        </h3>
        <div>
          <dl class="flex mb-2">
            <dt class="mr-2">客室</dt>
            <dd>
              <a :href="route('rooms.show', room.id)" class="hover:text-gray-600 underline hover:decoration-slate-400">
                {{room.title}}
              </a>
            </dd>
          </dl>

          <dl class="flex mb-2">
            <dt class="mr-2">プラン</dt>
            <dd>
              <a :href="route('rooms.show', room.id)" class="hover:text-gray-600 underline hover:decoration-slate-400">
                {{book.plan.title}}
              </a> 
            </dd>
          </dl>

          <dl class="flex mb-2">
            <dt class="mr-2">日程</dt>
            <dd>
              {{book.checkin_at}} 〜 {{book.checkout_at}}
            </dd>
          </dl>

        </div>
      </div>

      <div class="bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700 mb-4 ">
        <h3 class="font-semibold text-l text-gray-800 leading-tight pb-4">
          お客様情報
        </h3>
        <div>
          <dl class="flex mb-2">
            <dt class="mr-2">お名前</dt>
            <dd>
                {{book.user.name_kanji}} ({{book.user.name_kana}}) 様
            </dd>
          </dl>
          <dl class="flex mb-2">
            <dt class="mr-2">メールアドレス</dt>
            <dd>
                {{book.user.email}}
            </dd>
          </dl>
          <dl class="flex mb-2">
            <dt class="mr-2">お電話番号</dt>
            <dd>
                {{book.user.number}}
            </dd>
          </dl>
          <dl class="flex mb-2">
            <dt class="mr-2">備考</dt>
            <dd>
                {{book.note}}
            </dd>
          </dl>



        </div>
      </div>

      <div class="bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700 ">
        <h3 class="font-semibold text-l text-gray-800 leading-tight pb-4">
          お支払い情報
        </h3>
        <div>
          <dl class="flex mb-2" v-if="book.has_credit_card">
            <dt class="mr-2">お支払い方法</dt>
            <dd>
                クレジットカード
            </dd>
          </dl>
          <dl class="flex mb-2">
            <dt class="mr-2">料金</dt>
            <dd>
                {{book.total_amount.toLocaleString()}} 円 <span v-if="book.has_credit_card">(お支払い済み)</span>
            </dd>
          </dl>
        </div> 


      </div>
    </div>


  </CommonLayout>
</template>