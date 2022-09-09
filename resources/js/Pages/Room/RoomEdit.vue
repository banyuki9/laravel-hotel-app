<script setup>
import BreezeInput from '@/Components/Input.vue';
import BreezeTextarea from '@/Components/Textarea.vue';
import BreezeInputFile from '@/Components/InputFile.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';
import CommonLayout from "@/Layouts/Common.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
const props = defineProps(["room"]);

const form = useForm({
  title: '',
  description: '',
  room_size: '',
  min_capacity: '',
  max_capacity: '',
  bed_type: '',
  facilities: '',
  main_image: '',
  sub_images: [],
});
</script>

<template>
  <Head title="Rooms" />

  <CommonLayout :title="room.title">
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          客室登録
        </h2>
    </template>

    <form action="" method="POST">

      <div class="mb-6">
        <BreezeLabel for="title" value="客室名" />
        <BreezeInput id="title" type="text" class="mt-1 block w-full bg-gray-50" v-model="form.title" required autocomplete="current-password" autofocus />
      </div>
      <div class="mb-6">
        <BreezeLabel for="description" value="客室の説明" />
        <BreezeTextarea id="description" v-model="form.description"/>
      </div>
      <div class="mb-6">
        <BreezeLabel for="room_size" value="広さ" />
        <BreezeInput id="room_size" type="text" class="mt-1 block w-full bg-gray-50" v-model="form.room_size" required autocomplete="current-password" />
      </div>
      <div class="mb-6">
        <BreezeLabel for="min_capacity" value="定員" />
        <div class="flex items-center">
          <BreezeInput id="min_capacity" type="text" class="mt-1 block w-full bg-gray-50 w-24 mr-2" v-model="form.min_capacity" required autocomplete="current-password" /> - <BreezeInput type="text" class="mt-1 block w-full bg-gray-50 w-24 ml-2" v-model="form.max_capacity" required autocomplete="current-password" />
        </div>
      </div>
      <div class="mb-6">
        <BreezeLabel for="bed_type" value="ベッドタイプ" />
        <BreezeInput id="bed_type" type="text" class="mt-1 block w-full bg-gray-50" v-model="form.room_size" required autocomplete="current-password" />
      </div>
      <div class="mb-6">
        <BreezeLabel for="facilities" value="その他の設備" />
        <BreezeTextarea id="facilities" v-model="form.facilities"/>
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
        <BreezeButton class="text-lg ">
          登録する
        </BreezeButton>
      </div>
    </form>
  </CommonLayout>
</template>

