<script setup>
import BreezeInput from "@/Components/Input.vue";
import BreezeTextarea from "@/Components/Textarea.vue";
import BreezeInputError from "@/Components/InputError.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeButton from "@/Components/Button.vue";
import { defineEmits, defineProps, reactive, ref, watch } from "vue";

const props = defineProps({
  form: Object,
});

const guestFormDisplay = ref(false)
const guestNumber = ref("大人" + props.form.adult + "人," + "子供" + props.form.child + "人")
const date = new Date();
const range = reactive({
  start: props.form.startDate,
  end: props.form.endDate,
});

const showGuestForm = () => {
  guestFormDisplay.value = (!guestFormDisplay.value) ? true : false
}

const setGuestNumber = () => {
  guestNumber.value = "大人" + props.form.adult + "人," + "子供" + props.form.child + "人" 
  guestFormDisplay.value = false;
}

const update = (e) => {
  console.log(e);
}
</script>

<template>

  <form class="form py-6 pl-4 border rounded border-solid border-gray-300 max-w-screen-md mx-auto mb-8">

    <div class="flex justify-center">

      <v-date-picker v-model="range" is-range class="mb-4">
        <template v-slot="{ inputValue, inputEvents }">
          <BreezeLabel for="startDate" value="日程" />
          <div class="flex items-center">
            <input
            :value="inputValue.start"
            v-on="inputEvents.start"
              id="startDate"
              class="border px-2 py-1 w-40 rounded focus:outline-none focus:border-indigo-300"
            />
            <input
              v-on="inputEvents.end"
              v-model="inputValue.end"
              id="endDate"
              class="border px-2 py-1 w-40 rounded focus:outline-none focus:border-indigo-300"
            />
          </div>
        </template>
      </v-date-picker>
      
      <div class="relative ml-4">
        <BreezeLabel for="person" value="ご利用人数" />
        <BreezeInput @click="showGuestForm" id="person" type="text" class="border px-2 py-1 w-80 rounded focus:outline-none focus:border-indigo-300" required autocomplete="current-password" readonly :value="guestNumber"/>
  
        <div v-if="guestFormDisplay" class="z-50 absolute left-0 top-14 guestsForm shadow-sm w-80 py-4 border px-4 box-border rounded border-solid border-gray-300 mt-2 focus:outline-none focus:border-indigo-300 bg-white">
          <div class="mb-6">
            <BreezeLabel for="adult" value="大人" />
            <BreezeInput id="adult" v-model="form.adult" type="number" class="border px-2 py-1 rounded w-full focus:outline-none focus:border-indigo-300" required min="1"/>
          </div>
          <div class="mb-6">
            <BreezeLabel for="child" value="子供(年齢0-6)" />
            <BreezeInput id="child"  v-model="form.child" type="number" class="border px-2 py-1 rounded w-full focus:outline-none focus:border-indigo-300" required min="0"/>
          </div>
          <BreezeButton class="w-full text-center block justify-center" @click="setGuestNumber" type="button">
            <span class="text-center block">選択する</span>
          </BreezeButton>
        </div>
      </div>
    </div>


    <div class="flex justify-center mt-8">
      <BreezeButton class="text-lg">検索する</BreezeButton>
    </div>
  </form>
</template>

