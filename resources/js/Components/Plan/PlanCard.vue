<script setup>
import { ref, defineEmits, defineProps } from 'vue'

const props = defineProps({
  plan: Object,
  reservationLink: String,
  editLink: String,
})

const planDetailStatus = ref(false)

const showPlanDetail = () => {
  planDetailStatus.value = (!planDetailStatus.value) ? true : false
}


</script>

<template>

  <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">

    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{plan.title}}</h5>

    <div class="accordion mb-4" id="accordionExample">
      <div class="accordion-item bg-white border border-gray-200">
        <h2 class="accordion-header mb-0" id="headingOne" @click="showPlanDetail">
          <button class="
            accordion-button
            relative
            flex
            items-center
            w-full
            py-4
            px-5
            text-base text-gray-800 text-left
            bg-white
            border-0
            rounded-none
            transition
            focus:outline-none
          " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
            aria-controls="collapseOne">
            このプランには以下のものが含まれます
          </button>
        </h2>
        <div v-if="planDetailStatus" id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
          data-bs-parent="#accordionExample">
          <div class="accordion-body py-4 px-5 text-xs leading-relaxed">
            {{plan.plan_detail}}
          </div>
        </div>
      </div>

    </div>

    <div class="card-footer flex justify-between">

      <div class="price text-lg mb-3 flex justify-end items-center ">
        <span class="text-xs mr-3">大人/一泊</span>
        <span class="font-semibold">¥ <span class="text-2xl ">{{plan.day_fee}}</span>円 ~</span>
      </div>
      <div>
        <a :href="reservationLink" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-2">
            予約する
        </a>
        <a :href="editLink" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded-lg shadow text-sm mr-2 inline-block">
            編集
        </a>

      </div>
    </div>
  </div>
</template>