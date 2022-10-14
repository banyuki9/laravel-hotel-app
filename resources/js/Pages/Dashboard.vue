<script setup>
import CommonLayout from "@/Layouts/Common.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { ref } from "vue"
const props = defineProps(["rooms", "checkin_book", "checkout_book"]);
import RoomCard from "@/Components/Room/RoomCard.vue";
import UserBookCard from "@/Components/Book/UserBookCard.vue"

const displayCheckinBook = ref(true);
const displayCheckoutBook = ref(true);

const toggleCheckinBook = () => {
    (displayCheckinBook.value) ? displayCheckinBook.value = false : displayCheckinBook.value = true;
}
const toggleCheckoutBook = () => {
    (displayCheckoutBook.value) ? displayCheckoutBook.value = false : displayCheckoutBook.value = true;
}

</script>

<template>
  <Head title="ダッシュボード | Laravel Hotel" />

  <CommonLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        ダッシュボード
      </h2>
    </template>

    <div class="flex m-auto">
      <div class="basis-2/3 p-6">
        <div class="rooms">
            <div class="flex justify-between items-center mb-8">
                <h2 class="font-semibold text-xl text-gray-800">客室情報</h2>
                <Link :href="route('rooms.index')" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow text-sm">客室一覧</Link>
            </div>
          <div class="mx-auto flex flex-wrap justify-between">
            <RoomCard v-for="room in rooms" :key="room.id" :room="room" class="basis-[48%] " />
          </div>
        </div>
      </div>

      <div class=" basis-1/3 p-6">
        <div class="mb-24">
            <div class="flex justify-between items-center mb-8">
                <h2 class="font-semibold text-xl text-gray-800 flex justify-between items-center" @click="toggleCheckinBook">
                    <div>本日チェックインのお客様</div>
                    <div class="ml-4">
                        <div class="up-arrow" v-if="displayCheckinBook">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                            </svg>
                        </div>
                        <div class="up-arrow" v-else>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </div>

                </h2>
            </div>
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700" v-if="displayCheckinBook">

                <UserBookCard class="py-3 sm:py-4" v-for="book in checkin_book" :key="book.id" :book="book">
                </UserBookCard>
            </ul>
            <Link :href="route('book.checkin-index')" class="mt-8 ml-auto bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow text-sm">もっと見る</Link>
        </div> 
        <div class="mb-6">
            <div class="flex justify-between items-center mb-8">
                <h2 class="font-semibold text-xl text-gray-800 flex justify-between items-center" @click="toggleCheckoutBook">
                    <div>本日チェックアウトのお客様</div>
                    <div class="ml-4">
                        <div class="up-arrow" v-if="displayCheckoutBook">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                            </svg>
                        </div>
                        <div class="up-arrow" v-else>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </div>
                </h2>
            </div>
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700" v-if="displayCheckoutBook">
                <UserBookCard class="py-3 sm:py-4" v-for="book in checkout_book" :key="book.id" :book="book">
                </UserBookCard>
            </ul>
            <Link :href="route('book.checkout-index')" class="mt-8 ml-auto bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow text-sm">もっと見る</Link>
        </div> 
      </div>
    </div>
  </CommonLayout>
</template>

<style scoped>
.rooms-card {
    width: 48% ;
    flex-basis: 48%;
}
</style>