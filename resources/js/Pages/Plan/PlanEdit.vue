<script setup>
import CommonLayout from "@/Layouts/Common.vue";
import PlanCreateForm from '@/Components/Plan/Form.vue'
import { Head, useForm, defineProps } from "@inertiajs/inertia-vue3";
const props = defineProps(["room", "plan"]);

const form = useForm({
  title: props.plan.title,
  day_fee: props.plan.day_fee,
  holiday_fee: props.plan.holiday_fee,
  plan_detail: props.plan.plan_detail,
  plan_id: props.plan.id
});

const deleteForm = useForm({
  plan_id: props.plan.id,
  room_id: props.room.id
})

const buttonText = "完了する"

const submit = () => {
    form.patch(route('plan.update', props.room.id))
};

const destroy = () => {
  if (window.confirm("本当にこのプランを削除しますか？")) {
    deleteForm.delete(route('plan.destroy', deleteForm.plan_id))
  }
};

</script>

<template>
  <Head title="Plan Create" />

  <CommonLayout :title="room.title">
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          プラン編集
        </h2>
    </template>
    <h4 class="mb-8 font-semibold text-gray-800 leading-tight">
      客室名: {{room.title}}
    </h4>
    <PlanCreateForm :form="form" @submit="submit" :button-text="buttonText"/>
    <form @submit.prevent="destroy" class="mt-16 mb-8 flex justify-center">
      <button  class="bg-red-500 hover:bg-red-400 text-white font-semibold py-2 px-4 border  rounded shadow text-sm inline-block">
        このプランを削除する
      </button>
    </form>
  </CommonLayout>


</template>