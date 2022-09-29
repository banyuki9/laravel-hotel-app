<script setup>
  import CustomerInformationInput from '@/Components/Input.vue';
  import CustomerInformationTextarea from '@/Components/Textarea.vue';
  import CustomerInformationInputError from '@/Components/InputError.vue';
  import CustomerInformationLabel from '@/Components/Label.vue';
  import CustomerInformationFormButton from '@/Components/Button.vue';
  import { defineEmits, defineProps } from 'vue'

  const props = defineProps({
    form: Object,
  })

  const emit = defineEmits(['submit'])

  const submit = () => {
    emit('submit')
  }
</script>

<template>
  <form @submit.prevent="submit">
    <div class="mb-6">
      <CustomerInformationLabel for="email" value="メールアドレス" />
      <CustomerInformationInput id="email" type="email" class="mt-1 block w-full bg-gray-50" v-model="form.email" required readonly />
    </div>
    <div class="mb-6">
      <CustomerInformationLabel for="name_kanji" value="お名前(漢字)" />
      <CustomerInformationInput id="name_kanji" type="text" class="mt-1 block w-full bg-gray-50" v-model="form.name_kanji" required   />
      <CustomerInformationInputError class="mt-2" :message="form.errors.name_kanji" />
    </div>
    <div class="mb-6">
      <CustomerInformationLabel for="name_kana" value="お名前(ひらがな)" />
      <CustomerInformationInput id="name_kana" type="text" class="mt-1 block w-full bg-gray-50" v-model="form.name_kana" required  />
      <CustomerInformationInputError class="mt-2" :message="form.errors.name_kana" />
    </div>
    <div class="mb-6">
      <CustomerInformationLabel for="number" value="電話番号" />
      <CustomerInformationInput id="number" type="tel" class="mt-1 block w-full bg-gray-50" v-model="form.number" required  />
      <CustomerInformationInputError class="mt-2" :message="form.errors.number" />
    </div>
    <div class="mb-6">
      <CustomerInformationLabel for="note" value="備考" />
      <CustomerInformationTextarea id="note" v-model="form.note"/>
      <CustomerInformationInputError class="mt-2" :message="form.errors.note" />
    </div>

    <div class="flex items-end w-full mt-14">
      <CustomerInformationFormButton class="text-lg block self-end m-auto" v-text="'お支払い情報入力へ'"></CustomerInformationFormButton>
    </div>
  </form>
</template>

<style>

</style>