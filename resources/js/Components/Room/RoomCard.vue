<script setup>
import { ref, defineEmits, defineProps } from "vue";
import { onMounted } from "vue";
const props = defineProps({
  room: Object,
});
const getThumbnail = () => {
  props.room.images.some((image) => {
    if (image.is_thumbnail == 1) {
      thumbnail.value = image;
      return;
    }
  });
};
const thumbnail = ref("");
const url = location.protocol + "//" + location.host;
onMounted(() => {
  getThumbnail();
});
</script>

<template>
  <div class="basis-1/3 mb-5 overflow-hidden rounded">
    <div
      class="
        max-w-sm
        bg-white
        rounded-lg
        border border-gray-200
        shadow-md
        dark:bg-gray-800 dark:border-gray-700
      "
    >
      <a
        :href="route('rooms.show', room.id)"
        class="w-full pb-[70%] block bg-no-repeat bg-center bg-cover"
        :style="{
          'background-image': `url(${
            url + '/storage/images/' + thumbnail.link
          })`,
        }"
      >

      </a>
      <div class="p-5">
        <a :href="route('rooms.show', room.id)">
          <h5
            class="
              mb-2
              text-2xl
              font-bold
              tracking-tight
              text-gray-900
              dark:text-white
            "
          >
            {{ room.title }}
          </h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-sm">
          {{ room.description }}
        </p>
        <dl class="flex text-xs mb-1">
          <dt class="mr-3 text-gray-500">広さ</dt>
          <dd>{{ room.room_size }}</dd>
        </dl>
        <dl class="flex text-xs mb-1">
          <dt class="mr-3 text-gray-500">定員</dt>
          <dd>{{ room.min_capacity }} - {{ room.max_capacity }} 名</dd>
        </dl>
        <dl class="flex text-xs mb-4">
          <dt class="mr-3 text-gray-500">ベッド</dt>
          <dd>{{ room.bed_type }}</dd>
        </dl>
        <a
          :href="route('rooms.show', room.id)"
          class="
            inline-flex
            items-center
            py-2
            px-3
            text-sm
            font-medium
            text-center text-white
            bg-blue-700
            rounded-lg
            hover:bg-blue-800
            focus:ring-4 focus:outline-none focus:ring-blue-300
            dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800
          "
        >
          詳細を見る
          <svg
            aria-hidden="true"
            class="ml-2 -mr-1 w-4 h-4"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
              clip-rule="evenodd"
            ></path>
          </svg>
        </a>
      </div>
    </div>
  </div>
</template>