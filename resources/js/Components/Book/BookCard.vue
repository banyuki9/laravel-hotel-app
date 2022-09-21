<script setup>
import { ref, defineEmits, defineProps } from 'vue'

const props = defineProps({
  room: Object,
})

const readPlanDetail = (e) => {
  e.target.previousElementSibling.style.height = 'auto';
  e.target.style.display = 'none'
}
</script>

<template>
  <!-- Container -->
<div class="container mt-10 mx-auto p-4 md:p-0">
  
  <!-- Card wrapper -->
  <div class="shadow-lg flex flex-wrap w-full lg:w-4/5 mx-auto">
    
    <!-- Card image -->
    <div class="bg-cover bg-bottom border w-full md:w-1/3 h-64 md:h-auto relative" style="background-image:url('https://images7.alphacoders.com/347/347549.jpg')">
      <div class="absolute text-xl">
        <i class="fa fa-heart text-white hover:text-red-light ml-4 mt-4 cursor-pointer"></i>
      </div>
    </div>
    <!-- ./Card image -->
    
    <!-- Card body -->
    <div class="bg-white w-full md:w-2/3">
      <!-- Card body - outer wrapper -->
      <div class="h-full mx-auto px-6 md:px-0 md:pt-6 md:-ml-6 relative">
        <!-- Card body - inner wrapper -->
        <div class="bg-white lg:h-full p-6 -mt-6 md:mt-0 relative mb-4 md:mb-0 flex flex-wrap md:flex-wrap items-center">
          <!-- Card title and subtitle -->
          <div class="w-full lg:w-1/5 lg:border-right lg:border-solid text-center md:text-left">
            <h3 class="font-bold">{{room.title}}</h3>
            <hr class="w-1/4 md:ml-0 mt-4  border lg:hidden">
          </div>
          <!-- ./Card title and subtitle -->
          
          <!-- Card description -->
          <div class="w-full lg:w-3/5 lg:px-3">
            <p class="text-md mt-4 lg:mt-0 text-justify md:text-left text-sm">
            {{room.description}}
            </p>
          </div>
          <!-- ./Card description -->
          
          <!-- Call to action button -->
          <div class="w-full lg:w-1/5 mt-6 lg:mt-0 lg:px-4 text-center md:text-left">
            <a :href="route('rooms.show', room.id)" class="bg-white hover:bg-grey-darker hover:text-gray-400 border border-solid border-grey w-1/3 lg:w-full py-2 block text-center">詳細</a>
          </div>
          <!-- ./Call to action button -->

          <div class="plan_wrapper flex justify-between flex-wrap mt-6 w-full ">
            <p v-if="!room.plans.length">予約できるプランはありません</p>
            <div class="plan block p-4 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700  basis-1/2 mb-4" v-for="plan in room.plans" :key="plan.id">
              <h5 class="mb-2 text-sm tracking-tight text-gray-900 dark:text-white font-semibold">{{plan.title}}</h5>
              <p class="font-normal text-gray-700 dark:text-gray-400 mb-5 text-sm">
                <span class="plan_detail">{{plan.plan_detail}}</span>
                <span class="button mt-2 block text-right cursor-pointer text-slate-500" v-if="plan.plan_detail.length > 61" @click="readPlanDetail">もっと見る</span>
              </p>

              <div class="flex items-center mt-4">
                <div class="price text-lg mb-3 flex justify-end items-center">
                  <span class="text-xs mr-3">大人/一泊</span>
                  <span class="font-semibold">¥ <span class="text-2xl ">{{plan.day_fee}}</span>円 ~</span>
                </div>
              </div>
              <a :href="reservationLink" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-2">
                  予約する
              </a>

            </div>
          </div>

        </div>
        <!-- ./Card body - inner wrapper -->

      </div>
      <!-- ./Card body - outer wrapper -->
    </div>
    <!-- ./Card body -->
  </div>
  <!-- ./Card wrapper -->
</div>
<!-- ./Container -->
</template>

<style scoped>
.plan_detail {
  height: 62px;
  overflow-y: hidden;
  display: block;
}
</style>