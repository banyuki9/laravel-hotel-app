<script setup>
import PlanInput from '@/Components/Input.vue';
import PlanTextarea from '@/Components/Textarea.vue';
import PlanInputError from '@/Components/InputError.vue';
import PlanLabel from '@/Components/Label.vue';
import PlanFormButton from '@/Components/Button.vue';
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
        <PlanLabel for="title" value="プランタイトル" />
        <PlanInput id="title" type="text" class="mt-1 block w-full bg-gray-50" v-model="form.title" required autocomplete="current-password" autofocus />
        <PlanInputError class="mt-2" :message="form.errors.title" />
      </div>
      <div class="mb-6">
        <PlanLabel for="day_fee" value="平日料金" />
        <PlanInput id="day_fee" type="number" class="mt-1 block w-full bg-gray-50" v-model="form.day_fee" required autocomplete="current-password" />
        <PlanInputError class="mt-2" :message="form.errors.day_fee" />
      </div>
      <div class="mb-6">
        <PlanLabel for="holiday_fee" value="休日料金" />
        <PlanInput id="holiday_fee" type="number" class="mt-1 block w-full bg-gray-50" v-model="form.holiday_fee" required autocomplete="current-password" />
        <PlanInputError class="mt-2" :message="form.errors.holiday_fee" />

      </div>
      <div class="mb-6">
        <PlanLabel for="plan_detail" value="プラン詳細" />
        <PlanTextarea id="plan_detail" v-model="form.plan_detail"/>
        <PlanInputError class="mt-2" :message="form.errors.plan_detail" />
      </div>

      <div class="flex justify-center mt-8">
        <PlanFormButton class="text-lg" v-text="buttonText">

        </PlanFormButton>
      </div>
    </form>
</template>

