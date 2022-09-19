<script setup>
import BreezeInput from '@/Components/Input.vue';
import BreezeTextarea from '@/Components/Textarea.vue';
import BreezeInputFile from '@/Components/InputFile.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';
import { defineEmits, defineProps } from 'vue'

const props = defineProps({
  form: Object,
  buttonText: String
})

const emit = defineEmits(['submit'])

const submit = () => {
  emit('submit')
}

</script>

<template>

    <form @submit.prevent="submit">

      <div class="mb-6">
        <BreezeLabel for="title" value="プランタイトル" />
        <BreezeInput id="title" type="text" class="mt-1 block w-full bg-gray-50" v-model="form.title" required autocomplete="current-password" autofocus />
        <BreezeInputError class="mt-2" :message="form.errors.title" />
      </div>
      <div class="mb-6">
        <BreezeLabel for="day_fee" value="平日料金" />
        <BreezeInput id="day_fee" type="number" class="mt-1 block w-full bg-gray-50" v-model="form.day_fee" required autocomplete="current-password" />
        <BreezeInputError class="mt-2" :message="form.errors.day_fee" />
      </div>
      <div class="mb-6">
        <BreezeLabel for="holiday_fee" value="休日料金" />
        <BreezeInput id="holiday_fee" type="number" class="mt-1 block w-full bg-gray-50" v-model="form.holiday_fee" required autocomplete="current-password" />
        <BreezeInputError class="mt-2" :message="form.errors.holiday_fee" />

      </div>
      <div class="mb-6">
        <BreezeLabel for="plan_detail" value="プラン詳細" />
        <BreezeTextarea id="plan_detail" v-model="form.plan_detail"/>
        <BreezeInputError class="mt-2" :message="form.errors.plan_detail" />
      </div>

      <div class="flex justify-center mt-8">
        <BreezeButton class="text-lg" v-text="buttonText">

        </BreezeButton>
      </div>
    </form>
</template>

