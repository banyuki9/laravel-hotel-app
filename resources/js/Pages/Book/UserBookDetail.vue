<script setup>
import { usePage, Head, defineProps, useForm } from "@inertiajs/inertia-vue3"
import CommonLayout from "@/Layouts/Common.vue";
const props = defineProps(['book'])
const user = usePage().props.value.auth.user;

const checkInForm = useForm({
  book_id: props.book.id
})
console.log(props.book);

const checkIn = () => {
  checkInForm.post(route('book.checkin'))
}
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
        <p class="text-sm mb-2">
          ご予番号 : {{book.book_code}}
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
              <a :href="route('rooms.show', book.plan.room.id)" class="hover:text-gray-600 underline hover:decoration-slate-400">
                {{book.plan.room.title}}
              </a>
            </dd>
          </dl>

          <dl class="flex mb-2">
            <dt class="mr-2">プラン</dt>
            <dd>
              <a :href="route('rooms.show', book.plan.room.id)" class="hover:text-gray-600 underline hover:decoration-slate-400">
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

      <form class="flex items-center justify-center mt-14" v-if="user.role === 0&&!book.checkin_status" @submit.prevent="checkIn">
        <button class="checkin-button text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 mr-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 text-center max-w-[250px] w-full font-semibold text-xl">
          チェックイン
        </button>
      </form>
    </div>


  </CommonLayout>
</template>