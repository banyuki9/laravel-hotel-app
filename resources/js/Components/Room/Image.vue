<script setup>
import { defineProps, defineEmits } from "@inertiajs/inertia-vue3";
const props = defineProps([
  "imageUrl",
  "hasDeleteButton"
])
const emit = defineEmits(['delete'])

const deleteImage = (image) => {
  emit('delete', image)
}

</script>

<template>
  <div class="image w-full h-full max-h-[224px] min-h-[224px] relative">
    <form class="absolute top-0 right-0">
      <button type="button" class="bg-red-600 p-1 inline-flex items-center justify-center text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" v-if="hasDeleteButton" @click="deleteImage">
        <span class="sr-only">Close menu</span>
            
          <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
      </button>
    </form>

    <img :src="imageUrl" alt="" class="w-full object-cover h-full" />
  </div>
</template>