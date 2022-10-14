<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import PlanCard from "@/Components/Plan/PlanCard.vue";
import RoomImage from "@/Components/Room/Image.vue";
import CommonLayout from "@/Layouts/Common.vue";
import { ref } from "vue";
import { Head, useForm, usePage } from "@inertiajs/inertia-vue3";
import { onMounted } from "vue";
const props = defineProps(["room", "plans"]);
const form = useForm({
  id: props.room.id,
});
const user = usePage().props.value.auth.user;

const destroy = () => {
  if (window.confirm("本当にこの客室を削除しますか？")) {
    form.delete(route("rooms.destroy", form.id));
  }
};
console.log(props.room);

const getThumbnail = () => {
  props.room.images.some((image) => {
    if (image.is_thumbnail == 1) {
      thumbnail.value = image;
      return;
    }
  });
}
const url = location.protocol + "//" + location.host;
const thumbnail = ref("");

onMounted(() => {
  getThumbnail();
});

const reservationLink = "";
</script>

<template>
  <Head title="Rooms" />

  <CommonLayout :title="room.title">
   <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          客室詳細
        </h2>
        <a :href="route('rooms.index')" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow text-sm">
          客室一覧
        </a>
      </div>
    </template> 
    <h1
      class="room-title text-white text-center p-32 bg-no-repeat bg-center mb-12 text-xl bg-cover font-semibold text-xl"
      :style="{
        'background-image': `url(${url + '/storage/images/' + thumbnail.link})`,
      }"
    >
      {{ room.title }}
    </h1>

    <div v-if="user">
      <div v-if="user.role === 0" class="flex justify-between mb-10 max-w-4xl m-auto">
        <div>
          <a
            :href="route('rooms.edit', room.id)"
            class="
              bg-white
              hover:bg-gray-100
              text-gray-800
              font-semibold
              py-2
              px-4
              border border-gray-400
              rounded
              shadow
              text-sm
              mr-2
              inline-block
            "
          >
            編集
          </a>

          <a
            :href="route('plan.create', room.id)"
            class="
              bg-gray-700
              hover:bg-gray-600
              text-white
              font-semibold
              py-2
              px-4
              border
              rounded
              shadow
              text-sm
              inline-block
            "
          >
            プランの追加
          </a>
        </div>

        <div>
          <form @submit.prevent="destroy">
            <button
              class="
                bg-red-500
                hover:bg-red-400
                text-white
                font-semibold
                py-2
                px-4
                border
                rounded
                shadow
                text-sm
                inline-block
              "
            >
              削除
            </button>
          </form>
        </div>
      </div>
    </div>

    <div class="article max-w-4xl mx-auto mb-10 leading-relaxed">
      {{ room.description }}
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

    <div class="images mx-auto max-w-4xl  mt-12 mt-24" v-if="room.images.length">
        <h3
        class="
          font-medium
          leading-tight
          text-3xl
          mt-0
          mb-2
          text-center
          font-bold
          mb-12
        "
      >
        客室
      </h3>
      <div class="flex flex-wrap">
        <div
          v-for="image in room.images"
          :key="image.id"
          class="basis-3/12"
          :class="{ hidden: image.is_thumbnail }"
        >
          <RoomImage :image-url="image.image_url" />
        </div>
      </div>
    </div>

    <div class="mt-24 max-w-4xl mx-auto" v-if="plans.length">
      <h3
        class="
          font-medium
          leading-tight
          text-3xl
          mt-0
          mb-2
          text-center
          font-bold
          mb-12
        "
      >
        プラン
      </h3>

      <div
        class="
          plan-container
          flex flex-wrap
          -mx-1
          lg:-mx-2
          flex-row
          justify-between
        "
      >
        <PlanCard
          v-for="plan in plans"
          :key="plan.id"
          :plan="plan"
          class="
            plan_card
            p-6
            bg-white
            rounded-lg
            border border-gray-200
            shadow-md
            dark:bg-gray-800 dark:border-gray-700
            basis-[48%]
            mb-4
          "
          :reservation-link="reservationLink"
          :edit-link="`/plan/${room.id}/edit/${plan.id}`"
        />
      </div>
    </div>


  </CommonLayout>
</template>

