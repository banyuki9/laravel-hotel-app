<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import PlanCard from "@/Components/Plan/PlanCard.vue";
import CommonLayout from "@/Layouts/Common.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
const props = defineProps(["room", "plans"]);
const form = useForm({
  id: props.room.id
})

const destroy = () => {
    form.delete(route('rooms.destroy', form.id))
};

const reservationLink = ""
const editLink = ""
</script>

<template>
  <Head title="Rooms" />
  
  <CommonLayout :title="room.title">
        <h1 class="room-title text-white text-center p-28 bg-gray-600 mb-4 text-xl ">
          {{room.title}}
        </h1>
        
        <div class="flex justify-between mb-10">
          <div>
            <a :href="route('rooms.edit', room.id)" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow text-sm mr-2 inline-block">
              編集
            </a>
              
            <a class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2 px-4 border  rounded shadow text-sm inline-block">
              プランの追加
            </a>
          </div>
            
          <div>
            <form @submit.prevent="destroy">
              <button  class="bg-red-500 hover:bg-red-400 text-white font-semibold py-2 px-4 border  rounded shadow text-sm inline-block">
                削除
              </button>
            </form>
          </div>
        </div>

        <div class="article max-w-4xl mx-auto mb-8 leading-relaxed">
          {{room.description}}
        </div>

        <div class="max-w-4xl room-detail mx-auto">
          <dl class="flex text-s mb-1">
            <dt class="mr-3 text-gray-500">広さ</dt>
            <dd>{{ room.room_size }}</dd>
          </dl>
          <dl class="flex text-s mb-1">
            <dt class="mr-3 text-gray-500">定員</dt>
            <dd>{{ room.min_capacity }} - {{ room.max_capacity }} 名</dd>
          </dl>
          <dl class="flex text-s mb-2">
            <dt class="mr-3 text-gray-500">ベッド</dt>
            <dd>{{ room.bed_type }}</dd>
          </dl>
          <dl class="text-s mb-4">
            <dt class="mb-2 text-gray-500">その他設備</dt>
            <dd>{{ room.facilities }}</dd>
          </dl>
        </div>

      <div class="mt-24 max-w-4xl mx-auto">
        <h3 class="font-medium leading-tight text-3xl mt-0 mb-2 text-center font-bold mb-12">プラン</h3>

        <div class="plan-container flex">

            <PlanCard v-for="plan in plans" :key="plan.id" :plan="plan" class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 basis-1/2" :reservation-link="reservationLink" :edit-link="editLink" />

          </div>
          
        </div>

  </CommonLayout>
</template>

