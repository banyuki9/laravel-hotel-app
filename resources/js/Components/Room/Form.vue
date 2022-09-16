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
        <BreezeLabel for="title" value="客室名" />
        <BreezeInput id="title" type="text" class="mt-1 block w-full bg-gray-50" v-model="form.title" required autocomplete="current-password" autofocus />
        <BreezeInputError class="mt-2" :message="form.errors.title" />
      </div>
      <div class="mb-6">
        <BreezeLabel for="description" value="客室の説明" />
        <BreezeTextarea id="description" v-model="form.description"/>
        <BreezeInputError class="mt-2" :message="form.errors.description" />
      </div>
      <div class="mb-6">
        <BreezeLabel for="room_size" value="広さ" />
        <BreezeInput id="room_size" type="text" class="mt-1 block w-full bg-gray-50" v-model="form.room_size" required autocomplete="current-password" />
        <BreezeInputError class="mt-2" :message="form.errors.room_size" />
      </div>
      <div class="mb-6">
        <BreezeLabel for="min_capacity" value="定員" />
        <div class="flex items-center">
          <BreezeInput id="min_capacity" type="text" class="mt-1 block w-full bg-gray-50 w-24 mr-2" v-model="form.min_capacity" required autocomplete="current-password" /> - <BreezeInput type="text" class="mt-1 block w-full bg-gray-50 w-24 ml-2" v-model="form.max_capacity" required autocomplete="current-password" />
          <BreezeInputError class="mt-2" :message="form.errors.min_capacity" />
          <BreezeInputError class="mt-2" :message="form.errors.max_capacity" />
        </div>
      </div>
      <div class="mb-6">
        <BreezeLabel for="bed_type" value="ベッドタイプ" />
        <BreezeInput id="bed_type" type="text" class="mt-1 block w-full bg-gray-50" v-model="form.bed_type" required autocomplete="current-password" />
        <BreezeInputError class="mt-2" :message="form.errors.bed_type" />
      </div>
      <div class="mb-6">
        <BreezeLabel for="facilities" value="その他の設備" />
        <BreezeTextarea id="facilities" v-model="form.facilities"/>
        <BreezeInputError class="mt-2" :message="form.errors.facilities" />
      </div>
      
      <div class="mb-6">
        <BreezeLabel for="main_image" value="アイキャッチ画像" />
        <BreezeInputFile v-model="form.main_image" id="main_image"/>
        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">一覧時と詳細ページの一番上に表示されます。</div>
      </div>
      
      <div class="mb-6">
        <BreezeLabel for="main_image" value="サブ画像" />
        <BreezeInputFile v-model="form.main_image" id="main_image"/>
        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">10枚までアップロード可能</div>
      </div>


      <div class="flex justify-center mt-8">
        <BreezeButton class="text-lg" v-text="buttonText">

        </BreezeButton>
      </div>
    </form>
</template>

