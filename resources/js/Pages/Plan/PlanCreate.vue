<script setup>
import CommonLayout from "@/Layouts/Common.vue";
import PlanCreateForm from '@/Components/Plan/Form.vue'
import { Head, useForm, defineProps } from "@inertiajs/inertia-vue3";
const props = defineProps(["room"]);

const form = useForm({
  title: '',
  day_fee: '',
  holiday_fee: '',
  plan_detail: '',
});
const buttonText = "追加する"

const submit = () => {
    form.post(route('plan.store', props.room.id), {
        onFinish: () => form.reset(),
    })
};
</script>

<template>
  <Head title="Plan Create" />

  <CommonLayout :title="room.title">
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          プラン登録
        </h2>
    </template>
    <h4 class="mb-8 font-semibold text-gray-800 leading-tight">
      客室名: {{room.title}}
    </h4>
    <PlanCreateForm :form="form" @submit="submit" :button-text="buttonText"/>
  </CommonLayout>
</template>