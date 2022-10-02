<script setup>
import SearchFormInput from "@/Components/Input.vue";
import SearchFormError from "@/Components/InputError.vue";
import SearchFormLabel from "@/Components/Label.vue";
import SearchFormButton from "@/Components/Button.vue";
import { defineEmits, defineProps, reactive, ref, watch } from "vue";
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
  form: Object,
})

const guestFormDisplay = ref(false)
const date = new Date();
const datePickerErrorMessage = ref("");

const range = reactive({
  start: new Date(props.form.startDate),
  end: new Date(props.form.endDate),
});

const showGuestForm = () => {
  guestFormDisplay.value = (!guestFormDisplay.value) ? true : false
}

const setGuestNumber = () => {
  guestFormDisplay.value = false;
}

const searchRoomPlan = (startDate, endDate) => {
  props.form.startDate = new Date(replaceTimeString(startDate))
  props.form.endDate = new Date(replaceTimeString(endDate))
  props.form.get(route('book.index'), {
    preserveState: true,
  })
}

const replaceTimeString = (time_string) => {
  let res = null;

  res = time_string.replace( /[年|月]/g, '/');
  res = res.replace( /[時|分]/g, ':');
  res = res.replace( /[日|秒]/g, '');

  return res;
}


</script>

<template>

  <form class="form py-6 pl-4 border rounded border-solid border-gray-300 max-w-screen-md mx-auto mb-8">

    <div>

      <v-date-picker v-model="range" is-range class="mb-4 flex justify-center flex-wrap">
        <template v-slot="{ inputValue, inputEvents }" >
          <div>
            <SearchFormLabel for="startDate" value="日程" />
            <div class="flex items-center">
              <input
              :value="inputValue.start"
              v-on="inputEvents.start"
              id="startDate"
              class="border px-2 py-1 w-40 rounded focus:outline-none focus:border-indigo-300 mr-2"
              />
              <input
              :value="inputValue.end"
              v-on="inputEvents.end"
              id="endDate"
              class="border px-2 py-1 w-40 rounded focus:outline-none focus:border-indigo-300"
              />
            </div>
            
          </div>
          
          <div class="relative ml-4">
            <SearchFormLabel for="person" value="ご利用人数" />
            <SearchFormInput @click="showGuestForm" id="person" type="text" class="border px-2 py-1 w-80 rounded focus:outline-none focus:border-indigo-300" required autocomplete="current-password" readonly :value="`大人${form.adult}人, 子供${form.child}`"/>
            
            <div v-if="guestFormDisplay" class="z-50 absolute left-0 top-14 guestsForm shadow-sm w-80 py-4 border px-4 box-border rounded border-solid border-gray-300 mt-2 focus:outline-none focus:border-indigo-300 bg-white">
              <div class="mb-6">
                <SearchFormLabel for="adult" value="大人" />
                <SearchFormInput id="adult" v-model="form.adult" type="number" class="border px-2 py-1 rounded w-full focus:outline-none focus:border-indigo-300" required min="1"/>
              </div>
              <div class="mb-6">
                <SearchFormLabel for="child" value="子供(年齢0-6)" />
                <SearchFormInput id="child"  v-model="form.child" type="number" class="border px-2 py-1 rounded w-full focus:outline-none focus:border-indigo-300" required min="0"/>
              </div>
              <SearchFormButton class="w-full text-center block justify-center" @click="setGuestNumber" type="button">
                <span class="text-center block">選択する</span>
              </SearchFormButton>
            </div>
          </div>
          
          
          <div class="flex justify-center mt-8">
            <SearchFormButton class="text-lg" @click.prevent="searchRoomPlan(inputValue.start, inputValue.end)">検索する</SearchFormButton>
          </div>
        </template>
      </v-date-picker>
      
      <SearchFormError class="mt-2 text-center" :message="form.errors.startDate" />
      <SearchFormError class="mt-2 text-center" :message="form.errors.adult" />
      <SearchFormError class="mt-2 text-center" :message="form.errors.child" />
    </div>
    

  </form>
</template>

