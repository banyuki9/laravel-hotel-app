<script setup>
import BreezeInput from "@/Components/Input.vue";
import BreezeTextarea from "@/Components/Textarea.vue";
import BreezeInputError from "@/Components/InputError.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeButton from "@/Components/Button.vue";
import { defineEmits, defineProps, reactive, ref, watch } from "vue";
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
  form: Object,
})

const adult = ref(1)
const child = ref(0)

const guestFormDisplay = ref(false)
const date = new Date();

const range = reactive({
  start: props.form.start,
  end: props.form.end,
});

const showGuestForm = () => {
  guestFormDisplay.value = (!guestFormDisplay.value) ? true : false
}

const setGuestNumber = () => {
  guestFormDisplay.value = false;
}

const datePickerErrorMessage = ref("");

const searchRoomPlan = (startDate, endDate) => {
  props.form.start = new Date(replaceTimeString(startDate)).getTime()
  props.form.end = new Date(replaceTimeString(endDate)).getTime()
  validateDatePickerValue();

  if (!datePickerErrorMessage.value) {
    Inertia.replace(route('book.index', {adult: props.form.adult, child: props.form.child, startDate: props.form.start, endDate: props.form.end}))
  }
}

const validateDatePickerValue = () => {
  datePickerErrorMessage.value = ""
  const today = date.getTime();
  if (props.form.end < props.form.start) datePickerErrorMessage.value = "チェックアウト日はチェックイン日より後の日程を選択してください。";
  if (props.form.start < today) datePickerErrorMessage.value = "チェックイン日は本日より前の日付は選択できません。"
  if (date.getDate() === new Date(props.form.start).getDate()) datePickerErrorMessage.value = ""
}

const replaceTimeString = (time_string) => {
  var res = null;

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
            <BreezeLabel for="startDate" value="日程" />
            <div class="flex items-center">
              <input
              :value="inputValue.start"
              v-on="inputEvents.start"
                id="startDate"
                class="border px-2 py-1 w-40 rounded focus:outline-none focus:border-indigo-300 mr-2"
              />
              <input
                v-model="inputValue.end"
                id="endDate"
                class="border px-2 py-1 w-40 rounded focus:outline-none focus:border-indigo-300"
              />
            </div>
            <BreezeInputError class="mt-2" :message="datePickerErrorMessage" />
          </div>

          <div class="relative ml-4">
            <BreezeLabel for="person" value="ご利用人数" />
            <BreezeInput @click="showGuestForm" id="person" type="text" class="border px-2 py-1 w-80 rounded focus:outline-none focus:border-indigo-300" required autocomplete="current-password" readonly :value="`大人${form.adult}人, 子供${form.child}`"/>
      
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


          <div class="flex justify-center mt-8">
            <BreezeButton class="text-lg" @click.prevent="searchRoomPlan(inputValue.start, inputValue.end)">検索する</BreezeButton>
          </div>
        </template>
      </v-date-picker>

    </div>
    

  </form>
</template>

